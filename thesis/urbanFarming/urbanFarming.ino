#include <ESP8266WiFi.h>
#include "DHT.h"

#define DHTPIN D1
#define DHTTYPE DHT11 
 
const char* ssid     = "wifi username";
const char* password = "wifi password";
const char* host = "http://localhost/Urbanfarmingsystem.com";
DHT dht1(DHTPIN, DHTTYPE);
DHT dht2(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  delay(100);
  dht.begin();
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.print("Netmask: ");
  Serial.println(WiFi.subnetMask());
  Serial.print("Gateway: ");
  Serial.println(WiFi.gatewayIP());
}
void loop() {
  float h1 = dht1.readHumidity();
  float h2 = dht2.readHumidity();
  // Read temperature as Celsius (the default)
  float t1 = dht1.readTemperature();
  float t2 = dht2.readTemperature();
  if (isnan(h1) || isnan(t1)||isnan(h2) || isnan(t2)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  
  String url = "/insert.php?temp1=" + String(t1) + "&temp2=" + String(t2) + "&hum1=" + String(h1) +"&hum2="+ String(h2);
  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(500);
  
  while(client.available()){
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }
  
  Serial.println();
  Serial.println("closing connection");
  delay(3000);
}

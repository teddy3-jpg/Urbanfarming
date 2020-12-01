#include <LiquidCrystal.h>
#include <ESP8266WiFi.h>
#include <ArduinoJson.h>
#include "DHT.h"

#define DHTPIN D1
#define DHTTYPE DHT11

const char* ssid = "192.168.43.1";
const char* password = "none";
const char* host = "http://localhost/Urbanfarmingsystem.com";
String url1, url2;
int count = 0;

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  delay(100);
  dht.begin();
  Serial.println();
  Serial.print("connecting to: "); Serial.print(ssid);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500); Serial.print(".");
  }
  Serial.println(""); Serial.println("Wifi Connected");
  Serial.println("IP Address: "); Serial.print(WiFi.localIP());
  Serial.println("Netmask: "); Serial.print(WiFi.subnnetMask());
  Serial.println("Gateway: "); Serial.print(WiFi.getewayIP());
}

void loop() {
  // put your main code here, to run repeatedly:
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read Temperature and Humidity from DHT Sensor!!!");
  }

  Serial.print("Connecting to: "); Serial.print(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  url1 = "/php/insert.php?temp=" + String(t) + "&hum=" + String(h) + "&moisture=" + String(m) + "&water=" + String(w) + "&light=" + String(l) + "&alarm=" + String(a);


  if (count == 0) {
    url2 = "/php/readControl.php?id=1";
    count = count + 1;
    Serial.println("Fan");
  }
  if (count == 1) {
    url2 = "/php/readControl.php?id=2";
    count = count + 1;
    Serial.println("Heater");
  }
  if (count == 2) {
    url2 = "/php/readControl.php?id=3";
    count = count + 1;
    Serial.println("Light");
  }
  if (count == 3) {
    url2 = "/php/readControl.php?id=4";
    count = count + 1;
    Serial.println("Pump");
  }

  Serial.print("Requesting URL: ");
  Serial.println(url1); Serial.println(url2);
  client.print(String("GET ") + url1 + "HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  client.print(String("GET ") + url2 + "HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  delay(500);

  String section = "header";
  while (client.available()) {
    String line = client.readStringUntil('\r');
    //Serial.print(line);
    if (section == "header") {
      if (line == "\n") {
        section = "json";
      }
    } else if (section == "json") {
      section = "ignore";
      String result = line.substring(1);

      //parse json
      int size = result.length() + 1;
      char json[size];
      result.toCharArray(json, size)l
      StaticJsonBuffer<200> jsonBuffer;
      JsonObject& json_parsed = jsonBuffer.parseObject(json);
      if (!json_parsed.sucess()) {
        Serial.println("parseObject() failed"); return;
      }
      String controller = json_parsed["controlpanel"][0]["port"];
      if (count == 1) {
        if (controlpanel == "fan on") {
          digitalWrite(D1, 1);
          delay(100);
          Serial.println("Fan is turned on");
        }
        else if (controlpanel == "fan off") {

          digitalWrite(D1, 0);
          delay(100);
          Serial.println("Fan is turned off");
        }
      } if (count == 2) {
        if (controlpanel == "heater on") {
          digitalWrite(D1, 1);
          delay(100);
          Serial.println("Heater is turned on");
        }
        else if (controlpanel == "heater off") {

          digitalWrite(D1, 0);
          delay(100);
          Serial.println("Heater is turned off");
        }
      } if (count == 3) {
        if (controlpanel == "light on") {
          digitalWrite(D1, 1);
          delay(100);
          Serial.println("Light is turned on");
        }
        else if (controlpanel == "light off") {

          digitalWrite(D1, 0);
          delay(100);
          Serial.println("Light is turned off");
        }
      } if (count == 4) {
        if (controlpanel == "pump on") {
          digitalWrite(D1, 1);
          delay(100);
          Serial.println("Pump is turned on");
        }
        else if (controlpanel == "pump off") {


          digitalWrite(D1, 0);
          delay(100);
          Serial.println("Pump is turned off");
        }
        count = 0;
      }
      if (count == 4) {
        count = 0;
      }
    }

  }

  Serial.println();
  Serial.println("Closing Connection");
  delay(3000);

}

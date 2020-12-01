#include <ESP8266WiFi.h>
#include <ArduinoJson.h>
#include <LiquidCrystal.h>
#include <Keypad.h>
#include "DHT.h"

#define DHTTYPE DHT11   // DHT 11
#define DHTPIN 2     // Digital pin connected to the DHT sensor
#define LIGHT 3
#define ALARM 4
#define SOUND 5
#define HEATER 6
#define WATERLEVEL A0
#define MOISTURE A1
#define LDR A2

//intializing web server credentials
const char* ssid = "192.168.43.1";
const char* password = "none";
const char* host = "http://localhost/Urbanfarmingsystem.com";
String url1, url2;
int count = 0;

const byte ROWS = 4; //columns of keypad matrix
const byte COLS = 3;  //rows of keypad matrix
byte rowPins[ROWS] = {39, 40, 41, 42}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {38, 37, 36}; //connect to the column pinouts of the keypad

int h = 0, t = 0, waterlevel = 0, moistureSensor = 0, intensity = 0; //current measurments
int prevH = 0, prevT = 0, prevW = 0, prevM = 0, prevI = 0; //previous measurments
int changeT = 0, waterPoured = 0;  //change in temperature and poured water value
int hour = 0;

//setting up millis time interval variables for water
unsigned long previousDelayMillis = 0, previousDayMillis = 0, previousWaterMillis = 0;
const long delayInterval = 700;
int i = 0; //for the fan loop
long duration, waterInterval = 0;
int wInterval = 0;  // Variable to store the time interval between watering (numeric variable)
char waterKey;      //inserted keypad values for water
char keys[ROWS][COLS] = {
  {'1', '2', '3'},
  {'4', '5', '6'},
  {'7', '8', '9'},
  {'*', '0', '#'}
};

String alarmon = "On", alarmoff = "Off"; //alarm status
DHT dht(DHTPIN, DHTTYPE);
Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );
LiquidCrystal lcd(22, 23, 24, 25, 26, 27);

void setup() {
  Serial.begin(115200);
  wifiConnect();
  init();
  lcdDisplay();
}

void loop() {
  unsigned long currentMillis = millis(); // holds the current time
  if (currentMillis - previousDelayMillis >= delayInterval) {
    //save the last time
    previousDelayMillis = currentMillis;
    readTempAndHum();
    waterLevel();
    soilMoisture();
    LDRsensor();
    ioT();
  }
}
void init() {
  dht.begin();
  pinMode(LIGHT, OUTPUT);
  pinMode(ALARM, OUTPUT);
  pinMode(SOUND, OUTPUT);
  pinMode(HEATER, OUTPUT);

  digitalWrite(LIGHT, LOW);
  digitalWrite(ALARM, LOW);
  digitalWrite(SOUND, LOW);
  digitalWrite(HEATER, LOW);
  //stepper motor for water
  pinMode(28, OUTPUT); pinMode(29, OUTPUT); pinMode(30, OUTPUT); pinMode(31, OUTPUT);
  digitalWrite(28, LOW); digitalWrite(29, LOW); digitalWrite(30, LOW); digitalWrite(31, LOW);

  //stepper motor for fan
  pinMode(32, OUTPUT); pinMode(33, OUTPUT); pinMode(34, OUTPUT); pinMode(35, OUTPUT);
  digitalWrite(32, LOW); digitalWrite(33, LOW); digitalWrite(34, LOW); digitalWrite(35, LOW);
  prevH = dht.readHumidity();
  prevT = dht.readTemperature();
  prevW = analogRead(WATERLEVEL) - waterPoured;
  prevI = analogRead(LDR);
  prevM = analogRead(MOISTURE) + waterPoured;
}
void readTempAndHum() {
  // int prevT = 0, prevH = 0;
  h = dht.readHumidity();
  t = dht.readTemperature() - changeT;

  //int mincriticalT = 2;  int maxcriticalT = 35;  int minT=18;  int maxT=30;  int minH=40;int maxH=70;
  if (isnan(h) || isnan(t)) {
    Serial.println(F("Failed to read from sensors!"));
    return;
  }



  if (t > 24) {

    for (int i = 0; i < 3; i++) {
      fanOn();
    }
    lcd.setCursor(4, 0);
    lcd.print("H");
  } else  if (t <= 24 && t >= 18) {
    fanOff();
    heater(0);
    lcd.setCursor(4, 0);
    lcd.print("N");
  }
  else if (t < 18) {
    heater(1);
    lcd.setCursor(4, 0);
    lcd.print("L");
  } else {
    if (t <= 2 || t > 35 || h < 40 || h > 70) {
      alarmOn();
    }
  }
  if (t != prevT) {
    lcd.setCursor(2, 0);
    lcd.print(t);
    Serial.print(F("Temperature: ")); Serial.print(t); Serial.println(F("°C"));
    prevT = t;
  }
  if (h != prevH) {
    lcd.setCursor(14, 1);
    lcd.print(h);
    Serial.print(F("Humidity: ")); Serial.print(h); Serial.println("%");
    prevH = h;
  }
}
void waterLevel() {
  waterlevel = analogRead(WATERLEVEL);
  if (isnan(waterlevel)) {
    Serial.println(F("Failed to read from Water level sensor!"));
    return;
  }
  if (waterlevel != prevW) {
    if (waterlevel < 100) {
      alarmOn();
    }
    else if (waterlevel > 800) {
      alarmOn();
      waterlevel = waterlevel - 50;
    }

    lcd.setCursor(8, 1);
    lcd.print(waterlevel);
    prevW = waterlevel;
    Serial.print("Water level: "); Serial.println(waterlevel);
  }
  // return waterlevel;
}

void soilMoisture() {
  moistureSensor = analogRead(MOISTURE) + waterPoured;
  if (isnan(moistureSensor)) {
    Serial.println(F("Failed to read from Moisture sensor!"));
    return;
  }
  unsigned long currentMillis = millis();
  hour = currentMillis - previousDayMillis;
  if (currentMillis - previousDayMillis >= 10000) {
    previousDayMillis = currentMillis;
    hour = currentMillis - previousDayMillis;
  }
  if (moistureSensor < 300 && currentMillis - previousWaterMillis >= waterInterval) {
    alarmOn();
    previousWaterMillis = currentMillis;
    pump(1);
    // moistureSensor=moistureSensor+100;
  } else if (moistureSensor > 1000) {
    alarmOn();
    Serial.print("water is above the capacity of the tanker");
    pump(0);
    waterPoured = waterPoured - 200;
  } else {
    alarmOff();
    pump(0);
  }


  if (moistureSensor != prevM) {
    lcd.setCursor(2, 1);
    lcd.print(moistureSensor);
    Serial.print("Soil Moisture: "); Serial.println(moistureSensor);
    prevM = moistureSensor;
  }
  //return moistureSensor;
}
String alarm() {
  if (alarmOn()) {
    return alarmon;
  } else if (alarmOff()) {
    digitalWrite(SOUND, LOW);
    digitalWrite(ALARM, LOW);
    Serial.println("Alarm OFF");
    return alarmoff;
  } else {
    return "";
  }

}
bool alarmOn() {
  digitalWrite(SOUND, HIGH);
  digitalWrite(ALARM, HIGH);
  Serial.println("Alarm ON");
  return true;
}
bool alarmOff() {
  digitalWrite(SOUND, LOW);
  digitalWrite(ALARM, LOW);
  Serial.println("Alarm OFF");
  return true;
}


void light(int i) {

  if (i == 1) {
    digitalWrite(LIGHT, HIGH);
    Serial.println("Light ON");
  } else if (i == 0) {
    digitalWrite(LIGHT, LOW);
    Serial.println("Light OFF");
  } else {
    return;
  }


}
void LDRsensor() {
  //identifying day time and night time
  unsigned long currentMillis = millis();
  hour = currentMillis - previousDayMillis;
  if (currentMillis - previousDayMillis >= 10000) {
    previousDayMillis = currentMillis;
    hour = currentMillis - previousDayMillis;
  }
  intensity = analogRead(LDR);
  if (isnan(intensity)) {
    Serial.println(F("Failed to read from LDR sensor!"));
    return;
  }
  if (intensity < 300 && hour <= 5000) {
    light(1);
  } else {
    light(0);
  }
  if (intensity != prevI) {
    lcd.setCursor(9, 0);
    lcd.print(intensity);
    Serial.print(F("intensity:")); Serial.println(intensity);
    prevI = intensity;
  }
  if (hour <= 5000)
  { lcd.setCursor(12, 0);
    lcd.print("Day");
  }
  else
  { lcd.setCursor(12, 0);
    lcd.print("Night");
  }


  // return intensity;
}

void lcdDisplay() {
  lcd.begin(16, 2);
  lcd.clear();
  lcd.print("Power ON");
  delay(300);

  lcd.clear();
  lcd.print("Welcome to UrbanFarmingSystem");
  delay(300);

  lcd.clear();
  lcd.print("Enter time inte-");
  lcd.setCursor(0, 1);
  lcd.print("rval b/n watering");

  // Wait until the user inputs the interval for watering
  while (!waterKey) {
    waterKey = keypad.getKey();;
  }
  wInterval = int(waterKey) - 48;
  waterInterval = wInterval * 1000;
  lcd.clear();               // Clear the display
  lcd.print("Intervals in second");   // Print some text
  lcd.setCursor(0, 1);      // Set the LCD cursor to the required position
  lcd.print("water=");   // Print some text
  lcd.setCursor(7, 1);      // Set the LCD cursor to the required position
  lcd.print(wInterval);       // Print the water interval
  delay(500);

  lcd.clear(); // Clear the display
  lcd.setCursor(0, 0);
  lcd.print("T=");
  lcd.setCursor(2, 0);
  lcd.print(prevT);
  lcd.setCursor(6, 0);
  lcd.print("I=");
  lcd.setCursor(8, 0);
  lcd.print(prevI);
  lcd.setCursor(12, 1);
  lcd.print("H=");
  lcd.setCursor(14, 1);
  lcd.print(prevH);
  lcd.setCursor(0, 1);
  lcd.print("M=");
  lcd.setCursor(2, 1);
  lcd.print(prevM);
  lcd.setCursor(6, 1);
  lcd.print("W=");
  lcd.setCursor(8, 1);
  lcd.print(prevW);
  delay(700);
}

void pump(int w) {
  if (w == 1) {
    digitalWrite(28, HIGH);
    digitalWrite(29, LOW);
    digitalWrite(30, HIGH);
    digitalWrite(31, LOW);
    delay(100);
    digitalWrite(28, LOW);
    digitalWrite(29, HIGH);
    digitalWrite(30, HIGH);
    digitalWrite(31, LOW);
    delay(100);
    digitalWrite(28, LOW);
    digitalWrite(29, HIGH);
    digitalWrite(30, LOW);
    digitalWrite(31, HIGH);
    delay(100);
    digitalWrite(28, HIGH);
    digitalWrite(29, LOW);
    digitalWrite(30, LOW);
    digitalWrite(31, HIGH);
    delay(200);
    waterPoured = waterPoured + 400;
  }
  //close water valve
  else if (w == 0) {
    digitalWrite(28, HIGH);
    digitalWrite(29, LOW);
    digitalWrite(30, LOW);
    digitalWrite(31, HIGH);
    delay(100);
    digitalWrite(28, LOW);
    digitalWrite(29, HIGH);
    digitalWrite(30, LOW);
    digitalWrite(31, HIGH);
    delay(100);
    digitalWrite(28, LOW);
    digitalWrite(29, HIGH);
    digitalWrite(30, HIGH);
    digitalWrite(31, LOW);
    delay(100);
    digitalWrite(28, HIGH);
    digitalWrite(29, LOW);
    digitalWrite(30, HIGH);
    digitalWrite(31, LOW);

  }
}
void fanOn() {

  digitalWrite(32, HIGH);
  digitalWrite(33, LOW);
  digitalWrite(34, HIGH);
  digitalWrite(35, LOW);
  delay(200);
  digitalWrite(32, LOW);
  digitalWrite(33, HIGH);
  digitalWrite(34, HIGH);
  digitalWrite(35, LOW);
  delay(200);
  digitalWrite(32, LOW);
  digitalWrite(33, HIGH);
  digitalWrite(34, LOW);
  digitalWrite(35, HIGH);
  delay(200);
  digitalWrite(32, HIGH);
  digitalWrite(33, LOW);
  digitalWrite(34, LOW);
  digitalWrite(35, HIGH);
  delay(200);
  changeT = changeT + 2;
}
void fanOff() {
  digitalWrite(32, LOW);
  digitalWrite(33, LOW);
  digitalWrite(34, LOW);
  digitalWrite(35, LOW);
}
void heater(int n) {
  if (n == 1) {
    digitalWrite(HEATER, HIGH);
    changeT = changeT - 6;
  } else if (n == 0) {
    digitalWrite(HEATER, LOW);
  }
}
void wifiConnect() {
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
void ioT() {
  Serial.print("Connecting to: ");
  Serial.print(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  url1 = "/php/insert.php?temp=" + String(prevT) + "&hum=" + String(prevH) + "&moisture=" + String(prevM) + "&water=" + String(prevW) + "&light=" + String(prevI) + "&alarm=" + String(alarm());


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
          fanOn();
          delay(100);
          Serial.println("Fan is turned on");
        }
        else if (controlpanel == "fan off") {

          fanOff();
          delay(100);
          Serial.println("Fan is turned off");
        }
      } if (count == 2) {
        if (controlpanel == "heater on") {
          heater(1);
          delay(100);
          Serial.println("Heater is turned on");
        }
        else if (controlpanel == "heater off") {
          heater(0);
          delay(100);
          Serial.println("Heater is turned off");
        }
      } if (count == 3) {
        if (controlpanel == "light on") {
          light(1);
          delay(100);
          Serial.println("Light is turned on");
        }
        else if (controlpanel == "light off") {

          light(0);
          delay(100);
          Serial.println("Light is turned off");
        }
      } if (count == 4) {
        if (controlpanel == "pump on") {
          pump(1);
          delay(100);
          Serial.println("Pump is turned on");
        }
        else if (controlpanel == "pump off") {


          pump(0);
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

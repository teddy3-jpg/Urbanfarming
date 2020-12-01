//including libraries for keypad and LCD
#include <Keypad.h>
#include <LiquidCrystal.h>
//4 row and 3 column keypad
const byte ROWS = 4;
const byte COLS = 3;
//setting up sensor pins
const int tempPin = A0;
const int moistureLevelPin = A1;
const int sunlightPin = A2;
const int humidityPin = A3;
const int echoPin = 49; // Echo Pin of Ultrasonic Sensor
const int pingPin = 48; // Trigger Pin of Ultrasonic Sensor
//setting up millis time interval variables for water
unsigned long previousWaterMillis = 0;
long waterInterval = 0;
unsigned long previousDelayMillis = 0;
unsigned long previousDayMillis = 0;
const long delayInterval = 700;
int i=0;   //for the fan loop
long duration, waterLevel,prevWaterLevel; //

int temp = 0;
int humidity = 0;
int intensity = 0;
int tempChange=0;
int waterPoured = 0; //holds the amount of water added after opening the water pump
int prevTemp = 0;
int prevHumidity = 0;
int prevIntensity = 0;
int moistureLevel = 0;
int prevMoistureLevel = 0;
int normalMoistureLevel = 500;
int criticalMoistureLevel = 50;
int criticalWaterLevel=100;
//setting up minimum and maximum temperature level
int minTemp = 20;
int hour = 0;
int maxTemp = 35;
int minCriticalTemp=10;
int maxCriticalTemp=50;
int smokeValue;
//Keypad configuration
char keys[ROWS][COLS] = {
  {'1','2','3'},
  {'4','5','6'},
  {'7','8','9'},
  {'*','0','#'}
};

byte rowPins[ROWS] = {40, 41, 42, 43}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {39, 38, 37}; //connect to the column pinouts of the keypad

Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );
// Initialize the library with the numbers of the interface pins
LiquidCrystal lcd(22, 23, 24, 25, 26, 27); // Create an lcd object and assign the pins

int wInterval = 0;  // Variable to store the time interval between watering (numeric variable)
//inserted keypad values for water
char waterKey;

void setup() {
  // put your setup code here, to run once:
  //selecting pins as output and setting them low
  pinMode(45, OUTPUT); 
  pinMode(46, OUTPUT); 
  pinMode(47, INPUT);   
  pinMode(44, OUTPUT);
  pinMode(28, OUTPUT); 

  digitalWrite(28,LOW);
  digitalWrite(45,LOW);
  digitalWrite(46,LOW);  
  digitalWrite(44,LOW); 
  //stepper motor for water
  pinMode(29, OUTPUT); 
  pinMode(30, OUTPUT);
  pinMode(31, OUTPUT); 
  pinMode(32, OUTPUT);
  digitalWrite(29,LOW);
  digitalWrite(30,LOW);
  digitalWrite(31,LOW); 
  digitalWrite(32,LOW);
  //stepper motor for fan
  pinMode(33, OUTPUT); 
  pinMode(34, OUTPUT);
  pinMode(35, OUTPUT); 
  pinMode(36, OUTPUT);
  digitalWrite(33,LOW);
  digitalWrite(34,LOW);
  digitalWrite(35,LOW); 
  digitalWrite(36,LOW);
  //for level sensor
  pinMode(pingPin, OUTPUT); // initialising pin 48 as output
  pinMode(echoPin, INPUT); // initialising pin 49 as input
  //printing power on
  lcd.begin(16, 2); // Set the display to 16 columns and 2 rows
  lcd.clear(); // Clear the display
  lcd.print("Power ON"); // Print some text

  delay(300);
  // Accept user input. The user should only enter 1-9 for simulation purposes
  lcd.clear(); 
  lcd.print("Enter time inte-");
  lcd.setCursor(0,1);
  lcd.print("rval b/n watering");
  
  // Wait until the user inputs the interval for watering
  while(!waterKey){
    waterKey = keypad.getKey();;
  }
  // Convert the character input to its integer equivalent using its ASCII code
  wInterval = int(waterKey)-48;    
  waterInterval = wInterval*1000;
  lcd.clear();               // Clear the display
  lcd.print("Intervals in second");   // Print some text
  lcd.setCursor(0,1);       // Set the LCD cursor to the required position
  lcd.print("water=");   // Print some text
  lcd.setCursor(7,1);       // Set the LCD cursor to the required position
  lcd.print(wInterval);       // Print the water interval
  delay(500);

  // Variables to hold previous readings of sensor values
  prevMoistureLevel = analogRead(moistureLevelPin)+waterPoured;
  prevTemp = analogRead(tempPin)/2.046;
  prevIntensity = analogRead(sunlightPin);
  prevHumidity = (0.1577*analogRead(humidityPin))-25.868;
  digitalWrite(pingPin, LOW);
  delayMicroseconds(2);
  digitalWrite(pingPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(pingPin, LOW);
  duration = pulseIn(echoPin, HIGH); // using pulsin function to determine total time
  prevWaterLevel = (duration / 29 / 2)-waterPoured; // calling method

  // display temperature, water level and feed-level readings on LCD
  lcd.clear(); // Clear the display
  lcd.setCursor(0,0);
  lcd.print("T="); 
  lcd.setCursor(2,0);
  lcd.print(prevTemp);
  lcd.setCursor(6,0);
  lcd.print("I="); 
  lcd.setCursor(8,0);
  lcd.print(prevIntensity);
  lcd.setCursor(12,1);
  lcd.print("H="); 
  lcd.setCursor(14,1);
  lcd.print(prevHumidity);
  lcd.setCursor(0,1);
  lcd.print("M=");
  lcd.setCursor(2,1);
  lcd.print(prevMoistureLevel);
  lcd.setCursor(6,1);
  lcd.print("L=");
  lcd.setCursor(8,1);
  lcd.print(prevWaterLevel);

  delay(700);
}

void loop() {
    unsigned long currentMillis = millis(); // holds the current time
  if (currentMillis - previousDelayMillis >= delayInterval) {
   //save the last time
previousDelayMillis = currentMillis;
  //sensor inputs
  moistureLevel = analogRead(moistureLevelPin)+waterPoured;
  temp = (analogRead(tempPin)/2.046)-tempChange;
  intensity = analogRead(sunlightPin);
  humidity = (0.1577*analogRead(humidityPin))-25.868;
  smokeValue = digitalRead(47);
  //sounder and led alarm
    if (moistureLevel<criticalMoistureLevel || temp>maxCriticalTemp || 
    temp<minCriticalTemp || smokeValue == HIGH || waterLevel<criticalWaterLevel){
    digitalWrite(44, HIGH);
    digitalWrite(45,HIGH); }
    else{
    digitalWrite(44, LOW);
    digitalWrite(45,LOW); }
    //identifying day time and night time
    hour = currentMillis - previousDayMillis;
    if(currentMillis - previousDayMillis >= 10000){
      previousDayMillis = currentMillis;
      hour = currentMillis - previousDayMillis;
    }
    //artificial light
    if(prevIntensity<=300 && hour <= 5000){
      digitalWrite(46,HIGH); }
    else{
    digitalWrite(46, LOW);
      }
   //updating the temperature value 
  if (temp!=prevTemp){
    lcd.setCursor(2,0);
    lcd.print(temp); 
    prevTemp = temp;
  }
  //updating the humidy
  if (humidity!=prevHumidity){
    lcd.setCursor(14,1);
    lcd.print(humidity); 
    prevHumidity = humidity;
  }
    //updating the level sensor
  if (waterLevel!=prevWaterLevel){
    lcd.setCursor(8,1);
    lcd.print(waterLevel); 
    prevWaterLevel = waterLevel;
  }
  //updating the intensity
    if (intensity!=prevIntensity){
    lcd.setCursor(9,0);
    lcd.print(temp); 
    prevIntensity = intensity;
  }
  //updating the water level value
    if (moistureLevel!=prevMoistureLevel){
    lcd.setCursor(2,1);
    lcd.print(moistureLevel); 
    prevMoistureLevel =  moistureLevel;
  }
 //simulating the consumption of water
if(moistureLevel>=50)
waterPoured = waterPoured-50;
if(waterLevel<=0)
waterLevel = 0;
//displaying the real time values of temperature and water
  lcd.clear(); // Clear the display
  lcd.setCursor(0,0);
  lcd.print("T="); 
  lcd.setCursor(2,0);
  lcd.print(prevTemp);
  lcd.setCursor(12,1);
  lcd.print("H="); 
  lcd.setCursor(14,1);
  lcd.print(prevHumidity);
  lcd.setCursor(6,0);
  lcd.print("I="); 
  lcd.setCursor(8,0);
  lcd.print(prevIntensity);
  lcd.setCursor(0,1);
  lcd.print("M=");
  lcd.setCursor(2,1);
  lcd.print(prevMoistureLevel);
  lcd.setCursor(6,1);
  lcd.print("L=");
  lcd.setCursor(8,1);
  lcd.print(prevWaterLevel);
  //printing Day and Night
  if(hour <= 5000)
  {   lcd.setCursor(12,0);
      lcd.print("Day");
    }
  else
  {  lcd.setCursor(12,0);
     lcd.print("Night");
    }
    // Display "L" for Low on LCD if temperature is below minimum temperature
  if (temp<minTemp){
    lcd.setCursor(4,0);
    lcd.print("L"); 
  }
  // Display "H" for High on LCD if temperature is below minimum temperature
  else if (temp>maxTemp){ 
    lcd.setCursor(4,0);
    lcd.print("H"); 
  }
  // Display "N" for Normal on LCD if temperature is below minimum temperature
  else{    
    lcd.setCursor(4,0);
    lcd.print("N"); 
  }
  //for level sensor
  digitalWrite(pingPin, LOW);
  delayMicroseconds(2);
  digitalWrite(pingPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(pingPin, LOW);
  duration = pulseIn(echoPin, HIGH); // using pulsin function to determine total time
  waterLevel = (duration / 29 / 2)-waterPoured; // calling method
   //opening the water valve if the watering time interval is reached and if 
  //the water level is below normal
if (moistureLevel<normalMoistureLevel && currentMillis - previousWaterMillis >= waterInterval){
    //open water valve
previousWaterMillis = currentMillis;
digitalWrite(29,HIGH);
digitalWrite(30,LOW);
digitalWrite(31,HIGH);
digitalWrite(32,LOW);
delay(100);
digitalWrite(29,LOW);
digitalWrite(30,HIGH);
digitalWrite(31,HIGH);
digitalWrite(32,LOW);
delay(100);
digitalWrite(29,LOW);
digitalWrite(30,HIGH);
digitalWrite(31,LOW);
digitalWrite(32,HIGH);
delay(100); 
digitalWrite(29,HIGH);
digitalWrite(30,LOW);
digitalWrite(31,LOW);
digitalWrite(32,HIGH);
delay(200);
waterPoured = waterPoured+400;

//close water valve
digitalWrite(29,HIGH);
digitalWrite(30,LOW);
digitalWrite(31,LOW);
digitalWrite(32,HIGH);
delay(100);
digitalWrite(29,LOW);
digitalWrite(30,HIGH);
digitalWrite(31,LOW);
digitalWrite(32,HIGH);
delay(100);
digitalWrite(29,LOW);
digitalWrite(30,HIGH);
digitalWrite(31,HIGH);
digitalWrite(32,LOW);
delay(100);
digitalWrite(29,HIGH);
digitalWrite(30,LOW);
digitalWrite(31,HIGH);
digitalWrite(32,LOW); 
  }
//the food level is below normal
  if (temp>maxTemp){
    //rotate fan
 for(i=0; i<3;i++){
digitalWrite(33,HIGH);
digitalWrite(34,LOW);
digitalWrite(35,HIGH);
digitalWrite(36,LOW);
delay(200);
digitalWrite(33,LOW);
digitalWrite(34,HIGH);
digitalWrite(35,HIGH);
digitalWrite(36,LOW);
delay(200);
digitalWrite(33,LOW);
digitalWrite(34,HIGH);
digitalWrite(35,LOW);
digitalWrite(36,HIGH);
delay(200); 
digitalWrite(33,HIGH);
digitalWrite(34,LOW);
digitalWrite(35,LOW);
digitalWrite(36,HIGH);
delay(200);
tempChange=tempChange+2;
}
  }
  //code for the heater
  if (temp<minTemp){
    digitalWrite(28,HIGH);
    tempChange=tempChange-6;
    delay(800);
    digitalWrite(28,LOW);    
    }
  }
}

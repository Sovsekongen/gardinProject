#include <SoftwareSerial.h>
SoftwareSerial mySerial(5, 4);

void setup() 
{
  Serial.begin(9600);
  mySerial.begin(9600);
  
  pinMode(2, OUTPUT);
  pinMode(3, OUTPUT);
  digitalWrite(2, LOW);
  digitalWrite(3, LOW);
}

void loop() 
{
  String Data = "";
  char character;
  while (mySerial.available())
  {
    char character = mySerial.read();

      Data.concat(character);
      Serial.print("Received: ");
      Serial.println(Data);

      if(Data == "1")
    {
      digitalWrite(3, HIGH);
      digitalWrite(2, LOW);
      delay(65333);
    }
    else if(Data == "2")
    {
      digitalWrite(3, LOW);
      digitalWrite(2, HIGH);
      delay(66355);
    }
    else if(Data == "0")
    {
      digitalWrite(3, LOW);
      digitalWrite(2, LOW);
    }
    else
    {
      digitalWrite(3, LOW);
      digitalWrite(2, LOW);
    }
  }
}

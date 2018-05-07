int command = 0;
void setup() 
{
  Serial.begin(9600);
  pinMode(13, OUTPUT);
  pinMode(14, OUTPUT);
}

void loop() 
{
  if(Serial.available() > 0)
  {
    command = Serial.read();
    Serial.print(command);
    Serial.print("/n");
    if(command == 1)
    {
       digitalWrite(13, HIGH);
       digitalWrite(14, LOW);
    }
    else if(command == 2)
    {
       digitalWrite(13, LOW);
       digitalWrite(14, HIGH); 
    }
    else if(command == 0)
    {
      digitalWrite(13, LOW);
      digitalWrite(14, LOW);
    }
  }
}

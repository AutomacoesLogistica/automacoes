
int pin1 = 16;
int pin2 = 5;
String readString;
void setup() 
{
Serial.begin(115200);
pinMode(pin1,OUTPUT);
digitalWrite(pin1,LOW);
pinMode(pin2,OUTPUT);
digitalWrite(pin2,LOW);

}

void loop() 
{
 // Verifica se chegou algo na serial
 
 while (Serial.available()) 
 {
    delay(3);  
    char c = Serial.read();
    readString += c; 
 }
 
 // ******************************************************************************************************************************************************************************************
 
 if (readString.length() >0) 
 {
  Serial.println(readString);
  
  if (readString == "on1")     
  {
   digitalWrite(pin1, HIGH);
  }
  if (readString == "off1")
  {
   digitalWrite(pin1, LOW);
  }

  if (readString == "on2")     
  {
   digitalWrite(pin2, HIGH);
  }
  if (readString == "off2")
  {
   digitalWrite(pin2, LOW);
  }



    
  readString="";
 } 

} // fecha o loop

String readString;


void setup() 
{
Serial.begin(9600);

}

void loop() 
{
while(Serial.available())
{
 delay(3);
 char c = Serial.read();
 readString += c;
}

if (readString.length()>0) 
{
 Serial.println(readString);
 readString="";
}


}

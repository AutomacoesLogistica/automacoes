  // Arduino MEGA

#include <Wire.h>
String readString ;
void setup ()
{
Wire.begin(); //Definindo ser o MASTER
Serial.begin(9600);

}


void loop()
{
 char a = Serial.read(); 
  
 if (a == 'a')
 {
  Wire.requestFrom(2,6);
 }

while(Wire.available())
{
char c = Wire.read();

if(c!=';'){Serial.print(c);readString+=c;}
else{Serial.print("\n");
Serial.print("0 Valor de a e = ");
Serial.println(readString);
readString = "";
}
}

}

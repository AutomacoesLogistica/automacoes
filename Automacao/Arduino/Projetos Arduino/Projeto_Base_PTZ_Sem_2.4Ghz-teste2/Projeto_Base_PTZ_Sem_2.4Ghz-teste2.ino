#include <Servo.h> 
Servo myservoV; 
Servo myservoH; 
String readString;

int no=1;
 byte outArray[7];
 unsigned stopcheck;
 int checksum;
 int ByteNumber = 0;
 
String a[7];
int b;
void setup()
{

  Serial.begin(1200);
  pinMode(13,OUTPUT);
  digitalWrite(13,0);
b = 0;
}

void displayData()
{
  if ( no ==1 )
  {
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
    
   }
}


void loop()
{
//   digitalWrite(13,!digitalRead(13));  delay(100) 
 if ( no == 1  )
 {

      while ( Serial.available ())
      {          
        readString = Serial.read();

        if(b==6)
       {
        a[6] = readString;
        if(b>=6)
       {
       
        if(a[0]=="255")
        {
        Serial.print(a[0]);Serial.print(a[1]);Serial.print(a[2]);Serial.print(a[3]);Serial.print(a[4]);Serial.print(a[5]);Serial.print(a[6]); b = -1;Serial.println("");readString="";
        }
        else
        {
         for(int c=0;c<7;c++)
         {
          a[c] = "";
          b = 0;
         }
        }
       
       
       }

       }
           if(b==5)
       {
        a[5] = readString;
        b++;
       }
          if(b==4)
       {
        a[4] = readString;
        b++;
       }
         if(b==3)
       {
        a[3] = readString;
        b++;
       }
        if(b==2)
       {
        a[2] = readString;
        b++;
       }
        if(b==1)
       {
        a[1] = readString;
        b++;
       }
       if(b==0)
       {
        a[0] = readString;
        b++;
       }
       if (b==-1)
       {
        b=0;
       }
        
        
        outArray[0] = Serial.read();
      //Serial.write((byte)(outArray[0]));
      
      }

     // if(outArray[0].indexOf("led1") >= 0)
      
      
       
 }
 
 }  // final do loop



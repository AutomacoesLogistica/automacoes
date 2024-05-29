/*  
 This program is used for an Arduino to receive and decode PELCO-D PTZ Commands
 
 Thanks to Michael Blaylock for his sketch.  Learning how to read and procces serial data
 
 */
 
#include <LiquidCrystal.h>
 
  LiquidCrystal lcd(12, 11, 9, 8, 7, 6);
 
  byte outArray[7];        // read data Pelco Command
  unsigned stopcheck;      // For checking when a STOP command is received (257 Decimal)
  int checksum;            // For Calculating Checksum. Sum of the payload bytes (bytes 2 through 6) in the message
  int ByteNumber;
  int MotorSpeed;
 
void setup(){
 
  lcd.begin(16, 2);        // set up the LCD's number of columns and rows:
 
  Serial.begin(9600);      // baud rate  9600 can be 1200,2400 or 4800
 
  pinMode(3,  OUTPUT);
  pinMode(5,  OUTPUT);
  pinMode(13, OUTPUT);
 
  digitalWrite(3, HIGH);
  digitalWrite(5, HIGH);
 
}
 
void displayData()          // Display the array in serial monitor for debugging
{
  
  for (int j = 0; j<7; j+=1)
  {
  Serial.print(outArray[j],HEX);
  Serial.print(", ");
  }
  Serial.println("");
}
 
void loop()
{
    if ( Serial.available ())
      {
        
           
        outArray[ByteNumber ++] = Serial.read();
      }
       if(outArray[1] == 0xFF){ByteNumber = 0;}
       if(outArray[2] == 0xFF){ByteNumber = 0;}
       if(outArray[3] == 0xFF){ByteNumber = 0;}
        if(outArray[6] == 0xFF){ByteNumber = 0;}
       if ( ByteNumber > 6)
      {
           // ready for next time
                // for debugging
       ByteNumber = 0;
       
      displayData();  
       
      stopcheck = outArray[0] + outArray[1] + outArray[2] + outArray[3] + outArray[4] + outArray[5] + outArray[6] ;   //
      
      //Calculate STOP
       if ( stopcheck==257)  // Quando stopcheck é 257 em decimal , para o comando de recebimento
       {
         ByteNumber = -1; ByteNumber = -1; ByteNumber = -1; ByteNumber = -1; ByteNumber = -1; ByteNumber = -1;
           // StopActions();  //
       }
      }
 
}


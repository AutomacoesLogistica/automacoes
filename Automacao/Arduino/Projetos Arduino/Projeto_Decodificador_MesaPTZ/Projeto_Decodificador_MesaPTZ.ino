#include <LiquidCrystal.h>
 LiquidCrystal lcd(12, 11, 9, 8, 7, 6);
 byte outArray[7];
 unsigned stopcheck;
 int checksum;
 int ByteNumber;
 int MotorSpeed;

void setup()
{
  lcd.begin(16, 2);
  Serial.begin(9600);
  pinMode(3,  OUTPUT);
  pinMode(5,  OUTPUT);
  pinMode(13, OUTPUT);
  digitalWrite(3, HIGH);
  digitalWrite(5, HIGH);
}

void displayData()
{
 Serial.println("");
  for (int j = 0; j<7; j+=1){
 Serial.print(outArray[j],HEX);
 Serial.print(", ");
}

}

void loop()
{
       while ( Serial.available () )
      {
        outArray[ByteNumber ++] = Serial.read();
      }

       if ( ByteNumber > 6)
      {
       ByteNumber = 0;          // ready for next time
       displayData();           // for debugging
      
      stopcheck = outArray[0] + outArray[1] + outArray[2] + outArray[3] + outArray[4] + outArray[5] + outArray[6] ;   //
      
      //Calculate STOP
       if ( stopcheck == 257)  // Quando stopcheck é 257 em decimal , para o comando de recebimento
       {
         ByteNumber = -1;
           // StopActions();  //
       }

              
         if ( bitRead(outArray[3],0) == 0 )  // quando BIT 0 = 0 command 2 Normal command (PTZ)
        {
          Decoderen();   // Try to decode the Pelco Command
        }
        
         if ( bitRead(outArray[3],0) == 1 )  // Quando BIT 0 = 1 command 2 Extended command
        {
        ExtendedCommands();   // Try to decode the Extended Pelco Command
        }

}  // final do if
}  // final do loop


void Decoderen() // void para decodificar
{
lcd.setCursor(0,1);
MotorSpeed = map (outArray[4],  0, 0x3F, 255, 0);

// PAN e TILT:
 if ( bitRead(outArray[3],1) == 1 )
{
     analogWrite(3 , MotorSpeed);
     // digitalWrite(3, HIGH);
         Serial.println("RIGHT SPEED: ");
     lcd.print(outArray[4]);
}

 if ( bitRead(outArray[3],2) == 1 )
{
     analogWrite(5, MotorSpeed);
     // digitalWrite(5, HIGH);
          Serial.println("LEFT  SPEED: ");
     lcd.print(outArray[4]);
}

 if ( bitRead(outArray[3],3) == 1 )
{
         Serial.println("UP    SPEED: ");
     lcd.print(outArray[5]);
}

 if ( bitRead(outArray[3],4) == 1 )
{
          Serial.println("DOWN  SPEED: ");
     lcd.print(outArray[5]);
}

// ZOOM IRIS FOCUS:
 if ( bitRead(outArray[2],2) == 1 )
{
     Serial.println("Iris Close");
}

 if ( bitRead(outArray[2],1) == 1 )
{
          Serial.println("Iris Open");
}

 if ( bitRead(outArray[2],0) == 1 )
{
          Serial.println("Focus Near");
}

 if ( bitRead(outArray[3],7) == 1 )
{
         Serial.println("Focus Far ");
}

 if ( bitRead(outArray[3],6) == 1 )
{
       Serial.println("Zoom Wide ");
}

 if ( bitRead(outArray[3],5) == 1 )
{
         Serial.println("Zoom Tele ");}
}

void ExtendedCommands()
{
 lcd.setCursor(0,1);

 if ( outArray[2] == 0 )    // Only continu when Word 3 is 0
{

 if ( outArray[3] == 0x03 ){      // SET PRESET
         Serial.println("Set Preset: ");
    lcd.print(outArray[5]-1);}    // PRINT Preset. -1 to calculate right preset

 if ( outArray[3] == 0x05 ){      // Clear Preset
        Serial.println("Clear Preset:");
    lcd.print(outArray[5]-1);}    // PRINT Preset. -1 to           calculate right preset

}}



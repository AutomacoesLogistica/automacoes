#include <IRremote.h>

IRsend irsend;
String readString;


int ledPin = 13;



void setup()
{
  Serial.begin(9600);
pinMode(ledPin, OUTPUT); 
  pinMode(2, OUTPUT); 
  pinMode(12, OUTPUT); 
  pinMode(4, OUTPUT); 
  pinMode(8, OUTPUT); 
  pinMode(9, OUTPUT);
 digitalWrite(8,0);
 digitalWrite(9,0); 


}


void loop()
{
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }
  
 
// PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY    
// PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY    
// PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY    
// PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY     PRODIGY    



// LIGAR
if(readString=="PLIGAR")
{
  irsend.sendNEC(0xEF3AC5, 32);
  delay(10);
}
//MUTE
if(readString=="PMUTE")
{
  irsend.sendNEC(0xEF7887, 32);
  delay(10);
}

//NUMEROS  NUMEROS NUMEROS NUMEROS

// 0
if(readString=="P0")
{
  irsend.sendNEC(0xEF2AD5, 32);
  delay(10);
}
// 1
if(readString=="P1")
{
  irsend.sendNEC(0xEF02FD, 32);
  delay(10);
}
// 2
if(readString=="P2")
{
  irsend.sendNEC(0xEFC03F, 32);
  delay(10);
}
// 3
if(readString=="P3")
{
  irsend.sendNEC(0xEF40BF, 32);
  delay(10);
}
// 4
if(readString=="P4")
{
  irsend.sendNEC(0xEF48B7, 32);
  delay(10);
}
// 5
if(readString=="P5")
{
  irsend.sendNEC(0xEF6897, 32);
  delay(10);
}
// 6
if(readString=="P6")
{
  irsend.sendNEC(0xEF58A7, 32);
  delay(10);
}
// 7
if(readString=="P7")
{
  irsend.sendNEC(0xEFC837, 32);
  delay(10);
}
// 8  
if(readString=="P8")
{
  irsend.sendNEC(0xEFE817, 32);
  delay(10);
}
// 9
if(readString=="P9")
{
  irsend.sendNEC(0xEFD827, 32);
  delay(10);
}

// VOL+
if(readString=="PVOL+")
{
  irsend.sendNEC(0xEF6A95, 32); // volume + prodigy
  delay(20);
}

// VOL-
if(readString=="PVOL-")
{
irsend.sendNEC(0xEFAA55, 32); // volume - prodigy
delay(20);
}

// CH+
if(readString=="PCH+")
{
  irsend.sendNEC(0xEFBA45, 32);
  delay(10);
}

// CH-
if(readString=="PCH-")
{
  irsend.sendNEC(0xEFF807, 32);
  delay(10);
}

// CIMA
if(readString=="PCIMA")
{
  irsend.sendNEC(0xEF12ED, 32);
  delay(10);
}

// BAIXO
if(readString=="PBAIXO")
{
  irsend.sendNEC(0xEF50AF, 32);
  delay(10);
}

// OK
if(readString=="POK")
{
  irsend.sendNEC(0xEFD02F, 32);
  delay(10);
}

// EXIT
if(readString=="PEXIT")
{
  irsend.sendNEC(0xEF38C7, 32);
  delay(10);
}

//SLEEP
if(readString=="PSLEEP")
{
  irsend.sendNEC(0xEF9867, 32);
  delay(10);
}

//PLAY
if(readString=="PPLAY")
{
  irsend.sendNEC(0xEF906F, 32);
  delay(10);
}

// REC
if(readString=="PREC")
{
  irsend.sendNEC(0xEF10EF, 32);
  delay(10);
}

// STOP
if(readString=="PSTOP")
{
  irsend.sendNEC(0xEFD22D, 32);
  delay(10);
}

//PROXIMA
if(readString=="PPROXIMA")
{
  irsend.sendNEC(0xEF00FF, 32);
  delay(10);
}

// ANTERIOR
if(readString=="PANTERIOR")
{
  irsend.sendNEC(0xEF20DF, 32);
  delay(10);
}

// USB
if(readString=="PUSB")
{
  irsend.sendNEC(0xEF18E7, 32);
  delay(10);
}





// TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO  
// TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO  
// TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO  
// TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO  
// TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO   TV PHILCO  
   
 // LIGA
if(readString=="FLIGAR")
{
  irsend.sendNEC(0xFDC03F, 32);
  delay(10);
}

// SOURCE
if(readString=="FSOURCE")
{
  irsend.sendNEC(0xFD7887, 32);
  delay(10);
}

// VOL+
if(readString=="FVOL+")
{
 for (int i = 0;i<5;i++)
 { 
  irsend.sendNEC(0xFD6897, 32);
 
 }
}

// VOL-
if(readString=="FVOL-")
{
  irsend.sendNEC(0xFD58A7, 32);
  delay(10);
}

// MUTE
if(readString=="FMUTE")
{
  irsend.sendNEC(0xFDA857, 32);
  delay(10);
}

// EXIT
if(readString=="FEXIT")
{
  irsend.sendNEC(0xFD22DD, 32);
  delay(10);
}

// SLEEP
if(readString=="FSLEEP")
{
  irsend.sendNEC(0xFD9867, 32);
  delay(10);
}



// AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL   
// AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL   
// AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL   
// AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL   
// AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL    AR CONSUL   

// LIGA
if(readString=="ALIGAR")
{
  irsend.sendNEC(0x3FA15E, 32);
  delay(10);
}

// VERTICAL
if(readString=="AVERTICAL")
{
  irsend.sendNEC(0x3FC13E, 32);
  delay(10);
}

// HORIZONTAL
if(readString=="AHORIZONTAL")
{
  irsend.sendNEC(0x3F41BE, 32);
  delay(10);
}

// VELOCIDADE
if(readString=="AVELOCIDADE")
{
  irsend.sendNEC(0x3F21DE, 32);
  delay(10);
}

// TIMER
if(readString=="ATIMER")
{
  irsend.sendNEC(0x3F619E, 32);
  delay(10);
}

// UMIDIFICAR
if(readString=="AUMIDIFICAR")
{
  irsend.sendNEC(0x3FE11E, 32);
  delay(10);
}











if (readString == "on")     
    {
      digitalWrite(ledPin, HIGH);
    }
    if (readString == "off")
    {
      digitalWrite(ledPin, LOW);
    }
    
     if (readString == "LampG")     
    {
      digitalWrite(2, HIGH);
      delay(500);
      digitalWrite(2, LOW);   
  }
    
     if (readString == "portG")     
      {
      digitalWrite(12, HIGH);
      delay(500);
      digitalWrite(12, LOW);   
      }
     
     if (readString == "portP")     
      {
      digitalWrite(4, HIGH);
      delay(500);
      digitalWrite(4, LOW);   
      }
    
     if (readString == "1")     
      {
      digitalWrite(8, HIGH);
      }
    
     if (readString == "2")     
      {
      digitalWrite(8, LOW);
      }
    
     if (readString == "3")     
      {
      digitalWrite(9, HIGH);
      }
    
     if (readString == "4")     
      {
      digitalWrite(9, LOW);
      }






readString="";
}

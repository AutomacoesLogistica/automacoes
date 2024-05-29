// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   48
#define CSN_PIN 49
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

byte outArray[7];

#include <Servo.h> 
Servo myservoV1; 
Servo myservoH1;
Servo myservoV2; 
Servo myservoH2;



int limV1,limV2;
int limH1,limH2;
int v1,v2;
int h1,h2;
int SINAIS[1];  // usada para receber os comandos enviados
String readString;


void setup()
{
 Serial.begin(9600);
 radio.begin();
 radio.openReadingPipe(1,pipe);
  radio.startListening();;


myservoV1.attach(3);
myservoH1.attach(5);
myservoV2.attach(6);
myservoH2.attach(9);

  
 limV1 = 179;
 limH1 = 179;
 
 limV2 = 179;
 limH2 = 179;

  myservoH1.write(0); 
  myservoV1.write(0);
  myservoH2.write(0); 
  myservoV2.write(0);
  delay(1000);

for (int a = 0; a<40; a++)
{
  myservoH1.write((a*3)*1.5); 
  myservoH2.write((a*3)*1.5); 
  myservoV1.write((a*3)*1.5); 
  myservoV2.write((a*3)*1.5); 
  delay(100);
}
 
 delay(50);
  
for (int b = 0; b<40; b++)
{
  myservoH1.write(180-(b*2.25)); 
  myservoH2.write(180-(b*2.25)); 
  myservoV1.write(180-(b*2.25)); 
  myservoV2.write(180-(b*2.25)); 
  delay(100);
}
  myservoH1.write(90); 
  myservoV1.write(90);
  myservoH2.write(90); 
  myservoV2.write(90);
 

  v1,v2,h1,h2 = 90;

}

void loop()
{
 if ( radio.available()) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  radio.read( SINAIS, sizeof(SINAIS) );
  //Serial.println(SINAIS[0]);
 }

if (SINAIS[0]==1)
{
   outArray[0] = 0xFF;
   outArray[1] = 0x01;
   outArray[2] = 0x00;
   outArray[3] = 0x00;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x01;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   SINAIS[0] = 0;
}

if (SINAIS[0]==2)
{
   outArray[0] = 0xFF;
   outArray[1] = 0x02;
   outArray[2] = 0x00;
   outArray[3] = 0x00;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x02;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");  
   SINAIS[0] = 0;
}



if (SINAIS[0]==65)
{
// zoom + camera 1  
   for(int u=0;u<20;u++)
   {
   outArray[0] = 0xFF;
   outArray[1] = 0x01;
   outArray[2] = 0x00;
   outArray[3] = 0x20;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x21;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   }
   outArray[0] = 0xFF;
   outArray[1] = 0x01;
   outArray[2] = 0x00;
   outArray[3] = 0x00;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x01;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   SINAIS[0] = 0;  }

if (SINAIS[0]==66)
{
// zoom + camera 2
   for(int u=0;u<20;u++)
   {
   outArray[0] = 0xFF;
   outArray[1] = 0x02;
   outArray[2] = 0x00;
   outArray[3] = 0x20;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x22;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   }
   outArray[0] = 0xFF;
   outArray[1] = 0x02;
   outArray[2] = 0x00;
   outArray[3] = 0x00;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x02;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   SINAIS[0] = 0;  

}

if (SINAIS[0]==129)
{
// zoom - camera 1  
  for(int u=0;u<20;u++)
   {
   outArray[0] = 0xFF;
   outArray[1] = 0x01;
   outArray[2] = 0x00;
   outArray[3] = 0x40;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x41;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   }
    outArray[0] = 0xFF;
   outArray[1] = 0x01;
   outArray[2] = 0x00;
   outArray[3] = 0x00;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x01;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   SINAIS[0] = 0;
  
   

}

if (SINAIS[0]==130)
{
// zoom - camera 2  
   for(int u=0;u<20;u++)
   {
   outArray[0] = 0xFF;
   outArray[1] = 0x02;
   outArray[2] = 0x00;
   outArray[3] = 0x40;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x42;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   }
   outArray[0] = 0xFF;
   outArray[1] = 0x02;
   outArray[2] = 0x00;
   outArray[3] = 0x00;
   outArray[4] = 0x00;
   outArray[5] = 0x00;
   outArray[6] = 0x02;
   Serial.write((byte)(outArray[0]));
   Serial.write((byte)(outArray[1]));
   Serial.write((byte)(outArray[2]));
   Serial.write((byte)(outArray[3]));
   Serial.write((byte)(outArray[4]));
   Serial.write((byte)(outArray[5]));
   Serial.write((byte)(outArray[6]));
   Serial.println("");
   SINAIS[0] = 0;  
}





if (SINAIS[0]==143)
{
// cima camera 1
   v1 = v1+2;
   if(v1>limV1)
   {
    v1=limV1;
   }
    myservoV1.write(v1);  
    SINAIS[0] = 0;
    delay(50);
   
}

if (SINAIS[0]==144)
{
// cima camera 2  
   v2 = v2+2;
   if(v2>limV2)
   {
    v2=limV2;
   }
    myservoV2.write(v2);  
    SINAIS[0] = 0;
    delay(50);
}

if (SINAIS[0]==159)
{
// baixo camera 1  
   v1 = v1-2;
   if(v1<0){v1=0;}
   myservoV1.write(v1); 
   SINAIS[0] = 0;
   delay(50);
}

if (SINAIS[0]==160)
{
// baixo camera 2
   v2 = v2-2;
   if(v2<0){v2=0;}
   myservoV2.write(v2);   
   SINAIS[0] = 0;
   delay(50);
}






if (SINAIS[0]==131)
{
// direita camera 1 
   h1 = h1+5;
   if(h1>limH1){h1=limH1;}
   myservoH1.write(h1); SINAIS[0] = 0; 
}






if (SINAIS[0]==132)
{
// direita camera 2  
   h2 = h2+5;
   if(h2>limH2){h2=limH2;}
   myservoH2.write(h2); SINAIS[0] = 0; 
}

if (SINAIS[0]==135)
{
// esquerda camera 1 
   h1 = h1-5;
   if(h1<0){h1=0;}
   myservoH1.write(h1); SINAIS[0] = 0; 
}

if (SINAIS[0]==136)
{
// esquerda camera 2  
   h2 = h2-5;
   if(h2<0){h2=0;}
   myservoH2.write(h2);  SINAIS[0] = 0;
}


if (SINAIS[0]==257)
{
// reset camera 1  
  myservoH1.write(0); 
  myservoV1.write(0);
  delay(1000);

for (int a = 0; a<40; a++)
{
  myservoH1.write((a*3)*1.5); 
  myservoV1.write((a*3)*1.5); 
  delay(100);
}
 
 delay(50);
  
for (int b = 0; b<40; b++)
{
  myservoH1.write(180-(b*2.25)); 
  myservoV1.write(180-(b*2.25)); 
  delay(100);
}
  myservoH1.write(90); 
  myservoV1.write(90);
  v1,h1 = 90;
SINAIS[0] = 0;

}

if (SINAIS[0]==258)
{
// reset camera 2  
  myservoH2.write(0); 
  myservoV2.write(0);
  delay(1000);

for (int a = 0; a<40; a++)
{
  myservoH2.write((a*3)*1.5); 
  myservoV2.write((a*3)*1.5); 
  delay(100);
}
 
 delay(50);
  
for (int b = 0; b<40; b++)
{
  myservoH2.write(180-(b*2.25)); 
  myservoV2.write(180-(b*2.25)); 
  delay(100);
}
  myservoH2.write(90); 
  myservoV2.write(90);
  v2,h2 = 90;
SINAIS[0] = 0;
}

}  // final do loop



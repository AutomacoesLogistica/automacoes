// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

int SINAIS[1];  // usada para receber os comandos enviados
String readString;
String a[7];
int b;

void setup()
{
 Serial.begin(9600);
 radio.begin();
  radio.openWritingPipe(pipe); // inicia envio
 b = 0;
}

void loop()
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
     //Serial.print(a[0]);Serial.print(a[1]);Serial.print(a[2]);Serial.print(a[3]);Serial.print(a[4]);Serial.print(a[5]);Serial.print(a[6]);
      b = -1;readString="";
      //(a[0].toInt())+(a[1].toInt())+(a[2].toInt())+(a[3].toInt())+(a[4].toInt())+(a[5].toInt())+(a[6].toInt());
     int v = (a[3].toInt())+(a[4].toInt())+(a[5].toInt())+(a[6].toInt());
     //Serial.println(v);
     SINAIS[0] = v;
     radio.write(SINAIS,sizeof(0));
    
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
 }
}  // final do loop



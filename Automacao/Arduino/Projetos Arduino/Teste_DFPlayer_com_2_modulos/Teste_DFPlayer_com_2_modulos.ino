#include "Arduino.h"
#include "SoftwareSerial.h"
#include "DFRobotDFPlayerMini.h"
#include "AltSoftSerial.h"



AltSoftSerial altSerial; // Porta 8 e 9 (8 -Pino3 do modulo), 9 - Pinos dos resistores) //So aceita essas portas!
SoftwareSerial mySoftwareSerial(7, A0);  //RX, TX  A0 - Pino dos resistores , 7 - 3° pino

DFRobotDFPlayerMini myDFPlayer;//Via altSerial
DFRobotDFPlayerMini myDFPlayer2; //Via softserial

char buf;
char audio = '1';  //numero do audio
char b = 'x';

void setup()
{
  mySoftwareSerial.begin(9600);
  Serial.begin(115200);
  altSerial.begin(9600);

  Serial.println();
  Serial.println(F("Iniciando modulo mp3 1"));
  
  if (!myDFPlayer.begin(altSerial)) { // Use softwareSerial to communicate with mp3.
    Serial.println("Erro!");
    while(true);
  }
   Serial.print("Numero de arquivos no cartao SD 1 : ");
  Serial.println(myDFPlayer.readFileCounts(DFPLAYER_DEVICE_SD));

// Definicoes iniciais do modulo mp3
 myDFPlayer.setTimeOut(500);// Timeout serial 500ms
 myDFPlayer.volume(4);// Volume 25
 myDFPlayer.EQ(4);// Equalizacao class

 /*
 // PARA TOCAR ALGUM AUDIO *************************************
  
 char audio = '1';//  numero do audio
 buf = audio - 48;
 myDFPlayer.play(buf);//  para tocar audio
 delay(2000);
 // ************************************************************
 */
 
  Serial.println("Modulo 1 iniciado com sucesso!");

  Serial.println();
  Serial.println(F("Iniciando modulo mp3 2"));



  if (!myDFPlayer2.begin(mySoftwareSerial)) { // Use softwareSerial to communicate with mp3.
    Serial.println("Erro!");
    while(true);
  }
  Serial.print("Numero de arquivos no cartao SD 2 : ");
  Serial.println(myDFPlayer2.readFileCounts(DFPLAYER_DEVICE_SD));

// Definicoes iniciais do modulo mp3
 myDFPlayer2.setTimeOut(500);// Timeout serial 500ms
 myDFPlayer2.volume(5);// Volume 25
 myDFPlayer2.EQ(4);// Equalizacao class

 
 // PARA TOCAR ALGUM AUDIO *************************************
  
 audio = '1';//  numero do audio
 buf = audio - 48;
 myDFPlayer2.play(buf);//  para tocar audio
 
 // ************************************************************
 
  Serial.println("Modulo 2 iniciado com sucesso!");



}

void loop()
{
 if(Serial.available()>0)
 {
  b = Serial.read();
 
  audio = b;//  numero do audio
  
  
  if( audio == '1')
  {
   buf = audio - 48;
   myDFPlayer.play(buf);//  para tocar audio
   Serial.println("Tocou no mp3 1");
  }
  else if( audio == '2')
  {
    
   buf = audio - 48;
   myDFPlayer2.play(buf);//  para tocar audio
   Serial.println("Tocou no mp3 2");
  }
 }
 
b = 'x';
}

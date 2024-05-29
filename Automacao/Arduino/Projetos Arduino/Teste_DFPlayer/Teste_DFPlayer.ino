#include "Arduino.h"
#include "SoftwareSerial.h"
#include "DFRobotDFPlayerMini.h"
#include "AltSoftSerial.h"

AltSoftSerial altSerial;
SoftwareSerial mySoftwareSerial(7, A0);  //RX, TX
DFRobotDFPlayerMini myDFPlayer;
DFRobotDFPlayerMini myDFPlayer2;

char buf;
char audio = '4';  //numero do audio

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
 myDFPlayer.volume(5);// Volume 25
 myDFPlayer.EQ(4);// Equalizacao class

 
 // PARA TOCAR ALGUM AUDIO *************************************
  
 char audio = '1';//  numero do audio
 buf = audio - 48;
 myDFPlayer.play(buf);//  para tocar audio
 
 // ************************************************************
 
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
  
}

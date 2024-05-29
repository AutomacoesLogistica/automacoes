/*
 * 
 * Maquina AC44i 2.4 para ferromodelismo pai
 * 
 * Complemento para reproduzir o audio de buzina e sino
 * 
 * segundo arduino pro mini
 * 4 - Buzina
 * 5 - Sino
 * 7 - Beep2
 */


 
// Carrega as Bibliotecas
#include <SPI.h>
#include "Arduino.h"
#include "SoftwareSerial.h"
#include "DFRobotDFPlayerMini.h"

//Inicia a //Serial por software nos pinos 7 e A0
SoftwareSerial mySoftwareSerial(7, A0); // RX, TX // para audios constantes ( Ligando, ligado e desligado )
String readString;

DFRobotDFPlayerMini myDFPlayer; // Via Soft//Serial

int xx = 0;
char buf;
char audio = '4'; // numero do audio

void setup() 
{
 Serial.begin(9600);
   
 mySoftwareSerial.begin(9600);
 Serial.println();
 Serial.println(F("DFPlayer iniciado!"));
 if (!myDFPlayer.begin(mySoftwareSerial)) // Inicia o modulo MP3
 {
   Serial.println(F("Falha:"));
   Serial.println(F("1.conexões!"));
   Serial.println(F("2.cheque o cartão SD1!"));
 }
 Serial.print("Numero de arquivos no cartao SD 1 : ");
 Serial.println(myDFPlayer.readFileCounts(DFPLAYER_DEVICE_SD));
 //Definicoes iniciais do modulo mp3
 
 myDFPlayer.setTimeOut(500); //Timeout //Serial 500ms
 myDFPlayer.volume(25); //Volume 25
 myDFPlayer.EQ(4); //Equalizacao class
  
 // PARA TOCAR ALGUM AUDIO *************************************
  /*
  char audio = '7'; // numero do audio
  buf = audio - 48;
  myDFPlayer.play(buf); // para tocar audio
  */
 // ************************************************************
 Serial.println("Modulo 2 iniciado com sucesso!");
 Serial.println("Iniciado!");
}

void loop() 
{

  while (Serial.available()) {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  if (readString.length() >0) {
    Serial.println(readString);
    if (readString.indexOf("audio4") >= 0) // Buzina     
    {
     Serial.println("Tocando audio buzina!"); 
     audio = '4'; // numero do audio
     buf = audio - 48;
     myDFPlayer.play(buf); // para tocar audio
    }
    else if (readString.indexOf("audio5") >= 0) // sino
    {
     Serial.println("Tocando audio sino!"); 
     audio = '5'; // numero do audio
     buf = audio - 48;
     myDFPlayer.play(buf); // para tocar audio  
    }
    else if (readString.indexOf("audio7") >= 0) // beep
    {
     Serial.println("Tocando audio beep!"); 
     audio = '7'; // numero do audio
     buf = audio - 48;
     myDFPlayer.play(buf); // para tocar audio  
    } 
  
   readString="";
  }
} // Fecha loop

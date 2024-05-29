#include "Arduino.h"
#include "SoftwareSerial.h"
#include "DFRobotDFPlayerMini.h"

DFRobotDFPlayerMini myDFPlayer;

char buf;
char audio = '4';  //numero do audio

void printDetail(uint8_t type, int value);

void setup()
{
  Serial.begin(115200);
  
  
  if (!myDFPlayer.begin(Serial)) {
    while(true);
  }

// Definicoes iniciais do modulo mp3
 myDFPlayer.setTimeOut(500);// Timeout serial 500ms
 myDFPlayer.volume(5);// Volume 25
 myDFPlayer.EQ(4);// Equalizacao class

 
 // PARA TOCAR ALGUM AUDIO *************************************
  
 char audio = '1';//  numero do audio
 buf = audio - 48;
 myDFPlayer.play(buf);//  para tocar audio
 
 // ************************************************************
 
  
}

void loop()
{
  static unsigned long timer = millis();
  
  if (millis() - timer > 3000) {
    timer = millis();
    //myDFPlayer.next(); // Play next mp3 every 3 second.
  }
   if (myDFPlayer.available()) {
    printDetail(myDFPlayer.readType(), myDFPlayer.read()); //Print the detail message from DFPlayer to handle different errors and states.
  }
}

void printDetail(uint8_t type, int value){
  switch (type) {
    case TimeOut:
      //Serial.println(F("Time Out!"));
      break;
    case WrongStack:
      //Serial.println(F("Stack Wrong!"));
      break;
    case DFPlayerCardInserted:
      //Serial.println(F("Card Inserted!"));
      break;
    case DFPlayerCardRemoved:
      //Serial.println(F("Card Removed!"));
      break;
    case DFPlayerCardOnline:
      //Serial.println(F("Card Online!"));
      break;
    case DFPlayerPlayFinished:
      //Serial.print(F("Number:"));
      //Serial.print(value);
      //Serial.println(F(" Play Finished!"));
      break;
    case DFPlayerError:
      //Serial.print(F("DFPlayerError:"));
      switch (value) {
        case Busy:
          //Serial.println(F("Card not found"));
          break;
        case Sleeping:
          //Serial.println(F("Sleeping"));
          break;
        case SerialWrongStack:
          //Serial.println(F("Get Wrong Stack"));
          break;
        case CheckSumNotMatch:
          //Serial.println(F("Check Sum Not Match"));
          break;
        case FileIndexOut:
          //Serial.println(F("File Index Out of Bound"));
          break;
        case FileMismatch:
          //Serial.println(F("Cannot Find File"));
          break;
        case Advertise:
          //Serial.println(F("In Advertise"));
          break;
        default:
          break;
      }
      break;
    default:
      break;
  }

}

void printDetail2(uint8_t type, int value){
  switch (type) {
    case TimeOut:
      //Serial.println(F("Time Out!"));
      break;
    case WrongStack:
      //Serial.println(F("Stack Wrong!"));
      break;
    case DFPlayerCardInserted:
      //Serial.println(F("Card Inserted!"));
      break;
    case DFPlayerCardRemoved:
      //Serial.println(F("Card Removed!"));
      break;
    case DFPlayerCardOnline:
      //Serial.println(F("Card Online!"));
      break;
    case DFPlayerPlayFinished:
      //Serial.print(F("Number:"));
      //Serial.print(value);
      //Serial.println(F(" Play Finished!"));
      break;
    case DFPlayerError:
      //Serial.print(F("DFPlayerError:"));
      switch (value) {
        case Busy:
          //Serial.println(F("Card not found"));
          break;
        case Sleeping:
          //Serial.println(F("Sleeping"));
          break;
        case SerialWrongStack:
          //Serial.println(F("Get Wrong Stack"));
          break;
        case CheckSumNotMatch:
          //Serial.println(F("Check Sum Not Match"));
          break;
        case FileIndexOut:
          //Serial.println(F("File Index Out of Bound"));
          break;
        case FileMismatch:
          //Serial.println(F("Cannot Find File"));
          break;
        case Advertise:
          //Serial.println(F("In Advertise"));
          break;
        default:
          break;
      }
      break;
    default:
      break;
  }

}

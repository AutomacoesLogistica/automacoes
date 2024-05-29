
#include <SPI.h>
#include "EthernetSupW5100.h"

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,1,177);
EthernetServer server(80);
int contador;
int contador1;
int contador2;
int contador5;
int a;
int Lampada = 5;
int portaPortaoG = a;
int portaPortaoP = 7;

void setup()
{
  EthernetSupW5100.begin(mac, ip);
  server.begin();
Serial.begin(9600);

 pinMode(A0,OUTPUT); // solenoide 1
 pinMode(A1,OUTPUT); // solenoide 2
 pinMode(A2,OUTPUT); // solenoide 3
 pinMode(A3,OUTPUT); // solenoide 4
 pinMode(A4,OUTPUT); // solenoide 5
 pinMode(A5,OUTPUT); // solenoide 6
 
 pinMode(2,INPUT); // sensor aberto
 pinMode(3,INPUT); // sensor fechado
 pinMode(8,OUTPUT); // tranca eletromagnetica
pinMode(9,INPUT);

 contador = 0;
 contador1 = 0;
 contador2 = 0;
 contador5 = 0;
  
  // Configurando portas dos botoes
  pinMode(Lampada, OUTPUT);
  pinMode(portaPortaoG, OUTPUT);
  pinMode(portaPortaoP, OUTPUT);
  
  // Estado incial das portas
  digitalWrite(Lampada, LOW);
  digitalWrite(portaPortaoP, LOW);
  digitalWrite(portaPortaoG, LOW);
  // Registrando botoes
  //EthernetSupW5100.addButton(button pin, text on, text off, button type);
  EthernetSupW5100.addButton(Lampada, "COMANDO LAMPADA", "", SWITCH_BUTTON);
  EthernetSupW5100.addButton(portaPortaoG, "PORTAO GRANDE", "", SWITCH_BUTTON);
  EthernetSupW5100.addButton(portaPortaoP, "PORTAO PEQUENO", "", SWITCH_BUTTON);
}



void loop()
{
  // Carrega HTML
  EthernetSupW5100.loadHtml(server);
  
  // Verifica se algum botao foi pressionado
  int lastButton = EthernetSupW5100.getLastClickedButton();
  byte state = EthernetSupW5100.getButtonState(lastButton);
  
  // Executa o comando conforme o botao clicado
  if (lastButton == Lampada)
  {
  contador1++;  
  }
  if (lastButton == portaPortaoG)
  {
  contador2++;
  }
  if (lastButton == portaPortaoP||digitalRead(9)!=0)
  {
  digitalWrite(portaPortaoP, HIGH);
  delay(500);
  digitalWrite(portaPortaoP, LOW);
  }
  
  // Delay
   delay(10);




Serial.println(contador);
// comando lampada
if(contador1==1)//liga lampada
  {
  digitalWrite(5,1);
  }
if(contador1==2) //desliga lampada
  {
  digitalWrite(5,0);contador1 = 0;
  }

//.......................................

//TRAVA ELETROMAGNETICA

if(contador==0&&digitalRead(3)==0)// se estiver fora dos programas e o sensor de fechado atuado, energiza sempre a tranca
{
digitalWrite(8,1);
digitalWrite(A4,1); // solenoide 5 alimenta
}

//.......................................


if(digitalRead(6)!=0){contador5++;}// se o controle abcd receber o sinal de A,incrementa 1

if(contador5==1)// comando A foi apertado e esta em 1
  {
  contador = 1; // vai para menu 1
  }

if (contador==0&&contador2==1&&digitalRead(3)==0)// se receber sinal pela internet do portao grande e o sinal do sensor fechado esteja em zero, ou seja, fechado completamente, vai para menu 1
  {
  contador = 1;
  }

//..............................................................................................................


if(contador==1) // comando para abrir
{
  
  digitalWrite(8,0);// desenergiza a tranca
  digitalWrite(A4,0); // solenoide 5 alimenta
  delay(1000);
  digitalWrite(A0,1); // solenoide 1 alimenta
  digitalWrite(A1,1); // solenoide 2    
  digitalWrite(A2,1); // solenoide 3
  digitalWrite(A3,1); // solenoide 4 dreno
  
  if (contador==1&&digitalRead(2)==0) // comando para desenergizar as solenoides quando o portao estiver aberto
  {
   contador = 2;
  }
} 

// assim que abrir desenergiza todas as solenoides
if (contador==2)
  {
  digitalWrite(A0,0); // solenoide 1 alimenta
  digitalWrite(A1,0); // solenoide 2    
  digitalWrite(A2,0); // solenoide 3
  digitalWrite(A3,0); // solenoide 4 dreno
  delay(1000);
  contador = 3;
  }
  
//.....................................................................................

// DETECTANDO COMANDO PARA FECHAR

if (contador==3)
{
  if(contador==3&&contador2==3||contador5==3) // se receber outro pulso do A ou via ethernet , dara o comando para fechar o portao
  {
  contador = 4;
  }
}


//.......................................................................................

if (contador==4) // comando para fechar
  {
  digitalWrite(A4,1); // solenoide 5 alimenta
  digitalWrite(A5,1); // solenoide 6 dreno   
  delay(4000); // faz o portao de batente esperar o outro para nao encavalar
  digitalWrite(A1,1); // solenoide 2
  digitalWrite(A2,1); // solenoide 3 
  contador = 5;
  }
    
if (contador==5)
{
  if(contador==5&&digitalRead(3)==0) // comando para desenergizar as solenoides quando o portao estiver fechado
  {
  digitalWrite(A1,0); // solenoide 2
  digitalWrite(A2,0); // solenoide 3 
  delay(500);
  digitalWrite(8,1); // energiza a tranca
  delay(2000);
  digitalWrite(A5,0); // solenoide 6 drena
  
  contador = 0;delay(100);contador2 = 0;delay(100);contador5 = 0;delay(250);
  }
}

}// fecha loop
















//Programa : Teste basico encoder Arduino
//Autor : Arduino e Cia

//Carrega a biblioteca do encoder
#include <RotaryEncoder.h>

#include <Wire.h>
#include <EEPROM.h>
#include <Servo.h> 
Servo myservo;
String readString;
int pos_servo = 90;
unsigned int posicao_persiana;
int pulsoMax = 8; 
int pulsoMin = 0; 
int abrir = 0;
int fechar = 0;
int aberto = 0;
int fechado = 0;
unsigned int valor;
unsigned int pos;
byte hiByte;
 byte loByte;

//                    DT, CLK                       
RotaryEncoder encoder(A3, A4);

unsigned int newPos = 0; // inicio do valor dos pulsos

void setup()
{
 pinMode(A0,OUTPUT);
 pinMode(A1,OUTPUT);
 pinMode(2,OUTPUT);
 digitalWrite(2,HIGH);
 digitalWrite(A0,LOW);
 digitalWrite(A1,HIGH);
 Serial.begin(9600);
 myservo.attach(9);
 pos_servo = 90; // Mantem parado
 myservo.write(pos_servo);
 digitalWrite(2,LOW);
 int hiByte1 = (EEPROM.read(6)* 255)+(EEPROM.read(6));
 int loByte1 = (EEPROM.read(7)); 
 valor = ((hiByte1)+(loByte1));
 posicao_persiana = valor;
 abrir = 0; 
 fechar = 0; 
 aberto =  EEPROM.read(4);
 fechado = EEPROM.read(5);



Serial.println(abrir);
Serial.println(fechar);
Serial.println(aberto);
Serial.println(fechado);
Serial.print(newPos);
Serial.print("  ,  ");
Serial.println(posicao_persiana);



/*
 newPos = 0;
 // Armazena na serial
 hiByte = highByte(newPos);
 loByte = lowByte(newPos);
 Serial.print("hiByte :  ");Serial.println(hiByte);
 Serial.print("loByte :  ");Serial.println(loByte);
 EEPROM.write(6,hiByte);
 EEPROM.write(7,loByte);
*/




 
}

void loop()
{
 digitalWrite(A0,LOW);
 digitalWrite(A1,HIGH);



 if (posicao_persiana != newPos) 
 {
  if(newPos<=pulsoMin){newPos = pulsoMin;posicao_persiana = pulsoMin;}
  if(newPos>=pulsoMax){newPos = pulsoMax;posicao_persiana = pulsoMax;}
  Serial.println(newPos);
  posicao_persiana = newPos;
  salvaPulso();
 }



 

 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }
 
 if (readString.length() >0) 
 {
  Serial.println(readString);
  
  
  if (readString == "r") 
  {
    setup();
  }

  if (readString == "i") 
  {
    Serial.println(abrir);
Serial.println(fechar);
Serial.println(aberto);
Serial.println(fechado);
Serial.print(newPos);
Serial.print("  ,  ");
Serial.println(posicao_persiana);
  }

  
  if (readString == "pulso_Max") 
  {
    pulsoMax = pulsoMax+1;
    posicao_persiana = pulsoMax;
    pos = pulsoMax;
    abrir = 1;aberto = 0;
    fechar = 0; fechado = 1;
  }
  if (readString == "pulso_Min") 
  {
   pulsoMin = pulsoMin-1;
   posicao_persiana = pulsoMin;
   pos = pulsoMin;
   abrir = 0 ;aberto = 1;
   fechar = 1; fechado = 0;
   
  }
  
  
  if ((readString == "Abrir"||readString == "a") && fechado == 1)     
  {
   abrir = 1;
   fechar = 0;
   Serial.println("Abrindo!");
  }
  if ((readString == "Fechar" || readString == "f")  && aberto == 1)     
  {
   abrir = 0;
   fechar = 1;
   Serial.println("Fechando!");
  }  
  readString="";
 } 


//**********************************************************************************************

 encoder.tick(); // chama void da biblioteca para contar o pulso
 newPos = encoder.getPosition();
 

 


if (abrir==1 && aberto == 0 && fechar == 0 && fechado == 1)
{
  pos_servo = 30; // Manda abrir
  myservo.write(pos_servo);
  digitalWrite(2,HIGH);
  
  
  
  if ( posicao_persiana>=pulsoMax)
  {
   Serial.println("Esta Aberto!");
   pos_servo = 90;
   abrir = 0;aberto = 1;
   fechar = 0; fechado = 0;
  }
}

if (abrir==0 && aberto == 1 && fechar == 0 && fechado == 0) // Está aberto
{
 pos_servo = 90; // Mantem parado
 myservo.write(pos_servo);
 digitalWrite(2,LOW);

}


if (abrir==0 && aberto == 1 && fechar == 1 && fechado == 0) // Comando para fechar
{
  pos_servo = 130; // Manda fechar
  digitalWrite(2,HIGH);
  myservo.write(pos_servo);
  
    
  if ( posicao_persiana<=pulsoMin)
  {
    Serial.println("Esta Fechado!");
   pos_servo = 90;
   abrir = 0;aberto = 0;
   fechar = 0; fechado = 1;
   }
}

if (abrir==0 && aberto == 0 && fechar == 0 && fechado == 1) // Está fechado
{
 pos_servo = 90; // Mantem parado
 myservo.write(pos_servo);
 digitalWrite(2,LOW);
 
}


} // Fecha loop

void salvaPulso()
{
 // Armazena na serial
 hiByte = highByte(posicao_persiana);
 loByte = lowByte(posicao_persiana);
 Serial.print("hiByte :  ");Serial.println(hiByte);
 Serial.print("loByte :  ");Serial.println(loByte);
 EEPROM.write(6,hiByte);
 EEPROM.write(7,loByte);

 EEPROM.write(2,abrir);
 EEPROM.write(3,fechar);
 EEPROM.write(4,aberto);
 EEPROM.write(5,fechado);
 
  
}


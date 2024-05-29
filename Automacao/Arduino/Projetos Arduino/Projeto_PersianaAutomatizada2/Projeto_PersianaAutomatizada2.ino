
#include <Wire.h>
#include <EEPROM.h>
#include <Encoder.h>
#include <Servo.h>

Servo myservo;
String readString;
int pos_servo = 90; // Ajustar com valor especifico de cada persiana
long int newPosition;
long int ValorMinimo = 0;
long int ValorMaximo = 215;
long int ValorCorrente;
long int oldPosition;
long int Valor;
String comando;
Encoder myEnc(2, 3);

void setup() 
{
 Serial.begin(9600);
 int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0));
 int loByte1 = EEPROM.read(1); 
 ValorCorrente = ((hiByte1)+(loByte1));
 oldPosition  = -999;
 pinMode(8,OUTPUT);
 myservo.attach(9);
 digitalWrite(8,LOW);
 myservo.write(pos_servo);
 
 


 
}



void loop() 
{
  
  newPosition = myEnc.read();

while (Serial.available()) 
{
 delay(3);  
 char c = Serial.read();
 readString += c; 
}

if (readString.length() >0) 
{
 //Serial.println(readString);
 if (readString == "r") 
 {
  setup(); 
 }
 if (readString == "a") 
 {
  abrir(); comando = "abrir";
  
 }
 if (readString == "f") 
 {
  fechar();comando = "fechar"; 
 }
 if (readString == "p") 
 {
  parar(); comando = "parar";
 }
 if (readString == "sf") 
 {
  Valor = ValorMinimo;
  Salva(); 
 }
 if (readString == "sa") 
 {
  Valor = ValorMaximo;
  Salva(); 
 }
 readString = "";
} 
 
  
 if (newPosition != oldPosition) 
 {
  oldPosition = newPosition;
  Valor = (ValorCorrente+newPosition);
  // SE ATINGIR O VALOR MINIMO PARA
  if ( Valor < ValorMinimo)
  {
      Valor = ValorMinimo;
      parar();  
  }
   // SE ATINGIR O VALOR MAXIMO PARA
  if (Valor >= ValorMaximo )
  {
    Valor = ValorMaximo;
    parar();
  }
  if (Valor > (ValorMaximo-30) && (Valor < ValorMaximo)&& comando == "abrir")
  {
    pos_servo = 76;
    myservo.write(pos_servo);
  }
  
  if (Valor > (ValorMinimo) && (Valor < ValorMinimo+30 )&&comando == "fechar")
  {
    pos_servo = 98;
    myservo.write(pos_servo);
  }
  
  
  
  

 
  Serial.println(Valor);
  Salva();
 }

 }



void Salva()
{

 // Armazena na EEPROM
 byte hiByte = highByte(Valor);
 byte loByte = lowByte(Valor);
 EEPROM.write(0,hiByte);
 EEPROM.write(1,loByte);
 
}

void abrir()
{
 pos_servo = 30; // Manda abrir
 digitalWrite(8,HIGH);
 myservo.write(pos_servo);
 Serial.println("Cmd_Abrir");
}

void fechar()
{
 pos_servo = 150; // Manda fechar
 digitalWrite(8,HIGH);
 myservo.write(pos_servo);
 Serial.println("Cmd_Fechar"); 
 
}

void parar()
{
digitalWrite(8,LOW); // Desliga alimentação do transistor retirando alimentação do servo
myservo.write(pos_servo);
Serial.println("Parado!");   
comando = "parar";
}


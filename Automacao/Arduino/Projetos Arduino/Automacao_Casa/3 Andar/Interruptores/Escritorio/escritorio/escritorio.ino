#define entrada_pulso_1 2
#define entrada_pulso_2 4
#define entrada_pulso_3 7
#define led 3
long incremento = 0;
String readString="";
/*
Conexão do modulo RS485    Recebe as mensagens dos interruptores e envia tambem para a central com mqtt atualizar supervisorio
   RO = Pino A1
   DI = Pino A2
   DE = Pino A0 Pino para ativar transmissao
   RE = Pino A0 Pino para ativar transmissao
*/

#include<SoftwareSerial.h>
#define transmitir A0 // Pino DE e RE - Transmissao
#define pinRX A1 // Pino RO
#define pinTX A2 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);


//MENSAGENS A SEREM ENVIADAS!
String Mensagem_1 = "escritorio1"; 
String Mensagem_especial_1 = "esp_escritorio1"; 

String Mensagem_2 = "escritorio2"; 
String Mensagem_especial_2 = "esp_escritorio2"; 

String Mensagem_3 = "escritorio3"; 
String Mensagem_especial_3 = "esp_escritorio3"; 



void setup() 
{
 pinMode(entrada_pulso_1,INPUT);
 pinMode(entrada_pulso_2,INPUT);
 pinMode(entrada_pulso_3,INPUT);
 pinMode(led,OUTPUT);
 
 Serial.begin(9600);
 RS485.begin(9600);
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);
}

void loop() 
{
  analogWrite(led,80);
 while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }
  
 // ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1
 // ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1
 // ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1    ATUANDO O PULSADOR 1
  
  if(digitalRead(entrada_pulso_1)==LOW && digitalRead(entrada_pulso_2)==HIGH && digitalRead(entrada_pulso_3)==HIGH )
  {
    delay(200);
    Serial.println("Entrou 1!");
    while(digitalRead(entrada_pulso_1)==LOW)
    {
      delay(500);incremento++;
      if(incremento>=10){break;}
    }
    if(incremento>=10)
    {
      Serial.println("Comando Especial 1");
      //ATUACAO SEGURANDO O BOTAO!****************************************
      digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
      RS485.print(Mensagem_especial_1);
      digitalWrite(transmitir, LOW);  
      //******************************************************************
      delay(1000);
    }
    else
    {
      Serial.println("Pressionado_1!");
      Serial.println(incremento);
     // ATUACAO COMUM
      digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
      RS485.print(Mensagem_1);
      digitalWrite(transmitir, LOW);  
     
    }
    incremento = 0;
  } // Fecha pulsador 1


 // ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2
 // ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2
 // ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2    ATUANDO O PULSADOR 2
  
  if(digitalRead(entrada_pulso_2)==LOW && digitalRead(entrada_pulso_1)==HIGH && digitalRead(entrada_pulso_3)==HIGH)
  {
   delay(200);
   Serial.println("Entrou 2 !");
   while(digitalRead(entrada_pulso_2)==LOW)
    {
      delay(500);incremento++;
      if(incremento>=10){break;}
    }
    if(incremento>=10)
    {
      Serial.println("Comando Especial 2!");
      //ATUACAO SEGURANDO O BOTAO!****************************************
       digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
       RS485.print(Mensagem_especial_2);
       digitalWrite(transmitir, LOW);  
      //******************************************************************
      delay(1000);
    }
    else
    {
      Serial.println("Pressionado_2!");
      Serial.println(incremento);
     // ATUACAO COMUM
      digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
      RS485.print(Mensagem_2);
      digitalWrite(transmitir, LOW);  
     
    }
    
  } // Fecha pulsador 2



   // ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3
 // ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3
 // ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3    ATUANDO O PULSADOR 3
  
  if(digitalRead(entrada_pulso_3)==LOW && digitalRead(entrada_pulso_1)==HIGH && digitalRead(entrada_pulso_2)==HIGH)
  { 
    delay(200);
    Serial.println("Entrou 3!");
    while(digitalRead(entrada_pulso_3)==LOW)
    {
      delay(500);incremento++;
      if(incremento>=10){break;}
    }
    if(incremento>=10)
    {
      Serial.println("Comando Especial 3");
      //ATUACAO SEGURANDO O BOTAO!****************************************
      digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
      RS485.print(Mensagem_especial_3);
      digitalWrite(transmitir, LOW);  
      //******************************************************************
      delay(1000);
    }
    else
    {
      Serial.println("Pressionado_3!");
      Serial.println(incremento);
     // ATUACAO COMUM
      digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
      RS485.print(Mensagem_3);
      digitalWrite(transmitir, LOW);  
     
    }
    
  } // Fecha pulsador 3




  
 // // Zera para todos!
 
  // put your main code here, to run repeatedly:
delay(100);
readString="";//Limpa os dados!
}

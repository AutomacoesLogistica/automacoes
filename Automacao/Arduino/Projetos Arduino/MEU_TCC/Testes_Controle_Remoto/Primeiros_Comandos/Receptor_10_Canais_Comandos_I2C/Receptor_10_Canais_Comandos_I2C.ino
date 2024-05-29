/* Projeto Receptor de 2.4 Ghz

   1 - GND
   2 - VCC 3.3V ............................Nao usar 5V, queima
   3 - CE no Arduino pino 9
   4 - CSN no Arduino pino 10
   5 - SCK no Arduino pino 13
   6 - MOSI no Arduino pino 11
   7 - MISO no Arduino pino 12
   8 - Nao usado
   
 - Produzido por: Bruno Gonçalves
 - Data: 05/06/2014
*/

// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#include "Wire.h"
#define slaveAdress 0x08 // Endereco modulo de luzes
#define Endereco_MPU 0x68 //pino aberto 0X68 , pino ligado em 3,3V 0x69  Endereco MPU
#include <Servo.h>

Servo Motor1;
Servo Motor2;
Servo Motor3;
Servo Motor4;

#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089

RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção


#define N 70 // Numero de amostas
float media; // Recebe a media
float valores[N]; // Array para armazenar os valores lidos
double soma; // Variavel para somar os valores 
float distanciaM = 0.0;
float Ultima_distanciaM = 0.0;


int SINAIS[11];  // Define um array de 2 , ou seja, recebera duas vezes as informações, sendo uma no array [1]e uma no array [2], que no caso A0 e A1
int mapSINAIS[11];
int estabilidade;
int vezes_estabilidade;
int modo;
int vezes_modo;
int luz;
int vezes_luz;
int ultimoValorLuz;
int ValorLuz;
int bloqueiaPWM;
int Acelerometro_Eixo_X;
int Acelerometro_Eixo_Y;
int Acelerometro_Eixo_Z;

int aileron;
int leme;
int profundor;

//Pino de controle do motor
int pino_motor1 = 3;
int pino_motor2 = 5;
int pino_motor3 = 6;
//int pino_motor4 = 11;


int vel_motor1 = 0;
int vel_motor2 = 0;
int vel_motor3 = 0;
int vel_motor4 = 0;

int comunicacao = 0;


void setup()
{
  Serial.begin(9600);
  radio.begin();
  Wire.begin(); // ingressa ao barramento I2C
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  Wire.beginTransmission(Endereco_MPU);  //Inicia transmissão para o endereço do Endereco_MPU
  Wire.write(0);
  Wire.endTransmission(true);
  modo = 0;
  vezes_modo = 0;
  luz = 0;
  vezes_luz = 0;
  estabilidade = 0;
  vezes_estabilidade = 0;
  aileron = 0;
  leme = 0;
  profundor = 0;
  ultimoValorLuz = 0;
  ValorLuz = 0;
  bloqueiaPWM = 0;
  Motor1.attach(pino_motor1);
}


void loop()
{
 if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  bool done = false;
  while (!done)
  {
   radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 2 , mesmo numero do array do int SINAIS
   
   mapSINAIS[0] = map(SINAIS[0],10,1023,10,1023); // Aileron
   mapSINAIS[1] = map(SINAIS[1],10,1023,10,1023); // Profundor
   mapSINAIS[2] = map(SINAIS[2],10,1023,10,1023); // Leme
   mapSINAIS[3] = map(SINAIS[3],10,1023,10,1023); // Acelerador - Invertido
   mapSINAIS[4] = map(SINAIS[4],10,1023,10,1023); // Luz - Invertido

  SINAIS[0] = mapSINAIS[0]; // Define que o array 0 sera o sinal da analogica A0
  SINAIS[1] = mapSINAIS[1]; // Define que o array 0 sera o sinal da analogica A1
  SINAIS[2] = mapSINAIS[2]; // Define que o array 0 sera o sinal da analogica A2
  SINAIS[3] = mapSINAIS[3]; // Define que o array 0 sera o sinal da analogica A3  
  SINAIS[4] = mapSINAIS[4]; // Define que o array 0 sera o sinal da analogica A4

  // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
  for(int i = N-1;i>0;i--){ valores[i] = valores[i-1]; }
  valores[0] = distanciaM; // Coloca o valor mais atual em valores[0]
  soma = 0.0;  // Limpa a variavel de soma
  for (int i=0;i<N;i++){ soma = soma+valores[i];}
  media = soma/N;
  distanciaM = media; 

  
// *************************************************************************************************************************************************************************************
//  CONTROLE DOS MOTORES


  
  // Acelerador
  if (SINAIS[3]!=0)
  {
    vel_motor1 = map(SINAIS[3], 10, 1023, 20, 179);
    if (vel_motor1>179){vel_motor1 = 179;}
    if (vel_motor1<0){vel_motor1 = 0;}
    vel_motor1 = (vel_motor1);
    vel_motor2 = (vel_motor1);
    vel_motor3 = (vel_motor1);
  //vel_motor4 = (vel_motor1);
  
  }





  // Mapeando aileron
  if (SINAIS[0]!=0)
  {
   aileron = map(SINAIS[0], 10, 1000, 0, 10);
   if (aileron>10){aileron = 5;}
   if (aileron<0){aileron = 5;}
   if (aileron>5)
   {
    vel_motor1 = (vel_motor1);
    vel_motor2 = (vel_motor2+(aileron-5));
    vel_motor3 = (vel_motor3+(aileron-5));
    //vel_motor4 = (vel_motor4);
   }
   if (aileron<5)
   {
    vel_motor1 = (vel_motor1+(5-aileron));
    vel_motor2 = (vel_motor2);
    vel_motor3 = (vel_motor3);
    //vel_motor4 = (vel_motor4(5-aileron));
   }
  }





 // Mapeando profundor
  if (SINAIS[1]!=0)
 {
  profundor = map(SINAIS[1], 10, 1000, 0, 10);
  if (profundor>10){profundor = 5;}
  if (profundor<0){profundor = 5;}
  
  if (profundor>5)
  {
   vel_motor1 = (vel_motor1);
   vel_motor2 = (vel_motor2);
   vel_motor3 = (vel_motor3+(profundor-5));
 //vel_motor4 = (vel_motor4+(profundor-5));
  }
  
  if (profundor<5)
  {
   vel_motor1 = (vel_motor1+(5-profundor));
   vel_motor2 = (vel_motor2+(5-profundor));
   vel_motor3 = (vel_motor3);
 //vel_motor4 = (vel_motor4);
  }
 }

 
// Mapeando leme
  if (SINAIS[2]!=0)
 {
  leme = map(SINAIS[2], 10, 1000, 0, 10);
  if (leme>10){leme = 5;}
  if (leme<0){leme = 5;}
  
  if (leme>5)
  {
   vel_motor1 = (vel_motor1-(leme-5));
   vel_motor2 = (vel_motor2+(leme-5));
   vel_motor3 = (vel_motor3-(leme-5));
 //vel_motor4 = (vel_motor4+(leme-5));
  }
  
  if (leme<5)
  {
   vel_motor1 = (vel_motor1+(5-leme));
   vel_motor2 = (vel_motor2-(5-leme));
   vel_motor3 = (vel_motor3+(5-leme));
 //vel_motor4 = (vel_motor4-(5-leme));
  }
 }


// *************************************************************************************************************************************************************************************
 // MODULO DE ESTABILIDADE ATIVO 
 
  if ( profundor == 5 && aileron==5 && leme==5 && estabilidade == 1 && Ultima_distanciaM != 0.0 )
  {
   Wire.beginTransmission(Endereco_MPU);
   Wire.write(0x3B);        
   Wire.endTransmission(false);
   Wire.requestFrom(Endereco_MPU, 14, true); //requisita bytes
   Acelerometro_Eixo_X = Wire.read() << 8 | Wire.read();
   Acelerometro_Eixo_Y = Wire.read() << 8 | Wire.read();
   Acelerometro_Eixo_Z = Wire.read() << 8 | Wire.read();
   Acelerometro_Eixo_X = map(Acelerometro_Eixo_X, -16300, 16300, 0, 10);
   Acelerometro_Eixo_Y = map(Acelerometro_Eixo_Y, -16300, 16300, 0, 10);
   Acelerometro_Eixo_Z = map(Acelerometro_Eixo_Z, -16300, 16300, 0, 10);

   // Drone caindo para frente
   if (  Acelerometro_Eixo_X < 5 ) 
   {
    vel_motor1 = (vel_motor1+(5-Acelerometro_Eixo_X));
    vel_motor2 = (vel_motor2+(5-Acelerometro_Eixo_X));
    vel_motor3 = (vel_motor3-(5-Acelerometro_Eixo_X)); //  ????????
    vel_motor4 = (vel_motor4-(5-Acelerometro_Eixo_X)); //  ????????
   }
   // Drone caindo para tras
   if (  Acelerometro_Eixo_X > 5 ) 
   {
    vel_motor1 = (vel_motor1-(Acelerometro_Eixo_X-5));
    vel_motor2 = (vel_motor2-(Acelerometro_Eixo_X-5));
    vel_motor3 = (vel_motor3+(Acelerometro_Eixo_X-5)); //  ????????
    vel_motor4 = (vel_motor4+(Acelerometro_Eixo_X-5)); //  ????????
   }

    // Drone caindo para a esquerda
   if (  Acelerometro_Eixo_Y < 5 ) 
   {
    vel_motor1 = (vel_motor1-(5-Acelerometro_Eixo_Y)); //  ????????
    vel_motor2 = (vel_motor2+(5-Acelerometro_Eixo_Y));
    vel_motor3 = (vel_motor3+(5-Acelerometro_Eixo_Y));
    vel_motor4 = (vel_motor4-(5-Acelerometro_Eixo_Y)); //  ????????
   }
   // Drone caindo para a direita
   if (  Acelerometro_Eixo_Y > 5 ) 
   {
    vel_motor1 = (vel_motor1+(Acelerometro_Eixo_Y-5));
    vel_motor2 = (vel_motor2-(Acelerometro_Eixo_Y-5)); //  ????????
    vel_motor3 = (vel_motor3-(Acelerometro_Eixo_Y-5)); //  ????????
    vel_motor4 = (vel_motor4+(Acelerometro_Eixo_Y-5)); 
   }


     // Drone caindo para baixo
   if (  distanciaM < Ultima_distanciaM ) 
   {
    vel_motor1 = vel_motor1++;
    vel_motor2 = vel_motor2++;
    vel_motor3 = vel_motor3++;
    vel_motor4 = vel_motor4++;
   }
   
   // Drone sobindo
   if (  distanciaM > Ultima_distanciaM  ) 
   {
    vel_motor1 = vel_motor1--;
    vel_motor2 = vel_motor2--;
    vel_motor3 = vel_motor3--;
    vel_motor4 = vel_motor4--;
   }
   
  
  }
  else
  {
   // Atuailza velocidade dos motores
   Motor1.write(vel_motor1);
   Motor2.write(vel_motor2);
   Motor3.write(vel_motor3);
   //Motor4.write(vel_motor4);

  Serial.println(vel_motor1);
  }

 
// *************************************************************************************************************************************************************************************
// CONTROLE DE ILUMINACAO












 
// *************************************************************************************************************************************************************************************
// CONTROLE DE ESTABILIDADE

   if (SINAIS[5] == 1000 && vezes_estabilidade<20 && estabilidade==0 ){ vezes_estabilidade++; }
   if (SINAIS[5] == 500 && estabilidade==1){ vezes_estabilidade++; }
   if (SINAIS[5] == 1000 && estabilidade==1){ vezes_estabilidade = 1; }

   if (SINAIS[5] == 1000 && estabilidade==0 && vezes_estabilidade == 10) 
   {
    estabilidade = 1;
    Ultima_distanciaM = distanciaM;
   
   }
   
   if (SINAIS[5] == 500 && estabilidade==1 && vezes_estabilidade == 50) 
   {
    estabilidade = 0;
    vezes_estabilidade = 0;
   Ultima_distanciaM = 0.0;
   }
  


// *************************************************************************************************************************************************************************************
  // TIPO ILUMINACAO
   
   if (SINAIS[7] == 1000 && vezes_modo<20 && modo==0 ){ vezes_modo++; }
   if (SINAIS[7] == 500 && modo==1){ vezes_modo++; }
   if (SINAIS[7] == 1000 && modo==1){ vezes_modo = 1; }
   
   
   if (SINAIS[7] == 1000 && modo==0 && vezes_modo == 5) 
   {
    
    modo = 1;
    Wire.beginTransmission(slaveAdress);
    Wire.write("modo");
    Wire.write("");
    Wire.endTransmission(); // encerra a transmissao 
   }
   
   
   
   if (SINAIS[7] == 500 && modo==1 && vezes_modo == 50) 
   {
    modo = 0;
    vezes_modo = 0;
   }
  // *****************************************************************************************************************************************************************************
  
   //  MODO ILUMINAÇÃO
   if (SINAIS[8] == 1000 && vezes_luz<20 && luz==0 ){ vezes_luz++; }
   if (SINAIS[8] == 500 && luz==1){ vezes_luz++; }
   if (SINAIS[8] == 1000 && luz==1){ vezes_luz = 1; }
  

   if (SINAIS[8] == 1000 && luz==0 && vezes_luz == 5) 
   {
    luz = 1;
    Wire.beginTransmission(slaveAdress);
    Wire.write("luz_on"); 
    Wire.endTransmission(); // encerra a transmissao 
   }
  
   if (SINAIS[8]==500 && luz==1 && vezes_luz == 20) 
   {
    luz = 0;
    vezes_luz = 0;
    Wire.beginTransmission(slaveAdress);
    Wire.write("luz_off"); 
    Wire.endTransmission(); // encerra a transmissao     
   }
   // *****************************************************************************************************************************************************************************

   //  DESLIGAR MODO ILUMINAÇÃO
   if (SINAIS[9] == 1000 && vezes_modo<20 && modo==0 ){ vezes_modo++; }
   if (SINAIS[9] == 500 && modo==1){ vezes_modo++; }
   if (SINAIS[9] == 1000 && modo==1){ vezes_modo = 1; }
  

   if (SINAIS[9] == 1000 && modo==0 && vezes_modo == 5) 
   {
    modo = 1;
    Wire.beginTransmission(slaveAdress);
    Wire.write("modo_0"); 
    Wire.endTransmission(); // encerra a transmissao 
   }
  
   if (SINAIS[9]==500 && modo==1 && vezes_modo == 70) 
   {
    modo = 0;
    vezes_modo = 0;
    }
   // *****************************************************************************************************************************************************************************







  }

  if ( comunicacao == 1 )
  {
    comunicacao = 0;
   for (int x = 0; x<6;x++)
   {
    Wire.beginTransmission(slaveAdress);
    Wire.write("radio_on"); 
    Wire.endTransmission(); // encerra a transmissao
   }
   for (int x = 0; x<4;x++)
   {
    Wire.beginTransmission(slaveAdress);
    Wire.write("modo_0"); 
    Wire.endTransmission(); // encerra a transmissao
    
   }
  }

 }
 
 else
 {    
   vel_motor1 = 0;
   vel_motor2 = 0;
   vel_motor3 = 0;
   vel_motor4 = 0;
   Motor1.write(vel_motor1);
   Motor2.write(vel_motor2);
   Motor3.write(vel_motor3);
 //Motor4.write(vel_motor4);


  if ( comunicacao == 0 )
  {
   comunicacao = 1;
   for (int x = 0; x<6;x++)
   {
    Wire.beginTransmission(slaveAdress);
    Wire.write("radio_off"); 
    Wire.endTransmission(); // encerra a transmissao
    
   }
   
  }
  
 }

}

/* Projeto Receptor de 2.4 Ghz

   1 - GND
   2 - VCC 3.3V ............................Nao usar 5V, queima
   3 - CE to Arduino pin 7
   4 - CSN to Arduino pin 8
   5 - SCK to Arduino pin 13
   6 - MOSI to Arduino pin 11
   7 - MISO to Arduino pin 12
   8 - UNUSED
   
 - Produzido por: Bruno Gonçalves
 - Data: 05/06/2014
*/

// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   7
#define CSN_PIN 8

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089

RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

int SINAIS[6];  // Define um array de 6 


int val_3 = 0;
int val_5 = 0;
int val_6 = 0;
int val_9 = 0;
int val_10 = 0;

int pwmPin_3 = 3;
int pwmPin_5 = 5;
int pwmPin_6 = 6;
int pwmPin_9 = 9;
int pwmPin_10 = 10;

int sensor_3;
int sensor_5;
int sensor_6;
int sensor_9;
int sensor_10;




void setup()
{
  Serial.begin(9600);
  delay(1000);
  Serial.println("Nrf24L01 Receptor ativo");
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;


pinMode(pwmPin_3, OUTPUT);
pinMode(pwmPin_5, OUTPUT);
pinMode(pwmPin_6, OUTPUT);
pinMode(pwmPin_9, OUTPUT);
pinMode(pwmPin_10, OUTPUT);

}


void loop()
{
  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {

    bool done = false;
    while (!done)
    {

      done = radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 2 , mesmo numero do array do int joystick
      
      // IMPRIME O VALOR DA ROTACAO ...............................

      Serial.print(" ROTACAO :  ");
      int RPM = SINAIS[0]*1.75953079; // BASEANDO EM 1800 RPM
      Serial.print(RPM);// Imprime o valor do A0
      Serial.println(" RPM");
      
      val_3 = (SINAIS[0]);
      sensor_3 = map(val_3, 0, 1023, 51, 255);
      analogWrite(pwmPin_3, sensor_3);  // analogRead values go from 0 to 1023, analogWrite values from 0 to 255
      
      

      

      


       // IMPRIME O VALOR DA CORRENTE ...............................

      Serial.print(" CORRENTE :  ");
      int A = SINAIS[1]*0.0342131; // BASEADO EM 35 AMPERES
      Serial.print(A);// Imprime o valor do A1
      Serial.println(" A");

      val_5 = (SINAIS[1]);
      sensor_5 = map(val_5, 0, 1023, 51, 255);
      analogWrite(pwmPin_5, sensor_5);  // analogRead values go from 0 to 1023, analogWrite values from 0 to 255
      





       // IMPRIME O VALOR DO TORQUE ...............................

      Serial.print(" TORQUE :  ");
      int T = SINAIS[2]*0.97751711; // BASEADO EM 1000 KGF
      Serial.print(T);// Imprime o valor do A2
      Serial.println(" Kgf");

      val_6 = (SINAIS[2]);
      sensor_6 = map(val_6, 0, 1023, 51, 255);
      analogWrite(pwmPin_6, sensor_6);  // analogRead values go from 0 to 1023, analogWrite values from 0 to 255
            






      // IMPRIME O VALOR DO PHMETRO ...............................

      Serial.print(" PHMETRO :  ");
      int P = ((SINAIS[3]*0.00488759)+7); // BASEADO DE 4 A 12 , FEITO 12-7=5 E 5/1023= CONSTANTE + 7 QUE É MENOR VALOR
      Serial.print(P);// Imprime o valor do A3
      Serial.println(" PH");
      
      val_9 = (SINAIS[3]);
      sensor_9 = map(val_9, 0, 1023, 51, 255);
      analogWrite(pwmPin_9, sensor_9);  // analogRead values go from 0 to 1023, analogWrite values from 0 to 255
      
      
      
      




      // IMPRIME O VALOR DO RESERVA1 ...............................

      Serial.print(" RESERVA 1 :  ");
      int R1 = SINAIS[4];
      Serial.print(R1);// Imprime o valor do A4
      Serial.println(" RESERVA 1 ");

      val_10 = (SINAIS[4]);
      sensor_10 = map(val_10, 0, 1023, 51, 255);
      analogWrite(pwmPin_10, sensor_10);  // analogRead values go from 0 to 1023, analogWrite values from 0 to 255

      






            // IMPRIME O VALOR DA ROTACAO ...............................

      Serial.print(" RESERVA 2 :  ");
      int R2 = SINAIS[5];
      Serial.print(R2);// Imprime o valor do A5
      Serial.println(" RESERVA 2");

    }
  }
  else
  {    
  // Nao faz nada e fica parado esperando chegar sinal
  }

}

/* Projeto Receptor de 2.4 Ghz _ envio de 2 canais com UNO

   1 - GND
   2 - VCC 3.3V                 NAO USAR 5V POIS QUEIMA
   3 - CE to Arduino pino 9
   4 - CSN to Arduino pino 10
   5 - SCK to Arduino pino 13
   6 - MOSI to Arduino pino 11
   7 - MISO to Arduino pino 12
   8 - Nao usado
   - 
   
 - Produzido por: Bruno Gonçalves
 - Data: 05/06/2014
*/

// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089

RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

int SINAIS[2];  // Define um array de 6 

// 
int phmetro = 0;
int turbidimetro = 0;

// 
int pwmPin_3 = 3;
int pwmPin_5 = 5;

//
int saida_PWM_3;
int saida_PWM_5;


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
pinMode(8,OUTPUT);
digitalWrite(8,0);
}


void loop()
{
  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {

    bool done = false;
    while (!done)
    {
      digitalWrite(8,1);
      done = radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 2 , mesmo numero do array do int SINAIS
      
      // IMPRIME O VALOR DO PHMETRO
      Serial.print(" PHMETRO :  ");
      int PH = SINAIS[0];
      Serial.print(PH);// Imprime o valor do A0
      Serial.println(" PH");
      
      // Força uma saida PWM assumir o valor transmitido pelo radio
      phmetro = (SINAIS[0]);
      saida_PWM_3 = map(phmetro, 0, 1023, 51, 255); // DEFINIDO SER 51 ( da 1V de saida e 4mA) e 255 ( da 5V de saida e 20mA )
      analogWrite(pwmPin_3, saida_PWM_3);  // le o valor recebido ( 0 a 1023 ) e envia proprocional de 0 a 5 ( 0 a 255 )

      
      // ***************************************************************************************************************************************************************************

      // IMPRIME O VALOR DA TURBIDEZ
      Serial.print(" TURBIDEZ :  ");
      int TURBIDEZ = SINAIS[1];
      Serial.print(TURBIDEZ);// Imprime o valor do A1
      Serial.println(" TB");
      // Força uma saida PWM assumir o valor transmitido pelo radio
      turbidimetro = (SINAIS[1]);
      saida_PWM_5 = map(turbidimetro, 0, 1023, 51, 255); // DEFINIDO SER 51 ( da 1V de saida e 4mA) e 255 ( da 5V de saida e 20mA )
      analogWrite(pwmPin_5, saida_PWM_5);  // le o valor recebido ( 0 a 1023 ) e envia proprocional de 0 a 5 ( 0 a 255 )
      

    }
  }
 
  else
  {    
  digitalWrite(8,0); // Apaga o led indicando que não ouve comunicação
  }

}

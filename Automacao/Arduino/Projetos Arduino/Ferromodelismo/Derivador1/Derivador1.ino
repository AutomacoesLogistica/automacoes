/*
 * 
 * Servo 1 ferromodelismo pai
 * 
 * Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V ................Nao usar 5v , queima
   3 - CE to Arduino pin A0 //9
   4 - CSN to Arduino pin 10
   5 - SCK to Arduino pin 13
   6 - MOSI to Arduino pin 11
   7 - MISO to Arduino pin 12
   8 - UNUSED
 * 
 */

// Carrega as Bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#include <Servo.h>//Inclusão da biblioteca Servo
Servo servomotor;//Criando objeto do tipo Servo
int pos_reto = 82;//Variável que armazena a posição do servo
int pos_derivado = 120;//Variável que armazena a posição do servo
int x = 82;

String posicao = "Reto";

#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida

RF24 radio(CE_PIN, CSN_PIN); // Crea o Radio e ativa a transissão do sinal

// Array de 10 elementos
/*
 * SINAIS[0] = velocidade  
 * SINAIS[1] = setido  
 * SINAIS[2] = maquina ligada ou nao
 * SINAIS[3] = luz cabine
 * SINAIS[4] = luz chassi
 * SINAIS[5] = buzina
 * SINAIS[6] = sino
 * SINAIS[7] = maquina selecionada
 * SINAIS[8] = deviracao1
 * SINAIS[9] = derivacao2
 */

int SINAIS[10];
  
#define servo 3 // Servo
#define led_reto 4 // Led indicando que esta na posicao reto
#define led_derivado 5 // Led indicando que esta na posicao derivado

void setup() 
{
 pinMode(servo,OUTPUT);
 pinMode(led_reto,OUTPUT);
 digitalWrite(led_reto,LOW); //Inicia apagado
 pinMode(led_derivado,OUTPUT);
 digitalWrite(led_derivado,LOW); //Inicia apagado

 //inicia na posicao reto
 digitalWrite(led_reto,HIGH);
 digitalWrite(led_derivado, LOW);
 digitalWrite(led_reto,HIGH);
 digitalWrite(led_derivado, LOW);
 servomotor.attach(3);//Atribui o pino digital 3 ao objeto servomotor
 for(int a=0;a<3;a++)
 { 
  x = pos_reto;//55; 
  pinMode(3,OUTPUT);
  delay(100);
  servomotor.attach(3);//Atribui o pino digital 3 ao objeto servomotor
  servomotor.write(x);
  Serial.println(x);    
  pinMode(3,INPUT);
  delay(500);
 }
 posicao = "Reto";
 Serial.begin(9600);
 Serial.println("Iniciado!");
 radio.begin();
 radio.openReadingPipe(1,pipe);
 radio.startListening();;




}

void loop() 
{
 //Serial.println("Rodando");
 if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  bool done = false;
  while (!done)
  {
   //S/erial.println("Lido"); 
   done = radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 3
   int v_posicao = (SINAIS[8]); // status desse derivador
   
   if(v_posicao == 200 && posicao== "Reto" ) // Sentido derivado
   {
    //Posicao derivado
    posicao = "Derivado";
    digitalWrite(led_reto,LOW);
    digitalWrite(led_derivado, HIGH);
    for(int a=0;a<3;a++)
    { 
     x = pos_derivado; //92; 
     pinMode(3,OUTPUT);
     delay(100);
     servomotor.attach(3);//Atribui o pino digital 3 ao objeto servomotor
     servomotor.write(x);
     Serial.println(x); 
     pinMode(3,INPUT);   
     delay(200);
    }
   }
   else if(v_posicao == 100 && posicao == "Derivado")
   {
    posicao = "Reto"; 
    digitalWrite(led_reto,HIGH);
    digitalWrite(led_derivado, LOW);
    for(int a=0;a<3;a++)
    { 
     x = pos_reto;//55; 
     pinMode(3,OUTPUT);
     delay(100);
     servomotor.attach(3);//Atribui o pino digital 3 ao objeto servomotor
     servomotor.write(x);
     Serial.println(x);    
     pinMode(3,INPUT);
     delay(200);
    }
   
   
   
   }
  }// Fecha while(!done)
 } // Fecha if ( radio.available() )
} // Fecha LOOP

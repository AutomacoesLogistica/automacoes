/* Conexos do Modulo de 2.4Ghz
      
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
 - Data : 20/02/15
*/



//Importa as livrarias

#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

// Variaveis e Pinos
#define CE_PIN   9
#define CSN_PIN 10


const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida


RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal

int SINAIS[20];  // Numero de canais
int Pulso;
int Vezes;
int canal;
String Ncanal;
  int x;
int funcao;

String readString;

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
  radio.openReadingPipe(1,pipe);
  radio.startListening();;

  pinMode(2,INPUT);
  pinMode(3,OUTPUT);
  
  Vezes=0;  
  canal=0;
 x=0; 
funcao=0;
}



void loop()  
{
// CODIGO FEITO PARA COM O AUXILIO DO SOFTWARE SABER QUAL A ID DE COMUNICACAO E O PACOTE USADO  
while (Serial.available()) 
{
 delay(3);  
 char c = Serial.read();
 readString += c; 
}
            
if (readString.length() >0) 
{
 if (readString == "comunicacao")     
 {
     Serial.println("AUTOMACAO_TRANSMISSOR_interruptor_pulso");
     Serial.println("");
     Serial.println(" ID para comunicacao = 0xE8E8F0F0E1LL");
     Serial.println(" Canal usado =  0 ");
     Serial.println(" Numero de canais =  20 ");
     Serial.println(" Pino de entrada usado = pino 2 e resistor 10k para GND");
 }
   
 if (readString == "canal+")     
 {
    Serial.print("Novo Canal = ");
    x=(x+1);
    Serial.println(x); 
 }
   
 if (readString == "canal-")     
 {
    x=(x-1);
    Serial.print("Novo Canal = ");
    Serial.println(x); 
 }
   
 if (readString == "canal")     
 {
    x=(0);
    Serial.print("Novo Canal = ");
    Serial.println(x); 
 }
 readString=""; // LIMPA A VARIAVEL
} 
//************************************************************************************************************************************ 

// MAPEIA O INTERRUPTOR EM SUA ALTERAÇÃO DE STATUS
if(digitalRead(2)==1&&Vezes<=2) // 
{
  Vezes=3;
  funcao=1;
}
  
if(digitalRead(2)==0&&Vezes>=3&&Vezes<=5) // 
{
  Vezes = 0;
  funcao=1;
}
//************************************************************************************************************************************ 

// INICIA A PARTE DO RADIO DE 2.4gHZ
if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
{
  radio.read( SINAIS, sizeof(SINAIS) );
  if(SINAIS[0]==750)
  {
     funcao=1;
  }
}
 
//************************************************************************************************************************************ 
  
// ATUALIZA A SAIDA, FISICA POR CABO OU MESMO VIA FREQUENCIA  
if(funcao==1)
{
  if(digitalRead(3)==0&&funcao==1)
  {
    digitalWrite(3,1);
    SINAIS[0] = 750;
    radio.write(SINAIS,sizeof(0));
    funcao=0;
  }
  if(digitalRead(3)==1&&funcao==1)
  {
    digitalWrite(3,0);
    SINAIS[0] = 750;
    radio.write(SINAIS,sizeof(0));
    funcao=0;   
  }
  delay(250); 
}   // fecha funcao 1 


  
} // FECHA LOOP



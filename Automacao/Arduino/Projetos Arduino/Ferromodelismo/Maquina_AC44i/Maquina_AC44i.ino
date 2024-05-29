/*
 * 
 * Maquina AC44i 2.4 para ferromodelismo pai
 * 
 * Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V ................Nao usar 5v , queima
   3 - CE to Arduino pin 9
   4 - CSN to Arduino pin 10
   5 - SCK to Arduino pin 13
   6 - MOSI to Arduino pin 11
   7 - MISO to Arduino pin 12
   8 - UNUSED
 * 
 */

/*
 * AUDIOS **************************************
 
 * 1 - Ligando
 * 2 - Ligada
 * 3 - Desligando
 * 4 - Buzina
 * 5 - Sino
 */


 
// Carrega as Bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#include "Arduino.h"
#include "SoftwareSerial.h"
#include "DFRobotDFPlayerMini.h"
#include <Servo.h>
Servo motor1;
Servo motor2;

//Inicia a serial por software nos pinos 7 e A0
SoftwareSerial mySoftwareSerial(7, A0); // RX, TX // para audios constantes ( Ligando, ligado e desligado )
//SoftwareSerial mySoftwareSerial2(8, A2); // RX, TX > Para sirene e buzina

DFRobotDFPlayerMini myDFPlayer;
DFRobotDFPlayerMini myDFPlayer2;

#define CE_PIN   9
#define CSN_PIN 10

int xx = 0;
boolean ativa_audio = false;
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 2000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;


const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida

char buf;
char audio = '4'; // numero do audio

int direcao = 0;
int velocidade = 0;

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
  

#define reles 2 // Reles para mudar a direcao
#define led_cabine 3 // Iluminacao da cabine
#define led_chassi 4 // Iluminacao do chassi
int maquina_ligada = 0; //Recebe se a maquina esta ligada ou nao
int valor_velocidade = 0; //Recebe o valor da velocidade


int vezes_maquina_ligada = 0; // para saber quando toca o audio de ligar ou nao
String maquina_selecionada = "";

void setup() 
{
 Serial.begin(9600);
   
 motor1.attach(5); //Specify the esc signal pin,Here as D8
 motor2.attach(6); //Specify the esc signal pin,Here as D8
 motor1.writeMicroseconds(1000); //initialize the signal to 1000
 motor2.writeMicroseconds(1000); //initialize the signal to 1000
 //////delay(5000);
 pinMode(reles,OUTPUT);
 digitalWrite(reles,LOW); //Inicia desligado com sentido para frente
 pinMode(led_cabine,OUTPUT);
 digitalWrite(led_cabine,LOW); //Inicia apagado
 pinMode(led_chassi,OUTPUT);
 digitalWrite(led_chassi,LOW); //Inicia apagado
 //Comunicacao serial com o modulo mp3
 mySoftwareSerial.begin(9600);
 //Serial.println();
  //Serial.println(F("DFPlayer iniciado!"));


 
 if (!myDFPlayer.begin(mySoftwareSerial)) // Inicia o modulo MP3
 {
  
    //Serial.println(F("Falha:"));
    //Serial.println(F("1.conexões!"));
    //Serial.println(F("2.cheque o cartão SD1!"));
    

 }
 Serial.print("Numero de arquivos no cartao SD 1 : ");
  //Serial.println(myDFPlayer.readFileCounts(DFPLAYER_DEVICE_SD));
 //Definicoes iniciais do modulo mp3
 
 myDFPlayer.setTimeOut(500); //Timeout serial 500ms
 myDFPlayer.volume(27); //Volume 27
 myDFPlayer.EQ(4); //Equalizacao class
 
 // PARA TOCAR ALGUM AUDIO *************************************
  
  char audio = '6'; // numero do audio beep
  buf = audio - 48;
  myDFPlayer.play(buf); // para tocar audio
 
 // ************************************************************
 //Serial.println("Modulo 1 iniciado com sucesso!");
 delay(1000);
 Serial.println("audio7"); //Testar o beep no outro modulo!
 delay(1000);
 Serial.println("Iniciado!");
 radio.begin();
 radio.openReadingPipe(1,pipe);
 radio.startListening();
}

void loop() 
{
 if(xx = 0)
 {
  //Serial.println("Em loop!");
  xx = 1;
 }
  AtualMillis = millis();    //Tempo atual em ms
  if(ativa_audio == true)
  {
    if (AtualMillis - UltimoMillis > intervalo) 
    { 
     UltimoMillis = AtualMillis;    // Salva o tempo atual
     ativa_audio = false;
     }
  }
  else
  {
     UltimoMillis = AtualMillis;    // Salva o tempo atual
  }
    
   
  ////Serial.println("Rodando");
 if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  bool done = false;
  while (!done)
  {
   //S/erial.println("Lido"); 
   done = radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 3
   //Serial.print("SINAIS[0] = ");//Serial.println(SINAIS[0]);
      // BUZINA *********************************************************************
    int v_buzina = (SINAIS[5]); // buzina
    if(v_buzina == 200 && ativa_audio == false)
    {
     //Chama o audio da buzina
     //Serial.println("Buzinou!");
     Serial.println("audio4");//Para o outro modulo tocar o som da buzina!
     
     ativa_audio = true;
     vaudio(); // Entra para tocar o audio
    }
   
    // ACIONAMENTO SINO **********************************************************
    int v_sino = (SINAIS[6]); //sino
    if(v_sino == 200 && ativa_audio == false)
    {
      //Serial.println("Tocou sino!");
     Serial.println("audio5"); //Para o segundo modulo tocar o audio de sino
     ativa_audio = true;
     vaudio(); // Entra para tocar o audio
     //Agora verifico se a maquina estava ligada ou nao, caso sim, toco o audio 1 que é barulho dela ligada
    }

   int v_maquina = (SINAIS[7]); // maquina selecionada
   v_maquina = v_maquina -100;
   if( v_maquina == 0)
   {
    maquina_selecionada = "SD40";
   }
   else if(v_maquina == 1)
   {
    maquina_selecionada = "AC44i"; 
   }
   else
   {
    maquina_selecionada = "Ambas";
   }

   if(maquina_selecionada == "AC44i" || maquina_selecionada == "Ambas")
   {
    //Somente faz algo caso chege na frequencia que é para operar essa maquina ou ambas
    valor_velocidade = (SINAIS[0]);// Imprime o valor da velocidade
    velocidade = map(valor_velocidade,0,1023,1000,2000); // OBS: nao reduzir mais do que 128, pq senao o esc nao ativa
    //Serial.print("Velocidade = ");//Serial.println(velocidade);

    //DIRECAO *****************************************************************
    direcao = (SINAIS[1]); //sentido 
      ////Serial.println(direcao);
    if(direcao == 100 ) //Sentido para frente e reles desligados
    {
     //Sentido frente
     
     digitalWrite(reles,LOW);
    }
    else if(direcao == 200)
    {
     //Sentido ré
     digitalWrite(reles,HIGH);
    }

    //MAQUINA LIGADA ***********************************************************
    maquina_ligada = (SINAIS[2]); // maquina ligada ou nao
    
    ////Serial.println(maquina_ligada);
    
    if(maquina_ligada == 200 && vezes_maquina_ligada == 0)
    {
      //Maquina estava desligada e acabou de ligar!
      vezes_maquina_ligada = 1;
      //Chamo o audio de ligando a maquina
      char audio = '1'; // numero do audio de maquina ligadando
      buf = audio - 48;
      myDFPlayer.play(buf);
      ativa_audio = true;
      vaudio(); // Entra para tocar o audio
     }
      
      
    
    if(maquina_ligada == 100 && vezes_maquina_ligada == 1)
    {
      //Maquina estava ligada e acabou de desligar
      vezes_maquina_ligada = 0;
      //Chamo o audio de desligando a maquina
      char audio = '3'; // numero do audio de maquina desligando
      buf = audio - 48;
      myDFPlayer.play(buf);
      ativa_audio = true;
      vaudio(); // Entra para tocar o audio
     }
      //////delay(2000); //Nao retirar esse //////delay
      
    
    ////Serial.println(maquina_ligada);
    
    // ILUMINACAO DA CABINE ****************************************************
    int v_luz = (SINAIS[3]); // luz cabine
    //Serial.println(SINAIS[3]);
    if(v_luz == 100)
    {
     digitalWrite(led_cabine,LOW);
    }
    else if(v_luz == 200)
    {
     digitalWrite(led_cabine,HIGH);
    }
    
    // ILUMINACAO DO CHASSI *****************************************************
    int v_luz2 = (SINAIS[4]); // luz chassi
    if(v_luz2 == 100)
    {
     digitalWrite(led_chassi,LOW);
    }
    else if(v_luz2 == 200)
    {
     digitalWrite(led_chassi,HIGH);
    }
   

    //Aciona motores *********************************************
    if( maquina_ligada == 200 && (maquina_selecionada == "AC44i" || maquina_selecionada == "Ambas" ))
    { 
     if(direcao == 100)
     { 
      Serial.print(velocidade);
      //Serial.println(" - Frente");    
     }
     else
     {
      Serial.print(velocidade);
      //Serial.println(" - Tras");     
      }
      int v = velocidade + 100;
      if(v>2000){v=2000;}
     motor1.writeMicroseconds(velocidade); // frente
     motor2.writeMicroseconds(v); // tras

    }
    else
    {
    }
    //SINAIS[8] = deviracao1   > Usado apenas nos trilhos
    //SINAIS[9] = derivacao2   > Usado apenas nos trilhos


  /*
   Serial.print(velocidade);
   Serial.print(" - ");
   Serial.print(direcao);
   Serial.print(" - ");
   Serial.print(maquina_ligada);
   Serial.print(" - ");
   Serial.print(v_luz);
   Serial.print(" - ");
   Serial.print(v_luz2);
   Serial.print(" - ");
   Serial.print(v_buzina);
   Serial.print(" - ");
   Serial.print(v_sino);
   Serial.print(" - ");
   Serial.print(v_maquina);
   Serial.print(" - ");
   Serial.print(SINAIS[8]);
   Serial.print(" - ");
   //Serial.println(SINAIS[9]);
  */


   } // Fecha if(maquina_selecionada == "AC44i" || maquina_selecionada == "Ambas") 
   else
   {
    ////Serial.println("Maquina errada!");
   }
   
  }// Fecha while(!done)
 } // Fecha if ( radio.available() )
 else
 {
  ////Serial.println("Aguardando radio!");

 }
 
  


} // Fecha LOOP

void vaudio()
{
  ////Serial.println("Audio");
  
}

/* MAPEANDO PINOS DA CENTRAL

pino 0 = 
pino 1 = 
pino 2 = usado para mapear pulso para o VOL+ e VOL- 
pino 3 = usado para ativação da re
pino 4 = sensor infravermelho volume ( limite minimo, em 0 desliga e impede de diminuir volume ) 
pino 5 = usado para alterar o modo do sistema entre bluetooth , radio, aux/mp3 
pino 6 = usado para Play, SCAN
pino 7 = usado para Anterior
pino 8 = usado no motor de passo 
pino 9 = usado no motor de passo
pino 10 = usado no motor de passo
pino 11 = usado no motor de passo
pino 12 = usado para Proxima
pino 13 = usado para RMT
pino A0 = Sensor DHT11 de temperatura e umidade interna 
pino A1 = Sensor DHT11 de temperatura e umidade externa 
pino A2 = Mapeia o valor da distancia de re
pino A3 = 
pino A4 = 
pino A5 = 

*/


// MOTOR DE PASSO **********************************************************************
#include <Stepper.h>
const int stepsPerRevolution = 64;  // volta completa
Stepper myStepper(stepsPerRevolution, 8, 9, 10, 11);
int posicao;
int b;
int vezes;
int vol;
int mute;
int ativaVol,VOL;

// *************************************************************************************


// MODULO DE TEMPERATURA 
#include "DHT.h"
#define DHTTYPE DHT11 // DHT 11

// 1 do sensor +5V
// 2 do sensor ao pino de dados definido em seu Arduino
// 4 do sensor ao GND
// Conecte o resistor de 10K entre pin 2 (dados) e ao pino 1 (VCC) do sensor

 DHT dht1(A0, DHTTYPE); // sensor interno
 DHT dht2(A1, DHTTYPE); // sensor externo
float uuii = dht1.readHumidity();
float tpii = dht1.readTemperature();
float uuee = dht2.readHumidity();
float tpee = dht2.readTemperature();

// *************************************************************************************

// MAPEANDO A DISTANCIA DE RE
int dree;
int valor_re;


// MAPEANDO A TENSAO DA BATERIA
int vtbc;

// *************************************************************************************


int MODO; // usada para alternar entre modos de bluetooth , radio e auxilio


String readString; // USADO PARA CONCATENAR DADOS NA SERIAL


void setup() 
{
 Serial.begin(9600);

 // MODULOS DE TEMPERATURA DHT11
 dht1.begin(); // temperatura interna
 dht2.begin(); // temperatura externa

  
// MOTOR DE PASSO DO VOLUME
myStepper.setSpeed (400); // rpm
// mapeia o volume + e -
pinMode(2,INPUT); // mapeia os pulsos do volume + ou -
pinMode(4,INPUT); // mapeia o valor minimo pro volume --- sensor infravermelho
pinMode(3,INPUT); // usado para ativação da re
pinMode(5,OUTPUT); // usado para Alternar os MODOS
digitalWrite(5,1);
pinMode(6,OUTPUT); // usado para Play em MODO = 0 e Scan em MODO = 1
digitalWrite(6,1);
pinMode(7,OUTPUT); // usado para anterior
digitalWrite(7,1);
pinMode(12,OUTPUT); // usado para proxima
digitalWrite(12,1);
pinMode(13,OUTPUT); // usado para remote
digitalWrite(13,0);

MODO = 0;
posicao=0;
b = 0;
vol = 0;
vezes = 0;
ativaVol,VOL=0;
mute = 0;
zerar ();



}

  void zerar () // iniado para sincronizar a variavel de posicao e saber o volume maximo que se pode atingir
  {
   for (int i =0; i<5000; i++)// 
   {
    if(digitalRead(4)!=0)
    { 
     myStepper.step(1);
     delay(3);
    }
   }
    
    // ativa volume
    for (int i =0; i<5; i++)// 
    {
     Serial.println("av");  
    }
    // zera volume na barra da tela
    for (int i =0; i<5; i++)// 
    {
     Serial.println("zzz");
    }
    delay(1000);
    
    // sai da tela volume e volta a tela desenvolvedor 
    for (int i =0; i<5; i++)// 
    {
     Serial.println("000");
    }

   }


void temperatura_externa()  // ******************************************************************
{

// ENVIANDO A TEMPERATURA EXTERNA

for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println("tpee"); // ATIVO RECEBER A TEMPERATURA EXTERNA
 delay(250);
}
for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println(tpee); // ENVIO O VALOR DA TEMPERATURA EXTERNA
 delay(250);
}

// ENVIANDO A UMIDADE EXTERNA

for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println("uuee"); // ATIVO RECEBER A UMIDADE EXTERNA
 delay(250);
}
for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println(uuee); // ENVIO O VALOR DA UMIDADE EXTERNA
 delay(250);
}

loop();
}

//*******************************************************************************************


void temperatura_interna() 
{
// ENVIANDO A TEMPERATURA INTERNA

for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println("tpii"); // ATIVO RECEBER A TEMPERATURA INTERNA
 delay(250);
}
for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println(tpii); // ENVIO O VALOR DA TEMPERATURA INTERNA
 delay(250);
}

// ENVIANDO A UMIDADE INTERNA

for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println("uuii"); // ATIVO RECEBER A UMIDADE INTERNA
 delay(250);
}
for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println(uuii); // ENVIO O VALOR DA UMIDADE INTERNA
 delay(250);
}

loop();
}

//******************************************************************************************

// ENVIANDO A DISTANCIA INDICADA PELO SENSOR DE RE

void sensor_de_re() 
{

if(digitalRead(3)==0&&valor_re==0)
{
 valor_re = 1;
 for ( int  i = 0 ; i < 5 ; i++ ) 
 {
  Serial.println("adre"); // ATIVO RECEBER A DISTANCIA DO SENSOR DE RE
  delay(250);
 }
}

if(digitalRead(3)==0&& valor_re==1)
{
 for ( int  i = 0 ; i < 5 ; i++ ) 
 {
  Serial.println(dree); // ENVIO O VALOR DA DISTANCIA DO SENSOR DE RE
  delay(250);
 }
}

if(digitalRead(3)==1&& valor_re==1)
{
 valor_re = 0;
 for ( int  i = 0 ; i < 5 ; i++ ) 
 {
  { 
  Serial.println("000"); // DESATIVA RECEBER A DISTANCIA DO SENSOR DE RE
  delay(250);
 }
 loop();
 }
return;  // verificar se isso não da erro
}
}

// ******************************************************************************************

void tensao_bateria() 
{
// ENVIANDO O VALOR DA BATERIA DO CARRO

for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println("vtbc"); // ATIVO RECEBER O VALOR DA TENSAO DA BATERIA DO CARRO
 delay(250);
}

for ( int  i = 0 ; i < 5 ; i++ ) 
{
 Serial.println(vtbc); // ENVIO O VALOR DA TENSAO DA BATERIA DO CARRO
 delay(250);
}

loop();
}




//********************************************************************************************************************************************





// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP
// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP
// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP
// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP


void loop() 
{
  // Usado para atualizar os valores da umidade e temperatura interna e externa
  int uuii = dht1.readHumidity();
  int tpii = dht1.readTemperature();
  int uuee = dht2.readHumidity();
  int tpee = dht2.readTemperature();
 







  if (digitalRead(3)==0&&valor_re==0)
  {
   sensor_de_re();
  }

 
 
 
 
 
 
  
 if (digitalRead(4)!=1)
 {
 posicao=0;
 }
 

  // le a serial para comunicar com o tablet
  
  while (Serial.available()) 
  {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  
  
  // MODO RADIO *****************************************************************************************************************************************************************************
  
  
    if (readString == "scan")
    {
      if( MODO==1 )
      {
       digitalWrite(6,0);delay(500);digitalWrite(6,1); // ativa o scan
      }
    }
    
 
 
 
    
   // ALTERAR O MODO DA CENTRAL **************************************************************************************************************************************************************


    // MODO RADIO
    if (readString == "modo1")     
    {
     if ( MODO == 0 ) // se esta em bluetooth
     {
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
     }
     if ( MODO == 2 ) // se esta em aux
     {
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
     }
      MODO = 1;    // Seleciona o modo RADIO
    }


   // MODO AUX/MP3
    if (readString == "modo2")     
    {
   
     if ( MODO == 1 ) // se esta em radio
     {
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
     }
     if ( MODO == 0 ) // se esta em bluetooth
     {
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
     }
      MODO = 2;    // Seleciona o modo AUX/MP3
    }



   // MODO BLUETOOTH
    if (readString == "modo0")     
    {
   
     if ( MODO == 2 ) // se esta em AUX/MP3
     {
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
     }
     if ( MODO == 1 ) // se esta em RADIO
     {
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
      digitalWrite(5,0);delay(500);digitalWrite(5,1);delay(3000);
     }
      MODO = 0;     // Seleciona o modo BLUETOOTH
    }





   // RESETAR A CENTRAL **********************************************************************************************************************************************************************

    if (readString == "reset")     
    {    
    setup ();
    }
    
    
    // CONTROLE DO AUDIO  *******************************************************************************************************************************************************************

    // COMANDO DE ATIVAR/ DESATIVAR O REMOTE
    
    if (readString == "rmton")     
    {    
     // USADO PARA ATIVAR OS MODULOS, ATIVANDO A SAIDA RESPECTIVA DOS 12V DO REMOTE
     digitalWrite(13,1);delay(250);
    }
    if (readString == "rmtoff")     
    {    
     // USADO PARA DESATIVAR OS MODULOS, DESATIVANDO A SAIDA RESPECTIVA DOS 12V DO REMOTE   
     digitalWrite(13,0);delay(250);
    }

     // *****************************************************************
    

    // COMANDO DE MUSICA ANTERIOR 
    if (readString == "ant")     
    {    
     digitalWrite(7,0);delay(500);digitalWrite(7,1);    
    }
    // COMANDO DE MUSICA PROXIMA
    if (readString == "next")     
    {    
     digitalWrite(13,0);delay(500);digitalWrite(13,1);       
    }
    // COMANDO DE PLAY OU PAUSE    
    if (readString == "play")     
    {    
     digitalWrite(6,0);delay(500);digitalWrite(6,1);
    }

    // COMANDO DE MUTE
    if (readString == "onmut")     
    {  
    readString == "" ;
    mute = 1;  
    zerar ();
    }

    // COMANDO DE SAIR DO MUTE    
     if (readString == "ofmut")     
    {    
     
     if(posicao<=50 && mute==1)
     { 
       for (int c =0; c<5; c++)// 
       { 
        Serial.println("av");
       }
      
       for (int i =0; (i<5000||posicao>=500); i++)// 
       {
        Serial.println("v+"); 
        myStepper.step(-1);
        delay(5);
       }
       for (int c =0; c<5; c++)// 
       { 
        Serial.println("sv");
        mute = 0;
       }
     }  
    }
    
    
    
    readString=""; // limpa serial
  

  // MAPEIA O VOLUME PELO BOTÃO ROTATIVO NA CENTRAL ******************************************************************************************************************************************
  
  
if ( VOL>=20000 )
{
 ativaVol = 0; // Desativa o contador de tempo
 for (int c =0; c<5; c++)// 
 { 
  Serial.println("sv");
 }
 
 if ( vol ==1&&b==0 )
 {
  vol = 0 ;
  b=1;
  VOL=0;
 }
 
 if ( vol==0&&b==0 )
 {
  vol = 1;
  b=1;
  VOL=0;
  }
 b = 0;
}


if ( ativaVol == 1 )
{
 VOL = VOL+1;
 
}

  
  
  
  
// LOGICA PARA AUMENTAR O VOLUME  
// LOGICA PARA AUMENTAR O VOLUME  

  if (vol == 0)
  {
   if (digitalRead(2)==1&&vezes==0&&posicao<1650) // comando para aumentar o volume a cada pulso positivo no botão
   {
    if(mute==1) // se caso de o comando de mute na tela faz sair ao posicionar o botao de volume
    {
     mute = 0;
     for (int c =0; c<5; c++)// 
     { 
      Serial.println("smute");
     }
    }
    // *************************************************************************************
          
    ativaVol = 1; 
    VOL = 0;
    posicao = posicao+50;
    for (int c =0; c<5; c++)// 
   { 
    Serial.println("av");
   }
    Serial.println("v+");
    //Serial.println(posicao);
    for (int i =0; i<50; i++)// 
    {
     myStepper.step(-1);
     delay(5);
    }
    vezes = 1;
   }
   
   if (digitalRead(2)==0&&vezes==1&&posicao<1650) // comando para aumentar o volume a cada pulso positivo no botão
   {
    if(mute==1) // se caso de o comando de mute na tela faz sair ao posicionar o botao de volume
    {
     mute = 0;
     for (int c =0; c<5; c++)// 
     { 
      Serial.println("smute");
     }
    }
    // *************************************************************************************
    
    ativaVol = 1; 
    VOL = 0;
    posicao = posicao+50;
    for (int c =0; c<5; c++)// 
   { 
    Serial.println("av");
   }
    Serial.println("v+");
    //Serial.println(posicao);
    for (int i =0; i<50; i++)// 
    {
     myStepper.step(-1);
     delay(5);
    }
    vezes = 0;  
   }
  }
  
  // *************************************************************************************

// LOGICA PARA DIMINUIR O VOLUME
// LOGICA PARA DIMINUIR O VOLUME

  if (vol == 1)
  {
   
   if (digitalRead(2)==1 && vezes==0&& digitalRead(4)!=0) // comando para diminuir o volume a cada pulso negativo no botão
   {
    if(mute==1) // se caso de o comando de mute na tela faz sair ao posicionar o botao de volume
    {
     mute = 0;
     for (int c =0; c<5; c++)// 
     { 
      Serial.println("smute");
     }
    } 
     // *************************************************************************************
     
    ativaVol = 1; 
    VOL = 0;
    vezes=1;
    posicao = posicao-50;
    for (int c =0; c<5; c++)// 
   { 
    Serial.println("av");
   }
    Serial.println("v-");
    Serial.println(posicao);
    for (int i =0; i<50; i++)// 
    {
     myStepper.step(1);
     delay(5);
    }
   }
  
   if (digitalRead(2)==0 && vezes==1&& digitalRead(4)!=0) // comando para diminuir o volume a cada pulso negativo no botão
   {
    if(mute==1) // se caso de o comando de mute na tela faz sair ao posicionar o botao de volume
    {
     mute = 0;
     for (int c =0; c<5; c++)// 
     { 
      Serial.println("smute");
     }
    }
    // *************************************************************************************
    
    ativaVol = 1; 
    VOL = 0;
    vezes=0;
    posicao = posicao-50;
    for (int c =0; c<5; c++)// 
   { 
    Serial.println("av");
   }
    Serial.println("v-");   
    Serial.println(posicao);
    for (int i =0; i<50; i++)// 
    {
     myStepper.step(1);
     delay(5);
    }
   }
  }
  // *************************************************************************************

// Desativa todas as saidas conectadas ao motor de passo para evitar que ele esquente

digitalWrite(8,0);
digitalWrite(9,0);
digitalWrite(10,0);
digitalWrite(11,0);


} // fecha o loop


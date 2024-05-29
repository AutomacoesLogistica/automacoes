/* MAPEANDO PINOS DA CENTRAL

>>>>> Arduino 1 <<<<<<<

pino 0 = ok
pino 1 = ok
pino 2 = usado para mapear pulso para o VOL+ e VOL- OK
pino 3 = usado para ativação da re ok
pino 4 = sensor infravermelho volume ( limite minimo, em 0 desliga e impede de diminuir volume ) ok
pino 5 = usado para alterar o modo do sistema entre bluetooth , radio, aux/mp3  - cabo laranja ok
pino 6 = usado para Play, SCAN  - cabo preto ok
pino 7 = usado para Anterior - cabo branco ok
pino 8 = usado no motor de passo ok
pino 9 = usado no motor de passo okq
pino 10 = usado no motor de passo ok
pino 11 = usado no motor de passo ok
pino 12 = usado para Proxima - cabo vermelho ok
pino 13 = usado para RMT ok
pino A0 = Sensor DHT11 de temperatura e umidade interna 
pino A1 = Sensor DHT11 de temperatura e umidade externa 
pino A2 = Mapeia o valor analogico da distancia de re ok
pino A3 = ativa reset na central
pino A4 = usado para ant fisico ok
pino A5 = usado para next fisico ok

*/


// MOTOR DE PASSO **********************************************************************
#include <Stepper.h>
const int stepsPerRevolution = 64;  // volta completa
Stepper myStepper(stepsPerRevolution, 8, 9, 10, 11);
int posicao;
int b;
  int bb;
int vezes;
int vol;
int mute;
int ativaVol,VOL;
int contador ;
int exibir;
// *************************************************************************************

int RADIO;



// MODULO DE TEMPERATURA 

#include <dht.h>

dht DHT1;
dht DHT2;

#define DHT1_PIN A0 //interna
#define DHT2_PIN A1 // externa

// 1 do sensor +5V
// 2 do sensor ao pino de dados definido em seu Arduino
// 4 do sensor ao GND
// Conecte o resistor de 10K entre pin 2 (dados) e ao pino 1 (VCC) do sensor


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
 
// MOTOR DE PASSO DO VOLUME
myStepper.setSpeed (200); // rpm
// mapeia o volume + e -

pinMode(2,INPUT); // mapeia os pulsos do volume + ou -
pinMode(4,INPUT); // mapeia o valor minimo pro volume --- sensor infravermelho
pinMode(3,INPUT); // usado para ativação da re
digitalWrite(A0,0);
digitalWrite(A1,0);
digitalWrite(A2,0);
pinMode(5,OUTPUT); // usado para Alternar os MODOS
digitalWrite(5,0);
pinMode(6,OUTPUT); // usado para Play em MODO = 0 e Scan em MODO = 1
digitalWrite(6,0);
pinMode(7,OUTPUT); // usado para anterior
digitalWrite(7,0);
pinMode(12,OUTPUT); // usado para proxima
digitalWrite(12,0);
pinMode(13,OUTPUT); // usado para ler valor bateria
digitalWrite(13,0);
pinMode(A3,INPUT); // usado para reset
digitalWrite(A3,1);
pinMode(A4,INPUT);
digitalWrite(A4,1);
pinMode(A5,INPUT);
digitalWrite(A5,1);

MODO = 0;
posicao=0;
b = 0;
bb = 0;
vol = 0;
vezes = 0;
ativaVol,VOL=0;
mute = 0;
RADIO = 0;
contador = 0;
valor_re=0;
exibir = 0;
zerar ();

}



  void zerar () // iniado para sincronizar a variavel de posicao e saber o volume maximo que se pode atingir
  {
    for (int i =0; i<5000; i++)// 
   {
     if (digitalRead(4)!=0)
     {
      myStepper.step(1);
      delay(3);
     }
   }
    
    digitalWrite(8,0);
    digitalWrite(9,0);
    digitalWrite(10,0);
    digitalWrite(11,0);

   
   loop();
  }


void temperatura_externa()  // ******************************************************************
{
 exibir = 1; 
 contador = 0;
//ENVIANDO A TEMPERATURA EXTERNA
 Serial.println("tpee"); // ATIVO RECEBER A TEMPERATURA EXTERNA
 delay(250);
 Serial.println(DHT1.temperature,1); // ENVIO O VALOR DA TEMPERATURA EXTERNA
 delay(250);
 loop();
}

void umidade_externa()
{
 exibir = 2; 
 contador = 0;
 // ENVIANDO A UMIDADE EXTERNA
 Serial.println("uuee"); // ATIVO RECEBER A UMIDADE EXTERNA
 delay(500);
 Serial.println(DHT1.humidity,1); // ENVIO O VALOR DA UMIDADE EXTERNA
 delay(500);
 loop();
}


//*******************************************************************************************


void temperatura_interna() 
{
 exibir = 3; 
 contador = 0;
 // ENVIANDO A TEMPERATURA INTERNA
 Serial.println("tpii"); // ATIVO RECEBER A TEMPERATURA INTERNA
 delay(500);
 Serial.println(DHT2.humidity,1); // ENVIO O VALOR DA TEMPERATURA INTERNA
 delay(500);
 loop(); 
}


void umidade_interna()
{
 exibir = 4;
 contador = 0;
 // ENVIANDO A UMIDADE INTERNA
 Serial.println("uuii"); // ATIVO RECEBER A UMIDADE INTERNA
 delay(500);
 Serial.println(DHT2.humidity,1); // ENVIO O VALOR DA UMIDADE INTERNA
 delay(500);
 loop();
}


void tensao_bateria() 
{
 exibir = 5; 
 contador = 0;
Serial.println("bat");
delay(500);
loop();
}




//********************************************************************************************************************************************





// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP
// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP
// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP
// VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP ****** VOID LOOP


void loop() 
{
  if (contador>=100 && VOL>=100)
  {
  if (exibir == 4 && contador!=0)
   { 
    contador = 0;
    tensao_bateria();
   }
   
   if (exibir == 3 && contador!=0)
   { 
    contador = 0;
    umidade_interna();
   }
   
   if (exibir == 2 && contador!=0)
   { 
    contador = 0;
    temperatura_interna();
   }
   

   if (exibir == 1 && contador!=0)
   { 
    contador = 0;
    umidade_externa();
   }
      
    if (exibir == 0 && contador!=0)
   { 
    contador = 0;
    temperatura_externa();
   }
     
  if (exibir == 5 )
  {
   exibir = 0;
  }
  

}
 


    

  if (digitalRead(4)!=1) // se o volume atingir o minimo zera a variavel para sincronizaro limite maximo
  {
   posicao=0;
  }
  
  // ********************************************

 

  // le a serial para comunicar com o tablet
  
  while (Serial.available()) 
  {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  
  if (readString.length() >0) 
  {
    Serial.println(readString);
  }
  
  // MODO RADIO *****************************************************************************************************************************************************************************
  

    if (readString == "scan")
    {
      if( MODO==1 )
      {
       digitalWrite(6,1);delay(500);digitalWrite(6,0); // ativa o scan
      }
    }
    
 
 
 
    
   // ALTERAR O MODO DA CENTRAL **************************************************************************************************************************************************************


    // MODO RADIO
    if (readString == "modo1")     
    {
     if ( MODO == 0 ) // se esta em bluetooth
     {
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(3000);
     }
     if ( MODO == 2 ) // se esta em aux
     {
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(5000);
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(3000);
     }
      MODO = 1;    // Seleciona o modo RADIO
    }


   // MODO AUX/MP3
    if (readString == "modo2")     
    {
   
     if ( MODO == 1 ) // se esta em radio
     {
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(3000);
     }
     if ( MODO == 0 ) // se esta em bluetooth
     {
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(5000);
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(3000);
     }
      MODO = 2;    // Seleciona o modo AUX/MP3
    }



   // MODO BLUETOOTH
    if (readString == "modo0")     
    {
   
     if ( MODO == 2 ) // se esta em AUX/MP3
     {
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(3000);
     }
     if ( MODO == 1 ) // se esta em RADIO
     {
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(5000);
      digitalWrite(5,1);delay(500);digitalWrite(5,0);delay(3000);
     }
      MODO = 0;     // Seleciona o modo BLUETOOTH
    }





   // RESETAR A CENTRAL **********************************************************************************************************************************************************************

    if (readString.indexOf("reset")>=0)
    {    
    pinMode(A3,OUTPUT);  
    digitalWrite(A3,0);
    setup();
    }
    
    
    // CONTROLE DO AUDIO  *******************************************************************************************************************************************************************

    // COMANDO DE ATIVAR/ DESATIVAR O REMOTE
    
    
    // passado para o arduino 2
    
    if (readString.indexOf("rmton")>=0)
    {    
     // USADO PARA ATIVAR OS MODULOS, ATIVANDO A SAIDA RESPECTIVA DOS 12V DO REMOTE
     digitalWrite(13,1);delay(250);
    }
    if (readString.indexOf("rmtoff")>=0)
    {    
     // USADO PARA DESATIVAR OS MODULOS, DESATIVANDO A SAIDA RESPECTIVA DOS 12V DO REMOTE   
     digitalWrite(13,0);delay(250);
    }
    
    
     // *****************************************************************
    

    // COMANDO DE MUSICA ANTERIOR 
    if (readString == "ant"||digitalRead(A4)==0)     
    {    
     digitalWrite(7,1);delay(500);digitalWrite(7,0);    
    }
    // COMANDO DE MUSICA PROXIMA
    if (readString == "next"||digitalRead(A5)==0)     
    {    
     digitalWrite(12,1);delay(500);digitalWrite(12,0);       
    }
    // COMANDO DE PLAY OU PAUSE    
    if (readString.indexOf("play")>=0)
    {    
     digitalWrite(6,1);delay(500);digitalWrite(6,0);
    }

    // COMANDO DE MUTE
    if (readString.indexOf("onmt")>=0)
    {  
     if ( mute==0)
     {
       for (int c =0; c<5; c++)// 
     { 
      Serial.println("av");
     } 
      for (int i =0; (mute==0&&i<5000); i++)// 
      {
       if (digitalRead(4)!=0)
       {
         Serial.println("v-");   
        myStepper.step(1);
        delay(3);
        }
       if (digitalRead(4)!=1&& mute==0)
       {
        Serial.println("MUDO ATIVO");
        mute = 1;  
        readString == "" ;
        digitalWrite(8,0);
        digitalWrite(9,0);
        digitalWrite(10,0);
        digitalWrite(11,0);
        for (int c =0; c<5; c++)// 
        { 
         Serial.println("sv");
        }  
       }
      }
     }
    }

    // COMANDO DE SAIR DO MUTE    
     if (readString.indexOf("ofmt")>=0)
    {   
      Serial.println("MUDO DESATIVO"); 

    if(mute==1 )
    {
     for (int c =0; c<5; c++)// 
     { 
      Serial.println("av");
     } 
     for (int i =0; i<500; i++)// 
     {
        Serial.println("v+"); 
        myStepper.step(-1);
        delay(3);

     }
     for (int c =0; c<5; c++)// 
     { 
      Serial.println("sv");
      mute = 0;
     }  
    digitalWrite(8,0);
    digitalWrite(9,0);
    digitalWrite(10,0);
    digitalWrite(11,0);
   }
   } 
      



    // CONTROLE DA RADIO  *******************************************************************************************************************************************************************
   
    if (readString == "radio1"||readString == "radio2"||readString == "radio3"||readString == "radio4"||readString == "radio5")     
   {
   
    if (readString.indexOf("radio1")>=0)
    {    
     RADIO=1;
    }
    if (readString.indexOf("radio2")>=0)
    {    
     RADIO=2;    }

    if (readString.indexOf("radio3")>=0)
    {    
     RADIO=3;    }

    if (readString.indexOf("radio4")>=0)
    {    
     RADIO=4;    }
    if (readString.indexOf("radio5")>=0)
    {    
     RADIO=5;    }

     
     for(int v = 0; v <= RADIO ; v++)
     {
     digitalWrite(12,1);delay(300);digitalWrite(12,0);       
     
     }
     readString = "";
     RADIO = 0;
     }

     // *****************************************************************
    readString=""; // limpa serial
  












  // MAPEIA O VOLUME PELO BOTÃO ROTATIVO NA CENTRAL ******************************************************************************************************************************************
  
  
if ( VOL>=100 && b == 0)
{
 ativaVol = 0; // Desativa o contador de tempo
 if (vol==0&&bb==0)
 {
   vol = 1;
   bb=1;
 }

 if (vol==1&&bb==0)
 {
 bb==1;  
 vol = 0;
 }
 bb=0;
 b = 1;
 
 
 for (int c =0; c<2; c++)// 
 { 
  Serial.println("sv");
 }

}


if ( ativaVol == 1 )
{
 b=0; 
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

  if (vol==1)
  {
   
         if (digitalRead(2)==1 && vezes==0) // comando para diminuir o volume a cada pulso negativo no botão
         {
              if(mute==1) // se caso de o comando de mute na tela faz sair ao posicionar o botao de volume
              {
               mute = 0;
               for (int c =0; c<5; c++)// 
               { 
                Serial.println("smute");
               }
              } 

     
              ativaVol = 1; 
              VOL = 0;
              vezes=1;
              posicao = posicao-50;
              for (int c =0; c<5; c++)// 
             { 
              Serial.println("av");
             }
              Serial.println("v-");
          
              for (int i =0; i<50; i++)// 
              {
               myStepper.step(1);
               delay(5);
              }
             }
  
           // *************************************************************************************
   
   
           if (digitalRead(2)==0 && vezes==1) // comando para diminuir o volume a cada pulso negativo no botão
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
      
          for (int i =0; i<50; i++)// 
          {
           myStepper.step(1);
           delay(5);
          }
         }
   }
   
   
  // *************************************************************************************



  
// ENVIANDO A DISTANCIA INDICADA PELO SENSOR DE RE
  if (digitalRead(3)==1&&valor_re==0) // Se ativar a re entra no modo de envio de re
  {
    valor_re = 1;
     Serial.println("r+"); // ATIVO RECEBER A DISTANCIA DO SENSOR DE RE
     delay(80);
    

   }
  
  
  //******************************************************************************************
if(valor_re==1 && digitalRead(3)==1)
{
  for ( int  i = 0 ; i < 2 ; i++ ) 
 {
  Serial.println(analogRead(A2)); // ENVIO O VALOR DA DISTANCIA DO SENSOR DE RE
  delay(250);
 }
}

if(digitalRead(3)==0&& valor_re==1)
{
  valor_re = 0;
  Serial.println("r-"); // DESATIVA RECEBER A DISTANCIA DO SENSOR DE RE
  delay(80); 
}
// ******************************************************************************************







// Desativa todas as saidas conectadas ao motor de passo para evitar que ele esquente
digitalWrite(8,0);
digitalWrite(9,0);
digitalWrite(10,0);
digitalWrite(11,0);

contador = contador + 1;

int dht1 = DHT1.read11(DHT1_PIN);
int dht2 = DHT2.read11(DHT2_PIN);

} // fecha o loop


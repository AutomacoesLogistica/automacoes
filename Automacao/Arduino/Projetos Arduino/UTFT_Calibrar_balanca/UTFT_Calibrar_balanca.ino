

#include <UTFT.h>
#include <UTouch.h>
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção
int SINAIS[30];  // usada para receber os comandos enviados


int x,y;
int TELA;
int pronto;
int correia;
int peso;
int tempo5_1,tempo5_2,tempo5_3,tempo5_4,tempo5_5;
int vezes_5;
int media_tempo5,media_tempoT;
int tempoT_1,tempoT_2,tempoT_3,tempoT_4,tempoT_5;
int vezes_T;

// Declare which fonts we will be using
extern uint8_t SmallFont[];
extern uint8_t arial_bold[];
// Uncomment the next line for Arduino Mega
UTFT myGLCD(ITDB50,38,39,40,41);   // Remember to change the model parameter to suit your display module!
UTouch        myTouch(6,5,4,3,2);
void setup()
{
 Serial.begin(9600);
 myGLCD.InitLCD(); // inicia o lcd
 radio.begin();
 radio.openReadingPipe(1,pipe);
 radio.startListening();;
 myTouch.InitTouch();
 myTouch.setPrecision(PREC_EXTREME);
 myGLCD.setFont(arial_bold); // seleciona fonte
 myGLCD.clrScr(); // limpa lcd
 TELA = 0;
 correia = 0;
 peso = 0;
 pronto = 0;
 vezes_5,vezes_T = 1; // tem que comecar em 1
 tempo5_1,tempo5_2,tempo5_3,tempo5_4,tempo5_5=0;
 media_tempo5,media_tempoT = 0;
 tempoT_1,tempoT_2,tempoT_3,tempoT_4,tempoT_5=0;
 tela_principal();
}

void loop()
{
 
  while ( true )
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 
       
       
       if ( TELA == 0 ) // abre o touch da tela principal
       {
                    if ( pronto == 1 )
                    {
                    // Mapeia se clicou no Conectar (200,360,390,390) *********************************************************************************
                     if ((x>=200)&&(x<=390) && correia!=0 && peso!=0) 
                     {
                     if ((y>=360)&&(y<=390)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(200,360,390,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print(" Conectar  ", 210,370 );// Escrita
                        // deixa as outras demais em branco
                        // Limpar
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(410,360,600,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print("  Limpar   ", 420,370 );// Escrita
                       }
                      delay(1000);
                      tela_calibracao();
                     }
               
                    // Mapeia se clicou no Limpar (410,360,600,390);(410,220,600,250) *********************************************************************************
                    if ((x>=410)&&(x<=600) && correia!=0 && peso!=0) 
                     {
                     if ((y>=360)&&(y<=390)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(410,360,600,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print("  Limpar   ", 420,370 );// Escrita
                        // deixa as outras demais em branco
                        // Conectar
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(200,360,390,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" Conectar  ", 210,370 );// Escrita
                       }
                      delay(1000);
                      setup();
                     }
                 } // fecha o if pronto ==1 
                  
                   
                  if ( pronto == 0 )
                  {     
                    // Mapeia se clicou na TC-BP-106 (99,80,289,110) *********************************************************************************
                    if ((x>=99)&&(x<=289)) 
                     {
                     if ((y>=80)&&(y<=110)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(99,80,289,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-106 ", 109,90 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita                    
                        myGLCD.print(" TC-BP-106 ", 410,280 );// Escrita
                        correia = 106;
                        // deixa as outras demais em branco
                        // Correia TC-BP-107
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,80,499,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-107 ", 319,90 );// Escrita
                      
                        // Correia TC-BP-108
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(519,80,709,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-108 ", 529,90 );// Escrita
                      
                        // Correia TC-BP-109
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,130,289,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-109 ", 109,140 );// Escrita
                        
                        // Correia TC-FG-111
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,130,499,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-FG-111 ", 319,140 );// Escrita
                       }
                      delay(500);
                      
                     }
                     
                     
                      // Mapeia se clicou na TC-BP-107 (309,80,499,110) *********************************************************************************
                    if ((x>=309)&&(x<=499)) 
                     {
                     if ((y>=80)&&(y<=110)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(309,80,499,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-107 ", 319,90 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita                   
                        myGLCD.print(" TC-BP-107 ", 410,280 );// Escrita      
                        correia = 107;
                        // deixa as outras demais em branco
                         // Correia TC-BP-106
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,80,289,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-106 ", 109,90 );// Escrita
                      
                        // Correia TC-BP-108
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(519,80,709,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-108 ", 529,90 );// Escrita
                      
                        // Correia TC-BP-109
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,130,289,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-109 ", 109,140 );// Escrita
                        
                        // Correia TC-FG-111
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,130,499,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-FG-111 ", 319,140 );// Escrita
                       }
                      delay(500);
                     }
                     
                        // Mapeia se clicou na TC-BP-108 (519,80,709,110) *********************************************************************************
                    if ((x>=519)&&(x<=709)) 
                     {
                     if ((y>=80)&&(y<=110)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(519,80,709,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-108 ", 529,90 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita                   
                        myGLCD.print(" TC-BP-108 ", 410,280 );// Escrita          
                        correia = 108;
                        // deixa as outras demais em branco
                         // Correia TC-BP-106
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,80,289,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-106 ", 109,90 );// Escrita
                      
                          // Correia TC-BP-107
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,80,499,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-107 ", 319,90 );// Escrita
                        
                        // Correia TC-BP-109
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,130,289,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-109 ", 109,140 );// Escrita
                        
                        // Correia TC-FG-111
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,130,499,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-FG-111 ", 319,140 );// Escrita
                       }
                      delay(500);
                     }
                     
                     
                         // Mapeia se clicou na TC-BP-109 (99,130,289,160) *********************************************************************************
                    if ((x>=99)&&(x<=289)) 
                     {
                     if ((y>=130)&&(y<=160)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(99,130,289,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-109 ", 109,140 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita                   
                        myGLCD.print(" TC-BP-109 ", 410,280 );// Escrita
                        correia = 109;        
                        // deixa as outras demais em branco
                         // Correia TC-BP-106
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,80,289,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-106 ", 109,90 );// Escrita
                      
                          // Correia TC-BP-107
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,80,499,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-107 ", 319,90 );// Escrita
                        
                         // Correia TC-BP-108
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(519,80,709,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-108 ", 529,90 );// Escrita
                        
                        // Correia TC-FG-111
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,130,499,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-FG-111 ", 319,140 );// Escrita
                       }
                      delay(500);
                     }
                      
                     
                     // Mapeia se clicou na TC-FG-111 (309,130,499,160) *********************************************************************************
                    if ((x>=309)&&(x<=499)) 
                     {
                     if ((y>=130)&&(y<=160)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(309,130,499,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print(" TC-FG-111 ", 319,140 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita                    
                        myGLCD.print(" TC-FG-111 ", 410,280 );// Escrita          
                        correia = 111;          
                        // deixa as outras demais em branco
                        
                          // Correia TC-BP-106
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,80,289,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-106 ", 109,90 );// Escrita
                        
                        // Correia TC-BP-107
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(309,80,499,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-107 ", 319,90 );// Escrita
                      
                        // Correia TC-BP-108
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(519,80,709,110);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-108 ", 529,90 );// Escrita
                      
                        // Correia TC-BP-109
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(99,130,289,160);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" TC-BP-109 ", 109,140 );// Escrita
                                 
                       }
                      delay(500);
                     }
                     
                     
                     
                     // Mapeia se clicou no peso 40Kg (200,220,390,250) *********************************************************************************
                    if ((x>=200)&&(x<=390) && (correia == 106 ||correia == 107 ||correia == 108 ||correia == 109 ||correia == 111)) 
                     {
                     if ((y>=220)&&(y<=250)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(200,220,390,250);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print("   40 Kg   ", 210,230 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita          
                        myGLCD.print("   40 Kg   ", 390, 310);// Escrita                       
                        peso = 40;
                        pronto = 1; // ativa a leitura do trouch
                         // Adiciona botoes de conectar e limpar
                        // Conectar
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(200,360,390,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" Conectar  ", 210,370 );// Escrita
                        // Limpar
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(410,360,600,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print("  Limpar   ", 420,370 );// Escrita
                        
                        // deixa as outras demais em branco
                        //Pesos de 80 KG
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(410,220,600,250);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print("   80 Kg   ", 420,230 );// Escrita
                       }
                      delay(1000);
                     }
               
                     // Mapeia se clicou no peso 80Kg (410,220,600,250) *********************************************************************************
                    if ((x>=410)&&(x<=600) && (correia == 106 ||correia == 107 ||correia == 108 ||correia == 109 ||correia == 111)) 
                     {
                     if ((y>=220)&&(y<=250)) 
                      { 
                        myGLCD.setColor(255, 159, 27);  
                        myGLCD.fillRect(410,220,600,250);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 159, 27);// Cor de fundo da escrita
                        myGLCD.print("   80 Kg   ", 420,230 );// Escrita
                        myGLCD.setBackColor(155, 255, 97);// Cor de fundo da escrita                   
                        myGLCD.print("   80 Kg   ", 390, 310);// Escrita             
                        peso = 80;
                        pronto = 1; // ativa a leitura do trouch
                        
                        // Adiciona botoes de conectar e limpar
                        // Conectar
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(200,360,390,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print(" Conectar  ", 210,370 );// Escrita
                        // Limpar
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(410,360,600,390);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print("  Limpar   ", 420,370 );// Escrita
                        // deixa as outras demais em branco
                        // Pesos de 40 KG
                        myGLCD.setColor(255, 255, 255);  
                        myGLCD.fillRect(200,220,390,250);
                        myGLCD.setColor(0,0,0); // Cor da escrita
                        myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
                        myGLCD.print("   40 Kg   ", 210,230 );// Escrita
                       }
                      delay(1000);
                     }
                    } // fecha o pronto == 0
    } // fecha touch relacionado a tela principal
     
     
     if (TELA == 1) // abre o touch para tela calibração
     {
                     // Mapeia se clicou no Voltar (580,380,700,420) *********************************************************************************
                     if ((x>=580)&&(x<=700)) 
                     {
                     if ((y>=380)&&(y<=420)) 
                      {
                       setup(); 
                      }
                     }


     }// Fecha o touch da tela calibração
    
  
    }  // fecha o if touch pressionado
  } // fecha o while   

// **************************************************************************************************************************************************************************************


 if ( radio.available()) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  radio.read( SINAIS, sizeof(SINAIS) );
 
 
 // ***************************************************************************************************************************************************
 //
 //     RECEBENDO OS TEMPOS DE 5 METROS
 //
 
 // So recebe dados de o media_tempo5 for igual a zero, ou seja, nao recebeu os dados ainda
if (media_tempo5 == 0)
{
      // Recebe o 5 tempo de 5 metros
       if (SINAIS[1] != 0 && vezes_5 == 5)
       {
        tempo5_5 = SINAIS[1];
       }
      // Recebe o 4 tempo de 5 metros 
       if (SINAIS[1] != 0 && vezes_5 == 4)
       {
        tempo5_4 = SINAIS[1];
       }
      // Recebe o 3 tempo de 5 metros 
       if (SINAIS[1] != 0 && vezes_5 == 3)
       {
        tempo5_3 = SINAIS[1];
       }
       // Recebe o 2 tempo de 5 metros
        if (SINAIS[1] != 0 && vezes_5 == 2)
       {
        tempo5_2 = SINAIS[1];
       }
      // Recebe o 1 tempo de 5 metros
        if (SINAIS[1] != 0 && vezes_5 == 1)
       {
        tempo5_1 = SINAIS[1];
       }
    // ********************************************************************************************
      if (SINAIS[1] == 1023)
      {
      vezes_5++;
      // Finalizando a tomada de tempo
      if ( vezes_5 == 6)
      {
       media_tempo5 = tempo5_1+tempo5_2+tempo5_3+tempo5_4+tempo5_5;  
      }
      }
} // fecha os dados se a media não estiver pronta     
 // ***************************************************************************************************************************************************
 
 



 // ***************************************************************************************************************************************************
 //
 //     RECEBENDO OS TEMPOS DE VOLTA DA COREEIA
// 
 // So recebe dados de o media_tempoT for igual a zero, ou seja, nao recebeu os dados ainda
if (media_tempoT == 0)
{
      // Recebe o 5 tempo de volta
       if (SINAIS[2] != 0 && vezes_T == 5)
       {
        tempoT_5 = SINAIS[2];
       }
      // Recebe o 4 tempo de volta
       if (SINAIS[2] != 0 && vezes_T == 4)
       {
        tempoT_4 = SINAIS[2];
       }
      // Recebe o 3 tempo de volta
       if (SINAIS[2] != 0 && vezes_T == 3)
       {
        tempoT_3 = SINAIS[2];
       }
       // Recebe o 2 tempo de volta
        if (SINAIS[2] != 0 && vezes_T == 2)
       {
        tempoT_2 = SINAIS[2];
       }
      // Recebe o 1 tempo de volta
        if (SINAIS[2] != 0 && vezes_T == 1)
       {
        tempoT_1 = SINAIS[2];
       }
    // ********************************************************************************************
      if (SINAIS[2] == 1023)
      {
      vezes_T++;
      // Finalizando a tomada de tempo
      if ( vezes_T == 6)
      {
       media_tempoT = tempoT_1+tempoT_2+tempoT_3+tempoT_4+tempoT_5;  
      }
      }
} // fecha os dados se a media não estiver pronta     
 // ***************************************************************************************************************************************************
 







 
 
 
 }




















 
} // fecha loop 
 

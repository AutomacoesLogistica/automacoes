#include <UTFT.h>
#include <UTouch.h>
#include <UTFT_Buttons.h>
#include <IRremote.h>

IRsend irsend;

extern uint8_t SmallFont[];
extern uint8_t BigFont[];

UTFT          myGLCD(ITDB50,38,39,40,41);
UTouch        myTouch(6,5,4,3,2);
UTFT_Buttons  myButtons(&myGLCD, &myTouch);

int x,y;
int bcarro, bcasa;
int btv,bprodigy,bar,bcortina,blampada,bportao, pressed_button;
int telas;
int bportP,bportG;
int blampG;
int babrir,bfechar;
int babrir_1,bfechar_1; // usada para saber o ponto de para na tela cortina
// usados para a tela sky
int bpMUTE,bpPOWER,bpVOL_mais,bpVOL_menos,bpCH_mais,bpCH_menos,bpEXIT,bpSLEEP,bpCIMA,bpBAIXO,bpESQUERDA,bpDIREITA,bpOK,bpNET,bpMENU,bpCANAIS;

// usado para a tela canais
int b12,b13,b14,b26,b30,b31,b34,b35,b53,b54,b55,b60,b63,b92,b93,b101,b102,b123,b124,b128,b135,b136,b138,b142,b141,b192,bVOLTAR;
// usado para a tela ar
int baliga,bavertical,bahorizontal,baventilador,batimer,baumidade,bavoltar;



void setup()
{
  Serial.begin(9600);
// mudando o pino para envio do sinal de ir de 3 para o 9
// mudando o pino para envio do sinal de ir de 3 para o 9
// mudando o pino para envio do sinal de ir de 3 para o 9

  pinMode(9,OUTPUT); //  Declara o pino 9 como saida
  analogWrite(9, LOW);//  Declara nivel baixo e usando sempre analogWrite e nao digitalwrita, pois se trata de sinal analogico


// ****************************************************************************************************************************************************************  
  myGLCD.InitLCD();
  myGLCD.clrScr();
  myGLCD.setFont(SmallFont);
  myTouch.InitTouch();
  myTouch.setPrecision(PREC_EXTREME);
  myButtons.setTextFont(BigFont);
  tela_principal(); 
  telas = 0;
  babrir_1,bfechar_1=0;
}

void tela_principal()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
 
  bcarro = myButtons.addButton( 100,  50, 600,  150, "CASA");
  bcasa = myButtons.addButton( 100, 250, 600,  150, "CARRO");
  myButtons.drawButtons();
  
//  myGLCD.fillRoundRect( 100, 250, 600,  150);
//  myGLCD.setColor(VGA_RED);
//  myGLCD.setBackColor(VGA_GREEN);
 

  telas = 0;
  delay(1000);
  loop();
}

void tela_casa()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);

  btv = myButtons.addButton( 50,  50, 200,  200, "TV");
  bprodigy = myButtons.addButton( 300,  50, 200,  200, "SKY");  
  bar = myButtons.addButton( 550,  50, 200,  200, "AR");  
  blampada = myButtons.addButton( 50,  300, 200,  200, "LUZ");
  bcortina = myButtons.addButton( 300,  300, 200, 200, "CORTINA"); 
  bportao = myButtons.addButton( 550,  300, 200,  200, "PORTAO");  
  
  myButtons.drawButtons();
  telas = 1;
  delay(1000);
  loop();
}

// ***************************************************************************************************************************************************************************************************




void tela_tv()
{


}

// ***************************************************************************************************************************************************************************************************




void tela_sky()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
 
  bpPOWER = myButtons.addButton( 10,  10, 100,  100, "POWER");  
  bpMUTE = myButtons.addButton( 160,  10, 100,  100, "MUTE");
  bpVOL_mais = myButtons.addButton( 650,  10, 100,  100, "Vol +");
  bpVOL_menos = myButtons.addButton( 500,  10, 100,  100, "Vol -");
  bpCH_mais = myButtons.addButton( 650,  160, 100,  100, "CH +");
  bpCH_menos = myButtons.addButton( 500,  160, 100,  100, "CH -");
  bpMENU = myButtons.addButton( 350,  160, 100,  100, "MENU");
  bpCANAIS = myButtons.addButton( 350,  310, 100,  100, "CANAIS");
  bpEXIT = myButtons.addButton( 650,  310, 100,  100, "EXIT");
  bpNET = myButtons.addButton( 500,  310, 100,  100, "NET"); 
  bpSLEEP = myButtons.addButton( 310, 10, 100,  100, "SLEEP");
  bpCIMA = myButtons.addButton( 160, 180, 50, 50, "C");
  bpBAIXO = myButtons.addButton( 160, 330, 50, 50, "B");
  bpESQUERDA = myButtons.addButton( 85, 255, 50, 50, "E");
  bpDIREITA = myButtons.addButton( 235, 255, 50, 50, "D");
  bpOK = myButtons.addButton( 160, 255, 50, 50, "Ok");
  
  myButtons.drawButtons();
  telas = 22;
  delay(1000);
  loop();


}

// ***************************************************************************************************************************************************************************************************


void tela_CANAIS()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
 
// int b12,b13,b14,b26,b30,b31,b34,b35,b53
  b12 = myButtons.addButton( 50, 10, 200,  50, "BANDEIRANTES");
  b13 = myButtons.addButton( 50, 70, 200,  50, "BIS");  
  b14 = myButtons.addButton( 50, 130, 200,  50, "BIS HD");
  b26 = myButtons.addButton( 50, 190, 200,  50, "COMBATE");
//  b30 = myButtons.addButton( 50, 490, 200,  50, "DISC. CH");
  b31 = myButtons.addButton( 50, 250, 200,  50, "DISC. CH HD");
  b34 = myButtons.addButton( 50, 310, 200,  50, "D THEATER HD");  
  b35 = myButtons.addButton( 50, 370, 200,  50, "DISC. TURBO");
  b53 = myButtons.addButton( 50, 430, 200,  50, "FOX SPORTS");


//b54,b55,b60,b63,b92,b93,b101,b102,b123
  b54 = myButtons.addButton( 300, 10, 200,  50, "FOX SPORTS 2");
  b55 = myButtons.addButton( 300, 70, 200,  50, "FOX SPORTS HD");  
  b60 = myButtons.addButton( 300, 130, 200,  50, "GLOBO MINAS");
  b63 = myButtons.addButton( 300, 190, 200,  50, "GLOBO SP");
  b92 = myButtons.addButton( 300, 490, 200,  50, "MULTISHOW");
  b93 = myButtons.addButton( 300, 250, 200,  50, "MULTISHOW HD");
  b101 = myButtons.addButton( 300, 310, 200,  50, "OFF HD");  
  b102 = myButtons.addButton( 300, 370, 200,  50, "OFF");
  b123 = myButtons.addButton( 300, 430, 200,  50, "RECORD");


// b124,b128,b135,b136,b138,b142,b141;
  b124 = myButtons.addButton( 550, 10, 200,  50, "REDE TV");
  b128 = myButtons.addButton( 550, 70, 200,  50, "SBT");  
  b135 = myButtons.addButton( 550, 130, 200,  50, "SPORT TV");
  b136 = myButtons.addButton( 550, 190, 200,  50, "SPORT TV 2");
  b138 = myButtons.addButton( 550, 490, 200,  50, "SPORT TV 3");
  b142 = myButtons.addButton( 550, 250, 200,  50, "SPORT TV HD");
  b141 = myButtons.addButton( 550, 310, 200,  50, "SPORT TV2 HD");  
  b192 = myButtons.addButton( 550, 370, 200,  50, "WARNER HD");
  bVOLTAR = myButtons.addButton( 550, 430, 200,  50, "Voltar");


  myButtons.drawButtons();
  telas = 32;
  loop();



}








// ***************************************************************************************************************************************************************************************************



void tela_ar()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
 
  baliga = myButtons.addButton( 300,  50, 200,  80, "LIGAR/DESLIGAR");
  bavertical = myButtons.addButton( 50, 165 , 200,  80, "VERTICAL");
  bahorizontal = myButtons.addButton( 50, 285, 200, 80, "HORIZONTAL");
  baventilador = myButtons.addButton( 300, 400, 200, 80, "VENTILADOR");
  batimer = myButtons.addButton( 550, 285, 200, 80, "TIMER");
  baumidade = myButtons.addButton( 550,  165, 200, 80, "UMIDADE");
  bavoltar = myButtons.addButton( 300,  165, 200, 200, "VOLTAR");
  myButtons.drawButtons();
  telas = 23;
  delay(1000);
 loop();



  
  
  
  
  
  
  

}

// ***************************************************************************************************************************************************************************************************



void tela_luz()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
 
  blampG = myButtons.addButton( 100,  50, 600,  150, "LAMPADA DA GARAGEM");
  bVOLTAR = myButtons.addButton( 550, 430, 200,  50, "Voltar");
  myButtons.drawButtons();
  telas = 24;
  delay(1000);
  loop();


}

// ***************************************************************************************************************************************************************************************************
void tela_cortina()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
 
  babrir = myButtons.addButton( 100,  50, 600,  150, "ABRIR");
  bfechar = myButtons.addButton( 100,  250, 600,  150, "FECHAR");  

  myButtons.drawButtons();
  telas = 25;
  loop();



}

// ***************************************************************************************************************************************************************************************************
void tela_portao()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
  
  bportP = myButtons.addButton( 100,  50, 600,  150, "PORTAO PEQUENO");
  bportG = myButtons.addButton( 100, 250, 600,  150, "PORTAO GRANDE");

  myButtons.drawButtons();
  telas = 26;
  delay(1000);
  loop();


}

// ***************************************************************************************************************************************************************************************************
// ***************************************************************************************************************************************************************************************************
// ***************************************************************************************************************************************************************************************************
// ***************************************************************************************************************************************************************************************************


void tela_carro()
{
  myButtons.deleteAllButtons();
  myGLCD.clrScr();
  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);
  bcarro = myButtons.addButton( 100,  50, 600,  150, "   CARRO    ");
  bcasa = myButtons.addButton( 100, 250, 600,  150, "   CARRO   ");
  myButtons.drawButtons();
  telas = 2;
  delay(1000);
  loop();

}



void loop()
{  // abre o if geral
  
  // MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL  
  // MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL  
  // MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL  
  // MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL   MAPEIA TELA PRINCIPAL  
  
  while (telas==0) 
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 
      if ((x>=200)&&(x<=400)) 
       {
       if ((y>=60)&&(y<=190)) 
        { 
        tela_casa();
        }
        delay(50);
       }
       if ((x>=200)&&(x<=400)) 
        {
        if ((y>=260)&&(y<=400)) 
         { 
         tela_carro();
         }
         
         delay(50);
        }    
    }  // fecha o if touch pressionado

  } // fecha o while   
    

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA   
// MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA   
// MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA   
// MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA   
// MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA    MAPEIA TELA DA CASA   

  while (telas==1) 
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 
         
      // dados do botao TV para mapear o touch 
      //btv = myButtons.addButton( 50,  50, 200,  200, "TV");
      if ((x>=60)&&(x<=240)) 
       {
       if ((y>=60)&&(y<=240)) 
        { 
        tela_tv();
        }
        delay(50);
       }
      
 
      // dados do botao SKY para mapear o touch 
      // bprodigy = myButtons.addButton( 300,  50, 200,  200, "SKY");  
      if ((x>=310)&&(x<=490)) 
       {
       if ((y>=60)&&(y<=240)) 
        { 
        tela_sky();
        }
        delay(50);
       } 
  

      // dados do botao AR para mapear o touch 
      // bar = myButtons.addButton( 550,  50, 200,  200, "AR");  
      if ((x>=560)&&(x<=740)) 
       {
       if ((y>=60)&&(y<=240)) 
        { 
        tela_ar();
        }
        delay(50);
       } 


      // dados do botao LUZ para mapear o touch 
      // blampada = myButtons.addButton( 50,  300, 200,  200, "LUZ");
      if ((x>=60)&&(x<=240)) 
       {
       if ((y>=310)&&(y<=490)) 
        { 
        tela_luz();
        }
        delay(50);
       } 
  
  
      // dados do botao CORTINA para mapear o touch 
      // bcortina = myButtons.addButton( 300,  300, 200, 200, "CORTINA"); 
      if ((x>=310)&&(x<=490)) 
       {
       if ((y>=310)&&(y<=490)) 
        { 
        tela_cortina();
        }
        delay(50);
       } 
  

      // dados do botao PORTAO para mapear o touch 
      //bportao = myButtons.addButton( 550,  300, 200,  200, "PORTAO");  

      if ((x>=560)&&(x<=740)) 
       {
       if ((y>=310)&&(y<=490)) 
        { 
        tela_portao();
        }
        delay(50);
       }
       
       // COMANDO PARA VOLTAR AO INICIO   
       if ((x>=700)&&(x<=800)) 
        {
         if ((y>=420)&&(y<=500)) 
          {
           tela_principal();
          }
        }
    tela_casa();    
    }  // fecha o if touch pressionado
  } // fecha o while   

//*********

// MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY  
// MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY  
// MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY  
// MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY   MAPEIA TELA SKY  

while (telas==22) 

  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 

      if ((x>=10)&&(x<=110)) //   bpPOWER = myButtons.addButton( 10,  10, 100,  100, "POWER");  
       {
       if ((y>=10)&&(y<=110)) 
        { 
        irsend.sendNEC(0xEF3AC5, 32);
        delay(200);
        }
       }


      if ((x>=160)&&(x<=260)) //     bpMUTE = myButtons.addButton( 160,  10, 100,  100, "MUTE");
       {
       if ((y>=10)&&(y<=110)) 
        { 
        irsend.sendNEC(0xEF7887, 32);
        delay(200);
        }
       }


      if ((x>=650)&&(x<=750)) //    bpVOL_mais = myButtons.addButton( 650,  10, 100,  100, "Vol +");   
       {
       if ((y>=10)&&(y<=110)) 
        { 
        irsend.sendNEC(0xEF6A95, 32);
        delay(10);
        }
       }


      if ((x>=500)&&(x<=600)) //   bpVOL_menos = myButtons.addButton( 500,  10, 100,  100, "Vol -");   
       {
       if ((y>=10)&&(y<=110)) 
        { 
        irsend.sendNEC(0xEFAA55, 32);
        delay(10);
        }
       }


      if ((x>=650)&&(x<=750)) //     bpCH_mais = myButtons.addButton( 650,  160, 100,  100, "CH +");
       {
       if ((y>=160)&&(y<=260)) 
        { 
        irsend.sendNEC(0xEFBA45, 32);
        delay(20);
        }
       }



      if ((x>=500)&&(x<=600)) //       bpCH_menos = myButtons.addButton( 500,  160, 100,  100, "CH -");
       {
       if ((y>=160)&&(y<=260)) 
        { 
        irsend.sendNEC(0xEFF807, 32);
        delay(20);
        }
       }
 


      if ((x>=350)&&(x<=450)) //        bpMENU = myButtons.addButton( 350,  160, 100,  100, "MENU"); 
       {
       if ((y>=160)&&(y<=260)) 
        { 
        irsend.sendNEC(0xEF08F7, 32);
        delay(200);
        }
       }


      if ((x>=350)&&(x<=450)) //         bpCANAIS = myButtons.addButton( 350,  310, 100,  100, "CANAIS"); 
       {
       if ((y>=310)&&(y<=410)) 
        { 
        tela_CANAIS();
        delay(20);
        }
       }
 

      if ((x>=650)&&(x<=750)) //          bpEXIT = myButtons.addButton( 650,  310, 100,  100, "EXIT"); 
       {
       if ((y>=310)&&(y<=410)) 
        { 
        irsend.sendNEC(0xEF38C7, 32);
        delay(200);
        }
       }
 


      if ((x>=500)&&(x<=600)) //       bpNET = myButtons.addButton( 500,  310, 100,  100, "NET"); 
       {
       if ((y>=310)&&(y<=410)) 
        { 
        irsend.sendNEC(0xEF30CF, 32);
        delay(200);
        }
       }
 

      if ((x>=310)&&(x<=410)) //         bpSLEEP = myButtons.addButton( 310, 10, 100,  100, "SLEEP");
       {
       if ((y>=10)&&(y<=110)) 
        { 
        irsend.sendNEC(0xEF9867, 32);
        delay(200);
        }
       }



      if ((x>=160)&&(x<=210)) //           bpCIMA = myButtons.addButton( 160, 180, 50, 50, "C");
       {
       if ((y>=180)&&(y<=230)) 
        { 
        irsend.sendNEC(0xEF12ED, 32);
        delay(20);
        }
       }



      if ((x>=160)&&(x<=210)) //             bpBAIXO = myButtons.addButton( 160, 330, 50, 50, "B");
       {
       if ((y>=330)&&(y<=380)) 
        { 
        irsend.sendNEC(0xEF50AF, 32);
        delay(20);
        }
       }


      if ((x>=85)&&(x<=135)) //     bpESQUERDA = myButtons.addButton( 85, 255, 50, 50, "E");          
       {
       if ((y>=255)&&(y<=305)) 
        { 
        irsend.sendNEC(0xEFF00F, 32);
        delay(20);
        }
       }


      if ((x>=235)&&(x<=285)) //    bpDIREITA = myButtons.addButton( 235, 255, 50, 50, "D");   
       {
       if ((y>=255)&&(y<=305)) 
        { 
        irsend.sendNEC(0xEFE01F, 32);
        delay(20);
        }
       }


      if ((x>=160)&&(x<=210)) //      bpOK = myButtons.addButton( 160, 255, 50, 50, "Ok"); 
       {
       if ((y>=255)&&(y<=305)) 
        { 
        irsend.sendNEC(0xEFD02F, 32);
        delay(200);
        }
       }


 
 
 
 
      // COMANDO PARA VOLTAR A TELA CASA   
       if ((x>=730)&&(x<=800)) 
        {
         if ((y>=450)&&(y<=500)) 
          {
           tela_casa();
          }
        }

 
 
 
    }  // fecha o if touch pressionado

} // fecha o while   




// MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS  
// MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS  
// MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS  
// MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS  
// MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS   MAPEANDO BOTOES DOS CANAIS  

  while (telas==32) 
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 

//  bVOLTAR = myButtons.addButton( 550, 430, 200,  50, "Voltar");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=430)&&(y<=480)) 
        { 
          telas = 22; 
          tela_sky();
        }
        delay(50);
       }
       
//  b12 = myButtons.addButton( 50, 10, 200,  50, "BANDEIRANTES");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=10)&&(y<=60)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b13 = myButtons.addButton( 50, 70, 200,  50, "BIS");  
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=70)&&(y<=120)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b14 = myButtons.addButton( 50, 130, 200,  50, "BIS HD");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=130)&&(y<=180)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF48B7, 32);irsend.sendNEC(0xEFD02F, 32);
        }
        delay(50);
       }
 
//  b26 = myButtons.addButton( 50, 190, 200,  50, "COMBATE");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=190)&&(y<=240)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEF58A7, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }
/*
  b30 = myButtons.addButton( 50, 490, 200,  50, "DISC. CH");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=490)&&(y<=190)) 
        { 
        
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        
         irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEF2AD5, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }
*/

//  b31 = myButtons.addButton( 50, 250, 200,  50, "DISC. CH HD");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=250)&&(y<=300)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b34 = myButtons.addButton( 50, 310, 200,  50, "D THEATER HD");  
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=310)&&(y<=360)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEF48B7, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b35 = myButtons.addButton( 50, 370, 200,  50, "DISC. TURBO");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=370)&&(y<=420)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEF6897, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b53 = myButtons.addButton( 50, 430, 200,  50, "FOX SPORTS");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=430)&&(y<=480)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF6897, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b54 = myButtons.addButton( 300, 10, 200,  50, "FOX SPORTS 2");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=10)&&(y<=60)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF6897, 32);irsend.sendNEC(0xEF48B7, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b55 = myButtons.addButton( 300, 70, 200,  50, "FOX SPORTS HD");  
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=70)&&(y<=120)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF6897, 32);irsend.sendNEC(0xEF6897, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b60 = myButtons.addButton( 300, 130, 200,  50, "GLOBO MINAS");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=130)&&(y<=180)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF58A7, 32);irsend.sendNEC(0xEF2AD5, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b63 = myButtons.addButton( 300, 190, 200,  50, "GLOBO SP");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=190)&&(y<=240)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF58A7, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }
/*
  b92 = myButtons.addButton( 300, 490, 200,  50, "MULTISHOW");
      if ((x>=200)&&(x<=400)) 
       {
       if ((y>=60)&&(y<=190)) 
        { 
        
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        
         irsend.sendNEC(0xEFD827, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

       */

//  b93 = myButtons.addButton( 300, 250, 200,  50, "MULTISHOW HD");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=250)&&(y<=300)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEFD827, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b101 = myButtons.addButton( 300, 310, 200,  50, "OFF HD");  
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=310)&&(y<=360)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF2AD5, 32);irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b102 = myButtons.addButton( 300, 370, 200,  50, "OFF");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=370)&&(y<=420)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF2AD5, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b123 = myButtons.addButton( 300, 430, 200,  50, "RECORD");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=430)&&(y<=480)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }


//  b124 = myButtons.addButton( 550, 10, 200,  50, "REDE TV");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=10)&&(y<=60)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEF48B7, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b128 = myButtons.addButton( 550, 70, 200,  50, "SBT");  
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=70)&&(y<=120)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEFE817, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b135 = myButtons.addButton( 550, 130, 200,  50, "SPORT TV");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=130)&&(y<=180)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEF6897, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b136 = myButtons.addButton( 550, 190, 200,  50, "SPORT TV 2");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=190)&&(y<=240)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEF58A7, 32);irsend.sendNEC(0xEFD02F, 32);
        }
        delay(50);
       }
/*
  b138 = myButtons.addButton( 550, 490, 200,  50, "SPORT TV 3");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=60)&&(y<=190)) 
        { 
        
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF40BF, 32);irsend.sendNEC(0xEFE817, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }
*/

//  b142 = myButtons.addButton( 550, 250, 200,  50, "SPORT TV HD");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=250)&&(y<=310)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF48B7, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEFD02F, 32);

        }
        delay(50);
       }

//  b141 = myButtons.addButton( 550, 310, 200,  50, "SPORT TV2 HD");  
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=310)&&(y<=360)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEF48B7, 32);irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFD02F, 32);
        }
        delay(50);
       }

//  b192 = myButtons.addButton( 550, 370, 200,  50, "WARNER HD");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=370)&&(y<=420)) 
        { 
        /*
        1 - EF02FD 2 - EFC03F 3 - EF40BF 4 - EF48B7 5 - EF6897 6 - EF58A7 7 - EFC837 8 - EFE817 9 - EFD827 0 - EF2AD5 
        irsend.sendNEC(0x, 32); 
        */
         irsend.sendNEC(0xEF02FD, 32);irsend.sendNEC(0xEFD827, 32);irsend.sendNEC(0xEFC03F, 32);irsend.sendNEC(0xEFD02F, 32);
        }
        delay(50);
       }



delay(500);


      
    }  // fecha o if touch pressionado

  } // fecha o while   


//*********************************************************************************************************************************************************************

// MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR  
// MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR  
// MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR  
// MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR  
// MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR   MAPEIA TELA DO AR  

  while (telas==23) 

  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 

//  baliga = myButtons.addButton( 300,  50, 200,  80, "LIGAR/DESLIGAR");      
      if ((x>=200)&&(x<=400)) 
       {
       if ((y>=60)&&(y<=190)) 
        { 
        irsend.sendNEC(0x3FA15E, 32);
        delay(50);
        }
       }


//  baliga = myButtons.addButton( 300,  50, 200,  80, "LIGAR/DESLIGAR");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=50)&&(y<=130)) 
        { 
        irsend.sendNEC(0x3FA15E, 32);
        delay(50);
        }
       }

//  bavertical = myButtons.addButton( 50, 165 , 200,  80, "VERTICAL");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=165)&&(y<=245)) 
        { 
        irsend.sendNEC(0x3FC13E, 32);
        delay(50);
        }
       }

//  bahorizontal = myButtons.addButton( 50, 285, 200, 80, "HORIZONTAL");
      if ((x>=50)&&(x<=250)) 
       {
       if ((y>=285)&&(y<=365)) 
        { 
        irsend.sendNEC(0x3F41BE, 32);
        delay(50);
        }
       }


//  baventilador = myButtons.addButton( 300, 400, 200, 80, "VENTILADOR");
      if ((x>=300)&&(x<=500)) 
       {
       if ((y>=400)&&(y<=480)) 
        { 
        irsend.sendNEC(0x3F21DE, 32);
        delay(50);
        }
       }

//  batimer = myButtons.addButton( 550, 285, 200, 80, "TIMER");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=285)&&(y<=365)) 
        { 
        irsend.sendNEC(0x3F619E, 32);
        delay(50);
        }
       }
//  baumidade = myButtons.addButton( 550,  165, 200, 80, "UMIDADE");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=165)&&(y<=245)) 
        { 
        irsend.sendNEC(0x3FE11E, 32);
        delay(50);
        }
       }

//  bavoltar = myButtons.addButton( 300,  165, 200, 200, "VOLTAR");
     if ((x>=300)&&(x<=500)) 
        {
         if ((y>=165)&&(y<=365)) 
          {
           telas = 11;
            tela_casa();
          }
        }
    delay(500);
    }  // fecha o if touch pressionado
  } // fecha o while 


//*********************************************************************************************************************************************************************

// MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ 
// MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ 
// MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ 
// MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ 
// MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ  MAPEIA TELA DA LUZ 

  while (telas==24) 

  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 
      if ((x>=200)&&(x<=400)) 
       {
       if ((y>=60)&&(y<=190)) 
        { 
        irsend.sendNEC(0xFD52AD, 32);// lampada da garagem  
        delay(20);
       
        }
       }

       // COMANDO PARA VOLTAR AO INICIO   
       if ((x>=700)&&(x<=800)) 
        {
         if ((y>=420)&&(y<=500)) 
          {
           tela_casa();
          }
        }
 
//  bVOLTAR = myButtons.addButton( 550, 430, 200,  50, "Voltar");
      if ((x>=550)&&(x<=750)) 
       {
       if ((y>=430)&&(y<=480)) 
        { 
        tela_casa();
        }
        delay(50);
       }
 
 
 
    }  // fecha o if touch pressionado
  } // fecha o while   

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA    
// MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA    
// MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA    
// MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA     MAPEIA TELA DA CORTINA    

  while (telas==25) 
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 
           
            // abrir e parar
            if ((x>=200)&&(x<=400)) 
            {
             if ((y>=60)&&(y<=190)&&babrir_1==0) 
              { 
                myButtons.relabelButton(babrir, "PARAR", true);
                babrir_1 = 1;
                irsend.sendNEC(0xFDB847, 32); // cima do controle da TV PHILCO
                delay(500);
                loop();  
              }
             if ((y>=60)&&(y<=190)&&babrir_1)
              { 
                myButtons.relabelButton(babrir, "ABRIR", true);
                babrir_1 = 0;
                irsend.sendNEC(0xFDB847, 32); // cima do controle da TV PHILCO
                delay(500);
                loop();
              } 

            // fechar e para     
               if ((y>=260)&&(y<=400)&&bfechar_1==0) 
               { 
                myButtons.relabelButton(bfechar, "PARAR", true);
                bfechar_1 = 1;
                irsend.sendNEC(0xFDA25D, 32); // baixo do controle da TV PHILCO
                delay(500);
                loop();  
               }
              if ((y>=260)&&(y<=400)&&bfechar_1==1) 
               { 
                myButtons.relabelButton(bfechar, "FECHAR", true);
                bfechar_1 = 0;
                irsend.sendNEC(0xFDA25D, 32); // baixo do controle da TV PHILCO
                delay(50);
                loop();
               }
             }
            
          // COMANDO PARA VOLTAR AO INICIO   
            if ((x>=700)&&(x<=800)) 
            {
             if ((y>=420)&&(y<=500)) 
              {
              tela_casa();
              }
            }
          
          
            
    }  // fecha o if touch pressionado
  } // fecha o while   








// MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO  
// MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO  
// MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO  
// MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO   MAPEIA TELA DO PORTAO  

  while (telas==26) 
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
    {  // abre if touch disponivel
      myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
      x=myTouch.getX(); 
      y=myTouch.getY(); 
      if ((x>=200)&&(x<=400)) 
       {
       if ((y>=60)&&(y<=190)) 
        { 
         irsend.sendNEC(0xFD926D, 32);// portao pequeno
         delay(20);
          
        }
       }
       if ((x>=200)&&(x<=400)) 
        {
        if ((y>=260)&&(y<=400)) 
         { 
          irsend.sendNEC(0xFD32CD, 32);// portao grande
          delay(20);

         }
        }
       
       // COMANDO PARA VOLTAR AO INICIO   
       if ((x>=700)&&(x<=800)) 
        {
         if ((y>=420)&&(y<=500)) 
          {
           tela_casa();
          }
        }
 
    }  // fecha o if touch pressionado
  } // fecha o while   
    

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO   
// MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO   
// MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO   
// MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO   
// MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO    MAPEIA TELA DO CARRO   

  while (telas==2) 
  { // abre o while 
   if (myTouch.dataAvailable()==true) 
   {    

     myGLCD.desligaLCD();
     myGLCD.lcdOff();
     tela_principal(); 
   }
  } 
 





}  // fecha o if geral


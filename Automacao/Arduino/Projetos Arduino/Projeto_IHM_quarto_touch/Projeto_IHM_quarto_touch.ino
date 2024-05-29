//
//
// ...............................................  CONTROLE DE SAIDAS ATRAVES DO TOUCH SCREEN 5" ...............................................................................
//
//
// Produzido por: Bruno Gonçalves
// Data : 13/06/2014
// IDE: Arduino 1.5.6-r6
// Nome : Controle de 6 Saidas Touch Screen
//
//

// Bibliotecas usadas
#include <UTFT.h>           // Tela TTF
#include <UTouch.h>         // Touch Screen
#include <UTFT_Buttons.h>   // Botoes
#include <UTFT_Teclado.h>   // Teclado
//Fontes usadas
extern uint8_t Ubuntu[];

UTFT             Tela(ITDB50,38,39,40,41);         // Variavel da Tela 5.0 polegadas
UTouch           Touch(6,5,4,3,2);                 // Variavel do Touch Screen
UTFT_Buttons     Botao(&Tela, &Touch);             // Variavel dos botoes
UTFT_Teclado     Teclado(&Tela, &Touch, &Botao);   // Variavel do teclado

// Variaveis para controle das saidas
int contador1; //Contador para saida 1
int contador2; //Contador para saida 2
int contador3; //Contador para saida 3
int contador4; //Contador para saida 4
int contador5; //Contador para saida 5
int contador6; //Contador para saida 6
int tela;
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
void setup()
{ 
  Serial.begin(9600);  
  Touch.iniciarTouch();               // Inicia a tela Touch Screen            
  Touch.setPrecisao(PREC_MEDIUM); // Seta a precisão da tela para Média
  Tela.iniciaLCD(HORIZONTAL);         // Inicia o Painel LCD
  Tela.alteraContraste(100);

// Declarando dos pinos 7 ao 12 como saidas digitais
pinMode(7,OUTPUT);// Saida para o botao 1
pinMode(8,OUTPUT);// Saida para o botao 2
pinMode(9,OUTPUT);// Saida para o botao 3
pinMode(10,OUTPUT);// Saida para o botao 4
pinMode(11,OUTPUT);// Saida para o botao 5
pinMode(12,OUTPUT);// Saida para o botao 6
// Força saidas iniciarem desligadas
digitalWrite(7,LOW); // Força começar desligada
digitalWrite(8,LOW); // Força começar desligada
digitalWrite(9,LOW); // Força começar desligada
digitalWrite(10,LOW); // Força começar desligada
digitalWrite(11,LOW); // Força começar desligada
digitalWrite(12,LOW); // Força começar desligada

// Contadores para fazer as funções dos botões entre ON e OFF
contador1 = 0; //Contador para saida 1
contador2 = 0; //Contador para saida 2
contador3 = 0; //Contador para saida 3
contador4 = 0; //Contador para saida 4
contador5 = 0; //Contador para saida 5
contador6 = 0; //Contador para saida 6
tela = 20;
Serial.begin(9600);
}
// ----------------------------------------------------------------------------------------------------
void loop()  // Inicia o LOOP
{
  
  // Variaveis para criar os botões
    int Ba, Bb, Bc, Bd, Be, Bf,Bg,Bh,Br, BotaoPressionado;
    int Ba1, Bb1, Bc1, Bd1, Be1, Bf1,Bg1,Bh1,Br1, BotaoPressionado1;
    int Ba2, Bb2, Bc2, Bd2, Be2, Bf2,Bg2,Bh2,Br2, BotaoPressionado2;
    int Ba3, Bb3, Bc3, Bd3, Be3, Bf3,Bg3,Bh3,Br3, BotaoPressionado3;
    int Ba4, Bb4, Bc4, Bd4, Be4, Bf4,Bg4,Bh4,Br4, BotaoPressionado4;
    int Ba5, Bb5, Bc5, Bd5, Be5, Bf5,Bg5,Bh5,Br5, BotaoPressionado5;
    int Ba6, Bb6, Bc6, Bd6, Be6, Bf6,Bg6,Bh6,Br6, BotaoPressionado6;
    int Ba7, Bb7, Bc7, Bd7, Be7, Bf7,Bg7,Bh7,Br7, BotaoPressionado7;
    int Ba8, Bb8, Bc8, Bd8, Be8, Bf8,Bg8,Bh8,Br8, BotaoPressionado8;
  

  
 
 
 
 
  
 //IMPRIME DADOS NO DISPLAY TOUCH SCREEN 5" ................................................................................................................................. 
  while (true)
  {
    delay(10);
    
    if(tela==20)
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado == Ba)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 1;delay(100); // Vai pra tela da TV
         }
         
         if (BotaoPressionado == Bb)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 2;delay(100); // Vai pra tela da SKY
         }
         
         if (BotaoPressionado == Bc)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 3;delay(100); // Vai pra tela do AR
         }
         
         if (BotaoPressionado == Bd)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 4;delay(100);// Vai pra tela da Lampada Quarto
         }
         
         if (BotaoPressionado == Be)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 5;delay(100); // Vai pra tela portao pequeno
         }
         
         if (BotaoPressionado == Bf)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 6;delay(100); // Vai pra tela portao grande
         }
         
         if (BotaoPressionado == Bg)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 7;delay(100); // Vai pra tela lampada garagem
         }
         
         if (BotaoPressionado == Bh)
         {
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         tela = 8;delay(100); // Vai pra tela som/mesa
         }
         
         
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString(" CONTROLE TOUCH SCREEN   ", 10, 5);
     
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba = Botao.novoBotao(   60,  30,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, "   TV   ");  
     Bb = Botao.novoBotao(  150,  30,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, "  SKY   ");  
     Bc = Botao.novoBotao(  260,  30,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, "   AR   ");  
     Bd = Botao.novoBotao(  350,  30,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, "  LAMP  ");
     
     Be = Botao.novoBotao(   60,  320,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, " PORT P ");  
     Bf = Botao.novoBotao(  150,  320,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, " PORT G ");
     Bg = Botao.novoBotao(  260,  320,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, " LAMP G ");
     Bg = Botao.novoBotao(  360,  320,  250, 70, Ubuntu, VGA_BLACK,  VGA_LIME, "  SOM   ");    
     
     }
   } 
         
     
     
        
    else
    delay(10);
    
   
   
   // .......................................................................................................................................................................................
   
    if(tela==1) // TV
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado1 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado1 == Ba1)
         {
          Serial.println("Canal TV +");
          // Muda canal + TV
         }
         if (BotaoPressionado1 == Bb1)
         {
           Serial.println("Canal TV -");
          // Muda canal - TV
         }
         if (BotaoPressionado1 == Bc1)
         {
         Serial.println("Vol TV +");           
         // Aumenta vol
         }
         if (BotaoPressionado1 == Bd1)
         {
          Serial.println("Vol TV -");
          // Diminui vol
         }
         if (BotaoPressionado1 == Be1)
         {
           Serial.println("Sleep TV");         
          // programa sleep a cada aperto soma tempo na tv
         }
         if (BotaoPressionado1 == Bf1)
         {
           Serial.println("Mute TV");         
          // Coloca a TV em mudo
         }
         if (BotaoPressionado1 == Bg1)
         {
           Serial.println("Liga TV"); 
          // Liga Tv
         }
         if (BotaoPressionado1 == Bh1)
         {
           Serial.println("Desliga TV"); 
            // Desliga TV
         }
         if (BotaoPressionado1 == Br1)
         {
          Serial.println("Retornar a tela principal");
          tela = 20;delay(500); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("    CONTROLE DA TV PHILCO    ", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba1 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "CANAL +");  
     Bb1 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "CANAL -");  
     
     Bc1 = Botao.novoBotao(  190,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "VOL +");  
     Bd1 = Botao.novoBotao(  190, 310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "VOL -");
     
     Be1 = Botao.novoBotao(   320,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "SLEEP");  
     Bf1 = Botao.novoBotao(   320, 310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "MUTE");       
     
     Bg1 = Botao.novoBotao(   60,  590,  180, 100, Ubuntu, VGA_WHITE,  VGA_RED, "LIGA");         
     Bh1 = Botao.novoBotao(  190, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_RED, "DESLIGA");       
     Bh1 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }
  
  
  
   // .......................................................................................................................................................................................
    else
    delay(20);
    if(tela==2) // SKY
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado2 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado2 == Ba2)
         {
          Serial.println("Canal Sky +");
           delay(30); // Muda canal + TV
         }
         if (BotaoPressionado2 == Bb2)
         {
           Serial.println("Canal Sky -");
           delay(30); // Muda canal - TV
         }
         if (BotaoPressionado2 == Bc2)
         {
         Serial.println("Vol Sky +");           
         delay(30); // Aumenta vol
         }
         if (BotaoPressionado2 == Bd2)
         {
          Serial.println("Vol Sky -");
          delay(30); // Diminui vol
         }
         if (BotaoPressionado2 == Be2)
         {
           Serial.println("Sleep Sky");         
           delay(20); // programa sleep a cada aperto soma tempo na tv
         }
         if (BotaoPressionado2 == Bf2)
         {
           Serial.println("Mute Sky");         
           delay(30); // Coloca a TV em mudo
         }
         if (BotaoPressionado2 == Bg2)
         {
           Serial.println("Liga Sky"); 
           delay(30); // Liga Tv
         }
         if (BotaoPressionado2 == Bh2)
         {
           Serial.println("Desliga Sky"); 
           delay(30); // Desliga TV
         }
         if (BotaoPressionado2 == Br2)
         {
          Serial.println("Retornar a tela principal");
          tela = 20; // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DA SKY", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba2 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "CANAL +");  
     Bb2 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "CANAL -");  
     
     Bc2 = Botao.novoBotao(  190,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "VOL +");  
     Bd2 = Botao.novoBotao(  190, 310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "VOL -");
     
     Be2 = Botao.novoBotao(   320,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "SLEEP");  
     Bf2 = Botao.novoBotao(   320, 310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "MUTE");       
     
     Bg2 = Botao.novoBotao(   60,  590,  180, 100, Ubuntu, VGA_WHITE,  VGA_RED, "LIGA");         
     Bh2 = Botao.novoBotao(  190, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_RED, "DESLIGA");       
     Bh2 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }
  
  
  
   // .......................................................................................................................................................................................
    else
    delay(20);
    if(tela==3) // AR
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado3 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado3 == Ba3)
         {
         delay(30); // Muda canal + TV
         }
         if (BotaoPressionado3 == Bb3)
         {
         delay(30); // Muda canal - TV
         }
         if (BotaoPressionado3 == Bc3)
         {
         delay(30); // Aumenta vol
         }
         if (BotaoPressionado3 == Bd3)
         {
         delay(30); // Diminui vol
         }
         if (BotaoPressionado3 == Be3)
         {
         delay(20); // programa sleep a cada aperto soma tempo na tv
         }
         if (BotaoPressionado3 == Br3)
         {
         tela = 20;delay(30); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DO AR CONDICIONADO", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba3 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME,"LIGA");  
     Bb3 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "DESLIGA");  
     
     Bc3 = Botao.novoBotao(  190,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "VELOCIDADE");  
     Bd3 = Botao.novoBotao(  190, 310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "ALTURA");
     
     Be3 = Botao.novoBotao(   320,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "DIRECAO");  
     
     Bh3 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }
  



   // .......................................................................................................................................................................................
   else
   delay(20);
   if(tela==4) // LAMPADA QUARTO
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado4 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado4 == Ba4)
         {
         delay(30); // Muda canal + TV
         }
         if (BotaoPressionado4 == Bb4)
         {
         delay(30); // Muda canal - TV
         }
         if (BotaoPressionado4 == Br4)
         {
         tela = 20;delay(30); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DA LAMPADA QUARTO", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba4 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "LIGA");  
     Bb4 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "DESLIGA");  
     
     Bh4 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }
  



   // .......................................................................................................................................................................................
   
   else
   delay(20);
   if(tela==5) // PORTAO PEQUENO
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado5 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado5 == Ba5)
         {
         delay(30); // Muda canal + TV
         }
         if (BotaoPressionado5 == Br5)
         {
         tela = 20;delay(30); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DO PORTAO PEQUENO", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba5 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "ABRE");  
     
     Bh5 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
    }
   }



   // .......................................................................................................................................................................................
   
   else
   delay(20);
   if(tela==6) // PORTAO GRANDE
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado6 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado6 == Ba6)
         {
         delay(30); // Muda canal + TV
         }
         if (BotaoPressionado6 == Bb6)
         {
         delay(30); // Muda canal - TV
         }
         if (BotaoPressionado6 == Br6)
         {
         tela = 20;delay(30); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DO PORTAO GRANDE", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba6 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "ABRE");  
     Bb6 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "FECHA");  
     
     Bh6 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }




   // .......................................................................................................................................................................................
   
   else
   delay(20);
   if(tela==7) // LAMPADA GARAGEM
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado7 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado7 == Ba7)
         {
         delay(30); // Muda canal + TV
         }
         if (BotaoPressionado7 == Bb7)
         {
         delay(30); // Muda canal - TV
         }
         if (BotaoPressionado7 == Br7)
         {
         tela = 20;delay(30); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DA LAMPADA GARAGEM", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba7 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "LIGA");  
     Bb7 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "DESLIGA");  
          
     Bh7 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }




   // .......................................................................................................................................................................................
   
    else
    delay(20);
    if(tela==8) // CONTROLE DO SOM E MESA
    {
       if (Touch.telaPressionada() == true)
         {
          BotaoPressionado8 = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
          
         if (BotaoPressionado8 == Ba8)
         {
         delay(30); // Muda canal + TV
         }
         if (BotaoPressionado8 == Bb8)
         {
         delay(30); // Muda canal - TV
         }
         if (BotaoPressionado8 == Br8)
         {
         tela = 20;delay(30); // volta a tela principal
         Tela.preencherTela(VGA_BLACK);
         Botao.excluiTodosBotoes();  
         }
       
     
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("CONTROLE DO SOM E MESA", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba8 = Botao.novoBotao(   60,  30,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "LIGA");  
     Bb8 = Botao.novoBotao(   60,  310,  250, 100, Ubuntu, VGA_BLACK,  VGA_LIME, "DESLIGA");  
     Bh8 = Botao.novoBotao(  320, 590,  180, 100, Ubuntu, VGA_WHITE,  VGA_BLUE, "VOLTAR");           
     }
   }

  
 }// while
} // Fecha o LOOP


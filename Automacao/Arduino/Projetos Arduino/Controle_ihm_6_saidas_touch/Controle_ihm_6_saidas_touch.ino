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
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
void setup()
{ 
  Serial.begin(9600);  
  Touch.iniciarTouch();               // Inicia a tela Touch Screen            
  Touch.setPrecisao(PREC_EXTREME); // Seta a precisão da tela para Média
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
}
// ----------------------------------------------------------------------------------------------------
void loop()  // Inicia o LOOP
{
  
  // Variaveis para criar os botões
    int Ba, Bb, Bc, Bd, Be, Bf, BotaoPressionado;
  
  
  boolean sair = false;  
  
 
 
 
 
  
 //IMPRIME DADOS NO DISPLAY TOUCH SCREEN 5" ................................................................................................................................. 
  while (true)
  {
    
     Tela.preencherTela(VGA_BLACK);
     Botao.excluiTodosBotoes();  
  
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      Tela.molduraCheia(2, 1, 797, 40, VGA_BLUE, VGA_BLUE);
      Tela.alterarFonte(Ubuntu, VGA_WHITE, VGA_BLUE);  
      Tela.escreverString("  CONTROLE DE SAIDAS TOUCH   ", 10, 5);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba = Botao.novoBotao(  60,  10,  250, 200, Ubuntu, VGA_BLACK,  VGA_LIME, "SAIDA 1");  
     Bb = Botao.novoBotao(  60, 270,  250, 200, Ubuntu, VGA_BLACK,  VGA_LIME,   "SAIDA 2");  
     Bc = Botao.novoBotao(  60, 530,  250, 200, Ubuntu, VGA_BLACK,  VGA_LIME,   "SAIDA 3");  
     
     Bd = Botao.novoBotao( 270,  10,  250, 200, Ubuntu, VGA_BLACK, VGA_LIME,     "SAIDA 4");     
     Be = Botao.novoBotao( 270, 270,  250, 200, Ubuntu, VGA_BLACK, VGA_LIME,    "SAIDA 5");  
     Bf = Botao.novoBotao( 270, 530,  250, 200, Ubuntu, VGA_BLACK, VGA_LIME,    "SAIDA 6");       
     
     while(true) 
     {

  //COMANDOS PARA LIBERAR AS SAIDAS ..........................................................................................................................................
 
       
 //saida 1
 if(contador1==1)
 {
   digitalWrite(7,1);
 }
 if(contador1==2)
 {
   digitalWrite(7,0);
   contador1 = 0;
 }
 
  
  
   //saida 2
 if(contador2==1)
 {
   digitalWrite(8,1);
 }
 if(contador2==2)
 {
   digitalWrite(8,0);
   contador2 = 0;
 }
  
  
   //saida 3
 if(contador3==1)
 {
   digitalWrite(9,1);
 }
 if(contador3==2)
 {
   digitalWrite(9,0);
   contador3 = 0;
 }
  
  
  
   //saida 4
 if(contador4==1)
 {
   digitalWrite(10,1);
 }
 if(contador4==2)
 {
   digitalWrite(10,0);
   contador4 = 0;
 }
  
  
   //saida 5
 if(contador5==1)
 {
   digitalWrite(11,1);
 }
 if(contador5==2)
 {
   digitalWrite(11,0);
   contador5 = 0;
 }
  
  
   //saida 6
 if(contador6==1)
 {
   digitalWrite(12,1);
 }
 if(contador6==2)
 {
   digitalWrite(12,0);
   contador6 = 0;
 }
  
 
       
       //Verifica se algum lugar do touch foi pressionado, e se sim, apos isto verifica qual atraves das comparações abaixo
       if (Touch.telaPressionada() == true)
       {
         BotaoPressionado = Botao.verificaBotaoPressionado();// verifica qual botao foi pressionado abaixo
         
         
 // Comando para o botao SAIDA 1 .................................................................................................................................................        
        
         if (BotaoPressionado == Ba)
         {
          contador1++;delay(500);
          
         }
         else
         
 // Comando para o botao SAIDA 2 .................................................................................................................................................        
         
         if (BotaoPressionado == Bb)
         {
             contador2++;delay(500);
              
         }
         else
 // Comando para o botao SAIDA 3 .................................................................................................................................................       
         
         
         if (BotaoPressionado == Bc)
         {
             contador3++;delay(500);
              
         }
         else
         
// Comando para o botao SAIDA 4 .................................................................................................................................................         
        
         if (BotaoPressionado == Bd)
         {
              contador4++;delay(500);
             
         }
         else

// Comando para o botao SAIDA 5 .................................................................................................................................................         
         
         if (BotaoPressionado == Be)
         {
              contador5++;delay(500);
              
         }
         else

// Comando para o botao SAIDA 6 .................................................................................................................................................         
     
         if (BotaoPressionado == Bf)
         {
              contador6++;delay(500);
             
         }         
       }
     }
 }
} // Fecha o LOOP


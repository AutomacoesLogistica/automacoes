// Prototipo de Teste das Telas LCD de 3.2, 5.0 e 7.0 polegas
// Judson Michel Cunha
// Loja Arduino
// 29/05/2013

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//CORES DISPONÍVEIS PARA A TELA

// #define VGA_BLACK		0x0000  Preto
// #define VGA_WHITE		0xFFFF  Branco
// #define VGA_RED		0xF800  Vermelho
// #define VGA_GREEN		0x0400  Verde
// #define VGA_BLUE		0x001F  Azul
// #define VGA_SILVER		0xC618  Cinza Fraco 
// #define VGA_GRAY		0x8410  Cinza Medio
// #define VGA_MAROON		0x8000  Avermelhado
// #define VGA_YELLOW		0xFFE0  Amarelo
// #define VGA_OLIVE		0x8400  Verde Musgo
// #define VGA_LIME		0x07E0  Verde Claro
// #define VGA_AQUA		0x07FF  Azul bebe
// #define VGA_TEAL		0x0410  Azul fraco
// #define VGA_NAVY		0x0010  Azul forte, muito bonito
// #define VGA_FUCHSIA		0xF81F  Roxo Claro
// #define VGA_PURPLE		0x8010  Roxo Forte
// #define VGA_TRANSPARENT	        0xFFFFFFFF
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Imposta as bibliotecas necessarias

#include <UTFT.h>           // Tela TTF
#include <UTouch.h>         // Touch Screen
#include <UTFT_Buttons.h>   // Botoes
#include <UTFT_Teclado.h>   // Teclado

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Declara as Fontes DISPONIVEIS PARA A TELA

extern uint8_t OCR_A_Extended_M[];
extern uint8_t arial_bold[];
extern uint8_t Ubuntu[];

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// Declaração dos Dispositivos: TELA, TECLADO, BOTOES e TOUCH


//UTFT           Tela(ITDB32S,38,39,40,41);        // Variavel da Tela 3.2 polegadas, as mesma variáveis de 7.0 polegadas e 5.0 polegadas devem estar desabilitadas

//UTFT           Tela(TFT01_70,38,39,40,41);       // Variavel da Tela 7.0 polegadas, as mesma variáveis de 3.2 polegadas e 5.0 polegadas devem estar desabilitadas

UTFT             Tela(ITDB50,38,39,40,41);         // Variavel da Tela 5.0 polegadas, as mesma variáveis de 3.2 polegadas e 7.0 polegadas devem estar desabilitadas

UTouch           Touch(6,5,4,3,2);                 // Variavel do Touch Screen
UTFT_Buttons     Botao(&Tela, &Touch);             // Variavel dos botoes
UTFT_Teclado     Teclado(&Tela, &Touch, &Botao);   // Variavel do teclado

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

void setup()
{   
  Touch.iniciarTouch();               // Inicia a tela Touch Screen            
  Touch.setPrecisao(PREC_MEDIA); // Seta a precisão da tela para Média
  Tela.iniciaLCD(HORIZONTAL);         // Inicia o Painel LCD
  Tela.alteraContraste(100);
 Tela.escreverString("Bruno Goncalves", 10, 5);
  Tela.escreverString("Tecnico em Eletronica ", 20, 5);
   Tela.escreverString("Tel: (31)8849-4604 ", 30, 5);
    Tela.escreverString("Conselheiro Lafaiete ", 40, 5);
}

// ----------------------------------------------------------------------------------------------------

void loop()
{
  int Ba, Bb, Bc, Bd, Be, Bf,Bg,Bh, BotaoPressionado;
  boolean sair = false;  
  int Bv;
  while (true)
  {
    
     Tela.preencherTela(VGA_SILVER);
     Botao.excluiTodosBotoes();  
  
      // coluna, linha, largura, altura, largura da caixa de texto, cor fundo, cor letra, fonte, frase a ser escrita, alinhamento
      
      
      //coluna,linha,comprimento,altura,cor da caixa,cor da fonte
      Tela.molduraCheia(2, 5, 790, 40, VGA_BLUE, VGA_BLUE);

      //fonte, cor da fonte,cor do contorno da fonte
      Tela.alterarFonte(Ubuntu, VGA_WHITE,VGA_BLUE);  
      
      // Escreve a mensagem,
      Tela.escreverString("Sistema Monitoracao PC-BP-102", 10, 30);
     
                        // Lin, Col, Larg, Alt, Fonte, Cor Letra, CorFundo, Label
     Ba = Botao.novoBotao(   60,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");  
     Tela.escreverString("Mancal 1 = ", 65, 10);
     Bb = Botao.novoBotao(  110,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");  
     Bc = Botao.novoBotao(  160,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");  
     Bd = Botao.novoBotao(  210,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");  
     Be = Botao.novoBotao(  260,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");  
     Bf = Botao.novoBotao(  310,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");
     Bg = Botao.novoBotao(  360,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");
     Bh = Botao.novoBotao(  410,  10,  350, 40, Ubuntu, VGA_WHITE,  VGA_RED, "");

     
     while(true) 
     {

       if (Touch.telaPressionada() == true)
       {
         BotaoPressionado = Botao.verificaBotaoPressionado();
         if (BotaoPressionado==Ba)
         {
          Botao.novoBotao(  60,  10,  700, 300, Ubuntu, VGA_WHITE,  VGA_GREEN, "Bruno fdufidhsfhdsifhdsih");  delay(5000);
        
           break;
       }
         else
         if (BotaoPressionado == Bb)
         {
              digitalWrite(2, HIGH);
              Teclado.showMessage("", "BOTAO 02", "PRESSIONADO !", "", VGA_WHITE,  VGA_NAVY, Ubuntu, false);
              break;
         }
         else
         if (BotaoPressionado == Bc)
         {
              digitalWrite(3, HIGH);
              Teclado.showMessage("", "BOTAO 03", "PRESSIONADO !", "", VGA_WHITE,  VGA_NAVY, Ubuntu, false);
              break;
         }
         else
         if (BotaoPressionado == Bd)
         {
              digitalWrite(4, HIGH);
              Teclado.showMessage("", "BOTAO 04", "PRESSIONADO !", "", VGA_WHITE,  VGA_NAVY, Ubuntu, false);
              break;
         }
         else
         if (BotaoPressionado == Be)
         {
              digitalWrite(5, HIGH);
              Teclado.showMessage("", "BOTAO 05", "PRESSIONADO !", "", VGA_WHITE,  VGA_NAVY, Ubuntu, false);
              break;
         }
         else
         if (BotaoPressionado == Bf)
         {
              digitalWrite(6, HIGH);
              Teclado.showMessage("", "BOTAO 06", "PRESSIONADO !", "", VGA_WHITE,  VGA_NAVY, Ubuntu, false);
              break;
         }         
       }
     }
 }
}


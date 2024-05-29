#include <UTFT.h>
#include <UTFT_Geometry.h>

// Declara fontes a ser usadas
extern uint8_t SevenSegNumFont[];
extern uint8_t OCR_A_Extended_M[];
// Declara modelo do display
UTFT myGLCD(ITDB50,38,39,40,41);
int valor;
String valor1,valor2;
  int x,y;
void setup()
{
  myGLCD.InitLCD();
  myGLCD.setFont(OCR_A_Extended_M);
  myGLCD.setBackColor(VGA_BLUE);
  y=0;
  x=0;
  
   myGLCD.clrScr();
   myGLCD.fillRoundRect(0,0,799,50);
   myGLCD.setColor(VGA_BLACK);
   myGLCD.setBackColor(VGA_WHITE);
   myGLCD.print(" Maquina para Corte de MDF",190,10);
   myGLCD.setBackColor(VGA_BLACK);
 myGLCD.setColor(VGA_WHITE);
 myGLCD.print(" Distancia = ",10,90);
 myGLCD.setFont(SevenSegNumFont);
  myGLCD.setFont(OCR_A_Extended_M);
   myGLCD.print("mm",400,75);
  myGLCD.print("cm",740,75);  
  myGLCD.setBackColor(VGA_BLUE);
  myGLCD.fillRoundRect(0,200,150,300);
  myGLCD.fillRoundRect(649,200,799,300); 
   myGLCD.setFont(SevenSegNumFont);
}

void loop ()
{
 valor = analogRead(A0);
 
 valor1 = String(map(valor,0,1023,3000,0000));
 valor2 = String(map(valor,0,1023,300,000));

 myGLCD.fillRoundRect(240,75,380,140);
 myGLCD.setBackColor(VGA_BLACK);      
 myGLCD.setColor(VGA_WHITE);     
 myGLCD.setFont(SevenSegNumFont);
 myGLCD.print("0000",240,75); 
 myGLCD.print(valor1,240,75); 

 myGLCD.setFont(OCR_A_Extended_M);
 myGLCD.print(valor2,620,75); 
 


 delay(900);

  
}

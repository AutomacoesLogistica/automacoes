#include <UTFT.h>
#include <UTouch.h>
#include <UTFT_Buttons.h>

extern uint8_t SmallFont[];
extern uint8_t BigFont[];

UTFT          myGLCD(ITDB50,38,39,40,41);
UTouch        myTouch(6,5,4,3,2);
UTFT_Buttons  myButtons(&myGLCD, &myTouch);

int x,y;

void setup()
{
  myGLCD.InitLCD();
  myGLCD.clrScr();
  myGLCD.setFont(SmallFont);
  myTouch.InitTouch();
  myTouch.setPrecision(PREC_MEDIUM);
  myButtons.setTextFont(BigFont);

}

void loop()
{
  int but1, but2, but3, pressed_button;
  
  
  but1 = myButtons.addButton( 100,  50, 600,  50, "Bruno ");
  but2 = myButtons.addButton( 100, 150, 600,  50, "Fernanda");
  but3 = myButtons.addButton( 100, 250, 600, 50, "Sabrina");
 
 myButtons.drawButtons();


  myGLCD.setColor(VGA_BLACK);
  myGLCD.setBackColor(VGA_WHITE);


 while (1) 
{ // abre o while 
    
   if (myTouch.dataAvailable()==true) 
   {  // abre if touch disponivel
         
         myTouch.read();  // Le o ponto tocado e compara-o logo abaixo
         x=myTouch.getX(); 
         y=myTouch.getY(); 
        

    if ((x>=200)&&(x<=400)) 
    {
         if ((y>=60)&&(y<=90)) 
         { 
          myGLCD.print("Pressionado BRUNO", 110, 320);
          }
         delay(50);
    }
    
    
    if ((x>=200)&&(x<=400)) 
    {
    
         if ((y>=160)&&(y<=190)) 
         { 
          myGLCD.print("Pressionado FERNANDA", 110, 320);
          }
         delay(50);
    }    


    if ((x>=200)&&(x<=400)) 
    {
         if ((y>=260)&&(y<=290)) 
         { 
          myGLCD.print("Pressionado SABRINA", 110, 320);
          }
         delay(50);
    }



 
   }   
   }   
}




#include <UTFT.h>
int posicaoA,posicaoA1,posicaoB,posicaoB1;
int amplitudeA,amplitudeA1,amplitudeB,amplitudeB1;
int v;
 int canalA,canalA1;
 int canalB,canalB1;
 int CANAL_A,CANAL_B;
 int tempo_leitura,tempo_leitura1;
 double tensaoA,vezes_A;
 // Declare which fonts we will be using
extern uint8_t SmallFont[];

// Uncomment the next line for Arduino 2009/Uno
//UTFT myGLCD(ITDB43,19,18,17,16);   // Remember to change the model parameter to suit your display module!

// Uncomment the next line for Arduino Mega
UTFT myGLCD(ITDB50,38,39,40,41);   // Remember to change the model parameter to suit your display module!

void setup()
{
Serial.begin(9600);
   // Setup the LCD
   myGLCD.InitLCD();
   myGLCD.setFont(SmallFont);
   v=0;
   canalA,canalA1,canalB,canalB1 = 0;
   posicaoA,posicaoA1,posicaoB,posicaoB1 = 0;
   tempo_leitura,tempo_leitura1 = 0;
   CANAL_A,CANAL_B = 0;
  tensaoA,vezes_A=0;
   myGLCD.clrScr();
}

void loop()
{
  int buf1[1798];
  int buf2[1798];  
  int x, x2;
  int y, y2;
  int delayX;
  delayX=0;
 CANAL_A=1;  
  posicaoA,posicaoB = 239;// define a posição da onda na vertical,em 239 começa no centro da tela
  //amplitude = 220; // define o valir da amplitude da onda, 220 o valor máximo
  
 if (v==0) 
 {
   v=1; // muda para manter sempre 1 vez a execução
  myGLCD.clrScr();
  myGLCD.setColor(0, 93, 116);
  myGLCD.fillRect(700, 15, 799, 465);// espaço dados
  myGLCD.setColor(0, 0, 0);
  myGLCD.setBackColor(0,255,0);
  myGLCD.print("    Delay     ", 701, 18);
  myGLCD.print("  Tensao ChA  ", 701, 77);  
  myGLCD.print("  Tensao ChB  ", 701, 137);
  myGLCD.print("   Zoom ChA   ", 701, 197); 
  myGLCD.print("   Zoom ChB   ", 701, 257); 
  
  
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(720, 35, 779, 65);// espaço delay
  myGLCD.fillRect(720, 95, 779, 125);// espaço tensão ChA
  myGLCD.fillRect(720, 155, 779, 185);// espaço tensão ChB  
  myGLCD.fillRect(720, 215, 779, 245);// espaço Zoom ChA
  myGLCD.fillRect(720, 275, 779, 305);// espaço Zoom ChB    
  
  
  
  
  
  myGLCD.setColor(255, 0, 0);
  myGLCD.fillRect(0, 0, 799, 13);
  myGLCD.setColor(64, 64, 64);
  myGLCD.fillRect(0, 466, 799, 479);
  myGLCD.setColor(255, 255, 255);
  myGLCD.setBackColor(255, 0, 0);
  myGLCD.print("* Osciloscopio Bruno Goncalves *", CENTER, 1);
  myGLCD.setBackColor(64, 64, 64);
  myGLCD.setColor(255,255,0);
  myGLCD.print("< Bruno Goncalves - (31) 98369-1000 >", CENTER, 467);
 
  
  myGLCD.setColor(60, 194, 255);
  myGLCD.drawRect(0, 14, 698, 465);
  myGLCD.setColor(0,0,0);
  myGLCD.fillRect(1,15,698,464);
  myGLCD.setColor(60, 194, 255);
  myGLCD.setBackColor(0, 0, 0);
 //*************************************************************    
 // Desenha as linhas divisao
  myGLCD.drawLine(350, 15, 350, 464);
  myGLCD.drawLine(1, 239, 698, 239);
  myGLCD.setBackColor(255,255,255);
 //*************************************************************    
} 


// Draw a moving sinewave
  x=1;
  x2=1;


  if ( vezes_A >= 698)
 { 
  tensaoA = tensaoA/(698);
  double resptensaoA = ((5 * tensaoA)/1023);
  Serial.println(resptensaoA);
  resptensaoA = 0;
  tensaoA = 0;
  vezes_A = 0;
 }
 


    

  for (int i=1; i<=(698); i++) 
  {
   tensaoA = tensaoA+analogRead(A0);
   vezes_A++;
    //*********************************  Delay  ****************************
    // 
    //                                  
    tempo_leitura1 = analogRead(A6);  
    tempo_leitura = map(tempo_leitura1,0,1023,0,15); 
    
    delay(tempo_leitura);
    
    if (tempo_leitura< 10 && delayX == 0)
    {
    delayX = 1;  
    myGLCD.setColor(0, 0, 0);
    myGLCD.print("   ",735, 41);
    }
    if (tempo_leitura >= 10 && delayX == 1)
    {
     delayX = 0;
     myGLCD.setColor(0, 0, 0);
     myGLCD.print("   ",735, 41);
    } 
    String b = String(tempo_leitura);
    myGLCD.setColor(0, 0, 0);
    myGLCD.print(b +=" ms ",735, 41);  
  
    
    //*************************************************************
 
 
 
    x++;
    x2++;
     
       
    if (x==698)// posição final do grafico
    { 
      x=1;
     // Desenha as linhas divisao
     myGLCD.setColor(60, 194, 255);
     myGLCD.drawLine(350, 15, 350, 464);
     myGLCD.drawLine(1, 239, 698, 239);
    }
    if (x2==698)// posição final do grafico
    { 
     x2=1;
     // Desenha as linhas divisao
     myGLCD.setColor(60, 194, 255);     
     myGLCD.drawLine(350, 15, 350, 464);
     myGLCD.drawLine(1, 239, 698, 239);  
     }
    //*************************************************************    
    // Desenha a linha central, porem diminui a velocidade
    // myGLCD.setColor(0, 0, 255);
    // myGLCD.drawLine(1, 239, 798, 239);
    //*************************************************************
    //Limpa a tela
    myGLCD.setColor(0,0,0);//usado para limpar
    myGLCD.drawPixel(x,buf1[x ]);//usado para limpar 2
    myGLCD.drawPixel(x2,buf2[x2]);//usado para limpar canal B
   
   
    //*************************************************************
    //Amplitude
    amplitudeA1 = analogRead(A1);  
    amplitudeA = map(amplitudeA1,0,1023,0,220); 
    //Amplitude Canal B
    amplitudeB1 = analogRead(A3);  
    amplitudeB = map(amplitudeB1,0,1023,0,220); 

    //*************************************************************
    //Posição Canal A
    posicaoA = 239;
    //posicaoA1 = analogRead(A4);  
    //posicaoA = map(posicaoA1,0,1023,16,464); 
    //Posição Canal B
    //posicaoB1 = analogRead(A5);  
    //posicaoB = map(posicaoB1,0,1023,16,464); 

    //*************************************************************    
    //CANAL A 
   if ( CANAL_A == 1)
   { 
    myGLCD.setColor(255,255,0);// cor da senoide A
    canalA1 = analogRead(A0);  
    canalA = map(canalA1,1023,0,-90,90);
    y = posicaoA + (sin(((canalA)*3.14)/180)*(amplitudeA));// faz a senoide A
    myGLCD.drawPixel(x,y);// plota a senoide
    buf1[x]=y; // usado para limpar a senoide e criar a outra, sem ela, sobrescreve
   }  
   //*************************************************************    
   // CANAL B  
   if ( CANAL_B == 1)
   { 
    myGLCD.setColor(0,255,255);// cor da senoide B
    canalB1 = analogRead(A2);  
    canalB = map(canalB1,1023,0,-90,90);
    y2 = posicaoB + (sin(((canalB)*3.14)/180)*(amplitudeB));// faz a senoide
    myGLCD.drawPixel(x2,y2);// plota a senoide
    buf2[x2-1]=y2; // usado para limpar a senoide e criar a outra, sem ela, sobrescreve
   }
   //*************************************************************     
}

 
 }


/*
 * 
 * 
 * CODIGOS IR CENTRAL ROADSTAR 

          Power = FF08F7
          Mode = FF906F
          USB = FF9867
          Band = FFE817
          Atende = FF00FF
          Desliga = FF58A7
          vol+ = FFB24D
          vol- = FF48B7
          Sel = FF6897
          Menu = FF609F
          Play = FFF807
          Proximo = FFA857
          Anterior = FFD827

// CONEXOES DO ENCODER KY-040   
   
          +       -> 5V do Arduino
          GND     -> GND do Arduino
          DT      -> digital 8 Arduino
          CLK     -> digital 9 Arduino

// VALORES DA ENTRADA ANALOGICA A0 PARA EXECUTAR AS FUNCOES   
          Botao Proximo = 320
          Botao Anterior = 259
          Botao Bluetooth = 48
          Botao DVD = 343
          Botao FM = 525
          Botao EQ = 80
          Botao MUTE = 567
          Botao POWER = Entrada Digital
          Botao AUX = 10
          Botao APS = 418
          Botao GPS = 477
          Botao PIC = 158
          Botao Eject = 814
 

 
 
 
 
 
 
 
*/

int valorLidoAtual = 0;
int valorLidoAnteriormente = 0;
#include <IRremote.h>
#include <Encoder.h>
Encoder myEnc(5, 6); //CLK , DT
long oldPosition  = -999;
int pulsosVol = 2; // inicia com pouco

IRsend emissorIR;
void setup() 
{
 Serial.begin(9600);

}

void loop() 
{
 int c = analogRead(A0); // Fica lendo a analogica A0 para monitoramento dos botões
 if( c >7)
 {
 Serial.println(c);
 
 }
 long newPosition = myEnc.read();
 if (newPosition != oldPosition) 
 {
  oldPosition = newPosition;
  //Serial.println(newPosition);
  //Serial.print("  -  ");
  
  valorLidoAtual = newPosition;
  if (valorLidoAtual>(valorLidoAnteriormente+3)) //Aumenta volume
  {
  valorLidoAnteriormente = valorLidoAtual;  
   // Serial.println("Vol+");
    for (int x = 0;x<pulsosVol;x++)
    {
    emissorIR.sendNEC(0xFFB24D,32);delay(30);
    }
    
  }
  if (valorLidoAtual<(valorLidoAnteriormente-3)) // Diminui volume
  {
    valorLidoAnteriormente = valorLidoAtual;
    //Serial.println("Vol-");
    for (int x = 0;x<pulsosVol;x++)
    {
     emissorIR.sendNEC(0xFF48B7,32);delay(30);
    }
    
    
  }
  
  
  
 }







 // Mapeando os botoes

  
 //  Botao Proximo = 320
 if (c >318 && c< 322)
 {
  emissorIR.sendNEC(0xFFA857,32);
  delay(1000);
 }

 //  Botao Anterior = 259
 if (c >257 && c< 261)
 {
  emissorIR.sendNEC(0xFFD827,32);
  delay(1000);
 }

 // Botao Bluetooth = 48
 if (c >46 && c< 50)
 {
  emissorIR.sendNEC(0xFF00FF,32);
  delay(1000);
 }

 // Botao DVD = 343
 if (c >339 && c< 346)
 {
  emissorIR.sendNEC(0xFF9867,32);
  delay(1000);
 }

// Botao FM = 525
if (c >521 && c< 529)
 {
  emissorIR.sendNEC(0xFFE817,32);
  delay(1000);
 }

// Botao EQ = 80
if (c >78 && c< 84)
 {
  emissorIR.sendNEC(0xFF6897,32);
  delay(500);
 }


// Botao MUTE = 567
if (c >564 && c< 569)
 {
  for (int x = 0;x<70;x++)
  {
  emissorIR.sendNEC(0xFF48B7,32);
  delay(40);
  }
  delay(1000);
 }

// Botao APS = 418
if (c >415 && c< 420)
 {
  emissorIR.sendNEC(0xFF906F,32);
  delay(500);
 }


// Botao Eject = 814
if (c >809 && c< 818)
 {
  emissorIR.sendNEC(0xFF609F,32);
  delay(800);
 }


// Botao AUX = 10
if (c >9 && c< 11)
 {
  if (pulsosVol == 10)
  { 
   pulsosVol = 2; 
  }
  else
  {
   pulsosVol = 10; 
  }
  delay(1000);
 }



// Botao GPS 477
if (c >475 && c< 479)
 {
  //emissorIR.sendNEC(0xFF609F,32);
  delay(800);
 }

// Botao PIC = 158
if (c >156 && c< 160)
 {
  //emissorIR.sendNEC(0xFF609F,32);
  delay(800);
 }
 
 
} // Fecha o Loop

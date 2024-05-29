/*
 
15678149 - liga prodigy
volume +   15720479
volume -   15724559


16629823 - liga tv
volume +   16607383  
volume -   16603303

4170078 - liga ar
4153758 - timer ar


 
 * IRremote: IRsendDemo - demonstra o envio de codigos IR com IRsend
 * Um LED IR deve ser conectado a porta PWM 3 do Arduino.
 * Versao 0.1 Julho, 2009
 * Copyright 2009 Ken Shirriff
 * http://arcfn.com
 */

#include <IRremote.h>

IRsend irsend;
#include <IRremote.h>

int RECV_PIN = 11;// recebe o sinal do ir receptor pelo pino 11

IRrecv irrecv(RECV_PIN);
int ledpin=12;
decode_results recebido;

void setup()
{
  Serial.begin(9600);
pinMode(12,OUTPUT);
irrecv.enableIRIn();
}


void loop() {
if (irrecv.decode(&recebido)){
  Serial.println(recebido.value, DEC );
  Serial.println(recebido.value, HEX );
  irrecv.resume();
}  
 char v = recebido.value == 4186398;
  char valorlido = Serial.read();
  if (v) 
  irsend.sendNEC(0xEF3AC5, 32);
  if (recebido.value == 15686309||recebido.value == 4170078)  
digitalWrite (ledpin,1);
   if (valorlido == 'b'||recebido.value == 4153758)
   digitalWrite (ledpin,0);   

}




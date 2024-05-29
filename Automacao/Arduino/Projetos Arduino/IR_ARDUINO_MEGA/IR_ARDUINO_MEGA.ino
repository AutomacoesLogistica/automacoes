 
// Para Arduino MEGA, ligue o IR no pino 9
// 
//

#include <IRremote.h>

IRsend irsend;

void setup()
{
  Serial.begin(9600);
  pinMode(9,OUTPUT); //  Declara o pino 9 como saida
  analogWrite(9, LOW);//  Declara nivel baixo e usando sempre analogWrite e nao digitalwrita, pois se trata de sinal analogico
}

void loop() {
    char c = Serial.read();
    if (c == 'a'){
      irsend.sendNEC(0xEF6A95, 32); // se recebido " a " na serial, aumenta o volume da sky
      delay(100);
    }
    

}

      



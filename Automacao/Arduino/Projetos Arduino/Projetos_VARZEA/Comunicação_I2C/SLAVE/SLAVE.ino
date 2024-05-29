// Arduino UNO

#include <Wire.h>

void setup ()
{
Wire.begin(2); //Definindo ser o SLAVE e endereço 2
Wire.onRequest(requestEvent);
}


void loop()
{
delay(100);
}


void requestEvent()
{
  Serial.print("Solicitado Mensagem, Enviando!... " );
Wire.write("12345;");

}

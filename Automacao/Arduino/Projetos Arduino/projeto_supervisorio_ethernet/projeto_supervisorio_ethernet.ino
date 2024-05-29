#include <SPI.h>
#include "EthernetSupW5100.h"

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,2,5);
EthernetServer server(8085);

int portaLampada = 5;
int portaVentilador = 6;
int portaFechadura = 7;
int portaLampada1 = 2;
int portaLampada2 = 3;
int portaLampada3 = 4;
int portaLampada4 = 8;
int portaLampada5 = 9;
void setup()
{
  EthernetSupW5100.begin(mac, ip);
  server.begin();
  
  // Configurando portas dos botoes
  pinMode(portaLampada, OUTPUT);
  pinMode(portaLampada1, OUTPUT);
  pinMode(portaLampada2, OUTPUT);
  pinMode(portaLampada3, OUTPUT);
  pinMode(portaLampada4, OUTPUT);
  pinMode(portaLampada5, OUTPUT);
  pinMode(portaVentilador, OUTPUT);
  pinMode(portaFechadura, OUTPUT);
  
  // Estado incial das portas
  digitalWrite(portaLampada, LOW);
  digitalWrite(portaLampada1, LOW);
  digitalWrite(portaLampada2, LOW);
  digitalWrite(portaLampada3, LOW);
  digitalWrite(portaLampada4, LOW);
  digitalWrite(portaLampada5, LOW);
  digitalWrite(portaVentilador, LOW);
  digitalWrite(portaFechadura, LOW);
  
  // Registrando botoes
  //EthernetSupW5100.addButton(button pin, text on, text off, button type);
  EthernetSupW5100.addButton(portaLampada, "Liga Lampada", "Desliga Lampada", FLIP_BUTTON);
  EthernetSupW5100.addButton(portaVentilador, "Liga Ventilador", "Desliga Ventilador", FLIP_BUTTON);
  EthernetSupW5100.addButton(portaFechadura, "Abre Fechadura", "", SWITCH_BUTTON);
  EthernetSupW5100.addButton(portaLampada1, "Liga Lampada Sabrina", "Desliga Lampada Sabrina", FLIP_BUTTON);
  EthernetSupW5100.addButton(portaLampada2, "Liga Lampada copa", "Desliga Lampada copa", FLIP_BUTTON);
  EthernetSupW5100.addButton(portaLampada3, "Liga Lampada sala", "Desliga Lampada sala", FLIP_BUTTON);
  EthernetSupW5100.addButton(portaLampada4, "Liga Lampada cozinha", "Desliga Lampada cozinha", FLIP_BUTTON);
  EthernetSupW5100.addButton(portaLampada5, "Liga Lampada banheiro", "Desliga Lampada banheiro", FLIP_BUTTON);

}



void loop()
{
  // Carrega HTML
  EthernetSupW5100.loadHtml(server);
  
  // Verifica se algum botao foi pressionado
  int lastButton = EthernetSupW5100.getLastClickedButton();
  byte state = EthernetSupW5100.getButtonState(lastButton);
  
  // Executa o comando conforme o botao clicado
  if (lastButton == portaLampada)
  {
    digitalWrite(portaLampada, state);
  }
  if (lastButton == portaLampada1)
  {
    digitalWrite(portaLampada1, state);
  }
  if (lastButton == portaLampada2)
  {
    digitalWrite(portaLampada2, state);
  }  
  if (lastButton == portaLampada3)
  {
    digitalWrite(portaLampada3, state);
  }
  if (lastButton == portaLampada4)
  {
    digitalWrite(portaLampada4, state);
  }
  if (lastButton == portaLampada5)
  {
    digitalWrite(portaLampada5, state);
  }
  else if (lastButton == portaVentilador)
  {
    digitalWrite(portaVentilador, state);
  } 
  else if (lastButton == portaFechadura)
  {
    digitalWrite(portaFechadura, HIGH);
    delay(1000);
    digitalWrite(portaFechadura, LOW);
  }
  
  // Delay
  delay(10);
}

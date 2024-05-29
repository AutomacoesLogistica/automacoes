//Incluindo as bibliotecas necessárias
#include <Wire.h> 
#include <SSD1306.h>
//Incluindo os arquivos de imagem
#include "frame1.h"
#include "frame2.h"
#include "frame3.h"
#include "frame4.h"

//definições de posição da imagem e intervalo de transição
#define posX 21
#define posY 0
#define intervalo 500

SSD1306 display(0x3c, 4, 15); //Cria e ajusta o Objeto display

void setup()
{
  Serial.begin(115200);
  //O estado do GPIO16 é utilizado para controlar o display OLED
  pinMode(16, OUTPUT); // Define o pino o OLED como saida, pino o qual liga e desliga o display
  digitalWrite(16, LOW); // Desliga o display limpando suas configurações
  
  // ATENÇÃO
  //Para o OLED permanecer ligado, o GPIO16 deve permanecer HIGH
  //Deve estar em HIGH antes de chamar o display.init() e fazer as demais configurações,
  //não inverta a ordem
  digitalWrite(16, HIGH); // Liga o display
  display.init(); // Inicializa o display
  display.flipScreenVertically(); //inverte verticalmente a tela (opcional)
}

void loop() 
{
  Serial.println("loop");
  display.clear(); //limpa tela
  //carrega para o buffer o frame 1
  //usando as posições iniciais posX e posY
  //informa o tamanho da imagem com frame1_width e frame1_height
  //informa o nome da matriz que contem os bits da imagem, no caso frame1_bits
  display.drawXbm(posX, posY, frame1_width, frame1_height, frame1_bits); 
  //mostra o buffer no display
  display.display();
  //aguarda um intervalo antes de mostrar o próximo frame
  delay(intervalo);
  
  //repete o processo para todos os outros frames
  display.clear();
  display.drawXbm(posX, posY, frame2_width, frame2_height, frame2_bits);
  display.display();
  delay(intervalo);
  
  display.clear();
  display.drawXbm(posX, posY, frame3_width, frame3_height, frame3_bits);
  display.display();
  delay(intervalo);
  
  display.clear();
  display.drawXbm(posX, posY, frame4_width, frame4_height, frame4_bits);
  display.display();
  delay(intervalo);
}

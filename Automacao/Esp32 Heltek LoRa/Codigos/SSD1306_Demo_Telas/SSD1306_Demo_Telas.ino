#include <SPI.h> //responsável pela comunicação serial
#include <LoRa.h> //responsável pela comunicação com o WIFI Lora
#include <Wire.h>  //responsável pela comunicação i2c
#include "SSD1306.h" //responsável pela comunicação com o display
#include "images.h" //contém o logo para usarmos ao iniciar o display
SSD1306 display(0x3c, 4, 15); //Configuracao do display OLED

#define DEMO_DURATION 3000 // Define o tempo para cada tela de aprensentacao
typedef void (*Demo)(void);

int demoMode = 0; // Define a tela de demo
int counter = 1; // Contador para mudar entre telas

void setup() {
  Serial.begin(115200);
  Serial.println();
  //O estado do GPIO16 é utilizado para controlar o display OLED
  pinMode(16, OUTPUT); // Define o pino o OLED como saida, pino o qual liga e desliga o display
  digitalWrite(16, LOW); // Desliga o display limpando suas configurações
  
  // ATENÇÃO
  //Para o OLED permanecer ligado, o GPIO16 deve permanecer HIGH
  //Deve estar em HIGH antes de chamar o display.init() e fazer as demais configurações,
  //não inverta a ordem
  digitalWrite(16, HIGH); // Liga o display
  display.init();// Inicializa o display
  display.flipScreenVertically(); // Seta tela Vertical
  display.setFont(ArialMT_Plain_10);

}

void drawFontFaceDemo() 
{
 // Demo para escrever Hello World em 3 tamanhos na tela
 display.setTextAlignment(TEXT_ALIGN_LEFT); // Seta o alinhamento do texto a esquerda
 display.setFont(ArialMT_Plain_10); // Seleciona fonte ArialMT_Plain no tamanho 10
 display.drawString(0, 0, "Hello world");
 display.setFont(ArialMT_Plain_16); // Seleciona fonte ArialMT_Plain no tamanho 16
 display.drawString(0, 10, "Hello world");
 display.setFont(ArialMT_Plain_24); // Seleciona fonte ArialMT_Plain no tamanho 24
 display.drawString(0, 26, "Hello world");
}

void drawTextFlowDemo() 
{
 // Cria uma tela com mensagem 
 display.setFont(ArialMT_Plain_10);
 display.setTextAlignment(TEXT_ALIGN_LEFT);
 display.drawStringMaxWidth(0, 0, 128,"Nesta tela voce pode escrever o que quiser que ele quebra entre as linhas");
}

void drawTextAlignmentDemo()
{
 // Cria uma tela com demonstração de alinhamento de textos
 display.setFont(ArialMT_Plain_10); // Seta a fonte em tamanho 10
 display.setTextAlignment(TEXT_ALIGN_LEFT); // Define o texto alinhado a esquerda
 display.drawString(0, 10, "Alinhado Esquerda (0,10)"); // Escreve a mensagem na posicao x = 0 e y = 10
 display.setTextAlignment(TEXT_ALIGN_CENTER);// Define o texto alinhado no centro
 display.drawString(64, 22, "Alinhado Centro (64,22)"); // Escreve a mensagem na posicao x = 64 e y = 22
 display.setTextAlignment(TEXT_ALIGN_RIGHT);// Define o texto alinhado a direita
 display.drawString(128, 33, "Alinhado Direita (128,33)");// Escreve a mensagem na posicao x = 128 e y = 33
}

void drawRectDemo()
{
 // Demo da criacao de retas
 for (int i = 0; i < 10; i++) 
 {
  display.setPixel(i, i);
  display.setPixel(10 - i, i);
 }
 display.drawRect(12, 12, 20, 20);
 
 // Criando retangulo
 display.fillRect(14, 14, 17, 17);

 // Criando linha na horizontal
 display.drawHorizontalLine(0, 40, 20);

 // Criando linha na vertical
 display.drawVerticalLine(40, 0, 20);
}

void drawCircleDemo()
{
 // Tela exemplo da criacao de circulos
  for (int i=1; i < 8; i++) 
  {
   display.setColor(WHITE);
   display.drawCircle(32, 32, i*3);
   if (i % 2 == 0)
   {
    display.setColor(BLACK);
   }
   display.fillCircle(96, 32, 32 - i* 3);
  }
}

void drawProgressBarDemo() 
{
 //Criando Progress Bar 
 int progresso = (counter / 5) % 100;
 // Cria o Progress Bar
 display.drawProgressBar(0, 32, 120, 10, progresso);
 // Escreve o status do andamento de carregamento da progress bar
 display.setTextAlignment(TEXT_ALIGN_CENTER);
 display.drawString(64, 15, String(progress) + "%");
}

void drawImageDemo() 
{
 // see http://blog.squix.org/2015/05/esp8266-nodemcu-how-to-create-xbm.html
 // Carrega a imagem do logo Wifi
    display.drawXbm(34, 14, WiFi_Logo_width, WiFi_Logo_height, WiFi_Logo_bits);
}

Demo demos[] = {drawFontFaceDemo, drawTextFlowDemo, drawTextAlignmentDemo, drawRectDemo, drawCircleDemo, drawProgressBarDemo, drawImageDemo};
int demoLength = (sizeof(demos) / sizeof(Demo));
long timeSinceLastModeSwitch = 0;

void loop() {
  // clear the display
  display.clear();
  // draw the current demo method
  demos[demoMode]();

  display.setTextAlignment(TEXT_ALIGN_RIGHT);
  display.drawString(10, 128, String(millis()));
  // write the buffer to the display
  display.display();

  if (millis() - timeSinceLastModeSwitch > DEMO_DURATION) {
    demoMode = (demoMode + 1)  % demoLength;
    timeSinceLastModeSwitch = millis();
  }
  counter++;
  delay(10);
}

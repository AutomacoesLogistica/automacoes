/*
 * 
 *  CRIA BLUETOOTH COM NOME ESP32test
 *  
 *  BASTA CONECTAR E O DADO ENVIADO PELA CONEXAO BLUETOOTH SERA EXIBIDO NA SERIAL E O RECEBIDO NO DISPLAY OLED
 *  
 *  criado para ser usado com ESP32 LoRa OLED
 *  OBS: Não está usando o radio LoRa
 */


#include <SPI.h> //responsável pela comunicação serial
#include <Wire.h>  //responsável pela comunicação i2c
#include "SSD1306.h" //responsável pela comunicação com o display
#include "images.h" //contém o  WiFi_Logo para usarmos ao iniciar o display
#include "BluetoothSerial.h"

#if !defined(CONFIG_BT_ENABLED) || !defined(CONFIG_BLUEDROID_ENABLED)
#error Bluetooth is not enabled! Please run `make menuconfig` to and enable it
#endif
String readString,readString1;
String UltimaMensagemRecebida = "";
int numero = 0;
//Display OLED: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); // Configura a porta do display OLED

BluetoothSerial SerialBT;

void setup() 
{
 Serial.begin(115200);
 pinMode(16,OUTPUT); // Define a porta de alimentação do display OLED como saida
 digitalWrite(16, LOW); // Desliga para dar um reset em qualquer configuracao existente no display
 delay(50); 
 digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH
 display.init(); // Inicia o display OLED
 display.flipScreenVertically();  
 display.setTextAlignment(TEXT_ALIGN_LEFT);
 display.setFont(ArialMT_Plain_16);
 Logo(); // Chama o void para criar a logo na tela
 display.clear(); // Limpa o display
 SerialBT.begin("ESP32test"); //Bluetooth device name
 display.drawString(0, 0, "Bluetooth Ativado!");
 display.drawString(0, 16, "SSID : ");
 display.drawString(0, 40, "ESP32teste");
 display.display(); //mostra o conteúdo na tela
 Serial.println("Foi ativado a conexao Bluetooth!");
 Serial.println("SSID : ESP32test");
 delay(5000);
}

void loop() 
{
 display.clear();//apaga o conteúdo do display
 display.drawString(0, 0, "Dado Recebido: ");
 display.drawString(0, 16, ">  ");
 display.drawString(15, 16, UltimaMensagemRecebida);
 display.drawString(0, 32, "Msg Recebidas :");
 display.drawString(0, 48, ">  ");
 display.drawString(15, 48, String(numero));
 display.display(); //mostra o conteúdo na tela
 
  
  
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c; 
  }

  while (SerialBT.available()) 
  {
   delay(3);  
   char c = SerialBT.read();
   readString1 += c; 
  }
  
  if (readString.length() >0)  // Caso existe dados a serem enviados, ou seja, caso digitou algo na serial, ele envia pelo bluetooth
  {
   SerialBT.println(readString); // Envia no bluetooth a mensagem digitada na serial
   readString=""; //Limpa a mensagem para ficar disponivel para receber uma nova
  } 
  
  if (readString1.length() >0)// Caso exista alguma mensagem recebida pelo bluetooth, imprime na serial
  {
   numero++; 
   Serial.write(SerialBT.read()); // Imprime na serial o dado recebido pela conexão bluetooth
   UltimaMensagemRecebida = readString1 ;
   readString1 = ""; //Limpa a mensagem para ficar disponivel para receber uma nova
  }
  
} // Fecha Loop

void Logo()
{
 display.clear();// Limpa o display
 display.drawXbm(15,0, Imagem_IoT_width, Imagem_IoT_height, Imagem_IoT_bits); // Cria a imagem
 display.display(); // Atualiza o display
 delay(3000);
}

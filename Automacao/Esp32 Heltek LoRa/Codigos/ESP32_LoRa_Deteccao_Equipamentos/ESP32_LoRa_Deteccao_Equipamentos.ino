#include <SPI.h>
#include <LoRa.h>
#include <Wire.h>

//Deixe esta linha descomentada para compilar o Master
//Comente ou remova para compilar o Slave
//#define MASTER
#define SCK 5   // GPIO5  SCK

#define MISO 19 // GPIO19 MISO
#define MOSI 27 // GPIO27 MOSI
#define SS 18   // GPIO18 CS
#define RST 14  // GPIO14 RESET
#define DI00 26 // GPIO26 IRQ(Interrupt Request)
#define BAND 915E6 //Frequência do radio - exemplo : 433E6, 868E6, 915E6

const String GETDATA = "getdata";
const String SETDATA = "setdata=";

void setupLoRa()
{ 
 SPI.begin(SCK, MISO, MOSI, SS);
 LoRa.setPins(SS, RST, DI00);
 if (!LoRa.begin(BAND))
 {
  Serial.println("Erro ao inicializar o LoRa!");
  while (1);
 }
 LoRa.enableCrc();
 LoRa.receive();
}

#include <Wire.h>
#include <EEPROM.h>
#include <SPI.h>
#include <SD.h>
String readString;
unsigned int registro;
unsigned int valor;
byte hiByte;
byte loByte;
File myFile;

void setup() {
  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }
  //Serial.print("Inicializando o cartao SD");
  if (!SD.begin(4)) 
  {
  //  Serial.println("A inicalizacao falhou! ");
    return;
  }
  //Serial.println("Inicializacao completa!");
  int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0));
  int loByte1 = EEPROM.read(1); 
  valor = ((hiByte1)+(loByte1));
  registro = valor;
}

void loop()
{
  while (Serial.available())
  {
    delay(3);
    char c = Serial.read();
    readString += c;
  }
  if (readString.length() > 0)
  {
    if (readString == "p")  // Solicitado impressão dos dados do cartao
    {
      myFile = SD.open("Banco_01.txt");
      if (myFile)
      {
        Serial.println();
        Serial.println("Imprimindo os dados encontrados no cartão: ");
        while (myFile.available())
        {
          Serial.write(myFile.read());
        }
        myFile.close();
      }
      else
      {
        Serial.println("Erro ao abrir o arquivo Banco_01.txt");
      }
    }
    if (readString == "r")  // Reiniciar sistema
    {
    setup();
    }
    if (readString == "z")  // Zerar a eeprom
    {
     registro = 0;
     hiByte = highByte(registro);
     loByte = lowByte(registro);
     EEPROM.write(0,hiByte);
     EEPROM.write(1,loByte);
     Serial.println("A EEPROM foi zerada, a partir de agora basta desligar o sistema!");
     for (int i=0;i<10;i++)
     {
      Serial.print(" . ");
      delay(500);
     }
     setup();
    }
    readString = "";
  }

  myFile = SD.open("Banco_01.txt", FILE_WRITE); // Maximo é 8 caracteres
  if (myFile) // Se encontrar o arquivo entra e salva
  {
    registro = registro+1;
    myFile.print(registro);
    myFile.print(" - ");
    myFile.println(millis() / 1000);
    myFile.close();
    hiByte = highByte(registro);
    loByte = lowByte(registro);
    EEPROM.write(0,hiByte);
    EEPROM.write(1,loByte);
    
    
  }
  else // Senao da erro
  {
    Serial.println("Erro ao abrir o arquivo Banco_01.txt");
  }
  delay(3000);
}



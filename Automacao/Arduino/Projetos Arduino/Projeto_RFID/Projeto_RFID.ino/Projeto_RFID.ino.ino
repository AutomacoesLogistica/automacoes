/*
 * SCA - Pino 10
 * SCK - Pino 13
 * MOSI - Pino 11
 * MISO - Pino 12
 * IRQ - Nao utilizado
 * RST - Pino 9
 * VCC - 3.3v    -      Não utilizar 5V pois queima
 * 
 * 
 * 
 */


 
#include <AddicoreRFID.h>
#include <SPI.h>

#define  uchar unsigned char
#define uint  unsigned int

uchar fifobytes;
uchar fifoValue;

AddicoreRFID myRFID; // Cria um modulo RFID
/////////////////////////////////////////////////////////////////////
//set the pins
/////////////////////////////////////////////////////////////////////
const int AtivaRFID = 10;
const int RST = 9;

// O comprimento máximo da matriz
#define MAX_LEN 16

void setup() 
{                
 Serial.begin(9600);                        // Inicia serial em 9600
 SPI.begin(); // Inicia a biblioteca
 pinMode(AtivaRFID,OUTPUT);              // Define o pino digital 10 como saída para conectá-lo ao RFID / ATIVAR 
 digitalWrite(AtivaRFID, LOW);         // Ativa o leitor RFID
 pinMode(RST,OUTPUT);                     // Seta o pino para não resetar, em LOW reseta
 digitalWrite(RST, HIGH);

  myRFID.AddicoreRFID_Init();  // Inicia RFID
}

void loop()
{
 uchar i, tmp, checksum1;
 uchar status;
 uchar str[MAX_LEN];
 uchar RC_size;
 uchar blockAddr; // Endereço de bloco operação de seleção 0 a 63
 String mynum = "";
 str[1] = 0x4400;

// Encontre tag's , tipo de tag de retorno
 status = myRFID.AddicoreRFID_Request(PICC_REQIDL, str);  
  
// Se estiver tudo ok com o RFID imprime os dados de leitura
  if (status == MI_OK)
  {
   Serial.println("RFID Detectado");
   Serial.print("Tag do Tipo:\t\t");// Comando \t é tab
   uint tagType = str[0] << 8;
   tagType = tagType + str[1];
       
          switch (tagType) 
          {
            case 0x4400:
              Serial.println("Mifare UltraLight");
              break;
            case 0x400:
              Serial.println("Mifare One (S50)");
              break;
            case 0x200:
              Serial.println("Mifare One (S70)");
              break;
            case 0x800:
              Serial.println("Mifare Pro (X)");
              break;
            case 0x4403:
              Serial.println("Mifare DESFire");
              break;
            default:
              Serial.println("Tag Desconhecida");
              break;
          }
  }

  // Tag retorna numero de série de 4 Bytes
   status = myRFID.AddicoreRFID_Anticoll(str);
  
  if (status == MI_OK)
  {
          checksum1 = str[0] ^ str[1] ^ str[2] ^ str[3];
          Serial.print("O numero da TAG e:\t");
          Serial.print(str[0]); // Primeiro byte da tag
          Serial.print(",");
          Serial.print(str[1]);// Segundo byte da tag
          Serial.print(",");
          Serial.print(str[2]);// Terceiro byte da tag
          Serial.print(",");
          Serial.println(str[3]);// Quarto byte da tag

          Serial.print("Checksum lido:\t\t");
          Serial.println(str[4]); // Byte referente ao checksum lido
          Serial.print("Checksum Calculado:\t");
          Serial.println(checksum1);
            
            // Verificando os pares , Para ler o 1 usar str[0],Para ler o 2 usar str[1],Para ler o 3 usar str[2],Para ler o 4 usar str[3]
            if (str[0] == 141 && str[1] == 85 && str[2] == 15 && str[3] == 43) 
            {
              
             Serial.println("Bem Vindo Bruno");
            } 
            
            else if (str[0] == 197 && str[1] == 87 && str[2] == 176 && str[3] == 117)    
            {
             Serial.println(" Bem Vindo Amanda!");
            }
            
             else if (str[0] == 240 && str[1] == 247 && str[2] == 243 && str[3] == 178)    
            {
             Serial.println(" Bem Vindo Francisco!");
            }

            Serial.println();// Imprime uma linha vazia
            delay(1000);
  }
    
        myRFID.AddicoreRFID_Halt();      // Comando para hibernar a tag              

}


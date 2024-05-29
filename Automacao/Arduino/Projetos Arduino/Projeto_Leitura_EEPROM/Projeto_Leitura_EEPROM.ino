// Lendo EEPROM
#include <EEPROM.h>

int valor;

void setup() 
{
 // Codigo para leitura da EEPROM
int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0)); // Nao alterar
int loByte1 = EEPROM.read(1); 
valor = ((hiByte1)+(loByte1));// Pega a parte inteira mais o resto e soma em um unico inteiro

Serial.begin (9600);

}

void loop() 
{
Serial.println(valor);
}

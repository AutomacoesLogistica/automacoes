/*
 * 
 *  RECEPÇÃO DE DADOS POR I2C
 *  ESTE MODULO É CONSIDERADO UM SLAVE ( ESCRAVO )
 * 
 * 
 */


#include <Wire.h>
#define Slave_01 0x08 //endereço para recepção de dados, mesmo utilizado no codigo do mestre para que a mensagem seja redirecionada

String readString; // String para receber e concatenar os dados da serial
int pisca = 0;

void setup()
{
  
  Wire.begin(Slave_01); // Roda no endereco do primeiro slave definido no codigo do mestre
  Wire.onReceive(DadosRecebidos); // DadosRecebido é um void para receber e tratar os dados
  Serial.begin(115200); // Tem que ser a mesma velocidade da serial do mestre
  pinMode(13, OUTPUT); // Led definido como saida
  digitalWrite(13, 0);
  readString = ""; // Inicia a variavel limpa

}

void loop()
{
 if (pisca == 1)
 {
  digitalWrite(13,1);
  delay(200);
  digitalWrite(13,0);
  delay(200);
 }
  
}  



// VOID PARA RECEBER OS DADOS ****************************************************************************************************************************************************
void DadosRecebidos(int dados)
{
  while (Wire.available())
  {
    char c = Wire.read();
    readString += c;
  }

  if (readString.length() > 0)
  {
    Serial.print("Recebido da rede : ");
    Serial.println(readString);
    
    if (readString == "Liga_lampada_teto")
    {
     digitalWrite(13,1);   
    }
    if (readString == "Desliga_lampada_teto")
    {
     digitalWrite(13,0);   
    }

    if (readString == "Pisca_lampada_teto")
    {
     pisca = 1;
    }
    if (readString == "Sair_lampada_teto")
    {
     pisca = 0;
    }

    readString = ""; // Sempre limpa a variavel
  }
}

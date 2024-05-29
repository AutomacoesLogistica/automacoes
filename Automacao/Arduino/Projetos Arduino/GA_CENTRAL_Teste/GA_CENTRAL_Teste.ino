
// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN 9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção
// inclui a biblioteca LiquidCrystal:
#include <LiquidCrystal.h>
// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);
String readString;
int modo;
int x; 
int SINAIS[30]; // usada para receber os comandos enviados

void setup()
{
Serial.begin(9600);
delay(10);
// configura o numero de colunas e linhas do LCD: 
lcd.begin(20, 4);
radio.begin();
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;
modo=0;
lcd.setCursor(0, 0);lcd.print(" ");lcd.setCursor(0, 0);lcd.print("   GA Automacoes    ");
}

void loop()
{
if(x==-111)
{
Serial.println("sistema");
delay(1000);
setup();
}  
  
  
  
while (Serial.available()) 
{
delay(3); 
char c = Serial.read();
readString+=c; 
}

//**************************************************************************************************************************************************************************************
if(Serial.available()>0)
{Serial.println(readString);}
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 0
if (readString.indexOf("voltar")>=0)
{
lcd.setCursor(0, 1);lcd.print("                    ");
  readString="";
}


if (readString.indexOf("pp")>=0)
{
Serial.println("OKOKOKOKOKOK");
readString="";
}


if (readString.indexOf("sincronizar")>=0)
{
x=50;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
if (readString.indexOf("check")>=0&&x!=-50&&modo!=-50)
{
x=-50;
modo=1;
readString="";
}
if (readString.indexOf("check")>=0&&x==-50&&x==-50)
{
// entra sincronizando para voltar a rodar
x=50;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA RESETAR
if (readString.indexOf("reset")>=0) 
{
  lcd.clear();
lcd.setCursor(0, 0);lcd.print(" ");lcd.setCursor(0, 0);lcd.print("Resetando o Sistema!");delay(2000);
lcd.clear();
x=100;
modo=1;
readString="";
}
//****************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA RESETAR
if (readString.indexOf("viagem")>=0) 
{
lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("   Em Modo Viagem!  ");
x=-100;
modo=1;
readString="";
}
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA RESETAR
if (readString.indexOf("sair")>=0) 
{
lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("Saindo Modo Viagem! ");delay(2000);
readString="";
x=-111;
}





// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 0
if (readString.indexOf("SINAIS[0]")>=0) 
{
x=0;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 1
if (readString.indexOf("SINAIS[1]")>=0) 
{
x=1;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 2
if (readString.indexOf("SINAIS[2]")>=0) 
{
x=2;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 3
if (readString.indexOf("SINAIS[3]")>=0) 
{
x=3;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 4
if (readString.indexOf("SINAIS[4]")>=0) 
{
x=4;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 5
if (readString.indexOf("SINAIS[5]")>=0) 
{
x=5;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 6
if (readString.indexOf("SINAIS[6]")>=0) 
{
x=6;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 7
if (readString.indexOf("SINAIS[7]")>=0) 
{
x=7;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 8
if (readString.indexOf("SINAIS[8]")>=0) 
{
x=8;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
// SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 9
if (readString.indexOf("SINAIS[9]")>=0) 
{
x=9;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 10
if (readString.indexOf("SINAIS[10]")>=0) 
{
x=10;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 11
if (readString.indexOf("SINAIS[11]")>=0) 
{
x=11;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 12
if (readString.indexOf("SINAIS[12]")>=0) 
{
x=12;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 13
if (readString.indexOf("SINAIS[13]")>=0) 
{
x=13;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 14
if (readString.indexOf("SINAIS[14]")>=0) 
{
x=14;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 15
if (readString.indexOf("SINAIS[15]")>=0) 
{
x=15;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 16
if (readString.indexOf("SINAIS[16]")>=0) 
{
x=16;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 17
if (readString.indexOf("SINAIS[17]")>=0) 
{
x=17;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 18
if (readString.indexOf("SINAIS[18]")>=0) 
{
x=18;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 19
if (readString.indexOf("SINAIS[19]")>=0) 
{
x=19;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 20
if (readString.indexOf("SINAIS[20]")>=0) 
{
x=20;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 21
if (readString.indexOf("SINAIS[21]")>=0) 
{
x=21;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 22
if (readString.indexOf("SINAIS[22]")>=0) 
{
x=22;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 23
if (readString.indexOf("SINAIS[23]")>=0) 
{
x=23;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 24
if (readString.indexOf("SINAIS[24]")>=0) 
{
x=24;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 25
if (readString.indexOf("SINAIS[25]")>=0) 
{
x=25;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 26
if (readString.indexOf("SINAIS[26]")>=0) 
{
x=26;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 27
if (readString.indexOf("SINAIS[27]")>=0) 
{
x=27;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 28
if (readString.indexOf("SINAIS[28]")>=0) 
{
x=28;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 29
if (readString.indexOf("SINAIS[29]")>=0) 
{
x=29;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************
//SE RECEBER COMANDO POR BLUETOOTH OU ETHERNET PARA ALTERAR O ESTADO DO CANAL 30
if (readString.indexOf("SINAIS[30]")>=0) 
{
x=30;
modo=1;
readString="";
}
//**************************************************************************************************************************************************************************************







/*

if (radio.available()&&modo==0) 
{
radio.read( SINAIS, sizeof(SINAIS) );


// Usado para atualizar supervisorios, comando enviado pelos transmissores
if(SINAIS[0]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[0]=1");delay(10); 
Serial.println("SINAIS[0]=1");
}
if(SINAIS[0]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[0]=0");delay(10); 
Serial.println("SINAIS[0]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[1]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[1]=1");delay(10); 
Serial.println("SINAIS[1]=1");
}
if(SINAIS[1]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[1]=0");delay(10); 
Serial.println("SINAIS[1]=0");
}
if(SINAIS[2]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[2]=1");delay(10); 
Serial.println("SINAIS[2]=1");
}
if(SINAIS[2]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[2]=0");delay(10); 
Serial.println("SINAIS[2]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[3]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[3]=1");delay(10); 
Serial.println("SINAIS[3]=1");
}
if(SINAIS[3]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[3]=0");delay(10); 
Serial.println("SINAIS[3]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[4]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[4]=1");delay(10); 
Serial.println("SINAIS[4]=1");
}
if(SINAIS[4]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[4]=0");delay(10); 
Serial.println("SINAIS[4]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[5]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[5]=1");delay(10); 
Serial.println("SINAIS[5]=1");
}
if(SINAIS[5]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[5]=0");delay(10); 
Serial.println("SINAIS[5]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[6]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[6]=1");delay(10); 
Serial.println("SINAIS[6]=1");
}
if(SINAIS[6]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[6]=0");delay(10); 
Serial.println("SINAIS[6]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[7]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[7]=1");delay(10); 
Serial.println("SINAIS[7]=1");
}
if(SINAIS[7]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[7]=0");delay(10); 
Serial.println("SINAIS[7]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[8]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[8]=1");delay(10); 
Serial.println("SINAIS[8]=1");
}
if(SINAIS[8]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[8]=0");delay(10); 
Serial.println("SINAIS[8]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[9]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[9]=1");delay(10); 
Serial.println("SINAIS[9]=1");
}
if(SINAIS[9]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[9]=0");delay(10); 
Serial.println("SINAIS[9]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[10]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[10]=1");delay(10); 
Serial.println("SINAIS[10]=1");
}
if(SINAIS[10]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[10]=0");delay(10); 
Serial.println("SINAIS[10]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[11]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[11]=1");delay(10); 
Serial.println("SINAIS[11]=1");
}
if(SINAIS[11]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[11]=0");delay(10); 
Serial.println("SINAIS[11]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[12]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[12]=1");delay(10); 
Serial.println("SINAIS[12]=1");
}
if(SINAIS[12]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[12]=0");delay(10); 
Serial.println("SINAIS[12]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[13]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[13]=1");delay(10); 
Serial.println("SINAIS[13]=1");
}
if(SINAIS[13]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[13]=0");delay(10); 
Serial.println("SINAIS[13]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[14]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[14]=1");delay(10); 
Serial.println("SINAIS[14]=1");
}
if(SINAIS[14]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[14]=0");delay(10); 
Serial.println("SINAIS[14]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[15]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[15]=1");delay(10); 
Serial.println("SINAIS[15]=1");
}
if(SINAIS[15]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[15]=0");delay(10); 
Serial.println("SINAIS[15]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[16]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[16]=1");delay(10); 
Serial.println("SINAIS[16]=1");
}
if(SINAIS[16]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[16]=0");delay(10); 
Serial.println("SINAIS[16]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[17]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[17]=1");delay(10); 
Serial.println("SINAIS[17]=1");
}
if(SINAIS[17]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[17]=0");delay(10); 
Serial.println("SINAIS[17]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[18]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[18]=1");delay(10); 
Serial.println("SINAIS[18]=1");
}
if(SINAIS[18]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[18]=0");delay(10); 
Serial.println("SINAIS[18]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[19]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[19]=1");delay(10); 
Serial.println("SINAIS[19]=1");
}
if(SINAIS[19]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[19]=0");delay(10); 
Serial.println("SINAIS[19]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[20]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[20]=1");delay(10); 
Serial.println("SINAIS[20]=1");
}
if(SINAIS[20]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[20]=0");delay(10); 
Serial.println("SINAIS[20]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[21]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[21]=1");delay(10); 
Serial.println("SINAIS[21]=1");
}
if(SINAIS[21]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[21]=0");delay(10); 
Serial.println("SINAIS[21]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[22]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[22]=1");delay(10); 
Serial.println("SINAIS[22]=1");
}
if(SINAIS[22]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[22]=0");delay(10); 
Serial.println("SINAIS[22]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[23]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[23]=1");delay(10); 
Serial.println("SINAIS[23]=1");
}
if(SINAIS[23]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[23]=0");delay(10); 
Serial.println("SINAIS[23]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[24]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[24]=1");delay(10); 
Serial.println("SINAIS[24]=1");
}
if(SINAIS[24]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[24]=0");delay(10); 
Serial.println("SINAIS[24]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[25]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[25]=1");delay(10); 
Serial.println("SINAIS[25]=1");
}
if(SINAIS[25]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[25]=0");delay(10); 
Serial.println("SINAIS[25]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[26]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[26]=1");delay(10); 
Serial.println("SINAIS[26]=1");
}
if(SINAIS[26]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[26]=0");delay(10); 
Serial.println("SINAIS[26]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[27]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[27]=1");delay(10); 
Serial.println("SINAIS[27]=1");
}
if(SINAIS[27]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[27]=0");delay(10); 
Serial.println("SINAIS[27]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[28]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[28]=1");delay(10); 
Serial.println("SINAIS[28]=1");
}
if(SINAIS[28]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[28]=0");delay(10); 
Serial.println("SINAIS[28]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[29]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[29]=1");delay(10); 
Serial.println("SINAIS[29]=1");
}
if(SINAIS[29]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[29]=0");delay(10); 
Serial.println("SINAIS[29]=0");
}
// Recebe do Interruptor o sinal e atualiza a saida no supervisorio
if(SINAIS[30]==33)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[30]=1");delay(10); 
Serial.println("SINAIS[30]=1");
}
if(SINAIS[30]==31)
{
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("SINAIS[30]=0");delay(10); 
Serial.println("SINAIS[30]=0");
}


}
*/









if( modo==1)
{
if(x==50)
{
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[SINAIS,sizeof (SINAIS)]=10;
radio.write(SINAIS,sizeof(SINAIS));
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("Sincronizado!");delay(10); 
SINAIS[SINAIS,sizeof (SINAIS)]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
// Usado para check
if(x==-50)
{
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[SINAIS,sizeof (SINAIS)]=1023;
radio.write(SINAIS,sizeof(SINAIS));
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("Modo Check!");delay(10); 
SINAIS[SINAIS,sizeof (SINAIS)]=9;
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-50;modo=-50;
}
// Usado para acionar via serial ou Ethernet
if(x==100)
{
//reinicia a central
lcd.setCursor(0, 2);lcd.print(" ");lcd.setCursor(0, 2);lcd.print("Resetando o Sistema!");
setup();
}

if(x==-100)
\{

 int viagem = random(analogRead(A0));
 int w = map(viagem,0,1023,0,30);

//Modo Viagem
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[w] = 1000;
radio.write(SINAIS,sizeof(SINAIS));
delay(50000);



}

if(x==0)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 0");
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[0]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[0]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==1)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 1");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[1]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[1]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==2)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 2");
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[2]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[2]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==3)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 3");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[3]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[3]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==4)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 4");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[4]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[4]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==5)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 5");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[5]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[5]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==6)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 6");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[6]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[6]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==7)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 7");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[7]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[7]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==8)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 8");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[8]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[8]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==9)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 9");
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[9]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[9]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==10)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 10");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[10]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[10]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==11)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 11");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[11]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[11]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==12)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 12");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[12]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[12]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==13)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 13");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[13]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[13]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==14)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 14");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[14]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[14]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==15)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 15");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[15]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[15]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==16)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 16");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[16]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[16]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==17)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 17");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[17]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[17]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==18)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 18");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[18]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[18]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==19)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 19");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[19]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[19]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==20)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 20");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[20]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[20]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==21)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 21");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[21]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[21]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==22)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 22");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[22]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[22]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==23)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 23");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[23]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[23]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==24)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 24");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[24]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[24]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==25)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 25");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[25]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[25]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==26)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 26");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[26]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[26]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==27)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 27");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[27]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[27]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==28)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 28");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[28]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[28]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==29)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 29");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[29]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[29]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
if(x==30)
{
lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Code: 30");  
radio.stopListening();;
radio.openWritingPipe(pipe);
SINAIS[30]=1000;
radio.write(SINAIS,sizeof(SINAIS));
SINAIS[30]=9;
radio.write(SINAIS,sizeof(SINAIS));
radio.openReadingPipe(1,pipe);
radio.startListening();;
x=-1;modo=0;
}
}

// MODO CHECK
if ( modo==-50 ) 
{
radio.read( SINAIS, sizeof(SINAIS) );
if(SINAIS[0]==1111)
{
  Serial.println("SINAIS[0]=Ok");
}
if(SINAIS[1]==1111)
{
Serial.println("SINAIS[1]=Ok");
}
if(SINAIS[2]==1111)
{
Serial.println("SINAIS[2]=Ok");
}
if(SINAIS[3]==1111)
{
Serial.println("SINAIS[3]=Ok");
}
if(SINAIS[4]==1111)
{
Serial.println("SINAIS[4]=Ok");
}
if(SINAIS[5]==1111)
{
Serial.println("SINAIS[5]=Ok");
}
if(SINAIS[6]==1111)
{
Serial.println("SINAIS[6]=Ok");
}
if(SINAIS[7]==1111)
{
Serial.println("SINAIS[7]=Ok");
}
if(SINAIS[8]==1111)
{
Serial.println("SINAIS[8]=Ok");
}
if(SINAIS[9]==1111)
{
Serial.println("SINAIS[9]=Ok");
}
if(SINAIS[10]==1111)
{
Serial.println("SINAIS[10]=Ok");
}
if(SINAIS[11]==1111)
{
Serial.println("SINAIS[11]=Ok");
}
if(SINAIS[12]==1111)
{
Serial.println("SINAIS[12]=Ok");
}
if(SINAIS[13]==1111)
{
Serial.println("SINAIS[13]=Ok");
}
if(SINAIS[14]==1111)
{
Serial.println("SINAIS[14]=Ok");
}
if(SINAIS[15]==1111)
{
Serial.println("SINAIS[15]=Ok");
}
if(SINAIS[16]==1111)
{
Serial.println("SINAIS[16]=Ok");
}
if(SINAIS[17]==1111)
{
Serial.println("SINAIS[17]=Ok");
}
if(SINAIS[18]==1111)
{
Serial.println("SINAIS[18]=Ok");
}
if(SINAIS[19]==1111)
{
Serial.println("SINAIS[19]=Ok");
}
if(SINAIS[20]==1111)
{
Serial.println("SINAIS[20]=Ok");
}
if(SINAIS[21]==1111)
{
Serial.println("SINAIS[21]=Ok");
}
if(SINAIS[22]==1111)
{
Serial.println("SINAIS[22]=Ok");
}
if(SINAIS[23]==1111)
{
Serial.println("SINAIS[23]=Ok");
}
if(SINAIS[24]==1111)
{
Serial.println("SINAIS[24]=Ok");
}
if(SINAIS[25]==1111)
{
Serial.println("SINAIS[25]=Ok");
}
if(SINAIS[26]==1111)
{
Serial.println("SINAIS[26]=Ok");
}
if(SINAIS[27]==1111)
{
Serial.println("SINAIS[27]=Ok");
}
if(SINAIS[28]==1111)
{
Serial.println("SINAIS[28]=Ok");
}
if(SINAIS[29]==1111)
{
Serial.println("SINAIS[29]=Ok");
}
if(SINAIS[30]==1111)
{
Serial.println("SINAIS[30]=Ok");
}
x=-1;modo=0;
}





modo=0;







}// fecha loop

 

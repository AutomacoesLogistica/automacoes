/* Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V                 NAO USAR 5V POIS QUEIMA
   3 - CE to Arduino pino 9
   4 - CSN to Arduino pino 10
   5 - SCK to Arduino pino 13
   6 - MOSI to Arduino pino 11
   7 - MISO to Arduino pino 12
   8 - Nao usado
   - 
 */



//Importa as livrarias

#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9  // se for arduino mega mudar para 8
#define CSN_PIN 10 // se for arduino mega mudar para 53
const uint64_t pipe = 0xE8E8F0F0E1LL;
RF24 radio(CE_PIN, CSN_PIN);
int SINAIS[30];
String readString;
#include <LiquidCrystal.h>
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);
int modo;
long randNumber; // para funcao viagem
int w;
void setup()
{
  Serial.begin(9600);

  lcd.begin(20, 4);
  radio.begin();
  radio.openWritingPipe(pipe);
  lcd.setCursor(0, 0);lcd.print("                    ");lcd.setCursor(0, 0);lcd.print("    GA Automacoes   ");
  modo=0;
 randomSeed(analogRead(0));// para a funcao viagem
}



void loop()  
{
// Se em modo de viagem imprimir o numero do canal aleatoriamente na serial
 if(modo==1)
 {
 w = randNumber;
 Serial.print("SINAIS[");
 Serial.print(w);
 Serial.println("]");
 }
  
    
  while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString+=c; 
 }
 
 // Para tudo que chegar na serial ele imprimir e trabalhar, importante na funcao viagem, NAO RETIRARA
 if(readString!="")
 {
 Serial.println(readString);
 }

 // Quando clicado no modo viagem pelo supervisorio
 if (readString.indexOf("viagem")>=0)     
 {
 
  lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("   Em Modo Viagem   ");delay(2000);
  readString="";
  modo=1; // para entrar no modo viagem e alternar tudo aleatoriamente
  }



 // Quando clicado para sair do modo viagem no supervisorio
 if (readString.indexOf("sair")>=0)     
 {
  Serial.println("sistema"); // envia pela serial para o supervisorio liberar os botoes
  readString="";
  setup();
 }



 // Quando se clicar em voltar no supervisorio, envia sinal para limpar a tela do codigo recebido
 if (readString.indexOf("voltar")>=0)     
 {
  lcd.clear() ;
  readString="";
  }


 // Usado para resetar o sistema
 if (readString.indexOf("reset")>=0) 
 {
  lcd.clear();
 lcd.setCursor(0, 0);lcd.print(" ");lcd.setCursor(0, 0);lcd.print("Resetando o Sistema!");delay(2000);
 lcd.clear();
 setup();
 readString="";
 }




 if (readString.indexOf("sincronizar")>=0)     
 {
  modo=0; 
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("Sincronizado!");
  for(int i = 0; i < 30; i++){
  radio.write(SINAIS,sizeof(SINAIS));
  SINAIS[i] = 10;
  }
  for(int i = 0; i < 30; i++){
  SINAIS[i] = 9;
  radio.write(SINAIS,sizeof(SINAIS));
  }
  readString="";
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("                    ");
  readString="";
  }



 if (readString.indexOf("SINAIS[0]")>=0||w==0&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[0]");
  SINAIS[0] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS));
  }
  SINAIS[0] = 9;
  readString="";
  }
  
 if (readString.indexOf("SINAIS[1]")>=0||w==1&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[1]");
  SINAIS[1] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS));
  }
  SINAIS[1] = 9;
  readString="";
  }
  
 if (readString.indexOf("SINAIS[2]")>=0||w==2&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[2]");   
  SINAIS[2] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[2] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[3]")>=0||w==3&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[3]");   
  SINAIS[3] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[3] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[4]")>=0||w==4&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[4]");   
  SINAIS[4] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[4] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[5]")>=0||w==5&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[5]");   
  SINAIS[5] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[5] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[6]")>=0||w==6&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[6]");   
  SINAIS[6] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[6] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[7]")>=0||w==7&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[7]");   
  SINAIS[7] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[7] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[8]")>=0||w==8&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[8]");   
  SINAIS[8] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[8] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[9]")>=0||w==9&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[9]");   
  SINAIS[9] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[9] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[10]")>=0||w==10&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[10]");   
  SINAIS[10] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[10] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[11]")>=0||w==11&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[11]");   
  SINAIS[11] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[11] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[12]")>=0||w==12&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[12]");   
  SINAIS[12] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[12] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[13]")>=0||w==13&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[13]");   
  SINAIS[13] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[13] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[14]")>=0||w==14&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[14]");   
  SINAIS[14] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[14] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[15]")>=0||w==15&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[15]");   
  SINAIS[15] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[15] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[16]")>=0||w==16&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[16]");   
  SINAIS[16] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[16] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[17]")>=0||w==17&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[17]");   
  SINAIS[17] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[17] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[18]")>=0||w==18&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[18]");   
  SINAIS[18] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[18] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[19]")>=0||w==19&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[19]");   
  SINAIS[19] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[19] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[20]")>=0||w==20&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[20]");   
  SINAIS[20] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[20] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[21]")>=0||w==21&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[21]");   
  SINAIS[21] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[21] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[22]")>=0||w==22&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[22]");   
  SINAIS[22] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[22] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[23]")>=0||w==23&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[23]");   
  SINAIS[23] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[23] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[24]")>=0||w==24&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[24]");   
  SINAIS[24] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[24] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[25]")>=0||w==25&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[25]");   
  SINAIS[25] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[25] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[26]")>=0||w==26&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[26]");   
  SINAIS[26] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[26] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[27]")>=0||w==27&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[27]");   
  SINAIS[27] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[27] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[28]")>=0||w==28&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[28]");   
  SINAIS[28] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[28] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[29]")>=0||w==29&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[29]");   
  SINAIS[29] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[29] = 9;
  readString="";
  } 

 if (readString.indexOf("SINAIS[30]")>=0||w==30&&modo==1)     
 {
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("SINAIS[30]");   
  SINAIS[30] = 1000;
  for(int i = 0; i < 2; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[30] = 9;
  readString="";
  } 


    




if(modo==1)
{
 randNumber = random(0, 8); // primeiro numero é o inicio do random e o ultimo é o ultimo valor-1 , se quiser ate 50 , deixe 51

delay(3000);
}


    
}



int x;
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
// Variaveis e Pinos
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int SINAIS[15];  // Numero de canais
String readString;
void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  x=0;
  pinMode(8,OUTPUT);
  digitalWrite(8,0); // usado para atualizar o LED WIRELESS
}
//******************************************************************************************************************************************************************************************

void loop()  
{
   
 // Mapeia algo recebido pela serial     
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString+=c; 
 }


   // ATUALIZA A SAIDA AO
   if(readString.indexOf("Entrada A0")>=0||readString.indexOf("SINAIS[0]")>=0)     
   {
    x=1;
   }
   
    // ATUALIZA A SAIDA A1
   if(readString.indexOf("Entrada A1")>=0||readString.indexOf("SINAIS[1]")>=0)     
   {
    x=2;
   }
   
    // ATUALIZA A SAIDA A2
   if(readString.indexOf("Entrada A2")>=0||readString.indexOf("SINAIS[2]")>=0)     
   {
    x=3;  
   }
   
    // ATUALIZA A SAIDA A3
   if(readString.indexOf("Entrada A3")>=0||readString.indexOf("SINAIS[3]")>=0)     
   {
    x=4; 
   }
   
    // ATUALIZA A SAIDA A4
   if(readString.indexOf("Entrada A4")>=0||readString.indexOf("SINAIS[4]")>=0)     
   {
    x=5;  
   }
   
    // ATUALIZA A SAIDA A5
   if(readString.indexOf("Entrada A5")>=0||readString.indexOf("SINAIS[5]")>=0)     
   {
    x=6;
   }
   
    // ATUALIZA A SAIDA 2
   if(readString.indexOf("Entrada 2")>=0||readString.indexOf("SINAIS[6]")>=0)     
   {
   x=7;
   }
   
   // ATUALIZA A SAIDA 3
   if(readString.indexOf("Entrada 3")>=0||readString.indexOf("SINAIS[7]")>=0)     
   {
    x=8;
   }
   
   // ATUALIZA A SAIDA 4
   if(readString.indexOf("Entrada 4")>=0||readString.indexOf("SINAIS[8]")>=0)     
   {
    x=9;
   }
   
   // ATUALIZA A SAIDA 5
   if(readString.indexOf("Entrada 5")>=0||readString.indexOf("SINAIS[9]")>=0)     
   {
    x=10;
   }
   
   // ATUALIZA A SAIDA 6
   if(readString.indexOf("Entrada 6")>=0||readString.indexOf("SINAIS[10]")>=0)     
   {
    x=11;
   }
   
   // ATUALIZA A SAIDA 7
   if(readString.indexOf("Entrada 7")>=0||readString.indexOf("SINAIS[11]")>=0)     
   {
    x=12;
   }
   
   // ATUALIZA A SAIDA 8
   if(readString.indexOf("Entrada 8")>=0||readString.indexOf("SINAIS[12]")>=0)     
   {
    x=13;
   }
   
    // ATUALIZA A SAIDA 9
   if(readString.indexOf("Entrada 9")>=0||readString.indexOf("SINAIS[13]")>=0)     
   {
    x=14;
   }
   
    // ATUALIZA A SAIDA 10
   if(readString.indexOf("Entrada 10")>=0||readString.indexOf("SINAIS[14]")>=0)     
   {
    x=15;
   }
   
   if(readString.indexOf("resetar")>=0||readString.indexOf("SINAIS[60]")>=0)     
   {
    SINAIS[0]=1111;
   }
   
  readString="";
 
 
  
  // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  if(radio.available()||(x>0 && x<16) ) 
  {
    radio.read( SINAIS, sizeof(SINAIS) );
    digitalWrite(8,1); // acende shield
 
 
    
 if( x==1 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[0]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A0");
   x=0;
   }
   
 if( x==2 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[1]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A1");
   x=0;
   }
  
 if( x==3 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[2]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A2");
   x=0;
   }

 if( x==4 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[3]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A3");
   x=0;
   }

 if( x==5 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[4]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A4");
   x=0;
   }


 if( x==6 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[5]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A5");
   x=0;
   }


 if( x==7 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[6]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 2");
   x=0;
   }

 if( x==8 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[7]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 3");
   x=0;
   }


 if( x==9 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[8]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 4");
   x=0;
   }

 if( x==10 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[9]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 5");
   x=0;
   }

 if( x==11 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[10]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 6");
   x=0;
   }

 if( x==12 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[11]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 7");
   x=0;
   }

 if( x==13 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[12]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 8");
   x=0;
   }

 if( x==14 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[13]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 9");
   x=0;
   }

 if( x==15 )
   {
   digitalWrite(8,1); // acende shield
   SINAIS[14]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   radio.write(SINAIS ,sizeof(SINAIS));
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 10");
   x=0;
   }

  }
  
  else
  {
    digitalWrite(8,0); // apaga shield
  }
  
   
    SINAIS[0]=10;
    SINAIS[1]=10;
    SINAIS[2]=10;   
    SINAIS[3]=10;
    SINAIS[4]=10;
    SINAIS[5]=10;
    SINAIS[6]=10;
    SINAIS[7]=10;
    SINAIS[8]=10;
    SINAIS[9]=10;
    SINAIS[10]=10;
    SINAIS[11]=10;
    SINAIS[12]=10;
    SINAIS[13]=10;
    SINAIS[14]=10;
    
    radio.stopListening();;
    radio.openWritingPipe(pipe);
    radio.write(SINAIS ,sizeof(SINAIS));
    radio.openReadingPipe(1,pipe);
    radio.startListening();;

}
//******************************************************************************************************************************************************************************************


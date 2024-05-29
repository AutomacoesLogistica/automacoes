/*
 * 
 * Leitura do valor de velocidade do radar fixo MB
 * 
 * utiliza padrao RS232 lendo o cabo TX que sai do sensor Doppler KRD-2
 * 
 * esse cabo entra no adaptador RS232 /usb-ttl na porta 3 e o 5 no cabo de GND do sensor Doppler
 * 
 * Conexoes do adaptador RS232/usb-ttl 
 * VCC = 5V
 * RXD = RX do microcontrolador
 * TXD = NC 
 * GND = GND do microcontrolador
 * 
 * Baud Rate = 115200
 * 
 * 
 * 
 */


String readString;
String tamanho = "";
String valores1 = ""; //Primeiros valores r?g⸮⸮u⸮⸮
String valor_lido = "";

void setup() 
{
Serial.begin(115200);

}

void loop() 
{
while(Serial.available())
{
 delay(3);
 char c = Serial.read();
 readString += c;
}

if (readString.length()>0) 
{
 String mensagem = String(readString);
 tamanho = (mensagem.length());
 valores1 = (mensagem.substring(0,8));
 //Serial.println(mensagem);
 valor_lido = (mensagem.substring(8,9));

 if ( tamanho == "11")
 {
  
  if(valor_lido == "1") 
  {
   Serial.println("Velocidade de 1 Km/h");
  }
  else if(valor_lido == "2") 
  {
   Serial.println("Velocidade de 2 Km/h");
  }
  else if(valor_lido == "3") 
  {
   Serial.println("Velocidade de 3 Km/h");
  }
  else if(valor_lido == "4") 
  {
   Serial.println("Velocidade de 4 Km/h");
  }
  else if(valor_lido == "5") 
  {
   Serial.println("Velocidade de 5 Km/h");
  }
  else if(valor_lido == "6") 
  {
    Serial.println("Velocidade de 6 Km/h");
  }
  else if(valor_lido == "7") 
  {
   Serial.println("Velocidade de 7 Km/h");
  }
  else if(valor_lido == "8") 
  {
   Serial.println("Velocidade de 8 Km/h");
  }
  else if(valor_lido == "9") 
  {
   Serial.println("Velocidade de 9 Km/h");
  }
  else if(valor_lido == "=") 
  {
   Serial.println("Velocidade de 10 Km/h");
  }
  else if(valor_lido == "?") 
  {
   Serial.println("Velocidade de 11 Km/h");
  }
  else if(valor_lido == "A") 
  {
   Serial.println("Velocidade de 12 Km/h");
  }
  else if(valor_lido == "C") 
  {
   Serial.println("Velocidade de 13 Km/h");
  }
  else if(valor_lido == "E") 
  {
   Serial.println("Velocidade de 14 Km/h");
  }
  else if(valor_lido == "G") 
  {
   Serial.println("Velocidade de 15 Km/h");
  }
  else if(valor_lido == "I") 
  {
   Serial.println("Velocidade de 16 Km/h");
  }
  else if(valor_lido == "K") 
  {
   Serial.println("Velocidade de 17 Km/h");
  }
  else if(valor_lido == "M") 
  {
   Serial.println("Velocidade de 18 Km/h");
  }
  else  if(valor_lido == "O") 
  {
   Serial.println("Velocidade de 19 Km/h");
  }
  else  if(valor_lido == "Q") 
  {
   Serial.println("Velocidade de 20 Km/h");
  }
  else  if(valor_lido == "S") 
  {
   Serial.println("Velocidade de 21 Km/h");
  }
  else  if(valor_lido == "U") 
  {
   Serial.println("Velocidade de 22 Km/h");
  }
  else  if(valor_lido == "W") 
  {
   Serial.println("Velocidade de 23 Km/h");
  }
  else  if(valor_lido == "Y") 
  {
   Serial.println("Velocidade de 24 Km/h");
  }
  else  if(valor_lido == "[") 
  {
   Serial.println("Velocidade de 25 Km/h");
  }
  else  if(valor_lido == "]") 
  {
   Serial.println("Velocidade de 26 Km/h");
  }
  else
  {
    Serial.print("Velocidade não identificada   -    ");Serial.println(valor_lido);
  }
   
  
  
  
  
 
 
 
 }

 
 readString="";
}


}

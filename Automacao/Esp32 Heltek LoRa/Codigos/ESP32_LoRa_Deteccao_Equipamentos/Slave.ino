//Compila apenas se MASTER não estiver definido no arquivo principal
#ifndef MASTER
int contador = 0;
boolean atuado = false; // inicia desativado

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo2 = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;


void setup()
{
 Serial.begin(115200);
 pinMode(12,OUTPUT); 
 digitalWrite(12,0); 
 pinMode(13,OUTPUT); 
 digitalWrite(13,0);  
 setupLoRa();
 Serial.println("Slave");
}

void loop()
{
 AtualMillis = millis();    //Tempo atual em ms
 if ( atuado == false )
 {
  if (AtualMillis - UltimoMillis > intervalo2) 
  { 
   UltimoMillis = AtualMillis;    // Salva o tempo atual
   Tempo();
  }
 }
 else
 {
  if (AtualMillis - UltimoMillis > intervalo2/4) 
  { 
   UltimoMillis = AtualMillis;    // Salva o tempo atual
   Tempo2();
  }
 }
 int packetSize = LoRa.parsePacket();
 if (packetSize == GETDATA.length())
 {
  String readString = "";
  while(LoRa.available())
  {
   readString += (char) LoRa.read();
  }
  if(readString.equals(GETDATA))
  {
   int valor = LoRa.packetRssi()*-1;
   if (valor <70)
   { 
    String data = "Atuado"; //readData();
    LoRa.beginPacket();
    LoRa.print(SETDATA + data);
    LoRa.endPacket();
    Serial.println("Enviou: " + String(data));
    atuado = true;
   }
   else
   {
    Serial.println("Recebeu mais n enviou");
    atuado = false;
   }
  
  }
 }
} // Fecha Loop

String readData()
{
 return String(contador++);
}

void Tempo()
{
digitalWrite(12,!digitalRead(12));  // LED
digitalWrite(13,0);  // SIRENE
}
void Tempo2()
{
 digitalWrite(12,!digitalRead(12)); // LED
 digitalWrite(13,!digitalRead(13));   // SIRENE
}



#endif

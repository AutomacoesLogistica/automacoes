//Compila apenas se MASTER estiver definido no arquivo principal
#ifdef MASTER
#define intervalo 500

long ultimo_tempo = 0;
boolean atuado = false; // inicia desativado

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo2 = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
int vezes = 0;

void setup()
{
  Serial.begin(115200);
  pinMode(12,OUTPUT); 
  digitalWrite(12,0); 
  pinMode(13,OUTPUT); 
  digitalWrite(13,0);  

  setupLoRa();
  Serial.println("Master");
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

 
 
 
 if (millis() - ultimo_tempo > intervalo)
 {
  ultimo_tempo = millis();
  send(); // Chama para enviar os dados
 }
receive();// Chama para receber os dados
} // Fecha o loop


void send() // Envia os dados ***************************************************************************************************************************************************************
{
 LoRa.beginPacket();
 LoRa.print(GETDATA);
 LoRa.endPacket();
}

void receive() // Recebe os dados ***********************************************************************************************************************************************************
{
 int packetSize = LoRa.parsePacket();
 if (packetSize > SETDATA.length())
 {
  String readString = "";
  while(LoRa.available())
  {
   readString += (char) LoRa.read();
  }
  int index = readString.indexOf(SETDATA);
  if(index >= 0)
  {
   int valor = LoRa.packetRssi()*-1;
   if (valor <70)
   { 
    String data = readString.substring(SETDATA.length());
    Serial.println(data + " - Master");
    vezes = 0;
    atuado = true;
   }
   else
   {
    Serial.println("Recebeu fora alcance - Master" ); 
    atuado = false;
   }
  }
 }
 else
 {
  vezes++;

  if ( vezes >=55380)
  {  //Configurar para fazer desligar
  Serial.println("Não Recebeu - Master" );
  vezes = 0; 
  atuado = false;
  }
 }
} // Fecha void



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

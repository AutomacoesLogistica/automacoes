
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 500;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
void setup()
{
pinMode(13,OUTPUT);
digitalWrite(13,0);  
  
}
void loop()
{
  AtualMillis = millis();    //Tempo atual em ms
  
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
   Tempo();
    
  }
}


void Tempo()
{
digitalWrite(13,!digitalRead(13));  
  
}

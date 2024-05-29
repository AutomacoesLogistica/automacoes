#include <TinyGPS++.h>
#include <SoftwareSerial.h>


// Valores da media movel para velocidade
#define N_Amostras_Velocidade 5 // N_Amostras_Velocidadeumero de amostas
float media; // Recebe a media
int valores_Velocidade[N_Amostras_Velocidade]; // Array para armazeN_Amostras_Velocidadear os valores lidos
float Soma_Velocidade; // Variavel para Soma_Velocidader os valores 
float ValorLido_Velocidade;


// Valores da media movel para altitude
#define N_Amostras_Altitude 10 // N_Amostras_Altitude de amostas
float media_Altitude; // Recebe a media
int valores_Altitude[N_Amostras_Altitude]; // Array para armazenar os valores lidos
float Soma_Altitude; // Variavel para Soma_Velocidader os valores 
float ValorLido_Altitude;



static const int RXPin = 2, TXPin = 3;
static const uint32_t GPSBaud = 9600;
char data[32];
char hora[32];

TinyGPSPlus gps;
SoftwareSerial Serial_GPS(RXPin, TXPin);

void setup()
{
  Serial.begin(115200);
  Serial_GPS.begin(GPSBaud);
}

void loop()
{
  
  ImprimirDataHora(gps.date, gps.time);
  MediaMovelVelocidade();  
  Serial.print(ValorLido_Velocidade);
  Serial.println(" Km/h");
  Serial.print("Numero de Satelites : ");
  Serial.println(gps.satellites.value());
  MediaMovelAltitude();
  Serial.print("Altitude em m : ");
  Serial.println(ValorLido_Altitude,2);
  Serial.print("Data : ");
  Serial.println(data);
  Serial.print("Hora : ");
  Serial.println(hora);
  Serial.print("Latitude  : ");
  Serial.println(gps.location.lat(),6);
  Serial.print("Longitude : ");
  Serial.println(gps.location.lng(),6);
  Serial.println();  
  
  AtualizaDelayAtualizacao(500);
  if (millis() > 5000 && gps.charsProcessed() < 10)
  {
   Serial.println(F("Nao detectado GPS, verificar ligacao!"));
  }
} // Fecha o Loop


static void AtualizaDelayAtualizacao(unsigned long ms)
{
  unsigned long start = millis();
  do 
  {
    while (Serial_GPS.available())
      gps.encode(Serial_GPS.read());
  } while (millis() - start < ms);
}


static void MediaMovelVelocidade()
{
 for(int i = N_Amostras_Velocidade-1;i>0;i--)
 {
  valores_Velocidade[i] = valores_Velocidade[i-1];
 }
 ValorLido_Velocidade = gps.speed.kmph();
 valores_Velocidade[0] = ValorLido_Velocidade; // Coloca o valor mais atual em valores[0]
 Soma_Velocidade = 0;  // Limpa a variavel de Soma_Velocidade
 for (int i=0;i<N_Amostras_Velocidade;i++)
 {
  Soma_Velocidade = Soma_Velocidade+valores_Velocidade[i];
 }
 media = Soma_Velocidade/N_Amostras_Velocidade;
 ValorLido_Velocidade = media;
}

static void MediaMovelAltitude()
{
 for(int i = N_Amostras_Altitude-1;i>0;i--)
 {
  valores_Altitude[i] = valores_Altitude[i-1];
 }
 ValorLido_Altitude = (gps.altitude.meters());
 valores_Altitude[0] = ValorLido_Altitude; // Coloca o valor mais atual em valores[0]
 Soma_Altitude = 0;  // Limpa a variavel de Soma_Altitude
 for (int i=0;i<N_Amostras_Altitude;i++)
 {
  Soma_Altitude = Soma_Altitude+valores_Altitude[i];
 }
 media_Altitude = Soma_Altitude/N_Amostras_Altitude;
 ValorLido_Altitude = media_Altitude;
}



static void ImprimirDataHora(TinyGPSDate &d, TinyGPSTime &t)
{
  if (!d.isValid()){}
  else
  {
    sprintf(data, "%02d/%02d/%02d ", d.day(), d.month(), d.year());
  }
  
  if (!t.isValid()){}
  else
  {
    sprintf(hora, "%02d:%02d:%02d ", t.hour()-3, t.minute(), t.second());
  }
AtualizaDelayAtualizacao(0);
}



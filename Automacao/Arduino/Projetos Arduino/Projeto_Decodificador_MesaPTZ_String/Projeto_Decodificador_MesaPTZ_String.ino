// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   8
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção



#include <Servo.h> 
Servo myservoV1; 
Servo myservoH1;
Servo myservoV2; 
Servo myservoH2;



int limV1,limV2;
int limH1,limH2;

int SINAIS[1];  // usada para receber os comandos enviados
String readString;


void setup()
{
 Serial.begin(9600);
 radio.begin();
 radio.openReadingPipe(1,pipe);
  radio.startListening();;


myservoV1.attach(3);
myservoH1.attach(5);
myservoV2.attach(6);
myservoH2.attach(9);

  
 limV1 = 160;
 limH1 = 179;
 
 limV2 = 160;
 limH2 = 179;
 
  myservoH1.write(0); 
  myservoV1.write(160);
  myservoH2.write(0); 
  myservoV2.write(160);
  delay(1000);

for (int a = 0; a<40; a++)
{
  myservoH1.write((a*3)*1.5); 
  myservoH2.write((a*3)*1.5); 
  myservoV1.write(160-(a*2.5));
  myservoV2.write(160-(a*2.5));
  delay(100);
}
 
 delay(50);
  
for (int b = 0; b<40; b++)
{
  myservoH1.write(180-(b*2.25)); 
  myservoH2.write(180-(b*2.25)); 
  myservoV1.write(60+(b*1.5)); 
  myservoV2.write(60+(b*1.5)); 
  delay(100);
}
  myservoH1.write(90); 
  myservoV1.write(110);
  myservoH2.write(90); 
  myservoV2.write(110);

}

void loop()
{
  if ( radio.available()) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  radio.read( SINAIS, sizeof(SINAIS) );
 }

























 
}  // final do loop



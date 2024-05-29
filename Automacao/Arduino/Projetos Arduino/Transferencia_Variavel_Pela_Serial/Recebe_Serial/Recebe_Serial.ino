/*
GA AUTOMAÇÔES

transferencia de variavel pela serial

*/


int ledPin = 13; // pino do led
String readString; // String concatenadora de cacacteres recebidos pela serial

void setup() 
{
 Serial.begin(9600);
 pinMode(ledPin, OUTPUT); //define como saida a porta do led
}

void loop() 
{
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }
 
 
 if (readString.length()>0)  // se estiver dados prontos para serem impressos e diferentes de vazio ou zero, ( isso filtra todos os ruidos da serial )
 {
  int valor = readString.toInt() ;//recebe os dados da seria e converte em inteiro atribuindo a variavel 'valor'
  Serial.println(valor);

  if (valor == 1023) // se o valor da variave enviada pela serial for 1023 acende o led     
  {
   digitalWrite(ledPin, HIGH);
  }

  if (valor == 0) // se o valor da variave enviada pela serial for 0 apaga o led
  {
   digitalWrite(ledPin, LOW);
  }

  readString="";
 } 
}


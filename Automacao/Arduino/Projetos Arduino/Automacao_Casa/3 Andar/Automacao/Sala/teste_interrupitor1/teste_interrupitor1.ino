#define entrada1 2
// DADOS DA CONEXAO RS485
#define DIR 5 // Pino que define se esta recebendo ou enviando


void setup() 
{
 pinMode(entrada1,INPUT);
 Serial.begin(4800);
  pinMode(DIR,OUTPUT);
  digitalWrite(DIR,LOW); // em LOW recebe, para enviar mude para HIGH e volte para LOW

}

void loop() 
{
  
  if (digitalRead(entrada1)==0)
  {
    digitalWrite(DIR,HIGH);
    delay(500);
   
    while(digitalRead(entrada1)==0)
    {
     delay(500);   
    }
     
    Serial.write('S');
    digitalWrite(DIR,LOW);
  }
}

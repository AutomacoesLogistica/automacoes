//Programa : Teste sensor de chuva YL-83
//Autor : FILIPEFLOP
 
int pino_d = 7; //Pino ligado ao D0 do sensor
int pino_a = A5; //Pino ligado ao A0 do sensor
int val_d = 0; //Armazena o valor lido do pino digital
int val_a = 0; //Armazena o valor lido do pino analogico
 
 
void setup()
{
  pinMode(pino_d, INPUT);
  pinMode(pino_a, INPUT);
  Serial.begin(115200);
}
 
void loop()
{
  //Le e arnazena o valor do pino digital
  val_d = digitalRead(pino_d);
  //Le e armazena o valor do pino analogico
  val_a = analogRead(pino_a);
  //Envia as informacoes para o serial monitor
  Serial.print("Valor digital : ");
  Serial.print(val_d);
  Serial.print(" - Valor analogico : ");
  Serial.println(val_a);
  //Mostra no display se ha chuva ou nao
  if (val_d == 1)
  {
    Serial.println("Chuva : Nao");
   
  }
  else
  {
    Serial.println("Chuva : Sim");
  }
 
  //Mostra no display o nivel de intensidade
  //da chuva
  if (val_a >900 && val_a <1023)
  {
    Serial.println("Intensidade : -- ");
  }
  else if (val_a >600 && val_a <900)
  {
    Serial.println("Intensidade : Fraca");
  }
  else if (val_a >400 && val_a <600)
  {
    Serial.println("Intensidade : Moderada");
  }
  else if (val_a <400)
  {
   Serial.println("Intensidade : Forte");
  }    
  delay(1000);
}

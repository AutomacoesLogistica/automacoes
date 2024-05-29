#define entrada_GAGF 5
#define entrada_SVA 4
#define saida 0
#define saida_GAGF 14
#define saida_SVA 12

boolean GAGF = 0;
unsigned long pulsos = 0;
boolean SVA = 0;

void setup()
{
  Serial.begin(115200);
  pinMode(entrada_GAGF,INPUT);
  pinMode(entrada_SVA,INPUT);
  pinMode(saida,OUTPUT);
  digitalWrite(saida,LOW);
  pinMode(saida_GAGF,OUTPUT);
  digitalWrite(saida_GAGF,LOW);
  pinMode(saida_SVA,OUTPUT);
  digitalWrite(saida_SVA,LOW);
  
}


void loop()

{
  // Verificando o pulso do GAGF **************************************************************************************************************************************************
 if (digitalRead(entrada_GAGF) == 1)
 {
  delay(200);
  while(digitalRead(entrada_GAGF) == 1)
  {
   delay(100);
  }
  GAGF = 1;
  digitalWrite(saida_GAGF,HIGH);
  pulsos = 0;
  
 }
 // Verificando o pulso do GAGF **************************************************************************************************************************************************
 if (digitalRead(entrada_SVA) == 1)
 {
  delay(200);
  while(digitalRead(entrada_SVA) == 1)
  {
   delay(100);
  }
  SVA = 1;
  digitalWrite(saida_SVA,HIGH);
  pulsos = 0;
  
 }



 if (SVA == true && GAGF == true )
 {
  digitalWrite(saida,HIGH);
  digitalWrite(saida_GAGF,HIGH);
  digitalWrite(saida_SVA,HIGH);
  delay(2000);
  digitalWrite(saida,LOW);
  digitalWrite(saida_GAGF,LOW);
  digitalWrite(saida_SVA,LOW);
  SVA = 0;
  GAGF = 0;
 }




 pulsos++;



 if ( pulsos == 700000 )
 {
  pulsos = 0;
  Serial.println ("Zerou");
  digitalWrite(saida,LOW);
  digitalWrite(saida_GAGF,LOW);
  digitalWrite(saida_SVA,LOW);
  SVA = 0;
  GAGF = 0;
 }
 
}

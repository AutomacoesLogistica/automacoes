
int entradaX = 7;
int entradaY = 6;
int entradaZ = 5;
unsigned long valorX; // TROTTLE
unsigned long valorY; // ELEVON
unsigned long valorZ; // AUX

String marcha = "frente";
boolean rampa = false;

#define saida_motor1 9
#define saida_motor2 10
#define marcha_re 2
#define buzina 3

void setup()
{
  pinMode(entradaX, INPUT); //Acelerador   1070 a 1911   > vira de 0 a 255 com map
  pinMode(entradaY, INPUT); // Profundor   1236 a 1623   > se menor do que 1300  = marcha re 
  pinMode(entradaZ, INPUT); // Canal AUX 
  pinMode(saida_motor1,OUTPUT); //Saidas PWM para motor
  pinMode(saida_motor2,OUTPUT); //Saidas PWM para motor
  pinMode(marcha_re,OUTPUT); // Lampadas de re
  pinMode(buzina,OUTPUT); // Saida para buzina
  digitalWrite(marcha_re,LOW);
  digitalWrite(buzina,LOW);
  
  Serial.begin(9600);
}

void loop()
{
  rampa= false;
  valorX = pulseIn(entradaX, HIGH);
  valorY = pulseIn(entradaY, HIGH);
  valorZ = pulseIn(entradaZ, HIGH);
  
  if(valorX<1070){valorX = 1070;}
  if(valorX>1911){valorX = 1911;}
  if(valorY<1236){valorY = 1236;}
  if(valorY>1623){valorY = 1623;}

  //BUZINA****************
  if(valorY>1450)
  {
    digitalWrite(buzina,HIGH);
    Serial.println("Buzinando!");
  }
  else
  {
    digitalWrite(buzina,LOW);
    
  }
  int motor = map(valorX,1070,1911,0,255);

  if ( valorY <1300 )
  {
    marcha  = "re";
    digitalWrite(marcha_re,HIGH);
  }
  else
  {
    marcha = "frente";
    digitalWrite(marcha_re,LOW);
  }


  if(marcha == "frente")
  {
   digitalWrite(marcha_re,LOW); 
   analogWrite(saida_motor1,motor);
   analogWrite(saida_motor2,0);
  }
  else
  {
   digitalWrite(marcha_re,HIGH); 
   analogWrite(saida_motor2,motor);
   analogWrite(saida_motor1,0);
  }
  
    
  /*
  Serial.print("Valor lido ZX: ");
  Serial.print(valorZ);
  Serial.print("us");

  Serial.print("  Valor lido Y: ");
  Serial.print(valorY);
  Serial.println("us");
  */
  Serial.print(marcha);
  Serial.print(" - ");
  Serial.println(motor);
  
  delay(100);
}

/*

Equivalencia das saidas Digitais entre NodeMCU e ESP8266 (na IDE do Arduino)
NodeMCU - ESP8266
D0 = 16;
D1 = 5;
D2 = 4;
D3 = 0;
D4 = 2;
D5 = 14;
D6 = 12;
D7 = 13;
D8 = 15;
D9 = 3;
D10 = 1;
*/


int saida = 5;
int entrada = 16;
void setup() 
{
  Serial.begin(115200);
  pinMode(saida, OUTPUT);    
  pinMode(entrada, INPUT);
}



void loop() 
{
  if (digitalRead(entrada)==0)
  {
    digitalWrite(saida, HIGH);
    Serial.println(1);
  }
  else
  {
   Serial.println(0); 
   digitalWrite(saida, LOW); 
  }                          
                             
}

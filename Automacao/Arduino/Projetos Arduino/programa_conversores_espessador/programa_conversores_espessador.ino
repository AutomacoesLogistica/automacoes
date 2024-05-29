int a;
float b;
float c;
float d;
void setup()
{
  a = 1023;
  c = 20;
  d = 5;
  Serial.begin(9600); // 9600 bauds
  Serial.println("|                            BRUNO GONCALVES                           |");
  Serial.println("----------------------------------------------------------------------   ");
  Serial.println("|                  TABELA CONVERSOES PARA O ESPESSADOR                  |");
  Serial.println("----------------------------------------------------------------------   ");
}
void loop()
{
  if (a==0){
  a = 1023;c = 20;  d = 5;
}
  b = a*1.75953079;
   Serial.print(c);
  Serial.print(" mA ----------");
   Serial.print(d);
  Serial.print(" V ----------");
  
   Serial.print(a);
  Serial.print(" Valor ----------");
   Serial.print(b);
  Serial.println(" RPM");
  delay(10);
  a--;
  c = c-0.01564027;
  d = d-0.00488759;

}

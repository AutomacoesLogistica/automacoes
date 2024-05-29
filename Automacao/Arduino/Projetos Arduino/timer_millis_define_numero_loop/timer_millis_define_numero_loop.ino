const int ledPin = 13; 
int ledState = LOW; 
long valorTempo = 0; 
long intervalo = 1000; // DEFINE O TEMPO DO TIMER
int numero_vezes_loop;
int timer_ativo;
void setup() 
{
  Serial.begin(9600);
pinMode(ledPin, OUTPUT); 
timer_ativo = 0;
numero_vezes_loop = 0;
}


void loop()
{
 char c = Serial.read();
 unsigned long tempo = millis();


if (timer_ativo == 1)
{
  if(tempo - valorTempo > intervalo) 
 {
  valorTempo = tempo;
  digitalWrite(ledPin,1);
  numero_vezes_loop++;
 }
 if(numero_vezes_loop == 2 ) // aqui voce define o numero de vezes do loop do timer
 { 
  digitalWrite(ledPin,0);
   timer_ativo = 0;
  numero_vezes_loop = 0;
 }
}

if (c=='1') // digitar 1 na serial para ativar o timer
{
timer_ativo = 1;
}

}// fecha o loop


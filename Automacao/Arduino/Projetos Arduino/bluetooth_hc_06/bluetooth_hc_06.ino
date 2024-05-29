char val; // Variável que recebe os caracteres enviados para o Bluetooth
int ledpin = 13; // o pino 13 corresponde ao LED que já existe no Arduino Uno
 
void setup() {
  pinMode(ledpin, OUTPUT);
  Serial.begin(9600);       // Inicia a comunicação Serial a 9600bps
}
 
void loop() {
  // Checa se tem dados para serem lidos
      val = Serial.read();         // Faz a leitura e registra o caractere em  'val'
     Serial.println(val);
  // if 'H' was received
  if( val == 'l' ) 
  {
   Serial.println("Led ligado");
    digitalWrite(ledpin, HIGH);  // Liga o LED 13
  }
  if ( val == 'd' ) 
  { 
       Serial.println("Led desligado");
    digitalWrite(ledpin, LOW);   // Desliga o LED
  }
  delay(200);                    // espera 200 ms para próxima leitura
}

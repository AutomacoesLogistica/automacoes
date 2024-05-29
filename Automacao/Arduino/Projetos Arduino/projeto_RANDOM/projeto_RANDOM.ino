long randNumber;

void setup(){
  Serial.begin(9600);

  // se o pino de entrada analógica 0 não estiver conectado, ruído analógico
  // aleatório fará com que a função randomSeed() gere
  // diferente números de início cada vez que o programa for executado.
  // randomSeed() irá embralhar a função random.
  randomSeed(analogRead(0));
}

void loop() {
  // imprime um número aleatório entre 0 e 299
  randNumber = random(300);
  Serial.println(randNumber);  

  // imprime um número aleatório entre 10 e 19
  randNumber = random(10, 20);
  Serial.println(randNumber);

  delay(50);
}

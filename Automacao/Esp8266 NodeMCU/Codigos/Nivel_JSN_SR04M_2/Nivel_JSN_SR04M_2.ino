// Define Trig and Echo pin:
#define trigPin 13 // D7
#define echoPin 15 // D8
// Define variables:
long duration;
int distance;
int altura_max = 170; // em cm .....Perde 2 cm em relação a base do sensor, ex: Se do sensor ate o chao tem 88, coloque 86 cm aqui no valor (valor max que le é do sensor para baixo 25cm)
int nivel = 1; // Somente para iniciar
int nivel2 = 1; // Somente para iniciar
boolean resposta = 0; //em 0 resposta em cm, se em 1 resposta em %
void setup() {
  // Define inputs and outputs
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  
  // Begin Serial communication at a baudrate of 9600:
  Serial.begin(115200);
}
void loop() {
  // Clear the trigPin by setting it LOW:
  digitalWrite(trigPin, LOW);
  
  delayMicroseconds(5);
 // Trigger the sensor by setting the trigPin high for 10 microseconds:
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  
  // Read the echoPin. pulseIn() returns the duration (length of the pulse) in microseconds:
  duration = pulseIn(echoPin, HIGH);
  
  // Calculate the distance:
  distance = duration*0.034/2;
  Serial.println(distance);
  nivel = altura_max-distance;
  //Nivel em porcentagem
  nivel2 =nivel*100/altura_max;
  
  // Print the distance on the Serial Monitor (Ctrl+Shift+M):
  if(distance != 0 && nivel>0 && nivel <=altura_max)
  {
  //Para resposta em cm
  if(resposta == 0)
  {
   Serial.print("Nivel = ");
   Serial.print(nivel);
   Serial.println(" cm");
  }
  else
  {
   // Resposta em %
   Serial.print("Nivel = ");
   Serial.print(nivel2);
   Serial.println(" %"); 
  }
  }
  delay(100);
}

/* 

 CODIGO PARA SENSOR ULTRASSONIOC JSN_SR04T
 PODE SER ALIMENTADO COM 3.3 OU 5V

 PARA NODEMCU USAR 3.3 E CASO DESEJE USAR COM 5 PARA O NODEMCU OU RASPBERRY QUE SAO SINAIS 3.3V .
 >>> USAR NO SINAL DO ECHO UM RESISTOR 1k COM 2k E ENTRE OS DOIS LEVE O SINAL PARA A ENTRADA REFERENTE A ECHO E O OUTRO LADO DO 2K ATERRAR

*/

//Define Trig and Echo pin
#define trigPin 2 // RX 
#define echoPin 3 // TX // CASO SEJA ESP OU RASPBERRY QUE SAO 3.3v E ESTEJA SENDO ALIMENTADO POR 5, USAR O DIVISOR DE TENSAO ACIMA

//Define variables
long duration;
float distance;

void setup()
{
//Define inputs and outputs
pinMode(trigPin, OUTPUT);
pinMode(echoPin, INPUT);

//Begin Serial communication
Serial.begin(115200); // Starts the serial communication at a baudrate of 9600
}

void loop()
{
//Clear the trigPin by setting it LOW
digitalWrite(trigPin, LOW);
delayMicroseconds(5);

//Trigger the sensor by setting the trigPin high for 10 microseconds
digitalWrite(trigPin, HIGH);
delayMicroseconds(10);
digitalWrite(trigPin, LOW);

//Read the echoPin. pulseIn() returns the duration (length of the pulse) in microseconds.
duration = pulseIn(echoPin, HIGH);
// Calculate the distance
distance= duration*0.034/2;

//Print the distance on the Serial Monitor (Ctrl+Shift+M)
Serial.print("Distance = ");
Serial.print(distance);
Serial.println(" cm");
delay(100);
}

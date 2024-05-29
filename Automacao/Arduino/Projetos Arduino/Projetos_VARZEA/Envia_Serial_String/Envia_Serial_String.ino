int Sensor_A;
int Sensor_B;

void setup ()
{
Serial.begin(9600);
Sensor_A = 0; 
Sensor_B = 0;
}


void loop()
{
 Sensor_A = analogRead(A0);
 Sensor_B = analogRead(A1);
 
 Serial.print(Sensor_A);
 Serial.print(";");
 Serial.println(Sensor_B);
 

}

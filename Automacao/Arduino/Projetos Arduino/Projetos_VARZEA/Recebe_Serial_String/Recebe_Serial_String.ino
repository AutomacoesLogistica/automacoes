String readString;
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
  while (Serial.available()) 
  {
    delay(3);  
    char c = Serial.read();
    readString += c; 

  if (readString.length() >0) 
  {
   if ( readString!="")
  { 
   Serial.println(readString);  

  } 
    /*
  String varSerial = readString;
  int posicao_Serial = varSerial.indexOf(";"); //Posição do ponto e vírgula
  String Sensor_AA = varSerial.substring(0,posicao_Serial); //Extrai de 0 até a posição do ponto e vírgula
  String Sensor_BB = varSerial.substring(posicao_Serial + 1); //Extrai do ponto e vírgula até o final
  Sensor_A = Sensor_AA.toInt();
  Sensor_B = Sensor_BB.toInt();


  Serial.print("Sensor_A = ");
  Serial.print(Sensor_A);
  Serial.print("     Sensor_B = ");
  Serial.println(Sensor_B);
  */
  readString = "";
  }  
 }

}

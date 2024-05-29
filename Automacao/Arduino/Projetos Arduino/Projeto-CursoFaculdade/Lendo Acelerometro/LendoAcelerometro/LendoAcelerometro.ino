//Programa : Teste Acelerometro MMA7361  
//Alterações e comentários : Arduino e Cia  
   
 #include <AcceleroMMA7361.h> //Carrega a biblioteca do MMA7361  
   
 AcceleroMMA7361 accelero;  
 int x;  
 int y;  
 int z;  
   
 void setup()  
 {  
  Serial.begin(115200);  
  accelero.begin(13, 12, 11, 10, A0, A1, A2);  
  //Seta a voltagem de referencia AREF como 3.3V
  accelero.setARefVoltage(3.3);
  //Seta a sensibilidade (Pino GS) para +/-6G    
  accelero.setSensitivity(LOW);    
  accelero.calibrate();  
 }  
   
 void loop()  
 {  
  x = accelero.getXAccel(); //Obtem o valor do eixo X  
  y = accelero.getYAccel(); //Obtem o valor do eixo Y  
  z = accelero.getZAccel(); //Obtem o valor do eixo Z 
  
  float xx = map(x,-100,100,-48,48);
  float yy = map(y,-150,150,-30,30);
  Serial.print(xx);  
  Serial.print(",");  
  Serial.print(yy);  
  Serial.print(",");  
  Serial.print(z);  
  Serial.println(",");
  delay(500);                     
 
 }  

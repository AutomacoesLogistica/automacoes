void Modo2()
{
 Serial.println("Em MODO 2!");     
 n=0;  
digitalWrite(13,1);
delay(5000);
digitalWrite(13,0);
delay(5000);
loop();
}

void Modo1()
{
  Serial.println("Em MODO 1!");    
  n=0;
digitalWrite(13,1);
delay(1000);
digitalWrite(13,0);
delay(1000);
loop();
}

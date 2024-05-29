void ABRIR()
{
    
    if(tranca==0)
    {
    
    digitalWrite(8,0);// desenergiza a tranca eletrica
    digitalWrite(11,1); // energiza a tranca mecanica
    digitalWrite(A0,1); // solenoide 1 alimenta
    digitalWrite(A1,1); // solenoide 2    
    digitalWrite(A2,1); // solenoide 3
    digitalWrite(A3,1); // solenoide 4 dreno
    delay(2000);
   
    digitalWrite(11,0); // desenergiza a tranca mecanica 
    delay(2000);
    tranca = 1;
    }  
   
    
    if (tranca==1 && digitalRead(2)==0) // comando para desenergizar as solenoides quando o portao estiver aberto
    {
     delay(7000); // alterado para resolver problema atual, geralmente pode ser 2s apenas
     digitalWrite(A0,0); // solenoide 1 alimenta
     digitalWrite(A1,0); // solenoide 2    
     digitalWrite(A2,0); // solenoide 3
     digitalWrite(A3,0); // solenoide 4 dreno
     delay(500);
     tranca = 2;
     contador = 2;
    }
} 
  










  



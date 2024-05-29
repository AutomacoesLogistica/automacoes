void setup()
{
pinMode(2,INPUT);// sinal entrada botoeira de emergencia
pinMode(3,INPUT);// sinal de entrada desalinamento
pinMode(4,INPUT);// sinal de entrada corda plc
pinMode(5,INPUT);// sinal de entrada corda gaveta ccm
pinMode(13,OUTPUT);// sinal de permissao para partir a correia e que tudo esta ok
pinMode(6,INPUT);// sinal de jump ativo botoeira emergencia
pinMode(7,INPUT);// sinal de jump ativo desalinhamento
pinMode(8,INPUT);// sinal de jump ativo corda plc
pinMode(9,INPUT);// sinal de jump ativo corda gaveta ccm
pinMode(10, OUTPUT);// sinal de algum jump atuado e fica piscando de 1 em 1 segundo
pinMode(11, OUTPUT);//sinal de jump ativo para o plc 
pinMode(12, OUTPUT);//sinal para lampada de 127V ( antes aciona um rele )

Serial.begin(9600);
Serial.println(" Bem vindo ao Equipamento de Deteccao de Defeitos de Correias Transportadores Contato: Bruno Goncalves Tel: (31) 8849 - 4604 ");delay(10000);


}
void loop ()
{
  
  // Circuito referente a leitura dos circuitos da correias se estao todos ok.
  
  int entrada1 = digitalRead(2);
  digitalWrite(2,1); 
  int entrada2 = digitalRead(3);
  digitalWrite(3,1);  
  int entrada3 = digitalRead(4);
  digitalWrite(4,1); 
  int entrada4 = digitalRead(5);
  digitalWrite(5,1);
  // Circuito referente a jumpers.
  
  int jump1 = digitalRead(6);
  digitalWrite(6,1);
  int jump2 = digitalRead(7);
  digitalWrite(7,1);
  int jump3 = digitalRead(8);
  digitalWrite(8,1);
  int jump4 = digitalRead(9);
  digitalWrite(9,1);
 
 if (jump1==0) { Serial.println("JUMP ATIVO BOTOEIRA DE EMERGENCIA DE SOCO");delay(100);}
 if (jump2==0) { Serial.println("JUMP ATIVO DE DESALINHAMENTO");delay(100);}
 if (jump3==0) { Serial.println("JUMP ATIVO CORDA DE EMERGENCIA PLC");delay(100);}
 if (jump4==0) { Serial.println("JUMP ATIVO CORDA DE EMERGENCIA GAVETA CCM");delay(100);} 
 
  // Compara as 4 entradas e se todas estao ok indica que permite rodar na saida 13.
  if((entrada1==0 || (entrada1==1 && jump1==0)) && (entrada2==0 || (entrada2==1 && jump2==0)) && (entrada3==0 || (entrada3==1 && jump3==0)) && (entrada4==0 || (entrada4==1 && jump4==0)))
  {digitalWrite(12,0);digitalWrite(13,1);Serial.println("SUA CORREIA ESTA PRONTA PARA PARTIR");delay(1000);} else{digitalWrite(12,1);digitalWrite(13,0);Serial.println("SUA CORREIA APRESENTOU DEFEITO E PAROU");delay(5000);} 
    
   // Detecta jumpers ativo e manda sinalizar na saida 10 piscando por 1 segundo.
 
  if (jump1==0 || jump2==0 || jump3 ==0 || jump4 ==0)
  {digitalWrite(10,1);delay(500);digitalWrite(10,0);delay(500);digitalWrite(11,1);} else{digitalWrite(10,0);digitalWrite(11,0);}
 
 if (entrada1==1 && entrada2==1 && entrada3==1 && entrada4==1){Serial.println( " A correia Possui 4 defeitos" );}
 if (entrada1==0 && entrada2==0 && entrada3==0 && entrada4==0){Serial.println( " A correia Possui 0 defeitos" );}
 if (entrada1==0 && entrada2==1 && entrada3==1 && entrada4==1){Serial.println( " A correia Possui 3 defeitos" );}
 if (entrada1==1 && entrada2==0 && entrada3==1 && entrada4==1){Serial.println( " A correia Possui 3 defeitos" );}
 if (entrada1==1 && entrada2==1 && entrada3==0 && entrada4==1){Serial.println( " A correia Possui 3 defeitos" );}
 if (entrada1==1 && entrada2==1 && entrada3==1 && entrada4==0){Serial.println( " A correia Possui 3 defeitos" );}
 if (entrada1==0 && entrada2==0 && entrada3==1 && entrada4==1){Serial.println( " A correia Possui 2 defeitos" );}
 if (entrada1==0 && entrada2==1 && entrada3==0 && entrada4==1){Serial.println( " A correia Possui 2 defeitos" );}
 if (entrada1==0 && entrada2==1 && entrada3==1 && entrada4==0){Serial.println( " A correia Possui 2 defeitos" );}
 if (entrada1==1 && entrada2==0 && entrada3==0 && entrada4==1){Serial.println( " A correia Possui 2 defeitos" );}
 if (entrada1==1 && entrada2==0 && entrada3==1 && entrada4==0){Serial.println( " A correia Possui 2 defeitos" );}
 if (entrada1==1 && entrada2==1 && entrada3==0 && entrada4==0){Serial.println( " A correia Possui 2 defeitos" );}
 if (entrada1==1 && entrada2==0 && entrada3==0 && entrada4==0){Serial.println( " A correia Possui 1 defeito" );}
 if (entrada1==0 && entrada2==1 && entrada3==0 && entrada4==0){Serial.println( " A correia Possui 1 defeito" );}
 if (entrada1==0 && entrada2==0 && entrada3==1 && entrada4==0){Serial.println( " A correia Possui 1 defeito" );}
 if (entrada1==0 && entrada2==0 && entrada3==0 && entrada4==1){Serial.println( " A correia Possui 1 defeito" );}
}


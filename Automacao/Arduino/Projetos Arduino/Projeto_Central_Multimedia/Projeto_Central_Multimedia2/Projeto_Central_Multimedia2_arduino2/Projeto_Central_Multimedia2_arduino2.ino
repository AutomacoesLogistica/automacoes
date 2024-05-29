/* MAPEANDO PINOS DA CENTRAL
>>>>> Arduino 2 <<<<<<<

pino 0 = ok
pino 1 = ok
pino 2 = liga potencia amplificadores ok - em 1 ativa os amplificadores
pino 3 = Pos Chave ok - entrada em 1 ativa a tela 
pino 4 = liga iluminação ok - em 1 ativa a iluminacao
pino 5 = bloqueia tablet ok - saida em 1 fecha 2 cabos para bloquear o tablet
pino 6 = bloquear tablet fisicamente ok - entrada 0 ativa tela
pino 7 = carregar tablet ok
pino 8 = 
pino 9 = 
pino 10 =
pino 11 =
pino 12 =
pino 13 =
pino A0 =
pino A1 =
pino A2 =
pino A3 = 
pino A4 =
pino A5 =

*/
String readString;
int tela_ativa;
int ligado;
int bloqueia;
int carro_ligado;
int ligado_pelo_carro;
int vezes ;
int valor_remote;
int vtbc1,vtbc;
int nvez;
void setup()
{
Serial.begin(9600);

pinMode(2,OUTPUT); // saida para ligar os amplificadores ok
digitalWrite(2,0);
pinMode(3,INPUT); //entrada para receber o sinal do pos chave ok
pinMode(4,OUTPUT);// saida para ativar a iluminação ok
digitalWrite(4,0);
pinMode(5,OUTPUT); // saida para fechar os 2 cabos e bloquear o tablet ou desbloquear ok
digitalWrite(5,0);
pinMode(6,INPUT); //entrada para receber o bloqueio do tablet pelo botao ejetar ok
pinMode(7,OUTPUT); // saida para carregar o tablet ok
digitalWrite(7,0); 
pinMode(8,OUTPUT); // 
digitalWrite(8,0);
pinMode(9,OUTPUT); // 
digitalWrite(9,0);
pinMode(10,OUTPUT); // 
digitalWrite(10,0);
pinMode(11,OUTPUT); // 
digitalWrite(11,0);
pinMode(12,OUTPUT); // remote
digitalWrite(12,0);
pinMode(13,INPUT); //entrada para receber o trancar o tablet pelo botao dvd
digitalWrite(13,1);


pinMode(A0,INPUT); //
digitalWrite(A0,1);
pinMode(A1,INPUT); //
digitalWrite(A1,1);
pinMode(A2,INPUT); //
digitalWrite(A2,1);
pinMode(A3,INPUT); //
digitalWrite(A3,1);
pinMode(A4,INPUT); //
digitalWrite(A4,1);





vtbc,vtbc1 = 0;
tela_ativa = 0; // inicia a tela desligada
ligado = 0;
bloqueia = 0;
carro_ligado = 0;
ligado_pelo_carro = 0;
vezes = 0;
nvez = 0;
valor_remote = 0;
}


void loop ()
{
   
  
  //Se estiver dados para serem exibidos, dados recebidos pela serial do arduino 1

  while (Serial.available()>0) 
  {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  
  // ***************************************************************************
  
  
   if (readString.length()>0) 
   {
    
     Serial.println(readString);
    
   
   
    if (readString.indexOf("bat")>=0)
    {    
      // ENVIANDO O VALOR DA BATERIA DO CARRO
       vtbc1 = analogRead(A5);
       vtbc = map(vtbc1,0,1023,0,15);     
       Serial.println(vtbc); // ENVIO O VALOR DA TENSAO DA BATERIA DO CARRO
       delay(250);
    
    }

   
   
    if (readString.indexOf("reset")>=0)
    {    
     setup();
    }

   
    if (readString.indexOf("rmton")>=0)     
    {
      valor_remote = 1;
      digitalWrite(12,1);
    }

    if (readString.indexOf("rmtoff")>=0)     
    {
      valor_remote = 0;
      digitalWrite(12,0);
    }

   
     if (readString.indexOf("LG")>=0)     
    {
      digitalWrite(8,1);
      delay(1000);
      digitalWrite(8,0);
      
    }

      if (readString.indexOf("portP")>=0)     
    {
      digitalWrite(9,1);
      delay(1000);
      digitalWrite(9,0);
    }
  
      if (readString.indexOf("portG")>=0)
    {
      digitalWrite(10,1);
      delay(1000);
      digitalWrite(10,0);
    }
  
      if (readString.indexOf("LAM")>=0)
    {
      digitalWrite(11,1);
      delay(1000);
      digitalWrite(11,0);
    }

    readString = "";
  }

  
//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@  
//Codigo para ativar a lampada

if (digitalRead(A0)!=1)
{
digitalWrite(8,1);
delay(1000);
digitalWrite(8,0);
}
//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@




//Codigo para ativar o portao grande
if (digitalRead(A1)!=1)
{
digitalWrite(9,1);
delay(1000);
digitalWrite(9,0);
}
//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@


//Codigo para ativar o portao pequeno
if (digitalRead(A2)!=1)
{
digitalWrite(10,1);
delay(1000);
digitalWrite(10,0);
}
//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@



//Codigo para ativar a lampada de arandelas do muro
if (digitalRead(A3)!=1)
{
digitalWrite(11,1);
delay(1000);
digitalWrite(11,0);
}
//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@
  
  
  
// codigo ligar o tablet ou trancar ou destrancar pelo botao fisico
if ( digitalRead(13)==0)
{
 digitalWrite(5,1);
 delay(200); // 
 digitalWrite(5,0);
}

//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@


// mute fisico
if ( digitalRead(A4)!=1)
{
 digitalWrite(2,!digitalRead(2));
 delay(1500);
}

//#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@#@
 
vtbc = analogRead(A5);
 
 
 // *********************************************************************

// ativar iluminação e alimentação dos amplifiadores e carrega o tablet
 if ( tela_ativa == 1 && vezes == 1)
 {
   vezes = 0;
  if(valor_remote == 1)
  {
   digitalWrite(12,1);
  }
  digitalWrite(4,1); //liga as luzes
  digitalWrite(2,1); //ativa a alimentação dos amplificadores
  digitalWrite(7,1); //ativa carregar o tablet
  if (nvez == 0)
  {
  nvez = 1;  
  digitalWrite(5,1); // 
  delay(200);
  digitalWrite(5,0); // 
  }
  delay(3000);
 }

 if ( tela_ativa == 0 && vezes == 0 && digitalRead(3)!=1)
 {
  vezes = 1; 
  digitalWrite(12,0);
  digitalWrite(4,0); // apagam as luzes
  digitalWrite(2,0); // Desativa a alimentação dos amplificadores
  digitalWrite(7,0); // Desativa carregar o tablet
  if (nvez == 1)
  {
   nvez = 0;  
  digitalWrite(5,1); // 
  delay(200);
  digitalWrite(5,0); // 
  }
  delay(3000);
 }
 
 
 // *********************************************************************

// receper o status do pos chaves 
 if (digitalRead(3)==1)
 {
  vezes = 1; 
  tela_ativa = 1 ;
  carro_ligado=1;
  ligado_pelo_carro = 1;
 }

 if (digitalRead(3)==0&&carro_ligado==1)
 
 {
   delay(3000);
   
   if (digitalRead(6)==1)
   {
   tela_ativa = 0 ;
   carro_ligado=0;
   ligado_pelo_carro = 0;
   }
   
   if (digitalRead(6)==0)
   {
     for ( int x = 0; x<3; x++)
     {  
      digitalWrite(4,1); //liga as luzes 
      delay(500); 
      digitalWrite(4,0); //apaga as luzes 
      delay(500); 
      
     }  
    digitalWrite(4,1); // Deixa ligado
   delay(2000);
   carro_ligado=2;
   }
 }



   if ( carro_ligado==2 && digitalRead(6)==0)
   {
    tela_ativa = 0 ;
    carro_ligado = 0;
    ligado_pelo_carro = 0;
   } 
 
// *********************************************





//LIGAR TABLET PELO BOTAO EJETAR
if ( ligado_pelo_carro == 0 )
{

   if (digitalRead(6)==0 && carro_ligado == 0 && bloqueia==0 )
   {
     bloqueia = 1;
     tela_ativa = 1 ;
     delay(1000);
   }  


   if (digitalRead(6)==0 && carro_ligado == 0 && bloqueia==0)
   {
    tela_ativa = 0 ;
     delay(1000);
   }
   
   bloqueia = 0;
}


// ***************************************************************







}


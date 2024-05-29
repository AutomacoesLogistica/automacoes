#include <Servo.h> 
Servo myservoV; 
Servo myservoH; 
String readString1;
String readString2;
String readString3;
String readString4;
String readString5;
String readString6;
String readString7;
String readString8;
String readStringInfo;
int var2,var3,var4,var5,var6;
int modoPan,modoTilt;
int no;

String mensagem;
int val;
int valor;
int n;
int valorV,valorH;
int limV,limH;
String refV,refH;
int v = 110;
int h = 90;
void setup() 
{
 pinMode(2,INPUT); // inverte tilt
 pinMode(4,INPUT); // inverte pan

 
 
 
 pinMode(8,INPUT);
 pinMode(9,INPUT);
 pinMode(10,INPUT);
 pinMode(11,INPUT);
 pinMode(12,INPUT);
 pinMode(13,INPUT);



  
  Serial.begin(9600);
  Serial.println("Iniciado!");
  
  // obter o no do modulo
  if ( digitalRead(8)==1){  var2 = 1;}
  if ( digitalRead(8)==0){  var2 = 0;}
  if ( digitalRead(9)==1){  var3 = 1;}
  if ( digitalRead(9)==0){  var3 = 0;}
  if ( digitalRead(10)==1){  var4 = 1;}
  if ( digitalRead(10)==0){  var4 = 0;}
  if ( digitalRead(11)==1){  var5 = 1;}
  if ( digitalRead(11)==0){  var5 = 0;}
  if ( digitalRead(12)==1){  var6 = 1;}
  if ( digitalRead(12)==0){  var6 = 0;}
  
  // Codigo para converter os binarios em um valor unico decimal compriendido de 0 a 31, sendo 32 numeros
  no = ( ( 16 * var6 ) + ( 8 * var5 ) + ( 4 * var4 ) + ( 2 * var3 ) + ( 1 * var2 ) );
  Serial.print("Modulo usando o no :   ");
  Serial.println(no);
  
  // Define  o modo operacao o Pan    0 = Pan Normal e em 1 = Pan Invertido
  if ( digitalRead(13)==0){  modoPan = 0;  Serial.println("LDR Automatico");}
  if ( digitalRead(13)==1){  modoPan = 1;  Serial.println("LDR Por Rede  ");}

  // Define  o modo operacao o Tilt    1 = Tilt Normal e em 0 = Tilt Invertido
  if ( digitalRead(2)==1){ Serial.println("Tilt Normal");}
  if ( digitalRead(2)==0){ Serial.println("Tilt Invertido");}

  // Define  o modo operacao o Pan    1 = Pan Normal e em 0 = Pan Invertido
  if ( digitalRead(4)==1){ Serial.println("Pan Normal");}
  if ( digitalRead(4)==0){ Serial.println("Pan Invertido");}


  
  myservoV.attach(3);
  myservoH.attach(5);
  
 limV = 160;
 limH = 179;

  myservoH.write(0); 
  myservoV.write(160);
  delay(1000);

for (int a = 0; a<40; a++)
{
  myservoH.write((a*3)*1.5); 
  myservoV.write(160-(a*2.5));
  delay(100);
}
 
 delay(50);
  
for (int b = 0; b<40; b++)
{
  myservoH.write(180-(b*2.25)); 
  myservoV.write(60+(b*1.5)); 
  delay(100);
}
  myservoH.write(90); 
  myservoV.write(110);
  valorV = 0;
  valorH = 0;

  
} //Fecha Setup 

void loop() 
{ 
  while (Serial.available()>0) 
  {
   delay(3);  
   char c = Serial.read();
    readString1 += c;
   
  }
   
   
   
   
   
   
   
   
   
   
   if (readString1 == "m")
   {
   v = v+5;
   if(v>160){v=160;}
   myservoV.write(v);
   
   Serial.println(v);
   }
   
   if (readString1 == "n")
   {
   v = v-5;
   if(v<60){v=60;}
   myservoV.write(v);
   
   Serial.println(v);
   }
 if (readString1 == "v")
   {
   h = h+5;
   if(h>160){h=160;}
   myservoH.write(h);
   
   Serial.println(h);
   }
   
   if (readString1 == "b")
   {
   h = h-5;
   if(h<0){h=0;}
   myservoH.write(h);
   
   Serial.println(h);
   }


/*
   
   if (c ==',')
   {
   n++;
   }
  
   
   else
   {

   if (c =='*'){ n = -2;}
   if (c =='-'){ n = 0; }
   



    if ( n == -2 ){ readStringInfo += c;}
    if ( n == 0 ) { readString1 += c;   }
    if ( n == 1 ) { readString2 += c;   }
    if ( n == 2 ) { readString3 += c;   }
    if ( n == 3 ) { readString4 += c;   }
    if ( n == 4 ) { readString5 += c;   }
    if ( n == 5 ) { readString6 += c;   }
    if ( n == 6 ) { readString7 += c;   }
    if ( n == 7 ) { readString8 += c;   }
   } // fecha else
  }
  
   if (readString1.length()>0) 
   {
    
  if ( readStringInfo == "")
  {    
    Serial.println("  ");
    // 1 byte ************************************************************************************************
    Serial.print("Sincronismo:   "); 
    Serial.println(readString1); 

    // 2 byte ************************************************************************************************
    Serial.print("Endereco:      "); 
    if (readString2.length()<2)
    {
    Serial.print("0"); 
    Serial.println(readString2); 
    }
    else
    {
    Serial.println(readString2);   
    }
        
    // 3 byte ************************************************************************************************
    Serial.print("Comando 1:     "); 
    if (readString3.length()<2)
    {
    Serial.print("0"); 
    Serial.print(readString3); 
    Serial.print("        "); 
    }
    else
    {
    Serial.print(readString3);
    Serial.print("        ");    
    }

    // Adquirindo a funcao
    if (readString3 == "80"){Serial.println("Sensor"); }
    if (readString3 == "40"){Serial.println("Reservado"); }
    if (readString3 == "20"){Serial.println("Reservado"); }
    if (readString3 == "10"){Serial.println("Auto/Procura Manual"); }
    if (readString3 == "08"){Serial.println("Camera Liga / Camera Desliga"); }
    if (readString3 == "04"){Serial.println("Iris Fecha"); }
    if (readString3 == "02"){Serial.println("Iris Abre"); }
    if (readString3 == "01"){Serial.println("Foco Perto"); }
    if (readString3 == "00"){Serial.println(" "); }
    
    // 4 byte ************************************************************************************************
    Serial.print("Comando 2:     "); 
    if (readString4.length()<2)
    {
    Serial.print("0"); 
    Serial.print(readString4); 
    Serial.print("        ");
    }
    else
    {
    Serial.print(readString4);   
    Serial.print("        ");
    }
    
     // Adquirindo a funcao
    if (readString4 == "80"){Serial.println("Foco Longe"); }
    if (readString4 == "40"){Serial.println("Mais Zoom "); }
    if (readString4 == "20"){Serial.println("Menos Zoom"); }
    if (readString4 == "10"){Serial.println("Tilt paraBaixo"); }
    if (readString4 == "08"){Serial.println("Tilt para Cima"); }
    if (readString4 == "04"){Serial.println("Pan para Esquerda"); }
    if (readString4 == "02"){Serial.println("Pan para Direita"); }
    
    // 5 byte ************************************************************************************************
    Serial.print("Data 1:        "); 
    if (readString5.length()<2)
    {
    Serial.print("0"); 
    Serial.print(readString5);
    Serial.print("        "); 
    }
    else
    {
    Serial.print(readString5);   
    Serial.print("        ");
    }

     // Adquirindo a funcao
    if (readString5 == "00"){Serial.println("Pan Parar"); }
    if (readString5 == "01"){Serial.println("Pan Baixa Velocidade"); }
    if (readString5 == "3F"){Serial.println("Pan Alta Velocidade"); }
    if (readString5 == "FF"){Serial.println("Pan Velocidade Turbo"); }
    
    // 6 byte ************************************************************************************************
    Serial.print("Data 2:        "); 
    if (readString6.length()<2)
    {
    Serial.print("0"); 
    Serial.print(readString6);
    Serial.print("        "); 
    }
    else
    {
    Serial.print(readString6);   
    Serial.print("        ");
    }

    // Adquirindo a funcao
    if (readString6 == "00"){Serial.println("Tilt Parar"); }
    if (readString6 == "01"){Serial.println("Tilt Baixa Velocidade"); }
    if (readString6 == "3F"){Serial.println("Tilt Velocidade Maxima"); }
        
    // 7 byte ************************************************************************************************
    Serial.print("Checksun:      "); 
    if (readString7.length()<2)
    {
    Serial.print("0"); 
    Serial.print(readString7); 
    Serial.print("        ");
    }
    else
    {
    Serial.print(readString7);   
    Serial.print("        ");
    }
    
    Serial.println("Valor Checksun  ");    
    Serial.println("        ");    
    
    // ********************************************************************************************************
   }
   
   } // fecha se readStringInfo == ""
  if ( readStringInfo != "")
   {
    Serial.println(readStringInfo);
            if ( readStringInfo == "*info")
            {
            Serial.println("");
            Serial.println("Base PTZ - Bruno Goncalves");
            Serial.print("Modulo usando o no :   ");
            Serial.println(no);  
            // Define  o modo operacao o Pan    0 = Pan Normal e em 1 = Pan Invertido
            if ( digitalRead(13)==0){  modoPan = 0;  Serial.println("LDR Automatico");}
            if ( digitalRead(13)==1){  modoPan = 1;  Serial.println("LDR Por Rede  ");}
            // Define  o modo operacao o Tilt    1 = Tilt Normal e em 0 = Tilt Invertido
            if ( digitalRead(2)==1){ Serial.println("Tilt Normal");}
            if ( digitalRead(2)==0){ Serial.println("Tilt Invertido");}
            // Define  o modo operacao o Pan    1 = Pan Normal e em 0 = Pan Invertido
            if ( digitalRead(4)==1){ Serial.println("Pan Normal");}
            if ( digitalRead(4)==0){ Serial.println("Pan Invertido");}
            readStringInfo = "";
            }
            
            if ( readStringInfo == "*scan")
            {
            setup();
            readStringInfo = "";
            }
    readStringInfo = "";
   }
 
   

   
// SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - 
// SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - 
// SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - 
// SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - 
// SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - SE FOR O MESMO NO - 
//if ( no == readString2.toInt())
// { // Abre se for mesmo no


// FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   -
// FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   -
// FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   -
// FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   - FUNÇÕES COMANDO 2   -



    
//Mapeia a função Tilt Cima *************************************************************************************************************************
if (readString4 == "08")
{
     // Se o Tilt for normal
     if ( digitalRead(2)==1)
     { // abre 2 =1
           if (readString6 == "00") // Parar
          {
           valorV = valorV;
           Serial.println(valorV);
           if( valorV > limV){valorV = limV; }
           myservoV.write(valorV);
           // Aguarda o servo atingir a posição
           delay(10);       
          }
          if (readString6 == "01") // Baixa Velocidade
          {
           valorV++;
           Serial.println(valorV);
           if( valorV > limV){valorV = limV; }
           myservoV.write(valorV);
           // Aguarda o servo atingir a posição
           delay(10);       
          }
      
          if (readString6 == "3F")// Maxima velocidade
          {
           valorV = valorV + 10;
           Serial.println(valorV);
           if( valorV > limV){valorV = limV; }
           myservoV.write(valorV);
           // Aguarda o servo atingir a posição
           delay(10);       
          }
      } // fecha 2 = 1
     
   
      if ( digitalRead(2)==0)
      { // abre 2 = 0
           if (readString6 == "00") // Parar
           {
            valorV = valorV;
            Serial.println(valorV);
            if( valorV < 0){valorV = 0; }
            myservoV.write(valorV);
            // Aguarda o servo atingir a posição
            delay(10);   
           }
           if (readString6 == "01") // Baixa Velocidade
           {
            valorV--;
            Serial.println(valorV);
            if( valorV < 0){valorV = 0; }
            myservoV.write(valorV);
            // Aguarda o servo atingir a posição
            delay(10);   
           }
           if (readString6 == "3F")// Maxima velocidade
           {
            valorV = valorV - 10;
            Serial.println(valorV);
            if( valorV < 0){valorV = 0; }
            myservoV.write(valorV);
            // Aguarda o servo atingir a posição
            delay(10);   
           } 
      } // fecha 2 = 0

} //fecha tilt cima
   
//Mapeia a função Tilt Baixo *************************************************************************************************************************
if (readString4 == "10")
{
     if ( digitalRead(2)==1)
     { // abre 2 = 1
         if (readString6 == "00") // Parar
         {
          valorV = valorV;
          Serial.println(valorV);
          if( valorV < 0){valorV = 0; }
          myservoV.write(valorV);
          // Aguarda o servo atingir a posição
          delay(10);   
         }
         if (readString6 == "01") // Baixa Velocidade
         {
          valorV--;
          Serial.println(valorV);
          if( valorV < 0){valorV = 0; }
          myservoV.write(valorV);
          // Aguarda o servo atingir a posição
          delay(10);   
         }
         if (readString6 == "3F")// Maxima velocidade
         {
          valorV = valorV - 10;
          Serial.println(valorV);
          if( valorV < 0){valorV = 0; }
          myservoV.write(valorV);
          // Aguarda o servo atingir a posição
          delay(10);   
         }
     } // fecha 2 = 1
     
     if ( digitalRead(2)==0)
     { // abre 2 = 0
          if (readString6 == "00") // Parar
          {
           valorV = valorV;
           Serial.println(valorV);
           if( valorV > limV){valorV = limV; }
           myservoV.write(valorV);
           // Aguarda o servo atingir a posição
           delay(10);       
          }
          if (readString6 == "01") // Baixa Velocidade
          {
           valorV++;
           Serial.println(valorV);
           if( valorV > limV){valorV = limV; }
           myservoV.write(valorV);
           // Aguarda o servo atingir a posição
           delay(10);       
          }
      
          if (readString6 == "3F")// Maxima velocidade
          {
           valorV = valorV + 10;
           Serial.println(valorV);
           if( valorV > limV){valorV = limV; }
           myservoV.write(valorV);
           // Aguarda o servo atingir a posição
           delay(10);       
          }
     } // fecha 2 = 0
} // fecha tilt baixo    

//Mapeia a função Pan Esquerda *************************************************************************************************************************
if (readString4 == "04")
{
      if ( digitalRead(4)==1)
      { 
           if (readString5 == "00") // Parar
           {
            valorH = valorH;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
           if (readString5 == "01") // Baixa velocidade
           {
            valorH--;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
           if (readString5 == "3F") // Velocidade Alta
           {
            valorH = valorH - 10;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
           if (readString5 == "FF") // Velocidade Turbo
           {
            valorH = valorH - 20;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
      } // fecha 3 = 1
      
      if ( digitalRead(4)==0)
      { // abre 4 = 0
          if (readString5 == "00") // Parar
          {
           valorH = valorH;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }
          if (readString5 == "01") // Velocidade Baixa
          {
           valorH++;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }
          if (readString5 == "3F") // Velocidade Alta
          {
           valorH = valorH + 10;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }
          if (readString5 == "FF") // Velocidade Turbo
          {
           valorH = valorH +20;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }      
      } // fecha 4 = 0 
           
} //fecha pan esquerda   
    
//Mapeia a função Pan Direita *************************************************************************************************************************
if (readString4 == "02")
{
       if ( digitalRead(4)==1)
       { 
          if (readString5 == "00") // Parar
          {
           valorH = valorH;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }
          if (readString5 == "01") // Velocidade Baixa
          {
           valorH++;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }
          if (readString5 == "3F") // Velocidade Alta
          {
           valorH = valorH + 10;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          }
          if (readString5 == "FF") // Velocidade Turbo
          {
           valorH = valorH +20;
           Serial.println(valorH);
           if( valorH > limH){valorH = limH; }
           myservoH.write(valorH);
           // Aguarda o servo atingir a posição
           delay(10); 
          } 
      } // fecha 4 = 1

      if ( digitalRead(4)==0)
      {
           if (readString5 == "00") // Parar
           {
            valorH = valorH;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
           if (readString5 == "01") // Baixa velocidade
           {
            valorH--;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
           if (readString5 == "3F") // Velocidade Alta
           {
            valorH = valorH - 10;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
           if (readString5 == "FF") // Velocidade Turbo
           {
            valorH = valorH - 20;
            Serial.println(valorH);
            if( valorH < 0){valorH = 0; }
            myservoH.write(valorH);
            // Aguarda o servo atingir a posição
            delay(10);    
           }
      } // fecha 4 = 0
} //fecha pan direita
    
// FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   -                            
// FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   -                            
// FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   -                            
// FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   - FUNÇÕES COMANDO 1   -                            


//Mapeia a função Zoom Mais *************************************************************************************************************************
if (readString4 == "40")
{
  
} 

//Mapeia a função Zoom Menos *************************************************************************************************************************
if (readString4 == "20")
{
  
} 

//Mapeia a função Foco longe *************************************************************************************************************************
if (readString4 == "80")
{
  
} 




//Mapeia a função Sensor *************************************************************************************************************************
if (readString3 == "80")
{
  
} 

//Mapeia a função Reservado 1 *************************************************************************************************************************
if (readString3 == "40")
{
  
} 

//Mapeia a função Reservado 2 *************************************************************************************************************************
if (readString3 == "20")
{
  
} 

//Mapeia a função Procura Automatica / Manual *********************************************************************************************************
if (readString3 == "10")
{
  
} 

//Mapeia a função Câmera Liga / Câmera Desliga ********************************************************************************************************
if (readString3 == "08")
{
  
} 

//Mapeia a função Iris Fecha **************************************************************************************************************************
if (readString3 == "04")
{
  
} 

//Mapeia a função Iris Abre ***************************************************************************************************************************
if (readString3 == "02")
{
  
} 

//Mapeia a função Foco Perto **************************************************************************************************************************
if (readString3 == "01")
{
  
} 
        






  
    
//   } //Fecha se tem modulo








// ********************************************************************************************************

*/


  
   // Limpa dados
   readString1="";
   readString2="";
   readString3="";
   readString4="";
   readString5="";
   readString6="";
   readString7="";
   readString8="";
   readStringInfo="";
   n =0;
}

int menu = 1;
int temp1;
int temp2;
int temp3;
int temp4;
int temp5;
int temp6;
int temp7;
int temp8;
int temp9;
int temp10;
int t1;
int t2;
int t3;
int t4;
int t5;
int t6;
int t7;
int t8;
int t9;
int t10;
int programa;


int contador = 0;
int senha1 = 0;
int senha2 = 0;
int senha3 = 0;
int senha4 = 0;
int senha5 = 0;
int key;
#include <LiquidCrystal.h>

// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(12, 11, 5, 4, 3, 6);


void setup()
{
 lcd.begin(16, 2);
  Serial.begin(9600);
programa = 10;
temp1 = 20;
temp2 = 20;
temp3 = 20;
temp4 = 20;
temp5 = 20;
temp6 = 20;
temp7 = 20;
temp8 = 20;
temp9 = 20;
temp10 = 20;
pinMode(2, INPUT);
digitalWrite(2,0);
pinMode(3, OUTPUT);

delay(2500);
lcd.clear();delay(10);

lcd.setCursor(0,0);
lcd.print("DESPOEIRADOR MB2");delay(1000);
lcd.setCursor(0,0);
lcd.print("MB2             ");
lcd.setCursor(0,1);
lcd.print("DESPOEIRADOR    ");delay(1000);
lcd.clear();delay(10);
lcd.setCursor(0,1);
lcd.print("MB2 DESPOEIRADOR");delay(1000);
lcd.setCursor(0,0);
lcd.print("    DESPOEIRADOR");
lcd.setCursor(0,1);
lcd.print("             MB2");delay(1000);
lcd.clear();delay(10);
lcd.setCursor(0,0);
lcd.print("DESPOEIRADOR MB2");delay(1000);


lcd.setCursor(0,0);
lcd.print("MB2             ");
lcd.setCursor(0,1);
lcd.print("DESPOEIRADOR    ");delay(1000);
lcd.clear();delay(10);
lcd.setCursor(0,1);
lcd.print("MB2 DESPOEIRADOR");delay(1000);
lcd.setCursor(0,0);
lcd.print("    DESPOEIRADOR");
lcd.setCursor(0,1);
lcd.print("             MB2");delay(1000);

lcd.clear();delay(10);
lcd.setCursor(0,0);
lcd.print("DESPOEIRADOR MB2");delay(1000);
lcd.setCursor(0,0);
lcd.print("MB2             ");
lcd.setCursor(0,1);
lcd.print("DESPOEIRADOR    ");delay(1000);
lcd.clear();delay(10);
lcd.setCursor(0,1);
lcd.print("MB2 DESPOEIRADOR");delay(1000);
lcd.setCursor(0,0);
lcd.print("    DESPOEIRADOR");
lcd.setCursor(0,1);
lcd.print("             MB2");delay(1000);

lcd.setCursor(0,0);
lcd.clear();delay(10);
lcd.print("DESPOEIRADOR MB2");delay(2000);
lcd.setCursor(0,0);
lcd.clear();delay(500);
lcd.print("DESPOEIRADOR MB2");delay(500);
lcd.setCursor(0,0);
lcd.clear();delay(500);
lcd.print("DESPOEIRADOR MB2");delay(500);
lcd.setCursor(0,0);
lcd.clear();delay(500);
lcd.print("DESPOEIRADOR MB2");delay(500);
lcd.clear();delay(1000);

lcd.print("BRUNO GONCALVES ");
lcd.setCursor(0,1);
lcd.print("TEL:(31)88494604");
delay(3000);
lcd.clear();delay(2000);

}

void loop()
{
int a=analogRead(A0);//frente ou tras
int b=analogRead(A1);// cima ou baixo
// DIGITAR A SENHA ..............................................................................................................................................................
if(programa==10)
{
     if(a>=1000&&senha1<=8&&contador==0)
     {senha1++;}
     if(a>=1000&&senha2<=8&&contador==1)
     {senha2++;}
     if(a>=1000&&senha3<=8&&contador==2)
     {senha3++;}
     if(a>=1000&&senha4<=8&&contador==3)
     {senha4++;}
     if(a>=1000&&senha5<=8&&contador==4)
     {senha5++;}


     
     if(a<=40&&senha1>0&&contador==0)
     {senha1--;} 
     if(a<=40&&senha2>0&&contador==1)
     {senha2--;} 
     if(a<=40&&senha3>0&&contador==2)
     {senha3--;} 
     if(a<=40&&senha4>0&&contador==3)
     {senha4--;} 
     if(a<=40&&senha5>0&&contador==4)
     {senha5--;} 
     
     lcd.setCursor(0,0);
     lcd.print("Digite a Senha  ");delay(100);      
     lcd.setCursor(contador, 1);
     if(contador==0)
     {lcd.print(senha1);}
     if(contador==1)
     {lcd.print(senha2);}
     if(contador==2)
     {lcd.print(senha3);}
     if(contador==3)
     {lcd.print(senha4);}
     if(contador==4)
     {lcd.print(senha5);}
     
     
     delay(10);
     
     if(key=digitalRead(2)==1&&senha1&&contador==0)
     {contador = 1;lcd.setCursor(0,1);lcd.print("*");senha2 = 0;delay(300);}
     if(key=digitalRead(2)==1&&senha2&&contador==1)
     {contador = 2;lcd.setCursor(1,1);lcd.print("*");senha3 = 0;delay(300);}
     if(key=digitalRead(2)==1&&senha3&&contador==2)
     {contador = 3;lcd.setCursor(2,1);lcd.print("*");senha4 = 0;delay(300);}
     if(key=digitalRead(2)==1&&senha4&&contador==3)
     {contador = 4;lcd.setCursor(3,1);lcd.print("*");senha5 = 0;delay(300);}
     if(key=digitalRead(2)==1&&senha5&&contador==4)
     {contador = 5;lcd.setCursor(4,1);lcd.print("*");delay(300);}
  
     if (b<=40){contador = 0;senha1 = 0;senha2 = 0;senha3 = 0;senha4 = 0;senha5 = 0;lcd.clear();}
     
     delay(200);
     
     
     if(contador==5)
     {
         if(senha1==5&&senha2==4&&senha3==5&&senha4==2&&senha5==4)
         {  
         lcd.clear(); 
         lcd.print(" Senha Correta! ");
         delay(2000);
         contador = 0;
         programa = 0;
         lcd.clear();
         }
     else
        {
        lcd.clear();
        lcd.print("Senha Incorreta!");
        delay(2000);
        contador = 0;
        programa = 10;
        senha1 = 0;
        senha2 = 0;        
        senha3 = 0;        
        senha4 = 0;
        senha5 = 0;        
        lcd.clear();
        lcd.print("Digite a senha: ");
        }
      
}
}
//........................................................



// PARA CONFIGURA OS TEMPOS .....................................................................................................................................................
if(digitalRead(2)==1&&programa==0)
{
programa = 1;menu = 1;delay(1000);// se apertar a analogica faz entrar no programa
t1=temp1;
t2=temp2;
t3=temp3;
t4=temp4;
t5=temp5;
t6=temp6;
t7=temp7;
t8=temp8;
t9=temp9;
t10=temp10;
  lcd.setCursor(0,0);
  lcd.print("Entrando no     ");
  lcd.setCursor(0,1);
  lcd.print("Programa        ");
  delay(2500);lcd.clear();delay(100);
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde         ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .       ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ..      ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ...     ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....    ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .....   ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ......  ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....... ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ........");
  
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde         ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .       ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ..      ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ...     ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....    ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .....   ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ......  ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....... ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ........");
  
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde         ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .       ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ..      ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ...     ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....    ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .....   ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ......  ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....... ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ........");
  delay(250);
  lcd.clear();
  delay(1000);
  

}  

//.........................................................................................................


if(programa==0&&digitalRead(2)!=1);
{
  if(b>=1000&&menu!=10&&programa==0){menu++;delay(250);Serial.print("MENU    ");Serial.println(menu);}
  if(b<=400&&menu!=1&&programa==0){menu--;delay(250);Serial.print("MENU    ");Serial.println(menu);}

  if(menu==1&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 1     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp1);delay(100);
  if(a>=1000){temp1++;delay(150);Serial.println(temp1);}
  if(a<=400){temp1--;delay(150);Serial.println(temp1);}
  else{}
  }

  if(menu==2&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 2     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp2);delay(100);
  if(a>=1000){temp2++;delay(250);Serial.println(temp2);}
  if(a<=400){temp2--;delay(250);Serial.println(temp2);}
  else{}
  }

  if(menu==3&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 3     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp3);delay(100);
  if(a>=1000){temp3++;delay(250);Serial.println(temp3);}
  if(a<=400){temp3--;delay(250);Serial.println(temp3);}
  else{}
  }

  if(menu==4&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 4     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp4);delay(100);
  if(a>=1000){temp4++;delay(250);Serial.println(temp4);}
  if(a<=400){temp4--;delay(250);Serial.println(temp4);}
  else{}
  }

  if(menu==5&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 5     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp5);delay(100);
  if(a>=1000){temp5++;delay(250);Serial.println(temp5);}
  if(a<=400){temp5--;delay(250);Serial.println(temp5);}
  else{}
  }

  if(menu==6&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 6     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp6);delay(100);
  if(a>=1000){temp6++;delay(250);Serial.println(temp6);}
  if(a<=400){temp6--;delay(250);Serial.println(temp6);}
  else{}
  }

  if(menu==7&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 7     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp7);delay(100);
  if(a>=1000){temp7++;delay(250);Serial.println(temp7);}
  if(a<=400){temp7--;delay(250);Serial.println(temp7);}
  else{}
  }

  if(menu==8&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 8     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp8);delay(100);
  if(a>=1000){temp8++;delay(250);Serial.println(temp8);}
  if(a<=400){temp8--;delay(250);Serial.println(temp8);}
  else{}
  }

  if(menu==9&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 9     ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp9);delay(100);
  if(a>=1000){temp9++;delay(250);Serial.println(temp9);}
  if(a<=400){temp9--;delay(250);Serial.println(temp9);}
  else{}
  }

  if(menu==10&&programa==0)
  {
  lcd.setCursor(0,0);
  lcd.print("Solenoide 10    ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp10);delay(100);
  if(a>=1000){temp10++;delay(250);Serial.println(temp10);}
  if(a<=400){temp10--;delay(250);Serial.println(temp10);}
  else{}
  }

}  
// finaliza configurações .................................................................................



// RODA O PRGRAMA .................................................................................................................................................

if(digitalRead(2)==1&&programa==1)
{
programa = 10; // se apertar a analogica volta as configurações 
lcd.clear();delay(100);
lcd.setCursor(0,0);
lcd.print("Entrando em     ");
lcd.setCursor(0,1);
lcd.print("Configuracoes   ");
delay(2500);lcd.clear();delay(100);

lcd.setCursor(0,0);
  lcd.print("Aguarde         ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .       ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ..      ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ...     ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....    ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .....   ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ......  ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....... ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ........");
  
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde         ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .       ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ..      ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ...     ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....    ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .....   ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ......  ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....... ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ........");
  
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde         ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .       ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ..      ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ...     ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....    ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde .....   ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ......  ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ....... ");
  delay(250);
  lcd.setCursor(0,0);
  lcd.print("Aguarde ........");
  delay(250);
  lcd.clear();senha1 = 0;senha2 = 0;senha3 = 0;senha4 = 0;senha5 = 0;
  delay(1000);
  
}

// .........................................................................................................





// RODAR O PROGRAMA .............................................................................................................................................................

if(digitalRead(2)!=1&&programa==1)
{

  if(menu==1)// para disparar a solenoide 1 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp1--;
  Serial.print ("Solenoide =     ");
  Serial.println("1");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 1   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp1);
  delay(200);
  if(temp1==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 1     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 1 ");temp1=t1;
    }
  }
 // ...........................................................


  if(menu==2)// para disparar a solenoide 2 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp2--;
  Serial.print ("Solenoide =     ");
  Serial.println("2");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 2   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp2);
  delay(200);

  if(temp2==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 2     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 2 ");temp2=t2;
    }
  }
 // ...........................................................

  if(menu==3)// para disparar a solenoide 3 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp3--;
  Serial.print ("Solenoide =     ");
  Serial.println("3");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 3   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp3);
  delay(200);

  if(temp3==0)
    {
digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 3     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 3 ");temp3=t3;
    }
  }
 // ...........................................................

  if(menu==4)// para disparar a solenoide 4 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp4--;
  Serial.print ("Solenoide =     ");
  Serial.println("4");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 4   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp4);
  delay(200);

  if(temp4==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 4     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 4 ");temp4=t4;
    }
  }
 // ...........................................................

  if(menu==5)// para disparar a solenoide 5 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp5--;
  Serial.print ("Solenoide =     ");
  Serial.println("5");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 5   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp5);
  delay(200);

  if(temp5==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 5     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 5 ");temp5=t5;
    }
  }
 // ...........................................................

  if(menu==6)// para disparar a solenoide 6 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp6--;
  Serial.print ("Solenoide =     ");
  Serial.println("6");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 6   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp6);
  delay(200);

  if(temp6==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 6     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 6 ");temp6=t6;
    }
  }
 // ...........................................................

  if(menu==7)// para disparar a solenoide 7 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp7--;
  Serial.print ("Solenoide =     ");
  Serial.println("7");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 7   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp7);
  delay(200);

  if(temp7==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 7     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 7 ");temp7=t7;
    }
  }
 // ...........................................................

  if(menu==8)// para disparar a solenoide 8 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp8--;
  Serial.print ("Solenoide =     ");
  Serial.println("8");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 8   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp8);
  delay(200);

  if(temp8==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 8     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 8 ");temp8=t8;
    }
  }
 // ...........................................................

  if(menu==9)// para disparar a solenoide 9 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp9--;
  Serial.print ("Solenoide =     ");
  Serial.println("9");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 9   ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp9);
  delay(200);

  if(temp9==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 9     ");
    delay(1000);  
    lcd.clear();delay(100);
    menu++;  
    Serial.println("Disparado a solenoide 9 ");temp9=t9;
    }
  }
 // ...........................................................

  if(menu==10)// para disparar a solenoide 10 ..................
  {
  digitalWrite(13,0);
  delay(1000);
  temp10--;
  Serial.print ("Solenoide =     ");
  Serial.println("10");
  lcd.setCursor(0,0);
  lcd.print("Solenoide = 10  ");
  lcd.setCursor(0,1);
  lcd.print("Tempo =         ");
  lcd.setCursor(8,1);
  lcd.print(temp10);
  delay(200);

  if(temp10==0)
    {
    digitalWrite(13,1);
    lcd.clear();delay(100);
    lcd.setCursor(0,0);
    lcd.print("Disparado a     ");
    lcd.setCursor(0,1);
    lcd.print("Solenoide 10    ");
    delay(1000);  
    lcd.clear();delay(100);
    menu = 1;  
    Serial.println("Disparado a solenoide 10 ");temp10=t10;
    }
  }
 // ...........................................................


}// finaliza programa

} // finaliza o loop


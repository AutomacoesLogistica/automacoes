// Alterado dia 30/07/2017 para corrigir problemas dos pistoes


# define lampada = 7;
# define ppequeno = 4;
# define pgrande = 5;

int tranca;
int contador; // contador de menu para funcionamento
int contadorlampada ;
void setup()
{
 pinMode(A0,OUTPUT); // solenoide 1 alimenta abrir
 pinMode(A1,OUTPUT); // solenoide 2
 pinMode(A2,OUTPUT); // solenoide 3
 pinMode(A3,OUTPUT); // solenoide 4
 pinMode(A4,OUTPUT); // solenoide 5 alimenta fechar
 pinMode(A5,OUTPUT); // solenoide 6 dreno fechar
 
 pinMode(2,INPUT); // sensor aberto
 pinMode(3,INPUT); // sensor fechado
 pinMode(4,OUTPUT); // portao pequeno
 pinMode(5,OUTPUT); 
 pinMode(6,INPUT); // recebe comando portao grande
 pinMode(7,OUTPUT); // lampada
 pinMode(8,OUTPUT); // tranca eletromagnetica
 pinMode(9,INPUT); // comando para o portao pequeno
 pinMode(10,INPUT); // comando para a lampada
 pinMode(11,OUTPUT); // comando para tranca mecanica

 
 contador = 0; // contador de menu para funcionamento
 contadorlampada = 0;
  tranca = 0;
  // Estado incial das portas
  digitalWrite(7, LOW);
  digitalWrite(4, LOW);

}



void loop()
{
   
   
  // portao pequeno
  if (digitalRead(9)==1)
  {
  digitalWrite(4, HIGH); // da um pulso no eletroima do portao pequeno
  delay(1000);
  digitalWrite(4, LOW); // retira o pulso do eletroima do portao pequeno
  delay(2000);
  }


// COMANDO LAMPADA .........................................................................................................................................................................

 if(digitalRead(10)==1) // verifica se chegou algum comando para ligar a lampada
 {
  digitalWrite(7,!digitalRead(7));
  delay(2000);
  }




// COMANDO PARA ABRIR / FECHAR O PORTAO .............................................................................................................................................................
  
   if(digitalRead(6)==1)
   {
    if (contador==0) // Se reber o comando do controle para abrir
    { 
     contador = 1;
    }
   
    if (contador==2) // Se reber o comando do controle para abrir
    { 
     contador = 3;
    }
   }


if (contador==1)
{
ABRIR();  
}

if (contador==3)
{
FECHAR();  
}

//TRAVA ELETROMAGNETICA  ..................................................................................................................................................................
if(contador==0&&digitalRead(3)==0)// se estiver fora dos programas e o sensor de fechado atuado, energiza sempre a tranca
{
 digitalWrite(8,1); // energiza solenoide
 contador = 0;
 tranca = 0;
}



}// fecha loop
















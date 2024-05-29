/*
 *  teste dip switch 6 posicoes
 * 
 * 
 * 
 * 
 */

int var2,var3,var4,var5,var6;
int modo;
int no;


void setup() 
{
pinMode(2,INPUT);
pinMode(3,INPUT);
pinMode(4,INPUT);
pinMode(5,INPUT);
pinMode(6,INPUT);
pinMode(7,INPUT);

Serial.begin(9600);

if ( digitalRead(2)==1)
{
  var2 = 1;
}
if ( digitalRead(2)==0)
{
  var2 = 0;
}

if ( digitalRead(3)==1)
{
  var3 = 1;
}
if ( digitalRead(3)==0)
{
  var3 = 0;
}

if ( digitalRead(4)==1)
{
  var4 = 1;
}
if ( digitalRead(4)==0)
{
  var4 = 0;
}

if ( digitalRead(5)==1)
{
  var5 = 1;
}
if ( digitalRead(5)==0)
{
  var5 = 0;
}

if ( digitalRead(6)==1)
{
  var6 = 1;
}
if ( digitalRead(6)==0)
{
  var6 = 0;
}

// Define  o modo    em 0 = recebe e em 1 = envia
if ( digitalRead(7)==1)
{
  modo = 1;
  Serial.println("Em modo de Transmissao!");
  
}
if ( digitalRead(7)==0)
{
  modo = 0;
  Serial.println("Em modo de Recepcao!");
}




// Codigo para converter os binarios em um valor unico decimal compriendido de 0 a 31, sendo 32 numeros
no = ( ( 16 * var6 ) + ( 8 * var5 ) + ( 4 * var4 ) + ( 2 * var3 ) + ( 1 * var2 ) );


Serial.println(no);
}

void loop() {
  // put your main code here, to run repeatedly:

}

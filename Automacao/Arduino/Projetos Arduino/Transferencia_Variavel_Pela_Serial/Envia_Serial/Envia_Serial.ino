/*
GA AUTOMAÇÔES
transferencia de variavel inteira pela serial
*/

void setup() 
{
 Serial.begin(9600);
}

void loop()
{
 int valor = analogRead(A0); //le o valor da porta e atribui a variavel
 Serial.println(valor); // imprime a variavel
 Serial.println(""); // nao retira isso, pois isso que faz o arduino que recebe saber que acabou a mensagem enviada
 delay(70); // esse valor nao pode ser mudado , esse foi o minimo que funcionou redondo
}

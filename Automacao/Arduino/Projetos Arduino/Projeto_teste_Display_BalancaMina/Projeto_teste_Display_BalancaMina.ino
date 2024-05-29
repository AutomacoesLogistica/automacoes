long int valor;
void setup() 
{
Serial.begin(9600);
}

void loop() 
{



Serial.print("_BALANCA_LIBERADA_!_");// Mensagem 1
Serial.print(",");
Serial.print("____________________");// Mensagem 2
Serial.print("~");
Serial.print("000000");// Peso
Serial.print("*\n");
delay(4000);

valor = millis()+42000;  

Serial.print("_____AVANCAR_!______");// Mensagem 1
Serial.print(",");
Serial.print("____________________");// Mensagem 2
Serial.print("~");
Serial.print("000000");// Peso
Serial.print("*\n");
delay(4000);

valor = (millis()/1000)+42000;

Serial.print("_MOSTRE_O_CARTAO_!__");// Mensagem 1
Serial.print(",");
Serial.print("____________________");// Mensagem 2
Serial.print("~");
Serial.print("0");// Peso
Serial.print(valor);// Peso
Serial.print("*\n");
delay(4000);

valor = (millis()/1000)+42000;

Serial.print("ESTABILIZANDO_PESO!_");// Mensagem 1
Serial.print(",");
Serial.print("____________________");// Mensagem 2
Serial.print("~");
Serial.print("0");// Peso
Serial.print(valor);// Peso
Serial.print("*\n");
delay(4000);

valor = (millis()/1000)+42000;
Serial.print("_REGISTRANDO_PESO_!_");// Mensagem 1
Serial.print(",");
Serial.print("____________________");// Mensagem 2
Serial.print("~");
Serial.print("0");// Peso
Serial.print(valor);// Peso
Serial.print("*\n");
delay(4000);

valor = (millis()/1000)+42000;
Serial.print("___PESO_OK_BA_OLE___");// Mensagem 1
Serial.print(",");
Serial.print("___4519_-_045678Kg__");// Mensagem 2
Serial.print("~");
Serial.print("0");// Peso
Serial.print(valor);// Peso
Serial.print("*\n");

delay(10000);

Serial.print("____________________");// Mensagem 1
Serial.print(",");
Serial.print("____________________");// Mensagem 2
Serial.print("~");
Serial.print("000000");// Peso
Serial.print("*\n");
delay(2000);

}

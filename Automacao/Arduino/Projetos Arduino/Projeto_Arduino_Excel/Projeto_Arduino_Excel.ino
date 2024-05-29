float pinoPotenciometro = 0;    //  variavel que define a porta do potenciometro.
int linha = 0;         // variavel que se refere as linhas do excel
int LABEL = 1;   
int valor = 0;               // variavel que guarda o valor lido do potenciometro
void setup(){
Serial.begin(9600);                     //  inicialização da comunicação serial
Serial.println("CLEARDATA");            // Reset da comunicação serial
Serial.println("LABEL,Hora,valor,linha");   // Nomeia as colunas
}

void loop(){

valor = random(10);   // faz a leitura do potenciometro e guarda o valor em val.
linha++; // incrementa a linha do excel para que a leitura pule de linha em linha

Serial.print("DATA,TIME,"); //inicia a impressão de dados, sempre iniciando 
Serial.print(valor); 
Serial.print(",");
Serial.println(linha);

if (linha > 100) //laço para limitar a quantidade de dados
{
linha = 0;
Serial.println("CLEARDATA");            // Reset da comunicação serial
Serial.println("LABEL,Hora,valor,linha");   // Nomeia as colunas

//Serial.println("ROW,SET,2"); // alimentação das linhas com os dados sempre iniciando
}
delay(500);  // espera 200 milisegundos


}

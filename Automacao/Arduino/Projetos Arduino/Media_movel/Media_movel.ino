#define SENSOR A0
#define N 50 // Numero de amostas

int media; // Recebe a media
int valores[N]; // Array para armazenar os valores lidos
long soma; // Variavel para somar os valores 


void setup()
{
 Serial.begin(9600);
}

void loop() 
{
 int valorLido = analogRead(SENSOR);

 // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
 
 for(int i = N-1;i>0;i--)
 {
  valores[i] = valores[i-1];
 }

 // *************************************************************************************************************************************
 

  valores[0] = valorLido; // Coloca o valor mais atual em valores[0]
  soma = 0;  // Limpa a variavel de soma



  // For para calcular a media atualizada *************************************************************************************************
  for (int i=0;i<N;i++)
  {
    soma = soma+valores[i];
  }

  // ***************************************************************************************************************************************
  
  
  media = soma/N;




Serial.print(valorLido); // Imprime o valor do sensor instantâneo
Serial.print("\t"); // Da um TAB
Serial.println(media); // Imprime o valor sendo corrigido pela média móvel


} // Fecha o loop

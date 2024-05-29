/* 
 SCK = Pino 2
 DT = pino 3
  

 
 
 
 
 tutorial: Calibração de uma Célula de Carga 
*/

 
#include "HX711.h" //Biblioteca do HX711.h

HX711 balanca;                                                                        // SCK= pino 2 e DT= pino 3 

float calibration_factor = 48011.00;                                                        // Fator de calibração para ajuste da célula
float peso;                                                                                 // variável peso
float peso_botijao_vazio = 14.25;

#define N 60 // Numero de amostas
float media; // Recebe a media
int valores[N]; // Array para armazenar os valores lidos
float soma; // Variavel para somar os valores 


void setup() {                                                                              // rotina de configurações
  Serial.begin(115200);                                                                       // Baud rate da comunicação 
  Serial.println("Remova todos os pesos da balança");                                       // Printa "Remova todos os pesos da balança" na COM 
  delay(5000);                                                                              // atraso de 1000ms = 1s
  Serial.println("Após estabilização das leituras, coloque o peso conhecido na balança");   // Printa "Após estabilização das leituras, coloque o peso conhecido na balança" na COM 
  delay(1000);                                                                              // atraso de 1000ms = 1s
  Serial.println("Pressione + para incrementar o fator de calibração");                     // Printa "Pressione + para incrementar o fator de calibração" na COM
  Serial.println("Pressione - para decrementar o fator de calibração");                     // Printa "Pressione - para decrementar o fator de calibração" na COM
  delay(1000);
  balanca.begin(3,2);// atraso de 1000ms = 1s
  balanca.set_scale();                                                                      // seta escala
  balanca.tare();                                                                           // escala da tara

  long zero_factor = balanca.read_average();
  
}

void loop() {                                                                               // chama função de loop

  balanca.set_scale(calibration_factor);                                                    // a balanca está em função do fator de calibração 

  peso = balanca.get_units(), 10;                                                           // imprime peso
  
  if (peso < 0)                                                                             // se a unidade for menor que 0 será considerado 0
  {
    peso = 0.00;                                                                            // Para o caso do peso ser negativo, o valor apresentado será 0 
  }                                                  
  else
  {
   float peso_liquido;
   peso_liquido = (peso - peso_botijao_vazio)+0.95; // -1 para ajustar o peso das mangueiras
   for(int i = N-1;i>0;i--)
   {
    valores[i] = valores[i-1];
   }
   valores[0] = peso_liquido; // Coloca o valor mais atual em valores[0]
   soma = 0;  // Limpa a variavel de soma
   for (int i=0;i<N;i++)
   {
    soma = soma+valores[i];
   }
   
   media = soma/N;
     
   float peso_bruto = peso;
   float gas;

   gas = ((media * 100)/13);
   if(int(gas) >=100)
   {
    gas = 100.0;
   }
   Serial.print("Peso Bruto = ");Serial.print(peso);
   Serial.print(" Kg   -  Peso Liguido = ");Serial.print(media);
   Serial.print(" Kg  -  Gas = ");Serial.print(gas);
   Serial.println(" %");
  }
  Serial.println();                                                                         // Pula linha no serial
  delay(1000);                                                                               // atraso de 500ms = 0.5s






  if(Serial.available())                                                                    // caso sejam inseridos caracteres no serial
  {
    char temp = Serial.read();
    if(temp == '+')                                                                         // Se o + for pressionado
      calibration_factor += 1;                                                              // incrementa 1 no fator de calibração
    else if(temp == '-')                                                                    // Caso o - seja pressionado
      calibration_factor -= 1;                                                              // Decrementa 1 do fator de calibração
  }
}

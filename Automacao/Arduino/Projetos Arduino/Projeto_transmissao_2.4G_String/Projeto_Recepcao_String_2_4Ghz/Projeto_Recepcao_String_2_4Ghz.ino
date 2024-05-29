int valor_recebido; //Cria uma variável para armazenar os valores recebidos pela Serial
char valor_enviado; //Cria uma variável para armazenar os valores que serão enviados pela Serial

boolean estadoBotao=false; //Cria uma variável para armazenar o estado do botão
boolean estadoBotao_anterior=false; //Cria uma variável para armazenar o estado anterior do botão
boolean habilita_botao=true; //Variável para habilitar o enviado dos dados do botão

void setup()
{
  Serial.begin(9600); //Inicia uma comunicação Serial com Baud Rate de 9600
  pinMode(2, OUTPUT); //Define o pino 2 como saída
  pinMode(3, OUTPUT); //Define o pino 3 como saída
  pinMode(8, INPUT_PULLUP); //Define o pino 8 como entrada e com resistor de pull-up ativo
}

void loop()
{ 
  int valor_pot = 0; //Inicia a variável para armazenar os valores do potenciômetro com 0
  
  for(int i=0;i<100;i++) //Efetua 100 vezes a leitura do potenciômetro
  {
  int leitura = map(analogRead(A0), 0, 1023, 0, 180); //Le o valor do potenciômetro,
                                                       //Converte para uma escala de 0 a 180
                                                       //e Armazena na variável leitura
  valor_pot += leitura; //Soma a variável leitura ao valor anterior de valor_pot (que inicia com 0)
  }
  
  valor_pot = valor_pot/100; //Divide o valor_pot por 100 para tirar a média das leituras
  
  Serial.write(valor_pot); //Envia para a interface (Processing) o valor lido pelo potenciometro
                           //que será um valor de 0 a 180
  
  estadoBotao = digitalRead(8); //Faz a leitura do botão

  if (estadoBotao != estadoBotao_anterior) //Se o estado for diferente do estado anterior
  {
    
    if(habilita_botao == true) //Se a variável que habilita o bota for igual a true
    {
    if (estadoBotao == HIGH) //Se o estado do botão for igual a HIGH
    {
    valor_enviado = 255; //Armazena 255 na variável que será enviada para a interface
    digitalWrite(3, LOW); //Apaga o LED verde
    digitalWrite(2, HIGH); //Acende o LED Vermelho
    }
    
    else
    {
    valor_enviado = 254; //Armazena 254 na variável que será enviada para a interface
    digitalWrite(2, LOW); //Apaga o LED Vermelho
    digitalWrite(3, HIGH); //Acende o LED Verde
    }
    
    Serial.write(valor_enviado); //Envia a variável valor_enviado
    }
    
  }
  
  estadoBotao_anterior = estadoBotao; //Armazena o estado na variável estadoBotao_anterior
 
  delay(50); //Aguarda 50 milissegundos
  
  if(Serial.available()> 0) //Se algo for recebido pela serial
  {
    valor_recebido = Serial.read(); //Armazena o que foi recebido na variável valor_recebido
    
    if(valor_recebido == 255) //Se o que foi recebido for igual a 255
    {
      digitalWrite(2, !(digitalRead(2))); //Inverte o valor do LED vermelho
    }
    
    else if(valor_recebido == 254) //Senão, se o que foi recebido for igual a 254
    {
      digitalWrite(3, !(digitalRead(3))); //Inverte o valor do LED verde
    }
    
    else if(valor_recebido == 253) //Senão, se o que foi recebido for igual a 253
    {
      digitalWrite(2, LOW); //Apaga LED Vermelho
      digitalWrite(3, LOW); //Apaga LED Verde
      habilita_botao = !habilita_botao; //Inverte o estado da variável habilita_botao
      if(habilita_botao == true) digitalWrite(2, HIGH); //Se a variável habilita_bota for igual a true
                                                        //Aciona o LED vermelho
    }
  }
  
  
}

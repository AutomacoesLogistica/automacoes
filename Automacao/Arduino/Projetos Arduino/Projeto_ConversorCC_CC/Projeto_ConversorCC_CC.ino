/*
 * 
 *   PROJETO TRABALHO TCC  - CONVERSOR CC / CC
 * 
 * 
 * PINAGEM
 * 
 * A0 = Leitura do divisor de tensao
 * 3 = Pino saida PWM para ajustar o transistor e manter a tensao estabilizada
 * 
 * Desenvolvido : Bruno Gonçalves
 * 29 / 09 / 2016      21:37
 * 
 */



int Referencia; // Valor de referencia obtido em seu teste com 24 v fixo no divisor de tensao e o valor lido pela analogica
int ValorLido; // Valor lido instantaneamente durante a simulação, leitura obtida em cima do resistor ou optoacoplador
int ValorPWM; // Valor para chavear o transistor e elevar ou diminuir a tensao alterando a velocidade de pulsos na PWM

void setup() 
{
Serial.begin(9600); // Velocidade da Serial
Referencia = 600; // Apos os seus testes voce altera a sua referencia mudando o 600 para o valor que deseja
ValorPWM = 180; // Aqui voce define o valor inifial da PWM, não pode ultrapassar de 255
}

void loop() 
{
 ValorLido = analogRead(A0); // Recebe sua referencia, valor lido no divisor de tensão na saida

// Logica para incrementar o PWM para chegar até a sua referencia
      if ( ValorLido < Referencia )
      {
      analogWrite(3,(ValorPWM+1)); //Incrementa tendendo a chegar no valor de referencia

 // Imprime os dados na serial  *********************************************************************************
      Serial.print(" Referencia :   ");
      Serial.print(Referencia);
      Serial.print("   ,   Valor Entrada  :   ");
      Serial.println(ValorLido);
 // *************************************************************************************************************     

        if ( ValorPWM > 255)
        {
          ValorPWM = 255;
        }
      }

// Logica para derementar o PWM para chegar até a sua referencia
      if ( ValorLido > Referencia )
      {
      analogWrite(3,(ValorPWM-1)); //Decrementa tendendo a chegar no valor de referencia
      
 // Imprime os dados na serial  *********************************************************************************
      Serial.print(" Referencia :   ");
      Serial.print(Referencia);
      Serial.print("   ,   Valor Entrada  :   ");
      Serial.println(ValorLido);
 // *************************************************************************************************************     
        if ( ValorPWM < 0)
        {
          ValorPWM = 0;
        }
      }
// Logica para manter o PWM para na referencia
      if ( ValorLido = Referencia )
      {
        Serial.println("Saida estabilizada em 24V"); // Imprime na serial sempre que o valor estiver estabilizado
      }

} // Fecha Loop

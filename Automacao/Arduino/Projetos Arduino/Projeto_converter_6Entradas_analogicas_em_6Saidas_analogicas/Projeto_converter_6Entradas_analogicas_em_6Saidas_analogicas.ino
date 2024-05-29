
// DECLARANDO SINAIS PWM'S PARA SIMULAREM SAIDAS ANALOGICAS ...................................................................................................................................


// DADOS PARA CONTROLAR A SAIDA PWM 3 E FAZE-LA VIRAR UMA SAIDA ANALOGICA 
int entrada_A0 = A0; // Lê a entrada A0
int pwmPino_3 = 3; // Saida PWM 3
int Valor_3 = 0; // Saida para fazer a proporção na saida PWM 3


// DADOS PARA CONTROLAR A SAIDA PWM 5 E FAZE-LA VIRAR UMA SAIDA ANALOGICA 
int entrada_A1 = A1; // Lê a entrada A1
int pwmPino_5 = 5; // Saida PWM 5
int Valor_5 = 0; // Saida para fazer a proporção na saida PWM 5


// DADOS PARA CONTROLAR A SAIDA PWM 6 E FAZE-LA VIRAR UMA SAIDA ANALOGICA 
int entrada_A2 = A2; // Lê a entrada A2
int pwmPino_6 = 6; // Saida PWM 6
int Valor_6 = 0; // Saida para fazer a proporção na saida PWM 6


// DADOS PARA CONTROLAR A SAIDA PWM 9 E FAZE-LA VIRAR UMA SAIDA ANALOGICA 
int entrada_A3 = A3; // Lê a entrada A3
int pwmPino_9 = 9; // Saida PWM 9
int Valor_9 = 0; // Saida para fazer a proporção na saida PWM 9


// DADOS PARA CONTROLAR A SAIDA PWM 10 E FAZE-LA VIRAR UMA SAIDA ANALOGICA
int entrada_A4 = A4; // Lê a entrada A4
int pwmPino_10 = 10; // Saida PWM 10
int Valor_10 = 0; // Saida para fazer a proporção na saida PWM 10


// DADOS PARA CONTROLAR A SAIDA PWM 11 E FAZE-LA VIRAR UMA SAIDA ANALOGICA
int entrada_A5 = A5; // Lê a entrada A5
int pwmPino_11 = 11; // Saida PWM 11
int Valor_11 = 0; // Saida para fazer a proporção na saida PWM 11



// ...........................................................................................................................................................................................

void setup()

{
Serial.begin(9600);
pinMode(pwmPino_3, OUTPUT); //  Declarando como saida o pino PWM
pinMode(pwmPino_5, OUTPUT); //  Declarando como saida o pino PWM
pinMode(pwmPino_6, OUTPUT); //  Declarando como saida o pino PWM
pinMode(pwmPino_9, OUTPUT); //  Declarando como saida o pino PWM
pinMode(pwmPino_10, OUTPUT); //  Declarando como saida o pino PWM
pinMode(pwmPino_11, OUTPUT); //  Declarando como saida o pino PWM

}


void loop() {

// CONFIGURAÇÃO PARA A ENTRADA ANALOGICA RECEBER O SINAL VIA SERIAL E CONVERTELO EM UMA SAIDA PWM COMO SAIDA ANALOGICA ........................................................................
  
  Valor_3 = (analogRead(entrada_A0))/4;   // Recebe o valor de A0 e divide por quatro,pois a pwm trabalha somente ate 255 e não em 1023 como a entrada 
  analogWrite(pwmPino_3, Valor_3);   // Escreve o valor na saida pwm 3 convertendo para o mesmo valor recebido na serial referente a entrada A0 transmitida

        // Saida para comparação com supervisorio ou ate mesmo impreção em lcd
        int rpm_supervisorio = (Valor_3*4)*1.75953079; // REFERENTE A 1800 RPM
        Serial.print(rpm_supervisorio);
        Serial.println("   RPM ");



// CONFIGURAÇÃO PARA A ENTRADA ANALOGICA RECEBER O SINAL VIA SERIAL E CONVERTELO EM UMA SAIDA PWM COMO SAIDA ANALOGICA ........................................................................
  
  Valor_5 = (analogRead(entrada_A1))/4;   // Recebe o valor de A1 e divide por quatro,pois a pwm trabalha somente ate 255 e não em 1023 como a entrada 
  analogWrite(pwmPino_5, Valor_5);   // Escreve o valor na saida pwm 5 convertendo para o mesmo valor recebido na serial referente a entrada A1 transmitida

        // Saida para comparação com supervisorio ou ate mesmo impreção em lcd
        int corrente_supervisorio = (Valor_5*4)*0.0342131; // REFERENTE A 35 A
        Serial.print(corrente_supervisorio);
        Serial.println("   A ");



// CONFIGURAÇÃO PARA A ENTRADA ANALOGICA RECEBER O SINAL VIA SERIAL E CONVERTELO EM UMA SAIDA PWM COMO SAIDA ANALOGICA ........................................................................
  
  Valor_6 = (analogRead(entrada_A2))/4;   // Recebe o valor de A2 e divide por quatro,pois a pwm trabalha somente ate 255 e não em 1023 como a entrada 
  analogWrite(pwmPino_6, Valor_6);   // Escreve o valor na saida pwm 6 convertendo para o mesmo valor recebido na serial referente a entrada A2 transmitida

        // Saida para comparação com supervisorio ou ate mesmo impreção em lcd
        int torque_supervisorio = (Valor_6*4)*0.97751711; // REFERENTE A 1000 kgf
        Serial.print(torque_supervisorio);
        Serial.println("   Kgf ");



// CONFIGURAÇÃO PARA A ENTRADA ANALOGICA RECEBER O SINAL VIA SERIAL E CONVERTELO EM UMA SAIDA PWM COMO SAIDA ANALOGICA ........................................................................
  
  Valor_9 = (analogRead(entrada_A3))/4;   // Recebe o valor de A3 e divide por quatro,pois a pwm trabalha somente ate 255 e não em 1023 como a entrada 
  analogWrite(pwmPino_9, Valor_9);   // Escreve o valor na saida pwm 9 convertendo para o mesmo valor recebido na serial referente a entrada A3 transmitida

        // Saida para comparação com supervisorio ou ate mesmo impreção em lcd
        int ph_supervisorio = ((Valor_9*4)*0.00488759)+7; // REFERENTE A 7 a 12 Ph
        Serial.print(ph_supervisorio);
        Serial.println("   Ph ");



// CONFIGURAÇÃO PARA A ENTRADA ANALOGICA RECEBER O SINAL VIA SERIAL E CONVERTELO EM UMA SAIDA PWM COMO SAIDA ANALOGICA ........................................................................
  
  Valor_10 = (analogRead(entrada_A4))/4;   // Recebe o valor de A4 e divide por quatro,pois a pwm trabalha somente ate 255 e não em 1023 como a entrada 
  analogWrite(pwmPino_10, Valor_10);   // Escreve o valor na saida pwm 10 convertendo para o mesmo valor recebido na serial referente a entrada A4 transmitida

        // Saida para comparação com supervisorio ou ate mesmo impreção em lcd
        int reserva1_supervisorio = (Valor_10*4); // Reserva
        Serial.print(reserva1_supervisorio);
        Serial.println("   Reserva 1 ");



// CONFIGURAÇÃO PARA A ENTRADA ANALOGICA RECEBER O SINAL VIA SERIAL E CONVERTELO EM UMA SAIDA PWM COMO SAIDA ANALOGICA ........................................................................
  
  Valor_11 = (analogRead(entrada_A5))/4;   // Recebe o valor de A5 e divide por quatro,pois a pwm trabalha somente ate 255 e não em 1023 como a entrada 
  analogWrite(pwmPino_11, Valor_11);   // Escreve o valor na saida pwm 11 convertendo para o mesmo valor recebido na serial referente a entrada A5 transmitida

        // Saida para comparação com supervisorio ou ate mesmo impreção em lcd
        int reserva2_supervisorio = (Valor_11*4); // Reserva 2
        Serial.print(reserva2_supervisorio);
        Serial.println("   Reserva 2 ");

}

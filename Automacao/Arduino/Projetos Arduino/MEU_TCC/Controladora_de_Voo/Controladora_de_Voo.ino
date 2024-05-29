// --- Mapeamento de Hardware ---
#define ch1   8 //Canal 1 do rádio instanciado à entrada digital 2
#define ch2   9 //Canal 2 do rádio instanciado à entrada digital 3
#define ch3   10 //Canal 3 do rádio instanciado à entrada digital 4
#define ch4   11 //Canal 4 do rádio instanciado à entrada digital 5
#define LED  13 //LED onboard 
#include <Wire.h>
#include <Servo.h>

Servo Motor1;
Servo Motor2;
Servo Motor3;
Servo Motor4;


//Declaring some global variables
int gyro_x, gyro_y, gyro_z;
long acc_x, acc_y, acc_z, acc_total_vector;
int temperature;
long gyro_x_cal, gyro_y_cal, gyro_z_cal;
unsigned long loop_timer;
int lcd_loop_counter;
float angle_pitch, angle_roll,angle_yaw;
int angle_pitch_buffer, angle_roll_buffer;
boolean set_gyro_angles;
float angle_roll_acc, angle_pitch_acc,angle_yaw_acc;
float angle_pitch_output, angle_roll_output,angle_yaw_output;


// Constante para PID_aileron   ********************************
float Kp_aileron = 10;
float Ki_aileron = 5;
float Kd_aileron = 2;
float PID_aileron;
float PID_aileron_P = 0.00;
float PID_aileron_I = 0.00;
float PID_aileron_D = 0.00;
float erro_aileron = 0;
float erro_anterior_aileron = 0;


// Constante para PID_profundor   ********************************
float Kp_profundor = 50;
float Ki_profundor = 0.05;
float Kd_profundor = 0.1;
float PID_profundor;
float PID_profundor_P = 0.00;
float PID_profundor_I = 0.00;
float PID_profundor_D = 0.00;
float erro_profundor = 0;
float erro_anterior_profundor = 0;



// Constante PID geral **************************************************
float tempo_decorrido;
unsigned long tempo_atual;
unsigned long tempo_anterior;
int angulo_desejado = 0;
// **********************************************************************

int vel_motor1 = 0;
int vel_motor2 = 0;
int vel_motor3 = 0;
int vel_motor4 = 0;
int acelerador = 0;

float aileron = 0;
float profundor = 0;
float leme = 0;
int start = 0;
int conectado = 0;

#define N 5 // Numero de amostas

int media; // Recebe a media
int valores[N]; // Array para armazenar os valores lidos
long soma; // Variavel para somar os valores 



// --- Protótipo das funções auxiliares ---
void Ler_Receptor();      //Função para leitura das entradas dos canais
void Imprimir_Dados();      //Testa os 8 canais do Turnigy9x

 
// --- Declaração de variáveis globais ---

//variáveis para os canais do rádio
int canal_01 = 0;
int canal_02 = 0;
int canal_03 = 0;
int canal_04 = 0;    
 
    
    
// --- Rotina de Interrupção ---
ISR(TIMER2_OVF_vect)
{
 TCNT2=100;          // Reinicializa o registrador do Timer2
} //end ISR
 


// --- Configurações iniciais ---
void setup()
{ 
     
  // -- Direção dos I/Os --
  pinMode(ch1, INPUT); //Entrada para o canal 1 do rádio
  pinMode(ch2, INPUT); //Entrada para o canal 2 do rádio
  pinMode(ch3, INPUT); //Entrada para o canal 3 do rádio
  pinMode(ch4, INPUT); //Entrada para o canal 4 do rádio
  pinMode(LED, OUTPUT); //saída para o LED onboard
  digitalWrite(LED, LOW); //LED inicia desligado
  Wire.begin();    
  Serial.begin(115200);
  pinMode(12, OUTPUT); 
 
  Motor1.attach(4);
  Motor2.attach(5);
  Motor3.attach(6);
  Motor4.attach(7);
  
  Motor1.writeMicroseconds(1000);
  Motor2.writeMicroseconds(1000);
  Motor3.writeMicroseconds(1000);
  Motor4.writeMicroseconds(1000);  
  
  digitalWrite(12, HIGH);
  delay(3000);// Para estabilizar o drone                 
  tempo_atual = millis();
  Serial.println("Calibrando Giroscopio");
  setup_mpu_6050_registers();             
                                         
  // Calibrando MPU6050 ******************************************************************************************************************************************************************
  
  for (int cal_int = 0; cal_int < 2000 ; cal_int ++){                  //Run this code 2000 times
    if(cal_int % 15 == 0)digitalWrite(12,!digitalRead(12));                              //Print a dot on the LCD every 125 readings
    
    read_mpu_6050_data();                                              //Read the raw acc and gyro data from the MPU-6050
    gyro_x_cal += gyro_x;                                              //Add the gyro x-axis offset to the gyro_x_cal variable
    gyro_y_cal += gyro_y;                                              //Add the gyro y-axis offset to the gyro_y_cal variable
    gyro_z_cal += gyro_z;                                              //Add the gyro z-axis offset to the gyro_z_cal variable
    delay(2);                                                          //Delay 3us to simulate the 250Hz program loop
  }
  gyro_x_cal /= 2000;                                                  //Divide the gyro_x_cal variable by 2000 to get the avarage offset
  gyro_y_cal /= 2000;                                                  //Divide the gyro_y_cal variable by 2000 to get the avarage offset
  gyro_z_cal /= 2000;                                                  //Divide the gyro_z_cal variable by 2000 to get the avarage offset

  // *************************************************************************************************************************************************************************************
  digitalWrite(12, LOW);

  // -- Registradores de configuração do Timer2 --
     TCCR2A = 0x00;   //Timer operando em modo normal
     TCCR2B = 0x07;   //Prescaler 1:1024
     TCNT2  = 100;    //10 ms overflow again
     TIMSK2 = 0x01;   //Habilita interrupção do Timer2
  
   
  
} //end setup


//Loop infinito
void loop()
{
 tempo_anterior = tempo_atual;  
 Ler_Receptor(); //Lê os 8 primeiros canais do rádio
 
 read_mpu_6050_data();
 gyro_x -= gyro_x_cal;
 gyro_y -= gyro_y_cal;
 gyro_z -= gyro_z_cal;
  
  //Calcula angulos Giroscopio
  angle_pitch += gyro_x * 0.0000611;
  angle_roll += gyro_y * 0.0000611;
  angle_yaw += gyro_z * 0.0000611; 
  
  angle_pitch += angle_roll * sin(gyro_z * 0.000001066);
  angle_roll -= angle_pitch * sin(gyro_z * 0.000001066);
  angle_yaw += angle_yaw * sin(gyro_z * 0.000001066);
  
  // Calcula angulos do Acelerometro
  acc_total_vector = sqrt((acc_x*acc_x)+(acc_y*acc_y)+(acc_z*acc_z));
  angle_pitch_acc = asin((float)acc_y/acc_total_vector)* 57.296;
  angle_roll_acc = asin((float)acc_x/acc_total_vector)* -57.296;
  angle_yaw_acc = asin((float)acc_z/acc_total_vector)* -57.296;
  
  angle_pitch_acc -= 0.0;
  angle_roll_acc -= 0.0; 
  angle_yaw_acc -= 0.0; 

  if(set_gyro_angles)
  {
   angle_pitch = angle_pitch * 0.9996 + angle_pitch_acc * 0.0004;
   angle_roll = angle_roll * 0.9996 + angle_roll_acc * 0.0004;
   angle_yaw = angle_yaw * 0.9996 + angle_yaw_acc * 0.0004;
  }
  else
  {                           
   angle_pitch = angle_pitch_acc;
   angle_roll = angle_roll_acc;
   angle_yaw = angle_yaw_acc;                                
   set_gyro_angles = true;
  }
  angle_pitch_output = (angle_pitch_output * 0.9 + angle_pitch * 0.1);
  angle_roll_output = (angle_roll_output * 0.9 + angle_roll * 0.1);
  angle_yaw_output = (angle_yaw_output * 0.9 + angle_yaw * 0.1);
 
  aileron = (angle_pitch_output+2.68);//2.63
  profundor = (angle_roll_output+3.27);//4
  if(aileron == 0 && profundor == 0){angle_yaw_output = 0.00;leme = (0);}else{leme = (angle_yaw_output+85.6);}  


  
  Serial.print(aileron,3);
  Serial.print("  ,  ");
  Serial.print(profundor,3);
  Serial.print("  ,  ");
  Serial.println(leme,3);
 
                       
  if ( conectado == 1 ){digitalWrite(LED, HIGH);}else{digitalWrite(LED, LOW); }
  
  // Iniciar o modo para ligar motores
  if(start == 0 && acelerador < 1090 && canal_04 < 1150){start = 1;Serial.println(start);}
  
  // Depois de iniciar modo de ligar motores e voltar o leme para o centro liga os motores
  if(start == 1 && acelerador < 1090 && canal_04 > 1450){start = 2;Serial.println(start);}
  
  // Desligar os motores
  if(start == 2 && acelerador < 1090 && canal_04 > 1800){start = 0;Serial.println(start);}
  
  // O DRONE ESTÁ COM OS MOTORES LIGADOS
  if ( start == 2 )
  {
   // Calculando o PID_aileron
   tempo_atual = millis();
   tempo_decorrido = tempo_atual - tempo_anterior; // Divide para converter ms para s
   tempo_decorrido = (tempo_decorrido/1000);
   /*
   Serial.print("tempo_decorrido =  ");Serial.print(tempo_decorrido,4);
   Serial.print("   tempo_atual =  ");Serial.print(tempo_atual);
   Serial.print("   tempo_anterior =  ");Serial.println(tempo_anterior);
   */
   erro_aileron = angulo_desejado- aileron;
   erro_profundor = angulo_desejado- profundor;
   
   if(erro_aileron !=0)
   {
    PID_aileron_P = Kp_aileron * erro_aileron;
    PID_aileron_I += ( Ki_aileron * erro_aileron )*tempo_decorrido;
    PID_aileron_D = Kd_aileron*erro_aileron/tempo_decorrido;
   }
   else
   {
    PID_aileron_P = 0.0;
    PID_aileron_I = 0.0;
    PID_aileron_D = 0.0;
    erro_aileron = 0;
    erro_anterior_aileron = 0;
    aileron = 0;
   }

   if(erro_profundor !=0)
   {
    PID_profundor_P = Kp_profundor * erro_profundor;
    PID_profundor_I += ( Ki_profundor * erro_profundor )*tempo_decorrido;
    PID_profundor_D = Kd_profundor*erro_profundor/tempo_decorrido;
   }
   else
   {
    PID_profundor_P = 0.0;
    PID_profundor_I = 0.0;
    PID_profundor_D = 0.0;
    erro_profundor = 0;
    erro_anterior_profundor = 0;
    profundor = 0;
   }

   PID_aileron = PID_aileron_P + PID_aileron_I + PID_aileron_D;
   if (PID_aileron < -1000){PID_aileron = -1000;}
   if (PID_aileron > 1000 ){PID_aileron =  1000;}

   PID_profundor = PID_profundor_P + PID_profundor_I + PID_profundor_D;
   if (PID_profundor < -1000){PID_profundor = -1000;}
   if (PID_profundor > 1000 ){PID_profundor =  1000;}
   
   /*
   Serial.print("tempo_decorrido = ");Serial.print(tempo_decorrido);
   Serial.print("   PID_aileron = ");Serial.print(PID_aileron);
   Serial.print("   PID_aileron_P = ");Serial.print(PID_aileron_P);
   Serial.print("   PID_aileron_I = ");Serial.print(PID_aileron_I);
   Serial.print("   PID_aileron_D = ");Serial.print(PID_aileron_D);
   Serial.print("   erro_aileron = ");Serial.print(erro_aileron);
   Serial.print("   aileron = ");Serial.println(aileron);
   */
   
   vel_motor1 = acelerador - PID_aileron;
   vel_motor2 = acelerador - PID_aileron;
   vel_motor3 = acelerador + PID_aileron;
   vel_motor4 = acelerador + PID_aileron;
   
   /*   
   Serial.print("tempo_decorrido = ");Serial.print(tempo_decorrido);
   Serial.print("   PID_profundor = ");Serial.print(PID_profundor);
   Serial.print("   PID_profundor_P = ");Serial.print(PID_profundor_P);
   Serial.print("   PID_profundor_I = ");Serial.print(PID_profundor_I);
   Serial.print("   PID_profundor_D = ");Serial.print(PID_profundor_D);
   Serial.print("   erro_profundor = ");Serial.print(erro_profundor);
   Serial.print("   profundor = ");Serial.println(profundor);
   */
  

    
   //vel_motor1 += -PID_profundor;
   //vel_motor2 += +PID_profundor;
   //vel_motor3 += +PID_profundor;
   //vel_motor4 += -PID_profundor;
   
   
   
   if (vel_motor1 !=0 && vel_motor1 < 1075) vel_motor1 = 1075;
   if (vel_motor2 !=0 && vel_motor2 < 1075) vel_motor2 = 1075;
   if (vel_motor3 !=0 && vel_motor3 < 1075) vel_motor3 = 1075;
   if (vel_motor4 !=0 && vel_motor4 < 1075) vel_motor4 = 1075;
   
   if (vel_motor1>2000){vel_motor1 = 2000;}
   if (vel_motor2>2000){vel_motor2 = 2000;}
   if (vel_motor3>2000){vel_motor3 = 2000;}
   if (vel_motor4>2000){vel_motor4 = 2000;}
   /* 
   Serial.print(vel_motor1);
   Serial.print("   ,   ");
   Serial.print(vel_motor2);
   Serial.print("   ,   ");
   Serial.print(vel_motor3);
   Serial.print("   ,   ");
   Serial.println(vel_motor4);
   */
   Motor1.writeMicroseconds(vel_motor1);
   Motor2.writeMicroseconds(vel_motor2);
   Motor3.writeMicroseconds(vel_motor3);
   Motor4.writeMicroseconds(vel_motor4);  
   
   
   erro_anterior_aileron = erro_aileron;
   erro_anterior_profundor = erro_profundor;
   
   // Imprimir_Dados(); //Testa os canais e envia informação para o Serial Monitor  
  }// Fecha se start == 2
  
  else // Se start == 0
  {
   vel_motor1 = 1000; // mantem parados
   vel_motor2 = 1000; // mantem parados
   vel_motor3 = 1000; // mantem parados
   vel_motor4 = 1000; // mantem parados
     PID_aileron_P = 0.0;
    PID_aileron_I = 0.0;
    PID_aileron_D = 0.0;
    erro_aileron = 0;
    erro_anterior_aileron = 0;
    aileron = 0;
   Motor1.writeMicroseconds(vel_motor1);
   Motor2.writeMicroseconds(vel_motor2);
   Motor3.writeMicroseconds(vel_motor3);
   Motor4.writeMicroseconds(vel_motor4);
  }
} //end loop


//Funções auxiliares
void Ler_Receptor() //Faz a leitura dos 6 primeiros canais do rádio
{
 
 canal_01 = pulseIn(ch1, HIGH, 25000); //Lê pulso em nível alto do canal 1 e armazena na variável canal_01
 canal_02 = pulseIn(ch2, HIGH, 25000); //Lê pulso em nível alto do canal 2 e armazena na variável canal_02
 canal_03 = pulseIn(ch3, HIGH, 25000); //Lê pulso em nível alto do canal 3 e armazena na variável canal_03
 canal_04 = pulseIn(ch4, HIGH, 25000); //Lê pulso em nível alto do canal 4 e armazena na variável canal_04
 aileron = map(canal_01,1000,2000,1000,2000); 
 profundor = map(canal_02,2000,1000,1000,2000); 
 acelerador = map(canal_03,2000,1000,1000,2000);
 leme = map(canal_04,1000,2000,1000,2000); 
 
 // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
 for(int i = N-1;i>0;i--)
 {
  valores[i] = valores[i-1];
 }
 // *************************************************************************************************************************************
 valores[0] = acelerador; // Coloca o valor mais atual em valores[0]
 soma = 0;  // Limpa a variavel de soma
 // For para calcular a media atualizada *************************************************************************************************
 for (int i=0;i<N;i++)
 {
  soma = soma+valores[i];
 }
 // ***************************************************************************************************************************************
 media = soma/N;
 acelerador = media;
 vel_motor1 = acelerador;
 vel_motor2 = acelerador;
 vel_motor3 = acelerador;
 vel_motor4 = acelerador;
} //end read channels


void Imprimir_Dados() //Testa os canais via serial monitor (comentar esta função e só chamar quando necessário)
{

} //end Imprimir_Dados

void read_mpu_6050_data()
{                                             //Subroutine for reading the raw gyro and accelerometer data
 Wire.beginTransmission(0x68);                                        //Start communicating with the MPU-6050
 Wire.write(0x3B);                                                    //Send the requested starting register
 Wire.endTransmission();                                              //End the transmission
 Wire.requestFrom(0x68,14);                                           //Request 14 bytes from the MPU-6050
 while(Wire.available() < 14);                                        //Wait until all the bytes are received
 acc_x = Wire.read()<<8|Wire.read();                                  //Add the low and high byte to the acc_x variable
 acc_y = Wire.read()<<8|Wire.read();                                  //Add the low and high byte to the acc_y variable
 acc_z = Wire.read()<<8|Wire.read();                                  //Add the low and high byte to the acc_z variable
 temperature = Wire.read()<<8|Wire.read();                            //Add the low and high byte to the temperature variable
 gyro_x = Wire.read()<<8|Wire.read();                                 //Add the low and high byte to the gyro_x variable
 gyro_y = Wire.read()<<8|Wire.read();                                 //Add the low and high byte to the gyro_y variable
 gyro_z = Wire.read()<<8|Wire.read();                                 //Add the low and high byte to the gyro_z variable
}

void setup_mpu_6050_registers()
{
 //Activate the MPU-6050
 Wire.beginTransmission(0x68);                                        //Start communicating with the MPU-6050
 Wire.write(0x6B);                                                    //Send the requested starting register
 Wire.write(0x00);                                                    //Set the requested starting register
 Wire.endTransmission();                                              //End the transmission
 //Configure the accelerometer (+/-8g)
 Wire.beginTransmission(0x68);                                        //Start communicating with the MPU-6050
 Wire.write(0x1C);                                                    //Send the requested starting register
 Wire.write(0x10);                                                    //Set the requested starting register
 Wire.endTransmission();                                              //End the transmission
 //Configure the gyro (500dps full scale)
 Wire.beginTransmission(0x68);                                        //Start communicating with the MPU-6050
 Wire.write(0x1B);                                                    //Send the requested starting register
 Wire.write(0x08);                                                    //Set the requested starting register
 Wire.endTransmission();                                              //End the transmission
}







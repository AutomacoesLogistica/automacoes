#include <Wire.h>
#include <Servo.h>

Servo Motor1;
Servo Motor2;
Servo Motor3;
Servo Motor4;

//Declaring some global variables
float gyro_x, gyro_y, gyro_z;
long acc_x, acc_y, acc_z, acc_total_vector;
int temperature;
long gyro_x_cal, gyro_y_cal, gyro_z_cal;
unsigned long loop_timer;
int lcd_loop_counter;
float angle_pitch, angle_roll,angle_yaw;
float angle_pitch_buffer, angle_roll_buffer;
boolean set_gyro_angles;
float angle_roll_acc, angle_pitch_acc,angle_yaw_acc;
float angle_pitch_output, angle_roll_output,angle_yaw_output;

float aileron;
float leme;
float profundor;


float Kp = 15;
float Ki = 2;
float Kd = 0;
float PID;
float pid_P = 0.00;
float pid_I = 0.00;
float pid_D = 0.00;
float angulo_desejado = 0.0;

float tempo_decorrido;
unsigned long tempo_atual;
unsigned long tempo_anterior;

float erro = 0;
float erro_anterior = 0;
int vel_motor1 = 0;
int vel_motor2 = 0;
int vel_motor3 = 0;
int vel_motor4 = 0;
int acelerador = 1400;




void setup() {
  Wire.begin();                                                        //Start I2C as master
  Serial.begin(57600);                                               //Use only for debugging
  pinMode(12, OUTPUT); 
  pinMode(13, OUTPUT);                                                 //Set output 13 (LED) as output//Set output 13 (LED) as output

  Motor1.attach(10);//4
  Motor2.attach(9);//5
  Motor3.attach(11);//6
  Motor4.attach(3);//7
  
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
  //loop_timer = micros();                                               //Reset the loop timer
}

void loop(){
  
  tempo_anterior = tempo_atual;

   
  
  read_mpu_6050_data();                                                //Read the raw acc and gyro data from the MPU-6050

  gyro_x -= gyro_x_cal;                                                //Subtract the offset calibration value from the raw gyro_x value
  gyro_y -= gyro_y_cal;                                                //Subtract the offset calibration value from the raw gyro_y value
  gyro_z -= gyro_z_cal;                                                //Subtract the offset calibration value from the raw gyro_z value
  
  //Gyro angle calculations
  //0.0000611 = 1 / (250Hz / 65.5)
  angle_pitch += gyro_x * 0.0000611;                                   //Calculate the traveled pitch angle and add this to the angle_pitch variable
  angle_roll += gyro_y * 0.0000611;                                    //Calculate the traveled roll angle and add this to the angle_roll variable
  angle_yaw += gyro_z * 0.0000611; 
  
  //0.000001066 = 0.0000611 * (3.142(PI) / 180degr) The Arduino sin function is in radians
  angle_pitch += angle_roll * sin(gyro_z * 0.000001066);               //If the IMU has yawed transfer the roll angle to the pitch angel
  angle_roll -= angle_pitch * sin(gyro_z * 0.000001066);               //If the IMU has yawed transfer the pitch angle to the roll angel
  angle_yaw += angle_yaw * sin(gyro_z * 0.000001066); 
  
  //Accelerometer angle calculations
  acc_total_vector = sqrt((acc_x*acc_x)+(acc_y*acc_y)+(acc_z*acc_z));  //Calculate the total accelerometer vector
  //57.296 = 1 / (3.142 / 180) The Arduino asin function is in radians
  angle_pitch_acc = asin((float)acc_y/acc_total_vector)* 57.296;       //Calculate the pitch angle
  angle_roll_acc = asin((float)acc_x/acc_total_vector)* -57.296;       //Calculate the roll angle
  angle_yaw_acc = asin((float)acc_z/acc_total_vector)* -57.296;       //Calculate the roll angle
  
  //Place the MPU-6050 spirit level and note the values in the following two lines for calibration
  angle_pitch_acc -= 0.0;                                              //Accelerometer calibration value for pitch
  angle_roll_acc -= 0.0; 
  angle_yaw_acc -= 0.0; 

  if(set_gyro_angles){                                                 //If the IMU is already started
    angle_pitch = angle_pitch * 0.9996 + angle_pitch_acc * 0.0004;     //Correct the drift of the gyro pitch angle with the accelerometer pitch angle
    angle_roll = angle_roll * 0.9996 + angle_roll_acc * 0.0004;        //Correct the drift of the gyro roll angle with the accelerometer roll angle
    angle_yaw = angle_yaw * 0.9996 + angle_yaw_acc * 0.0004;
  }
  else{                                                                //At first start
    angle_pitch = angle_pitch_acc;                                     //Set the gyro pitch angle equal to the accelerometer pitch angle 
    angle_roll = angle_roll_acc;
    angle_yaw = angle_yaw_acc;                                
    set_gyro_angles = true;                                            //Set the IMU started flag
  }
  
  //To dampen the pitch and roll angles a complementary filter is used
  angle_pitch_output = (angle_pitch_output * 0.9 + angle_pitch * 0.1);//+2.63;   //Take 90% of the output pitch value and add 10% of the raw pitch value
  angle_roll_output = (angle_roll_output * 0.9 + angle_roll * 0.1);//+4;      //Take 90% of the output roll value and add 10% of the raw roll value
  angle_yaw_output = (angle_yaw_output * 0.9 + angle_yaw * 0.1);//+84.8;
 
  aileron = (angle_pitch_output+2.63);
  profundor = (angle_roll_output+4);
  if(aileron == 0 && profundor == 0){angle_yaw_output = 0.00;leme = (0);}else{leme = (angle_yaw_output+84.8);}  



   aileron = profundor;
   profundor = 0; 
/*  
  Serial.print(aileron);
  Serial.print("  ,  ");
  Serial.print(profundor);
  Serial.print("  ,  ");
  Serial.println(leme);
*/
                                    
/*
// Calculando o PID
tempo_atual = millis();
tempo_decorrido = tempo_atual - tempo_anterior; // Divide para converter ms para s
tempo_decorrido = (tempo_decorrido/1000);


Serial.print("tempo_decorrido =  ");Serial.print(tempo_decorrido,4);
Serial.print("   tempo_atual =  ");Serial.print(tempo_atual);
Serial.print("   tempo_anterior =  ");Serial.println(tempo_anterior);
*/



tempo_decorrido = 0.0215;

erro = angulo_desejado- aileron;
if(erro!= 0)
{
pid_P = Kp * erro;
pid_I += ( Ki * erro )*tempo_decorrido;
pid_D = Kd*erro/tempo_decorrido;
}
else
{
pid_P = 0.0;
pid_I = 0.0;
pid_D = 0.0;
}

PID = pid_P + pid_I + pid_D;

if (PID < -1000){PID = -1000;}
if (PID > 1000 ){PID =  1000;}


/*
Serial.print("tempo_decorrido = ");Serial.print(tempo_decorrido);
Serial.print("   PID = ");Serial.print(PID);
Serial.print("   pid_P = ");Serial.print(pid_P);
Serial.print("   pid_I = ");Serial.print(pid_I);
Serial.print("   pid_D = ");Serial.print(pid_D);
Serial.print("   erro = ");Serial.println(erro);
*/

//Serial.println(PID);

acelerador = 1300;

vel_motor1 = acelerador + PID;
vel_motor2 = acelerador + PID;
vel_motor3 = acelerador - PID;
vel_motor4 = acelerador - PID;





if (vel_motor1<1000){vel_motor1 = 1000;}
if (vel_motor1>2000){vel_motor1 = 2000;}

if (vel_motor2<1000){vel_motor2 = 1000;}
if (vel_motor2>2000){vel_motor2 = 2000;}

if (vel_motor3<1000){vel_motor3 = 1000;}
if (vel_motor3>2000){vel_motor3 = 2000;}

if (vel_motor4<1000){vel_motor4 = 1000;}
if (vel_motor4>2000){vel_motor4 = 2000;}

  Motor1.writeMicroseconds(vel_motor1);
  Motor2.writeMicroseconds(vel_motor2);
  Motor3.writeMicroseconds(vel_motor3);
  Motor4.writeMicroseconds(vel_motor4);  



/*
Serial.print(vel_motor1);
Serial.print("   ,   ");
Serial.print(vel_motor2);
Serial.print("   ,   ");
Serial.print(vel_motor3);
Serial.print("   ,   ");
Serial.println(vel_motor4);
*/





erro_anterior = erro;
}


void read_mpu_6050_data(){                                             //Subroutine for reading the raw gyro and accelerometer data
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

void setup_mpu_6050_registers(){
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















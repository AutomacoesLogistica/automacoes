#include <Servo.h>  //For driving the ESCs and Servos
#include <PS2X_lib.h> // Bill Porter's PS2X Library

PS2X ps2x;  //The PS2 Controller Class

int Val_LX = 0;
int Val_LY = 0;
int Val_RX = 0;
int Val_RY = 0;

void setup()
{
  Serial.begin(57600);
  ps2x.config_gamepad(13,11,10,12, true, true);
  // GamePad(clock, command, attention, data, Pressures?, Rumble?)

}

void loop()
{
  ps2x.read_gamepad();


                        
  if(ps2x.Button(PSB_PAD_UP))
  {
    Serial.println("Cima");
  }
  if(ps2x.ButtonPressed(PSB_PAD_LEFT))
  {
    Serial.println("Esquerda");
  }
  if(ps2x.ButtonPressed(PSB_PAD_RIGHT))
  {
    Serial.println("Direita");
  }
  if(ps2x.Button(PSB_PAD_DOWN))
  {
    Serial.println("Baixo");
  }


  if(ps2x.ButtonPressed(PSB_GREEN))
  {
    Serial.println("Triangulo");
  }
  if(ps2x.ButtonPressed(PSB_RED))
  {
    Serial.println("Bolinha");
  }
  if(ps2x.ButtonPressed(PSB_BLUE))
  {
    Serial.println("X");
  }
  if(ps2x.ButtonPressed(PSB_PINK))
  {
    Serial.println("Quadrado");
  }



if(ps2x.ButtonPressed(PSB_R1))
  {
    Serial.println("R1");
  }
  if(ps2x.ButtonPressed(PSB_R2))
  {
    Serial.println("R2");
  }
  if(ps2x.ButtonPressed(PSB_L1))
  {
    Serial.println("L1");
  }
  if(ps2x.ButtonPressed(PSB_L2))
  {
    Serial.println("L2");
  }
  if(ps2x.ButtonPressed(PSB_L3))
  {
    Serial.println("L3");
  }
  if(ps2x.ButtonPressed(PSB_R3))
  {
    Serial.println("R3");
  }
  if(ps2x.ButtonPressed(PSB_START))
  {
    Serial.println("Start");
  }
  if(ps2x.ButtonPressed(PSB_SELECT))
  {
    Serial.println("Select");
  }







  //Valores analógicos
  Val_RY = ps2x.Analog(PSS_RY);
  Val_RX = ps2x.Analog(PSS_RX);
  Val_LY = ps2x.Analog(PSS_LY);
  Val_LX = ps2x.Analog(PSS_LX);

/*
Serial.print(Val_LX);
Serial.print(",");
Serial.print(Val_LY);
Serial.print(",");
Serial.print(Val_RX);
Serial.print(",");
Serial.println(Val_RY);
*/
delay(15);
}

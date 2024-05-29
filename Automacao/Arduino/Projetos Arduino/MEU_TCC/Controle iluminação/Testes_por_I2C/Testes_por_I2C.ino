// MODULO CONTROLE DE ILUMINAÇÃO
#include <Wire.h>
#define Endereco_I2C 0x08 //endereço para recepção de dados

String readString;
int modoIluminacao;
int randomico;
int valorPWM_Luz;
int ativarLuz;

void setup()
{
  Wire.begin(Endereco_I2C);
  Wire.onReceive(DadosRecebidos);
  Serial.begin(9600);
  pinMode(4, OUTPUT); // Iluminação verde 1 frente
  pinMode(5, OUTPUT); // Iluminação verde 2 frente
  pinMode(6, OUTPUT); // Iluminação vermelha 1 cauda
  pinMode(7, OUTPUT); // Iluminação vermelha 2 cauda
  pinMode(9, OUTPUT); // Iluminação branca base
  digitalWrite(4, 0);
  digitalWrite(5, 0);
  digitalWrite(6, 0);
  digitalWrite(7, 0);

  modoIluminacao = 0;
  randomico = 0;
  valorPWM_Luz = 0;
  ativarLuz = 0;
  readString = "";

}

void loop()
{

  if (randomico == 1 )
  {
    modoIluminacao = random(7);
  }
  
  if (modoIluminacao == -1)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      digitalWrite(5, 1);
      digitalWrite(6, 1);
      digitalWrite(7, 1);
      delay(80);
      digitalWrite(4, 0);
      digitalWrite(5, 0);
      digitalWrite(6, 0);
      digitalWrite(7, 0);
      delay(80);
    }
  }



  if (modoIluminacao == 0)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }
  }


  if (modoIluminacao == 1)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }

    digitalWrite(4, 1);
    delay(200);
    digitalWrite(5, 1);
    delay(200);
    digitalWrite(6, 1);
    delay(200);
    digitalWrite(7, 1);
    delay(200);
    digitalWrite(4, 0);
    delay(200);
    digitalWrite(5, 0);
    delay(200);
    digitalWrite(6, 0);
    delay(200);
    digitalWrite(7, 0);
    delay(200);



  }

  if (modoIluminacao == 2)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }

    digitalWrite(4, 1);
    delay(200);
    digitalWrite(5, 1);
    delay(200);
    digitalWrite(6, 1);
    delay(200);
    digitalWrite(7, 1);
    delay(200);
    digitalWrite(7, 0);
    delay(200);
    digitalWrite(6, 0);
    delay(200);
    digitalWrite(5, 0);
    delay(200);
    digitalWrite(4, 0);
    delay(200);


  }


  if (modoIluminacao == 3)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }
    digitalWrite(7, 0);
    digitalWrite(4, 1);
    delay(200);
    digitalWrite(4, 0);
    digitalWrite(5, 1);
    delay(200);
    digitalWrite(5, 0);
    digitalWrite(6, 1);
    delay(200);
    digitalWrite(6, 0);
    digitalWrite(7, 1);
    delay(200);


  }

  if (modoIluminacao == 4)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }

    digitalWrite(6, 0);
    digitalWrite(4, 1);
    delay(200);
    digitalWrite(4, 0);
    digitalWrite(5, 1);
    delay(200);
    digitalWrite(5, 0);
    digitalWrite(7, 1);
    delay(200);
    digitalWrite(7, 0);
    digitalWrite(6, 1);
    delay(200);
  }


  if (modoIluminacao == 5)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      digitalWrite(5, 1);
      delay(100);
      digitalWrite(4, 0);
      digitalWrite(5, 0);
      delay(100);

    }
    digitalWrite(4, 0);
    digitalWrite(5, 0);

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(6, 1);
      digitalWrite(7, 1);
      delay(100);
      digitalWrite(6, 0);
      digitalWrite(7, 0);
      delay(100);

    }
  }

  if (modoIluminacao == 6)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }


    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      digitalWrite(5, 1);
      delay(80);
      digitalWrite(4, 0);
      digitalWrite(5, 0);
      delay(80);

    }
    digitalWrite(4, 0);
    digitalWrite(5, 0);

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(6, 1);
      digitalWrite(7, 1);
      delay(80);
      digitalWrite(6, 0);
      digitalWrite(7, 0);
      delay(80);
    }
    // **********************************************************************


    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(5, 1);
      digitalWrite(6, 1);
      delay(80);
      digitalWrite(5, 0);
      digitalWrite(6, 0);
      delay(80);

    }
    digitalWrite(5, 0);
    digitalWrite(6, 0);

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(7, 1);
      digitalWrite(4, 1);
      delay(80);
      digitalWrite(7, 0);
      digitalWrite(4, 0);
      delay(80);
    }

    
   // **********************************************************************


    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(6, 1);
      digitalWrite(7, 1);
      delay(80);
      digitalWrite(6, 0);
      digitalWrite(7, 0);
      delay(80);

    }
    digitalWrite(6, 0);
    digitalWrite(7, 0);

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      digitalWrite(5, 1);
      delay(80);
      digitalWrite(4, 0);
      digitalWrite(5, 0);
      delay(80);
    }

    
   // **********************************************************************


    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(7, 1);
      digitalWrite(4, 1);
      delay(80);
      digitalWrite(7, 0);
      digitalWrite(4, 0);
      delay(80);

    }
    digitalWrite(7, 0);
    digitalWrite(4, 0);

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(5, 1);
      digitalWrite(6, 1);
      delay(80);
      digitalWrite(5, 0);
      digitalWrite(6, 0);
      delay(80);
    }

    
   // **********************************************************************


    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      delay(80);
      digitalWrite(4, 0);
      delay(80);
      digitalWrite(5, 1);
      delay(80);
      digitalWrite(5, 0);
      delay(80);
      digitalWrite(6, 1);
      delay(80);
      digitalWrite(6, 0);
      delay(80);
      digitalWrite(7, 1);
      delay(80);
      digitalWrite(7, 0);
      delay(80);
    }
   

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      digitalWrite(5, 1);
      digitalWrite(6, 1);
      digitalWrite(7, 1);
      delay(80);
      digitalWrite(4, 0);
      digitalWrite(5, 0);
      digitalWrite(6, 0);
      digitalWrite(7, 0);
      delay(80);
    }


    
    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(7, 1);
      delay(80);
      digitalWrite(7, 0);
      delay(80);
      digitalWrite(6, 1);
      delay(80);
      digitalWrite(6, 0);
      delay(80);
      digitalWrite(5, 1);
      delay(80);
      digitalWrite(5, 0);
      delay(80);
      digitalWrite(4, 1);
      delay(80);
      digitalWrite(4, 0);
      delay(80);
    }
  }


  if (modoIluminacao == 7)
  {
    for (int x = 4; x < 8; x++ )
    {
      digitalWrite(x, 0);
    }

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(4, 1);
      delay(100);
      digitalWrite(4, 0);
      delay(100);

    }
    digitalWrite(4, 0);

    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(5, 1);
      delay(100);
      digitalWrite(5, 0);
      delay(100);

    }
    digitalWrite(5, 0);
    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(6, 1);
      delay(100);
      digitalWrite(6, 0);
      delay(100);

    }
    digitalWrite(6, 0);
    for (int x = 0; x < 5; x++ )
    {
      digitalWrite(7, 1);
      delay(100);
      digitalWrite(7, 0);
      delay(100);

    }
  }



if ( ativarLuz == 1 )
{
analogWrite(9,valorPWM_Luz);  
}



}// fecha o loop







void DadosRecebidos(int dados)
{
  while (Wire.available())
  {
    char c = Wire.read();
    readString += c;
  }

  if (readString.length() > 0)
  {
    Serial.println(readString);
    
    if (readString == "modo")
    {
      if (randomico == 0 )
      {
        modoIluminacao++;
        if (digitalRead(9) == 0)
        {
          digitalWrite(9, 1);
          delay(200);
          digitalWrite(9, 0);
        }
      }

      if (randomico == 1)
      {
        modoIluminacao = 0;
        randomico = 0;
      }
      if (modoIluminacao == 8 && randomico == 0)
      {
        randomico = 1;
      }
    }

    //*************************************************************************************************************************************************************************************

    if (readString == "modo_0")
    {
      modoIluminacao = 0;
    }


    if (readString == "radio_off" && modoIluminacao == 0)
    {
      modoIluminacao = -1;
    }


    if (readString == "radio_on" && modoIluminacao == -1)
    {
      modoIluminacao = 0;
    }


    //*************************************************************************************************************************************************************************************

    if (readString == "luz_on")
    {
     ativarLuz = 1;
     valorPWM_Luz = 255;
     
    }

    //*************************************************************************************************************************************************************************************

    if (readString == "luz_off")
    {
      ativarLuz = 0;
      digitalWrite(9, 0);
      valorPWM_Luz = 0;
    }

    //*************************************************************************************************************************************************************************************

   if (readString == "luz+")
    {
      valorPWM_Luz++;
      if ( valorPWM_Luz>255)
      {
        valorPWM_Luz = 255;
      }
    }

     if (readString == "luz-")
    {
      valorPWM_Luz--;
      if ( valorPWM_Luz<0)
      {
        valorPWM_Luz = 0;
      }
    }

    //*************************************************************************************************************************************************************************************



    readString = "";
  }
}

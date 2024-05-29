
// CONECCOES
// DS3231 SDA --> D2
// DS3231 SCL --> D1
// DS3231 VCC --> 3.3v
// DS3231 GND --> GND

/* for software wire use below
#include <SoftwareWire.h>  // must be included here so that Arduino library object file references work
#include <RtcDS3231.h>

SoftwareWire myWire(SDA, SCL);
RtcDS3231<SoftwareWire> Rtc(myWire);
 for software wire use above */

/* for normal hardware wire use below */
#include <Wire.h> // must be included here so that Arduino library object file references work
#include <RtcDS3231.h>
RtcDS3231<TwoWire> Rtc(Wire);
/* for normal hardware wire use above */

//Pòrtas
//D1 usado SDA
//D2 usado SCL
int ativado = 14; // D5 Botao seletora Aut / MAN
int rodar_semana = 12; //D6 Botao para acionar durante a semana
int led_bloqueado = 2; //D4
int led_ligado = 13; //D7
int led_desligado = 10; //SD3
int rele_bomba = 15; // D8
boolean rodar_sistema = false;
String hora_iniciado = "vazio";
String dias_da_semana[] = {"Domingo","Segunda","Terca", "Quarta", "Quinta","Sexta","Sabado"};
String v_dia_semana="";
int hora_limite = 18;
int dia;
int mes;
int ano;
int hora;
int minuto;
int segundo;

// handy routine to return true if there was an error
// but it will also print out an error message with the given topic
bool wasError(const char* errorTopic = "")
{
    uint8_t error = Rtc.LastError();
    if (error != 0)
    {
        // we have a communications error
        // see https://www.arduino.cc/reference/en/language/functions/communication/wire/endtransmission/
        // for what the number means
        Serial.print("[");
        Serial.print(errorTopic);
        Serial.print("] WIRE communications error (");
        Serial.print(error);
        Serial.print(") : ");

        switch (error)
        {
        case Rtc_Wire_Error_None:
            Serial.println("(none?!)");
            break;
        case Rtc_Wire_Error_TxBufferOverflow:
            Serial.println("transmit buffer overflow");
            break;
        case Rtc_Wire_Error_NoAddressableDevice:
            Serial.println("no device responded");
            break;
        case Rtc_Wire_Error_UnsupportedRequest:
            Serial.println("device doesn't support request");
            break;
        case Rtc_Wire_Error_Unspecific:
            Serial.println("unspecified error");
            break;
        case Rtc_Wire_Error_CommunicationTimeout:
            Serial.println("communications timed out");
            break;
        }
        return true;
    }
    return false;
}

void setup () 
{
    Serial.begin(115200);
    pinMode(ativado,INPUT);
    pinMode(rodar_semana,INPUT);
    pinMode(led_bloqueado,OUTPUT);
    digitalWrite(led_bloqueado,LOW); //Inicia apagado
    pinMode(led_ligado,OUTPUT);
    digitalWrite(led_ligado,LOW); //Inicia apagado
    pinMode(led_desligado,OUTPUT);
    digitalWrite(led_desligado,LOW); //Inicia apagado
    pinMode(rele_bomba,OUTPUT);
    digitalWrite(rele_bomba,LOW); //Inicia desligado
    Serial.print("compiled: ");
    Serial.print(__DATE__);
    Serial.println(__TIME__);

    //--------RTC SETUP ------------
    // if you are using ESP-01 then uncomment the line below to reset the pins to
    // the available pins for SDA, SCL
    // Wire.begin(0, 2); // due to limited pins, use pin 0 and 2 for SDA, SCL
    
    Rtc.Begin();
#if defined(WIRE_HAS_TIMEOUT)
    Wire.setWireTimeout(3000 /* us */, true /* reset_on_timeout */);
#endif

    RtcDateTime compiled = RtcDateTime(__DATE__, __TIME__);
    printDateTime(compiled);
    Serial.println();

    if (!Rtc.IsDateTimeValid()) 
    {
        if (!wasError("setup IsDateTimeValid"))
        {
            // Common Causes:
            //    1) first time you ran and the device wasn't running yet
            //    2) the battery on the device is low or even missing

            Serial.println("RTC lost confidence in the DateTime!");

            // following line sets the RTC to the date & time this sketch was compiled
            // it will also reset the valid flag internally unless the Rtc device is
            // having an issue

            Rtc.SetDateTime(compiled);
        }
    }

    if (!Rtc.GetIsRunning())
    {
        if (!wasError("setup GetIsRunning"))
        {
            Serial.println("RTC was not actively running, starting now");
            Rtc.SetIsRunning(true);
        }
    }

    RtcDateTime now = Rtc.GetDateTime();
    if (!wasError("setup GetDateTime"))
    {
        if (now < compiled)
        {
            Serial.println("RTC is older than compile time, updating DateTime");
            Rtc.SetDateTime(compiled);
        }
        else if (now > compiled)
        {
            Serial.println("RTC is newer than compile time, this is expected");
        }
        else if (now == compiled)
        {
            Serial.println("RTC is the same as compile time, while not expected all is still fine");
        }
    }

    // never assume the Rtc was last configured by you, so
    // just clear them to your needed state
    Rtc.Enable32kHzPin(false);
    wasError("setup Enable32kHzPin");
    Rtc.SetSquareWavePin(DS3231SquareWavePin_ModeNone); 
    wasError("setup SetSquareWavePin");
}

void loop () 
{
 if(rodar_sistema ==true)
 {

  if( digitalRead(rodar_semana)==LOW) //Se esta em automatico para horarios em modo alugado
  {
 //RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** 
 //RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** 
 //RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** 
 //RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** RODAR AUTOMATICO EM MODO ALUGADO ***** 

  
  //De 18 as 08 bloqueado!
  if(hora == 18 || hora == 19 || hora == 20 || hora == 21 || hora == 22 || hora == 23 || hora == 0 || hora == 1 || hora == 2 || hora == 3 || hora == 4 || hora == 5 || hora == 6 || hora == 7 || hora == 8)
  {
   digitalWrite(led_bloqueado,HIGH); //Acende lede de bloqueado
   digitalWrite(led_ligado,LOW); // Apaga o led de desligado
   digitalWrite(led_desligado,HIGH); // Sinalizando que esta desligado
   digitalWrite(rele_bomba,LOW); // Desliga a bomba
  }
  else
  {
    //Horario permitido de 09 as 17
    digitalWrite(led_bloqueado,LOW); // Apaga led de bloqueado
    
    if(hora_iniciado == "IMPAR")
    {
     if(hora == 9 || hora == 11 || hora == 13 || hora == 15 || hora == 17)
     {
      //LIGA A BOMBA
      digitalWrite(led_ligado,HIGH); // Sinaliza que a bomba esta ligada
      digitalWrite(led_desligado,!digitalRead(led_desligado)); // Fica piscando indicando que esta contanto tempo para desligar
      digitalWrite(rele_bomba,HIGH); // Liga a bomba
     }
     else // Hora = 10 ou 12 ou 14 ou 16
     {
      //DESLIGA A BOMBA
      digitalWrite(led_desligado,HIGH); // Sinaliza que a bomba esta desligada
      digitalWrite(led_ligado,!digitalRead(led_ligado)); // Fica piscando indicando que esta contanto tempo para ligar
      digitalWrite(rele_bomba,LOW); // Desliga a bomba
     }
    }
    else
    {
     //Horario par
     if(hora == 10 || hora == 12 || hora == 14 || hora == 16)
     {
      //LIGA A BOMBA
      digitalWrite(led_ligado,HIGH); // Sinaliza que a bomba esta ligada
      digitalWrite(led_desligado,!digitalRead(led_desligado)); // Fica piscando indicando que esta contanto tempo para desligar
      digitalWrite(rele_bomba,HIGH); // Liga a bomba
     }
     else // hora = 11 ou 13 ou 15 ou 17
     {
      //DESLIGA A BOMBA
      digitalWrite(led_desligado,HIGH); // Sinaliza que a bomba esta desligada
      digitalWrite(led_ligado,!digitalRead(led_ligado)); // Fica piscando indicando que esta contanto tempo para ligar
      digitalWrite(rele_bomba,LOW); // Desliga a bomba
     } 
    }
  }
  } // FECHA if( digitalRead(rodar_semana)==LOW)
  else
  {
    // RODA EM MONO SEMANAL **************************************************
    if( (hora == 9 || hora == 10 || hora == 11 || hora == 12 || hora == 13 || hora == 14  ) && ( v_dia_semana == "Segunda" || v_dia_semana == "Quarta" || v_dia_semana == "Sexta"  ) )
    {
      Serial.println("RODANDO EM MODO SEMANAL!");
     //LIGA A BOMBA
      digitalWrite(led_ligado,HIGH); // Sinaliza que a bomba esta ligada
      digitalWrite(led_desligado,LOW); // Mantem desligado o led
      digitalWrite(rele_bomba,HIGH); // Liga a bomba 
    }
    else
    {
     Serial.println("RODANDO EM MODO SEMANAL POREM BLOQUEADA PELO HORARIO E/OU DIA DA SEMANA!");
      //DESLIGA A BOMBA
      digitalWrite(led_desligado,HIGH); // Sinaliza que a bomba esta desligada
      digitalWrite(led_ligado, LOW); // Mantem desligado o led
      digitalWrite(rele_bomba,LOW); // Desliga a bomba
    }
   
  } // FECHA RODA EM MONO SEMANAL
  

 } // FECHA MODO RODAR SISTEMA **********************************************************************************************************************************
 else
 {
  //Desliga todas as saidas!
  digitalWrite(led_bloqueado,LOW); // Apaga led de bloqueado
  digitalWrite(led_ligado,LOW); // Apaga led de ligado
  digitalWrite(led_desligado,LOW); // Apaga led de desligado
  digitalWrite(rele_bomba,LOW); // Desliga a bomba
 }
    
    
    
    
    
    if (!Rtc.IsDateTimeValid()) 
    {
        if (!wasError("loop IsDateTimeValid"))
        {
            // Common Causes:
            //    1) the battery on the device is low or even missing and the power line was disconnected
            Serial.println("RTC lost confidence in the DateTime!");
        }
    }
    RtcDateTime now = Rtc.GetDateTime();
    if (!wasError("loop GetDateTime"))
    {
        printDateTime(now);
        Serial.println();
    }
 /*
  RtcTemperature temp = Rtc.GetTemperature();
    if (!wasError("loop GetTemperature"))
    {
        temp.Print(Serial);
        // you may also get the temperature as a float and print it
        // Serial.print(temp.AsFloatDegC());
        Serial.println("C");
    }
*/
    delay(1000); // ten seconds
}

#define countof(a) (sizeof(a) / sizeof(a[0]))

void printDateTime(const RtcDateTime& dt)
{
    char datestring[20];

    snprintf_P(datestring, 
            countof(datestring),
            PSTR("%02u/%02u/%04u %02u:%02u:%02u"),
            
            dt.Month(),
            dt.Day(),
            dt.Year(),
            dt.Hour(),
            dt.Minute(),
            dt.Second() );
    Serial.print("Dia da semana = ");
    v_dia_semana = dias_da_semana[dt.DayOfWeek()];
    Serial.println(v_dia_semana);
    dia = dt.Day();
    mes = dt.Month();
    ano = dt.Year();
    hora = dt.Hour();
    minuto = dt.Minute();
    segundo = dt.Second();
    
    Serial.print("Horario = ");
    Serial.println(String(dia) + "/" + String(mes) + "/ " +String(ano) + " " + String(hora) + ":" + String(minuto) + ":" + String(segundo)       );

    Serial.println("");
    if(digitalRead(ativado)==LOW && rodar_sistema == false) // para validar apenas uma vez
    {
      Serial.println("Ativado!");
      rodar_sistema = true;
      if(rodar_sistema == true)
      {
       if(hora%2 != 0)
       {
        //Iniciou em impar
        hora_iniciado = "IMPAR";
        Serial.println("Hora iniciado e " + hora_iniciado);
        Serial.println("A cascata ira operar nos horarios de 09,11,13,15,17");
       }
       else
       {
        if(hora < 10)
        {
          //Considero IMPAR para rodar mais tempos pois pode ter sido acionado as 06 ou 08 da manha
          //Iniciou em impar
          hora_iniciado = "IMPAR";
          Serial.println("Hora iniciado e " + hora_iniciado);
          Serial.println("A cascata ira operar nos horarios de 09,11,13,15,17");
        }
        else
        {
         //Iniciou em par
         hora_iniciado = "PAR";
         Serial.println("Hora iniciado e " + hora_iniciado);
         Serial.println("A cascata ira operar nos horarios de  10,12,14,16");
        }
       }
      }


     
    }
    else if (digitalRead(ativado) == HIGH && rodar_sistema == true)
    {
      Serial.println("Desativado!");
      rodar_sistema = false;
    }
    Serial.println("");

  if(digitalRead(rodar_semana) == HIGH)
     {
      digitalWrite(led_bloqueado,LOW); // Apaga led de bloqueado
     }  
}

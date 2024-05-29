/*

CONEXÃO DO ESP8266 NODEMCU NO MQTT COM OTA

   MODULO DA CENTRAL 3 ANDAR IP 192.168.2.201
   
   Conexão do modulo RS485
   RO = Pino D1
   DI = Pino D2
   DE = Pino D3
   RE = Pino D3

   Lampada Status  Pino D0
   
   Conexão Enc28j60
   SCK = Pino D5
    SO = Pino D6
    ST = Pino D7
    CS = Pino D8 porem passando pelos mosfets canal N
   RST = Reset
   VCC = 5V
   GND = GND

   Data  = Pino SD2     9
   Clock = Pino SD3    10

  Lista de IPS
  192.168.2.199 Central Externa
  192.168.2.200 Raspberry
  192.168.2.201 Central 3 Andar
  192.168.2.202 Sala / Varanda
  192.168.2.203 Quarto 1
  192.168.2.204 Quarto 2
  192.168.2.205 Cozinha
  192.168.2.206 Banheiro Social
  192.168.2.207 Cozinha / Corredor
  192.168.2.208 Quarto Casal / Banheiro
  192.168.2.209 Area Gourmet / Serviço

  DEFINICAO DOS RELES

   Sala   **************************************************

   sala = 0;     // Rele1_1
   slustre = 0;   // Rele2_1
   svaranda = 0;  // Rele3_1
   spainel = 0;   // Rele4_1
   scorti = 0;    // Rele5_1

   Quarto 1  ***********************************************

   quarto1 = 0;    // Rele6_1
   q1painel = 0;  // Rele7_1
   q1corti = 0;   // Rele8_1

   Quarto 2  ***********************************************

   quarto2 = 0;    // Rele1_2
   q2painel = 0;  // Rele2_2
   q2corti = 0;   // Rele3_2

   Cozinha   ***********************************************

   cozinha = 0;     // Rele4_2
   czcorredor = 0; // Rele5_2
   czpendente = 0; // Rele6_2
   czpia = 0;      // Rele7_2
   czpersi = 0;    // Rele8_2
   czpainel = 0;   // Rele1_3

   Quarto de Casal *****************************************
   quartocasal = 0;    // Rele2_3
   qcpainel = 0;  // Rele3_3
   qccorti = 0;   // Rele4_3

   Closet  ************************************************

   closet = 0;    // Rele5_3
   clinter = 0;   // Rele6_3
   clesp = 0;     // Rele7_3

   Espaco Gourmet *****************************************

   espgourmet = 0;      // Rele8_3
   egpendente = 0;  // Rele1_4
   egchurras = 0;   // Rele2_4
   egpersi = 0;     // Rele3_4
   espgourmet2 = 0;     // Rele4_4

   Laboratorio *********************************************

   laboratorio = 0;      // Rele5_4
   lbpersi = 0;     // Rele6_4
   lbventi = 0;     // Rele7_4

   Banheiro Social *****************************************

   banhsocial = 0;    // Rele8_4
   soesp = 0;     // Rele1_5
   soambi = 0;    // Rele2_5

   Banheiro Suite ******************************************

   banhsuite = 0;    // Rele3_5
   suesp = 0;     // Rele4_5
   suambi = 0;    // Rele5_5

   Acesso    ***********************************************

   acesso1 = 0;   // Rele6_5
   acesso2 = 0;   // Rele7_5
   ac2ambi = 0;    // Rele8_5

*/


#include <UIPEthernet.h>
#include "PubSubClient.h"
#include <ArduinoOTA.h>
#include<SoftwareSerial.h>
#define transmitir 0 // Pino DE e RE - Transmissao     PINO D3
#define pinRX 5 // Pino RO                             PINO D1
#define pinTX 4 // Pino DI                             PINO D2
SoftwareSerial RS485(pinRX, pinTX);

#define LedStatus 16 // LedStatus                      PINO D0

#define MACADDRESS 0x00,0x01,0x02,0x03,0x04,0x05
#define MYIPADDR 192,168,3,201
#define MYIPMASK 255,255,255,0
#define MYDNS 192,168,3,1
#define MYGW 192,168,3,1

// Dados para criar a conexão *******************************************************************************************************************************
uint8_t mac[6] = {MACADDRESS};
uint8_t myIP[4] = {MYIPADDR};
uint8_t myMASK[4] = {MYIPMASK};
uint8_t myDNS[4] = {MYDNS};
uint8_t myGW[4] = {MYGW};
//***********************************************************************************************************************************************************

//byte ip[] = { 192, 168, 2, 201 }; // Define o IP do arduino CADA UM DEVE TER O SEU
String ValorIP = "192.168.3.201"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "central_3 andar"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485
bool primeira_mensagem = 0;




#include <SerialRelayBruno.h>
const int NumeroModulos = 5;    // Maximo de 10 ( 80 reles )
SerialRelayBruno reles(9, 10, NumeroModulos); // (data( PINO SD2 ), clock ( PINO SD3 ), Numero de Modulos)


// CRIANDO VOIDS PARA ACESSO AS ABAS EXTERNAS DE CADA COMODO
void sala(void);
void quarto1(void);
void quarto2(void);
void cozinha(void);
void quartoc(void);
void closet(void);
void espacogourmet(void);
void laboratorio(void);
void banheiro_social(void);
void banheiro_suite(void);
void acesso(void);



String readString; // Variavel pra concatenar dados da serial
boolean intertrava = 0; // Serve para bloqueio e aciDesligarRelear apenas uma unica vez
char c;

// Variaveis da automacao

// Sala  **************************************************
boolean steto = 0;     // Rele1_1
boolean slustre = 0;   // Rele2_1
boolean svaranda = 0;  // Rele3_1
boolean spainel = 0;   // Rele4_1
boolean scorti = 0;    // Rele5_1

// Quarto 1  ***********************************************
boolean q1teto = 0;    // Rele6_1
boolean q1painel = 0;  // Rele7_1
boolean q1corti = 0;   // Rele8_1

// Quarto 2  ***********************************************
boolean q2teto = 0;    // Rele1_2
boolean q2painel = 0;  // Rele2_2
boolean q2corti = 0;   // Rele3_2

// Cozinha   ***********************************************
boolean czteto = 0;     // Rele4_2
boolean czcorredor = 0; // Rele5_2
boolean czpendente = 0; // Rele6_2
boolean czpia = 0;      // Rele7_2
boolean czpersi = 0;    // Rele8_2
boolean czpainel = 0;   // Rele1_3

// Quarto de Casal *****************************************
boolean qcteto = 0;    // Rele2_3
boolean qcpainel = 0;  // Rele3_3
boolean qccorti = 0;   // Rele4_3
boolean qcpendente = 0;   // Rele6_3

// Closet  ************************************************
boolean clteto = 0;    // Rele5_3
boolean clesp = 0;     // Rele7_3

//  Espaco Gourmet *****************************************
boolean egteto = 0;      // Rele8_3
boolean egpendente = 0;  // Rele1_4
boolean egchurras = 0;   // Rele2_4
boolean egpersi = 0;     // Rele3_4
boolean egteto2 = 0;     // Rele4_4

// Laboratorio *********************************************
boolean lbteto = 0;      // Rele5_4
boolean lbpersi = 0;     // Rele6_4
boolean lbventi = 0;     // Rele7_4

// Banheiro Social *****************************************
boolean soteto = 0;    // Rele8_4
boolean soesp = 0;     // Rele1_5
boolean soambi = 0;    // Rele2_5

// Banheiro Suite ******************************************
boolean suteto = 0;    // Rele3_5
boolean suesp = 0;     // Rele4_5
boolean suambi = 0;    // Rele5_5

// Acesso    ***********************************************
boolean ac1teto = 0;   // Rele6_5
boolean ac2teto = 0;   // Rele7_5
boolean ac2ambi = 0;    // Rele8_5*/

// DADOS DO SERVIDOR DO MQTT RASPBERRY
#define servidor_mqtt             "192.168.3.186"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "brunogon"  //Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/central"
#define TOPICO_PUBLISH   "dev/test/minhacasa/supervisorio" // Isso ira mudar de acordo com o ponto que a central ira enviar algum comando





EthernetClient Central3Andar; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(Central3Andar); // Nome de cada Servidor UNICO para cada Arduino

char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT









void imprimir()
{
  Serial.println(readString);

  // ALTERANDO OS RELES DA CASA   *****************************************************************************************************************************************************

  if ( readString.indexOf("all_principais_on") >= 0 || readString.indexOf("all_principais_off") >= 0)
  {
   principais();
  }
  

  

  // ALTERANDO OS RELES DA SALA   *****************************************************************************************************************************************************

  if ( readString.indexOf("sala_1") >= 0 || readString.indexOf("sala_0") >= 0 ||  readString.indexOf("teto_sala") >= 0)
  {
   sala();
  }
  if ( readString.indexOf("slustre_1") >= 0 || readString.indexOf("slustre_0") >= 0 ||readString.indexOf("lustre_sala") >= 0)
  {
   sala();  
  }
  if ( readString.indexOf("svaranda_1") >= 0 || readString.indexOf("svaranda_0") >= 0 || readString.indexOf("varan_sala") >= 0)
  {
    sala();
  }
  if ( readString.indexOf("spainel_1") >= 0 || readString.indexOf("spainel_0") >= 0 || readString.indexOf("amb_sala") >= 0)
  {
   sala();
  }
  if ( readString.indexOf("scorti_1") >= 0 || readString.indexOf("scorti_0") >= 0 || readString.indexOf("lam_cor_sala") >= 0)
  {
   sala();
  }
  if ( readString.indexOf("all_sala_on") >= 0 || readString.indexOf("all_sala_off") >= 0)
  {
   sala(); 
  }

  // QUARTO 1   *************************************************************************************************************************************************************************
  
  if ( readString.indexOf("quarto1_1") >= 0 ||  readString.indexOf("quarto1_0") >= 0 || readString.indexOf("lamp_quarto1") >= 0)
  {
   quarto1(); 
  }
  if ( readString.indexOf("q1painel_1") >= 0 || readString.indexOf("q1painel_0") >= 0 || readString.indexOf("amb_quarto1") >= 0)
  {
   quarto1(); 
  }
  if ( readString.indexOf("q1corti_1") >= 0 || readString.indexOf("q1corti_0") >= 0 || readString.indexOf("lam_cor_q1") >= 0)
  {
   quarto1(); 
  }
  if ( readString.indexOf("all_quarto1_on") >= 0 || readString.indexOf("all_quarto1_off") >= 0)
  {
   quarto1(); 
  }
  
  // QUARTO 2   *************************************************************************************************************************************************************************     

  if ( readString.indexOf("quarto2_1") >= 0 || readString.indexOf("quarto2_0") >= 0 || readString.indexOf("lamp_quarto2") >= 0)
  {
   quarto2();
  }
  if ( readString.indexOf("q2painel_1") >= 0 || readString.indexOf("q2painel_0") >= 0 || readString.indexOf("amb_quarto2") >= 0)
  {
   quarto2(); 
  }
  if ( readString.indexOf("q2corti_1") >= 0 || readString.indexOf("q2corti_0") >= 0 || readString.indexOf("lam_cor_q2") >= 0)
  {
   quarto2(); 
  }
  if ( readString.indexOf("all_quarto2_on") >= 0 || readString.indexOf("all_quarto2_off") >= 0)
  {
   quarto2(); 
  }
  
  // COZINHA   **************************************************************************************************************************************************************************

   if ( readString.indexOf("cozinha_1") >= 0 || readString.indexOf("cozinha_0") >= 0 || readString.indexOf("teto_cozinha") >= 0)
  {
   cozinha();
  }
  if ( readString.indexOf("czcorredor_1") >= 0 || readString.indexOf("czcorredor_0") >= 0 || readString.indexOf("teto_corredo") >= 0)
  {
   cozinha(); 
  }
  if ( readString.indexOf("czpendente_1") >= 0 || readString.indexOf("czpendente_0") >= 0 || readString.indexOf("pend_cozinha") >= 0)
  {
   cozinha(); 
  }
  if ( readString.indexOf("czpia_1") >= 0 || readString.indexOf("czpia_0") >= 0 || readString.indexOf("amb_cozinha") >= 0)
  {
   cozinha(); 
  }
  if ( readString.indexOf("czpersi_1") >= 0 || readString.indexOf("czpersi_0") >= 0 || readString.indexOf("lam_per_coz") >= 0)
  {
   cozinha(); 
  }
  if ( readString.indexOf("czpainel_1") >= 0 || readString.indexOf("czpainel_0") >= 0 || readString.indexOf("amb_ptv_coz") >= 0)
  {
   cozinha(); 
  }
  if ( readString.indexOf("all_cozinha_on") >= 0 || readString.indexOf("all_cozinha_off") >= 0)
  {
   cozinha(); 
  }

  
  // QUARTO DE CASAL   ******************************************************************************************************************************************************************

  if ( readString.indexOf("quartocasal_1") >= 0 || readString.indexOf("quartocasal_0") >= 0 || readString.indexOf("lamp_quartoc") >= 0)
  {
   quartoc(); 
  }
  if ( readString.indexOf("qcpainel_1") >= 0 || readString.indexOf("qcpainel_0") >= 0 || readString.indexOf("amb_quartoc") >= 0)
  {
   quartoc(); 
  }  
  if ( readString.indexOf("qccorti_1") >= 0 || readString.indexOf("qccorti_0") >= 0 || readString.indexOf("lam_cor_qc") >= 0)
  {
   quartoc(); 
  }
  if ( readString.indexOf("qcpendente_1") >= 0 || readString.indexOf("qcpendente_0") >= 0 || readString.indexOf("pendente_qc") >= 0)
  {
   quartoc(); 
  }
  if ( readString.indexOf("all_quartoc_on") >= 0 || readString.indexOf("all_quartoc_off") >= 0)
  {
   quartoc(); 
  }
  
  // CLOSET   ****************************************************************************************************************************************************************************
 
  if ( readString.indexOf("closet_1") >= 0 || readString.indexOf("closet_0") >= 0 || readString.indexOf("lamp_closet") >= 0)
  {
   closet(); 
  }
  if ( readString.indexOf("clesp_1") >= 0 || readString.indexOf("clesp_0") >= 0 ||readString.indexOf("espe_closet") >= 0)
  {
   closet(); 
  }
  if ( readString.indexOf("all_closet_on") >= 0 || readString.indexOf("all_closet_off") >= 0)
  {
   closet(); 
  }
   
  // ESPACO GOURMET   ********************************************************************************************************************************************************************
  
  if ( readString.indexOf("espgourmet_1") >= 0 || readString.indexOf("espgourmet_0") >= 0 || readString.indexOf("teto_gourmet") >= 0)
  {
   espacogourmet(); 
  }
  if ( readString.indexOf("egpendente_1") >= 0 || readString.indexOf("egpendente_0") >= 0 || readString.indexOf("pend_gourmet") >= 0)
  {
   espacogourmet(); 
  }
  if ( readString.indexOf("egchurras_1") >= 0 || readString.indexOf("egchurras_0") >= 0 || readString.indexOf("chur_gourmet") >= 0)
  {
   espacogourmet(); 
  }
  if ( readString.indexOf("egpersi_1") >= 0 || readString.indexOf("egpersi_0") >= 0 || readString.indexOf("lam_per_eg") >= 0) 
  {
   espacogourmet(); 
  }
  if ( readString.indexOf("espgourmet2_1") >= 0 || readString.indexOf("espgourmet2_0") >= 0 || readString.indexOf("lam_lav_eg") >= 0)
  {
   espacogourmet(); 
  }
  if ( readString.indexOf("all_espgour_on") >= 0 || readString.indexOf("all_espgour_off") >= 0)
  {
   espacogourmet(); 
  }
     
  // LABORATORIO   ************************************************************************************************************************************************************************
  
  if ( readString.indexOf("laboratorio_1") >= 0 || readString.indexOf("laboratorio_0") >= 0 || readString.indexOf("teto_labora") >= 0)
  {
   laboratorio(); 
  }
  if ( readString.indexOf("lbpersi_1") >= 0 || readString.indexOf("lbpersi_0") >= 0 || readString.indexOf("lam_per_lb") >= 0)
  {
   laboratorio(); 
  }
  if ( readString.indexOf("lbventi_1") >= 0 || readString.indexOf("lbventi_0") >= 0 || readString.indexOf("vent_labora") >= 0)
  {
   laboratorio(); 
  }
  if ( readString.indexOf("all_lab_on") >= 0 || readString.indexOf("all_lab_off") >= 0)
  {
   laboratorio(); 
  }
  
  // BANHEIRO SOCIAL   ********************************************************************************************************************************************************************

  if ( readString.indexOf("banhsocial_1") >= 0 || readString.indexOf("banhsocial_0") >= 0 || readString.indexOf("l_ban_soci") >= 0)
  {
   banheiro_social(); 
  }
  if ( readString.indexOf("soesp_1") >= 0 || readString.indexOf("soesp_0") >= 0 || readString.indexOf("esp_ban_soci") >= 0)
  {
   banheiro_social(); 
  }
  if ( readString.indexOf("soambi_1") >= 0 || readString.indexOf("soambi_0") >= 0 || readString.indexOf("amb_ban_soci") >= 0)
  {
   banheiro_social(); 
  }
  if ( readString.indexOf("all_bansoci_on") >= 0 || readString.indexOf("all_bansoci_off") >= 0)
  {
   banheiro_social(); 
  }
   
  // BANHEIRO SUITE   *********************************************************************************************************************************************************************
  
  if ( readString.indexOf("banhsuite_1") >= 0 || readString.indexOf("banhsuite_0") >= 0 || readString.indexOf("lam_banh_c") >= 0)
  {
   banheiro_suite(); 
  }
  if ( readString.indexOf("suesp_1") >= 0 || readString.indexOf("suesp_0") >= 0 || readString.indexOf("esp_banh_c") >= 0)
  {
   banheiro_suite(); 
  }
  if ( readString.indexOf("suambi_1") >= 0 || readString.indexOf("suambi_0") >= 0 || readString.indexOf("amb_ban_c") >= 0)
  {
   banheiro_suite();     
  }
  if ( readString.indexOf("all_bansui_on") >= 0 || readString.indexOf("all_bansui_off") >= 0)
  {
   banheiro_suite(); 
  }
  
  // ACESSO   *****************************************************************************************************************************************************************************

  if ( readString.indexOf("acesso1_1") >= 0 || readString.indexOf("acesso1_0") >= 0 || readString.indexOf("lam_ac_t1") >= 0)
  {
   acesso(); 
  }
  if ( readString.indexOf("acesso2_1") >= 0 || readString.indexOf("acesso2_0") >= 0 || readString.indexOf("lam_ac_t2") >= 0)
  {
   acesso(); 
  }
  if ( readString.indexOf("ac2ambi_1") >= 0 || readString.indexOf("ac2ambi_0") >= 0 || readString.indexOf("amb_ac_t2") >= 0)
  {
   acesso(); 
  }
  if ( readString.indexOf("all_acesso_on") >= 0 || readString.indexOf("all_acesso_off") >= 0)
  {
   acesso(); 
  }

  // DESLIGAR GERAL   ********************************************************************************************************************************************************************
  
  if ( readString.indexOf("all_todos_0") >= 0 )
  {
    for (int i = 1 ; i <= NumeroModulos ; i++)
    {
      for (int j = 1 ; j <= 8 ; j++)
        {   
        reles.SetRelay(j, DesligarRele, i);
      }
    }
  }
  
  // LIGAR GERAL   ********************************************************************************************************************************************************************
  
  if ( readString.indexOf("all_todos_1") >= 0 )
  {
   for (int i = 1 ; i <= NumeroModulos ; i++)
    {
      for (int j = 1 ; j <= 8 ; j++)
      {
        reles.SetRelay(j, LigarRele, i);
        delay(800);
      }
     }
    readString="";
    Serial.println("rodou");
    digitalWrite(LedStatus,HIGH);
    delay(1000);
    digitalWrite(LedStatus,LOW);
  }



  // AREA EXTERNA   **********************************************************************************************************************************************************************
  if ( readString.indexOf("teto_1") >= 0)
  {
   client.publish("dev/test/garagem/externa", "teto_1");
   delay(200);
  }
  if ( readString.indexOf("teto_0") >= 0)
  {
   client.publish("dev/test/garagem/externa", "teto_0");
   delay(200);
  }
  if ( readString.indexOf("pendente_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "pendente_1");
   delay(200);
  }
  if ( readString.indexOf("pendente_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "pendente_0");
   delay(200);
  }
  if ( readString.indexOf("quadro_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "quadro_1");
   delay(200);
  }
  if ( readString.indexOf("quadro_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "quadro_0");
   delay(200);
  }
  if ( readString.indexOf("muro_ch_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "muro_ch_1");
   delay(200);
  }
  if ( readString.indexOf("muro_ch_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "muro_ch_0");
   delay(200);
  }
  if ( readString.indexOf("liga1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "liga1");
   delay(200);
  }
  if ( readString.indexOf("desliga1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "desliga1");
   delay(200);
  }
  if ( readString.indexOf("liga2") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "liga2");
   delay(200);
  }
  if ( readString.indexOf("desliga2") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "desliga2");
   delay(200);
  }
  if ( readString.indexOf("liga3") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "liga3");
   delay(200);
  }
  if ( readString.indexOf("desliga3") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "desliga3");
   delay(200);
  }
  if ( readString.indexOf("muro_ca_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "muro_ca_1");
   delay(200);
  }
  if ( readString.indexOf("muro_ca_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "muro_ca_0");
   delay(200);
  }
  if ( readString.indexOf("jardim_h_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "jardim_h_1");
   delay(200);
  }
  if ( readString.indexOf("jardim_h_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "jardim_h_0");
   delay(200);
  }
  if ( readString.indexOf("jardim_v_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "jardim_v_1");
   delay(200);
  }
  if ( readString.indexOf("jardim_v_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "jardim_v_0");
   delay(200);
  }
  if ( readString.indexOf("oficina_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "oficina_1");
   delay(200);
  }
  if ( readString.indexOf("oficina_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "oficina_0");
   delay(200);
  }
  if ( readString.indexOf("frente_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "frente_1");
   delay(200);
  }
  if ( readString.indexOf("frente_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa", "frente_0");
   delay(200);
  }

  
 readString = ""; // Limpa a mensagem
 loop(); // Mantem sempre rodando

} // Fecha void imprimir







//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("Central3Andar", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("Central3Andar");
    if (conectado)
    {
     client.subscribe(mqtt_topico_sub, 1); //QoS 1 Subscreve para monitorar os comandos recebidos
     Serial.println("Conectado!");
     digitalWrite(LedStatus, LOW); // Ligado caso conecte no MQTT
    }
    else
    {
     Serial.println("Tentando Reconectar!");
     digitalWrite(LedStatus, HIGH); // Mantem apagado caso nao realize conexao
     delay(2000);
    }
  }
}

//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
   digitalWrite(LedStatus, HIGH); // 
   delay(200);
    digitalWrite(LedStatus, LOW); // 
  if (strMensagem == id )
  {
    String DadosDaMensagemRecebida = String(id) + String(" = ") + String(ValorIP);
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish("dev/test/garagem/externa/central", MensagemRecebida);
    delay(100);
  }
  else
  {
   MensagemParaImprimir = strMensagem;
   readString = strMensagem;
   if (primeira_mensagem == 1)
   {
    
    imprimir(); //Chama o void para imprimir
   }
   if (primeira_mensagem == 0)
   {
    primeira_mensagem = 1;
   }
  }
} // Fecha o void atualizar_mensagem



void setup()
{
  Serial.begin(115200);
  //  Ethernet.begin(ip); // Conecta através do ip fixo
  Ethernet.begin(mac,myIP,myDNS,myGW,myMASK);
  RS485.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);
  pinMode(A0,OUTPUT);
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  //Serial.println(Ethernet.localIP());
  pinMode(LedStatus, OUTPUT); // Define LedMensagem como saida
  digitalWrite(LedStatus, HIGH); // Inicia apagagado
  
  // Desligando todos os reles
  for (int i = 1 ; i <= NumeroModulos ; i++)
  {
    for (int j = 1 ; j <= 8 ; j++)
    {
      reles.SetRelay(j, DesligarRele, i);
    }
  }

  ArduinoOTA.setHostname("central_reles"); // nome que ira aparecer na rede
  // No authentication by default
  ArduinoOTA.onStart([]() {
    Serial.println("Inicio...");
  });
  ArduinoOTA.onEnd([]() {
    Serial.println("nFim!");
  });
  ArduinoOTA.onProgress([](unsigned int progress, unsigned int total) {
    Serial.printf("Progresso: %u%%r", (progress / (total / 100)));
  });
  ArduinoOTA.onError([](ota_error_t error) {
    Serial.printf("Erro [%u]: ", error);
    if (error == OTA_AUTH_ERROR) Serial.println("Autenticacao Falhou");
    else if (error == OTA_BEGIN_ERROR) Serial.println("Falha no Inicio");
    else if (error == OTA_CONNECT_ERROR) Serial.println("Falha na Conexao");
    else if (error == OTA_RECEIVE_ERROR) Serial.println("Falha na Recepcao");
    else if (error == OTA_END_ERROR) Serial.println("Falha no Fim");
  });
  ArduinoOTA.begin();



  
} // Fecha o void setup



void loop()
{
  ArduinoOTA.handle();
  if (!client.connected())
  {
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  }
  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT

}

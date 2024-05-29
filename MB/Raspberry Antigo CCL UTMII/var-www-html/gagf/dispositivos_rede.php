<!DOCTYPE html>
<html lang="pt-br">
    <head>
     <meta charset="utf-8"/>
     <title>Teste Fluxograma</title>
    <script type="text/javascript" src="./charts_fluxograma.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);
    
      var total_links;
      var links_offline;
      var links_online;
      var links_bat;

      function drawChart() {
        data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        
        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([

          // LINKS GERAL / PRINCIPAIS RGTECH
          [{'v':'RGTECH', 'f':'RGTECH<div style="color:blue; font-style:italic">Link Serra Ouro Branco</div>'},'', 'The President',],
          [{'v':'Inicio Rede','f':'Inicio Rede<div id=ip_Link Patrag style="color:blue; font-style:italic"></div>'}, 'RGTECH', ''],
          [{'v':'Link_VL', 'f':'Link_VL<div style="color:blue; font-style:italic">Link Mirante</div>'},'RGTECH', 'VP'],
          [{'v':'Link Escritorio UTMI','f':'Link Escritorio UTMI<div id=ip_Link Escritorio UTMI style="color:blue; font-style:italic">Link Escritorio UTMI</div>'}, 'RGTECH', 'Dispositivo para automação da logistica \n'],
          [{'v':'Link CCL MB','f':'Link CCL MB<div id=ip_Link Escritorio UTMI style="color:blue; font-style:italic">Link CCL</div>'}, 'RGTECH', 'Dispositivo para automação da logistica \n'],
          [{'v':'Link Recebimento ROM','f':'Link Recebimento ROM<div id=ip_Link Escritorio UTMI style="color:blue; font-style:italic">Base Box RGTECH</div>'}, 'RGTECH', 'Link para dispositivos instalado na saida alternativa do patio do recebimento de ROM de Miguel Burnier \n'],
          [{'v':'Link Saida Alternativa','f':'Link Saida Alternativa<div id=ip_Link Escritorio UTMI style="color:blue; font-style:italic">Base Box RGTECH</div>'}, 'RGTECH', 'Link para dispositivos instalado na saida alternativa do patio do recebimento de ROM de Miguel Burnier \n'],
          [{'v':'Link Patio Produto UTMII','f':'Link Patio Produto UTMII<div id=ip_Link Escritorio UTMI style="color:blue; font-style:italic">Carretinha RGTECH</br>Base Box</div>'}, 'RGTECH', 'Dispositivo para automação da logistica \n'],
          [{'v':'Link Patrag','f':'Link Patrag<div id=ip_Link Patrag style="color:blue; font-style:italic">Automação Patrag</div>'}, 'RGTECH', 'Dispositivo para automação da logistica \n'],
          [{'v':'Final Rede','f':'Final Rede<div id=ip_Link Patrag style="color:blue; font-style:italic"></div>'}, 'RGTECH', ''],

         

          // LINKS SALA AUTOMACAO LOGISTICA MB
          [{'v':'RB2011','f':'RB2011<div id=switch_rgtech_escritorio_utmi style="color:blue; font-style:italic">Routerborad RGTECH</div>'}, 'Link Escritorio UTMI', 'Routerboard RGETECH \n'],
          [{'v':'Swtich TPLINK','f':'Swtich TPLINK<div id=switch_automacao_sala_logistica style="color:blue; font-style:italic">Switch Sala Logistica</div>'}, 'RB2011', 'Não possui ip'],
          [{'v':'MQTT_PHP','f':'MQTT_PHP<div id=mqtt_php style="color:blue; font-style:italic">Salva dados MQTT no PHP</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.85 \n'],
          [{'v':'PHP_MQTT','f':'PHP_MQT<div id=php_mqtt style="color:blue; font-style:italic">Publica dados banco no MQTT</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.87 \n'],
          [{'v':'MQTT PHP Monitor Tensao','f':'MQTT PHP Monitor Tensao<div id=mqtt_php_monitor_tensao style="color:blue; font-style:italic">Esp8266 NodeMCU</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.83 \n'],
          [{'v':'Servidor PING','f':'Servidor PING<div id=servidor_ping style="color:blue; font-style:italic">Ping dos dispositivos da rede</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.84 \n'],
          [{'v':'Modem GAGF Logistica','f':'Modem GAGF Logistica<div id=modem_gagf_logistica style="color:blue; font-style:italic">Rede GAGF Automação Logística</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.250 \n'],
          [{'v':'Cria Link Automação/UTMI','f':'Cria Link Automação/UTMI<div id=mikrotik_groove_automacao_utmi style="color:blue; font-style:italic">Mikrotik Groove A-52hpn</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.73 \n'],
          [{'v':'Tablet Processador TAGs','f':'Tablet Processador TAGs<div id=tablet_processador_tag style="color:blue; font-style:italic">Tablet Sansung</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.91 \n'],
          [{'v':'NVR Logistica','f':'NVR Logistica<div id=nvr_cftv_logistica style="color:blue; font-style:italic">CFTV Logistica</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.32 \n'],
          [{'v':'Servidor Automação','f':'Servidor Automação<div id=raspberry_servidor_automacao style="color:blue; font-style:italic">Raspberry Pi</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.200 \n'],
          [{'v':'Tablet Testes Logistica','f':'Tablet Testes Logistica<div id=tablet_testes_logistica style="color:blue; font-style:italic">Tablet Multilaser</div>'}, 'Swtich TPLINK', 'IP: 10.10.25.93 \n'],
          

          // LINKS PATIO EXCESSO
          [{'v':'Link Patio Excesso','f':'Link Patio Excesso<div id=mikrotik_patio_excesso style="color:blue; font-style:italic">SXT Lite 5</div>'}, 'Cria Link Automação/UTMI', 'IP: 10.10.25.97 \n'],
          [{'v':'Câmera Patio Excesso','f':'Câmera Patio Excesso<div id=camera_patio_excesso style="color:blue; font-style:italic">Pelco</div>'}, 'Link Patio Excesso', 'IP: 10.10.25.113 \n'],

          // LINKS UTMI
          [{'v':'Link UTMI/Automação','f':'Link UTMI/Automação<div id=mikrotik_utmi_automacao style="color:blue; font-style:italic">SXT Lite 5</div>'}, 'Cria Link Automação/UTMI', 'IP: 10.10.25.75 \n'],
          [{'v':'Switch UTMI','f':'Switch UTMI<div id=switch_utmi style="color:blue; font-style:italic">Switch</div>'}, 'Link UTMI/Automação', 'Não possui IP'],
          [{'v':'GAGF Patio UTMI','f':'GAGF Patio UTMI<div id=mikrotik_gagf_patio_utmi style="color:blue; font-style:italic">Groove A-52hpn</div>'}, 'Switch UTMI', 'IP: 10.10.25.233 \n'],
          [{'v':'Câmera Patio UTMI','f':'Câmera Patio UTMI<div id=camera_patio_produto_utmi style="color:blue; font-style:italic">Câmera Intelbras VIP1020B G2</div>'}, 'Switch UTMI', 'IP: 10.10.25.43 \n'],
          [{'v':'Monitor Tensao UTMI','f':'Monitor Tensao UTMI<div id=monitor_tensao_utmi style="color:blue; font-style:italic">Esp8266 NodeMCU</div>'}, 'Switch UTMI', 'IP: 10.10.25.82 \n'],
          // LINKS BALANÇA 02
          [{'v':'Link Balança 02 MB','f':'Link Balança 02 MB<div id=mikrotik_balanca_02_mb style="color:blue; font-style:italic">SXT Lite 2</div>'}, 'GAGF Patio UTMI', 'IP: 10.10.25.139 \n'],
          [{'v':'Switch Balança 02 MB','f':'Switch Balança 02 MB<div id=switch_balanca_02_mb style="color:blue; font-style:italic">Switch TPLINK</div>'}, 'Link Balança 02 MB', 'Não possui IP'],
          [{'v':'DVR Balança 02 MB','f':'DVR Balança 02 MB<div id=dvr_balanca_02_mb style="color:blue; font-style:italic">DVR Intelbras</div>'}, 'Switch Balança 02 MB','IP: 10.10.25.227'],
          [{'v':'Câmera Testes Parafusos UTMI<div id=camera_teste_parafusos_balanca_02_mb style="color:black; background-color:rgb(77, 207, 166); font-style:italic">Câmera Hikivision</div>'}, 'Switch Balança 02 MB', 'IP: 10.10.25.46 \n'],
          
          // LINKS RECEBIMENTO ROM
          [{'v':'Switch RGTECH Rec. ROM','f':'Switch RGTECH Rec. ROM<div id=switch_rgtech_rec_rom style="color:blue; font-style:italic">RB750</div>'}, 'Link Recebimento ROM', 'Sem IP \n'],
          [{'v':'Reader Rec. ROM','f':'Reader Rec. ROM<div id=reader_rec_rom style="color:blue; font-style:italic">CA16003055</div>'}, 'Switch RGTECH Rec. ROM', 'MINA001 \n IP: 10.50.210.50  \n CA16003055 \n MAC Addres: 00:1B:5F:00:FB:01 \n Modelo: Alien ALR-F800'],
          [{'v':'Switch Rec. ROM','f':'Switch Rec. ROM<div id=switch_rec_rom style="color:blue; font-style:italic">TPLINK 16 CH</div>'}, 'Switch RGTECH Rec. ROM', 'Sem IP \n'],
          [{'v':'Câmera Superior Entrada Rec. ROM','f':'Câmera Superior Entrada Rec. ROM<div id=camera_superior_entrada_rec_rom style="color:blue; font-style:italic">HIKIVISION</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.110'],
          [{'v':'Câmera Placa Entrada Rec. ROM','f':'Câmera Placa Entrada Rec. ROM<div id=camera_placa_entrada_rec_rom style="color:blue; font-style:italic">HIKIVISION</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.116'],
          [{'v':'Câmera Superior Saída Rec. ROM','f':'Câmera Superior Saída Rec. ROM<div id=camera_superior_saida_rec_rom style="color:blue; font-style:italic">HIKIVISION</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.112'],
          [{'v':'Câmera Placa Saída Rec. ROM','f':'Câmera Placa Saída Rec. ROM<div id=camera_placa_saida_rec_rom style="color:blue; font-style:italic">HIKIVISION</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.111'],
          [{'v':'Computador Video Analitico SVA','f':'Computador Video Analitico SVA<div id=computador_sva_rec_rom style="color:blue; font-style:italic">SVA Video Analitico</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.117'],
          [{'v':'Raspberry Painel TV Rec. ROM','f':'Raspberry Painel TV Rec. ROM<div id=raspberry_tv_rec_rom style="color:blue; font-style:italic">Raspberry Painel TV</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.212 \n Raspberry PI 3 B+ modo QUIOSQUE'],
          [{'v':'Cria Link CFTV Saída Alt. Rec. ROM','f':'Cria Link CFTV Saída Alt. Rec. ROM<div id=mikrotik_cria_link_cftv_rec_rom style="color:blue; font-style:italic">SXT Lite 5</div>'}, 'Switch Rec. ROM', 'IP: 10.10.25.140 \n'],
          
          // LINKS RECEBIMENTO ROM / SAIDA ALTERNATIVA
          [{'v':'Recebe Link CFTV Saída Alt. Rec. ROM','f':'Recebe Link CFTV Saída Alt. Rec. ROM<div id=mikrotik_recebe_link_cftv_rec_rom style="color:blue; font-style:italic">SXT Lite 5</div>'}, 'Cria Link CFTV Saída Alt. Rec. ROM', 'IP: 10.10.25.141 \n'],
          [{'v':'Switch Rec. ROM/Saida Alt.','f':'Switch Rec. ROM/Saida Alt.<div id=switch_rec_rom/saida_alt style="color:blue; font-style:italic">TPLINK 8 CH</div>'}, 'Recebe Link CFTV Saída Alt. Rec. ROM', 'Sem IP \n'],
          [{'v':'Câmera Superior Saida Alt. Rec. ROM','f':'Câmera Superior Saida Alt. Rec. ROM<div id=camera_superior_saida_alt_rec_rom style="color:blue; font-style:italic">HIKIVISION</div>'}, 'Switch Rec. ROM/Saida Alt.', 'IP: 10.10.25.114'],
          [{'v':'Câmera Placa Saida Alt. Rec. ROM','f':'Câmera Placa Saida Alt. Rec. ROM<div id=camera_placa_saida_alt_rec_rom style="color:blue; font-style:italic">HIKIVISION</div>'}, 'Switch Rec. ROM/Saida Alt.', 'IP: 10.10.25.115'],
          
          // LINKS SAIDA ALTERNATIVA RECEBIMENTO ROM
          [{'v':'Switch RGTECH Saida Alt. Rec. ROM','f':'Switch RGTECH Saida Alt. Rec. ROM<div id=switch_rgtech_saida_alt_rec_rom style="color:blue; font-style:italic">RB750</div>'}, 'Link Saida Alternativa', 'Sem IP \n'],
          [{'v':'Switch Saida Alt. Rec. ROM','f':'Switch Saida Alt. Rec. ROM<div id=switch_saida_alt_rec_rom style="color:blue; font-style:italic">TPLINK 8 CH</div>'}, 'Switch RGTECH Saida Alt. Rec. ROM', 'Sem IP \n'],
          [{'v':'Câmera Patio ROM UTMII','f':'Câmera Patio ROM UTMII<div id=camera_patio_rom_utmii style="color:blue; font-style:italic">Câmera Intelbras VIP1020B G2</div>'}, 'Switch Saida Alt. Rec. ROM', 'IP: 10.10.25.62 \n'],
          [{'v':'Reader Saida Alt. Rec. ROM','f':'Reader Saida Alt. Rec. ROM<div id=reader_saida_alt_rec_rom style="color:blue; font-style:italic">KA17005936</div>'}, 'Switch Saida Alt. Rec. ROM', 'RFIDUTMROMII \n IP: 10.10.25.35  \n KA17005936 \n MAC Addres: 00:1b:5f:00:fc:fd \n Modelo: Alien ALR-F800'],
          [{'v':'GAGF Saida Alt. Rec. ROM','f':'GAGF Saida Alt. Rec. ROM<div id=mikrotik_gagf_saida_alt_rec_rom style="color:blue; font-style:italic">Groove A-52hpn</div>'}, 'Switch Saida Alt. Rec. ROM', 'IP: 10.10.25.224 \n'],

          // LINKS PATIO PRODUTO UTMII
          [{'v':'GAGF Patio Produto UMII','f':'GAGF Patio Produto UMII<div id=mikrotik_gagf_patio_produto_utmii style="color:blue; font-style:italic">Groove A-52hpn</div>'}, 'Link Patio Produto UTMII', 'IP: 10.10.25.214 \n'],
          
          // PAS CARREGADEIRAS UTMII
          // PC-02.001
          [{'v':'Carregadeira</br>PC-02.001','f':'Carregadeira</br>PC-02.001<div id=mikrotik_pc02.001 style="color:blue; font-style:italic">Groove A-52hpn</div>'}, 'GAGF Patio Produto UMII', 'IP: 10.10.25.151 \n'],
          [{'v':'Tablet</br>PC-02.001','f':'Tablet</br>PC-02.001<div id=tablet_pc02.001 style="color:blue; font-style:italic">Tablet Sansung</div>'}, 'Carregadeira</br>PC-02.001', 'IP: 10.10.25.51 \n'],
          [{'v':'Automacao</br>PC-02.001','f':'Automacao</br>PC-02.001<div id=automacao_pc02.001 style="color:blue; font-style:italic">ESP8266 NodeMCU</div>'}, 'Carregadeira</br>PC-02.001', 'IP: 10.10.25.101 \n'],
          [{'v':'Reader</br>PC-02.001','f':'Reader</br>PC-02.001<div id=reader_pc02.001 style="color:blue; font-style:italic">CA16002791</div>'}, 'Carregadeira</br>PC-02.001', 'RFIDCX003R \n IP: 10.10.25.15  \n CA16002791 \n MAC Addres: 00:1B:5F:00:FC:C5 \n Modelo: Alien ALR-F800'],
          
          // PC-02.006
          [{'v':'Carregadeira</br>PC-02.006','f':'Carregadeira</br>PC-02.006<div id=mikrotik_pc02.006 style="color:blue; font-style:italic">Groove A-52hpn</div>'}, 'GAGF Patio Produto UMII', 'IP: 10.10.25.156 \n'],
          [{'v':'Tablet</br>PC-02.006','f':'Tablet</br>PC-02.006<div id=tablet_pc02.006 style="color:blue; font-style:italic">Tablet Sansung</div>'}, 'Carregadeira</br>PC-02.006', 'IP: 10.10.25.56 \n'],
          [{'v':'Automacao</br>PC-02.006','f':'Automacao</br>PC-02.006<div id=automacao_pc02.006 style="color:blue; font-style:italic">ESP8266 NodeMCU</div>'}, 'Carregadeira</br>PC-02.006', 'IP: 10.10.25.106 \n'],
          [{'v':'Reader</br>PC-02.006','f':'Reader</br>PC-02.006<div id=reader_pc02.006 style="color:blue; font-style:italic">CA16002783</div>'}, 'Carregadeira</br>PC-02.006', 'RFIDCX001R \n IP: 10.10.25.17  \n CA16002783 \n MAC Addres: 00:1B:5F:00:FA:AB \n Modelo: Alien ALR-F800'],
          
          // PC-02.009
          [{'v':'Carregadeira</br>PC-02.009','f':'Carregadeira</br>PC-02.009<div id=mikrotik_pc02.009 style="color:blue; font-style:italic">Groove A-52hpn</div>'}, 'GAGF Patio Produto UMII', 'IP: 10.10.25.159 \n'],
          [{'v':'Tablet</br>PC-02.009','f':'Tablet</br>PC-02.009<div id=tablet_pc02.009 style="color:blue; font-style:italic">Tablet Sansung</div>'}, 'Carregadeira</br>PC-02.009', 'IP: 10.10.25.59 \n'],
          [{'v':'Automacao</br>PC-02.009','f':'Automacao</br>PC-02.009<div id=automacao_pc02.009 style="color:blue; font-style:italic">ESP8266 NodeMCU</div>'}, 'Carregadeira</br>PC-02.009', 'IP: 10.10.25.109 \n'],
          [{'v':'Reader</br>PC-02.009','f':'Reader</br>PC-02.009<div id=reader_pc02.009 style="color:blue; font-style:italic">CA16002907</div>'}, 'Carregadeira</br>PC-02.009', 'RFIDCX008R \n IP: 10.10.25.11  \n CA16002907 \n MAC Addres: 00:1B:5F:00:FA:D3 \n Modelo: Alien ALR-F800'],
   
          
          
          
          
          
          
          
          
          // LINKS PLATAFORMA DE AMOSTRAGEM UTMII
          [{'v':'Link Plataforma de Amostragem Patio UTMII','f':'Link Plataforma de Amostragem Patio UTMII<div id=mikrotik_link_plataforma_amostragem_utmii style="color:blue; font-style:italic">SXT Lite 2</div>'}, 'GAGF Patio Produto UMII', 'IP: 10.10.25.184 \n'],
          [{'v':'Switch Plataforma Amostragem UTMII','f':'Switch Plataforma Amostragem UTMII<div id=switch_plataforma_amostragem_utmii style="color:blue; font-style:italic">TPLINK 8 CH</div>'}, 'Link Plataforma de Amostragem Patio UTMII', 'Sem IP \n'],
          [{'v':'Câmera Patio de Produto UTMII','f':'Câmera Patio de Produto UTMII<div id=camera_patio_produto_utmii style="color:blue; font-style:italic">Câmera Intelbras VIP1020B G2</div>'}, 'Switch Plataforma Amostragem UTMII', 'IP: 10.10.25.44 \n'],
          [{'v':'Reader Plataforma Amostragem UMTII','f':'Reader Plataforma Amostragem UMTII<div id=reader_plataforma_amostragem_utmii style="color:blue; font-style:italic">KB16005363</div>'}, 'Switch Plataforma Amostragem UTMII', 'RFIDPLATAMOST \n IP: 10.10.25.89  \n KB16005363 \n MAC Addres: 00:1b:5f:00:fd:39 \n Modelo: Alien ALR-F800'],
          [{'v':'Raspberry Painel TV Plataforma Amostragem UTMII','f':'Raspberry Painel TV Plataforma Amostragem UTMII<div id=raspberry_tv_plataforma_amostragem_utmii style="color:blue; font-style:italic">Raspberry Painel TV</div>'}, 'Switch Plataforma Amostragem UTMII', 'IP: 10.10.25.213 \n Raspberry PI 3 B+ modo QUIOSQUE'],
          
          // LINKS PATIO PATRAG
          [{'v':'Switch RGTECH','f':'Switch RGTECH<div id=switch_rgtech_patrag style="color:blue; font-style:italic">RB750</div>'}, 'Link Patrag', 'Sem IP'],
          [{'v':'Switch Patrag','f':'Switch Patrag<div id=switch_patrag style="color:blue; font-style:italic">TPLINK 8 CH</div>'}, 'Switch RGTECH', 'Sem IP'],
          [{'v':'Monitor Tensao Patrag','f':'Monitor Tensao Patrag<div id=monitor_tensao_patrag style="color:blue; font-style:italic">Esp8266 NodeMCU</div>'}, 'Switch Patrag', 'IP: 10.10.25.202 \n'],
          [{'v':'Reader Patrag','f':'Reader Patrag<div id=reader_patrag style="color:blue; font-style:italic">CA16002931</div>'}, 'Switch Patrag', 'RFIDPATRAG \n IP: 10.10.25.49  \n CA16002931 \n MAC Addres: 00:1B:5F:00:FD:23 \n Modelo: Alien ALR-F800'],


        ]);
       
    // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,'allowCollapse':false,size:'medium'});
      }

    
    
    
   </script>



</head>


  <body >
    <input type="submit" class="BotaoMenu" name="btnVoltar" value="voltar" onclick="javascript: location.href='menu.php';" />
    
    <label id="lb_total_links">Total de Dispositivos :</label>
    
    <input id="btn_links_offline" type="buttom" name="" value=""/>
    <label id="lb_links_offline">Links Offline :</label>
    
    <input id="btn_links_online" type="buttom" name="" value=""/>
    <label id="lb_links_online">Links Online :</label>
    
    <input id="btn_links_bat" type="buttom" name="" value=""/>
    <label id="lb_links_bat">Links Alimentados por Bateria :</label>
    
    
    <div id="chart_div" class="container"></div>
    



<script>

setTimeout(carregar_dispositivos,2000); // assim que iniciar chama atualização apos 2 segundos

function teste(){
   // var MQTT_PHP = window.document.getElementById('MQTT_PHP');
   // MQTT_PHP.style.backgroundColor='#FF6347'; // cor offline #FF6347 e para online #32CD32
   // MQTT_PHP.style.color='black';
    alert('a');
}

var total_links;
var links_offline;
var links_online;
var links_bat;


function carregar_dispositivos()
{   
 total_links = 0;
 links_offline = 0;
 links_online = 0;
 links_bat = 0;


   <?php
   include_once 'conexao3.php';
   $sql = $dbcon->query("SELECT * FROM tbl_ping");
   if(mysqli_num_rows($sql)>0)
   {



    while($dados = $sql->fetch_array())
    {
     $dispositivo = $dados['dispositivo'];
     $titulo_supervisorio = $dados['titulo_supervisorio'];
     $subtitulo_supervisorio = $dados['subtitulo_supervisorio'];
     $ip = $dados['ip'];
     $condicao = $dados['condicao'];
     $descricao = $dados['descricao'];
     $modo_alimentacao = $dados['modo_alimentacao'];
     $data = $dados['data'];
     $hora = $dados['hora'];
    
     // Descarrega os dados
     ?>
      var dispositivo = "<?php print $dispositivo ?>"
      var titulo_supervisorio = "<?php print $titulo_supervisorio ?>"
      var subtitulo_supervisorio = "<?php print $subtitulo_supervisorio ?>"
      var ip = "<?php print $ip ?>"
      var condicao = "<?php print $condicao ?>"
      var descricao = "<?php print $descricao ?>"
      var data = "<?php print $data ?>"
      var hora = "<?php print $hora ?>"
      var modo_alimentacao = "<?php print $modo_alimentacao ?>"

    // CONDICAO
    var lbcondicao = document.getElementById(dispositivo) //Linca com o ID e sabe qual dispositivo deve ser atualizado
    total_links = total_links + 1;
    if (condicao == "OK")
    {
     if(modo_alimentacao == "BAT") // SE O LINK ESTIVER ONLINE E ALIMENTADO POR BATERIA
     {
      links_bat = links_bat + 1; 
      //lbcondicao.innerHTML = condicao;
      lbcondicao.style.backgroundColor='	#FFD700'; // cor offline #FF6347 , online por BAT 	#FFD700 e para online #32CD32
      lbcondicao.style.color='#000000';
      lbcondicao.innerHTML = lbcondicao.innerHTML + "\n<h3>Online!</h3></b>" + "\n Alimentado por <b>Bateria!</b></br>"+ data + "</br>" + hora;
      lbcondicao.style.font='italic 9pt verdana';
     }
     else // SE O LINK ESTIVER ONLINE E ALIMENTADO POR AC OU SEM ESPECIFICAR
     {
      links_online = links_online + 1; 
      //lbcondicao.innerHTML = condicao;
      lbcondicao.style.backgroundColor='#40E0D0'; // cor offline #FF6347 e para online #32CD32
      lbcondicao.style.color='#000000';
      if(data == "" && hora == "")
      {
        lbcondicao.innerHTML = lbcondicao.innerHTML + "\n<h3>Online!</h3></b>";
      }else{
        lbcondicao.innerHTML = lbcondicao.innerHTML + "\n<h3>Online!</h3></b>"+ data + "</br>" + hora;
      }
      
      lbcondicao.style.font='italic 9pt verdana';

     }
      


    }else if (condicao == "Erro") // SE O LINK ESTIVER FORA
    {
     links_offline = links_offline + 1;  
    //lbcondicao.innerHTML = condicao;
    lbcondicao.style.backgroundColor='#FF6347'; // cor offline #FF6347 e para online #32CD32
    lbcondicao.style.color='#000000';
    lbcondicao.innerHTML = lbcondicao.innerHTML + "\n<h3>Offline!</h3></b>" + data + "</br>" + hora;
    lbcondicao.style.font='italic 9pt verdana';
    }




    else
    {    // NEM USA, APENAS PARA EVITAR POSSIVEIS ERROS CASO ESTEJA VAZIO
    //lbcondicao.innerHTML = "";
    lbcondicao.style.backgroundColor='#A9A9A9'; // cor offline #FF6347 e para online #32CD32
    }
    
    <?php
   } // fecha while
   // Descarrega os dados
   
   } // fecha o if
   ?>
    
    //atualiza os dados nas labels
    var lb_total_links = document.getElementById('lb_total_links')
    lb_total_links.innerHTML = "<b>Total de Dispositivos : </b>"+total_links;
 
    var lb_links_offline = document.getElementById('lb_links_offline')
    lb_links_offline.innerHTML = "<b>Links Offline : </b>"+ links_offline;

    var lb_links_online = document.getElementById('lb_links_online')
    lb_links_online.innerHTML = "<b>Links Online : </b>"+ links_online;

    var lb_links_bat = document.getElementById('lb_links_bat')
    lb_links_bat.innerHTML = "<b>Links Alimentados por Bateria : </b>"+ links_bat;

    
    //console.log(data.wg[0].c[0].v); // Pega o Titulo
    //console.log(data.wg[10].c[1].v); // Pega o Subtitulo
    //console.log(data.wg[10].c[2].v); // Pega a Informação
    //data.wg[10].c[0].v = "bruno";
    //data.addRows(data.wg[10].c[0].v);
    //drawChart()
    //lbtitulo_mqtt_php.wg[10].c[2].v.innerHTML="Bruno";
   // mysqli_close($dbcon); //fecha a conexao com o banco
}












var minutos = 1; // tempo para atualizar a pagina
setTimeout("location.reload(true);",(60000* minutos));
</script>




<script type="text/javascript">
$(window).load(function()
{
 $(document).mousemove(function(e) 
 {
  $("html, body").scrollTop(function(i, v) 
  {
   //var h = $(window).height();
  // var y = e.clientY - h / 2;
  // return v + y * 0.1;
  });
 });
});
</script>



<style>
body{
  background-color: rgba(0,0,139,.1);

}
INPUT.BotaoMenu {
     width: 140px;
     height: 26px;
     font-weight: bold
     font-family: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer
}

Label#lb_total_links{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 160px;
    top: 11px;
}
Label#lb_links_offline{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 380px;
    top: 11px;
}
Label#lb_links_online{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 540px;
    top: 11px;
}
Label#lb_links_bat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 710px;
    top: 11px;
}


input#btn_links_offline{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: #FF6347;/* vermelho */ 
    left: 350px;
    top: 10px;
    width:15px;
    height:15px;
    padding-left: 5px;
}
input#btn_links_online{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: #32CD32;/* verde */ 
    left: 510px;
    top: 10px;
    width:15px;
    height:15px;
    padding-left: 5px;
}
input#btn_links_bat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: #FFD700;/* amarelo */ 
    left: 680px;
    top: 10px;
    width:15px;
    height:15px;
    padding-left: 5px;
}

#chart_div{
  margin-left: 20px;
  margin-right: 20px;
  margin-bottom: 50px;
  position: absolute;
  top: 50px;

}




</style>




  </body>
</html>

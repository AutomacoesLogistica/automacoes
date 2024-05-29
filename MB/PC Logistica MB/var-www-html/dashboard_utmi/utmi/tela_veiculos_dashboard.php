<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
    <title>Tela Resumo Motoristas</title>
</head>
<body>


<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_utmi.php?vezes=0'"/>

<?php

$permite_echo = "0"; // Em 1 para debugar e em 0 corta os echos

$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
if($tempo == '-1'){$tempo = 30000;}
if($nvezes == '-1'){$nvezes = 5;}
if($vezes != '-1'){$vezes = intval($vezes)+1;}

if($vezes == -1){}else{$vezes = intval($vezes)+1;}



date_default_timezone_set('America/Sao_Paulo');
$data1 = date('d/m/Y');
$data = isset($_GET['data'])?$_GET['data']:$data1;
$hora = date('H:i:s');
$vdata = explode('/',$data);
$dia = intval($vdata[0]);
$mes = intval($vdata[1]);
$ano = intval($vdata[2]);
$numero_tabela = 0;
$pesquisa_mes = 'mes_'.intval($mes); //exemplo mes_8
$pesquisa_ano = '2024';


if($valor_do_mes == '')
{
 //Busco a hora atual
 $mensagem = explode('/',$data);
 $mes = $mensagem[1];
}
else
{
 $mes = $valor_do_mes;  
}

//Converte o dado do mes passado ou adquirido pela data atual e converte no nome do mes
if($mes == '1'){$nome_mes = 'Janeiro';$v_mes = "/01/";}
else if($mes == '2'){$nome_mes = 'Fevereiro';$v_mes = "/02/";}
else if($mes == '3'){$nome_mes = 'Março';$v_mes = "/03/";}
else if($mes == '4'){$nome_mes = 'Abril';$v_mes = "/04/";}
else if($mes == '5'){$nome_mes = 'Maio';$v_mes = "/05/";}
else if($mes == '6'){$nome_mes = 'Junho';$v_mes = "/06/";}
else if($mes == '7'){$nome_mes = 'Julho';$v_mes = "/07/";}
else if($mes == '8'){$nome_mes = 'Agosto';$v_mes = "/08/";}
else if($mes == '9'){$nome_mes = 'Setembro';$v_mes = "/09/";}
else if($mes == '10'){$nome_mes = 'Outubro';$v_mes = "/10/";}
else if($mes == '11'){$nome_mes = 'Novembro';$v_mes = "/11/";}
else{$nome_mes = 'Dezembro';$v_mes = "/12/";}
//************************************************************************************


$pesquisa_dia = $data;
$tabela = 'veiculos_dashboard_' . $pesquisa_ano;

//echo $tabela;
//echo "</BR>";
//echo $pesquisa_dia;
//echo $tabela;


// BUSCO OS DADOS PARA O DIA ************************************************

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE data = '$pesquisa_dia' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $v0 = $dados["v0"];
 $v1 = $dados["v1"];
 $v2 = $dados["v2"];
 $v3 = $dados["v3"];
 $v4 = $dados["v4"];
 $v5 = $dados["v5"];
 $v6 = $dados["v6"];
 $v7 = $dados["v7"];
 $v8 = $dados["v8"];
 $v9 = $dados["v9"];
 $v10 = $dados["v10"];
 $v11 = $dados["v11"];
 $v12 = $dados["v12"];
 $v13 = $dados["v13"];
 $v14 = $dados["v14"];
 $v15 = $dados["v15"];
 $v16 = $dados["v16"];
 $v17 = $dados["v17"];
 $v18 = $dados["v18"];
 $v19 = $dados["v19"];
 $v20 = $dados["v20"];
 $v21 = $dados["v21"];
 $v22 = $dados["v22"];
 $v23 = $dados["v23"];

}
$total_turno1 = intval($v0)+intval($v1)+intval($v2)+intval($v3)+intval($v4)+intval($v5)+intval($v6)+intval($v7);
$total_turno2 = intval($v8)+intval($v9)+intval($v10)+intval($v11)+intval($v12)+intval($v13)+intval($v14)+intval($v15)+intval($v16);
$total_turno3 = intval($v17)+intval($v18)+intval($v19)+intval($v20)+intval($v21)+intval($v22)+intval($v23);
$total = intval($total_turno1) + intval($total_turno2) + intval($total_turno3); 

//PESQUISO AGORA PARA O MES ************************************************************************************************************


include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE data like '%$v_mes%'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $encontrados = intval($encontrados) + 1;
  $m_v0 = $dados["v0"];
  $m_v1 = $dados["v1"];
  $m_v2 = $dados["v2"];
  $m_v3 = $dados["v3"];
  $m_v4 = $dados["v4"];
  $m_v5 = $dados["v5"];
  $m_v6 = $dados["v6"];
  $m_v7 = $dados["v7"];
  $m_v8 = $dados["v8"];
  $m_v9 = $dados["v9"];
  $m_v10 = $dados["v10"];
  $m_v11 = $dados["v11"];
  $m_v12 = $dados["v12"];
  $m_v13 = $dados["v13"];
  $m_v14 = $dados["v14"];
  $m_v15 = $dados["v15"];
  $m_v16 = $dados["v16"];
  $m_v17 = $dados["v17"];
  $m_v18 = $dados["v18"];
  $m_v19 = $dados["v19"];
  $m_v20 = $dados["v20"];
  $m_v21 = $dados["v21"];
  $m_v22 = $dados["v22"];
  $m_v23 = $dados["v23"];
  
  $m_2v0 = intval($m_2v0) + intval($m_v0); 
  $m_2v1 = intval($m_2v1) + intval($m_v1);
  $m_2v2 = intval($m_2v2) + intval($m_v2);
  $m_2v3 = intval($m_2v7) + intval($m_v3);
  $m_2v4 = intval($m_2v4) + intval($m_v4);
  $m_2v5 = intval($m_2v5) + intval($m_v5);
  $m_2v6 = intval($m_2v6) + intval($m_v6);
  $m_2v7 = intval($m_2v7) + intval($m_v7);
  $m_2v8 = intval($m_2v8) + intval($m_v8);
  $m_2v9 = intval($m_2v9) + intval($m_v9);
  $m_2v10 = intval($m_2v10) + intval($m_v10);
  $m_2v11 = intval($m_2v11) + intval($m_v11);
  $m_2v12 = intval($m_2v12) + intval($m_v12);
  $m_2v13 = intval($m_2v13) + intval($m_v13);
  $m_2v14 = intval($m_2v14) + intval($m_v14);
  $m_2v15 = intval($m_2v15) + intval($m_v15);
  $m_2v16 = intval($m_2v16) + intval($m_v16);
  $m_2v17 = intval($m_2v17) + intval($m_v17);
  $m_2v18 = intval($m_2v18) + intval($m_v18);
  $m_2v19 = intval($m_2v19) + intval($m_v19);
  $m_2v20 = intval($m_2v20) + intval($m_v20);
  $m_2v21 = intval($m_2v21) + intval($m_v21);
  $m_2v22 = intval($m_2v22) + intval($m_v22);
  $m_2v23 = intval($m_2v23) + intval($m_v23);
 }
}
 $m_total_turno1 = intval($m_2v0)+intval($m_2v1)+intval($m_2v2)+intval($m_2v3)+intval($m_2v4)+intval($m_2v5)+intval($m_2v6)+intval($m_2v7) ;
 $m_total_turno2 = intval($m_2v8)+intval($m_2v9)+intval($m_2v10)+intval($m_2v11)+intval($m_2v12)+intval($m_2v13)+intval($m_2v14)+intval($m_2v15)+intval($m_2v16);
 $m_total_turno3 = intval($m_2v17)+intval($m_2v18)+intval($m_2v19)+intval($m_2v20)+intval($m_2v21)+intval($m_2v22)+intval($m_2v23);
 $m_total = intval($m_total_turno1) + intval($m_total_turno2) + intval($m_total_turno3); 

?>


<script>
  console.log(<?php print $encontrados ?>);
  </script>

<script type="text/javascript">
  
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Horario", "Numero Viajens",{ role: "style" }],
        ['00', <?php print $v0 ?>, "#00008B" ],
        ['01', <?php print $v1 ?>, "#00008B"],
        ['02', <?php print $v2 ?>, "#00008B"],
        ['03', <?php print $v3 ?>, "#00008B"],
        ['04', <?php print $v4 ?>, "#00008B"],
        ['05', <?php print $v5 ?>, "#00008B"],
        ['06', <?php print $v6 ?>, "#00008B"],
        ['07', <?php print $v7 ?>, "#00008B"],
        ['08', <?php print $v8 ?>, "#00008B"],
        ['09', <?php print $v9 ?>, "#00008B"],
        ['10', <?php print $v10 ?>, "#00008B"],
        ['11', <?php print $v11 ?>, "#00008B"],
        ['12', <?php print $v12 ?>, "#00008B"],
        ['13', <?php print $v13 ?>, "#00008B"],
        ['14', <?php print $v14 ?>, "#00008B"],
        ['15', <?php print $v15 ?>, "#00008B"],
        ['16', <?php print $v16 ?>, "#00008B"],
        ['17', <?php print $v17 ?>, "#00008B"],
        ['18', <?php print $v18 ?>, "#00008B"],
        ['19', <?php print $v19 ?>, "#00008B"],
        ['20', <?php print $v20 ?>, "#00008B"],
        ['21', <?php print $v21 ?>, "#00008B"],
        ['22', <?php print $v22 ?>, "#00008B"],
        ['23', <?php print $v23 ?>, "#00008B"]
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '92%', 'height': '50%'},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
         textStyle: 
         {
          textPosition: 'none', 
          fontSize: 10,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "80%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos"));
      chart.draw(view, options);
  }

</script>



<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Horario", "Numero Viajens",{ role: "style" }],
        ['00', <?php print $m_2v0 ?>, "#00008B" ],
        ['01', <?php print $m_2v1 ?>, "#00008B"],
        ['02', <?php print $m_2v2 ?>, "#00008B"],
        ['03', <?php print $m_2v3 ?>, "#00008B"],
        ['04', <?php print $m_2v4 ?>, "#00008B"],
        ['05', <?php print $m_2v5 ?>, "#00008B"],
        ['06', <?php print $m_2v6 ?>, "#00008B"],
        ['07', <?php print $m_2v7 ?>, "#00008B"],
        ['08', <?php print $m_2v8 ?>, "#00008B"],
        ['09', <?php print $m_2v9 ?>, "#00008B"],
        ['10', <?php print $m_2v10 ?>, "#00008B"],
        ['11', <?php print $m_2v11 ?>, "#00008B"],
        ['12', <?php print $m_2v12 ?>, "#00008B"],
        ['13', <?php print $m_2v13 ?>, "#00008B"],
        ['14', <?php print $m_2v14 ?>, "#00008B"],
        ['15', <?php print $m_2v15 ?>, "#00008B"],
        ['16', <?php print $m_2v16 ?>, "#00008B"],
        ['17', <?php print $m_2v17 ?>, "#00008B"],
        ['18', <?php print $m_2v18 ?>, "#00008B"],
        ['19', <?php print $m_2v19 ?>, "#00008B"],
        ['20', <?php print $m_2v20 ?>, "#00008B"],
        ['21', <?php print $m_2v21 ?>, "#00008B"],
        ['22', <?php print $m_2v22 ?>, "#00008B"],
        ['23', <?php print $m_2v23 ?>, "#00008B"]
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '92%', 'height': '50%'},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
         textStyle: 
         {
          textPosition: 'none', 
          fontSize: 10,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "80%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);
  }

</script>



<div id="grafico_encerramentos" >


</div> 

    
<div id="grafico_encerramentos2" ></div> 



<label id='titulo1' name='titulo1' >Dados veículos Miguel Burnier referente ao dia <?php print $data ?></label>
<label id='titulo5' name='titulo5' >Dados veículos Miguel Burnier referente ao mês de <?php print $nome_mes ?></label>

<label id='titulo1_1' name='titulo1_1' >Dados atualizados às <?php print $hora ?> - Leitura PIRES</label>
<label id='titulo2' name='titulo2'>Total de veículos </label>
<label id='titulo2m' name='titulo2m'>Total de veículos </label>
<label id='v_turno1' name='v_turno1'>1° turno: <?php print $total_turno1 ?></label>
<label id='v_turno2' name='v_turno2'>2° turno: <?php print $total_turno2 ?></label>
<label id='v_turno3' name='v_turno3'>3° turno: <?php print $total_turno3 ?></label>
<label id='v_total' name='v_total'>Veículos no dia: <?php print $total ?></label>

<label id='v_turno1m' name='v_turno1m'>1° turno: <?php print $m_total_turno1 ?></label>
<label id='v_turno2m' name='v_turno2m'>2° turno: <?php print $m_total_turno2 ?></label>
<label id='v_turno3m' name='v_turno3m'>3° turno: <?php print $m_total_turno3 ?></label>
<label id='v_totalm' name='v_totalm'>Veículos no mês: <?php print $m_total ?></label>

<label id='titulo3' name='titulo3'  hidden='hidden'>Transportadoras/Mês</label>
</body>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<h3 id="lb_marcacao">Definir PIRES? </h3>

<input id="btn_pires" name="btn_pires"  type="button" value="Habilitar"  onclick="valida_botao();"/>



<div id="mensagens_pires">
<label id='vtitulo' name='vtitulo' >Defina a mensagem para a tela do pires</label>
<label id="mensagem">Marcação sendo realizada nos controles da UTMI!</label>
<label id="valor_tela" hidden='hidden'></label>
<input id="btn_salvar" name="btn_salvar"  type="button" value="Salvar"  onclick="botao_salvar();"/>
<img id="cima" src="./images/cima.png"  onclick="clicou_cima();"/>
<img id="baixo" src="./images/baixo.png"  onclick="clicou_baixo();"/>
</div> 


<script>
document.getElementById('mensagens_pires').style.display='none';
var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';
valor_tela = 1;


function botao_salvar()
{
 msg_recebida = document.getElementById('mensagem').innerHTML;
 valor_tela = document.getElementById('valor_tela').innerHTML; 
 $.ajax({
           url: 'atualiza_mensagem_pires.php',
           type: 'GET',
           dataType: 'text',
           data: {'mensagem': msg_recebida ,'id_mensagem': valor_tela},
           timeout: 8000,
           success: function(resultado)
           {
            if(resultado == "OK")
            {
             document.getElementById('mensagens_pires').style.display='none'; 
            }
            else
            {
              document.getElementById('mensagens_pires').style.display='none'; 
              alert("Ocorreu algum erro, tente novamente!\n\nCaso o erro persista, acionar o Bruno Gonçalves!");
            }
           }
          });
  
  document.getElementById('voltar').style.display='block';
  document.getElementById('grafico_encerramentos').style.display='block';
  document.getElementById('grafico_encerramentos2').style.display='block';
  document.getElementById('titulo5').style.display='block';
  document.getElementById('titulo2m').style.display='block';
  document.getElementById('v_turno1m').style.display='block';
  document.getElementById('v_turno2m').style.display='block';
  document.getElementById('v_turno3m').style.display='block';
  document.getElementById('v_totalm').style.display='block';

}

function clicou_baixo()
{
 $.ajax({
           url: 'busca_mensagem.php',
           type: 'GET',
           dataType: 'text',
           data: {'condicao':'baixo','valor': valor_tela},
           timeout: 8000,
           success: function(resultado)
           {
            const myArray = resultado.split(";");
            msg_recebida = myArray[0];
            condicao = myArray[1];
            valor_tela = parseInt(myArray[2]);
            limite_id =  parseInt(myArray[3]);
            
            if(msg_recebida == "Limite superior!")
            {

            }
            else if (limite_id == valor_tela)
            {
             console.log("Oculta o botao baixo!");
             //Tenho que esconder o botao mais
             document.getElementById('baixo').style.display='none';
             document.getElementById('cima').style.display='block';
             console.log("Mensagem = " + msg_recebida);
             console.log("Condicao = "+ condicao);
             console.log("Valor atual da tela = "+ valor_tela);
             console.log("Limite ID = "+ limite_id);
             //Atualizo a mensagem o display da tela
             document.getElementById('mensagem').innerHTML = msg_recebida;
             document.getElementById('valor_tela').innerHTML = valor_tela;
            }
            else
            {
             //Deixo o botao baixo aparecendo
             document.getElementById('cima').style.display='block'; 
             document.getElementById('baixo').style.display='block'; 
             console.log("Mensagem = " + msg_recebida);
             console.log("Condicao = "+ condicao);
             console.log("Valor atual da tela = "+ valor_tela);
             console.log("Limite ID = "+ limite_id);
             //Atualizo a mensagem o display da tela
             document.getElementById('mensagem').innerHTML = msg_recebida;
             document.getElementById('valor_tela').innerHTML = valor_tela;
            }
           }
           
       });

}


function clicou_cima()
{
 $.ajax({
           url: 'busca_mensagem.php',
           type: 'GET',
           dataType: 'text',
           data: {'condicao':'cima','valor': valor_tela},
           timeout: 8000,
           success: function(resultado)
           {
            const myArray = resultado.split(";");
            msg_recebida = myArray[0];
            condicao = myArray[1];
            valor_tela = parseInt(myArray[2]);
            limite_id =  parseInt(myArray[3]);

            if (valor_tela == 1)
            {
             console.log("Oculta o botao cima!");
             //Tenho que esconder o botao mais
             document.getElementById('baixo').style.display='block';
             document.getElementById('cima').style.display='none';
             console.log("Mensagem = " + msg_recebida);
             console.log("Condicao = "+ condicao);
             console.log("Valor atual da tela = "+ valor_tela);
             console.log("Limite ID = "+ limite_id);
             //Atualizo a mensagem o display da tela
             document.getElementById('mensagem').innerHTML = msg_recebida;
             document.getElementById('valor_tela').innerHTML = valor_tela;
            }
            else
            {
             //Deixo o botao cima aparecendo
             document.getElementById('cima').style.display='block'; 
             document.getElementById('baixo').style.display='block'; 
             console.log("Mensagem = " + msg_recebida);
             console.log("Condicao = "+ condicao);
             console.log("Valor atual da tela = "+ valor_tela);
             console.log("Limite ID = "+ limite_id);
             //Atualizo a mensagem o display da tela
             document.getElementById('mensagem').innerHTML = msg_recebida;
             document.getElementById('valor_tela').innerHTML = valor_tela;
            }
           }
           
       });

}
//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
 //location.href='./dashboard_utmi.php?vezes=0';//Por default passo 2 vezes apenas

 window.setTimeout( "location.href=`./dashboard_excesso_mb.php?vezes=0&nvezes=3&tempo=30000`");
}
else
{
 if(link_vezes != '-1')
 {
   window.setTimeout( "location.href=`./tela_veiculos_dashboard.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}





function valida_botao()
{
  
  
  
  
  //alert("clicou");
  var porta = 8026;
  var ip = "138.0.77.80";
  var ip_completo = (ip + ":" + porta).toString();
  //passo via ajax para realizar o ajuste
  $.ajax({
  url: 'script_marcacao_pires.php',
  type: 'GET',
  dataType: 'html',
  data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
  success: function(resultado)
  {
   if(resultado.includes("Foi habilitado")==true)
   {
    alert("Ativado a marcação no pires com sucesso!");
    document.getElementById('btn_pires').value = "Desabilitar";
    document.getElementById('btn_pires').style.backgroundColor='#FF6347';
    document.getElementById('mensagens_pires').style.display='none';
    document.getElementById('voltar').style.display='block';
    document.getElementById('grafico_encerramentos').style.display='block';
    document.getElementById('grafico_encerramentos2').style.display='block';
    document.getElementById('titulo5').style.display='block';
    document.getElementById('titulo2m').style.display='block';
    document.getElementById('v_turno1m').style.display='block';
    document.getElementById('v_turno2m').style.display='block';
    document.getElementById('v_turno3m').style.display='block';
    document.getElementById('v_totalm').style.display='block';

   }
   else if(resultado.includes("Foi desabilitado")==true)
   {
    alert("Desativado a marcação no pires com sucesso!");
    document.getElementById('btn_pires').value = "Habilitar";
    document.getElementById('btn_pires').style.backgroundColor='#29A1AB';
    document.getElementById('mensagens_pires').style.display='block';
    document.getElementById('voltar').style.display='none';
    document.getElementById('grafico_encerramentos').style.display='none';
    document.getElementById('grafico_encerramentos2').style.display='none';
    document.getElementById('titulo5').style.display='none';
    document.getElementById('titulo2m').style.display='none';
    document.getElementById('v_turno1m').style.display='none';
    document.getElementById('v_turno2m').style.display='none';
    document.getElementById('v_turno3m').style.display='none';
    document.getElementById('v_totalm').style.display='none';


   }
   else
   {
    //alert(resultado);
    alert("Não foi possível realizar o ajuste, tente novamente!\n\nCaso persista o erro acionar o Bruno!");
   }
  }
  });
 
}

//Verifica condicao do pires
var porta = 8026;
var ip = "138.0.77.80";
var ip_completo = (ip + ":" + porta).toString();
//passo via ajax para realizar o ajuste
  $.ajax({
  url: 'script_verifica_marcacao_pires.php',
  type: 'GET',
  dataType: 'html',
  data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
  success: function(resultado)
  {
    if(resultado.includes("HABILITADA")==true)
    {
      console.log("Esta ativado a marcacao no pires!");
      document.getElementById('btn_pires').value = "Desabilitar";
      document.getElementById('btn_pires').style.backgroundColor='#FF6347';
    }
    else if(resultado.includes("BLOQUEADO")==true)
    {
      console.log("Esta desativado a marcacao no pires!");
      document.getElementById('btn_pires').value = "Habilitar";
      document.getElementById('btn_pires').style.backgroundColor='#29A1AB';
    }
    else
    {
      console.log(resultado);
    }
  }
  });
</script>


<style>

LABEL#mensagem{
    position: absolute;
    text-align:center;
    font: bold 26pt verdana;
    color: #B22222;
    left: 7%;
    top: 30%;
    padding-top: 20px;
    padding-bottom: 0px;
    width:70%;
    height:28%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 4px #B22222 solid!important;
}


#lb_marcacao{
    margin-left: 0px;
    position: absolute;
    left: 86.5%;
    top: 2.5%;
    font: bold 12pt verdana;
    
}


INPUT#btn_salvar
{
    width: 200px;
    height: 40px;
    background-color: rgb(0,200,20);
    color: #000000;
    margin-left: 0px;
    position: absolute;
    font: normal 16pt verdana;
    left:72%;
    top: 78%;
    padding-left: 5px;
    
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_salvar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}





INPUT#btn_pires
{
    width: 150px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:86%;
    top: 8%;
    padding-left: 5px;
    
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_pires:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ttp_pires:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
    font: normal 12pt verdana;
    color: rgba(0,0,0,0.7);
}

LABEL#vtitulo
{
  position: absolute;
  left: 29%;
  top: 5%;
  font: bold 20pt verdana;
  color:	#000000;
}
LABEL#titulo1
{
  position: absolute;
  left: 29%;
  top: 5%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#titulo5
{
  position: absolute;
  left: 29%;
  top: 53%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#titulo11
{
  position: absolute;
  left: 34%;
  top: 50%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#titulo1_1
{
  position: absolute;
  left: 38%;
  top: 8.3%;
  font: bold 14pt verdana;
  color:	#00008B;
}
LABEL#titulo2
{
  position: absolute;
  left: 8%;
  top: 13.8%;
  font: bold 14pt verdana;
  color:	#00008B;
}
LABEL#v_turno1
{
  position: absolute;
  left: 25%;
  top: 14%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#v_turno2
{
  position: absolute;
  left: 42%;
  top: 14%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#v_turno3
{
  position: absolute;
  left: 58%;
  top: 14%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#v_total
{
  position: absolute;
  left: 74%;
  top: 14%;
  font: bold 12pt verdana;
  color:	#000000;
}



LABEL#titulo2m
{
  position: absolute;
  left: 8%;
  top: 58.8%;
  font: bold 14pt verdana;
  color:	#00008B;
}
LABEL#v_turno1m
{
  position: absolute;
  left: 25%;
  top: 59%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#v_turno2m
{
  position: absolute;
  left: 42%;
  top: 59%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#v_turno3m
{
  position: absolute;
  left: 58%;
  top: 59%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#v_totalm
{
  position: absolute;
  left: 74%;
  top: 59%;
  font: bold 12pt verdana;
  color:	#000000;
}











LABEL#titulo3
{
  position: absolute;
  left: 75%;
  top: 53%;
  font: bold 16pt verdana;
  color:	#000000;
}


DIV#grafico_encerramentos{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 95%;
    height: 41%;
    padding-top: 3%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #FFFFFF;

}
DIV#grafico_encerramentos2{
    padding-left: 0px;
    position: absolute;
    left: 3%;
    top: 51%;
    width: 95%;
    height: 41%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;
    

}

DIV#mensagens_pires{
    position: absolute;
    padding-top:20px;
    padding-left: 20px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 93.8%;
    height: 42%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;
    

}
IMG#rank1{
    margin-left: 0px;
    position: absolute;
    left: 11%;
    top: 3%;
    width: 160px;
    height: 90px;
    transform: rotate(-4deg);
    cursor: pointer;

}
IMG#rank2{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 3%;
    width: 180px;
    height: 80px;
    cursor: pointer;

}

IMG#rank1_1{
    margin-left: 0px;
    position: absolute;
    left: 11%;
    top: 53%;
    width: 100px;
    height: 30px;
    transform: rotate(-4deg);
    cursor: pointer;

}
IMG#rank2_1{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 53%;
    width: 180px;
    height: 80px;
    cursor: pointer;

}


IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 5px;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
IMG#cima{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 31%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}
IMG#baixo{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 51%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}
body{

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}


</style>
</html>
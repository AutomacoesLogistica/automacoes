<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="refresh" content="10000"><!-- atualiza a pagina automaticamente em segundos -->
<script type="text/javascript" src="./charts_colunamix.js"></script>
<script type="text/javascript" src="./charts_pizza.js"></script>
    
  
   
<?php


$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
if($tempo == '-1'){$tempo = 30000;}
if($nvezes == '-1'){$nvezes = 5;}
if($vezes != '-1'){$vezes = intval($vezes)+1;}



if($vezes == -1)
{

}
else
{
 $vezes = intval($vezes)+1;   
}


?>






<script type="text/javascript">
  var data_atual = ""; // Inicia Vazio
  var $dia1 = "";
  var $dia2 = "";
  var $dia3 = "";
  var $dia4 = "";
  var $dia5 = "";
  var $dia6 = "";
  var $dia7 = "";
  var $dia8 = "";
  var $dia9 = "";
  var $dia10 = "";
  var $dia11 = "";
  var $dia12 = "";
  var $dia13 = "";
  var $dia14 = "";
  var $dia15 = "";
  var $dia16 = "";
  var $dia17 = "";
  var $dia18 = "";
  var $dia19 = "";
  var $dia20 = "";
  var $dia21 = "";
  var $dia22 = "";
  var $dia23 = "";
  var $dia24 = "";
  var $dia25 = "";
  var $dia26 = "";
  var $dia27 = "";
  var $dia28 = "";
  var $dia29 = "";
  var $dia30 = "";
  var $dia31 = "";

  var array_turnoA = [];
  var array_turnoB = [];
  var array_turnoC = [];
  var array_turnoD = [];
  var array_quantidade_hora = [];
  var quantidade_total = 0;
  var array_transportadora = [];
  var array_quantidade = [];
  
  for (i=0;i<20;i++)
  {
    array_transportadora[i]=0;
    array_quantidade[i] = 0;
  }


  for (i=0;i<24;i++)
  {
   array_quantidade_hora[i]=0;
  }


  var dia = ""; // Inicia Vazio
  var mes = ""; // Inicia Vazio
  var ano = ""; // Inicia Vazio

  var hora = ""; // Inicia Vazio
  var hora_atual = ""; // Inicia Vazio
  var turno = ""; // Inicia Vazio
  var turno_atual = ""; // Inicia Vazio
  var valor_turno = ""; // Inicia Vazio
  var i;
  var quantidadeA = 0;
  var quantidadeB = 0;
  var quantidadeC = 0;
  var quantidadeD = 0;
  

  var sigla = "";
 

  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
    
   

  function drawChart() 
  {
  <?php
  include_once 'conexao.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  //$hora = '16:00:00';
  $resultado = intval(substr($hora,0,2));    
  if($resultado >= 0 AND $resultado < 8) // Pertence ao primeiro turno
  {
   $valor_turno = "turno1"; // Busca na coluna 3 que equivale ao primeiro turno
  }
  else if($resultado > 7 AND $resultado < 17) // Pertence ao segundo turno
  {
   $valor_turno = "turno2"; // Busca na coluna 4 que equivale ao segundo turno
  }
  else
  {
   $valor_turno = "turno3"; // Busca na coluna 5 que equivale ao terceiro turno
  }
  $sq6 = $dbcon->query("SELECT * FROM lista_turno WHERE data='$data'");
  if(mysqli_num_rows($sq6)>0)
  {
   while($dados = $sq6->fetch_array())
   {
     // Achou a data agora salva a o turno
     if($valor_turno == "turno1")
     {
      $turno2 = $dados['turno1']; // Busca a letra do turno
     }
     elseif($valor_turno == "turno2")
     {
      $turno2 = $dados['turno2']; // Busca a letra do turno
     }
     else
     {
      $turno2 = $dados['turno3']; // Busca a letra do turno
     }
     
 } 
}
else
{
    // Não encontrou a data no sistema
} 


  
  
  $sigla = "";
  
  $mes = (substr($data,3,2)); // extrai o mes atual
  $ano = (substr($data,6,4)); // extrai o ano atual
    
  $hora_atual = intval(substr($hora,0,2)); // extrai a hora atual para identificar qual turno estamos 


  $dia1 = "01/".$mes."/".$ano;
  $dia2 = "02/".$mes."/".$ano;
  $dia3 = "03/".$mes."/".$ano;
  $dia4 = "04/".$mes."/".$ano;
  $dia5 = "05/".$mes."/".$ano;
  $dia6 = "06/".$mes."/".$ano;
  $dia7 = "07/".$mes."/".$ano;
  $dia8 = "08/".$mes."/".$ano;
  $dia9 = "09/".$mes."/".$ano;
  $dia10 = "10/".$mes."/".$ano;
  $dia11 = "11/".$mes."/".$ano;
  $dia12 = "12/".$mes."/".$ano;
  $dia13 = "13/".$mes."/".$ano;
  $dia14 = "14/".$mes."/".$ano;
  $dia15 = "15/".$mes."/".$ano;
  $dia16 = "16/".$mes."/".$ano;
  $dia17 = "17/".$mes."/".$ano;
  $dia18 = "18/".$mes."/".$ano;
  $dia19 = "19/".$mes."/".$ano;
  $dia20 = "20/".$mes."/".$ano;
  $dia21 = "21/".$mes."/".$ano;
  $dia22 = "22/".$mes."/".$ano;
  $dia23 = "23/".$mes."/".$ano;
  $dia24 = "24/".$mes."/".$ano;
  $dia25 = "25/".$mes."/".$ano;
  $dia26 = "26/".$mes."/".$ano;
  $dia27 = "27/".$mes."/".$ano;
  $dia28 = "28/".$mes."/".$ano;
  $dia29 = "29/".$mes."/".$ano;
  $dia30 = "30/".$mes."/".$ano;
  $dia31 = "31/".$mes."/".$ano;

  ?>
  turno_atual = "<?php print $turno2 ?>"
  mes = "<?php print $mes ?>"
  ano = "<?php print $ano ?>"
  hora_atual = "<?php print $hora_atual ?>"
  data_atual = "<?php print $data ?>"
  $dia1 ="<?php print $dia1 ?>"
  $dia2 ="<?php print $dia2 ?>"
  $dia3 ="<?php print $dia3 ?>"
  $dia4 ="<?php print $dia4 ?>"
  $dia5 ="<?php print $dia5 ?>"
  $dia6 ="<?php print $dia6 ?>"
  $dia7 ="<?php print $dia7 ?>"
  $dia8 ="<?php print $dia8 ?>"
  $dia9 ="<?php print $dia9 ?>"
  $dia10 ="<?php print $dia10 ?>"
  $dia11 ="<?php print $dia11 ?>"
  $dia12 ="<?php print $dia12 ?>"
  $dia13 ="<?php print $dia13 ?>"
  $dia14 ="<?php print $dia14 ?>"
  $dia15 ="<?php print $dia15 ?>"
  $dia16 ="<?php print $dia16 ?>"
  $dia17 ="<?php print $dia17 ?>"
  $dia18 ="<?php print $dia18 ?>"
  $dia19 ="<?php print $dia19 ?>"
  $dia20 ="<?php print $dia20 ?>"
  $dia21 ="<?php print $dia21 ?>"
  $dia22 ="<?php print $dia22 ?>"
  $dia23 ="<?php print $dia23 ?>"
  $dia24 ="<?php print $dia24 ?>"
  $dia25 ="<?php print $dia25 ?>"
  $dia26 ="<?php print $dia26 ?>"
  $dia27 ="<?php print $dia27 ?>"
  $dia28 ="<?php print $dia28 ?>"
  $dia29 ="<?php print $dia29 ?>"
  $dia30 ="<?php print $dia30 ?>"
  $dia31 ="<?php print $dia31 ?>"
  
  
  


 



  
  
  for (i=0;i<33;i++)
  {
   array_turnoA[i]=0;
   array_turnoB[i]=0;
   array_turnoC[i]=0;
   array_turnoD[i]=0;
  }


  <?php
  
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
$a_id = "";
$a_epc = "";
$a_placa = "";
$a_data = "";
$a_hora = "";
$u_epc = "";
$u_placa = "";
$u_data = "";
$u_hora = "";

include "conexao.php";
$sql = $dbcon->query("SELECT * FROM lista_excesso_vl ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
    $encontrado =0;
  while($dados = $sql->fetch_array())
  {
      if ($encontrado <=5 && $encontrado >0 )
      {
        $u_epc = $a_epc;
        $u_placa = $a_placa;
        $u_data = $a_data;
        $u_hora = $a_hora;
                
        $a_id = $dados['id'];
        $a_epc = $dados['epc'];
        $a_placa = $dados['placa'];
        $a_data = $dados['data'];
        $a_hora = $dados['hora'];
        
        if($u_epc == $a_epc && $u_placa == $a_placa && $u_data == $a_data && $u_hora == $a_hora)
        {
         //echo "igual";echo"</br>";
         $sq2 = $dbcon->query("DELETE FROM lista_excesso_vl WHERE id='$a_id'");
        }
        else
        {
         //echo "diferente";echo"</br>";  
        }
      }
      if ($encontrado == 0)
      {
        $a_id = $dados['id'];
        $a_epc = $dados['epc'];
        $a_placa = $dados['placa'];
        $a_data = $dados['data'];
        $a_hora = $dados['hora'];   
      }
      $encontrado++;      
  } 
}

// ***********************************************************************************************************



// BUSCA TRANSPORTADORAS  
include "conexao.php";
$encontrado = 0;
$sql = $dbcon->query("SELECT * FROM transportadoras");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $transportadora = $dados['sigla'];
  $encontrado = $encontrado+1;
  ?>
  
  transportadora ="<?php print $transportadora ?>"
  encontrado ="<?php print $encontrado ?>"
  array_transportadora[encontrado] = transportadora;
  <?php
 }//Fecha while
 $encontrado = $encontrado+1;
 ?>
  encontrado ="<?php print $encontrado ?>"
  array_transportadora[encontrado] = 'Não identificada!'; // Para alocar as que não assoiciou a placa!
 <?php
 
}//Fecha if








  $sql = $dbcon->query("SELECT * FROM lista_excesso_vl WHERE mes = '$mes' AND ano = '$ano' AND local_instalacao = 'Varzea do Lopes'");
  
  

  //$dias_do_mes = 29;


  
  if(mysqli_num_rows($sql)>0)
  {
  
  while($dados = $sql->fetch_array())
  {
    $dia = intval((substr($dados['data'],0,2))); // retiro o dia
    $hora = intval((substr($dados['hora'],0,2))); // retiro a hora
    $turno = $dados['turno']; // busco o turno
    $dia_no_banco = $dados['data'];
    $sigla = $dados['sigla'];
    ?>
    
    dia ="<?php print $dia ?>";
    dia_no_banco ="<?php print $dia_no_banco ?>";
    hora ="<?php print $hora ?>";
    turno ="<?php print $turno ?>";
    sigla = "<?php print $sigla ?>";
    
    if(turno_atual == turno && data_atual == dia_no_banco) // BUSCA A TRANSPORTADORA REFERENTE AO TURNO QUE ESTAMOS
    {
      if(sigla == array_transportadora[1])
      {
        array_quantidade[1] = array_quantidade[1]+1;
      }

      else if(sigla == array_transportadora[2])
      {
        array_quantidade[2] = array_quantidade[2]+1;
      }

      else if(sigla == array_transportadora[3])
      {
        array_quantidade[3] = array_quantidade[3]+1;
      }

      else if(sigla == array_transportadora[4])
      {
        array_quantidade[4] = array_quantidade[4]+1;
      }

      else if(sigla == array_transportadora[5])
      {
        array_quantidade[5] = array_quantidade[5]+1;
      }

      else if(sigla == array_transportadora[6])
      {
        array_quantidade[6] = array_quantidade[6]+1;
      }

      else if(sigla == array_transportadora[7])
      {
        array_quantidade[7] = array_quantidade[7]+1;
      }

      else if(sigla == array_transportadora[8])
      {
        array_quantidade[8] = array_quantidade[8]+1;
      }

      else if(sigla == array_transportadora[9])
      {
        array_quantidade[9] = array_quantidade[9]+1;
      }
      else if(sigla == array_transportadora[10])
      {
        array_quantidade[10] = array_quantidade[10]+1;
      }
      else
      {
        array_quantidade[11] = array_quantidade[11]+1; // Sempre deve ficar na ultima
      }
    }




    if(turno == "A")
    {
      array_turnoA[dia] = array_turnoA[dia] + 1;
      quantidadeA = quantidadeA+1;
    }
    if(turno == "B")
    {
      array_turnoB[dia] = array_turnoB[dia] + 1;
      quantidadeB = quantidadeB+1;
    }
    if(turno == "C")
    {
      array_turnoC[dia] = array_turnoC[dia] + 1;
      quantidadeC = quantidadeC+1;
    }
    if(turno == "D")
    {
      array_turnoD[dia] = array_turnoD[dia] + 1;
      quantidadeD = quantidadeD+1;
    }

    if(data_atual == dia_no_banco)
    {
      array_quantidade_hora[hora] = array_quantidade_hora[hora]+1;
    }
   
    <?php

  
  
  }// Fecha While
 }
  else
  {
  // Não existe dados para este mes e ano no banco
  }



  ?>

// CRIA O GRAFICO DAS TRANSPORTADORAS ************************************************
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart_transportadora);

  function drawChart_transportadora()
  {
   var cor_azul = "#00008B";
   var data = google.visualization.arrayToDataTable([
   ["Transportadora", "Quantidade", { role: "style" } ],
   [array_transportadora[1], array_quantidade[1],cor_azul],
   [array_transportadora[2], array_quantidade[2],cor_azul],
   [array_transportadora[3], array_quantidade[3],cor_azul],
   [array_transportadora[4], array_quantidade[4],cor_azul],
   [array_transportadora[5], array_quantidade[5],cor_azul],
   [array_transportadora[6], array_quantidade[6],cor_azul],
   [array_transportadora[7], array_quantidade[7],cor_azul],
   [array_transportadora[8], array_quantidade[8],cor_azul],
   [array_transportadora[9], array_quantidade[9],cor_azul],
   [array_transportadora[10], array_quantidade[10],cor_azul],
   ['Não identificado', array_quantidade[11],cor_azul]
   ]);

   var view = new google.visualization.DataView(data);
   view.setColumns([0, 1,
   { calc: "stringify",
   sourceColumn: 1,
   type: "string",
   role: "annotation" },
   2]);

   var options = {
    title: "Lista Excesso Por Transportadora",
    width: 795,
    height: 700,
    fontSize: 14,
    
    vAxis: {minValue: 0, viewWindow: {value: 1}, gridlines: {"color": "#f2f2f2", "count": 2}, baselineColor: "#f2f2f2"},
    hAxis: {minValue: 0,viewWindow: {min:0.1},gridlines: {"color": cor_azul},baselineColor: cor_azul},
    bar: {groupWidth: "55%"},
    legend: { position: "none" },
   };
   var chart_transportadora = new google.visualization.BarChart(document.getElementById("chart_div4"));
   chart_transportadora.draw(view, options);
  }















//********************************************************************************* */
  var total_dia1 = array_turnoA[1]+array_turnoB[1]+array_turnoC[1]+array_turnoD[1];
  var total_dia2 = array_turnoA[2]+array_turnoB[2]+array_turnoC[2]+array_turnoD[2];
  var total_dia3 = array_turnoA[3]+array_turnoB[3]+array_turnoC[3]+array_turnoD[3];
  var total_dia4 = array_turnoA[4]+array_turnoB[4]+array_turnoC[4]+array_turnoD[4];
  var total_dia5 = array_turnoA[5]+array_turnoB[5]+array_turnoC[5]+array_turnoD[5];
  var total_dia6 = array_turnoA[6]+array_turnoB[6]+array_turnoC[6]+array_turnoD[6];
  var total_dia7 = array_turnoA[7]+array_turnoB[7]+array_turnoC[7]+array_turnoD[7];
  var total_dia8 = array_turnoA[8]+array_turnoB[8]+array_turnoC[8]+array_turnoD[8];
  var total_dia9 = array_turnoA[9]+array_turnoB[9]+array_turnoC[9]+array_turnoD[9];
  var total_dia10 = array_turnoA[10]+array_turnoB[10]+array_turnoC[10]+array_turnoD[10];
  var total_dia11 = array_turnoA[11]+array_turnoB[11]+array_turnoC[11]+array_turnoD[11];
  var total_dia12 = array_turnoA[12]+array_turnoB[12]+array_turnoC[12]+array_turnoD[12];
  var total_dia13 = array_turnoA[13]+array_turnoB[13]+array_turnoC[13]+array_turnoD[13];
  var total_dia14 = array_turnoA[14]+array_turnoB[14]+array_turnoC[14]+array_turnoD[14];
  var total_dia15 = array_turnoA[15]+array_turnoB[15]+array_turnoC[15]+array_turnoD[15];
  var total_dia16 = array_turnoA[16]+array_turnoB[16]+array_turnoC[16]+array_turnoD[16];
  var total_dia17 = array_turnoA[17]+array_turnoB[17]+array_turnoC[17]+array_turnoD[17];
  var total_dia18 = array_turnoA[18]+array_turnoB[18]+array_turnoC[18]+array_turnoD[18];
  var total_dia19 = array_turnoA[19]+array_turnoB[19]+array_turnoC[19]+array_turnoD[19];
  var total_dia20 = array_turnoA[20]+array_turnoB[20]+array_turnoC[20]+array_turnoD[20];
  var total_dia21 = array_turnoA[21]+array_turnoB[21]+array_turnoC[21]+array_turnoD[21];
  var total_dia22 = array_turnoA[22]+array_turnoB[22]+array_turnoC[22]+array_turnoD[22];
  var total_dia23 = array_turnoA[23]+array_turnoB[23]+array_turnoC[23]+array_turnoD[23];
  var total_dia24 = array_turnoA[24]+array_turnoB[24]+array_turnoC[24]+array_turnoD[24];
  var total_dia25 = array_turnoA[25]+array_turnoB[25]+array_turnoC[25]+array_turnoD[25];
  var total_dia26 = array_turnoA[26]+array_turnoB[26]+array_turnoC[26]+array_turnoD[26];
  var total_dia27 = array_turnoA[27]+array_turnoB[27]+array_turnoC[27]+array_turnoD[27];
  var total_dia28 = array_turnoA[28]+array_turnoB[28]+array_turnoC[28]+array_turnoD[28];
  var total_dia29 = array_turnoA[29]+array_turnoB[29]+array_turnoC[29]+array_turnoD[29];
  var total_dia30 = array_turnoA[30]+array_turnoB[30]+array_turnoC[30]+array_turnoD[30];
  var total_dia31 = array_turnoA[31]+array_turnoB[31]+array_turnoC[31]+array_turnoD[31];



  var data = google.visualization.arrayToDataTable([
  ['Genre', 'Letra A', 'Letra B', 'Letra C', 'Letra D', {role: 'annotation' }, {role: 'annotation' } ],
  [$dia1,array_turnoA[1]?array_turnoA[1]:0  , array_turnoB[1]?array_turnoB[1]:0,array_turnoC[1]?array_turnoC[1]:0,array_turnoD[1]?array_turnoD[1]:0, '',total_dia1],
  [$dia2,array_turnoA[2]?array_turnoA[2]:0  ,array_turnoB[2]?array_turnoB[2]:0,array_turnoC[2]?array_turnoC[2]:0,array_turnoD[2]?array_turnoD[2]:0, '',total_dia2],
  [$dia3,array_turnoA[3]?array_turnoA[3]:0  ,array_turnoB[3]?array_turnoB[3]:0,array_turnoC[3]?array_turnoC[3]:0,array_turnoD[3]?array_turnoD[3]:0, '',total_dia3],
  [$dia4,array_turnoA[4]?array_turnoA[4]:0  ,array_turnoB[4]?array_turnoB[4]:0,array_turnoC[4]?array_turnoC[4]:0,array_turnoD[4]?array_turnoD[4]:0, '',total_dia4],
  [$dia5,array_turnoA[5]?array_turnoA[5]:0  ,array_turnoB[5]?array_turnoB[5]:0,array_turnoC[5]?array_turnoC[5]:0,array_turnoD[5]?array_turnoD[5]:0, '',total_dia5],
  [$dia6,array_turnoA[6]?array_turnoA[6]:0  ,array_turnoB[6]?array_turnoB[6]:0,array_turnoC[6]?array_turnoC[6]:0,array_turnoD[6]?array_turnoD[6]:0, '',total_dia6],
  [$dia7,array_turnoA[7]?array_turnoA[7]:0  ,array_turnoB[7]?array_turnoB[7]:0,array_turnoC[7]?array_turnoC[7]:0,array_turnoD[7]?array_turnoD[7]:0, '',total_dia7],
  [$dia8,array_turnoA[8]?array_turnoA[8]:0  ,array_turnoB[8]?array_turnoB[8]:0,array_turnoC[8]?array_turnoC[8]:0,array_turnoD[8]?array_turnoD[8]:0, '',total_dia8],
  [$dia9,array_turnoA[9]?array_turnoA[9]:0  ,array_turnoB[9]?array_turnoB[9]:0,array_turnoC[9]?array_turnoC[9]:0,array_turnoD[9]?array_turnoD[9]:0, '',total_dia9],
  [$dia10,array_turnoA[10]?array_turnoA[10]:0  ,array_turnoB[10]?array_turnoB[10]:0,array_turnoC[10]?array_turnoC[10]:0,array_turnoD[10]?array_turnoD[10]:0, '',total_dia10],
  [$dia11,array_turnoA[11]?array_turnoA[11]:0  ,array_turnoB[11]?array_turnoB[11]:0,array_turnoC[11]?array_turnoC[11]:0,array_turnoD[11]?array_turnoD[11]:0, '',total_dia11],
  [$dia12,array_turnoA[12]?array_turnoA[12]:0  ,array_turnoB[12]?array_turnoB[12]:0,array_turnoC[12]?array_turnoC[12]:0,array_turnoD[12]?array_turnoD[12]:0, '',total_dia12],
  [$dia13,array_turnoA[13]?array_turnoA[13]:0  ,array_turnoB[13]?array_turnoB[13]:0,array_turnoC[13]?array_turnoC[13]:0,array_turnoD[13]?array_turnoD[13]:0, '',total_dia13],
  [$dia14,array_turnoA[14]?array_turnoA[14]:0  ,array_turnoB[14]?array_turnoB[14]:0,array_turnoC[14]?array_turnoC[14]:0,array_turnoD[14]?array_turnoD[14]:0, '',total_dia14],
  [$dia15,array_turnoA[15]?array_turnoA[15]:0  ,array_turnoB[15]?array_turnoB[15]:0,array_turnoC[15]?array_turnoC[15]:0,array_turnoD[15]?array_turnoD[15]:0, '',total_dia15],
  [$dia16,array_turnoA[16]?array_turnoA[16]:0  ,array_turnoB[16]?array_turnoB[16]:0,array_turnoC[16]?array_turnoC[16]:0,array_turnoD[16]?array_turnoD[16]:0, '',total_dia16],
  [$dia17,array_turnoA[17]?array_turnoA[17]:0  ,array_turnoB[17]?array_turnoB[17]:0,array_turnoC[17]?array_turnoC[17]:0,array_turnoD[17]?array_turnoD[17]:0, '',total_dia17],
  [$dia18,array_turnoA[18]?array_turnoA[18]:0  ,array_turnoB[18]?array_turnoB[18]:0,array_turnoC[18]?array_turnoC[18]:0,array_turnoD[18]?array_turnoD[18]:0, '',total_dia18],
  [$dia19,array_turnoA[19]?array_turnoA[19]:0  ,array_turnoB[19]?array_turnoB[19]:0,array_turnoC[19]?array_turnoC[19]:0,array_turnoD[19]?array_turnoD[19]:0, '',total_dia19],
  [$dia20,array_turnoA[20]?array_turnoA[20]:0  ,array_turnoB[20]?array_turnoB[20]:0,array_turnoC[20]?array_turnoC[20]:0,array_turnoD[20]?array_turnoD[20]:0, '',total_dia20],
  [$dia21,array_turnoA[21]?array_turnoA[21]:0  ,array_turnoB[21]?array_turnoB[21]:0,array_turnoC[21]?array_turnoC[21]:0,array_turnoD[21]?array_turnoD[21]:0, '',total_dia21],
  [$dia22,array_turnoA[22]?array_turnoA[22]:0  ,array_turnoB[22]?array_turnoB[22]:0,array_turnoC[22]?array_turnoC[22]:0,array_turnoD[22]?array_turnoD[22]:0, '',total_dia22],
  [$dia23,array_turnoA[23]?array_turnoA[23]:0  ,array_turnoB[23]?array_turnoB[23]:0,array_turnoC[23]?array_turnoC[23]:0,array_turnoD[23]?array_turnoD[23]:0, '',total_dia23],
  [$dia24,array_turnoA[24]?array_turnoA[24]:0  ,array_turnoB[24]?array_turnoB[24]:0,array_turnoC[24]?array_turnoC[24]:0,array_turnoD[24]?array_turnoD[24]:0, '',total_dia24],
  [$dia25,array_turnoA[25]?array_turnoA[25]:0  ,array_turnoB[25]?array_turnoB[25]:0,array_turnoC[25]?array_turnoC[25]:0,array_turnoD[25]?array_turnoD[25]:0, '',total_dia25],
  [$dia26,array_turnoA[26]?array_turnoA[26]:0  ,array_turnoB[26]?array_turnoB[26]:0,array_turnoC[26]?array_turnoC[26]:0,array_turnoD[26]?array_turnoD[26]:0, '',total_dia26],
  [$dia27,array_turnoA[27]?array_turnoA[27]:0  ,array_turnoB[27]?array_turnoB[27]:0,array_turnoC[27]?array_turnoC[27]:0,array_turnoD[27]?array_turnoD[27]:0, '',total_dia27],
  [$dia28,array_turnoA[28]?array_turnoA[28]:0  ,array_turnoB[28]?array_turnoB[28]:0,array_turnoC[28]?array_turnoC[28]:0,array_turnoD[28]?array_turnoD[28]:0, '',total_dia28],
  [$dia29,array_turnoA[29]?array_turnoA[29]:0  ,array_turnoB[29]?array_turnoB[29]:0,array_turnoC[29]?array_turnoC[29]:0,array_turnoD[29]?array_turnoD[29]:0, '',total_dia29],
  [$dia30,array_turnoA[30]?array_turnoA[30]:0  ,array_turnoB[30]?array_turnoB[30]:0,array_turnoC[30]?array_turnoC[30]:0,array_turnoD[30]?array_turnoD[30]:0, '',total_dia30],
  [$dia31,array_turnoA[31]?array_turnoA[31]:0  ,array_turnoB[31]?array_turnoB[31]:0,array_turnoC[31]?array_turnoC[31]:0,array_turnoD[31]?array_turnoD[31]:0, '',total_dia31],
  ]);
  var options = {
  legend: { position: 'top', maxLines: 3 },
  bar: { groupWidth: '75%' },
  isStacked: true,
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
  chart.draw(data, options); // cria o grafico com opções
  }
  










  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart2);
  
  
  function drawChart2() 
  {
    
    var data2 = new google.visualization.DataTable();
    data2.addColumn('string', 'Topping');
    data2.addColumn('number', 'Slices');
    data2.addRows([
    ['Letra A', quantidadeA],
    ['Letra B', quantidadeB],
    ['Letra C', quantidadeC],
    ['Letra D', quantidadeD]
    ]);
   
    var options2 = {'title':'Lista Excesso Varzea do Lopes'};
    var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
    chart2.draw(data2, options2);
  }



    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart3);
    
    var cor_azul = "#00008B";
   
    
    function drawChart3() 
    {
      var data3;
    if(hora_atual >= 0 && hora_atual < 8) // Pertence ao primeiro turno
    {
      valor_turno = "turno1";
      data3 = google.visualization.arrayToDataTable([
      ["Local", "Carretas", { role: "style" } ],
      ["00:00 à 01:00", array_quantidade_hora[0]?array_quantidade_hora[0]:0, cor_azul],
      ["01:00 à 02:00", array_quantidade_hora[1]?array_quantidade_hora[1]:0, cor_azul],
      ["02:00 à 03:00", array_quantidade_hora[2]?array_quantidade_hora[2]:0, cor_azul],
      ["03:00 à 04:00", array_quantidade_hora[3]?array_quantidade_hora[3]:0, cor_azul],
      ["04:00 à 05:00", array_quantidade_hora[4]?array_quantidade_hora[4]:0, cor_azul],
      ["05:00 à 06:00", array_quantidade_hora[5]?array_quantidade_hora[5]:0, cor_azul],
      ["06:00 à 07:00", array_quantidade_hora[6]?array_quantidade_hora[6]:0, cor_azul],
      ["07:00 à 08:00", array_quantidade_hora[7]?array_quantidade_hora[7]:0, cor_azul]
     ]);
     quantidade_total = array_quantidade_hora[0]+array_quantidade_hora[1]+array_quantidade_hora[2]+array_quantidade_hora[3]+array_quantidade_hora[4]+array_quantidade_hora[5]+array_quantidade_hora[6]+array_quantidade_hora[7];
    }
    else if(hora_atual > 7 && hora_atual < 17) // Pertence ao segundo turno
    {  
      valor_turno = "turno2"; 
      data3 = google.visualization.arrayToDataTable([
      ["Local", "Carretas", { role: "style" } ],
      ["08:00 à 09:00", array_quantidade_hora[8]?array_quantidade_hora[8]:0, cor_azul],
      ["09:00 à 10:00", array_quantidade_hora[9]?array_quantidade_hora[9]:0, cor_azul],
      ["10:00 à 11:00", array_quantidade_hora[10]?array_quantidade_hora[10]:0, cor_azul],
      ["11:00 à 12:00", array_quantidade_hora[11]?array_quantidade_hora[11]:0, cor_azul],
      ["12:00 à 13:00", array_quantidade_hora[12]?array_quantidade_hora[12]:0, cor_azul],
      ["13:00 à 14:00", array_quantidade_hora[13]?array_quantidade_hora[13]:0, cor_azul],
      ["14:00 à 15:00", array_quantidade_hora[14]?array_quantidade_hora[14]:0, cor_azul],
      ["15:00 à 16:00", array_quantidade_hora[15]?array_quantidade_hora[15]:0, cor_azul],
      ["16:00 à 17:00", array_quantidade_hora[16]?array_quantidade_hora[16]:0, cor_azul]
     ]);
     quantidade_total = array_quantidade_hora[8]+array_quantidade_hora[9]+array_quantidade_hora[10]+array_quantidade_hora[11]+array_quantidade_hora[12]+array_quantidade_hora[13]+array_quantidade_hora[14]+array_quantidade_hora[15]+array_quantidade_hora[16];
     
    }
    else
    {
      valor_turno = "turno3";
      data3 = google.visualization.arrayToDataTable([
      ["Local", "Carretas", { role: "style" } ],
      ["17:00 à 18:00", array_quantidade_hora[17]?array_quantidade_hora[17]:0, cor_azul],
      ["18:00 à 19:00", array_quantidade_hora[18]?array_quantidade_hora[18]:0, cor_azul],
      ["19:00 à 20:00", array_quantidade_hora[19]?array_quantidade_hora[19]:0, cor_azul],
      ["20:00 à 21:00", array_quantidade_hora[20]?array_quantidade_hora[20]:0, cor_azul],
      ["21:00 à 22:00", array_quantidade_hora[21]?array_quantidade_hora[21]:0, cor_azul],
      ["22:00 à 23:00", array_quantidade_hora[22]?array_quantidade_hora[22]:0, cor_azul],
      ["23:00 à 00:00", array_quantidade_hora[23]?array_quantidade_hora[23]:0, cor_azul]
      ]);
      quantidade_total = array_quantidade_hora[17]+array_quantidade_hora[18]+array_quantidade_hora[19]+array_quantidade_hora[20]+array_quantidade_hora[21]+array_quantidade_hora[22]+array_quantidade_hora[23];
      
    }

     view3 = new google.visualization.DataView(data3);
     view3.setColumns([0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      
     

    

    // BUSCANDO PELA DATA ATUAL QUAL A LETRA DO TURNO NO MOMENTO
    
    if (valor_turno == "turno1")
    {
         
    } // fecha if turno 1
    else if(valor_turno == "turno2")
    {
         
    } // fecha if turno 2
    else // Turno 3
    {
     
     
    } // fecha if turno 3
    

   


      var options3 = {
        title: "Lista Excesso do dia "+dia+"/"+mes+"/"+ano+ "    -     Referente ao turno da letra "+ turno_atual+ " - Total de Excessos: "+quantidade_total,
        bar: {groupWidth: "75%"}, // Espessura da coluna
        legend: { position: "none" },
      };
      var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
      chart3.draw(view3, options3); // cria o grafico com opções
  

     
 
  
  }























  //setTimeout("location.reload(false);",10000); // recarrega a pagina em 5 segundos




  </script>
  </head>

<body>
<div id="conexao" hidden="hidden">
<label id="colaborador"></label>
<label id="funcao"></label>

<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>
<?php
// Busca o usuario passado e verifica no sistema
$usuario = "";
$tipo = "";
$criptografia = "";
$usuario_criptografado = "";
include_once 'conexao2.php';
$complemento = $_GET['complemento'];
$check = $_GET['check'];
$registro = (floatval($complemento))/1.5;
$nome = "";
// Desfazendo a criptografia
for ($i=0; $i < strlen($check)-1; $i+=2)
{
 $nome .= chr(hexdec($check[$i].$check[$i+1]));
}

$sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND nome='$nome'");
if(mysqli_num_rows($sql)>0){
while($dados = $sql->fetch_array()){
$usuario = $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
$tipo = $dados['tipo_usuario'];
$criptografia = $dados['criptografia'];
}
// deixa rodar
?>
<script>
var usuario = window.document.getElementById('colaborador');
var colaborador = "<?php print $usuario ?>";
usuario.innerHTML = "Usuario : "  + colaborador;
var lfuncao = window.document.getElementById('funcao');
var funcao = "<?php print $tipo ?>";
lfuncao.innerHTML = "Perfil : " + funcao;
var lusuario_criptografado = "<?php print $check ?>";
var link_criptografia = window.document.getElementById('criptografia');
link_criptografia.value = lusuario_criptografado;
var lcriptografia = "<?php print $criptografia ?>";
var link_criptografia2 = window.document.getElementById('criptografia2');
link_criptografia2.value = lcriptografia;
</script>
<?php


}else{
?>
<script language="JavaScript">
//window.Notification="Senha Incorreta!";
//window.location="login.php";
</script>
<?php
}
?>








  <div id="chart_div" style="width:800; height:600"></div>
  <div id="chart_div2" style="width:600; height:500" ></div>
  <div id="chart_div3" ></div>
  <div id="chart_div4" ></div>
  <img id="voltar" src="./images/btn_voltar.png" id="voltar" onclick="javascript: location.href='./dashboard_vl.php?vezes=0';"/>

 <div id='filtro'>
   <h3> Filtrar dados </h3>
 <label>Selecione o mês desejado: </label>
 <?php
include_once 'conexao2.php';
$id = 'DEFAULT';
$id = 1;

$sql = $dbcon->query("SELECT * FROM mes");

if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="mes" id="mes">
 <?php
 while($dados = $sql->fetch_array())
 {
  $nome_mes = $dados['nome_mes'];
  $valor_mes = $dados['valor_mes'];
  echo"<option>$nome_mes</option>";
 }
}

?>

</select>
<input style="margin-left: 10px;" type="submit" class="BotaoMenu" value="Filtrar" onclick="clicou();"/>
</div>

<?php
error_reporting(0);

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

$vmes = substr($data,3,2);

?>
<script>
var link_mes = window.document.getElementById('mes');
var filtro = '<?php print $vmes ?>';
var mes = "";
if(filtro == '01'){mes = 'Janeiro';}
else if (filtro == '02'){mes = 'Fevereiro';}
else if (filtro == '03'){mes = 'Março';}
else if (filtro == '04'){mes = 'Abril';}
else if (filtro == '05'){mes = 'Maio';}
else if (filtro == '06'){mes = 'Junho';}
else if (filtro == '07'){mes = 'Julho';}
else if (filtro == '08'){mes = 'Agosto';}
else if (filtro == '09'){mes = 'Setembro';}
else if (filtro == '10'){mes = 'Outubro';}
else if (filtro == '11'){mes = 'Novembro';}
else if (filtro == '12'){mes = 'Dezembro';}
link_mes.value = mes;
</script>
</body>


<script>
function clicou()
{
  var link_mes = window.document.getElementById('mes');
  var b = link_mes.value;
  if(b == "Janeiro"){b = "01";}
  if(b == "Fevereiro"){b = "02";}
  if(b == "Março"){b = "03";}
  if(b == "Abril"){b = "04";}
  if(b == "Maio"){b = "05";}
  if(b == "Junho"){b = "06";}
  if(b == "Julho"){b = "07";}
  if(b == "Agosto"){b = "08";}
  if(b == "Setembro"){b = "09";}
  if(b == "Outubro"){b = "19";}
  if(b == "Novembro"){b = "11";}
  if(b == "Dezembro"){b = "12";}
 
  location.href=`filtro_excesso_vl.php?filtro=${b}&complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}`;
}



var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 4)
{
 location.href='http://192.168.30.124/dips/dashboard_vl.php?vezes=0';
 //location.href='.gagf/dashboard_excesso_vl.php?vezes=0';
}
else
{
 if(link_vezes != '-1')
 {
    window.setTimeout( "location.href=`./dashboard_excesso_vl.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}
</script>




</script>
 <style>
body{
  width: 100%;
  height: 100%;
}
 INPUT.BotaoMenu {
     width: 140px;
     height: 26px;
     position: absolute;
     top: 50%;
     left: 10px;
     font-weight: normal;
     font-family: verdana;
     font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}


SELECT#mes{
    margin-left: 0px;
    position: absolute;
    left: 1px;
    top: 34%;
    font-weight: normal;
    font-family: verdana;
    font-size: 12pt;
    width: 180px;
    height: 28px;
    cursor: pointer;

}

 DIV#chart_div{
    margin-left: 0px;
    position: absolute;
    left: -90px;
    top: 0px;
    width: 85%;
    height: 50%;
    

}
 DIV#chart_div2{
    margin-left: 0px;
    position: absolute;
    left: 72%;
    top: 0px;
    width: 500px;
    height: 450px;
    

}
DIV#chart_div3{
    margin-left: 0px;
    position: absolute;
    left: -60px;
    top: 55%;
    width: 75%;
    height: 40%;
    

}

DIV#chart_div4{
    margin-left: 0px;
    position: absolute;
    left: 65%;
    top: 40%;
    width: 10%;
    height: 40%;
    background-color: transparent;
    

}
DIV#filtro{
    margin-left: 0px;
    position: absolute;
    left: 78%;
    top: 32%;
    background-color: transparent;
    width: 21%;
    height: 250px;
    

}

IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 5px;
    width: 28px;
    height: 28px;
    cursor: pointer;

}

 </style>

</html>

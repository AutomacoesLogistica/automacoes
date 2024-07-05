<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
    <title>Tela Amostragem VL</title>
</head>
<body>



<?php

$permite_echo = "0"; // Em 1 para debugar e em 0 corta os echos

//$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
//$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
//$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
//if($tempo == '-1'){$tempo = 30000;}
//if($nvezes == '-1'){$nvezes = 5;}
//if($vezes != '-1'){$vezes = intval($vezes)+1;}

//if($vezes == -1){}else{$vezes = intval($vezes)+1;}



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
$pesquisa_ano = '2023';
$data_leitura = $data;

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


date_default_timezone_set('America/Sao_Paulo');

$hora_leitura = date('H:i:s');
$dia = (substr($data_leitura,0,2));
$mes = (substr($data_leitura,3,2)); // extrai o mes atual
$ano = (substr($data_leitura,6,4)); // extrai o ano atual


$numero_materiais = 0;
$numero_trasportadoras = 0;

$array_materiais = [];
$array_lista_materiais = [];
$array_v_materiais = [];

$array_transportadoras = [];
$array_lista_transportadoras = [];
$array_v_transportadoras = [];

$encontrados = 0;
$numero_amostragem = 0;
$encontrados = 0;
$numero_amostragem = 0;
$hora_zero = 0;
$hora_um = 0;
$hora_dois = 0;
$hora_tres = 0;
$hora_quatro = 0;
$hora_cinco = 0;
$hora_seis = 0;
$hora_sete = 0;
$hora_oito = 0;
$hora_nove = 0;
$hora_dez = 0;
$hora_onze = 0;
$hora_doze = 0;
$hora_treze = 0;
$hora_quatorze = 0;
$hora_quinze = 0;
$hora_dezesseis = 0;
$hora_dezessete = 0;
$hora_dezoito = 0;
$hora_dezenove = 0;
$hora_vinte = 0;
$hora_vinte_e_um = 0;
$hora_vinte_e_dois = 0;
$hora_vinte_e_tres = 0;
$v_turno1 = 0;
$v_turno2 = 0;
$v_turno3 = 0;
$v_turnoX = 0;
$tempo_medio = 0;

$turno1 = 'X';
$turno2 = 'X';
$turno3 = 'X';

$tabela = 'lista_turno_'.$ano.'_lmn';

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data_leitura'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];

}



include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM amostragem WHERE data_leitura='$data_leitura'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $encontrados = intval($encontrados) + 1;
  $amostrado = $dados['amostrado'];
  if($amostrado == "sim")
  {
    $numero_amostragem = intval($numero_amostragem)+1;
    $tempo_amostras = floatval($tempo_amostras)+floatval($dados['tempo_gasto']);
  }
  //Agora trato os valores para hora
  $hora = intval($dados['hora']);
  if($hora == 0)
  {
   $hora_zero = intval($hora_zero) +1;
  }
  else if($hora == 1)
  {
   $hora_um = intval($hora_um) + 1;
  }
  else if($hora == 2)
  {
    $hora_dois = intval($hora_dois) + 1;
  }
  else if($hora == 3)
  {
    $hora_tres = intval($hora_tres) + 1;
  }
  else if($hora == 4)
  {
    $hora_quatro = intval($hora_quatro) + 1;
  }
  else if($hora == 5)
  {
    $hora_cinco = intval($hora_cinco) + 1;
  }
  else if($hora == 6)
  {
    $hora_seis = intval($hora_seis) + 1;
  }
  else if($hora == 7)
  {
    $hora_sete = intval($hora_sete)+1;
  }
  else if($hora == 8)
  {
    $hora_oito = intval($hora_oito) + 1;
  }
  else if($hora == 9)
  {
    $hora_nove = intval($hora_nove) + 1;
  }
  else if($hora == 10)
  {
    $hora_dez = intval($hora_dez) + 1;
  }
  else if($hora == 11)
  {
    $hora_onze = intval($hora_onze) + 1;
  }
  else if($hora == 12)
  {
    $hora_doze = intval($hora_doze) + 1;
  }
  else if($hora == 13)
  {
    $hora_treze = intval($hora_treze) + 1;
  }
  else if($hora == 14)
  {
    $hora_quatorze = intval($hora_quatorze) + 1;
  }
  else if($hora == 15)
  {
    $hora_quinze = intval($hora_quinze) + 1;
  }
  else if($hora == 16)
  {
    $hora_dezesseis = intval($hora_dezesseis) + 1;
  }
  else if($hora == 17)
  {
    $hora_dezessete = intval($hora_dezessete) + 1;
  }
  else if($hora == 18)
  {
    $hora_dezoito = intval($hora_dezoito) + 1;
  }
  else if($hora == 19)
  {
    $hora_dezenove = intval($hora_dezenove) + 1;
  }
  else if($hora == 20)
  {
    $hora_vinte = intval($hora_vinte) + 1;
  }
  else if($hora == 21)
  {
    $hora_vinte_e_um = intval($hora_vinte_e_um) + 1;
  }
  else if($hora == 22)
  {
    $hora_vinte_e_dois = intval($hora_vinte_e_dois) + 1;
  }
  else if($hora == 23)
  {
    $hora_vinte_e_tres = intval($hora_vinte_e_tres) + 1;
  }
  //Agora trato a quantitade por turno
  $vv_turno = $dados['turno'];
  if($amostrado == "sim")
  {
    if($vv_turno == $turno1)
    {
    $v_turno1 = intval($v_turno1)+1;
    }
    else if($vv_turno == $turno2)
    {
    $v_turno2 = intval($v_turno2)+1;
    }
    else if($vv_turno == $turno3)
    {
    $v_turno3 = intval($v_turno3)+1;
    }
    else
    {
      $v_turnoX = intval($v_turnoX) + 1;
    }
  }

  //Busco dados de materiais mas porem dos que foram amostrados!
  if($amostrado == "sim")
  {
    $v_materiais = $dados['material'];
    array_push($array_lista_materiais, $v_materiais);
    if($v_materiais != "")
    {
      if(in_array($v_materiais, $array_materiais, true))
      {
      
      }
      else
      {
       array_push($array_materiais, $v_materiais);
       $numero_materiais = intval($numero_materiais)+1;
      }
    } // Fecha if($v_materiais != "")
  }


  //Busco dados de transportadoras mas porem dos que foram amostrados!
  if($amostrado == "sim")
  {
    $v_transportadoras = $dados['transportadora'];
    array_push($array_lista_transportadoras, $v_transportadoras);
    if($v_transportadoras != "")
    {
      if(in_array($v_transportadoras, $array_transportadoras, true))
      {
      
      }
      else
      {
       array_push($array_transportadoras, $v_transportadoras);
       $numero_trasportadoras = intval($numero_trasportadoras)+1;
      }
    } // Fecha if($v_materiais != "")
   }



 } //Fecha o Whille
} // Fecha o if de consulta


//Agora busco dados para o mes
$encontrado_mes = 0;
$amostrado_mes = 0;
$aderencia_mes = 0;

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM amostragem WHERE mes='$mes'");
if(mysqli_num_rows($sql)>0)
{
  while($dados = $sql->fetch_array())
  {
    $encontrado_mes = intval($encontrado_mes) + 1; 
    $v_amostrado_mes = $dados['amostrado'];
    if($v_amostrado_mes == "sim")
    {
      $amostrado_mes = intval($amostrado_mes) + 1;
    }
  }

}







if(intval($encontrados)>0)
{
 $numero_passagem_pela_balanca2 = intval($encontrados);

 $aderencia_dia = ($numero_amostragem/$numero_passagem_pela_balanca2)*100;
 $aderencia_dia = strval(number_format($aderencia_dia,2,",","")) . " %";
 
 $aderencia_mes = ($amostrado_mes/$encontrado_mes)*100;
 $aderencia_mes = strval(number_format($aderencia_mes,2,",","")) . " %";
 
 $tempo_medio = floatval($tempo_amostras/$numero_amostragem);
 $tempo_medio = strval(intval($tempo_medio)) . " s";
 /*
 echo "Encontrados = " . $encontrados;
 echo "</BR>";
 echo "Numero de amostragens = " . $numero_amostragem;
 echo "</BR>";
 echo "Aderencia_dia = ".$aderencia_dia;
 echo "</BR>";
 echo "Listagem por turno ******************";
 echo "</BR>";
 echo "Turno 1 ( ".$turno1.") = " . $v_turno1;
 echo "</BR>";
 echo "Turno 2 ( ".$turno2.") = " . $v_turno2;
 echo "</BR>";
 echo "Turno 3 ( ".$turno3.") = " .$v_turno3;
 echo "</BR>";
 echo "Turno X = " . $v_turnoX;
 echo "</BR>";
 echo "</BR>";
 echo "Dados referentes a materiais ****************";
 echo "</BR>";
 echo "Numero de materiais encontrados = " . intval($numero_materiais);
 echo "</BR>";echo "</BR>";echo "</BR>";
 */
 $array_v_materiais = json_encode(array_count_values($array_lista_materiais));
 $jsonObj = json_decode($array_v_materiais);
 
 if(intval($numero_materiais) == 1)
 {
  $m0 = $array_materiais[0];
  $quantidade_material_zero = $jsonObj->$m0;
  //echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  //echo "</BR>";
 }
 else if(intval($numero_materiais) == 2)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  //echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  //echo "</BR>";
  //echo "Quantidade material 1 = " . intval($quantidade_material_um);
  //echo "</BR>";
 }
 else if(intval($numero_materiais) == 3)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $m2 = $array_materiais[2];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  $quantidade_material_dois = $jsonObj->$m2;
  //echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  //echo "</BR>";
  //echo "Quantidade material 1 = " . intval($quantidade_material_um);
  //echo "</BR>";
  //echo "Quantidade material 2 = " . intval($quantidade_material_dois);
  //echo "</BR>";
 }
 else if(intval($numero_materiais) == 4)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $m2 = $array_materiais[2];
  $m3 = $array_materiais[3];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  $quantidade_material_dois = $jsonObj->$m2;
  $quantidade_material_tres = $jsonObj->$m3;
  //echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  //echo "</BR>";
  //echo "Quantidade material 1 = " . intval($quantidade_material_um);
  //echo "</BR>";
  //echo "Quantidade material 2 = " . intval($quantidade_material_dois);
  //echo "</BR>";
  //echo "Quantidade material 3 = " . intval($quantidade_material_tres);
  //echo "</BR>";
 }
 else if(intval($numero_materiais) == 5)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $m2 = $array_materiais[2];
  $m3 = $array_materiais[3];
  $m4 = $array_materiais[4];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  $quantidade_material_dois = $jsonObj->$m2;
  $quantidade_material_tres = $jsonObj->$m3;
  $quantidade_material_quatro = $jsonObj->$m4;
  //echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  //echo "</BR>";
  //echo "Quantidade material 1 = " . intval($quantidade_material_um);
  //echo "</BR>";
  //echo "Quantidade material 2 = " . intval($quantidade_material_dois);
  //echo "</BR>";
  //echo "Quantidade material 3 = " . intval($quantidade_material_tres);
  //echo "</BR>";
  //echo "Quantidade material 4 = " . intval($quantidade_material_quatro);
  //echo "</BR>";
  
 }
/*
 echo "</BR>";echo "</BR>";echo "</BR>";
 
 echo "</BR>";
 for ($x = 0; $x < intval($numero_materiais); $x++) {
  echo "> ". $array_materiais[$x] ."</BR>";
}
echo "</BR>";
echo "</BR>";
echo "Agora dados referente ao mes ************************";
echo "</BR>";
echo "Numero de amostragens no mes = " . $amostrado_mes;
echo "</BR>";
echo "Numero de passagem pela balanca no mes = " . $encontrado_mes;
echo "</BR>";
echo "Aderencia no mes = " . $aderencia_mes;

echo "</BR>";echo "</BR>";echo "</BR>";

echo "Dados de transportadoras ******************";
echo "</BR>";
echo "Encontrados = " . $numero_trasportadoras;
echo "</BR>";
//var_dump($array_transportadoras);
//var_dump($array_lista_transportadoras);
*/
$array_v_transportadoras = (array_count_values($array_lista_transportadoras));
arsort($array_v_transportadoras);
$vezes=0;
$array_transp = [];
$array_v_transp = [];
foreach ($array_v_transportadoras as $key => $val) 
{
 $array_transp[$vezes] = $key;
 $array_v_transp[$vezes] = $val;
 $vezes = intval($vezes) + 1;
}
//var_dump($array_v_transp);
$tamanho_array = count($array_transp);
//echo "</BR>";
//echo "Tamanho do array é : " . $tamanho_array;
//echo "</BR>";
if(intval($tamanho_array)<=5)
{
 //echo $array_transp[0] .' : '. $array_v_transp[0];
 //echo "</BR>";
 //echo $array_transp[1] .' : '. $array_v_transp[1];
 //echo "</BR>";
 //echo $array_transp[2] .' : '. $array_v_transp[2];
 //echo "</BR>";
 //echo $array_transp[3] .' : '. $array_v_transp[3];
 //echo "</BR>";
 //echo $array_transp[4] .' : '. $array_v_transp[4];
 //echo "</BR>";
}
else
{
 // echo $array_transp[0] .' : '. $array_v_transp[0];
 // echo "</BR>";
 // echo $array_transp[1] .' : '. $array_v_transp[1];
 // echo "</BR>";
 // echo $array_transp[2] .' : '. $array_v_transp[2];
 // echo "</BR>";
 $faltam = intval($tamanho_array)-5;
 $quantidade = 0;
 for ($x = 0; $x < intval($faltam); $x++) 
 {
  $quantidade = intval($quantidade)+ intval($array_v_transp[5+intval($x)]);
 }
 //echo "Outros : " . $quantidade;
}















}

$total_turno1 = intval($v_turno1);
$total_turno2 = intval($v_turno2);
$total_turno3 = intval($v_turno3);
$total = intval($total_turno1) + intval($total_turno2) + intval($total_turno3); 

?>


<script>
  console.log(<?php print $encontrados ?>);
  </script>

<script type="text/javascript">
  
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Horario", "Numero Amostras",{ role: "style" }],
        ['00', <?php print $hora_zero ?>, "#00008B" ],
        ['01', <?php print $hora_um ?>, "#00008B"],
        ['02', <?php print $hora_dois ?>, "#00008B"],
        ['03', <?php print $hora_tres ?>, "#00008B"],
        ['04', <?php print $hora_quatro ?>, "#00008B"],
        ['05', <?php print $hora_cinco ?>, "#00008B"],
        ['06', <?php print $hora_seis ?>, "#00008B"],
        ['07', <?php print $hora_sete ?>, "#00008B"],
        ['08', <?php print $hora_oito ?>, "#00008B"],
        ['09', <?php print $hora_nove ?>, "#00008B"],
        ['10', <?php print $hora_dez ?>, "#00008B"],
        ['11', <?php print $hora_onze ?>, "#00008B"],
        ['12', <?php print $hora_doze ?>, "#00008B"],
        ['13', <?php print $hora_treze ?>, "#00008B"],
        ['14', <?php print $hora_quatorze ?>, "#00008B"],
        ['15', <?php print $hora_quinze ?>, "#00008B"],
        ['16', <?php print $hora_dezesseis ?>, "#00008B"],
        ['17', <?php print $hora_dezessete ?>, "#00008B"],
        ['18', <?php print $hora_dezoito ?>, "#00008B"],
        ['19', <?php print $hora_dezenove ?>, "#00008B"],
        ['20', <?php print $hora_vinte ?>, "#00008B"],
        ['21', <?php print $hora_vinte_e_um ?>, "#00008B"],
        ['22', <?php print $hora_vinte_e_dois ?>, "#00008B"],
        ['23', <?php print $hora_vinte_e_tres ?>, "#00008B"]
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '96%', 'height': '70%'},
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
      var numero_materiais = parseInt('<?php print $numero_materiais ?>');
      if(numero_materiais == 1)
      {
        var data = google.visualization.arrayToDataTable([
        ["Material", "Numero Amostras",{ role: "style" }],
        ['<?php print $array_materiais[0] ?>', <?php print $quantidade_material_zero ?>, "#00008B" ]
        
      ]);

      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '96%', 'height': '57%'},
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
          fontSize: 26,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "60%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);

      }
      else if (numero_materiais == 2)
      {
        var data = google.visualization.arrayToDataTable([
        ["Material", "Numero Amostras",{ role: "style" }],
        ['<?php print $array_materiais[0] ?>',  <?php print $quantidade_material_zero ?>, "#00008B" ],
        ['<?php print $array_materiais[1] ?>',  <?php print $quantidade_material_um ?>, "#00008B" ]
        
      ]);

      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '96%', 'height': '57%'},
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
          fontSize: 26,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "60%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);

      }
      else if (numero_materiais == 3)
      {
        var data = google.visualization.arrayToDataTable([
        ["Material", "Numero Amostras",{ role: "style" }],
        ['<?php print $array_materiais[0] ?>',  <?php print $quantidade_material_zero ?>, "#00008B" ],
        ['<?php print $array_materiais[1] ?>',  <?php print $quantidade_material_um ?>, "#00008B" ],
        ['<?php print $array_materiais[2] ?>',  <?php print $quantidade_material_dois ?>, "#00008B" ]
      ]);


      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '96%', 'height': '57%'},
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
          fontSize: 13,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "60%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);



      }
      else if (numero_materiais == 4)
      {
        var data = google.visualization.arrayToDataTable([
        ["Material", "Numero Amostras",{ role: "style" }],
        ['<?php print $array_materiais[0] ?>',  <?php print $quantidade_material_zero ?>, "#00008B" ],
        ['<?php print $array_materiais[1] ?>',  <?php print $quantidade_material_um ?>, "#00008B" ],
        ['<?php print $array_materiais[2] ?>',  <?php print $quantidade_material_dois ?>, "#00008B" ],
        ['<?php print $array_materiais[3] ?>',  <?php print $quantidade_material_tres ?>, "#00008B" ]
      ]);

      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '96%', 'height': '57%'},
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
          fontSize: 11,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "60%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);

      }
      else if (numero_materiais == 5)
      {
        var data = google.visualization.arrayToDataTable([
        ["Material", "Numero Amostras",{ role: "style" }],
        ['<?php print $array_materiais[0] ?>',  <?php print $quantidade_material_zero ?>, "#00008B" ],
        ['<?php print $array_materiais[1] ?>',  <?php print $quantidade_material_um ?>, "#00008B" ],
        ['<?php print $array_materiais[2] ?>',  <?php print $quantidade_material_dois ?>, "#00008B" ],
        ['<?php print $array_materiais[3] ?>',  <?php print $quantidade_material_tres ?>, "#00008B" ],
        ['<?php print $array_materiais[4] ?>',  <?php print $quantidade_material_quatro ?>, "#00008B" ]
      ]);  

      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '96%', 'height': '57%'},
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
          fontSize: 9,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "60%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);

      }
      

  }


</script>

<script type="text/javascript">
  // CRIA O GRAFICO DAS TRANSPORTADORAS ************************************************
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart_transportadora);

  function drawChart_transportadora()
  {   
   var cor_azul = "#00008B";
   var tamanho_array = parseInt('<?php print $tamanho_array ?>');
   if(tamanho_array <=5)
   {
    if(tamanho_array ==1)
    {
      var data = google.visualization.arrayToDataTable([
      ["Transportadora", "Quantidade", { role: "style" } ],
      ["", <?php print $array_v_transp[0] ?>,cor_azul]
      ]);

    }
    else if(tamanho_array == 2)
    {
      var data = google.visualization.arrayToDataTable([
      ["Transportadora", "Quantidade", { role: "style" } ],
      ["", <?php print $array_v_transp[0] ?>,cor_azul],
      ["", <?php print $array_v_transp[1] ?>,cor_azul]
      ]);

    }
    else if(tamanho_array == 3)
    {
      var data = google.visualization.arrayToDataTable([
      ["Transportadora", "Quantidade", { role: "style" } ],
      ["", <?php print $array_v_transp[0] ?>,cor_azul],
      ["", <?php print $array_v_transp[1] ?>,cor_azul],
      ["", <?php print $array_v_transp[2] ?>,cor_azul]
      ]);
      
    }    
    else if(tamanho_array == 4)
    {
      var data = google.visualization.arrayToDataTable([
      ["Transportadora", "Quantidade", { role: "style" } ],
      ["", <?php print $array_v_transp[0] ?>,cor_azul],
      ["", <?php print $array_v_transp[1] ?>,cor_azul],
      ["", <?php print $array_v_transp[2] ?>,cor_azul],
      ["", <?php print $array_v_transp[3] ?>,cor_azul]
      ]);
      
    }
    else if(tamanho_array == 5)
    {
      var data = google.visualization.arrayToDataTable([
      ["Transportadora", "Quantidade", { role: "style" } ],
      ["", <?php print $array_v_transp[0] ?>,cor_azul],
      ["", <?php print $array_v_transp[1] ?>,cor_azul],
      ["", <?php print $array_v_transp[2] ?>,cor_azul],
      ["", <?php print $array_v_transp[3] ?>,cor_azul],  
      ['', <?php print $array_v_transp[4] ?>,cor_azul]
      ]);
    }        
   }
   else
   {
    var data = google.visualization.arrayToDataTable([
      ["Transportadora", "Quantidade", { role: "style" } ],
      ["", <?php print $array_v_transp[0] ?>,cor_azul],
      ["", <?php print $array_v_transp[1] ?>,cor_azul],
      ["", <?php print $array_v_transp[2] ?>,cor_azul],
      ["", <?php print $array_v_transp[3] ?>,cor_azul],  
      ['', <?php print $quantidade ?>,cor_azul]
      ]);

   }





   var view = new google.visualization.DataView(data);
   view.setColumns([0, 1,
   { calc: "stringify",
   sourceColumn: 1,
   type: "string",
   role: "annotation" },
   2]);

   var options = {
    'chartArea': {'width': '64%', 'height': '60%'},
    fontSize: 14,
    
    vAxis: {minValue: 0, viewWindow: {value: 1}, gridlines: {"color": "#f2f2f2", "count": 2}, baselineColor: "#f2f2f2"},
    hAxis: {minValue: 0,viewWindow: {min:0.1},gridlines: {"color": cor_azul},baselineColor: cor_azul},
    bar: {groupWidth: "75%"},
    legend: { position: "none" },
   };
   var chart_transportadora = new google.visualization.BarChart(document.getElementById("grafico_encerramentos3"));
   chart_transportadora.draw(view, options);
  }









</script>



<div id="grafico_encerramentos" >


</div> 

    
<div id="grafico_encerramentos2" ></div> 

<div id="grafico_encerramentos3" ></div> 
<div id="grafico_encerramentos4" ></div> 

<label id='titulo1' name='titulo1' onclick="javascript: location.href='./tela_mensagem.php'" >Amostragem Várzea do Lopes referente ao dia <?php print $data ?></label>
<label id='titulo5' name='titulo5' >Materiais amostrados</label>
<label id='titulo6' name='titulo6' >>>> Tempo médio amostragem = <?php print $tempo_medio ?> <<<</label>

<label id='v_turno1' name='v_turno1'>1° turno: <?php print $total_turno1 ?></label>
<label id='v_turno2' name='v_turno2'>2° turno: <?php print $total_turno2 ?></label>
<label id='v_turno3' name='v_turno3'>3° turno: <?php print $total_turno3 ?></label>
<label id='v_aderencia' name='v_aderencia'>(A) <?php print $numero_amostragem ?> / ( V ) <?php print $numero_passagem_pela_balanca2 ?></label>
<label id='v_aderencia2' name='v_aderencia2'><?php print $aderencia_dia ?></label>

<label id='v_titulo21' name='v_titulo21'>Amostras x Transportadoras</label>
<label id='v_transportadora1' name='v_transportadora1'></label>
<label id='v_transportadora2' name='v_transportadora2'></label>
<label id='v_transportadora3' name='v_transportadora3'></label>
<label id='v_transportadora4' name='v_transportadora4'></label>
<label id='v_transportadora5' name='v_transportadora5'></label>

<label id='v_titulo2' name='v_titulo2'>Mês de <?php print $nome_mes ?></label>
<label id='v_mes_n_amostras' name='v_mes_n_amostras'>N° Amostras:</label>
<label id='v_mes_n_amostras2' name='v_mes_n_amostras2'><?php print $amostrado_mes ?></label>
<label id='v_mes_n_viajens' name='v_mes_n_viajens'>N° Viagens:</label>
<label id='v_mes_n_viajens2' name='v_mes_n_viajens2'><?php print $encontrado_mes ?></label>
<label id='v_mes_n_aderencia' name='v_mes_n_aderencia'>Aderência :</label>
<label id='v_mes_n_aderencia2' name='v_mes_n_aderencia2'><?php print $aderencia_mes ?></label>
<img id='semaforo' src='./images/semaforo_verde.png'/>
</body>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



<script>
var tamanho_array = parseInt('<?php print $tamanho_array ?>')  ;
console.log(tamanho_array);
if(tamanho_array ==1)
{
  document.getElementById('v_transportadora1').innerHTML = '<?php print $array_transp[0]?>';
}
else if(tamanho_array ==2)
{
  document.getElementById('v_transportadora1').innerHTML = '<?php print $array_transp[0]?>';
  document.getElementById('v_transportadora2').innerHTML = '<?php print $array_transp[1]?>';
}
else if(tamanho_array ==3)
{
  document.getElementById('v_transportadora1').innerHTML = '<?php print $array_transp[0]?>';
  document.getElementById('v_transportadora2').innerHTML = '<?php print $array_transp[1]?>';
  document.getElementById('v_transportadora3').innerHTML = '<?php print $array_transp[2]?>';
}
else if(tamanho_array ==4)
{
  document.getElementById('v_transportadora1').innerHTML = '<?php print $array_transp[0]?>';
  document.getElementById('v_transportadora2').innerHTML = '<?php print $array_transp[1]?>';
  document.getElementById('v_transportadora3').innerHTML = '<?php print $array_transp[2]?>';
  document.getElementById('v_transportadora4').innerHTML = '<?php print $array_transp[3]?>';
}
else if(tamanho_array ==5)
{
  document.getElementById('v_transportadora1').innerHTML = '<?php print $array_transp[0]?>';
  document.getElementById('v_transportadora2').innerHTML = '<?php print $array_transp[1]?>';
  document.getElementById('v_transportadora3').innerHTML = '<?php print $array_transp[2]?>';
  document.getElementById('v_transportadora4').innerHTML = '<?php print $array_transp[3]?>';
  document.getElementById('v_transportadora5').innerHTML = '<?php print $array_transp[4]?>';
}
else if (tamanho_array >5)
{
  document.getElementById('v_transportadora1').innerHTML = '<?php print $array_transp[0]?>';
  document.getElementById('v_transportadora2').innerHTML = '<?php print $array_transp[1]?>';
  document.getElementById('v_transportadora3').innerHTML = '<?php print $array_transp[2]?>';
  document.getElementById('v_transportadora4').innerHTML = '<?php print $array_transp[3]?>';
  document.getElementById('v_transportadora5').innerHTML = 'Outros ';
}

//var link_vezes = '<?php print $vezes ?>';
//var link_nvezes = '<?php print $nvezes ?>';
//var link_tempo = '<?php print $tempo ?>';
/*
//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
 //location.href='./dashboard_utmi.php?vezes=0';//Por default passo 2 vezes apenas

 window.setTimeout( "location.href=`./dashboard_excesso_mb_lmn.php?vezes=0&nvezes=3&tempo=30000`");
}
else
{
 if(link_vezes != '-1')
 {
   window.setTimeout( "location.href=`./tela_veiculos_dashboard.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}
*/





function verifica_tela()
{
 //var lb_tempo = document.getElementById('lb_tempo').innerHTML;
 setInterval(function() 
  {
    $.ajax({
           url: './busca_valor_tela.php',
           type: 'GET',          
           success: function(resultado)
           {
               console.log('Tela : '+resultado);
               if(parseInt(resultado)==0)
               {
                monitora_vezes = parseInt(monitora_vezes) + 1;
               }
               if(monitora_vezes == 60)
               {
                //Reinicia a pagina
                location.href = "./tela_amostragem.php";
               }
               if(parseInt(resultado)==1)
               {
                location.href = "./tela_mensagem.php";
               }
           }
        });
        $.ajax({
           url: './busca_valor_semaforo.php',
           type: 'GET',          
           success: function(resultado)
           {
               console.log('semaforo : '+resultado);
               if(resultado.trim()=="verde")
               {
                document.getElementById('semaforo').src="./images/semaforo_verde.png";
               }
               else if(resultado.trim()=="vermelho")
               {
                document.getElementById('semaforo').src="./images/semaforo_vermelho.png";
               }
               else
               {
                document.getElementById('semaforo').src="./images/semaforo_apagado.png";
               }
           }
        });
 



  },1000);        
}


var monitora_vezes = 0;


var valor_v_aderencia2 = parseInt(document.getElementById('v_aderencia2').innerHTML);
console.log("v_aderencia2 = " + valor_v_aderencia2);

var valor_v_mes_n_aderencia2 = parseInt(document.getElementById('v_mes_n_aderencia2').innerHTML);
console.log("v_mes_n_aderencia2 = " + valor_v_mes_n_aderencia2);


if( valor_v_aderencia2 < 80)
{
  //Cor vermelha
  document.getElementById('v_aderencia2').style.color='rgb(200,20,10)';
}
else
{
  //cor verde
  document.getElementById('v_aderencia2').style.color='rgb(0,200,20)';
}


if( valor_v_mes_n_aderencia2 < 80)
{
  //Cor vermelha
  document.getElementById('v_mes_n_aderencia2').style.color='rgb(200,20,10)';
}
else
{
  //cor verde
  document.getElementById('v_mes_n_aderencia2').style.color='rgb(0,200,20)';
}



verifica_tela();





</script>


<style>
LABEL#v_titulo21
{
  position: absolute;
  left: 72%;
  top: 16%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#v_transportadora1
{
  position: absolute;
  left: 69%;
  top: 22.3%;
  font: normal 10pt verdana;
  color:	#000000;
  width: 8%;
  height: 3.2%;
  text-align: right;
  background-color: transparent;
}
LABEL#v_transportadora2
{
  position: absolute;
  left: 69%;
  top: 26.3%;
  font: normal 10pt verdana;
  color:	#000000;
  width: 8%;
  height: 3.2%;
  text-align: right;
  background-color: transparent;
}
LABEL#v_transportadora3
{
  position: absolute;
  left: 69%;
  top: 30.3%;
  font: normal 10pt verdana;
  color:	#000000;
  width: 8%;
  height: 3.2%;
  text-align: right;
  background-color: transparent;
}
LABEL#v_transportadora4
{
  position: absolute;
  left: 69%;
  top: 34.3%;
  font: normal 10pt verdana;
  color:	#000000;
  width: 8%;
  height: 3.2%;
  text-align: right;
  background-color: transparent;
}
LABEL#v_transportadora5
{
  position: absolute;
  left: 69%;
  top: 38.3%;
  font: normal 10pt verdana;
  color:	#000000;
  width: 8%;
  height: 3.2%;
  text-align: right;
  background-color: transparent;
}


LABEL#v_titulo2
{
  position: absolute;
  left: 69%;
  top: 53%;
  font: bold 22pt verdana;
  color:	#000000;
  width: 28.5%;
  height: 4%;
  text-align: center;
  background-color: transparent;
}

IMG#semaforo
{
  position: absolute;
  left: 91%;
  top: 60%;
  width: 100px;
  height: 120px;
  font: bold 18pt verdana;
  color:	#000000;
}

LABEL#v_mes_n_amostras
{
  position: absolute;
  left: 70%;
  top: 60%;
  font: bold 18pt verdana;
  color:	#000000;
}
LABEL#v_mes_n_amostras2
{
  position: absolute;
  left: 83%;
  top: 59.2%;
  padding-left:  20px;
  font: bold 30pt verdana;
  color:	#00008B;
}

LABEL#v_mes_n_viajens
{
  position: absolute;
  left: 70%;
  top: 67%;
  font: bold 18pt verdana;
  color:	#000000;
}
LABEL#v_mes_n_viajens2
{
  position: absolute;
  left: 83%;
  top: 66.2%;
  font: bold 30pt verdana;
  color:	#00008B;
}

LABEL#v_mes_n_aderencia
{
  position: absolute;
  left: 70%;
  top: 74%;
  font: bold 18pt verdana;
  color:	#000000;
}
LABEL#v_mes_n_aderencia2
{
  position: absolute;
  left: 83%;
  top: 73.2%;
  font: bold 30pt verdana;
  color:	rgb(0,0,0);
}









#lb_marcacao{
    margin-left: 0px;
    position: absolute;
    left: 86.5%;
    top: 2.5%;
    font: bold 12pt verdana;
    
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


LABEL#titulo1
{
  position: absolute;
  text-align: center;
  left: 0%;
  top: 2.5%;
  width: 100%;
  font: bold 28pt verdana;
  color:#00008B;
  background-color: transparent;
}
LABEL#titulo5
{
  position: absolute;
  text-align: center;
  left: 2.5%;
  width: 64.8%;
  top: 53%;
  font: bold 22pt verdana;
  color:	#000000;
}
LABEL#titulo6
{
  position: absolute;
  text-align: center;
  left: 2.5%;
  width: 64.8%;
  top: 57%;
  font: bold 14pt verdana;
  color:	#00008B;
  background-color: transparent;
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
  left: 5%;
  top: 16%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#v_turno2
{
  position: absolute;
  left: 18%;
  top: 16%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#v_turno3
{
  position: absolute;
  left: 31%;
  top: 16%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#v_aderencia
{
  position: absolute;
  left: 43%;
  top: 16%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#v_aderencia2
{
  position: absolute;
  left: 59.5%;
  top: 16%;
  font: bold 16pt verdana;
  color:	rgb(0,0,0);
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
LABEL#v_aderenciam
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
    left: 2%;
    top: 12%;
    width: 65%;
    height: 31%;
    padding-top: 3%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #FFFFFF;

}
DIV#grafico_encerramentos2{
    padding-left: 0px;
    position: absolute;
    left: 2%;
    top: 51%;
    width: 65%;
    height: 42%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;
    

}
DIV#grafico_encerramentos3{
    padding-top: 20px;
    padding-left: 60px;
    position: absolute;
    left: 68.5%;
    top: 12%;
    width: 25%;
    height: 34%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(255,255,255);
    

}


DIV#grafico_encerramentos4{
    padding-top:20px;
    padding-left: 20px;
    position: absolute;
    left: 68.5%;
    top: 51%;
    width: 28%;
    height: 39.5%;
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
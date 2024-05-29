<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Resumo Giro</title>
</head>
<body>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_vl.php?vezes=0'"/>

<?php
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
//$hora = date('H:i:s');
$vdata = explode('/',$data);
$dia = intval($vdata[0]);
$mes = intval($vdata[1]);
$ano = intval($vdata[2]);
$numero_tabela = 0;
$pesquisa_mes = 'mes_'.intval($mes); //exemplo mes_8
$pesquisa_ano = 'ano_2022';
$encontrados = 0;


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
if($mes == '1'){$nome_mes = 'Janeiro';}
else if($mes == '2'){$nome_mes = 'Fevereiro';}
else if($mes == '3'){$nome_mes = 'Março';}
else if($mes == '4'){$nome_mes = 'Abril';}
else if($mes == '5'){$nome_mes = 'Maio';}
else if($mes == '6'){$nome_mes = 'Junho';}
else if($mes == '7'){$nome_mes = 'Julho';}
else if($mes == '8'){$nome_mes = 'Agosto';}
else if($mes == '9'){$nome_mes = 'Setembro';}
else if($mes == '10'){$nome_mes = 'Outubro';}
else if($mes == '11'){$nome_mes = 'Novembro';}
else{$nome_mes = 'Dezembro';}
//************************************************************************************

$encontrados_transportadoras_dia = 0;
$nome_transportadora = array();
$nome_transportadora_foto = array();
$quantidade_transportadora = array();


$numero_viajens = 0;
$numero_motoristas = 0;

$encontrados_transportadoras_mes = 0;
$nome_transportadora_mes = array();
$nome_transportadora_foto_m = array();
$quantidade_transportadora_mes = array();

if(intval($mes)>6)
{
 $numero_tabela = 2;
 $pesquisa_dia = 'mes'.(intval($mes)-6).'_dia_'.$dia; //exemplo mes1_dia4
}   
else
{
 $numero_tabela = 1;
 $pesquisa_dia = 'mes'.intval($mes).'_dia_'.$dia; //exemplo mes1_dia4
}


//AGORA BUSCO O RANKING DAS TRANSPORTADORAS NO DIA
$tabela = 'cadastro_motoristas'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_transportadoras1, senão busca no no cadastro_transportadoras2

echo $pesquisa_dia;

//echo $tabela;
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE $pesquisa_dia!='0' ");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $numero_motoristas = intval($numero_motoristas)+1;
  $numero_viajens = intval($numero_viajens) + intval($dados[$pesquisa_dia]); 
 }
}


echo "</BR> Numero de viajens : " . $numero_motoristas;
echo "</BR> Numero de viajens : " . $numero_viajens;
echo "</BR> Giro : " . floatval(($numero_viajens)/($numero_motoristas));
?>



</body>
</html>
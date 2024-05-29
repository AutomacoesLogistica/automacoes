<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<?php

//Teste em get na url
//?id=32149&epc=442002000000000000001547&placa=RFJ7I64&sigla=Cooperauto&data=03/11/2023&mes=11&ano=2023&hora=14:32:08&uf=BR&local_instalacao=Miguel Burnier&ca=KA16005925&turno=L&operador=Nao definido



$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
$placa = isset($_GET['placa'])?$_GET['placa']:'vazio';
if($placa = 'Não encontrada!'){$placa = '-';}
$sigla = isset($_GET['sigla'])?$_GET['sigla']:'vazio';
if($sigla = 'Não identificada!'){$sigla = '-';}
$data = isset($_GET['data'])?$_GET['data']:'vazio';
$mes = isset($_GET['mes'])?$_GET['mes']:'vazio';
$ano = isset($_GET['ano'])?$_GET['ano']:'vazio';
$hora = isset($_GET['hora'])?$_GET['hora']:'vazio';
$uf = isset($_GET['uf'])?$_GET['uf']:'vazio';
$local_instalacao = isset($_GET['local_instalacao'])?$_GET['local_instalacao']:'vazio';
$ca = isset($_GET['ca'])?$_GET['ca']:'vazio';
$turno = isset($_GET['turno'])?$_GET['turno']:'vazio';
$operador = isset($_GET['operador'])?$_GET['operador']:'vazio';
$id = isset($_GET['id'])?$_GET['id']:'vazio';
  

echo "ID = " . $id;
echo "</BR>";
echo "EPC = ". $epc;
echo "</BR>";
echo "Placa = " . $placa;
echo "</BR>";
echo "Sigla = " . $sigla;
echo "</BR>";
echo "Data = " . $data;
echo "</BR>";
echo "Mes = " . $mes;
echo "</BR>";
echo "Ano = " . $ano;
echo "</BR>";
echo "Hora = " . $hora;
echo "</BR>";
echo "UF = " . $uf;
echo "</BR>";
echo "Local Instalacao = " . $local_instalacao;
echo "</BR>";
echo "CA = " . $ca;
echo "</BR>";
echo "Turno = " . $turno;
echo "</BR>";
echo "Operador = " . $operador;
echo "</BR>";






//Salvo agora na sala da logistica

if($epc != 'vazio')
{
 include_once 'conexao.php';
 $sql = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano' ,'$hora','$uf','$local_instalacao','$ca', '$turno','$operador')");
 //$sql = $dbcon->query("INSERT INTO lista_excesso_mb(epc)VALUES('$epc')");
}
else
{
  echo "Erro parametros";  
}

//Atualizo o banco como tratado
if ( $id != 'vazio')
{
 include_once 'conexao_excesso.php';
 $sql = $dbcon->query("UPDATE lista_excesso_mb SET sala_log = 'Sim' WHERE id='$id'");
}    




?>
</html>
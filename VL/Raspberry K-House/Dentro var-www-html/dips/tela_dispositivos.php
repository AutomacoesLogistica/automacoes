<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_vl.php?vezes=0'"/>
<div id='dispositivos'>




</div>

<script>
    var verde = 'green';
    var vermelho = 'red';

</script>
<?php 

//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
//atualizo dashboard
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");


$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
if($tempo == '-1'){$tempo = 10000;}
if($nvezes == '-1'){$nvezes = 5;}
if($vezes != '-1'){$vezes = intval($vezes)+1;}



if($vezes == -1)
{

}
else
{
 $vezes = intval($vezes)+1;   
}


$online = 0;
$offline = 0;
$antena_ok = 0;
$antena_erro = 0;

$nome_equipamento = 'Entrada CO';
$horario1 = '12/04/2022 12:22:33';
?>



</body>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<label id='titulo1' name='titulo1' >Lista dos dispositivos de Automação</label>



<!-- PRIMEIRO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Entrada CO';

include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento1' name='equipamento1' ><?php print $nome_equipamento ?></label>
<label id='data1' name='data1' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry1" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry1();'/>
 <script>document.getElementById('data1').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry1" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry1();'/>
 <script>document.getElementById('data1').style.color=vermelho;</script>
 <?php
 
 $offline = intval($offline)+1;
}

//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry1_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;

}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry1_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}

if($antena1 == 'OK')
{
  ?>
  <img id="raspberry1_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry1_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry1_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry1_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry1_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry1_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';

?>

<!-- **********************************************************************************************-->



<!-- SEGUNDO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Entrada BH';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento2' name='equipamento2' ><?php print $nome_equipamento ?></label>
<label id='data2' name='data2' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry2" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry2();'/>
 <script>document.getElementById('data2').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry2" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry2();'/>
 <script>document.getElementById('data2').style.color=vermelho;</script>
 <?php
   
   $offline = intval($offline)+1;
}


if($antena0 == 'OK')
{
  ?>
  <img id="raspberry2_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry2_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena1 == 'OK')
{
  ?>
  <img id="raspberry2_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry2_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry2_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry2_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry2_antena3" src="./images/antena_ok_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry2_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';







?>




<!-- **********************************************************************************************-->


<!-- TERCEIRO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Controle 1';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento3' name='equipamento3' ><?php print $nome_equipamento ?></label>
<label id='data3' name='data3' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry3" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry3();' />
 <script>document.getElementById('data3').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry3" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry3();'/>
 <script>document.getElementById('data3').style.color=vermelho;</script>
 <?php
   
   $offline = intval($offline)+1;
}

//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry3_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry3_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry3_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry3_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry3_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry3_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry3_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry3_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';




?>



<!-- ******          -->



<!-- QUARTO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Controle 2';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento4' name='equipamento4' ><?php print $nome_equipamento ?></label>
<label id='data4' name='data4' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry4" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry4();'/>
 <script>document.getElementById('data4').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry4" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry4();' />
 <script>document.getElementById('data4').style.color=vermelho;</script>
 <?php
  
   $offline = intval($offline)+1;
}


//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry4_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry4_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry4_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry4_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry4_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry4_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry4_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry4_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';






?>



<!-- ******          -->



<!-- QUINTO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Controle 3';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento5' name='equipamento5' ><?php print $nome_equipamento ?></label>
<label id='data5' name='data5' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry5" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry5();'/>
 <script>document.getElementById('data5').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry5" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry5();'/>
 <script>document.getElementById('data5').style.color=vermelho;</script>
 <?php
   
   $offline = intval($offline)+1;
}


//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry5_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry5_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry5_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry5_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry5_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry5_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry5_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry5_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';


?>



<!-- ******          -->




<!-- SEXTO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Balanca 1';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento6' name='equipamento6' ><?php print $nome_equipamento ?></label>
<label id='data6' name='data6' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry6" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry6();'/>
 <script>document.getElementById('data6').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry6" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry6();'/>
 <script>document.getElementById('data6').style.color=vermelho;</script>
 <?php
   
   $offline = intval($offline)+1;
}




//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry6_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry6_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry6_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry6_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry6_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry6_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry6_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry6_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';
?>



<!-- ******          -->



<!-- SETIMA DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Balanca 2';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento7' name='equipamento7' ><?php print $nome_equipamento ?></label>
<label id='data7' name='data7' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry7" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry7();'/>
 <script>document.getElementById('data7').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry7" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry7();'/>
 <script>document.getElementById('data7').style.color=vermelho;</script>
 <?php
   
   $offline = intval($offline)+1;
}



//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry7_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry7_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry7_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry7_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry7_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry7_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry7_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry7_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';
?>



<!-- ******          -->






<!-- OITAVO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Balanca 3';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento8' name='equipamento8' ><?php print $nome_equipamento ?></label>
<label id='data8' name='data8' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry8" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry8();'/>
 <script>document.getElementById('data8').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry8" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry8();'/>
 <script>document.getElementById('data8').style.color=vermelho;</script>
 <?php
 
 $offline = intval($offline)+1;  
}



//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry8_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry8_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry8_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry8_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry8_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry8_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry8_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry8_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';
?>



<!-- ******          -->






<!-- NONO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Excesso';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento9' name='equipamento9' ><?php print $nome_equipamento ?></label>
<label id='data9' name='data9' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry9" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry9();'/>
 <script>document.getElementById('data9').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry9" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry9();'/>
 <script>document.getElementById('data9').style.color=vermelho;</script>
 <?php
 
 $offline = intval($offline)+1;  
}


//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry9_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry9_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry9_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry9_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry9_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry9_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry9_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry9_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';

?>



<!-- ******          -->



<!-- DECIMO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Amostragem';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento10' name='equipamento10' ><?php print $nome_equipamento ?></label>
<label id='data10' name='data10' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry10" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry10();'/>
 <script>document.getElementById('data10').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry10" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry10();'/>
 <script>document.getElementById('data10').style.color=vermelho;</script>
 <?php
 
 $offline = intval($offline)+1;  
}


//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry10_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry10_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry10_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry10_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry10_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;

  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry10_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
  
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry10_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry10_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';
?>



<!-- ******          -->



<!-- DECIMO PRIMEIRO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Saida CO';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento11' name='equipamento11' ><?php print $nome_equipamento ?></label>
<label id='data11' name='data11' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry11" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry11();'/>
 <script>document.getElementById('data11').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry11" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry11();'/>
 <script>document.getElementById('data11').style.color=vermelho;</script>
 <?php
 
 $offline = intval($offline)+1;  
}

//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry11_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry11_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry11_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;

}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry11_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry11_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry11_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry11_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry11_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';
?>



<!-- ******          -->





<!-- DECIMO SEGUNDO DISPOSITIVO ****************************************************************************-->
<?php
$nome_equipamento = 'Saida BH';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$nome_equipamento' ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $condicao = $dados['condicao'];
 $data_atualizacao = $dados['data_atualizacao'];
 $hora_atualizacao = $dados['hora_atualizacao'];
 $numero_antenas=$dados['numero_antenas'];
 $antena0 = $dados['antena0'];
 $antena1 = $dados['antena1'];
 $antena2 = $dados['antena2'];
 $antena3 = $dados['antena3'];
}
$horario = $data_atualizacao . ' ' . $hora_atualizacao;

?>
<label id='equipamento12' name='equipamento12' ><?php print $nome_equipamento ?></label>
<label id='data12' name='data12' ><?php print $horario ?></label>
<?php
if($condicao == 'OK')
{
 ?>
 <img id="raspberry12" src="./images/raspberry_ok.png" onclick='clicou_img_raspberry12();'/>
 <script>document.getElementById('data12').style.color=verde;</script>
 <?php
 $online = intval($online)+1;
 
}
else
{
 ?>
 <img id="raspberry12" src="./images/raspberry_erro.png" onclick='clicou_img_raspberry12();'/>
 <script>document.getElementById('data12').style.color=vermelho;</script>
 <?php
 
 $offline = intval($offline)+1;  
}


//TRATO AS ANTENAS
if($antena0 == 'OK')
{
  ?>
  <img id="raspberry12_antena0" src="./images/antena_ok_0.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena0 == 'Erro')
{
  ?>
  <img id="raspberry12_antena0" src="./images/antena_erro_0.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena1 == 'OK')
{
  ?>
  <img id="raspberry12_antena1" src="./images/antena_ok_1.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;

}
else if($antena1 == 'Erro')
{
  ?>
  <img id="raspberry12_antena1" src="./images/antena_erro_1.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



if($antena2 == 'OK')
{
  ?>
  <img id="raspberry12_antena2" src="./images/antena_ok_2.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena2 == 'Erro')
{
  ?>
  <img id="raspberry12_antena2" src="./images/antena_erro_2.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}


if($antena3 == 'OK')
{
  ?>
  <img id="raspberry12_antena3" src="./images/antena_ok_3.png" />
  <?php
  $antena_ok = intval($antena_ok)+1;
  
}
else if($antena3 == 'Erro')
{
  ?>
  <img id="raspberry12_antena3" src="./images/antena_erro_3.png" />
  <?php
  
  $antena_erro = intval($antena_erro)+1;
}
else
{
 //Nem faz nada!
}



$antena0 = '';
$antena1 = '';
$antena2 = '';
$antena3 = '';
?>



<!-- ******          -->




<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  
  <script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var tamanho_array = parseInt(<?php print intval($encontrados) ?>);

    console.log(tamanho_array);
     

    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
       ['Data', 'Onlines',{ role: "style" },{ role: "annotation" } ],
       ['Onlines', <?php print $online ?>,"green",''],
       ['Offlines/Desligados',<?php print $offline ?> ,"red", '']
     
     ]);
    
  
     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2, 
                      3,
                      { calc: "stringify",
                        sourceColumn: 3,
                        type: "string",
                        role: "annotation" },
                   ]);

                      var options = {
    
       'chartArea': {'width': '90%', 'height': '40%'},
 
       legend: { position: 'none', maxLines: 3 },
       bar: {groupWidth: "60%"},
       isStacked: false,
       backgroundColor: '#F8F8FF',
       
       annotations: 
       {
        textStyle: 
        {
         fontName: 'Times-Roman',
         fontSize: 28,
         bold: false,
         italic: false,
         color: '#000000',
         auraColor: 'black',
         opacity: 1
        }
       },


    hAxis: {
      textStyle: {
        fontSize: 16,
        color: 'black' // Cor das legendas embaixo das colunas
      },
    },
    vAxis: {
        textPosition: 'none',
        gridlines: {
            color: 'transparent' //cor das grades de fundo do gráfico
        }
    },
   



       
     };
    
     var chart = new google.visualization.ColumnChart(document.getElementById("grafico_1"));
     chart.draw(view, options);
    }
 </script>









<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  
  <script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var tamanho_array = parseInt(<?php print intval($encontrados) ?>);

    console.log(tamanho_array);
     

    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
       ['Data', 'Onlines',{ role: "style" },{ role: "annotation" } ],
       ['OK', <?php print $antena_ok ?>,"green",''],
       ['Erro',<?php print $antena_erro ?> ,"red", '']
     
     ]);
    
  
     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2, 
                      3,
                      { calc: "stringify",
                        sourceColumn: 3,
                        type: "string",
                        role: "annotation" },
                   ]);

                      var options = {
    
       'chartArea': {'width': '90%', 'height': '40%'},
 
       legend: { position: 'none', maxLines: 3 },
       bar: {groupWidth: "60%"},
       isStacked: false,
       backgroundColor: '#F8F8FF',
       
       annotations: 
       {
        textStyle: 
        {
         fontName: 'Times-Roman',
         fontSize: 28,
         bold: false,
         italic: false,
         color: '#000000',
         auraColor: 'black',
         opacity: 1
        }
       },


    hAxis: {
      textStyle: {
        fontSize: 16,
        color: 'black' // Cor das legendas embaixo das colunas
      },
    },
    vAxis: {
        textPosition: 'none',
        gridlines: {
            color: 'transparent' //cor das grades de fundo do gráfico
        }
    },
   



       
     };
    
     var chart = new google.visualization.ColumnChart(document.getElementById("grafico_2"));
     chart.draw(view, options);
    }
 </script>











<div id="grafico_1"></div> 



<div id="grafico_2"></div> 



<label id='titulo2' name='titulo2' >Equipamentos</label>
<label id='titulo3' name='titulo3' >Antenas</label>



<script>

function clicou_img_raspberry1()
{
 //alert('Clicou no primeiro');  
 location.href='./tela_grafico_dispositivo.php?ponto=Entrada_CO';
}
function clicou_img_raspberry2()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Entrada_BH';
}
function clicou_img_raspberry3()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Controle_1';
}
function clicou_img_raspberry4()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Controle_2';
}
function clicou_img_raspberry5()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Controle_3';
}
function clicou_img_raspberry6()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Balanca_1';
}
function clicou_img_raspberry7()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Balanca_2';
}
function clicou_img_raspberry8()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Balanca_3';
}
function clicou_img_raspberry9()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Excesso';
}
function clicou_img_raspberry10()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Amostragem';
}
function clicou_img_raspberry11()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Saida_CO';
}
function clicou_img_raspberry12()
{
 //alert('Clicou no segundo');  
 location.href='./tela_grafico_dispositivo.php?ponto=Saida_BH';
}
</script>









<script>

var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 3)
{
 location.href='http://192.168.30.124/gagf/dashboard_excesso_vl.php?vezes=0';
 //location.href='./dashboard_vl.php?vezes=0';
}
else
{
 if(link_vezes != '-1')
 {
    window.setTimeout( "location.href=`./tela_dispositivos.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}
</script>




<style>

DIV#grafico_1{
    margin-left: 0px;
    position: absolute;
    left: 54%;
    top: 55%;
    width: 19%;
    height: 30%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 4px #000000 solid!important;
    background-color: #F8F8FF;

}
DIV#grafico_2{
    margin-left: 0px;
    position: absolute;
    left: 75%;
    top: 55%;
    width: 19%;
    height: 30%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 4px #000000 solid!important;
    background-color: #F8F8FF;

}

LABEL#titulo1
{
  position: absolute;
  left: 32%;
  top: 5%;
  font: bold 22pt verdana;
  color:	#000000;
}

LABEL#titulo2
{
  position: absolute;
  left: 58.5%;
  top: 57%;
  font: bold 14pt verdana;
  color:	#000000;
}

LABEL#titulo3
{
  position: absolute;
  left: 81%;
  top: 57%;
  font: bold 14pt verdana;
  color:	#000000;
}



IMG#raspberry1{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 15%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento1
{
  position: absolute;
  left: 12%;
  top: 17%;
  font: bold 14pt verdana;
  color:	#000000;
}

LABEL#data1
{
  position: absolute;
  left: 20.5%;
  top: 17%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry1_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry1_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry1_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry1_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}




IMG#raspberry2{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 24%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento2
{
  position: absolute;
  left: 12%;
  top: 26%;
  font: bold 14pt verdana;
  color:	#000000;
}
LABEL#data2
{
  position: absolute;
  left: 20.5%;
  top: 26%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry2_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry2_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry2_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry2_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

















IMG#raspberry3{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 33%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento3
{
  position: absolute;
  left: 12%;
  top: 35%;
  font: bold 14pt verdana;
  color:	#000000;
}
LABEL#data3
{
  position: absolute;
  left: 20.5%;
  top: 35%;
  font: normal 14pt verdana;
  color:	#000000;
}


IMG#raspberry3_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry3_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry3_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry3_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}



IMG#raspberry4{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 42%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento4
{
  position: absolute;
  left: 12%;
  top: 44%;
  font: bold 14pt verdana;
  color:	#000000;
}
LABEL#data4
{
  position: absolute;
  left: 20.5%;
  top: 44%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry4_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry4_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry4_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry4_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}



IMG#raspberry5{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 51%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento5
{
  position: absolute;
  left: 12%;
  top: 53%;
  font: bold 14pt verdana;
  color:	#000000;
}

LABEL#data5
{
  position: absolute;
  left: 20.5%;
  top: 53%;
  font: normal 14pt verdana;
  color:	#000000;
}


IMG#raspberry5_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 51%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry5_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
    top: 51%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry5_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 51%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry5_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
    top: 51%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}




IMG#raspberry6{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 60%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento6
{
  position: absolute;
  left: 12%;
  top: 62%;
  font: bold 14pt verdana;
  color:	#000000;
}

LABEL#data6
{
  position: absolute;
  left: 20.5%;
  top: 62%;
  font: normal 14pt verdana;
  color:	#000000;
}


IMG#raspberry6_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
   top: 60%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry6_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
   top: 60%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry6_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
   top: 60%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry6_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
   top: 60%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}


IMG#raspberry7{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 69%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento7
{
  position: absolute;
  left: 12%;
  top: 71%;
  font: bold 14pt verdana;
  color:	#000000;
}

LABEL#data7
{
  position: absolute;
  left: 20.5%;
  top: 71%;
  font: normal 14pt verdana;
  color:	#000000;
}



IMG#raspberry7_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
  top: 69%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry7_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
  top: 69%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry7_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
  top: 69%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry7_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
  top: 69%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}




IMG#raspberry8{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 78%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento8
{
  position: absolute;
  left: 12%;
  top: 80%;
  font: bold 14pt verdana;
  color:	#000000;
}


LABEL#data8
{
  position: absolute;
  left: 20.5%;
  top: 80%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry8_antena0{
    margin-left: 0px;
    position: absolute;
    left: 35%;
  top: 78%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry8_antena1{
    margin-left: 0px;
    position: absolute;
    left: 38.5%;
  top: 78%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry8_antena2{
    margin-left: 0px;
    position: absolute;
    left: 42%;
  top: 78%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry8_antena3{
    margin-left: 0px;
    position: absolute;
    left: 45.5%;
  top: 78%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}







IMG#raspberry9{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 15%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento9
{
  position: absolute;
  left: 59%;
  top: 17%;
  font: bold 14pt verdana;
  color:	#000000;
}

LABEL#data9
{
  position: absolute;
  left: 69%;
  top: 17%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry9_antena0{
    margin-left: 0px;
    position: absolute;
    left: 84%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry9_antena1{
    margin-left: 0px;
    position: absolute;
    left: 87.5%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry9_antena2{
    margin-left: 0px;
    position: absolute;
    left: 91%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry9_antena3{
    margin-left: 0px;
    position: absolute;
    left: 94.5%;
    top: 15%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}




IMG#raspberry10{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 24%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento10
{
  position: absolute;
  left: 59%;
  top: 26%;
  font: bold 14pt verdana;
  color:	#000000;
}
LABEL#data10
{
  position: absolute;
  left: 69%;
  top: 26%;
  font: normal 14pt verdana;
  color:	#000000;
}
IMG#raspberry10_antena0{
    margin-left: 0px;
    position: absolute;
    left: 84%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry10_antena1{
    margin-left: 0px;
    position: absolute;
    left: 87.5%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry10_antena2{
    margin-left: 0px;
    position: absolute;
    left: 91%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry10_antena3{
    margin-left: 0px;
    position: absolute;
    left: 94.5%;
    top: 24%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}



IMG#raspberry11{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 33%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento11
{
  position: absolute;
  left: 59%;
  top: 35%;
  font: bold 14pt verdana;
  color:	#000000;
}
LABEL#data11
{
  position: absolute;
  left: 69%;
  top: 35%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry11_antena0{
    margin-left: 0px;
    position: absolute;
    left: 84%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry11_antena1{
    margin-left: 0px;
    position: absolute;
    left: 87.5%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry11_antena2{
    margin-left: 0px;
    position: absolute;
    left: 91%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry11_antena3{
    margin-left: 0px;
    position: absolute;
    left: 94.5%;
    top: 33%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}




IMG#raspberry12{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 42%;
    width: 80px;
    height: 50px;
    cursor: pointer;

}
LABEL#equipamento12
{
  position: absolute;
  left: 59%;
  top: 44%;
  font: bold 14pt verdana;
  color:	#000000;
}
LABEL#data12
{
  position: absolute;
  left: 69%;
  top: 44%;
  font: normal 14pt verdana;
  color:	#000000;
}

IMG#raspberry12_antena0{
    margin-left: 0px;
    position: absolute;
    left: 84%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry12_antena1{
    margin-left: 0px;
    position: absolute;
    left: 87.5%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry12_antena2{
    margin-left: 0px;
    position: absolute;
    left: 91%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}

IMG#raspberry12_antena3{
    margin-left: 0px;
    position: absolute;
    left: 94.5%;
    top: 42%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}















#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
    font: normal 12pt verdana;
    color: rgba(0,0,0,0.7);
}

DIV#dispositivos{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 95%;
    height: 90%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: 	#F5F5F5;

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
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="excellentexport.js"></script>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`dashboard_excesso_vl.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" hidden='hidden' onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>
<?php
error_reporting(0);

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

$vmes = substr($data,3,2);

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






<?php
   $mes = '';

  $filtro = $_GET['filtro'];
  
  $filtro = trim($filtro);
  if($filtro == "")
  {
    $filtro = $vmes;  
  }
  if (intval($vmes)< intval($filtro))
  {
   $filtro = $vmes;
  }
  
  
  if($filtro == '01')
  {
  $mes = 'Janeiro';
  }
  else if ($filtro == '02')
  {
    $mes = 'Fevereiro';
  }
  else if ($filtro == '03')
  {
    $mes = 'Março';
  }
  else if ($filtro == '04')
  {
    $mes = 'Abril';
  }
  else if ($filtro == '05')
  {
    $mes = 'Maio';
  }
  else if ($filtro == '06')
  {
    $mes = 'Junho';
  }
  else if ($filtro == '07')
  {
    $mes = 'Julho';
  }
  else if ($filtro == '08')
  {
    $mes = 'Agosto';
  }
  else if ($filtro == '09')
  {
    $mes = 'Setembro';
  }
  else if ($filtro == '10')
  {
    $mes = 'Outubro';
  }
  else if ($filtro == '11')
  {
    $mes = 'Novembro';
  }
  else if ($filtro == '12')
  {
    $mes = 'Dezembro';
  }

  $nome_arquivo = "ListaExcessos_vl_".$mes.".csv";


 $titulo = "Filtro da lista de excessos vl referente ao mês de ".$mes;
 ?>
 <a download='<?php print $nome_arquivo ?>' id="exportar" onclick="return ExcellentExport.csv(this, 'datatable');">Exportar CSV</a>
  </br></br>
 <h1 id="titulo"><?php echo $titulo ?> </h1>

<table id="datatable" border= 1px; >
 <thead >
   <tr>
       <th class="th1">ID</th>
       <th class="th2">TAG Carreta</th>
       <th class="th3">Placa</th>
       <th class="th4">Transportadora</th>
       <th class="th5">Data</th>
       <th class="th6">Horario</th>
       <th class="th7">Site</th>
       <th class="th8">Turno</th>
       
   </tr>
 </thead>
 <tbody>
   <tr> 
<?php

include 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_excesso_vl WHERE mes='$filtro'  ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
 $encontrado =0;
 while($dados = $sql->fetch_array())
 {
  $encontrado++;   
  $id = $dados['id'];
  $epc = $dados['epc'];
  $data = $dados['data'];
  $mes = $dados['mes'];
  $ano = $dados['ano'];
  $hora = $dados['hora'];
  $local_instalacao = $dados['local_instalacao'];
  $turno = $dados['turno'];
  $placa = $dados['placa'];
  $sigla = $dados['sigla'];
  if($placa == ''){$placa = 'Não identificado!';}
  if($placa == '-'){$placa = 'Não identificado!';}
  ?>
    <td class="th1"><?php echo $id ?></td>
    	<td class="th2"><?php echo $epc ?></td>
      <td class="th3"><?php echo $placa ?></td>
    	<td class="th4"><?php echo $sigla ?></td>
        <td class="th5"><?php echo $data ?></td>
        <td class="th6"><?php echo $hora ?></td>
        <td class="th7"><?php echo $local_instalacao ?></td>
        <td class="th8"><?php echo $turno ?></td>
 
        
    </tr>
  <?php
  
   
 } // Fecha While
 ?>
	
 </tbody>
</table>
<?php
}// Fecha o if 


//for($i=1;$i<=$encontrado;$i++){  
//    echo $html[$i];
//    echo'</BR>';
//}
?>






<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


</body>

<script>

</script>

<style>







.th1{
    width: 80px;  
    text-align: center;
}
.th2{
    width: 280px;
    text-align: center;  
}
.th3{
    width: 150px;
    text-align: center;  
}
.th4{
    width: 220px;
    text-align: center;  
}
.th5{
    width: 125px;
    text-align: center;  
}
.th6{
    width: 160px;
    text-align: center;  
}
.th7{
    width: 230px;
    text-align: center;  
}
.th8{
    width: 80px;
    text-align: center;  
}

table {
    width: 1402px;
    position: absolute;
    display:inline-block;
    background-color:#ADD8E6;
    font: normal 12pt times;
    left: 50px;
    top: 15%;
}
thead {
    display: inline-block;
    width: 100%;
    height: 20px;
    background-color:#F5F5DC;
    color: #000000;
    padding-top:2px;
    padding-bottom:5px;
    
}
tbody {
    height: 500px;
    display: inline-block;
    width: 100%;
    background-color:#F8F8FF;
    overflow: auto;
    
}



h1#titulo{
    margin-left: 0px;
    position: absolute;
    left: 60px;
    top: 4%;
    
}

a#exportar{
    margin-left: 0px;
    position: absolute;
    left: 83.4%;
    top: 8%;
    width: 180px;
    height: 25px;
    padding-top: 5px;
    text-align: center;
    background-color: 	#C0C0C0;
    border-radius: 6px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;
    
}




IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#home{
    margin-left: 0px;
    position: absolute;
    left: 38px;
    top:  2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 90%;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3%;
    top: 0%;
    width:92.9%;
    height:3%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 6%;
    top: -10%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 75%;
    top: 5%;
}

INPUT#criptografia
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 11pt verdana;
    color:#000000;
    left: 30%;
    top: 5%;

}
INPUT#criptografia2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 55%;
    top: 5%;

}

body{

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>



</html>
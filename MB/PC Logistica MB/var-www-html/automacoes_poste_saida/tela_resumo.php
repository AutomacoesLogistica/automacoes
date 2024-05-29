<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resumo Automações Saida Balança 01 MB</title>
</head>
<body>


<script>
function info(mensagem)
{
  alert(mensagem);
}

</script>
<div id="tela">

<?php
//Busco o turno
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');

$vdata = isset($_GET['data'])?$_GET['data']:'vazio';

if($vdata == 'vazio')
{
 $data = $data; 
}
else
{
 $data = $vdata; 
}


$array_ponto=array();
$encontrado_mg = 0;
$encontrado_balanca = 0;
$array_ticket_id=array();
$array_ticket_data_hora=array();
$array_ticket_numero_gagf=array();
$array_ticket_numero_gscs =array();
$array_ticket_material=array();
$array_ticket_destino=array();
$array_ticket_motorista=array();
$encontrado_ticket = 0;

$array_saindo_vazio_id=array();
$array_saindo_vazio_data_hora=array();
$array_saindo_vazio_numero_gagf=array();
$array_saindo_vazio_numero_gscs =array();
$array_saindo_vazio_material=array();
$array_saindo_vazio_destino=array();
$array_saindo_vazio_motorista=array();
$encontrado_saindo_vazio = 0;


$array_excesso_id=array();
$array_excesso_data_hora=array();
$array_excesso_numero_gagf=array();
$array_excesso_numero_gscs =array();
$array_excesso_material=array();
$array_excesso_destino=array();
$array_excesso_motorista=array();
$encontrado_excesso = 0;



$array_concluidos_id=array();
$array_concluidos_data_hora=array();
$array_concluidos_numero_gagf=array();
$array_concluidos_numero_gscs =array();
$array_concluidos_material=array();
$array_concluidos_destino=array();
$array_concluidos_motorista=array();
$encontrado_concluidos = 0;

$array_tratando=array();
$encontrado_tratando = 0;
$encontrado_total = 0;


$hora = date('H:i:s'); 

//Busco o turno atual
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM historico_display WHERE data_aqui1='$data' ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
while($dados = $sql->fetch_array())
{ 
 $condicao = $dados['condicao1'];
 $numero_gagf = $dados['gagf'];
 $numero_gscs = $dados['gscs'];
 $material = $dados['material'];
 $destino = $dados['destino'];
 $motorista = $dados['motorista'];
 //$motorista = explode(' ',$motorista);
 //$motorista = $motorista[0];
 $id = $dados['id'];
 $data_hora = $dados['data_aqui1']." ".$dados['hora_aqui1'];

 if($condicao == "Ticket")
 {
  $encontrado_ticket = intval($encontrado_ticket)+1;
  $array_ticket_id[$encontrado_ticket] = $id;
  $array_ticket_data_hora[$encontrado_ticket] = $data_hora;
  $array_ticket_numero_gagf[$encontrado_ticket] = $numero_gagf;
  $array_ticket_numero_gscs[$encontrado_ticket] = $numero_gscs;
  $array_ticket_material[$encontrado_ticket] = $material;
  $array_ticket_destino[$encontrado_ticket] = $destino;
  $array_ticket_motorista[$encontrado_ticket] = $motorista;
  
 }
 else if($condicao == "Concluído")
 {
  $encontrado_concluidos = intval($encontrado_concluidos)+1;  
  $array_concluidos_id[$encontrado_concluidos] = $id;
  $array_concluidos_data_hora[$encontrado_concluidos] = $data_hora;
  $array_concluidos_numero_gagf[$encontrado_concluidos] = $numero_gagf;
  $array_concluidos_numero_gscs[$encontrado_concluidos] = $numero_gscs;
  $array_concluidos_material[$encontrado_concluidos] = $material;
  $array_concluidos_destino[$encontrado_concluidos] = $destino;
  $array_concluidos_motorista[$encontrado_concluidos] = $motorista;
 }
 else if($condicao == "Concluido2")
 {
  $encontrado_saindo_vazio = intval($encontrado_saindo_vazio)+1; 
  $array_saindo_vazio_id[$encontrado_saindo_vazio] = $id;
  $array_saindo_vazio_data_hora[$encontrado_saindo_vazio] = $data_hora;
  $array_saindo_vazio_numero_gagf[$encontrado_saindo_vazio] = $numero_gagf;
  $array_saindo_vazio_numero_gscs[$encontrado_saindo_vazio] = $numero_gscs;
  $array_saindo_vazio_material[$encontrado_saindo_vazio] = $material;
  $array_saindo_vazio_destino[$encontrado_saindo_vazio] = $destino;
  $array_saindo_vazio_motorista[$encontrado_saindo_vazio] = $motorista; 
 }
 else if($condicao == "Excesso/Falta")
 {
  $encontrado_excesso = intval($encontrado_excesso)+1;
  $array_excesso_id[$encontrado_excesso] = $id;
  $array_excesso_data_hora[$encontrado_excesso] = $data_hora;
  $array_excesso_numero_gagf[$encontrado_excesso] = $numero_gagf;
  $array_excesso_numero_gscs[$encontrado_excesso] = $numero_gscs;
  $array_excesso_material[$encontrado_excesso] = $material;
  $array_excesso_destino[$encontrado_excesso] = $destino;
  $array_excesso_motorista[$encontrado_excesso] = $motorista;
 }


 $encontrado_total  = intval($encontrado_total)+1;
}
mysqli_close();
}


  ?>
 
  <?php
  echo '<h2> Resumo do dia '. $data .' - ' . '<b>Total Eventos:</b> '. $encontrado_total .'</h2>';
  echo '</BR>';
  echo '<b>Total Eventos Alerta Ticket:</b> '. $encontrado_ticket;
  echo '</BR>';
  //Criando a tabela ***********************
  ?>
  <div id="tabela_excessos" name="tabela_excessos">
  <table border= 1.2px; >
  <thead >
  <tr>
   <th class="th1_1">ID</th>
   <th class="th2_1">Horario</th>
   <th class="th3_1">GAGF</th>
   <th class="th4_1">GSCS</th>
   <th class="th5_1">Material</th>
   <th class="th6_1">Destino</th>
   <th class="th7_1">Motorista</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for($x = 1; $x <= intval($encontrado_ticket); $x++) 
  {
   ?>
   <tr>
    <td class="th1"><?php print $array_ticket_id[$x] ?></td>
    <td class="th2"><?php print $array_ticket_data_hora[$x] ?></td>
    <td class="th3"><?php print $array_ticket_numero_gagf[$x] ?></td>
    <td class="th4"><?php print $array_ticket_numero_gscs[$x] ?></td>
    <td class="th5"><?php print $array_ticket_material[$x] ?></td>
    <td class="th6"><?php print $array_ticket_destino[$x] ?></td>
    <td class="th7"><?php print $array_ticket_motorista[$x] ?></td>
   </tr>
   <?php
  }
  ?>
  </tbody>
  </table>
  </div>
  <?php
  // Fecha a tabela *********************************************************
  
   
echo '</BR>';
echo '<b>Total Saindo Vazio:</b> '. $encontrado_saindo_vazio;
echo '</BR>';
//Criando a tabela ***********************
?>
<div id="tabela_saindo_vazio" name="tabela_saindo_vazio">
<table border= 1.2px; >
<thead >
<tr>
 <th class="th1_1">ID</th>
 <th class="th2_1">Horario</th>
 <th class="th3_1">GAGF</th>
 <th class="th4_1">GSCS</th>
 <th class="th5_1">Material</th>
 <th class="th6_1">Destino</th>
 <th class="th7_1">Motorista</th>
</tr>
</thead>
<tbody>
<?php
for($x = 1; $x <= intval($encontrado_saindo_vazio); $x++) 
{
 ?>
 <tr>
  <td class="th1"><?php print $array_saindo_vazio_id[$x] ?></td>
  <td class="th2"><?php print $array_saindo_vazio_data_hora[$x] ?></td>
  <td class="th3"><?php print $array_saindo_vazio_numero_gagf[$x] ?></td>
  <td class="th4"><?php print $array_saindo_vazio_numero_gscs[$x] ?></td>
  <td class="th5"><?php print $array_saindo_vazio_material[$x] ?></td>
  <td class="th6"><?php print $array_saindo_vazio_destino[$x] ?></td>
  <td class="th7"><?php print $array_saindo_vazio_motorista[$x] ?></td>
 </tr>
 <?php
}
?>
</tbody>
</table>
</div>
<?php
// Fecha a tabela *********************************************************  
  
  
  
 
echo '</BR>';
echo '<b>Total Eventos Excesso/Falta:</b> '. $encontrado_excesso;
echo '</BR>';
 //Criando a tabela ***********************
 ?>
 <div id="tabela_excessos" name="tabela_excessos">
 <table border= 1.2px; >
 <thead >
 <tr>
  <th class="th1_1">ID</th>
  <th class="th2_1">Horario</th>
  <th class="th3_1">GAGF</th>
  <th class="th4_1">GSCS</th>
  <th class="th5_1">Material</th>
  <th class="th6_1">Destino</th>
  <th class="th7_1">Motorista</th>
 </tr>
 </thead>
 <tbody>
 <?php
 for($x = 1; $x <= intval($encontrado_excesso); $x++) 
 {
  ?>
  <tr>
   <td class="th1"><?php print $array_excesso_id[$x] ?></td>
   <td class="th2"><?php print $array_excesso_data_hora[$x] ?></td>
   <td class="th3"><?php print $array_excesso_numero_gagf[$x] ?></td>
   <td class="th4"><?php print $array_excesso_numero_gscs[$x] ?></td>
   <td class="th5"><?php print $array_excesso_material[$x] ?></td>
   <td class="th6"><?php print $array_excesso_destino[$x] ?></td>
   <td class="th7"><?php print $array_excesso_motorista[$x] ?></td>
  </tr>
  <?php
 }
 ?>
 </tbody>
 </table>
 </div>
 <?php
 // Fecha a tabela *********************************************************

  
  
  
  
  
  echo '</BR>';
  











  echo '<b>Total Eventos Concluidos saindo carregado:</b> '. $encontrado_concluidos;
  echo '</BR>';
  //Criando a tabela ***********************
  ?>
  <div id="tabela_concluidos" name="tabela_concluidos">
  <table border= 1.2px; >
  <thead >
  <tr>
   <th class="th1_1">ID</th>
   <th class="th2_1">Horario</th>
   <th class="th3_1">GAGF</th>
   <th class="th4_1">GSCS</th>
   <th class="th5_1">Material</th>
   <th class="th6_1">Destino</th>
   <th class="th7_1">Motorista</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for($x = 1; $x <= intval($encontrado_concluidos); $x++) 
  {
   ?>
   <tr>
    <td class="th1"><?php print $array_concluidos_id[$x] ?></td>
    <td class="th2"><?php print $array_concluidos_data_hora[$x] ?></td>
    <td class="th3"><?php print $array_concluidos_numero_gagf[$x] ?></td>
    <td class="th4"><?php print $array_concluidos_numero_gscs[$x] ?></td>
    <td class="th5"><?php print $array_concluidos_material[$x] ?></td>
    <td class="th6"><?php print $array_concluidos_destino[$x] ?></td>
    <td class="th7"><?php print $array_concluidos_motorista[$x] ?></td>
   </tr>
   <?php
  }
  ?>
  </tbody>
  </table>
  </div>
  <?php
  // Fecha a tabela *********************************************************




  
?>





<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>

DIV#tela{
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100%;
  height: auto;
  background-color: transparent;

}


.th1_1{
    width: 5%;
    text-align: center;
    background-color: rgb(155,155,255);
}

.th2_1{
    width: 8%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th3_1{
    width: 6.5%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th4_1{
    width: 6.5%;
    text-align: center;
    background-color: rgb(155,155,255);
}

.th5_1{
    width: 18%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th6_1{
    width: 12%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th7_1{
    width: 20%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th1{
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
.th2{
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
.th3{
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
.th4{
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255); 
}
.th5{
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
.th6{
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
.th7{

    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 38%;
    //top: 98%;
    font: normal 12pt verdana;
    color:#000000;
}
body{
    width: 100%;
  height: auto;
  background-color: #ADD8E6;
  overflow: auto;
}
html{

}
</style>
</html>
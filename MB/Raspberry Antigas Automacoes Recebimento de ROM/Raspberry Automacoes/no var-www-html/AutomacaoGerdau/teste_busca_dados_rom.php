<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resumo ROM</title>
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

$data_ontem = date('d/m/Y');
$data_ontem = explode('/',$data_ontem);
$dia_anterior  =(intval($data_ontem[0])-1);
$data_ontem = (intval($data_ontem[0])-1).'/'.$data_ontem[1].'/'.$data_ontem[2];


$entrada_erros_SVA = 0;
$entrada_erros_GSCS = 0;
$primeira_deteccao_hj_saida_alternativa = '';
$primeira_deteccao_ontem_saida_alternativa = '';
$array_manual_hj_entrada=array();
$array_manual_hj_justificativa_entrada=array();
$array_manual_hj_descricao_entrada=array();
$array_manual_hj_hora_entrada=array();
$array_manual_hj_colaborador_entrada=array();
$encontrados_hj_entrada = 0;

$array_manual_hj_saida=array();
$array_manual_hj_justificativa_saida=array();
$array_manual_hj_descricao_saida=array();
$array_manual_hj_hora_saida=array();
$array_manual_hj_colaborador_saida=array();
$encontrados_hj_saida = 0;

$array_manual_hj_saida_alternativa=array();
$array_manual_hj_justificativa_saida_alternativa=array();
$array_manual_hj_descricao_saida_alternativa=array();
$array_manual_hj_hora_saida_alternativa=array();
$array_manual_hj_colaborador_saida_alternativa=array();
$encontrados_hj_saida_alternativa = 0;


$aut_entrada_ontem = 0;
$man_entrada_ontem = 0;
$t_entrada_ontem = 0;

$aut_saida_ontem = 0;
$man_saida_ontem = 0;
$t_saida = 0;

$aut_saida_ontem_alt = 0;
$man_saida_ontem_alt = 0;
$t_saida_alt_ontem = 0;

$hora = date('H:i:s'); 
$turno1 = '';
$turno2 = '';
$turno3 = '';
$turno_atual = '';
$v_turno = 0;

//Busco o turno atual
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
if(mysqli_num_rows($sql)>0)
{
while($dados = $sql->fetch_array())
{ 
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];
}
mysqli_close();
}

$valor_hora = explode(':',$hora);
$valor_hora = $valor_hora[0];
if(intval($valor_hora)>=0 && intval($valor_hora)<8)
{
  //Turno 1
  $turno_atual = $turno1;  
  $v_turno = 1;
}
else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
{
  //Turno 2
  $turno_atual = $turno2;  
  $v_turno = 2;
}
else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
{
  //Turno 3
  $turno_atual = $turno3;  
  $v_turno = 3;
}
else{
    //erro
    $turno_atual = '-';
}
/*

echo "<h2>Data Atual : ". $data . " - Turno atual: ". $turno_atual . "</h2>";


echo '************************************';
*/
//Agora atualizo no sistema a saida automatica
//Busco o valor
$aut_entrada = 0;
$man_entrada = 0;
$t_entrada = 0;

$aut_saida = 0;
$man_saida = 0;
$t_saida = 0;

$aut_saida_alt = 0;
$man_saida_alt = 0;
$t_saida_alt = 0;


//Busco dados de hj
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
if(mysqli_num_rows($sql)>0)
{
   $dados = $sql->fetch_array();
   $aut_entrada = intval($dados['aut_entrada']);
   $man_entrada = intval($dados['man_entrada']);
   $t_entrada = intval($dados['t_entrada']);

   $aut_saida = intval($dados['aut_saida']);
   $man_saida = intval($dados['man_saida']);
   $t_saida = intval($dados['t_saida']);

   $aut_saida_alt = intval($dados['aut_saida_alt']);
   $man_saida_alt = intval($dados['man_saida_alt']);
   $t_saida_alt = intval($dados['t_saida_alt']);
}
mysqli_close();


//Busco dados dia anterior

include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data_ontem'");
if(mysqli_num_rows($sql)>0)
{
  $dados = $sql->fetch_array();
  $aut_entrada_ontem = intval($dados['aut_entrada']);
  $man_entrada_ontem = intval($dados['man_entrada']);
  $t_entrada_ontem = intval($dados['t_entrada']);

  $aut_saida_ontem = intval($dados['aut_saida']);
  $man_saida_ontem = intval($dados['man_saida']);
  $t_saida = intval($dados['t_saida']);

  $aut_saida_ontem_alt = intval($dados['aut_saida_alt']);
  $man_saida_ontem_alt = intval($dados['man_saida_alt']);
  $t_saida_alt_ontem = intval($dados['t_saida_alt']);
} 
mysqli_close();

/*
include_once 'conexao_sva.php';
$sql = $dbcon->query("SELECT * FROM cheio_vazio WHERE (data_leitura ='$data' AND camera_id='ms0742-cam02') ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
  $dados = $sql->fetch_array();
  $primeira_deteccao_hj_saida_alternativa = $dados['hora'];
}
mysqli_close();
*/

/*
include_once 'conexao_sva.php';
$sql = $dbcon->query("SELECT * FROM cheio_vazio WHERE (data_leitura ='$data_ontem ' AND camera_id='ms0742-cam02') ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
  $dados = $sql->fetch_array();
  $primeira_deteccao_ontem_saida_alternativa  = $dados['hora'];
}
mysqli_close();

*/
  ?>
  <div id='tela0' name='tela0'>
  <?php
  echo '<h2> Resumo do dia '. $data .'</h2>';
  
  $total_entrada = ( intval($aut_entrada)+intval($man_entrada));
  echo '<b>Total Entrada:</b> '. ( intval($aut_entrada)+intval($man_entrada));
  echo '</BR>';
  echo "&nbsp&nbsp&nbsp&nbsp&nbsp<b>Automatico: </b>". $aut_entrada;
  echo "</BR>";
  echo "&nbsp&nbsp&nbsp&nbsp&nbsp<b>Manual: </b>" . $man_entrada;
  echo '</BR>';
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Validações Automáticas: </b>'.  (number_format((floatval( $aut_entrada/$total_entrada*100)),1,",",".")).'%'; 
  echo '</BR>';
  echo '</BR>';
  $total_saida = (intval($aut_saida) + intval($aut_saida_alt) + intval($man_saida) + intval($man_saida_alt));
  echo '<b>Total Saida:</b> ' . $total_saida;
  echo '</BR>';
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSaida Normal';
  echo '</BR>';
  echo "&nbsp&nbsp&nbsp&nbsp&nbsp<b>Automatico: </b>". $aut_saida;
  echo'</BR>';
  echo"&nbsp&nbsp&nbsp&nbsp&nbsp<b>Manual: </b>" . $man_saida;
  echo '</BR>';echo '</BR>';
  echo '&nbsp&nbsp&nbsp&nbsp&nbspSaida Alternativa';
  echo '</BR>';
  echo "&nbsp&nbsp&nbsp&nbsp&nbsp<b>Automatico: </b>". $aut_saida_alt;
  echo "</BR>";
  echo "&nbsp&nbsp&nbsp&nbsp&nbsp<b>Manual: </b>" . $man_saida_alt;
  //echo "</BR>";
  //echo "&nbsp&nbsp&nbsp&nbsp&nbsp<b>Primeira detecção : </b> " . $primeira_deteccao_hj_saida_alternativa;
  echo '</BR>';
  echo '</BR>';
  $assertividade_saida = (number_format(100-(floatval( (intval($man_saida)+intval($man_saida_alt))/(intval($aut_saida)+intval($aut_saida_alt))*100)),1,",","."));
  if(intval($assertividade_saida) == 100)
  {
    echo '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Assertividade OCR:</b> '. '-- '.'%'; 
  }
  else
  {
    echo '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Assertividade OCR:</b> '. $assertividade_saida.'%'; 
  }
  echo '</BR>';
  $assertividade_saida_entrada = (number_format((floatval( (intval($total_saida))/(intval($total_entrada))*100)),1,",","."));
  $d_assertividade_saida_entrada = (number_format(100-(floatval( (intval($total_saida))/(intval($total_entrada))*100)),1,",","."));
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Assertividade OCR Saida x Entrada:</b> ' . $assertividade_saida_entrada . '%';
  echo '</BR>';
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Faltou detecção OCR Saida x Entrada:</b> ' . $d_assertividade_saida_entrada . '%';
  echo "</BR>";
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Faltou:  </b>' . (intval($total_entrada)-(intval($total_saida))) . ' Eventos!';
?>

</div>

<div id="tela1" name="tela1">
<table border= 2px; >
  <thead >
    <tr>
    	<th class="th1_1">Data/Hora</th>
    	<th class="th2_1">Erro</th>
    	<th class="th0_0">Cancela</th>
      <th class="th4_1">Colaborador</th>
      <th class="th4_1">Descricao</th>

    </tr>
  </thead>
  <tbody>

<?php
  echo '</BR><font color="#FFFFFF"><b>&nbsp&nbspResumo dos Eventos Manuais</b></font>';
  include_once 'conexao_portal.php';
  $sql = $dbcon->query("SELECT * FROM eventos WHERE (data='$data' AND cancela='Entrada Recebimento ROM')");
  if(mysqli_num_rows($sql)>0)
  {
    
   
    while($dados = $sql->fetch_array())
    {
      $array_manual_hj_entrada[$encontrados_hj_entrada] = $dados['data'];
      $array_manual_hj_hora_entrada[$encontrados_hj_entrada] = $dados['hora'];
      $array_manual_hj_justificativa_entrada[$encontrados_hj_entrada] = $dados['justificativa'];
      $array_manual_hj_descricao_entrada[$encontrados_hj_entrada] = $dados['descricao'];
      $array_manual_hj_colaborador_entrada[$encontrados_hj_entrada] = $dados['nome_colaborador'];
      ?>
      <tr>
    	<td class="th1"><?php print $array_manual_hj_entrada[$encontrados_hj_entrada] . ' ' . $array_manual_hj_hora_entrada[$encontrados_hj_entrada] ?></td>
      <?php
      if($array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]=="Validou apenas GSCS")
      {
       $entrada_erros_SVA = intval($entrada_erros_SVA)+1; 
      ?>
      <td class="th2"><img id="img_sva" src="./images/sva.png" onclick="info('<?php print $array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]?>')"/></td>
      <?php 
      }
      else if( ($array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]=="Validou apenas SVA")|| ($array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]=="Troca de Turno - Erro GSCS") )
      {
       $entrada_erros_GSCS = intval($entrada_erros_GSCS)+1; 
      ?>
      <td class="th2"><img id="img_gscs" src="./images/gscs.png" onclick="info('<?php print $array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]?>')"/></td>
      
      <?php 
      }
      else if($array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]=="Pipa da Fagundes umectando a via")
      {
      ?>
      <td class="th2"><img id="img_gscs" src="./images/pipa.png" onclick="info('<?php print $array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]?>')"/></td>
      <?php 
      }
      else
      {
      ?>
      <td class="th2"><img id="img_gscs" src="./images/carro.png" onclick="info('<?php print $array_manual_hj_justificativa_entrada[$encontrados_hj_entrada]?>)'"/></td>
      <?php
      }
      
      ?>


      
      <td class="th0">Entrada</td>
      <td class="th4"><?php print $array_manual_hj_colaborador_entrada[$encontrados_hj_entrada] ?></td>
      <td class="th4"><?php print $array_manual_hj_descricao_entrada[$encontrados_hj_entrada] ?></td>
      <?php
       $encontrados_hj_entrada = intval($encontrados_hj_entrada)+1;
      ?>
      </tr>
      <?php
    }
    mysqli_close();
  }
  include_once 'conexao_portal.php';
  $sql = $dbcon->query("SELECT * FROM eventos WHERE (data='$data' AND cancela='Saída Recebimento ROM')");
  if(mysqli_num_rows($sql)>0)
  {
   
   while($dados = $sql->fetch_array())
   {
    $array_manual_hj_saida[$encontrados_hj_saida] = $dados['data'];
    $array_manual_hj_hora_saida[$encontrados_hj_saida] = $dados['hora'];
    $array_manual_hj_justificativa_saida[$encontrados_hj_saida] = $dados['justificativa'];
    $array_manual_hj_descricao_saida[$encontrados_hj_saida] = $dados['descricao'];
    $array_manual_hj_colaborador_saida[$encontrados_hj_saida] = $dados['nome_colaborador'];
    ?>
    <tr>
    <td class="th1"><?php print $array_manual_hj_saida[$encontrados_hj_saida] . ' ' . $array_manual_hj_hora_saida[$encontrados_hj_saida] ?></td>
    <?php
    if($array_manual_hj_justificativa_saida[$encontrados_hj_saida]=="SVA não validou a saída")
    {
    ?>
    <td class="th2"><img id="img_sva" src="./images/sva.png" onclick="info('<?php print $array_manual_hj_justificativa_saida[$encontrados_hj_saida]?>')"/></td>
    <?php 
    }
    else if($array_manual_hj_justificativa_saida[$encontrados_hj_saida]=="Pipa da Fagundes umectando a via")
    {
    ?>
    <td class="th2"><img id="img_gscs" src="./images/pipa.png" onclick="info('<?php print $array_manual_hj_justificativa_saida[$encontrados_hj_saida]?>')"/></td>
    <?php 
    }
    else
    {
    ?>
    <td class="th2"><img id="img_gscs" src="./images/carro.png" onclick="info('<?php print $array_manual_hj_justificativa_saida[$encontrados_hj_saida]?>')"/></td>
    <?php
    }
    
    ?>


    
    <td class="th0">Saida</td>
    <td class="th4"><?php print $array_manual_hj_colaborador_saida[$encontrados_hj_saida] ?></td>
    <td class="th4"><?php print $array_manual_hj_descricao_saida[$encontrados_hj_saida] ?></td>
    <?php
    $encontrados_hj_saida = intval($encontrados_hj_saida)+1;
    ?>
    </tr>
    <?php
    }
    mysqli_close();
  }
  include_once 'conexao_portal.php';
  $sql = $dbcon->query("SELECT * FROM eventos WHERE (data='$data' AND cancela='Saída Alt. Recebimento ROM')");
  if(mysqli_num_rows($sql)>0)
  {
  
    
  
  while($dados = $sql->fetch_array())
  {
    $array_manual_hj_saida_alternativa[$encontrados_hj_saida_alternativa] = $dados['data'];
    $array_manual_hj_hora_saida_alternativa[$encontrados_hj_saida_alternativa] = $dados['hora'];
    $array_manual_hj_justificativa_saida_alternativa[$encontrados_hj_saida_alternativa] = $dados['justificativa'];
    $array_manual_hj_descricao_saida_alternativa[$encontrados_hj_saida_alternativa] = $dados['descricao'];
    $array_manual_hj_colaborador_saida_alternativa[$encontrados_hj_saida_alternativa] = $dados['nome_colaborador'];
    ?>
    <tr>
    <td class="th1"><?php print $array_manual_hj_saida_alternativa[$encontrados_hj_saida_alternativa] . ' ' . $array_manual_hj_hora_saida_alternativa[$encontrados_hj_saida_alternativa] ?></td>
    <?php
    if($array_manual_hj_justificativa_saida_alternativa[$encontrados_hj_saida_alternativa]=="SVA não validou a saída")
    {
    ?>
    <td class="th2"><img id="img_sva" src="./images/sva.png" onclick="info('<?php print $array_manual_hj_justificativa_saida_alternativa[$encontrados_hj_saida_alternativa]?>')"/></td>
    <?php 
    }
    else if($array_manual_hj_justificativa_saida_alternativa[$encontrados_hj_saida_alternativa]=="Pipa da Fagundes umectando a via")
    {
    ?>
    <td class="th2"><img id="img_gscs" src="./images/pipa.png" onclick="info('<?php print $array_manual_hj_justificativa_saida_alternativa[$encontrados_hj_saida_alternativa]?>')"/></td>
    <?php 
    }
    else
    {
    ?>
    <td class="th2"><img id="img_gscs" src="./images/carro.png" onclick="info('<?php print $array_manual_hj_justificativa_saida_alternativa[$encontrados_hj_saida_alternativa]?>)'"/></td>
    <?php
    }
    
    ?>


    
    <td class="th0">S.Alt</td>
    <td class="th4"><?php print $array_manual_hj_colaborador_saida_alternativa[$encontrados_hj_saida_alternativa] ?></td>
    <td class="th4"><?php print $array_manual_hj_descricao_saida_alternativa[$encontrados_hj_saida_alternativa] ?></td>
    <?php
    $encontrados_hj_saida_alternativa = intval($encontrados_hj_saida_alternativa)+1;
    ?>
    </tr>
    <?php
   }
   mysqli_close();
  }
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="#FFFFFF"><b>Erros SVA =  </b>';
  echo $entrada_erros_SVA . '&nbsp&nbsp&nbsp&nbsp&nbsp<b>Assertividade OCR = </b>'.(number_format(100-(floatval( $entrada_erros_SVA/$total_entrada*100)),1,",",".")).'%&nbsp&nbsp&nbsp&nbsp&nbsp<b>Erros GSCS =  </b>' . $entrada_erros_GSCS . '</font>';
  ?>
   </tbody>
</table>
  </div>
  <?php



?>




</div>


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>

DIV#tela{
  position: absolute;
  top: 12%;
  left: 5%;
  width: 90%;
  height: 70%;
  background-color: transparent;

}
DIV#tela0{
  position: absolute;
  top: 0%;
  left: 0%;
  font: normal 12pt;
  width: 27.9%;
  height: 92%;
  background-color: transparent;
  display:inline-block;
  overflow: auto;

}
DIV#tela1{
  position: absolute;
  top: 0%;
  left: 28%;
  width: 72%;
  height: 100%;
  background-color: rgba(10,10,10,0.5);
  display:inline-block;
  overflow: auto;

}

IMG#img_sva{
    width: 100px;
    height: 33px;
 
}

IMG#img_sva:hover
{
 background-color: #555555; /* Preto */
 color: white;
 transform: translateX(10px);
}
IMG#img_sva:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
IMG#img_gscs{
    width: 100px;
    height: 33px;

}
IMG#img_gscs:hover
{
 background-color: #555555; /* Preto */
 color: white;
 transform: translateX(10px);
}
IMG#img_gscs:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.th1_1{
    width: 13%;
    text-align: center;
    background-color: rgb(155,155,255);
}

.th2_1{
    width: 16%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th0_0{
    width: 9%;
    text-align: center;
    background-color: rgb(155,155,255);
}
.th4_1{
    width: 35%;
    text-align: center;
    background-color: rgb(155,155,255);
}

.th4_1{
    width: 85px;
    text-align: center;
    background-color: rgb(155,155,255);
}

.th1{
    width: 13%;  
    text-align: center;
    font: normal 8pt verdana;
    background-color: rgb(255,255,255);
}
.th2{
    width: 16%;
    text-align: center; 
    background-color: rgb(255,255,255); 
}
.th0{
    width: 9%;
    text-align: center; 
    background-color: rgb(255,255,255); 
}
.th4{
    width: 35%;
    text-align: left;
    font: normal 10pt verdana;
    background-color: rgb(255,255,255);  
}
.th4{
    width: 85px;
    text-align: left;
    font: normal 10pt verdana;
    background-color: rgb(255,255,255);  
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 38%;
    top: 90%;
    font: normal 12pt verdana;
    color:#000000;
}
body{

}
html{
background: url("./images/tela_gerdau_logo.png");
margin-top: -50px !important;
background-size: 100%;
}
</style>
</html>
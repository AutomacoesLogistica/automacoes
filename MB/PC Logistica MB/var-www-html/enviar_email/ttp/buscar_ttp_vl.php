<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="excellentexport.js"></script>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$v = explode('/',$data);
$mes = $v[1];
$ano = $v[2];
$nome_arquivo = "Lista_TTP_VL_".$mes.'_'.$ano.".csv";


if($mes == '01')
{
$v_mes = 'Janeiro';
}
else if ($mes == '02')
{
  $v_mes = 'Fevereiro';
}
else if ($mes == '03')
{
  $v_mes = 'Março';   
}
else if ($mes == '04')
{
  $v_mes = 'Abril';   
}
else if ($mes == '05')
{
  $v_mes = 'Maio';   
}
else if ($mes == '06')
{
  $v_mes = 'Junho';   
}
else if ($mes == '07')
{
  $v_mes = 'Julho';   
}
else if ($mes == '08')
{
  $v_mes = 'Agosto';   
}
else if ($mes == '09')
{
  $v_mes = 'Setembro';   
}
else if ($mes == '10')
{
  $v_mes = 'Outubro';   
}
else if ($mes == '11')
{
  $v_mes = 'Novembro';   
}
else if ($mes == '12')
{
  $v_mes = 'Dezembro';   
}



$titulo = "Filtro da lista de TTP VL referente ao mês de ".$v_mes . ' da entrada à saida';
 ?>
 <a download='<?php print $nome_arquivo ?>' id="exportar" onclick="return ExcellentExport.csv(this, 'datatable');">Exportar CSV</a>
  </br></br>
 <h1 id="titulo"><?php echo $titulo ?> </h1>

<table id="datatable" border= 1px; >
 <thead >
   <tr>
       <th class="th1">ID</th>
       <th class="th2">ID Historico</th>
       <th class="th3">TTP</th>
       <th class="th4">Data Entrada</th>
       <th class="th5">Hora Entrada</th>
       <th class="th6">Data Saida</th>
       <th class="th7">Hora Saida</th>
       <th class="th8">Turno</th>
       
   </tr>
 </thead>
 <tbody>
   <tr> 
<?php
$tabela = 'ttp_entrada_a_saida';
$encontrado = 0;
$array_id = array();
$array_id_historico = array();
$array_ttp = array();
$array_data_entrada = array();
$array_hora_entrada = array();
$array_data_saida = array();
$array_hora_saida = array();
$array_turno = array();

include_once 'conexao_vl.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE (mes='$mes' AND ano='$ano') ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
 $encontrado =0;
 while($dados = $sql->fetch_array())
 {
  $id = $dados['id'];
  $id_historico = $dados['id_historico'];
  $ttp = $dados['ttp'];
  $data_entrada = $dados['data_entrada'];
  $hora_entrada = $dados['hora_entrada'];
  $data_saida = $dados['data_saida'];
  $hora_saida = $dados['hora_saida'];
  $turno = $dados['turno'];
   
  $array_id[$encontrado] = $id;
  $array_id_historico[$encontrado] = $id_historico;
  $array_ttp[$encontrado]=$ttp;
  $array_data_entrada[$encontrado] = $data_entrada;
  $array_hora_entrada[$encontrado] = $hora_entrada;
  $array_data_saida[$encontrado] = $data_saida;
  $array_hora_saida[$encontrado] = $hora_saida;
  $array_turno[$encontrado] = $turno;

  $encontrado = intval($encontrado) + 1;
  ?>
    <td class="th1"><?php echo $id ?></td>
    	<td class="th2"><?php echo $id_historico ?></td>
      <td class="th3"><?php echo $ttp ?></td>
    	<td class="th4"><?php echo $data_entrada ?></td>
        <td class="th5"><?php echo $hora_entrada ?></td>
        <td class="th6"><?php echo $data_saida ?></td>
        <td class="th7"><?php echo $hora_saida ?></td>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTMI</title>
    <script src="./ajax/ajax.js"></script>
</head>
<body>
<input type='text' id='tb_valor_id' name='tb_valor_id' value="vazio" />
</BR></BR>
<label id="lb_info" name="lb_info"></label>
<script>

// DADOS ********************************************
var n_offlines = 0;
var n_onlines = 0;

var valor_ip_mb = "";
var descricao = "";
var chegou_fim = "";
var valor_site = "";
var valor_condicao_mb = "";
var valor_condicao_banco = "";
var caminho_audio = "";
var valor_data_mb = "";
var valor_hora_mb = "";
var encontrados_mb = 0;
var ultimo_id_encontrado = 0;
var array_ip_mb = [];
var array_condicao_mb = [];
var array_condicao_banco = [];
var array_data_mb = [];
var array_hora_mb = [];
var array_site = [];
var array_descricao = [];
var array_caminho_audio = [];
var msg_info = "";
var msg_info2 = "";

for (i=0;i<260;i++)
  {
   array_ip_mb[i]=0;
   array_condicao_mb[i]=0;
   array_condicao_banco[i]=0;
   array_data_mb[i]=0;
   array_hora_mb[i]=0;
   array_site[i]=0;
   array_descricao[i]=0;
   array_caminho_audio[i] = 0;
  
  }

testar_mb();

function testar_mb()
{
 <?php
 $planta = "UTMI";
 $valor_id = isset($_GET['id'])? $_GET['id']:"0";
 $valor_id2 = $valor_id + 5;

 // BUSCA ULTIMO ID VALIDO E ATIVO *******************************************************************
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM dados WHERE ativo='SIM' AND valor_site='$planta' ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $ultimo_id = $dados['id'];
  }
 }

 // ***************************************************************************************************

if($valor_id2 > $ultimo_id)
{
  $chegou_fim = "SIM";
}
else
{
  $chegou_fim = "NAO";
}


 include_once 'conexao.php';
 $sq1 = $dbcon->query("SELECT * FROM dados WHERE ativo='SIM' AND id>$valor_id AND valor_site='$planta' LIMIT 5");
 if(mysqli_num_rows($sq1)>0)
 {
  $encontrado = 0;   
  while($dados = $sq1->fetch_array())
  {
   $encontrado = $encontrado+1;
   $host = $dados['ip'];
   $condicao_no_banco = $dados['condicao'];
   $site = $dados['valor_site'];
   $busca_id_banco = $dados['id'];
   $descricao = $dados['descricao'];
   $caminho_audio = $dados['caminho_audio'];
  
  $output = "";
  $status = "";
  
   // Testa se esta online
  exec("ping -n 3 -w 1 $host", $output, $status);
  $valor1 = $output[7];
  $valor = explode(',', $valor1);
  $valor3 = $valor[2];
  $valor = explode('(', $valor3);
  $valor3 = $valor[1];
  $valor = explode('%', $valor3);
  $valor3 = $valor[0];
  //echo "IP: ". $host . " - ";
  if (intval($valor3)<99)
  {
   //echo"Online";
   $condicao = "Online";
  }
  else
  {
   //echo"Offline";
   $condicao = "Offline";
  }
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');// data agora
   $hora = date('H:i:s');// hora de agora
   
   
   ?>
  ultimo_id_encontrado = "<?php print $busca_id_banco  ?>";
  caminho_audio = "<?php print $caminho_audio ?>";
  descricao = "<?php print $descricao ?>";
  valor_ip_mb ="<?php print $host ?>";
  valor_site ="<?php print $site ?>";
  valor_condicao_mb ="<?php print $condicao ?>";
  valor_condicao_banco = "<?php print $condicao_no_banco ?>";
  valor_data_mb ="<?php print $data ?>";
  valor_hora_mb ="<?php print $hora ?>";
  encontrados_mb ="<?php print $encontrado ?>";
  array_ip_mb[encontrados_mb] = valor_ip_mb;
  array_condicao_mb[encontrados_mb] = valor_condicao_mb;
  array_condicao_banco[encontrados_mb] = valor_condicao_banco;
  array_data_mb[encontrados_mb] = valor_data_mb;
  array_hora_mb[encontrados_mb] = valor_hora_mb;
  array_site[encontrados_mb] = valor_site;
  array_descricao[encontrados_mb] = descricao;
  array_caminho_audio[encontrados_mb] = caminho_audio;
  
  <?php
  
  }// Fecha while    
 } // Fecha ip
 ?>
 

 //DESCARREGA OS DADOS DENTRO DA PLANILHA DE MB *********************************************************
 //alert(encontrados_mb);
 chegou_fim = "<?php print $chegou_fim ?>";
 //alert(ultimo_id_encontrado);
 //alert(chegou_fim);
 
 
 if (chegou_fim == "SIM")
 {
  var link_tb_valor_id = window.document.getElementById('tb_valor_id');
  link_tb_valor_id.value = "0";
 }
 else
 {
  var link_tb_valor_id = window.document.getElementById('tb_valor_id'); 
  link_tb_valor_id.value = ultimo_id_encontrado;
 }
 
 for (i=1;i<=encontrados_mb;i++)
 {
  //alert(array_ip_mb[i] + " - " + array_condicao_mb[i] + " - " + array_data_mb[i] + " - " + array_hora_mb[i]);
  /*
  if(i==1)
  {
    alert(array_ip_mb[i]);
    alert(array_condicao_mb[i]);
    alert(array_data_mb[i]);
    alert(array_hora_mb[i]);
    alert(array_site[i]);
  }
  */
  
  if(array_condicao_mb[i] == "Online")
  {
    n_onlines = n_onlines + 1;
    msg_info = msg_info+ "</BR><b>Site: </b>" +  array_site[i] + "<b>&emsp;&emsp;IP: </b>" + array_ip_mb[i] + "<b>&emsp;&emsp;Status: <font color='green'>" + array_condicao_mb[i] + "</b>&emsp;&emsp;<font color='black'><b>   Equipamento: </b>" + array_descricao[i];
  }
  else
  {
    n_offlines = n_offlines + 1;
    msg_info2 = msg_info2+ "</BR><b>Site: </b>" +  array_site[i] + "<b>&emsp;&emsp;IP: </b>" + array_ip_mb[i] + "<b>&emsp;&emsp;Status: <font color='red'>" + array_condicao_mb[i] + "</b>&emsp;&emsp;<font color='black'><b>   Equipamento: </b>" + array_descricao[i]; 
  }
  
  
  //alert(msg_info);
  
  if(array_condicao_mb[i]!= array_condicao_banco[i])
  {
    
    $.ajax({
      url: 'salva_dados_mb.php',
      type: 'GET',
      dataType: 'json',
      data: {'ip': array_ip_mb[i],'condicao': array_condicao_mb[i], 'data': array_data_mb[i],'hora': array_hora_mb[i],'site': array_site[i], 'caminho_audio': array_caminho_audio[i] },
    });

  }// Fecha se condicao atual for diferente da do banco!
 } //Fecha for


 var link_lb_info = window.document.getElementById('lb_info');
 link_lb_info.innerHTML = "</BR>Encontrados " + encontrados_mb + " dispositivos!" + "</BR></BR> Onlines : "+ n_onlines +"</BR>"+ msg_info+"</BR></BR>Offlines: " + n_offlines+ "</BR>"+ msg_info2;

} // Fecha o function MB1






//document.location.reload(true);
location.href=`testes.php?id=${tb_valor_id.value}`;
//location.href=`testes.php?id=90`;

</script>




</body>
</html>
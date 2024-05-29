
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Modelo PHP</title>
</head>
<body>
 <input id='tbEPC' type="text" value = "" hidden="hidden" />
 <input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
 <input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>















<?php
$epc = $_GET['epc'];
$desativada = $_GET['acao'];
$criptografia = "";
$usuario_criptografado = "";
$complemento = $_GET['complemento'];
$check = $_GET['check'];
include_once 'conexao.php';
 if($desativada == "sim")
 {
  $epc_bloqueio = substr($epc,0,6)."88".substr($epc,8,18);
  $sql = $dbcon->query("UPDATE `lista_tags` SET desativada='$desativada' WHERE epc='$epc'");
  $sql = $dbcon->query("UPDATE `lista_tags` SET epc='$epc_bloqueio' WHERE epc='$epc'");
  ?>
  <script>
   var lusuario_criptografado = "<?php print $check ?>";
   var link_criptografia = window.document.getElementById('criptografia');
   link_criptografia.value = lusuario_criptografado;
   var lcriptografia = "<?php print $complemento ?>";
   var link_criptografia2 = window.document.getElementById('criptografia2');
   link_criptografia2.value = lcriptografia;

   

   var epc = "<?php print $epc_bloqueio ?>";
   var link_epc = window.document.getElementById('tbEPC');
   link_epc.value = epc;
   location.href=`editar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${tbEPC.value}`;
  </script>
  <?php
 }
else
{

// ENTRA PARA ATIVAR

  $epc_nova = substr($epc,0,6)."00".substr($epc,8,18);
  //Agora verifica se ela não esta sendo usada por outra tag
  $sql = $dbcon->query("SELECT * FROM `lista_tags` WHERE epc='$epc_nova'");
  if(mysqli_num_rows($sql)>0)
  {
   //Se entrou aqui pq esta sendo usada por outro e não pode salvar
   ?>
   <script>
   alert("Não foi possivel restaurar esta TAG pois a tag esta sendo aplicada para alguma outra placa no sistema!");
   var lusuario_criptografado = "<?php print $check ?>";
   var link_criptografia = window.document.getElementById('criptografia');
   link_criptografia.value = lusuario_criptografado;
   var lcriptografia = "<?php print $complemento ?>";
   var link_criptografia2 = window.document.getElementById('criptografia2');
   link_criptografia2.value = lcriptografia;
   var epc = "<?php print $epc ?>";
   var link_epc = window.document.getElementById('tbEPC');
   link_epc.value = epc;
   location.href=`editar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${tbEPC.value}`;
  </script>
  <?php
  }
  else
  {
   // Tudo ok, pode retornar esta tag
   $sql = $dbcon->query("UPDATE `lista_tags` SET desativada='$desativada' WHERE epc='$epc'");
   $sql = $dbcon->query("UPDATE `lista_tags` SET epc='$epc_nova' WHERE epc='$epc'");
   ?>
   <script>
   var lusuario_criptografado = "<?php print $check ?>";
   var link_criptografia = window.document.getElementById('criptografia');
   link_criptografia.value = lusuario_criptografado;
   var lcriptografia = "<?php print $complemento ?>";
   var link_criptografia2 = window.document.getElementById('criptografia2');
   link_criptografia2.value = lcriptografia;
   var epc = "<?php print $epc_nova ?>";
   var link_epc = window.document.getElementById('tbEPC');
   link_epc.value = epc;
   location.href=`editar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${tbEPC.value}`;
  </script>
  <?php
  
  }
  

  
}

   ?>
   


</body>
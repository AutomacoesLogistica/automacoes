<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<script src="js/index.js" type="text/javascript"></script>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body onload="limpar()">
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`consultar_cancelas_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>


<?php
// Busca o usuario passado e verifica no sistema
$usuario = "";
$tipo = "";
$criptografia = "";
$usuario_criptografado = "";
include_once 'conexao2.php';
$complemento = $_GET['complemento'];
$check = $_GET['check'];
$registro = ceil((floatval($complemento))/1.5);
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
window.Notification="Senha Incorreta!";
//window.location="login.php";
</script>
<?php
}
?>
<?php   
// VERIFICA SE O registro EXISTE
include_once 'conexao2.php';
$registro = $_GET['registro'];
$senha = $_GET['senha'];
$motivos = $_GET['motivos'];
$cancela = $_GET['cancela'];
$sitio = $_GET['sitio'];
$cod = $_GET['cod'];
$codigo_lora = $_GET['codigo_lora'];

include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM motivos_acionamentos WHERE motivo='$motivos'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['mensagem']; // Busco o valor da mensagem para acionar o rom, e saber se conta ou nao para entrar/sair
 }
}
?>

<?php

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$validado = 0;
$acesso_aciona_cancela = 0;
$sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND senha='$senha'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $usuario = $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
  $tipo = $dados['tipo_usuario'];
  $area = $dados['area'];
  $acesso_aciona_cancela = $dados['acesso_aciona_cancela']; // Busca o valor que esta em relação a numero de acessos
  if($acesso_aciona_cancela == "")
  {
   $acesso_aciona_cancela = '0';
  }
  $validado = 1; // Encontrou
 }
 $tipo = trim($tipo);
 if($tipo == "Operador CCL MB" Or $tipo == "Operador CCO" Or $tipo == "Desenvolvedor" Or $tipo == "Administrador" )
 {
  /*
  echo"ok";echo"</br>";
  echo $registro;echo"  -  ";echo $usuario;echo"  -  ";
  echo $tipo;echo"  -  ";echo $area;echo"</br>";
  echo $motivos;echo"</br>";echo $cancela;echo"  -  ";
  echo $sitio;echo"</br>";echo $data;echo"  -  ";
  echo $hora; echo"</br>";echo $codigo_lora;
  */
   
  /* Pode Salvar   */
  if($validado == 1)
  { 
   //Salva quem realizou o acionamento e qual deles! 
   include_once 'conexao2.php';
   $sql = $dbcon->query("INSERT INTO eventos SET registro='$registro', justificativa='$motivos', cancela='$cancela', data='$data', hora='$hora', nome_colaborador='$usuario', sitio='$sitio', area='$area'");
  
   // Atualiza no portal o numero de vezes que a pessoa já abriu a cancela
   $acesso_aciona_cancela = intval($acesso_aciona_cancela) + 1;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE pessoas SET acesso_aciona_cancela='$acesso_aciona_cancela' WHERE nome='$usuario'");


  /*Salvando o Comando */
  
  //PASSA OS PARÂMETROS PARA O ROM
  ?>
   <script>
    var valor = '<?php print trim($mensagem) ?>';
    var id = '<?php print trim($codigo_lora) ?>';
    //alert(mensagem);
    //alert(id);
    //URL_COMPLETA >>>EXemplo http://192.168.20.66/AutomacaoGerdau/monitor_rom.php?mensagem=manter&id=04
    var dados = "mensagem="+valor+"&id="+id;

    //PASSA VIA AJAX
    $.ajax({
      url: 'http://192.168.20.66/AutomacaoGerdau/monitor_rom.php?'+dados,
      type: 'GET',
      dataType: 'html',
      success: function(resultado)
      {
       alert(resultado);
      }
     });

   </script>
  <?php
  //echo " Salvo com sucesso!";
  ?>
  <script>
  usuario = "<?php print $usuario ?>";
  cancela = "<?php print $cancela ?>";
  
  alert("ATENÇÃO: "+ usuario +", você acabou de efetuar o acionamento na cancela de"+ cancela);
  location.href=`consultar_cancelas_utmii.php?complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}`;
  </script>
  <?php
  }
}
 else
 {
  ?>
  <script>
  alert("Usuario e Senha corretas porem sem permissão para realizar o acionamento!");
  location.href=`consultar_cancelas_utmii.php?complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}`;
  </script>
  <?php  
 }

}
else
{
  ?>
  <script>
  alert("Senha Incorreta!");
  location.href=`consultar_cancelas_utmii.php?complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}`;
  </script>
  <?php
}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Modelo PHP</title>
</head>
<body>
<div id="conexao" hidden="hidden">
<label id="colaborador"></label>
<label id="funcao"></label>

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
window.location="login.php";
</script>
<?php
}
?>
<div id="aux_suporte"></div>
<div id="aux_letreiro"></div>
<?php
include_once 'conexao_display_patrag.php';
$mensagem1 ="";
$mensagem2 = "";
$peso = "";
$semaforo_entrada = "";
$semaforo_saida = "";


$sql = $aux_conexao_display->query("SELECT * FROM balanca_01 WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $mensagem1 =$dados['mensagem1'];
  $mensagem2 = $dados['mensagem2'];
  $peso = $dados['peso'];
  $semaforo_entrada = $dados['semaforo_entrada'];
  $semaforo_saida = $dados['semaforo_saida'];
 }
}   
if($mensagem1 == "" && $mensagem2 == "")
{
 $mensagem1 = "     BALANCA 01     ";
 $mensagem2 = "  PATRAG - GERDAU   ";
}else
{
 if($mensagem1 == "")
 {
  $mensagem1 ="                    ";   
 }   
 if($mensagem2 == "")
 {
  $mensagem2 = "                    ";   
 }   
}


if($peso==""){$peso = "000000";}
if($semaforo_entrada ==""){$semaforo_entrada = "nao_definido";}
if($semaforo_entrada == "avancar" || $semaforo_entrada == "parar"){}else{$semaforo_entrada = "nao_definido";}
if($semaforo_saida ==""){$semaforo_saida = "nao_definido";}
if($semaforo_saida == "avancar" || $semaforo_saida == "parar"){}else{$semaforo_saida = "nao_definido";}

$linha_1_primeiro = substr($mensagem1,0,1);
if($linha_1_primeiro == " "){$linha_1_primeiro = "vz";}
elseif($linha_1_primeiro == "a"){$linha_1_primeiro = "-a";}
elseif($linha_1_primeiro == "b"){$linha_1_primeiro = "-b";}
elseif($linha_1_primeiro == "c"){$linha_1_primeiro = "-c";}
elseif($linha_1_primeiro == "d"){$linha_1_primeiro = "-d";}
elseif($linha_1_primeiro == "e"){$linha_1_primeiro = "-e";}
elseif($linha_1_primeiro == "f"){$linha_1_primeiro = "-f";}
elseif($linha_1_primeiro == "g"){$linha_1_primeiro = "-g";}
elseif($linha_1_primeiro == "h"){$linha_1_primeiro = "-h";}
elseif($linha_1_primeiro == "i"){$linha_1_primeiro = "-i";}
elseif($linha_1_primeiro == "j"){$linha_1_primeiro = "-j";}
elseif($linha_1_primeiro == "k"){$linha_1_primeiro = "-k";}
elseif($linha_1_primeiro == "l"){$linha_1_primeiro = "-l";}
elseif($linha_1_primeiro == "m"){$linha_1_primeiro = "-m";}
elseif($linha_1_primeiro == "n"){$linha_1_primeiro = "-n";}
elseif($linha_1_primeiro == "o"){$linha_1_primeiro = "-o";}
elseif($linha_1_primeiro == "p"){$linha_1_primeiro = "-p";}
elseif($linha_1_primeiro == "q"){$linha_1_primeiro = "-q";}
elseif($linha_1_primeiro == "r"){$linha_1_primeiro = "-r";}
elseif($linha_1_primeiro == "s"){$linha_1_primeiro = "-s";}
elseif($linha_1_primeiro == "t"){$linha_1_primeiro = "-t";}
elseif($linha_1_primeiro == "u"){$linha_1_primeiro = "-u";}
elseif($linha_1_primeiro == "v"){$linha_1_primeiro = "-v";}
elseif($linha_1_primeiro == "x"){$linha_1_primeiro = "-x";}
elseif($linha_1_primeiro == "y"){$linha_1_primeiro = "-y";}
elseif($linha_1_primeiro == "w"){$linha_1_primeiro = "-w";}
elseif($linha_1_primeiro == "z"){$linha_1_primeiro = "-z";}
elseif($linha_1_primeiro == ":"){$linha_1_primeiro = "2pontos";}
elseif($linha_1_primeiro == "*"){$linha_1_primeiro = "ast";}
elseif($linha_1_primeiro == "/"){$linha_1_primeiro = "barra_d";}
elseif($linha_1_primeiro == "?"){$linha_1_primeiro = "int";}
elseif($linha_1_primeiro == ">"){$linha_1_primeiro = "maiorq";}
elseif($linha_1_primeiro == "<"){$linha_1_primeiro = "menorq";}
else{$linha_1_primeiro = substr($mensagem1,0,1);}

$linha_2_primeiro = substr($mensagem1,1,1);
if($linha_2_primeiro == " "){$linha_2_primeiro = "vz";}
elseif($linha_2_primeiro == "a"){$linha_2_primeiro = "-a";}
elseif($linha_2_primeiro == "b"){$linha_2_primeiro = "-b";}
elseif($linha_2_primeiro == "c"){$linha_2_primeiro = "-c";}
elseif($linha_2_primeiro == "d"){$linha_2_primeiro = "-d";}
elseif($linha_2_primeiro == "e"){$linha_2_primeiro = "-e";}
elseif($linha_2_primeiro == "f"){$linha_2_primeiro = "-f";}
elseif($linha_2_primeiro == "g"){$linha_2_primeiro = "-g";}
elseif($linha_2_primeiro == "h"){$linha_2_primeiro = "-h";}
elseif($linha_2_primeiro == "i"){$linha_2_primeiro = "-i";}
elseif($linha_2_primeiro == "j"){$linha_2_primeiro = "-j";}
elseif($linha_2_primeiro == "k"){$linha_2_primeiro = "-k";}
elseif($linha_2_primeiro == "l"){$linha_2_primeiro = "-l";}
elseif($linha_2_primeiro == "m"){$linha_2_primeiro = "-m";}
elseif($linha_2_primeiro == "n"){$linha_2_primeiro = "-n";}
elseif($linha_2_primeiro == "o"){$linha_2_primeiro = "-o";}
elseif($linha_2_primeiro == "p"){$linha_2_primeiro = "-p";}
elseif($linha_2_primeiro == "q"){$linha_2_primeiro = "-q";}
elseif($linha_2_primeiro == "r"){$linha_2_primeiro = "-r";}
elseif($linha_2_primeiro == "s"){$linha_2_primeiro = "-s";}
elseif($linha_2_primeiro == "t"){$linha_2_primeiro = "-t";}
elseif($linha_2_primeiro == "u"){$linha_2_primeiro = "-u";}
elseif($linha_2_primeiro == "v"){$linha_2_primeiro = "-v";}
elseif($linha_2_primeiro == "x"){$linha_2_primeiro = "-x";}
elseif($linha_2_primeiro == "y"){$linha_2_primeiro = "-y";}
elseif($linha_2_primeiro == "w"){$linha_2_primeiro = "-w";}
elseif($linha_2_primeiro == "z"){$linha_2_primeiro = "-z";}
elseif($linha_2_primeiro == ":"){$linha_2_primeiro = "2pontos";}
elseif($linha_2_primeiro == "*"){$linha_2_primeiro = "ast";}
elseif($linha_2_primeiro == "/"){$linha_2_primeiro = "barra_d";}
elseif($linha_2_primeiro == "?"){$linha_2_primeiro = "int";}
elseif($linha_2_primeiro == ">"){$linha_2_primeiro = "maiorq";}
elseif($linha_2_primeiro == "<"){$linha_2_primeiro = "menorq";}
else{$linha_2_primeiro = substr($mensagem1,1,1);}


$linha_3_primeiro = substr($mensagem1,2,1);
if($linha_3_primeiro == " "){$linha_3_primeiro = "vz";}
elseif($linha_3_primeiro == "a"){$linha_3_primeiro = "-a";}
elseif($linha_3_primeiro == "b"){$linha_3_primeiro = "-b";}
elseif($linha_3_primeiro == "c"){$linha_3_primeiro = "-c";}
elseif($linha_3_primeiro == "d"){$linha_3_primeiro = "-d";}
elseif($linha_3_primeiro == "e"){$linha_3_primeiro = "-e";}
elseif($linha_3_primeiro == "f"){$linha_3_primeiro = "-f";}
elseif($linha_3_primeiro == "g"){$linha_3_primeiro = "-g";}
elseif($linha_3_primeiro == "h"){$linha_3_primeiro = "-h";}
elseif($linha_3_primeiro == "i"){$linha_3_primeiro = "-i";}
elseif($linha_3_primeiro == "j"){$linha_3_primeiro = "-j";}
elseif($linha_3_primeiro == "k"){$linha_3_primeiro = "-k";}
elseif($linha_3_primeiro == "l"){$linha_3_primeiro = "-l";}
elseif($linha_3_primeiro == "m"){$linha_3_primeiro = "-m";}
elseif($linha_3_primeiro == "n"){$linha_3_primeiro = "-n";}
elseif($linha_3_primeiro == "o"){$linha_3_primeiro = "-o";}
elseif($linha_3_primeiro == "p"){$linha_3_primeiro = "-p";}
elseif($linha_3_primeiro == "q"){$linha_3_primeiro = "-q";}
elseif($linha_3_primeiro == "r"){$linha_3_primeiro = "-r";}
elseif($linha_3_primeiro == "s"){$linha_3_primeiro = "-s";}
elseif($linha_3_primeiro == "t"){$linha_3_primeiro = "-t";}
elseif($linha_3_primeiro == "u"){$linha_3_primeiro = "-u";}
elseif($linha_3_primeiro == "v"){$linha_3_primeiro = "-v";}
elseif($linha_3_primeiro == "x"){$linha_3_primeiro = "-x";}
elseif($linha_3_primeiro == "y"){$linha_3_primeiro = "-y";}
elseif($linha_3_primeiro == "w"){$linha_3_primeiro = "-w";}
elseif($linha_3_primeiro == "z"){$linha_3_primeiro = "-z";}
elseif($linha_3_primeiro == ":"){$linha_3_primeiro = "2pontos";}
elseif($linha_3_primeiro == "*"){$linha_3_primeiro = "ast";}
elseif($linha_3_primeiro == "/"){$linha_3_primeiro = "barra_d";}
elseif($linha_3_primeiro == "?"){$linha_3_primeiro = "int";}
elseif($linha_3_primeiro == ">"){$linha_3_primeiro = "maiorq";}
elseif($linha_3_primeiro == "<"){$linha_3_primeiro = "menorq";}
else{$linha_3_primeiro = substr($mensagem1,2,1);}


$linha_4_primeiro = substr($mensagem1,3,1);
if($linha_4_primeiro == " "){$linha_4_primeiro = "vz";}
elseif($linha_4_primeiro == "a"){$linha_4_primeiro = "-a";}
elseif($linha_4_primeiro == "b"){$linha_4_primeiro = "-b";}
elseif($linha_4_primeiro == "c"){$linha_4_primeiro = "-c";}
elseif($linha_4_primeiro == "d"){$linha_4_primeiro = "-d";}
elseif($linha_4_primeiro == "e"){$linha_4_primeiro = "-e";}
elseif($linha_4_primeiro == "f"){$linha_4_primeiro = "-f";}
elseif($linha_4_primeiro == "g"){$linha_4_primeiro = "-g";}
elseif($linha_4_primeiro == "h"){$linha_4_primeiro = "-h";}
elseif($linha_4_primeiro == "i"){$linha_4_primeiro = "-i";}
elseif($linha_4_primeiro == "j"){$linha_4_primeiro = "-j";}
elseif($linha_4_primeiro == "k"){$linha_4_primeiro = "-k";}
elseif($linha_4_primeiro == "l"){$linha_4_primeiro = "-l";}
elseif($linha_4_primeiro == "m"){$linha_4_primeiro = "-m";}
elseif($linha_4_primeiro == "n"){$linha_4_primeiro = "-n";}
elseif($linha_4_primeiro == "o"){$linha_4_primeiro = "-o";}
elseif($linha_4_primeiro == "p"){$linha_4_primeiro = "-p";}
elseif($linha_4_primeiro == "q"){$linha_4_primeiro = "-q";}
elseif($linha_4_primeiro == "r"){$linha_4_primeiro = "-r";}
elseif($linha_4_primeiro == "s"){$linha_4_primeiro = "-s";}
elseif($linha_4_primeiro == "t"){$linha_4_primeiro = "-t";}
elseif($linha_4_primeiro == "u"){$linha_4_primeiro = "-u";}
elseif($linha_4_primeiro == "v"){$linha_4_primeiro = "-v";}
elseif($linha_4_primeiro == "x"){$linha_4_primeiro = "-x";}
elseif($linha_4_primeiro == "y"){$linha_4_primeiro = "-y";}
elseif($linha_4_primeiro == "w"){$linha_4_primeiro = "-w";}
elseif($linha_4_primeiro == "z"){$linha_4_primeiro = "-z";}
elseif($linha_4_primeiro == ":"){$linha_4_primeiro = "2pontos";}
elseif($linha_4_primeiro == "*"){$linha_4_primeiro = "ast";}
elseif($linha_4_primeiro == "/"){$linha_4_primeiro = "barra_d";}
elseif($linha_4_primeiro == "?"){$linha_4_primeiro = "int";}
elseif($linha_4_primeiro == ">"){$linha_4_primeiro = "maiorq";}
elseif($linha_4_primeiro == "<"){$linha_4_primeiro = "menorq";}
else{$linha_4_primeiro = substr($mensagem1,3,1);}


$linha_5_primeiro = substr($mensagem1,4,1);
if($linha_5_primeiro == " "){$linha_5_primeiro = "vz";}
elseif($linha_5_primeiro == "a"){$linha_5_primeiro = "-a";}
elseif($linha_5_primeiro == "b"){$linha_5_primeiro = "-b";}
elseif($linha_5_primeiro == "c"){$linha_5_primeiro = "-c";}
elseif($linha_5_primeiro == "d"){$linha_5_primeiro = "-d";}
elseif($linha_5_primeiro == "e"){$linha_5_primeiro = "-e";}
elseif($linha_5_primeiro == "f"){$linha_5_primeiro = "-f";}
elseif($linha_5_primeiro == "g"){$linha_5_primeiro = "-g";}
elseif($linha_5_primeiro == "h"){$linha_5_primeiro = "-h";}
elseif($linha_5_primeiro == "i"){$linha_5_primeiro = "-i";}
elseif($linha_5_primeiro == "j"){$linha_5_primeiro = "-j";}
elseif($linha_5_primeiro == "k"){$linha_5_primeiro = "-k";}
elseif($linha_5_primeiro == "l"){$linha_5_primeiro = "-l";}
elseif($linha_5_primeiro == "m"){$linha_5_primeiro = "-m";}
elseif($linha_5_primeiro == "n"){$linha_5_primeiro = "-n";}
elseif($linha_5_primeiro == "o"){$linha_5_primeiro = "-o";}
elseif($linha_5_primeiro == "p"){$linha_5_primeiro = "-p";}
elseif($linha_5_primeiro == "q"){$linha_5_primeiro = "-q";}
elseif($linha_5_primeiro == "r"){$linha_5_primeiro = "-r";}
elseif($linha_5_primeiro == "s"){$linha_5_primeiro = "-s";}
elseif($linha_5_primeiro == "t"){$linha_5_primeiro = "-t";}
elseif($linha_5_primeiro == "u"){$linha_5_primeiro = "-u";}
elseif($linha_5_primeiro == "v"){$linha_5_primeiro = "-v";}
elseif($linha_5_primeiro == "x"){$linha_5_primeiro = "-x";}
elseif($linha_5_primeiro == "y"){$linha_5_primeiro = "-y";}
elseif($linha_5_primeiro == "w"){$linha_5_primeiro = "-w";}
elseif($linha_5_primeiro == "z"){$linha_5_primeiro = "-z";}
elseif($linha_5_primeiro == ":"){$linha_5_primeiro = "2pontos";}
elseif($linha_5_primeiro == "*"){$linha_5_primeiro = "ast";}
elseif($linha_5_primeiro == "/"){$linha_5_primeiro = "barra_d";}
elseif($linha_5_primeiro == "?"){$linha_5_primeiro = "int";}
elseif($linha_5_primeiro == ">"){$linha_5_primeiro = "maiorq";}
elseif($linha_5_primeiro == "<"){$linha_5_primeiro = "menorq";}
else{$linha_5_primeiro = substr($mensagem1,4,1);}

$linha_6_primeiro = substr($mensagem1,5,1);
if($linha_6_primeiro == " "){$linha_6_primeiro = "vz";}
elseif($linha_6_primeiro == "a"){$linha_6_primeiro = "-a";}
elseif($linha_6_primeiro == "b"){$linha_6_primeiro = "-b";}
elseif($linha_6_primeiro == "c"){$linha_6_primeiro = "-c";}
elseif($linha_6_primeiro == "d"){$linha_6_primeiro = "-d";}
elseif($linha_6_primeiro == "e"){$linha_6_primeiro = "-e";}
elseif($linha_6_primeiro == "f"){$linha_6_primeiro = "-f";}
elseif($linha_6_primeiro == "g"){$linha_6_primeiro = "-g";}
elseif($linha_6_primeiro == "h"){$linha_6_primeiro = "-h";}
elseif($linha_6_primeiro == "i"){$linha_6_primeiro = "-i";}
elseif($linha_6_primeiro == "j"){$linha_6_primeiro = "-j";}
elseif($linha_6_primeiro == "k"){$linha_6_primeiro = "-k";}
elseif($linha_6_primeiro == "l"){$linha_6_primeiro = "-l";}
elseif($linha_6_primeiro == "m"){$linha_6_primeiro = "-m";}
elseif($linha_6_primeiro == "n"){$linha_6_primeiro = "-n";}
elseif($linha_6_primeiro == "o"){$linha_6_primeiro = "-o";}
elseif($linha_6_primeiro == "p"){$linha_6_primeiro = "-p";}
elseif($linha_6_primeiro == "q"){$linha_6_primeiro = "-q";}
elseif($linha_6_primeiro == "r"){$linha_6_primeiro = "-r";}
elseif($linha_6_primeiro == "s"){$linha_6_primeiro = "-s";}
elseif($linha_6_primeiro == "t"){$linha_6_primeiro = "-t";}
elseif($linha_6_primeiro == "u"){$linha_6_primeiro = "-u";}
elseif($linha_6_primeiro == "v"){$linha_6_primeiro = "-v";}
elseif($linha_6_primeiro == "x"){$linha_6_primeiro = "-x";}
elseif($linha_6_primeiro == "y"){$linha_6_primeiro = "-y";}
elseif($linha_6_primeiro == "w"){$linha_6_primeiro = "-w";}
elseif($linha_6_primeiro == "z"){$linha_6_primeiro = "-z";}
elseif($linha_6_primeiro == ":"){$linha_6_primeiro = "2pontos";}
elseif($linha_6_primeiro == "*"){$linha_6_primeiro = "ast";}
elseif($linha_6_primeiro == "/"){$linha_6_primeiro = "barra_d";}
elseif($linha_6_primeiro == "?"){$linha_6_primeiro = "int";}
elseif($linha_6_primeiro == ">"){$linha_6_primeiro = "maiorq";}
elseif($linha_6_primeiro == "<"){$linha_6_primeiro = "menorq";}
else{$linha_6_primeiro = substr($mensagem1,5,1);}

$linha_7_primeiro = substr($mensagem1,6,1);
if($linha_7_primeiro == " "){$linha_7_primeiro = "vz";}
elseif($linha_7_primeiro == "a"){$linha_7_primeiro = "-a";}
elseif($linha_7_primeiro == "b"){$linha_7_primeiro = "-b";}
elseif($linha_7_primeiro == "c"){$linha_7_primeiro = "-c";}
elseif($linha_7_primeiro == "d"){$linha_7_primeiro = "-d";}
elseif($linha_7_primeiro == "e"){$linha_7_primeiro = "-e";}
elseif($linha_7_primeiro == "f"){$linha_7_primeiro = "-f";}
elseif($linha_7_primeiro == "g"){$linha_7_primeiro = "-g";}
elseif($linha_7_primeiro == "h"){$linha_7_primeiro = "-h";}
elseif($linha_7_primeiro == "i"){$linha_7_primeiro = "-i";}
elseif($linha_7_primeiro == "j"){$linha_7_primeiro = "-j";}
elseif($linha_7_primeiro == "k"){$linha_7_primeiro = "-k";}
elseif($linha_7_primeiro == "l"){$linha_7_primeiro = "-l";}
elseif($linha_7_primeiro == "m"){$linha_7_primeiro = "-m";}
elseif($linha_7_primeiro == "n"){$linha_7_primeiro = "-n";}
elseif($linha_7_primeiro == "o"){$linha_7_primeiro = "-o";}
elseif($linha_7_primeiro == "p"){$linha_7_primeiro = "-p";}
elseif($linha_7_primeiro == "q"){$linha_7_primeiro = "-q";}
elseif($linha_7_primeiro == "r"){$linha_7_primeiro = "-r";}
elseif($linha_7_primeiro == "s"){$linha_7_primeiro = "-s";}
elseif($linha_7_primeiro == "t"){$linha_7_primeiro = "-t";}
elseif($linha_7_primeiro == "u"){$linha_7_primeiro = "-u";}
elseif($linha_7_primeiro == "v"){$linha_7_primeiro = "-v";}
elseif($linha_7_primeiro == "x"){$linha_7_primeiro = "-x";}
elseif($linha_7_primeiro == "y"){$linha_7_primeiro = "-y";}
elseif($linha_7_primeiro == "w"){$linha_7_primeiro = "-w";}
elseif($linha_7_primeiro == "z"){$linha_7_primeiro = "-z";}
elseif($linha_7_primeiro == ":"){$linha_7_primeiro = "2pontos";}
elseif($linha_7_primeiro == "*"){$linha_7_primeiro = "ast";}
elseif($linha_7_primeiro == "/"){$linha_7_primeiro = "barra_d";}
elseif($linha_7_primeiro == "?"){$linha_7_primeiro = "int";}
elseif($linha_7_primeiro == ">"){$linha_7_primeiro = "maiorq";}
elseif($linha_7_primeiro == "<"){$linha_7_primeiro = "menorq";}
else{$linha_7_primeiro = substr($mensagem1,6,1);}

$linha_8_primeiro = substr($mensagem1,7,1);
if($linha_8_primeiro == " "){$linha_8_primeiro = "vz";}
elseif($linha_8_primeiro == "a"){$linha_8_primeiro = "-a";}
elseif($linha_8_primeiro == "b"){$linha_8_primeiro = "-b";}
elseif($linha_8_primeiro == "c"){$linha_8_primeiro = "-c";}
elseif($linha_8_primeiro == "d"){$linha_8_primeiro = "-d";}
elseif($linha_8_primeiro == "e"){$linha_8_primeiro = "-e";}
elseif($linha_8_primeiro == "f"){$linha_8_primeiro = "-f";}
elseif($linha_8_primeiro == "g"){$linha_8_primeiro = "-g";}
elseif($linha_8_primeiro == "h"){$linha_8_primeiro = "-h";}
elseif($linha_8_primeiro == "i"){$linha_8_primeiro = "-i";}
elseif($linha_8_primeiro == "j"){$linha_8_primeiro = "-j";}
elseif($linha_8_primeiro == "k"){$linha_8_primeiro = "-k";}
elseif($linha_8_primeiro == "l"){$linha_8_primeiro = "-l";}
elseif($linha_8_primeiro == "m"){$linha_8_primeiro = "-m";}
elseif($linha_8_primeiro == "n"){$linha_8_primeiro = "-n";}
elseif($linha_8_primeiro == "o"){$linha_8_primeiro = "-o";}
elseif($linha_8_primeiro == "p"){$linha_8_primeiro = "-p";}
elseif($linha_8_primeiro == "q"){$linha_8_primeiro = "-q";}
elseif($linha_8_primeiro == "r"){$linha_8_primeiro = "-r";}
elseif($linha_8_primeiro == "s"){$linha_8_primeiro = "-s";}
elseif($linha_8_primeiro == "t"){$linha_8_primeiro = "-t";}
elseif($linha_8_primeiro == "u"){$linha_8_primeiro = "-u";}
elseif($linha_8_primeiro == "v"){$linha_8_primeiro = "-v";}
elseif($linha_8_primeiro == "x"){$linha_8_primeiro = "-x";}
elseif($linha_8_primeiro == "y"){$linha_8_primeiro = "-y";}
elseif($linha_8_primeiro == "w"){$linha_8_primeiro = "-w";}
elseif($linha_8_primeiro == "z"){$linha_8_primeiro = "-z";}
elseif($linha_8_primeiro == ":"){$linha_8_primeiro = "2pontos";}
elseif($linha_8_primeiro == "*"){$linha_8_primeiro = "ast";}
elseif($linha_8_primeiro == "/"){$linha_8_primeiro = "barra_d";}
elseif($linha_8_primeiro == "?"){$linha_8_primeiro = "int";}
elseif($linha_8_primeiro == ">"){$linha_8_primeiro = "maiorq";}
elseif($linha_8_primeiro == "<"){$linha_8_primeiro = "menorq";}
else{$linha_8_primeiro = substr($mensagem1,7,1);}

$linha_9_primeiro = substr($mensagem1,8,1);
if($linha_9_primeiro == " "){$linha_9_primeiro = "vz";}
elseif($linha_9_primeiro == "a"){$linha_9_primeiro = "-a";}
elseif($linha_9_primeiro == "b"){$linha_9_primeiro = "-b";}
elseif($linha_9_primeiro == "c"){$linha_9_primeiro = "-c";}
elseif($linha_9_primeiro == "d"){$linha_9_primeiro = "-d";}
elseif($linha_9_primeiro == "e"){$linha_9_primeiro = "-e";}
elseif($linha_9_primeiro == "f"){$linha_9_primeiro = "-f";}
elseif($linha_9_primeiro == "g"){$linha_9_primeiro = "-g";}
elseif($linha_9_primeiro == "h"){$linha_9_primeiro = "-h";}
elseif($linha_9_primeiro == "i"){$linha_9_primeiro = "-i";}
elseif($linha_9_primeiro == "j"){$linha_9_primeiro = "-j";}
elseif($linha_9_primeiro == "k"){$linha_9_primeiro = "-k";}
elseif($linha_9_primeiro == "l"){$linha_9_primeiro = "-l";}
elseif($linha_9_primeiro == "m"){$linha_9_primeiro = "-m";}
elseif($linha_9_primeiro == "n"){$linha_9_primeiro = "-n";}
elseif($linha_9_primeiro == "o"){$linha_9_primeiro = "-o";}
elseif($linha_9_primeiro == "p"){$linha_9_primeiro = "-p";}
elseif($linha_9_primeiro == "q"){$linha_9_primeiro = "-q";}
elseif($linha_9_primeiro == "r"){$linha_9_primeiro = "-r";}
elseif($linha_9_primeiro == "s"){$linha_9_primeiro = "-s";}
elseif($linha_9_primeiro == "t"){$linha_9_primeiro = "-t";}
elseif($linha_9_primeiro == "u"){$linha_9_primeiro = "-u";}
elseif($linha_9_primeiro == "v"){$linha_9_primeiro = "-v";}
elseif($linha_9_primeiro == "x"){$linha_9_primeiro = "-x";}
elseif($linha_9_primeiro == "y"){$linha_9_primeiro = "-y";}
elseif($linha_9_primeiro == "w"){$linha_9_primeiro = "-w";}
elseif($linha_9_primeiro == "z"){$linha_9_primeiro = "-z";}
elseif($linha_9_primeiro == ":"){$linha_9_primeiro = "2pontos";}
elseif($linha_9_primeiro == "*"){$linha_9_primeiro = "ast";}
elseif($linha_9_primeiro == "/"){$linha_9_primeiro = "barra_d";}
elseif($linha_9_primeiro == "?"){$linha_9_primeiro = "int";}
elseif($linha_9_primeiro == ">"){$linha_9_primeiro = "maiorq";}
elseif($linha_9_primeiro == "<"){$linha_9_primeiro = "menorq";}
else{$linha_9_primeiro = substr($mensagem1,8,1);}

$linha_10_primeiro = substr($mensagem1,9,1);
if($linha_10_primeiro == " "){$linha_10_primeiro = "vz";}
elseif($linha_10_primeiro == "a"){$linha_10_primeiro = "-a";}
elseif($linha_10_primeiro == "b"){$linha_10_primeiro = "-b";}
elseif($linha_10_primeiro == "c"){$linha_10_primeiro = "-c";}
elseif($linha_10_primeiro == "d"){$linha_10_primeiro = "-d";}
elseif($linha_10_primeiro == "e"){$linha_10_primeiro = "-e";}
elseif($linha_10_primeiro == "f"){$linha_10_primeiro = "-f";}
elseif($linha_10_primeiro == "g"){$linha_10_primeiro = "-g";}
elseif($linha_10_primeiro == "h"){$linha_10_primeiro = "-h";}
elseif($linha_10_primeiro == "i"){$linha_10_primeiro = "-i";}
elseif($linha_10_primeiro == "j"){$linha_10_primeiro = "-j";}
elseif($linha_10_primeiro == "k"){$linha_10_primeiro = "-k";}
elseif($linha_10_primeiro == "l"){$linha_10_primeiro = "-l";}
elseif($linha_10_primeiro == "m"){$linha_10_primeiro = "-m";}
elseif($linha_10_primeiro == "n"){$linha_10_primeiro = "-n";}
elseif($linha_10_primeiro == "o"){$linha_10_primeiro = "-o";}
elseif($linha_10_primeiro == "p"){$linha_10_primeiro = "-p";}
elseif($linha_10_primeiro == "q"){$linha_10_primeiro = "-q";}
elseif($linha_10_primeiro == "r"){$linha_10_primeiro = "-r";}
elseif($linha_10_primeiro == "s"){$linha_10_primeiro = "-s";}
elseif($linha_10_primeiro == "t"){$linha_10_primeiro = "-t";}
elseif($linha_10_primeiro == "u"){$linha_10_primeiro = "-u";}
elseif($linha_10_primeiro == "v"){$linha_10_primeiro = "-v";}
elseif($linha_10_primeiro == "x"){$linha_10_primeiro = "-x";}
elseif($linha_10_primeiro == "y"){$linha_10_primeiro = "-y";}
elseif($linha_10_primeiro == "w"){$linha_10_primeiro = "-w";}
elseif($linha_10_primeiro == "z"){$linha_10_primeiro = "-z";}
elseif($linha_10_primeiro == ":"){$linha_10_primeiro = "2pontos";}
elseif($linha_10_primeiro == "*"){$linha_10_primeiro = "ast";}
elseif($linha_10_primeiro == "/"){$linha_10_primeiro = "barra_d";}
elseif($linha_10_primeiro == "?"){$linha_10_primeiro = "int";}
elseif($linha_10_primeiro == ">"){$linha_10_primeiro = "maiorq";}
elseif($linha_10_primeiro == "<"){$linha_10_primeiro = "menorq";}
else{$linha_10_primeiro = substr($mensagem1,9,1);}

$linha_11_primeiro = substr($mensagem1,10,1);
if($linha_11_primeiro == " "){$linha_11_primeiro = "vz";}
elseif($linha_11_primeiro == "a"){$linha_11_primeiro = "-a";}
elseif($linha_11_primeiro == "b"){$linha_11_primeiro = "-b";}
elseif($linha_11_primeiro == "c"){$linha_11_primeiro = "-c";}
elseif($linha_11_primeiro == "d"){$linha_11_primeiro = "-d";}
elseif($linha_11_primeiro == "e"){$linha_11_primeiro = "-e";}
elseif($linha_11_primeiro == "f"){$linha_11_primeiro = "-f";}
elseif($linha_11_primeiro == "g"){$linha_11_primeiro = "-g";}
elseif($linha_11_primeiro == "h"){$linha_11_primeiro = "-h";}
elseif($linha_11_primeiro == "i"){$linha_11_primeiro = "-i";}
elseif($linha_11_primeiro == "j"){$linha_11_primeiro = "-j";}
elseif($linha_11_primeiro == "k"){$linha_11_primeiro = "-k";}
elseif($linha_11_primeiro == "l"){$linha_11_primeiro = "-l";}
elseif($linha_11_primeiro == "m"){$linha_11_primeiro = "-m";}
elseif($linha_11_primeiro == "n"){$linha_11_primeiro = "-n";}
elseif($linha_11_primeiro == "o"){$linha_11_primeiro = "-o";}
elseif($linha_11_primeiro == "p"){$linha_11_primeiro = "-p";}
elseif($linha_11_primeiro == "q"){$linha_11_primeiro = "-q";}
elseif($linha_11_primeiro == "r"){$linha_11_primeiro = "-r";}
elseif($linha_11_primeiro == "s"){$linha_11_primeiro = "-s";}
elseif($linha_11_primeiro == "t"){$linha_11_primeiro = "-t";}
elseif($linha_11_primeiro == "u"){$linha_11_primeiro = "-u";}
elseif($linha_11_primeiro == "v"){$linha_11_primeiro = "-v";}
elseif($linha_11_primeiro == "x"){$linha_11_primeiro = "-x";}
elseif($linha_11_primeiro == "y"){$linha_11_primeiro = "-y";}
elseif($linha_11_primeiro == "w"){$linha_11_primeiro = "-w";}
elseif($linha_11_primeiro == "z"){$linha_11_primeiro = "-z";}
elseif($linha_11_primeiro == ":"){$linha_11_primeiro = "2pontos";}
elseif($linha_11_primeiro == "*"){$linha_11_primeiro = "ast";}
elseif($linha_11_primeiro == "/"){$linha_11_primeiro = "barra_d";}
elseif($linha_11_primeiro == "?"){$linha_11_primeiro = "int";}
elseif($linha_11_primeiro == ">"){$linha_11_primeiro = "maiorq";}
elseif($linha_11_primeiro == "<"){$linha_11_primeiro = "menorq";}
else{$linha_11_primeiro = substr($mensagem1,10,1);}

$linha_12_primeiro = substr($mensagem1,11,1);
if($linha_12_primeiro == " "){$linha_12_primeiro = "vz";}
elseif($linha_12_primeiro == "a"){$linha_12_primeiro = "-a";}
elseif($linha_12_primeiro == "b"){$linha_12_primeiro = "-b";}
elseif($linha_12_primeiro == "c"){$linha_12_primeiro = "-c";}
elseif($linha_12_primeiro == "d"){$linha_12_primeiro = "-d";}
elseif($linha_12_primeiro == "e"){$linha_12_primeiro = "-e";}
elseif($linha_12_primeiro == "f"){$linha_12_primeiro = "-f";}
elseif($linha_12_primeiro == "g"){$linha_12_primeiro = "-g";}
elseif($linha_12_primeiro == "h"){$linha_12_primeiro = "-h";}
elseif($linha_12_primeiro == "i"){$linha_12_primeiro = "-i";}
elseif($linha_12_primeiro == "j"){$linha_12_primeiro = "-j";}
elseif($linha_12_primeiro == "k"){$linha_12_primeiro = "-k";}
elseif($linha_12_primeiro == "l"){$linha_12_primeiro = "-l";}
elseif($linha_12_primeiro == "m"){$linha_12_primeiro = "-m";}
elseif($linha_12_primeiro == "n"){$linha_12_primeiro = "-n";}
elseif($linha_12_primeiro == "o"){$linha_12_primeiro = "-o";}
elseif($linha_12_primeiro == "p"){$linha_12_primeiro = "-p";}
elseif($linha_12_primeiro == "q"){$linha_12_primeiro = "-q";}
elseif($linha_12_primeiro == "r"){$linha_12_primeiro = "-r";}
elseif($linha_12_primeiro == "s"){$linha_12_primeiro = "-s";}
elseif($linha_12_primeiro == "t"){$linha_12_primeiro = "-t";}
elseif($linha_12_primeiro == "u"){$linha_12_primeiro = "-u";}
elseif($linha_12_primeiro == "v"){$linha_12_primeiro = "-v";}
elseif($linha_12_primeiro == "x"){$linha_12_primeiro = "-x";}
elseif($linha_12_primeiro == "y"){$linha_12_primeiro = "-y";}
elseif($linha_12_primeiro == "w"){$linha_12_primeiro = "-w";}
elseif($linha_12_primeiro == "z"){$linha_12_primeiro = "-z";}
elseif($linha_12_primeiro == ":"){$linha_12_primeiro = "2pontos";}
elseif($linha_12_primeiro == "*"){$linha_12_primeiro = "ast";}
elseif($linha_12_primeiro == "/"){$linha_12_primeiro = "barra_d";}
elseif($linha_12_primeiro == "?"){$linha_12_primeiro = "int";}
elseif($linha_12_primeiro == ">"){$linha_12_primeiro = "maiorq";}
elseif($linha_12_primeiro == "<"){$linha_12_primeiro = "menorq";}
else{$linha_12_primeiro = substr($mensagem1,11,1);}

$linha_13_primeiro = substr($mensagem1,12,1);
if($linha_13_primeiro == " "){$linha_13_primeiro = "vz";}
elseif($linha_13_primeiro == "a"){$linha_13_primeiro = "-a";}
elseif($linha_13_primeiro == "b"){$linha_13_primeiro = "-b";}
elseif($linha_13_primeiro == "c"){$linha_13_primeiro = "-c";}
elseif($linha_13_primeiro == "d"){$linha_13_primeiro = "-d";}
elseif($linha_13_primeiro == "e"){$linha_13_primeiro = "-e";}
elseif($linha_13_primeiro == "f"){$linha_13_primeiro = "-f";}
elseif($linha_13_primeiro == "g"){$linha_13_primeiro = "-g";}
elseif($linha_13_primeiro == "h"){$linha_13_primeiro = "-h";}
elseif($linha_13_primeiro == "i"){$linha_13_primeiro = "-i";}
elseif($linha_13_primeiro == "j"){$linha_13_primeiro = "-j";}
elseif($linha_13_primeiro == "k"){$linha_13_primeiro = "-k";}
elseif($linha_13_primeiro == "l"){$linha_13_primeiro = "-l";}
elseif($linha_13_primeiro == "m"){$linha_13_primeiro = "-m";}
elseif($linha_13_primeiro == "n"){$linha_13_primeiro = "-n";}
elseif($linha_13_primeiro == "o"){$linha_13_primeiro = "-o";}
elseif($linha_13_primeiro == "p"){$linha_13_primeiro = "-p";}
elseif($linha_13_primeiro == "q"){$linha_13_primeiro = "-q";}
elseif($linha_13_primeiro == "r"){$linha_13_primeiro = "-r";}
elseif($linha_13_primeiro == "s"){$linha_13_primeiro = "-s";}
elseif($linha_13_primeiro == "t"){$linha_13_primeiro = "-t";}
elseif($linha_13_primeiro == "u"){$linha_13_primeiro = "-u";}
elseif($linha_13_primeiro == "v"){$linha_13_primeiro = "-v";}
elseif($linha_13_primeiro == "x"){$linha_13_primeiro = "-x";}
elseif($linha_13_primeiro == "y"){$linha_13_primeiro = "-y";}
elseif($linha_13_primeiro == "w"){$linha_13_primeiro = "-w";}
elseif($linha_13_primeiro == "z"){$linha_13_primeiro = "-z";}
elseif($linha_13_primeiro == ":"){$linha_13_primeiro = "2pontos";}
elseif($linha_13_primeiro == "*"){$linha_13_primeiro = "ast";}
elseif($linha_13_primeiro == "/"){$linha_13_primeiro = "barra_d";}
elseif($linha_13_primeiro == "?"){$linha_13_primeiro = "int";}
elseif($linha_13_primeiro == ">"){$linha_13_primeiro = "maiorq";}
elseif($linha_13_primeiro == "<"){$linha_13_primeiro = "menorq";}
else{$linha_13_primeiro = substr($mensagem1,12,1);}

$linha_14_primeiro = substr($mensagem1,13,1);
if($linha_14_primeiro == " "){$linha_14_primeiro = "vz";}
elseif($linha_14_primeiro == "a"){$linha_14_primeiro = "-a";}
elseif($linha_14_primeiro == "b"){$linha_14_primeiro = "-b";}
elseif($linha_14_primeiro == "c"){$linha_14_primeiro = "-c";}
elseif($linha_14_primeiro == "d"){$linha_14_primeiro = "-d";}
elseif($linha_14_primeiro == "e"){$linha_14_primeiro = "-e";}
elseif($linha_14_primeiro == "f"){$linha_14_primeiro = "-f";}
elseif($linha_14_primeiro == "g"){$linha_14_primeiro = "-g";}
elseif($linha_14_primeiro == "h"){$linha_14_primeiro = "-h";}
elseif($linha_14_primeiro == "i"){$linha_14_primeiro = "-i";}
elseif($linha_14_primeiro == "j"){$linha_14_primeiro = "-j";}
elseif($linha_14_primeiro == "k"){$linha_14_primeiro = "-k";}
elseif($linha_14_primeiro == "l"){$linha_14_primeiro = "-l";}
elseif($linha_14_primeiro == "m"){$linha_14_primeiro = "-m";}
elseif($linha_14_primeiro == "n"){$linha_14_primeiro = "-n";}
elseif($linha_14_primeiro == "o"){$linha_14_primeiro = "-o";}
elseif($linha_14_primeiro == "p"){$linha_14_primeiro = "-p";}
elseif($linha_14_primeiro == "q"){$linha_14_primeiro = "-q";}
elseif($linha_14_primeiro == "r"){$linha_14_primeiro = "-r";}
elseif($linha_14_primeiro == "s"){$linha_14_primeiro = "-s";}
elseif($linha_14_primeiro == "t"){$linha_14_primeiro = "-t";}
elseif($linha_14_primeiro == "u"){$linha_14_primeiro = "-u";}
elseif($linha_14_primeiro == "v"){$linha_14_primeiro = "-v";}
elseif($linha_14_primeiro == "x"){$linha_14_primeiro = "-x";}
elseif($linha_14_primeiro == "y"){$linha_14_primeiro = "-y";}
elseif($linha_14_primeiro == "w"){$linha_14_primeiro = "-w";}
elseif($linha_14_primeiro == "z"){$linha_14_primeiro = "-z";}
elseif($linha_14_primeiro == ":"){$linha_14_primeiro = "2pontos";}
elseif($linha_14_primeiro == "*"){$linha_14_primeiro = "ast";}
elseif($linha_14_primeiro == "/"){$linha_14_primeiro = "barra_d";}
elseif($linha_14_primeiro == "?"){$linha_14_primeiro = "int";}
elseif($linha_14_primeiro == ">"){$linha_14_primeiro = "maiorq";}
elseif($linha_14_primeiro == "<"){$linha_14_primeiro = "menorq";}
else{$linha_14_primeiro = substr($mensagem1,13,1);}

$linha_15_primeiro = substr($mensagem1,14,1);
if($linha_15_primeiro == " "){$linha_15_primeiro = "vz";}
elseif($linha_15_primeiro == "a"){$linha_15_primeiro = "-a";}
elseif($linha_15_primeiro == "b"){$linha_15_primeiro = "-b";}
elseif($linha_15_primeiro == "c"){$linha_15_primeiro = "-c";}
elseif($linha_15_primeiro == "d"){$linha_15_primeiro = "-d";}
elseif($linha_15_primeiro == "e"){$linha_15_primeiro = "-e";}
elseif($linha_15_primeiro == "f"){$linha_15_primeiro = "-f";}
elseif($linha_15_primeiro == "g"){$linha_15_primeiro = "-g";}
elseif($linha_15_primeiro == "h"){$linha_15_primeiro = "-h";}
elseif($linha_15_primeiro == "i"){$linha_15_primeiro = "-i";}
elseif($linha_15_primeiro == "j"){$linha_15_primeiro = "-j";}
elseif($linha_15_primeiro == "k"){$linha_15_primeiro = "-k";}
elseif($linha_15_primeiro == "l"){$linha_15_primeiro = "-l";}
elseif($linha_15_primeiro == "m"){$linha_15_primeiro = "-m";}
elseif($linha_15_primeiro == "n"){$linha_15_primeiro = "-n";}
elseif($linha_15_primeiro == "o"){$linha_15_primeiro = "-o";}
elseif($linha_15_primeiro == "p"){$linha_15_primeiro = "-p";}
elseif($linha_15_primeiro == "q"){$linha_15_primeiro = "-q";}
elseif($linha_15_primeiro == "r"){$linha_15_primeiro = "-r";}
elseif($linha_15_primeiro == "s"){$linha_15_primeiro = "-s";}
elseif($linha_15_primeiro == "t"){$linha_15_primeiro = "-t";}
elseif($linha_15_primeiro == "u"){$linha_15_primeiro = "-u";}
elseif($linha_15_primeiro == "v"){$linha_15_primeiro = "-v";}
elseif($linha_15_primeiro == "x"){$linha_15_primeiro = "-x";}
elseif($linha_15_primeiro == "y"){$linha_15_primeiro = "-y";}
elseif($linha_15_primeiro == "w"){$linha_15_primeiro = "-w";}
elseif($linha_15_primeiro == "z"){$linha_15_primeiro = "-z";}
elseif($linha_15_primeiro == ":"){$linha_15_primeiro = "2pontos";}
elseif($linha_15_primeiro == "*"){$linha_15_primeiro = "ast";}
elseif($linha_15_primeiro == "/"){$linha_15_primeiro = "barra_d";}
elseif($linha_15_primeiro == "?"){$linha_15_primeiro = "int";}
elseif($linha_15_primeiro == ">"){$linha_15_primeiro = "maiorq";}
elseif($linha_15_primeiro == "<"){$linha_15_primeiro = "menorq";}
else{$linha_15_primeiro = substr($mensagem1,14,1);}

$linha_16_primeiro = substr($mensagem1,15,1);
if($linha_16_primeiro == " "){$linha_16_primeiro = "vz";}
elseif($linha_16_primeiro == "a"){$linha_16_primeiro = "-a";}
elseif($linha_16_primeiro == "b"){$linha_16_primeiro = "-b";}
elseif($linha_16_primeiro == "c"){$linha_16_primeiro = "-c";}
elseif($linha_16_primeiro == "d"){$linha_16_primeiro = "-d";}
elseif($linha_16_primeiro == "e"){$linha_16_primeiro = "-e";}
elseif($linha_16_primeiro == "f"){$linha_16_primeiro = "-f";}
elseif($linha_16_primeiro == "g"){$linha_16_primeiro = "-g";}
elseif($linha_16_primeiro == "h"){$linha_16_primeiro = "-h";}
elseif($linha_16_primeiro == "i"){$linha_16_primeiro = "-i";}
elseif($linha_16_primeiro == "j"){$linha_16_primeiro = "-j";}
elseif($linha_16_primeiro == "k"){$linha_16_primeiro = "-k";}
elseif($linha_16_primeiro == "l"){$linha_16_primeiro = "-l";}
elseif($linha_16_primeiro == "m"){$linha_16_primeiro = "-m";}
elseif($linha_16_primeiro == "n"){$linha_16_primeiro = "-n";}
elseif($linha_16_primeiro == "o"){$linha_16_primeiro = "-o";}
elseif($linha_16_primeiro == "p"){$linha_16_primeiro = "-p";}
elseif($linha_16_primeiro == "q"){$linha_16_primeiro = "-q";}
elseif($linha_16_primeiro == "r"){$linha_16_primeiro = "-r";}
elseif($linha_16_primeiro == "s"){$linha_16_primeiro = "-s";}
elseif($linha_16_primeiro == "t"){$linha_16_primeiro = "-t";}
elseif($linha_16_primeiro == "u"){$linha_16_primeiro = "-u";}
elseif($linha_16_primeiro == "v"){$linha_16_primeiro = "-v";}
elseif($linha_16_primeiro == "x"){$linha_16_primeiro = "-x";}
elseif($linha_16_primeiro == "y"){$linha_16_primeiro = "-y";}
elseif($linha_16_primeiro == "w"){$linha_16_primeiro = "-w";}
elseif($linha_16_primeiro == "z"){$linha_16_primeiro = "-z";}
elseif($linha_16_primeiro == ":"){$linha_16_primeiro = "2pontos";}
elseif($linha_16_primeiro == "*"){$linha_16_primeiro = "ast";}
elseif($linha_16_primeiro == "/"){$linha_16_primeiro = "barra_d";}
elseif($linha_16_primeiro == "?"){$linha_16_primeiro = "int";}
elseif($linha_16_primeiro == ">"){$linha_16_primeiro = "maiorq";}
elseif($linha_16_primeiro == "<"){$linha_16_primeiro = "menorq";}
else{$linha_16_primeiro = substr($mensagem1,15,1);}

$linha_17_primeiro = substr($mensagem1,16,1);
if($linha_17_primeiro == " "){$linha_17_primeiro = "vz";}
elseif($linha_17_primeiro == "a"){$linha_17_primeiro = "-a";}
elseif($linha_17_primeiro == "b"){$linha_17_primeiro = "-b";}
elseif($linha_17_primeiro == "c"){$linha_17_primeiro = "-c";}
elseif($linha_17_primeiro == "d"){$linha_17_primeiro = "-d";}
elseif($linha_17_primeiro == "e"){$linha_17_primeiro = "-e";}
elseif($linha_17_primeiro == "f"){$linha_17_primeiro = "-f";}
elseif($linha_17_primeiro == "g"){$linha_17_primeiro = "-g";}
elseif($linha_17_primeiro == "h"){$linha_17_primeiro = "-h";}
elseif($linha_17_primeiro == "i"){$linha_17_primeiro = "-i";}
elseif($linha_17_primeiro == "j"){$linha_17_primeiro = "-j";}
elseif($linha_17_primeiro == "k"){$linha_17_primeiro = "-k";}
elseif($linha_17_primeiro == "l"){$linha_17_primeiro = "-l";}
elseif($linha_17_primeiro == "m"){$linha_17_primeiro = "-m";}
elseif($linha_17_primeiro == "n"){$linha_17_primeiro = "-n";}
elseif($linha_17_primeiro == "o"){$linha_17_primeiro = "-o";}
elseif($linha_17_primeiro == "p"){$linha_17_primeiro = "-p";}
elseif($linha_17_primeiro == "q"){$linha_17_primeiro = "-q";}
elseif($linha_17_primeiro == "r"){$linha_17_primeiro = "-r";}
elseif($linha_17_primeiro == "s"){$linha_17_primeiro = "-s";}
elseif($linha_17_primeiro == "t"){$linha_17_primeiro = "-t";}
elseif($linha_17_primeiro == "u"){$linha_17_primeiro = "-u";}
elseif($linha_17_primeiro == "v"){$linha_17_primeiro = "-v";}
elseif($linha_17_primeiro == "x"){$linha_17_primeiro = "-x";}
elseif($linha_17_primeiro == "y"){$linha_17_primeiro = "-y";}
elseif($linha_17_primeiro == "w"){$linha_17_primeiro = "-w";}
elseif($linha_17_primeiro == "z"){$linha_17_primeiro = "-z";}
elseif($linha_17_primeiro == ":"){$linha_17_primeiro = "2pontos";}
elseif($linha_17_primeiro == "*"){$linha_17_primeiro = "ast";}
elseif($linha_17_primeiro == "/"){$linha_17_primeiro = "barra_d";}
elseif($linha_17_primeiro == "?"){$linha_17_primeiro = "int";}
elseif($linha_17_primeiro == ">"){$linha_17_primeiro = "maiorq";}
elseif($linha_17_primeiro == "<"){$linha_17_primeiro = "menorq";}
else{$linha_17_primeiro = substr($mensagem1,16,1);}

$linha_18_primeiro = substr($mensagem1,17,1);
if($linha_18_primeiro == " "){$linha_18_primeiro = "vz";}
elseif($linha_18_primeiro == "a"){$linha_18_primeiro = "-a";}
elseif($linha_18_primeiro == "b"){$linha_18_primeiro = "-b";}
elseif($linha_18_primeiro == "c"){$linha_18_primeiro = "-c";}
elseif($linha_18_primeiro == "d"){$linha_18_primeiro = "-d";}
elseif($linha_18_primeiro == "e"){$linha_18_primeiro = "-e";}
elseif($linha_18_primeiro == "f"){$linha_18_primeiro = "-f";}
elseif($linha_18_primeiro == "g"){$linha_18_primeiro = "-g";}
elseif($linha_18_primeiro == "h"){$linha_18_primeiro = "-h";}
elseif($linha_18_primeiro == "i"){$linha_18_primeiro = "-i";}
elseif($linha_18_primeiro == "j"){$linha_18_primeiro = "-j";}
elseif($linha_18_primeiro == "k"){$linha_18_primeiro = "-k";}
elseif($linha_18_primeiro == "l"){$linha_18_primeiro = "-l";}
elseif($linha_18_primeiro == "m"){$linha_18_primeiro = "-m";}
elseif($linha_18_primeiro == "n"){$linha_18_primeiro = "-n";}
elseif($linha_18_primeiro == "o"){$linha_18_primeiro = "-o";}
elseif($linha_18_primeiro == "p"){$linha_18_primeiro = "-p";}
elseif($linha_18_primeiro == "q"){$linha_18_primeiro = "-q";}
elseif($linha_18_primeiro == "r"){$linha_18_primeiro = "-r";}
elseif($linha_18_primeiro == "s"){$linha_18_primeiro = "-s";}
elseif($linha_18_primeiro == "t"){$linha_18_primeiro = "-t";}
elseif($linha_18_primeiro == "u"){$linha_18_primeiro = "-u";}
elseif($linha_18_primeiro == "v"){$linha_18_primeiro = "-v";}
elseif($linha_18_primeiro == "x"){$linha_18_primeiro = "-x";}
elseif($linha_18_primeiro == "y"){$linha_18_primeiro = "-y";}
elseif($linha_18_primeiro == "w"){$linha_18_primeiro = "-w";}
elseif($linha_18_primeiro == "z"){$linha_18_primeiro = "-z";}
elseif($linha_18_primeiro == ":"){$linha_18_primeiro = "2pontos";}
elseif($linha_18_primeiro == "*"){$linha_18_primeiro = "ast";}
elseif($linha_18_primeiro == "/"){$linha_18_primeiro = "barra_d";}
elseif($linha_18_primeiro == "?"){$linha_18_primeiro = "int";}
elseif($linha_18_primeiro == ">"){$linha_18_primeiro = "maiorq";}
elseif($linha_18_primeiro == "<"){$linha_18_primeiro = "menorq";}
else{$linha_18_primeiro = substr($mensagem1,17,1);}

$linha_19_primeiro = substr($mensagem1,18,1);
if($linha_19_primeiro == " "){$linha_19_primeiro = "vz";}
elseif($linha_19_primeiro == "a"){$linha_19_primeiro = "-a";}
elseif($linha_19_primeiro == "b"){$linha_19_primeiro = "-b";}
elseif($linha_19_primeiro == "c"){$linha_19_primeiro = "-c";}
elseif($linha_19_primeiro == "d"){$linha_19_primeiro = "-d";}
elseif($linha_19_primeiro == "e"){$linha_19_primeiro = "-e";}
elseif($linha_19_primeiro == "f"){$linha_19_primeiro = "-f";}
elseif($linha_19_primeiro == "g"){$linha_19_primeiro = "-g";}
elseif($linha_19_primeiro == "h"){$linha_19_primeiro = "-h";}
elseif($linha_19_primeiro == "i"){$linha_19_primeiro = "-i";}
elseif($linha_19_primeiro == "j"){$linha_19_primeiro = "-j";}
elseif($linha_19_primeiro == "k"){$linha_19_primeiro = "-k";}
elseif($linha_19_primeiro == "l"){$linha_19_primeiro = "-l";}
elseif($linha_19_primeiro == "m"){$linha_19_primeiro = "-m";}
elseif($linha_19_primeiro == "n"){$linha_19_primeiro = "-n";}
elseif($linha_19_primeiro == "o"){$linha_19_primeiro = "-o";}
elseif($linha_19_primeiro == "p"){$linha_19_primeiro = "-p";}
elseif($linha_19_primeiro == "q"){$linha_19_primeiro = "-q";}
elseif($linha_19_primeiro == "r"){$linha_19_primeiro = "-r";}
elseif($linha_19_primeiro == "s"){$linha_19_primeiro = "-s";}
elseif($linha_19_primeiro == "t"){$linha_19_primeiro = "-t";}
elseif($linha_19_primeiro == "u"){$linha_19_primeiro = "-u";}
elseif($linha_19_primeiro == "v"){$linha_19_primeiro = "-v";}
elseif($linha_19_primeiro == "x"){$linha_19_primeiro = "-x";}
elseif($linha_19_primeiro == "y"){$linha_19_primeiro = "-y";}
elseif($linha_19_primeiro == "w"){$linha_19_primeiro = "-w";}
elseif($linha_19_primeiro == "z"){$linha_19_primeiro = "-z";}
elseif($linha_19_primeiro == ":"){$linha_19_primeiro = "2pontos";}
elseif($linha_19_primeiro == "*"){$linha_19_primeiro = "ast";}
elseif($linha_19_primeiro == "/"){$linha_19_primeiro = "barra_d";}
elseif($linha_19_primeiro == "?"){$linha_19_primeiro = "int";}
elseif($linha_19_primeiro == ">"){$linha_19_primeiro = "maiorq";}
elseif($linha_19_primeiro == "<"){$linha_19_primeiro = "menorq";}
else{$linha_19_primeiro = substr($mensagem1,18,1);}


$linha_20_primeiro = substr($mensagem1,19,1);
if($linha_20_primeiro == " "){$linha_20_primeiro = "vz";}
elseif($linha_20_primeiro == "a"){$linha_20_primeiro = "-a";}
elseif($linha_20_primeiro == "b"){$linha_20_primeiro = "-b";}
elseif($linha_20_primeiro == "c"){$linha_20_primeiro = "-c";}
elseif($linha_20_primeiro == "d"){$linha_20_primeiro = "-d";}
elseif($linha_20_primeiro == "e"){$linha_20_primeiro = "-e";}
elseif($linha_20_primeiro == "f"){$linha_20_primeiro = "-f";}
elseif($linha_20_primeiro == "g"){$linha_20_primeiro = "-g";}
elseif($linha_20_primeiro == "h"){$linha_20_primeiro = "-h";}
elseif($linha_20_primeiro == "i"){$linha_20_primeiro = "-i";}
elseif($linha_20_primeiro == "j"){$linha_20_primeiro = "-j";}
elseif($linha_20_primeiro == "k"){$linha_20_primeiro = "-k";}
elseif($linha_20_primeiro == "l"){$linha_20_primeiro = "-l";}
elseif($linha_20_primeiro == "m"){$linha_20_primeiro = "-m";}
elseif($linha_20_primeiro == "n"){$linha_20_primeiro = "-n";}
elseif($linha_20_primeiro == "o"){$linha_20_primeiro = "-o";}
elseif($linha_20_primeiro == "p"){$linha_20_primeiro = "-p";}
elseif($linha_20_primeiro == "q"){$linha_20_primeiro = "-q";}
elseif($linha_20_primeiro == "r"){$linha_20_primeiro = "-r";}
elseif($linha_20_primeiro == "s"){$linha_20_primeiro = "-s";}
elseif($linha_20_primeiro == "t"){$linha_20_primeiro = "-t";}
elseif($linha_20_primeiro == "u"){$linha_20_primeiro = "-u";}
elseif($linha_20_primeiro == "v"){$linha_20_primeiro = "-v";}
elseif($linha_20_primeiro == "x"){$linha_20_primeiro = "-x";}
elseif($linha_20_primeiro == "y"){$linha_20_primeiro = "-y";}
elseif($linha_20_primeiro == "w"){$linha_20_primeiro = "-w";}
elseif($linha_20_primeiro == "z"){$linha_20_primeiro = "-z";}
elseif($linha_20_primeiro == ":"){$linha_20_primeiro = "2pontos";}
elseif($linha_20_primeiro == "*"){$linha_20_primeiro = "ast";}
elseif($linha_20_primeiro == "/"){$linha_20_primeiro = "barra_d";}
elseif($linha_20_primeiro == "?"){$linha_20_primeiro = "int";}
elseif($linha_20_primeiro == ">"){$linha_20_primeiro = "maiorq";}
elseif($linha_20_primeiro == "<"){$linha_20_primeiro = "menorq";}
else{$linha_20_primeiro = substr($mensagem1,19,1);}


//  SEGUNDA LINHA DO DISPLAY





$linha_1_segundo = substr($mensagem2,0,1);
if($linha_1_segundo == " "){$linha_1_segundo = "vz";}
elseif($linha_1_segundo == "a"){$linha_1_segundo = "-a";}
elseif($linha_1_segundo == "b"){$linha_1_segundo = "-b";}
elseif($linha_1_segundo == "c"){$linha_1_segundo = "-c";}
elseif($linha_1_segundo == "d"){$linha_1_segundo = "-d";}
elseif($linha_1_segundo == "e"){$linha_1_segundo = "-e";}
elseif($linha_1_segundo == "f"){$linha_1_segundo = "-f";}
elseif($linha_1_segundo == "g"){$linha_1_segundo = "-g";}
elseif($linha_1_segundo == "h"){$linha_1_segundo = "-h";}
elseif($linha_1_segundo == "i"){$linha_1_segundo = "-i";}
elseif($linha_1_segundo == "j"){$linha_1_segundo = "-j";}
elseif($linha_1_segundo == "k"){$linha_1_segundo = "-k";}
elseif($linha_1_segundo == "l"){$linha_1_segundo = "-l";}
elseif($linha_1_segundo == "m"){$linha_1_segundo = "-m";}
elseif($linha_1_segundo == "n"){$linha_1_segundo = "-n";}
elseif($linha_1_segundo == "o"){$linha_1_segundo = "-o";}
elseif($linha_1_segundo == "p"){$linha_1_segundo = "-p";}
elseif($linha_1_segundo == "q"){$linha_1_segundo = "-q";}
elseif($linha_1_segundo == "r"){$linha_1_segundo = "-r";}
elseif($linha_1_segundo == "s"){$linha_1_segundo = "-s";}
elseif($linha_1_segundo == "t"){$linha_1_segundo = "-t";}
elseif($linha_1_segundo == "u"){$linha_1_segundo = "-u";}
elseif($linha_1_segundo == "v"){$linha_1_segundo = "-v";}
elseif($linha_1_segundo == "x"){$linha_1_segundo = "-x";}
elseif($linha_1_segundo == "y"){$linha_1_segundo = "-y";}
elseif($linha_1_segundo == "w"){$linha_1_segundo = "-w";}
elseif($linha_1_segundo == "z"){$linha_1_segundo = "-z";}
elseif($linha_1_segundo == ":"){$linha_1_segundo = "2pontos";}
elseif($linha_1_segundo == "*"){$linha_1_segundo = "ast";}
elseif($linha_1_segundo == "/"){$linha_1_segundo = "barra_d";}
elseif($linha_1_segundo == "?"){$linha_1_segundo = "int";}
elseif($linha_1_segundo == ">"){$linha_1_segundo = "maiorq";}
elseif($linha_1_segundo == "<"){$linha_1_segundo = "menorq";}
else{$linha_1_segundo = substr($mensagem2,0,1);}

$linha_2_segundo = substr($mensagem2,1,1);
if($linha_2_segundo == " "){$linha_2_segundo = "vz";}
elseif($linha_2_segundo == "a"){$linha_2_segundo = "-a";}
elseif($linha_2_segundo == "b"){$linha_2_segundo = "-b";}
elseif($linha_2_segundo == "c"){$linha_2_segundo = "-c";}
elseif($linha_2_segundo == "d"){$linha_2_segundo = "-d";}
elseif($linha_2_segundo == "e"){$linha_2_segundo = "-e";}
elseif($linha_2_segundo == "f"){$linha_2_segundo = "-f";}
elseif($linha_2_segundo == "g"){$linha_2_segundo = "-g";}
elseif($linha_2_segundo == "h"){$linha_2_segundo = "-h";}
elseif($linha_2_segundo == "i"){$linha_2_segundo = "-i";}
elseif($linha_2_segundo == "j"){$linha_2_segundo = "-j";}
elseif($linha_2_segundo == "k"){$linha_2_segundo = "-k";}
elseif($linha_2_segundo == "l"){$linha_2_segundo = "-l";}
elseif($linha_2_segundo == "m"){$linha_2_segundo = "-m";}
elseif($linha_2_segundo == "n"){$linha_2_segundo = "-n";}
elseif($linha_2_segundo == "o"){$linha_2_segundo = "-o";}
elseif($linha_2_segundo == "p"){$linha_2_segundo = "-p";}
elseif($linha_2_segundo == "q"){$linha_2_segundo = "-q";}
elseif($linha_2_segundo == "r"){$linha_2_segundo = "-r";}
elseif($linha_2_segundo == "s"){$linha_2_segundo = "-s";}
elseif($linha_2_segundo == "t"){$linha_2_segundo = "-t";}
elseif($linha_2_segundo == "u"){$linha_2_segundo = "-u";}
elseif($linha_2_segundo == "v"){$linha_2_segundo = "-v";}
elseif($linha_2_segundo == "x"){$linha_2_segundo = "-x";}
elseif($linha_2_segundo == "y"){$linha_2_segundo = "-y";}
elseif($linha_2_segundo == "w"){$linha_2_segundo = "-w";}
elseif($linha_2_segundo == "z"){$linha_2_segundo = "-z";}
elseif($linha_2_segundo == ":"){$linha_2_segundo = "2pontos";}
elseif($linha_2_segundo == "*"){$linha_2_segundo = "ast";}
elseif($linha_2_segundo == "/"){$linha_2_segundo = "barra_d";}
elseif($linha_2_segundo == "?"){$linha_2_segundo = "int";}
elseif($linha_2_segundo == ">"){$linha_2_segundo = "maiorq";}
elseif($linha_2_segundo == "<"){$linha_2_segundo = "menorq";}
else{$linha_2_segundo = substr($mensagem2,1,1);}


$linha_3_segundo = substr($mensagem2,2,1);
if($linha_3_segundo == " "){$linha_3_segundo = "vz";}
elseif($linha_3_segundo == "a"){$linha_3_segundo = "-a";}
elseif($linha_3_segundo == "b"){$linha_3_segundo = "-b";}
elseif($linha_3_segundo == "c"){$linha_3_segundo = "-c";}
elseif($linha_3_segundo == "d"){$linha_3_segundo = "-d";}
elseif($linha_3_segundo == "e"){$linha_3_segundo = "-e";}
elseif($linha_3_segundo == "f"){$linha_3_segundo = "-f";}
elseif($linha_3_segundo == "g"){$linha_3_segundo = "-g";}
elseif($linha_3_segundo == "h"){$linha_3_segundo = "-h";}
elseif($linha_3_segundo == "i"){$linha_3_segundo = "-i";}
elseif($linha_3_segundo == "j"){$linha_3_segundo = "-j";}
elseif($linha_3_segundo == "k"){$linha_3_segundo = "-k";}
elseif($linha_3_segundo == "l"){$linha_3_segundo = "-l";}
elseif($linha_3_segundo == "m"){$linha_3_segundo = "-m";}
elseif($linha_3_segundo == "n"){$linha_3_segundo = "-n";}
elseif($linha_3_segundo == "o"){$linha_3_segundo = "-o";}
elseif($linha_3_segundo == "p"){$linha_3_segundo = "-p";}
elseif($linha_3_segundo == "q"){$linha_3_segundo = "-q";}
elseif($linha_3_segundo == "r"){$linha_3_segundo = "-r";}
elseif($linha_3_segundo == "s"){$linha_3_segundo = "-s";}
elseif($linha_3_segundo == "t"){$linha_3_segundo = "-t";}
elseif($linha_3_segundo == "u"){$linha_3_segundo = "-u";}
elseif($linha_3_segundo == "v"){$linha_3_segundo = "-v";}
elseif($linha_3_segundo == "x"){$linha_3_segundo = "-x";}
elseif($linha_3_segundo == "y"){$linha_3_segundo = "-y";}
elseif($linha_3_segundo == "w"){$linha_3_segundo = "-w";}
elseif($linha_3_segundo == "z"){$linha_3_segundo = "-z";}
elseif($linha_3_segundo == ":"){$linha_3_segundo = "2pontos";}
elseif($linha_3_segundo == "*"){$linha_3_segundo = "ast";}
elseif($linha_3_segundo == "/"){$linha_3_segundo = "barra_d";}
elseif($linha_3_segundo == "?"){$linha_3_segundo = "int";}
elseif($linha_3_segundo == ">"){$linha_3_segundo = "maiorq";}
elseif($linha_3_segundo == "<"){$linha_3_segundo = "menorq";}
else{$linha_3_segundo = substr($mensagem2,2,1);}


$linha_4_segundo = substr($mensagem2,3,1);
if($linha_4_segundo == " "){$linha_4_segundo = "vz";}
elseif($linha_4_segundo == "a"){$linha_4_segundo = "-a";}
elseif($linha_4_segundo == "b"){$linha_4_segundo = "-b";}
elseif($linha_4_segundo == "c"){$linha_4_segundo = "-c";}
elseif($linha_4_segundo == "d"){$linha_4_segundo = "-d";}
elseif($linha_4_segundo == "e"){$linha_4_segundo = "-e";}
elseif($linha_4_segundo == "f"){$linha_4_segundo = "-f";}
elseif($linha_4_segundo == "g"){$linha_4_segundo = "-g";}
elseif($linha_4_segundo == "h"){$linha_4_segundo = "-h";}
elseif($linha_4_segundo == "i"){$linha_4_segundo = "-i";}
elseif($linha_4_segundo == "j"){$linha_4_segundo = "-j";}
elseif($linha_4_segundo == "k"){$linha_4_segundo = "-k";}
elseif($linha_4_segundo == "l"){$linha_4_segundo = "-l";}
elseif($linha_4_segundo == "m"){$linha_4_segundo = "-m";}
elseif($linha_4_segundo == "n"){$linha_4_segundo = "-n";}
elseif($linha_4_segundo == "o"){$linha_4_segundo = "-o";}
elseif($linha_4_segundo == "p"){$linha_4_segundo = "-p";}
elseif($linha_4_segundo == "q"){$linha_4_segundo = "-q";}
elseif($linha_4_segundo == "r"){$linha_4_segundo = "-r";}
elseif($linha_4_segundo == "s"){$linha_4_segundo = "-s";}
elseif($linha_4_segundo == "t"){$linha_4_segundo = "-t";}
elseif($linha_4_segundo == "u"){$linha_4_segundo = "-u";}
elseif($linha_4_segundo == "v"){$linha_4_segundo = "-v";}
elseif($linha_4_segundo == "x"){$linha_4_segundo = "-x";}
elseif($linha_4_segundo == "y"){$linha_4_segundo = "-y";}
elseif($linha_4_segundo == "w"){$linha_4_segundo = "-w";}
elseif($linha_4_segundo == "z"){$linha_4_segundo = "-z";}
elseif($linha_4_segundo == ":"){$linha_4_segundo = "2pontos";}
elseif($linha_4_segundo == "*"){$linha_4_segundo = "ast";}
elseif($linha_4_segundo == "/"){$linha_4_segundo = "barra_d";}
elseif($linha_4_segundo == "?"){$linha_4_segundo = "int";}
elseif($linha_4_segundo == ">"){$linha_4_segundo = "maiorq";}
elseif($linha_4_segundo == "<"){$linha_4_segundo = "menorq";}
else{$linha_4_segundo = substr($mensagem2,3,1);}


$linha_5_segundo = substr($mensagem2,4,1);
if($linha_5_segundo == " "){$linha_5_segundo = "vz";}
elseif($linha_5_segundo == "a"){$linha_5_segundo = "-a";}
elseif($linha_5_segundo == "b"){$linha_5_segundo = "-b";}
elseif($linha_5_segundo == "c"){$linha_5_segundo = "-c";}
elseif($linha_5_segundo == "d"){$linha_5_segundo = "-d";}
elseif($linha_5_segundo == "e"){$linha_5_segundo = "-e";}
elseif($linha_5_segundo == "f"){$linha_5_segundo = "-f";}
elseif($linha_5_segundo == "g"){$linha_5_segundo = "-g";}
elseif($linha_5_segundo == "h"){$linha_5_segundo = "-h";}
elseif($linha_5_segundo == "i"){$linha_5_segundo = "-i";}
elseif($linha_5_segundo == "j"){$linha_5_segundo = "-j";}
elseif($linha_5_segundo == "k"){$linha_5_segundo = "-k";}
elseif($linha_5_segundo == "l"){$linha_5_segundo = "-l";}
elseif($linha_5_segundo == "m"){$linha_5_segundo = "-m";}
elseif($linha_5_segundo == "n"){$linha_5_segundo = "-n";}
elseif($linha_5_segundo == "o"){$linha_5_segundo = "-o";}
elseif($linha_5_segundo == "p"){$linha_5_segundo = "-p";}
elseif($linha_5_segundo == "q"){$linha_5_segundo = "-q";}
elseif($linha_5_segundo == "r"){$linha_5_segundo = "-r";}
elseif($linha_5_segundo == "s"){$linha_5_segundo = "-s";}
elseif($linha_5_segundo == "t"){$linha_5_segundo = "-t";}
elseif($linha_5_segundo == "u"){$linha_5_segundo = "-u";}
elseif($linha_5_segundo == "v"){$linha_5_segundo = "-v";}
elseif($linha_5_segundo == "x"){$linha_5_segundo = "-x";}
elseif($linha_5_segundo == "y"){$linha_5_segundo = "-y";}
elseif($linha_5_segundo == "w"){$linha_5_segundo = "-w";}
elseif($linha_5_segundo == "z"){$linha_5_segundo = "-z";}
elseif($linha_5_segundo == ":"){$linha_5_segundo = "2pontos";}
elseif($linha_5_segundo == "*"){$linha_5_segundo = "ast";}
elseif($linha_5_segundo == "/"){$linha_5_segundo = "barra_d";}
elseif($linha_5_segundo == "?"){$linha_5_segundo = "int";}
elseif($linha_5_segundo == ">"){$linha_5_segundo = "maiorq";}
elseif($linha_5_segundo == "<"){$linha_5_segundo = "menorq";}
else{$linha_5_segundo = substr($mensagem2,4,1);}

$linha_6_segundo = substr($mensagem2,5,1);
if($linha_6_segundo == " "){$linha_6_segundo = "vz";}
elseif($linha_6_segundo == "a"){$linha_6_segundo = "-a";}
elseif($linha_6_segundo == "b"){$linha_6_segundo = "-b";}
elseif($linha_6_segundo == "c"){$linha_6_segundo = "-c";}
elseif($linha_6_segundo == "d"){$linha_6_segundo = "-d";}
elseif($linha_6_segundo == "e"){$linha_6_segundo = "-e";}
elseif($linha_6_segundo == "f"){$linha_6_segundo = "-f";}
elseif($linha_6_segundo == "g"){$linha_6_segundo = "-g";}
elseif($linha_6_segundo == "h"){$linha_6_segundo = "-h";}
elseif($linha_6_segundo == "i"){$linha_6_segundo = "-i";}
elseif($linha_6_segundo == "j"){$linha_6_segundo = "-j";}
elseif($linha_6_segundo == "k"){$linha_6_segundo = "-k";}
elseif($linha_6_segundo == "l"){$linha_6_segundo = "-l";}
elseif($linha_6_segundo == "m"){$linha_6_segundo = "-m";}
elseif($linha_6_segundo == "n"){$linha_6_segundo = "-n";}
elseif($linha_6_segundo == "o"){$linha_6_segundo = "-o";}
elseif($linha_6_segundo == "p"){$linha_6_segundo = "-p";}
elseif($linha_6_segundo == "q"){$linha_6_segundo = "-q";}
elseif($linha_6_segundo == "r"){$linha_6_segundo = "-r";}
elseif($linha_6_segundo == "s"){$linha_6_segundo = "-s";}
elseif($linha_6_segundo == "t"){$linha_6_segundo = "-t";}
elseif($linha_6_segundo == "u"){$linha_6_segundo = "-u";}
elseif($linha_6_segundo == "v"){$linha_6_segundo = "-v";}
elseif($linha_6_segundo == "x"){$linha_6_segundo = "-x";}
elseif($linha_6_segundo == "y"){$linha_6_segundo = "-y";}
elseif($linha_6_segundo == "w"){$linha_6_segundo = "-w";}
elseif($linha_6_segundo == "z"){$linha_6_segundo = "-z";}
elseif($linha_6_segundo == ":"){$linha_6_segundo = "2pontos";}
elseif($linha_6_segundo == "*"){$linha_6_segundo = "ast";}
elseif($linha_6_segundo == "/"){$linha_6_segundo = "barra_d";}
elseif($linha_6_segundo == "?"){$linha_6_segundo = "int";}
elseif($linha_6_segundo == ">"){$linha_6_segundo = "maiorq";}
elseif($linha_6_segundo == "<"){$linha_6_segundo = "menorq";}
else{$linha_6_segundo = substr($mensagem2,5,1);}

$linha_7_segundo = substr($mensagem2,6,1);
if($linha_7_segundo == " "){$linha_7_segundo = "vz";}
elseif($linha_7_segundo == "a"){$linha_7_segundo = "-a";}
elseif($linha_7_segundo == "b"){$linha_7_segundo = "-b";}
elseif($linha_7_segundo == "c"){$linha_7_segundo = "-c";}
elseif($linha_7_segundo == "d"){$linha_7_segundo = "-d";}
elseif($linha_7_segundo == "e"){$linha_7_segundo = "-e";}
elseif($linha_7_segundo == "f"){$linha_7_segundo = "-f";}
elseif($linha_7_segundo == "g"){$linha_7_segundo = "-g";}
elseif($linha_7_segundo == "h"){$linha_7_segundo = "-h";}
elseif($linha_7_segundo == "i"){$linha_7_segundo = "-i";}
elseif($linha_7_segundo == "j"){$linha_7_segundo = "-j";}
elseif($linha_7_segundo == "k"){$linha_7_segundo = "-k";}
elseif($linha_7_segundo == "l"){$linha_7_segundo = "-l";}
elseif($linha_7_segundo == "m"){$linha_7_segundo = "-m";}
elseif($linha_7_segundo == "n"){$linha_7_segundo = "-n";}
elseif($linha_7_segundo == "o"){$linha_7_segundo = "-o";}
elseif($linha_7_segundo == "p"){$linha_7_segundo = "-p";}
elseif($linha_7_segundo == "q"){$linha_7_segundo = "-q";}
elseif($linha_7_segundo == "r"){$linha_7_segundo = "-r";}
elseif($linha_7_segundo == "s"){$linha_7_segundo = "-s";}
elseif($linha_7_segundo == "t"){$linha_7_segundo = "-t";}
elseif($linha_7_segundo == "u"){$linha_7_segundo = "-u";}
elseif($linha_7_segundo == "v"){$linha_7_segundo = "-v";}
elseif($linha_7_segundo == "x"){$linha_7_segundo = "-x";}
elseif($linha_7_segundo == "y"){$linha_7_segundo = "-y";}
elseif($linha_7_segundo == "w"){$linha_7_segundo = "-w";}
elseif($linha_7_segundo == "z"){$linha_7_segundo = "-z";}
elseif($linha_7_segundo == ":"){$linha_7_segundo = "2pontos";}
elseif($linha_7_segundo == "*"){$linha_7_segundo = "ast";}
elseif($linha_7_segundo == "/"){$linha_7_segundo = "barra_d";}
elseif($linha_7_segundo == "?"){$linha_7_segundo = "int";}
elseif($linha_7_segundo == ">"){$linha_7_segundo = "maiorq";}
elseif($linha_7_segundo == "<"){$linha_7_segundo = "menorq";}
else{$linha_7_segundo = substr($mensagem2,6,1);}

$linha_8_segundo = substr($mensagem2,7,1);
if($linha_8_segundo == " "){$linha_8_segundo = "vz";}
elseif($linha_8_segundo == "a"){$linha_8_segundo = "-a";}
elseif($linha_8_segundo == "b"){$linha_8_segundo = "-b";}
elseif($linha_8_segundo == "c"){$linha_8_segundo = "-c";}
elseif($linha_8_segundo == "d"){$linha_8_segundo = "-d";}
elseif($linha_8_segundo == "e"){$linha_8_segundo = "-e";}
elseif($linha_8_segundo == "f"){$linha_8_segundo = "-f";}
elseif($linha_8_segundo == "g"){$linha_8_segundo = "-g";}
elseif($linha_8_segundo == "h"){$linha_8_segundo = "-h";}
elseif($linha_8_segundo == "i"){$linha_8_segundo = "-i";}
elseif($linha_8_segundo == "j"){$linha_8_segundo = "-j";}
elseif($linha_8_segundo == "k"){$linha_8_segundo = "-k";}
elseif($linha_8_segundo == "l"){$linha_8_segundo = "-l";}
elseif($linha_8_segundo == "m"){$linha_8_segundo = "-m";}
elseif($linha_8_segundo == "n"){$linha_8_segundo = "-n";}
elseif($linha_8_segundo == "o"){$linha_8_segundo = "-o";}
elseif($linha_8_segundo == "p"){$linha_8_segundo = "-p";}
elseif($linha_8_segundo == "q"){$linha_8_segundo = "-q";}
elseif($linha_8_segundo == "r"){$linha_8_segundo = "-r";}
elseif($linha_8_segundo == "s"){$linha_8_segundo = "-s";}
elseif($linha_8_segundo == "t"){$linha_8_segundo = "-t";}
elseif($linha_8_segundo == "u"){$linha_8_segundo = "-u";}
elseif($linha_8_segundo == "v"){$linha_8_segundo = "-v";}
elseif($linha_8_segundo == "x"){$linha_8_segundo = "-x";}
elseif($linha_8_segundo == "y"){$linha_8_segundo = "-y";}
elseif($linha_8_segundo == "w"){$linha_8_segundo = "-w";}
elseif($linha_8_segundo == "z"){$linha_8_segundo = "-z";}
elseif($linha_8_segundo == ":"){$linha_8_segundo = "2pontos";}
elseif($linha_8_segundo == "*"){$linha_8_segundo = "ast";}
elseif($linha_8_segundo == "/"){$linha_8_segundo = "barra_d";}
elseif($linha_8_segundo == "?"){$linha_8_segundo = "int";}
elseif($linha_8_segundo == ">"){$linha_8_segundo = "maiorq";}
elseif($linha_8_segundo == "<"){$linha_8_segundo = "menorq";}
else{$linha_8_segundo = substr($mensagem2,7,1);}

$linha_9_segundo = substr($mensagem2,8,1);
if($linha_9_segundo == " "){$linha_9_segundo = "vz";}
elseif($linha_9_segundo == "a"){$linha_9_segundo = "-a";}
elseif($linha_9_segundo == "b"){$linha_9_segundo = "-b";}
elseif($linha_9_segundo == "c"){$linha_9_segundo = "-c";}
elseif($linha_9_segundo == "d"){$linha_9_segundo = "-d";}
elseif($linha_9_segundo == "e"){$linha_9_segundo = "-e";}
elseif($linha_9_segundo == "f"){$linha_9_segundo = "-f";}
elseif($linha_9_segundo == "g"){$linha_9_segundo = "-g";}
elseif($linha_9_segundo == "h"){$linha_9_segundo = "-h";}
elseif($linha_9_segundo == "i"){$linha_9_segundo = "-i";}
elseif($linha_9_segundo == "j"){$linha_9_segundo = "-j";}
elseif($linha_9_segundo == "k"){$linha_9_segundo = "-k";}
elseif($linha_9_segundo == "l"){$linha_9_segundo = "-l";}
elseif($linha_9_segundo == "m"){$linha_9_segundo = "-m";}
elseif($linha_9_segundo == "n"){$linha_9_segundo = "-n";}
elseif($linha_9_segundo == "o"){$linha_9_segundo = "-o";}
elseif($linha_9_segundo == "p"){$linha_9_segundo = "-p";}
elseif($linha_9_segundo == "q"){$linha_9_segundo = "-q";}
elseif($linha_9_segundo == "r"){$linha_9_segundo = "-r";}
elseif($linha_9_segundo == "s"){$linha_9_segundo = "-s";}
elseif($linha_9_segundo == "t"){$linha_9_segundo = "-t";}
elseif($linha_9_segundo == "u"){$linha_9_segundo = "-u";}
elseif($linha_9_segundo == "v"){$linha_9_segundo = "-v";}
elseif($linha_9_segundo == "x"){$linha_9_segundo = "-x";}
elseif($linha_9_segundo == "y"){$linha_9_segundo = "-y";}
elseif($linha_9_segundo == "w"){$linha_9_segundo = "-w";}
elseif($linha_9_segundo == "z"){$linha_9_segundo = "-z";}
elseif($linha_9_segundo == ":"){$linha_9_segundo = "2pontos";}
elseif($linha_9_segundo == "*"){$linha_9_segundo = "ast";}
elseif($linha_9_segundo == "/"){$linha_9_segundo = "barra_d";}
elseif($linha_9_segundo == "?"){$linha_9_segundo = "int";}
elseif($linha_9_segundo == ">"){$linha_9_segundo = "maiorq";}
elseif($linha_9_segundo == "<"){$linha_9_segundo = "menorq";}
else{$linha_9_segundo = substr($mensagem2,8,1);}

$linha_10_segundo = substr($mensagem2,9,1);
if($linha_10_segundo == " "){$linha_10_segundo = "vz";}
elseif($linha_10_segundo == "a"){$linha_10_segundo = "-a";}
elseif($linha_10_segundo == "b"){$linha_10_segundo = "-b";}
elseif($linha_10_segundo == "c"){$linha_10_segundo = "-c";}
elseif($linha_10_segundo == "d"){$linha_10_segundo = "-d";}
elseif($linha_10_segundo == "e"){$linha_10_segundo = "-e";}
elseif($linha_10_segundo == "f"){$linha_10_segundo = "-f";}
elseif($linha_10_segundo == "g"){$linha_10_segundo = "-g";}
elseif($linha_10_segundo == "h"){$linha_10_segundo = "-h";}
elseif($linha_10_segundo == "i"){$linha_10_segundo = "-i";}
elseif($linha_10_segundo == "j"){$linha_10_segundo = "-j";}
elseif($linha_10_segundo == "k"){$linha_10_segundo = "-k";}
elseif($linha_10_segundo == "l"){$linha_10_segundo = "-l";}
elseif($linha_10_segundo == "m"){$linha_10_segundo = "-m";}
elseif($linha_10_segundo == "n"){$linha_10_segundo = "-n";}
elseif($linha_10_segundo == "o"){$linha_10_segundo = "-o";}
elseif($linha_10_segundo == "p"){$linha_10_segundo = "-p";}
elseif($linha_10_segundo == "q"){$linha_10_segundo = "-q";}
elseif($linha_10_segundo == "r"){$linha_10_segundo = "-r";}
elseif($linha_10_segundo == "s"){$linha_10_segundo = "-s";}
elseif($linha_10_segundo == "t"){$linha_10_segundo = "-t";}
elseif($linha_10_segundo == "u"){$linha_10_segundo = "-u";}
elseif($linha_10_segundo == "v"){$linha_10_segundo = "-v";}
elseif($linha_10_segundo == "x"){$linha_10_segundo = "-x";}
elseif($linha_10_segundo == "y"){$linha_10_segundo = "-y";}
elseif($linha_10_segundo == "w"){$linha_10_segundo = "-w";}
elseif($linha_10_segundo == "z"){$linha_10_segundo = "-z";}
elseif($linha_10_segundo == ":"){$linha_10_segundo = "2pontos";}
elseif($linha_10_segundo == "*"){$linha_10_segundo = "ast";}
elseif($linha_10_segundo == "/"){$linha_10_segundo = "barra_d";}
elseif($linha_10_segundo == "?"){$linha_10_segundo = "int";}
elseif($linha_10_segundo == ">"){$linha_10_segundo = "maiorq";}
elseif($linha_10_segundo == "<"){$linha_10_segundo = "menorq";}
else{$linha_10_segundo = substr($mensagem2,9,1);}

$linha_11_segundo = substr($mensagem2,10,1);
if($linha_11_segundo == " "){$linha_11_segundo = "vz";}
elseif($linha_11_segundo == "a"){$linha_11_segundo = "-a";}
elseif($linha_11_segundo == "b"){$linha_11_segundo = "-b";}
elseif($linha_11_segundo == "c"){$linha_11_segundo = "-c";}
elseif($linha_11_segundo == "d"){$linha_11_segundo = "-d";}
elseif($linha_11_segundo == "e"){$linha_11_segundo = "-e";}
elseif($linha_11_segundo == "f"){$linha_11_segundo = "-f";}
elseif($linha_11_segundo == "g"){$linha_11_segundo = "-g";}
elseif($linha_11_segundo == "h"){$linha_11_segundo = "-h";}
elseif($linha_11_segundo == "i"){$linha_11_segundo = "-i";}
elseif($linha_11_segundo == "j"){$linha_11_segundo = "-j";}
elseif($linha_11_segundo == "k"){$linha_11_segundo = "-k";}
elseif($linha_11_segundo == "l"){$linha_11_segundo = "-l";}
elseif($linha_11_segundo == "m"){$linha_11_segundo = "-m";}
elseif($linha_11_segundo == "n"){$linha_11_segundo = "-n";}
elseif($linha_11_segundo == "o"){$linha_11_segundo = "-o";}
elseif($linha_11_segundo == "p"){$linha_11_segundo = "-p";}
elseif($linha_11_segundo == "q"){$linha_11_segundo = "-q";}
elseif($linha_11_segundo == "r"){$linha_11_segundo = "-r";}
elseif($linha_11_segundo == "s"){$linha_11_segundo = "-s";}
elseif($linha_11_segundo == "t"){$linha_11_segundo = "-t";}
elseif($linha_11_segundo == "u"){$linha_11_segundo = "-u";}
elseif($linha_11_segundo == "v"){$linha_11_segundo = "-v";}
elseif($linha_11_segundo == "x"){$linha_11_segundo = "-x";}
elseif($linha_11_segundo == "y"){$linha_11_segundo = "-y";}
elseif($linha_11_segundo == "w"){$linha_11_segundo = "-w";}
elseif($linha_11_segundo == "z"){$linha_11_segundo = "-z";}
elseif($linha_11_segundo == ":"){$linha_11_segundo = "2pontos";}
elseif($linha_11_segundo == "*"){$linha_11_segundo = "ast";}
elseif($linha_11_segundo == "/"){$linha_11_segundo = "barra_d";}
elseif($linha_11_segundo == "?"){$linha_11_segundo = "int";}
elseif($linha_11_segundo == ">"){$linha_11_segundo = "maiorq";}
elseif($linha_11_segundo == "<"){$linha_11_segundo = "menorq";}
else{$linha_11_segundo = substr($mensagem2,10,1);}

$linha_12_segundo = substr($mensagem2,11,1);
if($linha_12_segundo == " "){$linha_12_segundo = "vz";}
elseif($linha_12_segundo == "a"){$linha_12_segundo = "-a";}
elseif($linha_12_segundo == "b"){$linha_12_segundo = "-b";}
elseif($linha_12_segundo == "c"){$linha_12_segundo = "-c";}
elseif($linha_12_segundo == "d"){$linha_12_segundo = "-d";}
elseif($linha_12_segundo == "e"){$linha_12_segundo = "-e";}
elseif($linha_12_segundo == "f"){$linha_12_segundo = "-f";}
elseif($linha_12_segundo == "g"){$linha_12_segundo = "-g";}
elseif($linha_12_segundo == "h"){$linha_12_segundo = "-h";}
elseif($linha_12_segundo == "i"){$linha_12_segundo = "-i";}
elseif($linha_12_segundo == "j"){$linha_12_segundo = "-j";}
elseif($linha_12_segundo == "k"){$linha_12_segundo = "-k";}
elseif($linha_12_segundo == "l"){$linha_12_segundo = "-l";}
elseif($linha_12_segundo == "m"){$linha_12_segundo = "-m";}
elseif($linha_12_segundo == "n"){$linha_12_segundo = "-n";}
elseif($linha_12_segundo == "o"){$linha_12_segundo = "-o";}
elseif($linha_12_segundo == "p"){$linha_12_segundo = "-p";}
elseif($linha_12_segundo == "q"){$linha_12_segundo = "-q";}
elseif($linha_12_segundo == "r"){$linha_12_segundo = "-r";}
elseif($linha_12_segundo == "s"){$linha_12_segundo = "-s";}
elseif($linha_12_segundo == "t"){$linha_12_segundo = "-t";}
elseif($linha_12_segundo == "u"){$linha_12_segundo = "-u";}
elseif($linha_12_segundo == "v"){$linha_12_segundo = "-v";}
elseif($linha_12_segundo == "x"){$linha_12_segundo = "-x";}
elseif($linha_12_segundo == "y"){$linha_12_segundo = "-y";}
elseif($linha_12_segundo == "w"){$linha_12_segundo = "-w";}
elseif($linha_12_segundo == "z"){$linha_12_segundo = "-z";}
elseif($linha_12_segundo == ":"){$linha_12_segundo = "2pontos";}
elseif($linha_12_segundo == "*"){$linha_12_segundo = "ast";}
elseif($linha_12_segundo == "/"){$linha_12_segundo = "barra_d";}
elseif($linha_12_segundo == "?"){$linha_12_segundo = "int";}
elseif($linha_12_segundo == ">"){$linha_12_segundo = "maiorq";}
elseif($linha_12_segundo == "<"){$linha_12_segundo = "menorq";}
else{$linha_12_segundo = substr($mensagem2,11,1);}

$linha_13_segundo = substr($mensagem2,12,1);
if($linha_13_segundo == " "){$linha_13_segundo = "vz";}
elseif($linha_13_segundo == "a"){$linha_13_segundo = "-a";}
elseif($linha_13_segundo == "b"){$linha_13_segundo = "-b";}
elseif($linha_13_segundo == "c"){$linha_13_segundo = "-c";}
elseif($linha_13_segundo == "d"){$linha_13_segundo = "-d";}
elseif($linha_13_segundo == "e"){$linha_13_segundo = "-e";}
elseif($linha_13_segundo == "f"){$linha_13_segundo = "-f";}
elseif($linha_13_segundo == "g"){$linha_13_segundo = "-g";}
elseif($linha_13_segundo == "h"){$linha_13_segundo = "-h";}
elseif($linha_13_segundo == "i"){$linha_13_segundo = "-i";}
elseif($linha_13_segundo == "j"){$linha_13_segundo = "-j";}
elseif($linha_13_segundo == "k"){$linha_13_segundo = "-k";}
elseif($linha_13_segundo == "l"){$linha_13_segundo = "-l";}
elseif($linha_13_segundo == "m"){$linha_13_segundo = "-m";}
elseif($linha_13_segundo == "n"){$linha_13_segundo = "-n";}
elseif($linha_13_segundo == "o"){$linha_13_segundo = "-o";}
elseif($linha_13_segundo == "p"){$linha_13_segundo = "-p";}
elseif($linha_13_segundo == "q"){$linha_13_segundo = "-q";}
elseif($linha_13_segundo == "r"){$linha_13_segundo = "-r";}
elseif($linha_13_segundo == "s"){$linha_13_segundo = "-s";}
elseif($linha_13_segundo == "t"){$linha_13_segundo = "-t";}
elseif($linha_13_segundo == "u"){$linha_13_segundo = "-u";}
elseif($linha_13_segundo == "v"){$linha_13_segundo = "-v";}
elseif($linha_13_segundo == "x"){$linha_13_segundo = "-x";}
elseif($linha_13_segundo == "y"){$linha_13_segundo = "-y";}
elseif($linha_13_segundo == "w"){$linha_13_segundo = "-w";}
elseif($linha_13_segundo == "z"){$linha_13_segundo = "-z";}
elseif($linha_13_segundo == ":"){$linha_13_segundo = "2pontos";}
elseif($linha_13_segundo == "*"){$linha_13_segundo = "ast";}
elseif($linha_13_segundo == "/"){$linha_13_segundo = "barra_d";}
elseif($linha_13_segundo == "?"){$linha_13_segundo = "int";}
elseif($linha_13_segundo == ">"){$linha_13_segundo = "maiorq";}
elseif($linha_13_segundo == "<"){$linha_13_segundo = "menorq";}
else{$linha_13_segundo = substr($mensagem2,12,1);}

$linha_14_segundo = substr($mensagem2,13,1);
if($linha_14_segundo == " "){$linha_14_segundo = "vz";}
elseif($linha_14_segundo == "a"){$linha_14_segundo = "-a";}
elseif($linha_14_segundo == "b"){$linha_14_segundo = "-b";}
elseif($linha_14_segundo == "c"){$linha_14_segundo = "-c";}
elseif($linha_14_segundo == "d"){$linha_14_segundo = "-d";}
elseif($linha_14_segundo == "e"){$linha_14_segundo = "-e";}
elseif($linha_14_segundo == "f"){$linha_14_segundo = "-f";}
elseif($linha_14_segundo == "g"){$linha_14_segundo = "-g";}
elseif($linha_14_segundo == "h"){$linha_14_segundo = "-h";}
elseif($linha_14_segundo == "i"){$linha_14_segundo = "-i";}
elseif($linha_14_segundo == "j"){$linha_14_segundo = "-j";}
elseif($linha_14_segundo == "k"){$linha_14_segundo = "-k";}
elseif($linha_14_segundo == "l"){$linha_14_segundo = "-l";}
elseif($linha_14_segundo == "m"){$linha_14_segundo = "-m";}
elseif($linha_14_segundo == "n"){$linha_14_segundo = "-n";}
elseif($linha_14_segundo == "o"){$linha_14_segundo = "-o";}
elseif($linha_14_segundo == "p"){$linha_14_segundo = "-p";}
elseif($linha_14_segundo == "q"){$linha_14_segundo = "-q";}
elseif($linha_14_segundo == "r"){$linha_14_segundo = "-r";}
elseif($linha_14_segundo == "s"){$linha_14_segundo = "-s";}
elseif($linha_14_segundo == "t"){$linha_14_segundo = "-t";}
elseif($linha_14_segundo == "u"){$linha_14_segundo = "-u";}
elseif($linha_14_segundo == "v"){$linha_14_segundo = "-v";}
elseif($linha_14_segundo == "x"){$linha_14_segundo = "-x";}
elseif($linha_14_segundo == "y"){$linha_14_segundo = "-y";}
elseif($linha_14_segundo == "w"){$linha_14_segundo = "-w";}
elseif($linha_14_segundo == "z"){$linha_14_segundo = "-z";}
elseif($linha_14_segundo == ":"){$linha_14_segundo = "2pontos";}
elseif($linha_14_segundo == "*"){$linha_14_segundo = "ast";}
elseif($linha_14_segundo == "/"){$linha_14_segundo = "barra_d";}
elseif($linha_14_segundo == "?"){$linha_14_segundo = "int";}
elseif($linha_14_segundo == ">"){$linha_14_segundo = "maiorq";}
elseif($linha_14_segundo == "<"){$linha_14_segundo = "menorq";}
else{$linha_14_segundo = substr($mensagem2,13,1);}

$linha_15_segundo = substr($mensagem2,14,1);
if($linha_15_segundo == " "){$linha_15_segundo = "vz";}
elseif($linha_15_segundo == "a"){$linha_15_segundo = "-a";}
elseif($linha_15_segundo == "b"){$linha_15_segundo = "-b";}
elseif($linha_15_segundo == "c"){$linha_15_segundo = "-c";}
elseif($linha_15_segundo == "d"){$linha_15_segundo = "-d";}
elseif($linha_15_segundo == "e"){$linha_15_segundo = "-e";}
elseif($linha_15_segundo == "f"){$linha_15_segundo = "-f";}
elseif($linha_15_segundo == "g"){$linha_15_segundo = "-g";}
elseif($linha_15_segundo == "h"){$linha_15_segundo = "-h";}
elseif($linha_15_segundo == "i"){$linha_15_segundo = "-i";}
elseif($linha_15_segundo == "j"){$linha_15_segundo = "-j";}
elseif($linha_15_segundo == "k"){$linha_15_segundo = "-k";}
elseif($linha_15_segundo == "l"){$linha_15_segundo = "-l";}
elseif($linha_15_segundo == "m"){$linha_15_segundo = "-m";}
elseif($linha_15_segundo == "n"){$linha_15_segundo = "-n";}
elseif($linha_15_segundo == "o"){$linha_15_segundo = "-o";}
elseif($linha_15_segundo == "p"){$linha_15_segundo = "-p";}
elseif($linha_15_segundo == "q"){$linha_15_segundo = "-q";}
elseif($linha_15_segundo == "r"){$linha_15_segundo = "-r";}
elseif($linha_15_segundo == "s"){$linha_15_segundo = "-s";}
elseif($linha_15_segundo == "t"){$linha_15_segundo = "-t";}
elseif($linha_15_segundo == "u"){$linha_15_segundo = "-u";}
elseif($linha_15_segundo == "v"){$linha_15_segundo = "-v";}
elseif($linha_15_segundo == "x"){$linha_15_segundo = "-x";}
elseif($linha_15_segundo == "y"){$linha_15_segundo = "-y";}
elseif($linha_15_segundo == "w"){$linha_15_segundo = "-w";}
elseif($linha_15_segundo == "z"){$linha_15_segundo = "-z";}
elseif($linha_15_segundo == ":"){$linha_15_segundo = "2pontos";}
elseif($linha_15_segundo == "*"){$linha_15_segundo = "ast";}
elseif($linha_15_segundo == "/"){$linha_15_segundo = "barra_d";}
elseif($linha_15_segundo == "?"){$linha_15_segundo = "int";}
elseif($linha_15_segundo == ">"){$linha_15_segundo = "maiorq";}
elseif($linha_15_segundo == "<"){$linha_15_segundo = "menorq";}
else{$linha_15_segundo = substr($mensagem2,14,1);}

$linha_16_segundo = substr($mensagem2,15,1);
if($linha_16_segundo == " "){$linha_16_segundo = "vz";}
elseif($linha_16_segundo == "a"){$linha_16_segundo = "-a";}
elseif($linha_16_segundo == "b"){$linha_16_segundo = "-b";}
elseif($linha_16_segundo == "c"){$linha_16_segundo = "-c";}
elseif($linha_16_segundo == "d"){$linha_16_segundo = "-d";}
elseif($linha_16_segundo == "e"){$linha_16_segundo = "-e";}
elseif($linha_16_segundo == "f"){$linha_16_segundo = "-f";}
elseif($linha_16_segundo == "g"){$linha_16_segundo = "-g";}
elseif($linha_16_segundo == "h"){$linha_16_segundo = "-h";}
elseif($linha_16_segundo == "i"){$linha_16_segundo = "-i";}
elseif($linha_16_segundo == "j"){$linha_16_segundo = "-j";}
elseif($linha_16_segundo == "k"){$linha_16_segundo = "-k";}
elseif($linha_16_segundo == "l"){$linha_16_segundo = "-l";}
elseif($linha_16_segundo == "m"){$linha_16_segundo = "-m";}
elseif($linha_16_segundo == "n"){$linha_16_segundo = "-n";}
elseif($linha_16_segundo == "o"){$linha_16_segundo = "-o";}
elseif($linha_16_segundo == "p"){$linha_16_segundo = "-p";}
elseif($linha_16_segundo == "q"){$linha_16_segundo = "-q";}
elseif($linha_16_segundo == "r"){$linha_16_segundo = "-r";}
elseif($linha_16_segundo == "s"){$linha_16_segundo = "-s";}
elseif($linha_16_segundo == "t"){$linha_16_segundo = "-t";}
elseif($linha_16_segundo == "u"){$linha_16_segundo = "-u";}
elseif($linha_16_segundo == "v"){$linha_16_segundo = "-v";}
elseif($linha_16_segundo == "x"){$linha_16_segundo = "-x";}
elseif($linha_16_segundo == "y"){$linha_16_segundo = "-y";}
elseif($linha_16_segundo == "w"){$linha_16_segundo = "-w";}
elseif($linha_16_segundo == "z"){$linha_16_segundo = "-z";}
elseif($linha_16_segundo == ":"){$linha_16_segundo = "2pontos";}
elseif($linha_16_segundo == "*"){$linha_16_segundo = "ast";}
elseif($linha_16_segundo == "/"){$linha_16_segundo = "barra_d";}
elseif($linha_16_segundo == "?"){$linha_16_segundo = "int";}
elseif($linha_16_segundo == ">"){$linha_16_segundo = "maiorq";}
elseif($linha_16_segundo == "<"){$linha_16_segundo = "menorq";}
else{$linha_16_segundo = substr($mensagem2,15,1);}

$linha_17_segundo = substr($mensagem2,16,1);
if($linha_17_segundo == " "){$linha_17_segundo = "vz";}
elseif($linha_17_segundo == "a"){$linha_17_segundo = "-a";}
elseif($linha_17_segundo == "b"){$linha_17_segundo = "-b";}
elseif($linha_17_segundo == "c"){$linha_17_segundo = "-c";}
elseif($linha_17_segundo == "d"){$linha_17_segundo = "-d";}
elseif($linha_17_segundo == "e"){$linha_17_segundo = "-e";}
elseif($linha_17_segundo == "f"){$linha_17_segundo = "-f";}
elseif($linha_17_segundo == "g"){$linha_17_segundo = "-g";}
elseif($linha_17_segundo == "h"){$linha_17_segundo = "-h";}
elseif($linha_17_segundo == "i"){$linha_17_segundo = "-i";}
elseif($linha_17_segundo == "j"){$linha_17_segundo = "-j";}
elseif($linha_17_segundo == "k"){$linha_17_segundo = "-k";}
elseif($linha_17_segundo == "l"){$linha_17_segundo = "-l";}
elseif($linha_17_segundo == "m"){$linha_17_segundo = "-m";}
elseif($linha_17_segundo == "n"){$linha_17_segundo = "-n";}
elseif($linha_17_segundo == "o"){$linha_17_segundo = "-o";}
elseif($linha_17_segundo == "p"){$linha_17_segundo = "-p";}
elseif($linha_17_segundo == "q"){$linha_17_segundo = "-q";}
elseif($linha_17_segundo == "r"){$linha_17_segundo = "-r";}
elseif($linha_17_segundo == "s"){$linha_17_segundo = "-s";}
elseif($linha_17_segundo == "t"){$linha_17_segundo = "-t";}
elseif($linha_17_segundo == "u"){$linha_17_segundo = "-u";}
elseif($linha_17_segundo == "v"){$linha_17_segundo = "-v";}
elseif($linha_17_segundo == "x"){$linha_17_segundo = "-x";}
elseif($linha_17_segundo == "y"){$linha_17_segundo = "-y";}
elseif($linha_17_segundo == "w"){$linha_17_segundo = "-w";}
elseif($linha_17_segundo == "z"){$linha_17_segundo = "-z";}
elseif($linha_17_segundo == ":"){$linha_17_segundo = "2pontos";}
elseif($linha_17_segundo == "*"){$linha_17_segundo = "ast";}
elseif($linha_17_segundo == "/"){$linha_17_segundo = "barra_d";}
elseif($linha_17_segundo == "?"){$linha_17_segundo = "int";}
elseif($linha_17_segundo == ">"){$linha_17_segundo = "maiorq";}
elseif($linha_17_segundo == "<"){$linha_17_segundo = "menorq";}
else{$linha_17_segundo = substr($mensagem2,16,1);}

$linha_18_segundo = substr($mensagem2,17,1);
if($linha_18_segundo == " "){$linha_18_segundo = "vz";}
elseif($linha_18_segundo == "a"){$linha_18_segundo = "-a";}
elseif($linha_18_segundo == "b"){$linha_18_segundo = "-b";}
elseif($linha_18_segundo == "c"){$linha_18_segundo = "-c";}
elseif($linha_18_segundo == "d"){$linha_18_segundo = "-d";}
elseif($linha_18_segundo == "e"){$linha_18_segundo = "-e";}
elseif($linha_18_segundo == "f"){$linha_18_segundo = "-f";}
elseif($linha_18_segundo == "g"){$linha_18_segundo = "-g";}
elseif($linha_18_segundo == "h"){$linha_18_segundo = "-h";}
elseif($linha_18_segundo == "i"){$linha_18_segundo = "-i";}
elseif($linha_18_segundo == "j"){$linha_18_segundo = "-j";}
elseif($linha_18_segundo == "k"){$linha_18_segundo = "-k";}
elseif($linha_18_segundo == "l"){$linha_18_segundo = "-l";}
elseif($linha_18_segundo == "m"){$linha_18_segundo = "-m";}
elseif($linha_18_segundo == "n"){$linha_18_segundo = "-n";}
elseif($linha_18_segundo == "o"){$linha_18_segundo = "-o";}
elseif($linha_18_segundo == "p"){$linha_18_segundo = "-p";}
elseif($linha_18_segundo == "q"){$linha_18_segundo = "-q";}
elseif($linha_18_segundo == "r"){$linha_18_segundo = "-r";}
elseif($linha_18_segundo == "s"){$linha_18_segundo = "-s";}
elseif($linha_18_segundo == "t"){$linha_18_segundo = "-t";}
elseif($linha_18_segundo == "u"){$linha_18_segundo = "-u";}
elseif($linha_18_segundo == "v"){$linha_18_segundo = "-v";}
elseif($linha_18_segundo == "x"){$linha_18_segundo = "-x";}
elseif($linha_18_segundo == "y"){$linha_18_segundo = "-y";}
elseif($linha_18_segundo == "w"){$linha_18_segundo = "-w";}
elseif($linha_18_segundo == "z"){$linha_18_segundo = "-z";}
elseif($linha_18_segundo == ":"){$linha_18_segundo = "2pontos";}
elseif($linha_18_segundo == "*"){$linha_18_segundo = "ast";}
elseif($linha_18_segundo == "/"){$linha_18_segundo = "barra_d";}
elseif($linha_18_segundo == "?"){$linha_18_segundo = "int";}
elseif($linha_18_segundo == ">"){$linha_18_segundo = "maiorq";}
elseif($linha_18_segundo == "<"){$linha_18_segundo = "menorq";}
else{$linha_18_segundo = substr($mensagem2,17,1);}

$linha_19_segundo = substr($mensagem2,18,1);
if($linha_19_segundo == " "){$linha_19_segundo = "vz";}
elseif($linha_19_segundo == "a"){$linha_19_segundo = "-a";}
elseif($linha_19_segundo == "b"){$linha_19_segundo = "-b";}
elseif($linha_19_segundo == "c"){$linha_19_segundo = "-c";}
elseif($linha_19_segundo == "d"){$linha_19_segundo = "-d";}
elseif($linha_19_segundo == "e"){$linha_19_segundo = "-e";}
elseif($linha_19_segundo == "f"){$linha_19_segundo = "-f";}
elseif($linha_19_segundo == "g"){$linha_19_segundo = "-g";}
elseif($linha_19_segundo == "h"){$linha_19_segundo = "-h";}
elseif($linha_19_segundo == "i"){$linha_19_segundo = "-i";}
elseif($linha_19_segundo == "j"){$linha_19_segundo = "-j";}
elseif($linha_19_segundo == "k"){$linha_19_segundo = "-k";}
elseif($linha_19_segundo == "l"){$linha_19_segundo = "-l";}
elseif($linha_19_segundo == "m"){$linha_19_segundo = "-m";}
elseif($linha_19_segundo == "n"){$linha_19_segundo = "-n";}
elseif($linha_19_segundo == "o"){$linha_19_segundo = "-o";}
elseif($linha_19_segundo == "p"){$linha_19_segundo = "-p";}
elseif($linha_19_segundo == "q"){$linha_19_segundo = "-q";}
elseif($linha_19_segundo == "r"){$linha_19_segundo = "-r";}
elseif($linha_19_segundo == "s"){$linha_19_segundo = "-s";}
elseif($linha_19_segundo == "t"){$linha_19_segundo = "-t";}
elseif($linha_19_segundo == "u"){$linha_19_segundo = "-u";}
elseif($linha_19_segundo == "v"){$linha_19_segundo = "-v";}
elseif($linha_19_segundo == "x"){$linha_19_segundo = "-x";}
elseif($linha_19_segundo == "y"){$linha_19_segundo = "-y";}
elseif($linha_19_segundo == "w"){$linha_19_segundo = "-w";}
elseif($linha_19_segundo == "z"){$linha_19_segundo = "-z";}
elseif($linha_19_segundo == ":"){$linha_19_segundo = "2pontos";}
elseif($linha_19_segundo == "*"){$linha_19_segundo = "ast";}
elseif($linha_19_segundo == "/"){$linha_19_segundo = "barra_d";}
elseif($linha_19_segundo == "?"){$linha_19_segundo = "int";}
elseif($linha_19_segundo == ">"){$linha_19_segundo = "maiorq";}
elseif($linha_19_segundo == "<"){$linha_19_segundo = "menorq";}
else{$linha_19_segundo = substr($mensagem2,18,1);}


$linha_20_segundo = substr($mensagem2,19,1);
if($linha_20_segundo == " "){$linha_20_segundo = "vz";}
elseif($linha_20_segundo == "a"){$linha_20_segundo = "-a";}
elseif($linha_20_segundo == "b"){$linha_20_segundo = "-b";}
elseif($linha_20_segundo == "c"){$linha_20_segundo = "-c";}
elseif($linha_20_segundo == "d"){$linha_20_segundo = "-d";}
elseif($linha_20_segundo == "e"){$linha_20_segundo = "-e";}
elseif($linha_20_segundo == "f"){$linha_20_segundo = "-f";}
elseif($linha_20_segundo == "g"){$linha_20_segundo = "-g";}
elseif($linha_20_segundo == "h"){$linha_20_segundo = "-h";}
elseif($linha_20_segundo == "i"){$linha_20_segundo = "-i";}
elseif($linha_20_segundo == "j"){$linha_20_segundo = "-j";}
elseif($linha_20_segundo == "k"){$linha_20_segundo = "-k";}
elseif($linha_20_segundo == "l"){$linha_20_segundo = "-l";}
elseif($linha_20_segundo == "m"){$linha_20_segundo = "-m";}
elseif($linha_20_segundo == "n"){$linha_20_segundo = "-n";}
elseif($linha_20_segundo == "o"){$linha_20_segundo = "-o";}
elseif($linha_20_segundo == "p"){$linha_20_segundo = "-p";}
elseif($linha_20_segundo == "q"){$linha_20_segundo = "-q";}
elseif($linha_20_segundo == "r"){$linha_20_segundo = "-r";}
elseif($linha_20_segundo == "s"){$linha_20_segundo = "-s";}
elseif($linha_20_segundo == "t"){$linha_20_segundo = "-t";}
elseif($linha_20_segundo == "u"){$linha_20_segundo = "-u";}
elseif($linha_20_segundo == "v"){$linha_20_segundo = "-v";}
elseif($linha_20_segundo == "x"){$linha_20_segundo = "-x";}
elseif($linha_20_segundo == "y"){$linha_20_segundo = "-y";}
elseif($linha_20_segundo == "w"){$linha_20_segundo = "-w";}
elseif($linha_20_segundo == "z"){$linha_20_segundo = "-z";}
elseif($linha_20_segundo == ":"){$linha_20_segundo = "2pontos";}
elseif($linha_20_segundo == "*"){$linha_20_segundo = "ast";}
elseif($linha_20_segundo == "/"){$linha_20_segundo = "barra_d";}
elseif($linha_20_segundo == "?"){$linha_20_segundo = "int";}
elseif($linha_20_segundo == ">"){$linha_20_segundo = "maiorq";}
elseif($linha_20_segundo == "<"){$linha_20_segundo = "menorq";}
else{$linha_20_segundo = substr($mensagem2,19,1);}



$cor = "vm";
$peso_1 = substr($peso,0,1);
$peso_2 = substr($peso,1,1);
$peso_3 = substr($peso,2,1);
$peso_4 = substr($peso,3,1);
$peso_5 = substr($peso,4,1);
$peso_6 = substr($peso,5,1);

$caminho = "./images/display/";
$complemento = ".jpg";

?>
<div id="letreiro">
<img class="foto" src=<?php print $caminho.$linha_1_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_2_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_3_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_4_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_5_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_6_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_7_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_8_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_9_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_10_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_11_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_12_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_13_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_14_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_15_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_16_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_17_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_18_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_19_primeiro.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_20_primeiro.$complemento?> id="can2_pat"/>
</div>

<div id="letreiro2">
<img class="foto" src=<?php print $caminho.$linha_1_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_2_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_3_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_4_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_5_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_6_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_7_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_8_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_9_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_10_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_11_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_12_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_13_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_14_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_15_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_16_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_17_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_18_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_19_segundo.$complemento?> id="can2_pat"/>
<img class="foto" src=<?php print $caminho.$linha_20_segundo.$complemento?> id="can2_pat"/>
</div>

<div id="peso">
<img class="peso" src=<?php print $caminho.$peso_1.$cor.".png"?> id="can2_pat"/>
<img class="peso" src=<?php print $caminho.$peso_2.$cor.".png"?> id="can2_pat"/>
<img class="peso" src=<?php print $caminho.$peso_3.$cor.".png"?> id="can2_pat"/>
<img class="peso" src=<?php print $caminho.$peso_4.$cor.".png"?> id="can2_pat"/>
<img class="peso" src=<?php print $caminho.$peso_5.$cor.".png"?> id="can2_pat"/>
<img class="peso" src=<?php print $caminho.$peso_6.$cor.".png"?> id="can2_pat"/>
</div>

<div id="aux_semaforo_entrada"></div>
<div id="semaforo_entrada">
<img class="semaforos" src=<?php print $caminho.$semaforo_entrada.".png"?> id="can2_pat" onclick="javascript: location.href=`menu_patrag.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
</div>
<div id="aux_semaforo_saida"></div>
<div id="semaforo_saida">
<img class="semaforos" src=<?php print $caminho.$semaforo_saida.".png"?> id="can2_pat"/>
</div>






<script>
setTimeout("location.reload(true);",2000); // recarrega a pagina em 5 segundos
</script>



</body>




<style>
body{
    background-color: #708090;
}

img.foto{
    float:top;
    margin-left:0px;
    margin-right:-4px;
    padding-top: 0px;
    padding-bottom:0px;
    padding-left:0px;
    padding-right:0px;
    background-color: #FFFFFF;
    width:65px;
    height:180px;

}

div#letreiro{
    margin: 0px;
    padding-left: 30px;
    padding-right: 30px;
    padding-top:30px;
    padding-bottom: 10px;
    position: absolute;
    left: 80px;
    top: 40px;
    width:1300px;
    height:180px;
    background-color: #1C1C1C;
}
div#letreiro2{
    position: absolute;
    margin: 0px;
    padding-left: 30px;
    padding-right: 30px;
    padding-top:0px;
    padding-bottom: 30px;
    left:80px;
    top: 250px;
    width:1300px;
    height:180px;
    background-color: #1C1C1C;
}

div#aux_letreiro{
    position: absolute;
    margin: 0px;
    padding-left: 30px;
    padding-right: 30px;
    padding-top:0px;
    padding-bottom: 30px;
    left:70px;
    top: 30px;
    width:1300px;
    height:390px;
    background-color: #1C1C1C;
    border: 10px;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
    
}

img.peso{
    float:top;
    margin-left:0px;
    margin-right:10px;
    padding-top: 0px;
    padding-bottom:0px;
    padding-left:0px;
    padding-right:0px;
    width:100px;
    height:200px;
    background-color: #000000;

}

div#peso{
    margin: 0px;
    position: absolute;
    left: 390px;
    top: 500px;
    margin: 0px;
    padding-left: 18px;
    padding-right:11px;
    padding-top:15px;
    padding-bottom: 11px;
    left:400px;
    top: 500px;
    width:681px;
    height:205px;
    background-color: #1C1C1C;
    border: 10px;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
}

img.semaforos{
    float:top;
    margin-left:0px;
    margin-right:10px;
    padding-top: 0px;
    padding-bottom:0px;
    padding-left:0px;
    padding-right:0px;
    width:110px;
    height:110px;

}
div#semaforo_entrada{
    margin-left: 0px;
    position: absolute;
    left: 50px;
    top: 550px;
    padding: 15px;
    width:110px;
    height:110px;
    background-color: #1C1C1C;
    border: 10px;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
}
div#aux_semaforo_entrada{
    margin-left: 0px;
    position: absolute;
    left: 111px;
    top: 530px;
    padding: 15px;
    width:6px;
    height:280px;
    background-color: #FFD700;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
}

div#semaforo_saida{
    margin-left: 0px;
    position: absolute;
    left: 1310px;
    top: 550px;
    padding: 15px;
    width:110px;
    height:110px;
    background-color: #1C1C1C;
    border: 10px;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
}
div#aux_semaforo_saida{
    margin-left: 0px;
    position: absolute;
    left: 1370px;
    top: 530px;
    padding: 15px;
    width:6px;
    height:280px;
    background-color: #FFD700;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
}
div#aux_suporte{
    margin-left: 0px;
    position: absolute;
    left: 740px;
    top: 5px;
    padding: 15px;
    width:6px;
    height:805px;
    background-color: #FFD700;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
}

</style>









</html>
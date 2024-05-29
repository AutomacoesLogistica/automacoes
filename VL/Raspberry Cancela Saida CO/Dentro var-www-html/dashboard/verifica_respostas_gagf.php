<?php


$origem = isset($_GET['origem'])?$_GET['origem']:"vazio";
$destino = isset($_GET['destino'])?$_GET['destino']:"vazio";
$estoque = isset($_GET['estoque'])?$_GET['estoque']:"vazio";
$nomination = isset($_GET['nomination'])?$_GET['nomination']:"vazio";
$material= isset($_GET['material'])?$_GET['material']:"vazio";
$pesoBruto = isset($_GET['pesoBruto'])?$_GET['pesoBruto']:"vazio";
$pesoMaterialCarregado = isset($_GET['pesoMaterialCarregado'])?$_GET['pesoMaterialCarregado']:"vazio";
$idProcessoGagf_pai = isset($_GET['idProcessoGagf_pai'])?$_GET['idProcessoGagf_pai']:"vazio";
$idProcessoGagf_filho = isset($_GET['idProcessoGagf_filho'])?$_GET['idProcessoGagf_filho']:"vazio";
$idProcessoGscs_pai = isset($_GET['idProcessoGscs_pai'])?$_GET['idProcessoGscs_pai']:"vazio";
$idProcessoGscs_filho = isset($_GET['idProcessoGscs_filho'])?$_GET['idProcessoGscs_filho']:"vazio";
$nome = isset($_GET['nome'])?$_GET['nome']:"vazio";
$cpf = isset($_GET['cpf'])?$_GET['cpf']:"vazio";
$cnh = isset($_GET['cnh'])?$_GET['cnh']:"vazio";
$celular = isset($_GET['celular'])?$_GET['celular']:"vazio";
$email = isset($_GET['email'])?$_GET['email']:"vazio";
$tara = isset($_GET['tara'])?$_GET['tara']:"vazio";
$tag_motorista = '-';
$placa_carreta = isset($_GET['placaCarreta'])?$_GET['placaCarreta']:"vazio";
$placa_cavalo = isset($_GET['placaCavalo'])?$_GET['placaCavalo']:"vazio";


$transportadoraCarreta  = isset($_GET['transportadoraCarreta'])?$_GET['transportadoraCarreta']:"vazio";
$sigla_transportadora = ''; // Tem que consultar e buscar
//Consulto e busco a sigla da transportadora
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadoraCarreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $sigla_transportadora = $dados['sigla'];
}



include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM historico WHERE placa_carreta='$placa_carreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
}

//echo 'o ID e: '.$id;



//$placa_carreta ='RTS6B24';


//echo $placa_carreta;
//echo '</BR>';

include_once 'conexao_dashboard.php';

$sql = $dbcon->query("SELECT * FROM historico WHERE placa_carreta='$placa_carreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id2 = trim(strval($dados['id']));
}
//echo '</BR>';
//echo 'o ID e: '.$id2;

if($id2 !='' AND $id2 != '0')
{
  //Encontrou, então podemos fazer o update na tabela
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("UPDATE historico_complemento SET  origem = '$origem',
  destino = '$destino',
  material = '$material',
  estoque = '$estoque',
  num_gagf = '$idProcessoGagf_pai',
  num_gscs = '$idProcessoGscs_pai',
  num_gagf_filho = '$idProcessoGagf_filho',
  num_gscs_filho = '$idProcessoGscs_filho', 
  nomination = '$nomination',
  peso_bruto = '$pesoBruto',
  tara = '$tara',
  peso_liquido = '$pesoMaterialCarregado',
  nome = '$nome' 
  WHERE id_historico='$id2'");


  // Agora verifico o cadastro do motorista, caso nao tenha no sistema, cadastro ele no nosso banco de dados!
  if($nome != '' && $nome !='vazio' && $nome != '0')
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    //$hora = date('H:i:s');
    
    $vdata = explode('/',$data);
    $dia = intval($vdata[0]);
    $mes = intval($vdata[1]);
    $ano = intval($vdata[2]);
    $numero_tabela = 0;
    if(intval($mes)>6)
    {
     $numero_tabela = 2;
    }   
    else
    {
     $numero_tabela = 1;
    }
    $tabela = 'cadastro_motoristas'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_motoristas1, senão busca no no cadastro_motoristas2
    $pesquisa_dia = 'mes'.$dia.'_dia_'.$dia; //exemplo mes1_dia4
    $pesquisa_mes = 'mes_'.$mes; //exemplo mes_8
    $pesquisa_ano = 'ano_2022';

    //Verficiso se ja existe cadastro dele
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE nome='$nome' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     $id = $dados['id'];
     //OBS: caso mes seja acima do 6, no caso 7 a 12, dimiuir 6 e salvar no banco cadastro_motoristas2 os dados referente a mes_xx_dia_xx
     //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
     // agora fazer o update
    }
    else
    {
     //Não existe, então posso cadastralo tando no cadastro_motorista1 quanto no cadastro_motorista2
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("INSERT INTO cadastro_motoristas1 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora) VALUES ($nome,'$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora')");
 
     //Salva tambem na segunda tabela
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("INSERT INTO cadastro_motoristas2 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora) VALUES ($nome,'$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora')");
    }
   } // fecha  if($nome != '' && $nome !='vazio' && $nome != '0')
  
}
//Responde para o servidor de envio
echo json_encode('ok');


 ?>

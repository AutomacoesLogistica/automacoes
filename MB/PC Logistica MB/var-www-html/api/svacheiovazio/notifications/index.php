<?php
error_reporting(0);

$method = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json;charset=utf-8');
$dados = json_decode(file_get_contents('php://input'), true);
//print_r($dados);

$v_condicao = '-';
$mensagem = strval(implode("','",$dados));
//echo strlen($mensagem);

$tipo_evento = $dados["type"]; // Para essa aplica��o sempre sera 15
$media_server_id = $dados["media_server_id"]; // pega o nome do servidor
$camera = $dados["camera_id"]; // pega o nome do ms+numero camera EX: ms0099-cam00
$valor_camera = explode('-',$camera);
$camera = $valor_camera[1]; //Extrai apenas o nome da camera!
$detected_at = $dados["detected_at"]; // recebe o horario detectado pelo sistema SVA
//Padrao recebido: 2022-06-01T15:30:15-03:00
if($detected_at !='')
{
 $vv = explode('T',$detected_at);
 $v_data = explode('-',$vv[0]); // 2022-06-01
 $v_data = $v_data[2].'/'.$v_data[1].'/'.$v_data[0];

 $v_hora = explode('-',$vv[1]); //15:30:15-03:00
 $v_hora = $v_hora[0];
}



$local_api = $dados["media_server_name"]; // pega o local da api EX: MB-BAL-01
if ($local_api == "MB-BAL-01 1061")
{
$local_api = "MS 1061";	
}
else if ($local_api == "MB-BAL-01 1101")
{
$local_api = "MS 1101";	
}

$saida_detectada = $dados["camera_name"]; // pega o nome do local da saida EX: SAIDA-PRI ou SAIDA-SEG
$deu_match = "";

if($saida_detectada == "SAIDA-PRI") // Detectado apenas placa
{
  $saida_detectada = "Saida Principal";  
}
else if($saida_detectada == "SAIDA-SEG") // Detectado apenas placa
{
  $saida_detectada = "Saida Segur Pro";  
}
else if ($saida_detectada == "SAIDA-PRI Cheio") // Detectado saindo cheio pela saida principal
{
  $saida_detectada = "Saida Principal";
}
else if ($saida_detectada == "SAIDA-PRI Vazio") // Detectado saindo vazio pela saida principal
{
  $saida_detectada = "Saida Principal";
}
else if ($saida_detectada == "SAIDA-SEG Cheio") // Detectado saindo cheio pela saida segur pro
{
  $saida_detectada = "Saida Segur Pro";
}
else if ($saida_detectada == "SAIDA-SEG Vazio") // Detectado saindo vazio pela saida segur pro
{
  $saida_detectada = "Saida Segur Pro";
}
else
{
  //Deixa como esta, o que foi recebido
}


$valor_placa = $dados["text"]; // recebe o valor da placa EX: ABC1010

if ( $valor_placa == "-" )
{
  $valor_placa = "xxxxxxx";
}
else if ( $valor_placa == "FRE Frente" )
{
 $valor_placa = "Sincronismo!";
}

$video_placa = $dados["url"]; // recebe a url da placa
$condicao = $dados["text_2"]; // recebe o valor do status EX: CHE Cheio ou VAZ Vazio

if ($condicao == "CHE Cheio")
{
  $condicao = "Saindo Cheio!"; 
  $v_condicao = "Saindo Cheio!"; 
  date_default_timezone_set('America/Sao_Paulo');
  $data_completa = date('d/m/Y');
  $horario = date('H:i:s');
  include_once 'conexao_sva_cheio_vazio.php';
  $sql = $dbcon->query("INSERT INTO historico_api_cheio_vazio SET condicao='$condicao',data='$data_completa',hora='$horario'");
}


else if ( $condicao == "VAZ Vazio")
{
  $condicao = "Saindo Vazio!";  
  $v_condicao = "Saindo Vazio!";  
  date_default_timezone_set('America/Sao_Paulo');
  $data_completa = date('d/m/Y');
  $horario = date('H:i:s');
  include_once 'conexao_sva_cheio_vazio.php';
  $sql = $dbcon->query("INSERT INTO historico_api_cheio_vazio SET condicao='$condicao',data='$data_completa',hora='$horario'");

}
else if( $condicao =="SUP Superior" || $condicao == "SUP  Superior" || $condicao == "SUP  Superior " || $condicao == "SUP Superior " || $condicao == "SUP superior" || $condicao == "SUP superior " || $condicao == "SUP  superior" || $condicao == "SUP  superior ")
{
	$v_condicao = "Deteccao Superior";  
}
else if ( $condicao == "-")
{
  $condicao = "Detectado Placa!";
}
else
{
 // N�o faz nada, e deixa o valor que foi recebido!
}
$video_bascula = $dados["url_2"]; // recebe a url do video da b�scula
$imagem = $dados["image"]; // Imagem do evento

$data_completa = '';
$horario = '';

if ( $video_placa == $video_bascula)
{
$deu_match = "";
}
else
{
$deu_match = "MAT";
}



date_default_timezone_set('America/Sao_Paulo');
$data_completa = date('d/m/Y');
$horario = date('H:i:s');

include_once 'conexao_sva_cheio_vazio.php';

$pode_salvar = "SIM";

//VERIFICO SE A PLACA DETECTADA N�O CONSTA NA LISTA DE PLACAS DESCARTADAS
$sql = $dbcon->query("SELECT * FROM placas_descartadas WHERE valor_placa='$valor_placa'");
if(mysqli_num_rows($sql)>0)
{
 $pode_salvar = "NAO"; // A placa entregue pela API ja consta na lista de que nao desejamos salvar no sistema principal, porem vamos salva-la em outra lista por seguran�a!
}



$tag = "0";

//VERIFICO SE A PLACA DETECTADA Existe TAG
include_once 'conexao_sva_cheio_vazio.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$valor_placa'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $tag = $dados['tag'];# Busco a tag referente a placa
 }
}
else
{
$tag = 'vazio'; // Deixa em branco pois n�o encontrou a tag referente a esta placa!
}


include_once 'conexao_sva_cheio_vazio.php';

if ($pode_salvar=="SIM")
{
 //SALVA OS DADOS NO BANDO DE DADOS DO SISTEMA PRINCIPAL POIS A PLACA ESTÁ PERMITDA!  
 if($tag !='vazio')
 {
  //Acestou a placa pois encontrou a tag no sistema 
  $sql = $dbcon->query("INSERT INTO deteccao SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$v_data',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='SIM',registro='12345678',nome='USUARIO ROBO',justificativa='Validado a placa pelo ROBO, pendente validação da báscula!',deteccao_falsa='$deu_match',tag='$tag'");
 }
 else
 {
  $sql = $dbcon->query("INSERT INTO deteccao SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$v_data',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='',registro='',nome='',justificativa='',deteccao_falsa='$deu_match',tag='$tag'");
 }
 
}
else
{
  // A PLACA EXISTE NA LISTA DE NAO DESEJADOS, SALVAREMOS NO SISTEMA SECUNDARIO
  //$sql = $dbcon->query("INSERT INTO deteccao_proibidas SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='SIM',registro='12345678',nome='USUARIO ROB�',justificativa='Placa detectada corretamente e a mesma n�o se trata de uma placa de carreta!',deteccao_falsa=''");
  $sql = $dbcon->query("INSERT INTO deteccao_proibidas SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$v_data',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='SIM',registro='12345678',nome='USUARIO ROBO',justificativa='Placa detectada corretamente e a mesma nao se trata de uma placa de carreta!',deteccao_falsa='',tag='$tag'");
}



//Dados da mensagem sem a imagem.
$msg_completa = $tipo_evento.','.$media_server_id.','.$camera.','.$detected_at.','.$local_api.','.$saida_detectada.','.$valor_placa.','.$video_placa.','.$condicao.','.$video_bascula;




include_once 'conexao_sva_cheio_vazio.php';
$sql = $dbcon->query("INSERT INTO teste SET mensagem='$msg_completa'");



 //Busco o ultimo ID
 //Agora busco o ultimo ID, ou seja, o ID dessa mensagem salva!
 $id_cheio_vazio = "";
 include_once 'conexao_sva_cheio_vazio.php';
 $sql = $dbcon->query("SELECT * FROM deteccao ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $id_cheio_vazio = $dados['id']; // Ultimo ID que refere a esse dado da API salvo!
 }

if($id_cheio_vazio == '')
{
	$id_cheio_vazio = 'x';
}









//agora atualizo o display
if($saida_detectada  != "Saida Segur Pro")
{
	if ($v_condicao == "Saindo Cheio!" )
	{
	 $condicao2 = "Saindo Cheio!"; 
	 include_once 'conexao_poste_balanca1.php';
	 $sql = $dbcon->query("UPDATE display_balanca1 SET id_cheio_vazio='$id_cheio_vazio', api_cheio_vazio='$condicao2' WHERE id='1'");
		  

	}
	else if ( $v_condicao == "Saindo Vazio!")
	{
	 $condicao2 = "Saindo Vazio!";  
	 include_once 'conexao_poste_balanca1.php';
	 $sql = $dbcon->query("UPDATE display_balanca1 SET id_cheio_vazio='$id_cheio_vazio', api_cheio_vazio='$condicao2' WHERE id='1'");
		
	}
	else if ( $v_condicao == "Deteccao Superior")
	{
	 $condicao2 = "Deteccao Superior!";  
	 include_once 'conexao_poste_balanca1.php';
	 $sql = $dbcon->query("UPDATE display_balanca1 SET id_cheio_vazio='$id_cheio_vazio', api_cheio_vazio='$condicao2' WHERE id='1'");
	}
	else
	{
	 $condicao2 = "Detectado Placa!";  
	  
	 //include_once 'conexao_poste_balanca1.php';
	 //$sql = $dbcon->query("UPDATE display_balanca1 SET id_cheio_vazio='$id_cheio_vazio', api_cheio_vazio='$condicao2' WHERE id='1'");

	}
}

$msg = '200 OK';
echo json_encode($msg);
http_response_code(200);

?>


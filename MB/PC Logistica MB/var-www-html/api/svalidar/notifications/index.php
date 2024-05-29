<?php
error_reporting(0);
$method = $_SERVER['REQUEST_METHOD']=='POST';
header('Content-Type: application/json;charset=utf-8;');
$dados = json_decode(file_get_contents('php://input'), true);
//print_r($dados);
//$mensagem = strval(implode("','",$dados));
//echo strlen($mensagem);

$media_server_id = $dados["media_server_id"]; // pega o nome do servidor
$camera = $dados["camera_id"]; // pega o nome do ms+numero camera EX: ms0099-cam00
$tipo_evento = $dados["type"]; // Para essa aplicacao sempre sera 15
$text = $dados["text"]; // Para essa aplicacao vem sempre DCG Distribuição
$detected_at = $dados["detected_at"]; // recebe o horario detectado pelo sistema SVA
$confidence = $dados["confidence"]; // Valor de 0 a 100, quando maior, significa que foi uma boa assertividade e pode confiar no evento
$mediaZ_Total = $dados["average_all"]; // Media do Z de todos os pontos
$mediaZ_Carga = $dados["average_cargo"];//["averageCargo"]; // Media do Z de todos os pontos
$dlc = $dados["dlc"]; // Numero entre 0 e 100 indicando a distribuicao longitudinal da carga
$dtc = $dados["dtc"]; // Numero entre 0 e 100 indicando a distribuicao longitudinal da carga
$videoURL = $dados["url"];//["videoURL"]; // Implementacao futura



if($videoURL == '')
{
 $videoURL = '-';   
}


$snapshotURL = $dados["image"];//["snapshotURL"]; // Implementacao futura
if($snapshotURL =='')
{
 $snapshotURL = '-';
}

$num_linhas_matrix = $dados["surface_rows"]; // Indica quantas linhas ha na matriz de superficie.
$num_colunas_matrix = $dados["surface_cols"]; // Indica quantas colunas ha na matriz de superficie.
$matrix = $dados["surface"]; //Matriz bidimensional com a altura de cada ponto do solo. Pontos onde nao houve leitura vem com null
date_default_timezone_set('America/Sao_Paulo');
$data_completa = date('d/m/Y');
$horario = date('H:i:s');

//TABELA CONDICAO DE VEICULOS
$v_mediaZ_Carga = intval($mediaZ_Carga);
$v_num_linhas_matrix = intval($num_linhas_matrix);
$veiculo = '';
$veiculo2 = '';

//caminhao traçado cheio $v_mediaZ_Carga >=2100 && $v_mediaZ_Carga <2450 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130
//caminhao traçado vazio
//caminhao pequeno $v_mediaZ_Carga >=2600 && $v_mediaZ_Carga <2700 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130 
//caminhao tank  $v_mediaZ_Carga >=2600 && $v_mediaZ_Carga <2700 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130

//carreta prancha $v_mediaZ_Carga >=1300 && $v_mediaZ_Carga <1400 && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390
//carreta vazia  $v_mediaZ_Carga >=1400 && $v_mediaZ_Carga <1800  && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390 
//carreta cheia  $v_mediaZ_Carga >=1800 && $v_mediaZ_Carga <2500  && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390
//carreta lonada  $v_mediaZ_Carga >=3000 && $v_mediaZ_Carga <4000 && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390
//carreta vazia  $v_mediaZ_Carga >=       && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390

//caminhao traçado cheio $v_mediaZ_Carga >=2100 && $v_mediaZ_Carga <2450 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130
if($v_mediaZ_Carga >=2100 && $v_mediaZ_Carga <2450 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130)
{
 //caminhao traçado cheio
 $veiculo = 'Traçado';
 $veiculo2 = 'Cheio'; 
}
//caminhao pequeno $v_mediaZ_Carga >=2600 && $v_mediaZ_Carga <2700 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130 
elseif($v_mediaZ_Carga >=2600 && $v_mediaZ_Carga <2700 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130)
{
 //caminhao pequeno
  $veiculo = 'Caminhão Pequeno';
  $veiculo2 = '';
}
//caminhao tank  $v_mediaZ_Carga >=2600 && $v_mediaZ_Carga <2700 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130
elseif($v_mediaZ_Carga >=2600 && $v_mediaZ_Carga <2700 && $v_num_linhas_matrix>70 && $v_num_linhas_matrix<130)
{
 //caminhao tank
 $veiculo = 'Caminhão tanque';
 $veiculo2 = '';  
}
//carreta prancha $v_mediaZ_Carga >=1300 && $v_mediaZ_Carga <1400 && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390
elseif($v_mediaZ_Carga >=1300 && $v_mediaZ_Carga <1400 && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390)
{
 //carreta prancha
 $veiculo = 'Carreta Prancha';
 $veiculo2 = '';
}
//carreta vazia  $v_mediaZ_Carga >=1400 && $v_mediaZ_Carga <1800  && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390 
elseif($v_mediaZ_Carga >=1400 && $v_mediaZ_Carga <1800  && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390) 
{
 $veiculo = 'Carreta';
 $veiculo2 = 'Vazia';    
}
//carreta cheia  $v_mediaZ_Carga >=1500 && $v_mediaZ_Carga <2500  && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390 
elseif($v_mediaZ_Carga >=1800 && $v_mediaZ_Carga <2500  && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390) 
{
 $veiculo = 'Carreta';
 $veiculo2 = 'Cheia';    
}

//carreta lonada  $v_mediaZ_Carga >=3000 && $v_mediaZ_Carga <4000 && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390
elseif($v_mediaZ_Carga >=3000 && $v_mediaZ_Carga <4000 && $v_num_linhas_matrix>=145 && $v_num_linhas_matrix<390)
{
//carreta lonada
$veiculo = 'Carreta';
$veiculo2 = 'Lonada';
}
else
{
 $veiculo = 'Nao identificado';
 $veiculo2 = 'Nao identificado';
}





$msg_completa = $media_server_id.','.$camera.','.$tipo_evento.','.$text.','.$detected_at.','.$conficende.','.$mediaZ_Total.','.$mediaZ_Carga.','.$dlc.','.$dtc.','.$num_linhas_matrix.','.$num_colunas_matrix;

include_once 'conexao_sva_lidar.php';
$sql = $dbcon->query("INSERT INTO teste SET mensagem='$msg_completa'");



//Busco os valores configurados para tolerancia de DLC e DTC
include_once 'conexao_sva_lidar.php';
$sql = $dbcon->query("SELECT * FROM configuracoes WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $valor_dlc = intval($dados['valor_dlc']); // dado em %
 $valor_dtc = intval($dados['valor_dtc']); // dado em %
}
$msg_alerta = '';
$alerta2 = '';

if(intval($dlc) != 0 && intval($dtc)!=0)
{
    $total_dlc_max = (50*($valor_dlc/100))+50 ; // Valor maximo DLC
    $total_dlc_min = 50-(50*($valor_dlc/100)) ; // Valor minimo DLC

    $total_dtc_max = (50*($valor_dtc/100))+50 ; // Valor maximo DTC
    $total_dtc_min = 50-(50*($valor_dtc/100)) ; // Valor minimo DTC

    $alerta_dlc = 0;
    $alerta_dtc = 0;
    if( floatval($dlc) > floatval($total_dlc_min) && floatval($dlc) < floatval($total_dlc_max) )
    {
    // Esta ok, dentro do valor aceito!
    $alerta_dlc = 0;  
    }
    else
    {
    $alerta_dlc = 1;  
    }

    if( floatval($dtc) > floatval($total_dtc_min) && floatval($dtc) < floatval($total_dtc_max) )
    {
    // Esta ok, dentro do valor aceito!
    $alerta_dtc = 0;  
    }
    else
    {
    $alerta_dtc = 1;
    }

   
    if($alerta_dlc == 1 || $alerta_dtc == 1)
    {
        if($alerta_dlc == 1 && $alerta_dtc == 0 )
        {
         $msg_alerta = 'Alerta DLC'; 
         //OBS: DLC quanto mais proximo de zero, sentido fluxo esta traseira, mais proximo 100, sentido fluxo esta dianteira
         if(floatval($dlc)<=floatval($total_dlc_min))
         {
          // esta descentralizada traseira
          $alerta2 = 'Carga descentralizada para a traseira!';
         }
         else
         {
          //pq esta maior, ou seja, seta descentralizada dianteira
          $alerta2 = 'Carga descentralizada para a dianteira!'; 
         }  
        }
        else if($alerta_dlc == 0 && $alerta_dtc == 1 )
        {
         $msg_alerta = 'Alerta DTC';   
         //OBS: DTC quanto mais proximo de zero, sentido fluxo esta para direita, mais proximo 100, sentido fluxo esta para esquerda
         if(floatval($dtc)<=floatval($total_dtc_min))
         {
          // esta descentralizada para a direita
          $alerta2 = 'Carga descentralizada transversalmente à direita!';
         }
         else
         {
          //pq esta maior, ou seja, seta descentralizada para a esquerda 
          $alerta2 = 'Carga descentralizada transversalmente à esquerda!'; 
         }
        }
        else
        {
            //Os dois sao 1
            $msg_alerta = 'Alerta DTC e DLC';
            $alerta2 = 'Carga descentralizada em dois pontos!';

        }
        
    }
    else
    {
    //Os 2 sao 0   
    $msg_alerta = 'Tudo OK'; 
    $alerta2 = 'Tudo OK';  
    }
}
else
{
 $msg_alerta = 'Erro';
 $alerta2 = 'Erro';   
}


include_once 'conexao_sva_lidar.php';
$sql = $dbcon->query("INSERT INTO dados_api_lidar SET  tipo_veiculo='$veiculo',condicao_veiculo='$veiculo2', media_server_id='$media_server_id',camera='$camera',tipo_evento='$tipo_evento',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',confidence='$confidence',mediaZ_Total='$mediaZ_Total',mediaZ_Carga='$mediaZ_Carga',dlc='$dlc',dtc='$dtc',alerta='$msg_alerta',alerta2='$alerta2',num_linhas_matrix='$num_linhas_matrix',num_colunas_matrix='$num_colunas_matrix',url_video='$videoURL',image='$snapshotURL',plot_lidar='".serialize($matrix)."',id_cheio_vazio='-',id_historico_display='-' ");


//Agora busco o ultimo ID, ou seja, o ID dessa mensagem salva!
$id = "";
include_once 'conexao_sva_lidar.php';
$sql = $dbcon->query("SELECT * FROM dados_api_lidar ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id']; // Ultimo ID que refere a esse dado da API salvo!
}

//SALVO O ULTIMO DETECTADO QUE NO CASO E ESSE NA TABELA DO DISPLAY PARA AJUDAR EM MATCH!
date_default_timezone_set('America/Sao_Paulo');
$data_alerta = date('d/m/Y');
$hora_alerta = date('H:i:s');


include_once 'conexao_poste_balanca1.php';
$sql = $dbcon->query("UPDATE display_balanca1 SET dlc='$dlc',dtc='$dtc',api_lidar='$id',alerta='$msg_alerta',alerta2='$alerta2',data_alerta='$data_alerta',hora_alerta='$hora_alerta',veiculo='$veiculo',condicao_veiculo='$veiculo2' WHERE id=1");


$msg = '200 OK';
echo json_encode($msg);
http_response_code(200);

?>


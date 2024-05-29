<?php
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO


error_reporting(0);


$radar = "radar_restaurante_mb";

$url = isset($_GET['nome'])?$_GET['nome']:"VAZIO";
$audio = isset($_GET['audio'])? $_GET['audio']:"VAZIO";

//echo($audio);
//echo($url);

if($url <>"VAZIO" && $audio <> "VAZIO")
{
    //echo("entrou"); 
    $mensagem= (explode("=",$url));
    $dia = $mensagem[0];
    $mes = $mensagem[1];
    $ano = $mensagem[2];
    $ano = explode("_",$ano);
    $dados = $ano[1];
    $ano = $ano[0];

    $dados = explode("^",$dados);
    $hora = $dados[0];
    $minutos = $dados[1];
    $segundos = $dados[2];

    $dados2 = explode("*",$segundos);
    $segundos = $dados2[0];

    $dados3 = explode(".",$dados2[1]);

    $velocidade = $dados3[0];
    $extensao = $dados3[1];


    $data = $dia."/".$mes."/".$ano;
    $horario_evento = $hora.":".$minutos.":".$segundos;

    $pasta = "videos/".$radar."/".$ano."/".$mes."/".$dia."/".$url;
    /*
    echo($dia);echo("/");echo($mes);echo("/");echo($ano);
    echo("</BR>");
    echo("</BR>");
    echo($hora);echo(":");echo($minutos);echo(":");echo($segundos);
    echo("</BR>");
    echo("</BR>");
    echo("Velocidade = ");echo($velocidade);echo(" Km/h");
    echo("</BR>");
    echo("Extensão = .");echo($extensao);
    echo("</BR>");
    echo($pasta);
    */

    include_once 'conexao_sva_externo.php';
    $sql = $dbcon->query("INSERT INTO radar_restaurante_mb(data_evento,horario_evento,caminho)VALUES('$data','$horario_evento','$pasta')");

    include_once 'conexao_sva_externo.php';

    $sql = $dbcon->query("INSERT INTO audios(audio)VALUES('$audio')");


}

?>

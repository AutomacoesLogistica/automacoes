<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amostragem VL</title>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>

</head>
<body>


<?php
include_once 'conexao_amostragem.php';
$sql = $dbcon->query("UPDATE configuracoes_amostragem SET tela='0' WHERE id=1");

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM configuracoes_amostragem WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $nome = strtoupper($dados['nome']);
 $placa = strtoupper($dados['placa']);
 $estoque = strtoupper($dados['estoque']);
 $material = strtoupper($dados['material']);
 $destino = strtoupper($dados['destino']);

}
if($nome == "NÃO IDENTIFICADO!"){$nome = "Não identificado!";}
if($estoque == "NÃO IDENTIFICADO!"){$estoque = "Não identificado!";}
if($material == "NÃO IDENTIFICADO!"){$material = "Não identificado!";}
if($destino == "NÃO IDENTIFICADO!"){$destino = "Não identificado!";}

?>
<label id="mensagem" hidden='hidden'></label>
<label id="lb_local">AMOSTRAGEM VÁRZEA DO LOPES</label>

<label id="lb_motorista"><?php print $nome ?></label>
<label id="lb_placa"><?php print $placa ?></label>
<label id="lb_estoque"><?php print $estoque ?></label>
<label id="lb_material"><?php print $material ?></label>
<label id="lb_destino"><?php print $destino ?></label>
<label id="lb_tempo" onclick='conta_tempo();'>25</label>
<label id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves</label>
</body>


<script>

var tamanho_nome = parseInt('<?php print strlen($nome)?>');
if(tamanho_nome >29)
{
 document.getElementById('lb_motorista').style.fontSize='32pt';
}

var tamanho_estoque = parseInt('<?php print strlen($estoque)?>');
if(tamanho_estoque >29)
{
 document.getElementById('lb_estoque').style.fontSize='32pt';
}

var tamanho_material = parseInt('<?php print strlen($material)?>');
if(tamanho_material >29)
{
 document.getElementById('lb_material').style.fontSize='32pt';
}

var tamanho_destino = parseInt('<?php print strlen($destino)?>');
if(tamanho_destino >29)
{
 document.getElementById('lb_destino').style.fontSize='32pt';
}


var utlima_mensagem = "-"; // Inicia com essa mensagem, nao mudar!
var msg_recebida = "";

function conta_tempo()
{
 var lb_tempo = document.getElementById('lb_tempo').innerHTML;
 setInterval(function() 
  {
    lb_tempo = parseInt(lb_tempo)-1;
    if(lb_tempo <= 1)
    {
      //volta para pagina
      lb_tempo = 1;
      location.href = "./tela_amostragem.php";
    }
    console.log(lb_tempo);
    document.getElementById('lb_tempo').innerHTML = lb_tempo;
  },1000);

}
function busca_mensagem() 
{
  setInterval(function() 
  {
    //Aqui vai o que deseja fazer
    $.ajax({
           url: 'busca_mensagem.php',
           type: 'GET',
           dataType: 'text',
           timeout: 8000,
           success: function(resultado){
            const myArray = resultado.split(";");
            
            msg_recebida = myArray[0];
            valor_tela = myArray[1];
            if(msg_recebida == utlima_mensagem)
            {
             console.log("Igual!");
            }
            else
            {
              utlima_mensagem = msg_recebida;
              console.log(msg_recebida);
              console.log(valor_tela);
              if(msg_recebida != '')
              {
               document.getElementById("mensagem").innerHTML = msg_recebida;
              }
              else{
                document.getElementById("mensagem").innerHTML = 'Marcação sendo realizada nos controles da UTMI!';
              }
            }
            
           }
       });
  }, 3000);


}
conta_tempo();

</script>


<style>
  LABEL#lb_local{
    position: absolute;
    text-align:center;
    font: bold 28pt Arial;
    color: #000000;
    left: 0%;
    top: 0%;
    padding-top: 1px;
    padding-bottom: 13px;
    width:100%;
    height:3.5%;
    background-color: transparent;

}
LABEL#lb_motorista{
    position: absolute;
    text-align:left;
    font: bold 36pt Arial;
    color: #000000;
    left: 27%;
    top: 8.5%;
    padding-top: 9px;
    padding-left: 22px;
    padding-bottom: 9px;
    width:65%;
    height:8.5%;
    background-color: transparent;

}
LABEL#lb_placa{
    position: absolute;
    text-align:left;
    font: bold 36pt Arial;
    color: #000000;
    left: 27%;
    top: 25.4%;
    padding-top: 9px;
    padding-left: 22px;
    padding-bottom: 9px;
    width:65%;
    height:8.5%;
    background-color: transparent;

}
LABEL#lb_estoque{
    position: absolute;
    text-align:left;
    font: bold 36pt Arial;
    color: #000000;
    left: 27%;
    top: 42.3%;
    padding-top: 9px;
    padding-left: 22px;
    padding-bottom: 9px;
    width:65%;
    height:8.5%;
    background-color: transparent;

}
LABEL#lb_material{
    position: absolute;
    text-align:left;
    font: bold 36pt Arial;
    color: #000000;
    left: 27%;
    top: 59.2%;
    padding-top: 9px;
    padding-left: 22px;
    padding-bottom: 9px;
    width:65%;
    height:8.5%;
    background-color: transparent;

}
LABEL#lb_destino{
    position: absolute;
    text-align:left;
    font: bold 36pt Arial;
    color: #000000;
    left: 27%;
    top: 76.1%;
    padding-top: 9px;
    padding-left: 22px;
    padding-bottom: 9px;
    width:65%;
    height:8.5%;
    background-color: transparent;

}
LABEL#lb_tempo{
    position: absolute;
    text-align:center;
    font: bold 36pt Arial;
    color: #000000;
    left: 5%;
    top: 88%;
    padding-top: 9px;
    padding-bottom: 9px;
    width:4%;
    height:8.5%;
    background-color: transparent;

}

LABEL#lb_desenvolvedor{
    position: absolute;
    text-align:center;
    font: bold 14pt Arial;
    color: rgba(0,0,0,0.5);
    left: 0%;
    top: 95%;
    padding-top: 1px;
    padding-bottom: 0px;
    width:100%;
    height:3.5%;
    background-color: transparent;

}

body{

margin-top: 0px;
}
html{
background: url("./images/base_tela_ca.png")center;
margin-top: -28.5%;
padding-top: 0px;
background-size: 100%;

}
</style>
</html>
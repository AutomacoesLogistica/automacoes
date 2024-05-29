<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href='./dashboard_utmi.php';"/>

<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>


<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->
<div id='dados'>

<?php
$nome_coluna = $_GET['label'];
//echo $nome_coluna;
//$nome_coluna = 'Entrada CO';

$quantidade_coluna = $_GET['quantidade'];

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  
//echo ( 'Hoje : ' .$data_agora);
//echo'</BR>';echo'</BR>';echo'</BR>';


$tipo = '';
$encontrado = 0;
$limite = 0;
// Conecto no banco e busco os valores
include_once 'conexao.php';

if($nome_coluna == 'Entrada Pires')
{
   $nome_coluna = 'Entrada'; 
    $sql = $dbcon->query("SELECT * FROM limites WHERE referencia='entradas' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
         $limite = $dados['limite_em_minutos'];
     }
    }    
}
else if($nome_coluna == 'Controles 1')
{
    $nome_coluna = 'Controle 1';
    $sql = $dbcon->query("SELECT * FROM limites WHERE referencia='controles' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
         $limite = $dados['limite_em_minutos'];
     }
    }    
}
else if($nome_coluna == 'Controle 2')
{
    $nome_coluna = 'Controle 2';
    $sql = $dbcon->query("SELECT * FROM limites WHERE referencia='controles' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
         $limite = $dados['limite_em_minutos'];
     }
    }    
}
else if($nome_coluna == 'Saída Automações')
{
    $nome_coluna = 'Saida';
    $sql = $dbcon->query("SELECT * FROM limites WHERE referencia='saidas' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
         $limite = $dados['limite_em_minutos'];
     }
    }    
}

/*
else if($nome_coluna == 'Pátio UTMI')
{
    $nome_coluna = 'Pátio UTMI';
    $sql = $dbcon->query("SELECT * FROM limites WHERE referencia='saida_co' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
         $limite = $dados['limite_em_minutos'];
     }
    }    
}

*/
//FALTA FAZER PARA OUTRAS COLUNAS!


























$limite_titulo = $limite; // Somente para exibir no titulo
$limite = (intval($limite)*60); // o * 6 somente para aumentar o valor da barra ja que na barra multiplico por 3


// Conecto no banco e busco os valores
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM dashboard WHERE tipo='$nome_coluna' ORDER BY hora_leitura ASC");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrado = $encontrado + 1;
  $id = $dados['id'];
  $placa_carreta = $dados['placa_carreta'];
  $placa_cavalo = $dados['placa_cavalo'];
  $epc_cavalo = $dados['epc_cavalo'];
  $epc_carreta = $dados['epc_carreta'];
  $data_banco = $dados['data_leitura'];
  $hora_banco = $dados['hora_leitura'];
  $mensagem = explode('/',$data_banco);
  $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
  $horario_banco = $mensagem . ' ' . $hora_banco; 
  
  //Agora calculo a diferença
  $data_inicio = new DateTime($data_agora);
  $data_fim = new DateTime($horario_banco);
  // Resgata diferença entre as datas
  $dateInterval = $data_inicio->diff($data_fim);
  $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
  $mensagem1 = explode(' ',$mensagem);
  $vmensagem1 = explode('/',$mensagem1[0]);
  $dia = $vmensagem1[0];
  $mes = $vmensagem1[1];
  $ano = $vmensagem1[2];
  $mensagem = explode(':',$mensagem1[1]);
  $hora = $mensagem[0];
  $minuto = $mensagem[1];
  $segundo = $mensagem[2];
  $tempo = $hora.':'. $minuto . ':' . $segundo;
  $valor = ((intval($hora)*3600)+(intval($minuto)*60)+intval($segundo)); // converte para segundos
  
  if($dia == 0 || $hora == 0)
  {

    
  
    if($placa_carreta !='')
    {
     ?>
     <img id="carreta" src="./images/carreta_alerta.png"/>
     <label id='placa' name='placa'>Placa: <b><?php print $placa_carreta ?></b></label>
     <label id='acesso' name='acesso'> Validado: <b><?php print $data_banco .' '. $hora_banco?></b></label>
     <label id='permanencia' name='permanencia'>Permanência: <b><?php print $tempo ?></b></label>
     
     <label class='t1' id='<?php print $id?>' name='<?php print $id?>'></label>
     <script>
     var link = document.getElementById('<?php print $id ?>');
     link.innerHTML = '                              ';
     //console.log(link.id);
     var valor = '<?php print $valor ?>';
     var limite = '<?php print $limite ?>';
     calculado = ((valor/limite)*100);
     if(calculado >=100){calculado = 100;}
     link.innerHTML = '    ';
     
     if(calculado >0 && calculado <=50)
     {
        document.getElementById('<?php print $id ?>').style.backgroundColor = "#3CB371";    
     }
     else if (calculado >50 && calculado <=80)
     {
       document.getElementById('<?php print $id ?>').style.backgroundColor = "#FFD700";
     }
     else
     {
        document.getElementById('<?php print $id ?>').style.backgroundColor = "#FF4500";  
     }

     var valor = ' <?php print $valor ?>';
     if(valor >=580)
     {
         valor = 580;
     }
     valor = (calculado*580)/100;
     console.log(valor + ' - ' + limite + ' = ' + calculado);
     document.getElementById('<?php print $id ?>').style.width = valor+"px";
     document.getElementById('<?php print $id ?>').style.heigth = "35px";
     
     </script>
     
     <label id='lb_percentagem' name='lb_percentagem'>0% ---------------------------- 25% ---------------------------- 50% ---------------------------- 75% ---------------------------- 100%</label>
     <label class='percentagem' id='<?php print $id ?>' name='<?php print $id ?>'></label>
     <script>
     var porcentagem = document.getElementById('<?php print $id ?>');
     porcentagem.innerHTML = (calculado.toFixed(1)) + ' %';

    </script>
     <?php   
     echo '</BR>'; //echo '-------------------------------------------------------------------------------------------------------------------------------------------';
     echo '</BR>';echo '</BR>';
    }
    else if ($placa_cavalo !='')
    {
     
      ?>  
      <img id="cavalo" src="./images/cavalo_alerta.png"/>
      <label id='placa' name='placa'>Placa: <b><?php print $placa_cavalo ?></b></label>
      <label id='acesso' name='acesso'> Validado: <b><?php print $data_banco .' '. $hora_banco?></b></label> 
      <label id='permanencia' name='permanencia'>Permanência: <b><?php print $tempo ?></b></label> 
      <label class='t1' id='<?php print $id?>' name='<?php print $id?>'></label>
     <script>
     var link = document.getElementById('<?php print $id ?>');
     link.innerHTML = '                              ';
     //console.log(link.id);
     var valor = '<?php print $valor ?>';
     var limite = '<?php print $limite ?>';
     calculado = ((valor/limite)*100);
     if(calculado >=100){calculado = 100;}
     link.innerHTML = '    ';
     //console.log(valor + ' - ' + limite + ' = ' + calculado);
     if(calculado >0 && calculado <=50)
     {
        document.getElementById('<?php print $id ?>').style.backgroundColor = "#3CB371";    
     }
     else if (calculado >50 && calculado <=80)
     {
       document.getElementById('<?php print $id ?>').style.backgroundColor = "#FFD700";
     }
     else
     {
        document.getElementById('<?php print $id ?>').style.backgroundColor = "#FF4500";  
     }

     var valor = ' <?php print $valor ?>';
     if(valor >=580)
     {
         valor = 580;
     }
     valor = (calculado*580)/100;
     document.getElementById('<?php print $id ?>').style.width = valor +"px";
     document.getElementById('<?php print $id ?>').style.heigth = "35px";
     
     </script>
    
    <label id='lb_percentagem' name='lb_percentagem'>0% ---------------------------- 25% ---------------------------- 50% ---------------------------- 75% ---------------------------- 100%</label>
     <label class='percentagem' id='<?php print $id ?>' name='<?php print $id ?>'></label>
     <script>
     var porcentagem = document.getElementById('<?php print $id ?>');
     porcentagem.innerHTML = (calculado.toFixed(1)) + ' %';
     </script>

   


      <?php
      //echo 'Placa: ' . $placa_cavalo .' - Data: ' . $data_banco . ' Hora: ' . $hora_banco . ' Tempo : ' . $tempo;
      echo '</BR>'; //echo '-------------------------------------------------------------------------------------------------------------------------------------------';
      echo '</BR>';echo '</BR>';
    }
    else
    {
      ?>
      <img id="alerta" src="./images/alerta.png"/>
      <label id='placa' name='placa'>Placa: <b>XXXXX</b></label>
      <label id='acesso' name='acesso'> Validado: <b><?php print $data_banco .' '. $hora_banco?></b></label> 
      <label id='permanencia' name='permanencia'>Permanência: <b><?php print $tempo ?></b></label> 
      
      <label class='t1' id='<?php print $id?>' name='<?php print $id?>' ></label>
     <script>
     var link = document.getElementById('<?php print $id ?>');
     link.innerHTML = '                              ';
     //console.log(link.id);
     var valor = '<?php print $valor ?>';
     var limite = '<?php print $limite ?>';
     calculado = ((valor/limite)*100);
     if(calculado >=100){calculado = 100;}
     link.innerHTML = '    ';
     console.log(valor + ' - ' + limite + ' = ' + calculado);
     if(calculado >0 && calculado <=50)
     {
        document.getElementById('<?php print $id ?>').style.backgroundColor = "#3CB371";    
     }
     else if (calculado >50 && calculado <=80)
     {
       document.getElementById('<?php print $id ?>').style.backgroundColor = "#FFD700";
     }
     else
     {
        document.getElementById('<?php print $id ?>').style.backgroundColor = "#FF4500";  
     }

     var valor = ' <?php print $valor ?>';
     if(valor >=580)
     {
         valor = 580;
     }
     valor = (calculado*580)/100;
     document.getElementById('<?php print $id ?>').style.width = valor +"px";
    
     document.getElementById('<?php print $id ?>').style.heigth = "35px";
     
     </script>
        <label id='lb_percentagem' name='lb_percentagem'>0% ---------------------------- 25% ---------------------------- 50% ---------------------------- 75% ---------------------------- 100%</label>
     <label class='percentagem' id='<?php print $id ?>' name='<?php print $id ?>'></label>
     <script>
     var porcentagem = document.getElementById('<?php print $id ?>');
     porcentagem.innerHTML = (calculado.toFixed(1)) + ' %';
     </script>

     

      <?php
      // echo 'Placa: XXXXXXXX - Data: ' . $data_banco . ' Hora: ' . $hora_banco . ' Tempo : ' . $tempo; 
      echo '</BR>'; //echo '-------------------------------------------------------------------------------------------------------------------------------------------';
      echo '</BR>';echo '</BR>';
    }

  }


 
  
  
  
  
  
  
     
  



 } // Fecha While
} // Fecha if



?>

</div>
<label id='titulo' name='titulo' > </label>
<label id='lb_referencia' name='lb_referencia' > </label>
<label id='lb_veiculos' name='lb_veiculos' > </label>

<script>
var link_titulo = document.getElementById('titulo');
var link_referencia = document.getElementById('lb_referencia');
var link_veiculos = document.getElementById('lb_veiculos');
var nome = '<?php print $nome_coluna ?>';
var referencia = '<?php print $limite_titulo ?>';
var n_encontrados = '<?php print $encontrado ?>';

//console.log(nome);
if(nome == 'Entrada')
{
    link_titulo.innerHTML = 'Ponto : <b>Entradas até controle</b>';
}
else if(nome == 'Controle 1' || nome == 'Controle 2')
{
    link_titulo.innerHTML = 'Ponto : <b>Disponíveis para carregamento</b>';
}
else if(nome == 'Excesso')
{
    link_titulo.innerHTML = 'Ponto : <b>Retirada / Completando Carga</b>';
}
else if(nome == 'Saida')
{
    link_titulo.innerHTML = 'Ponto : <b>Veiculos que saíram da planta</b>';
}
link_referencia.innerHTML ='Tempo Limite : <b>' + referencia + ' MIN</b>';
link_veiculos.innerHTML = 'Veículos na etapa: <b>' + n_encontrados + '</b>';
</script>











<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>

IMG#cavalo{
    margin-left: 0px;
    position: absolute;
    left: 1.5%;
    width: 50px;
    height: 36px;
    cursor: pointer;

}
IMG#carreta{
    margin-left: 0px;
    position: absolute;
    left: 1%;
    width: 58px;
    height: 32px;
    cursor: pointer;

}

IMG#alerta{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    width: 30px;
    height: 30px;
    cursor: pointer;

}







LABEL#titulo{
    margin-left: 0px;
    position: absolute;
    left: 5.2%;
    top: 7%;
    font-size: 30px;
    font-style: normal;
}
LABEL#lb_referencia{
    margin-left: 0px;
    position: absolute;
    left: 43%;
    top: 7%;
    font-size: 30px;
    font-style: normal;
}

LABEL#lb_veiculos{
    margin-left: 0px;
    position: absolute;
    left: 69%;
    top: 7%;
    font-size: 30px;
    font-style: normal;
}

DIV#dados{
    padding-top: 40px;
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 15%;
    width: 89%;
    height: 68%;
    background-color: #F8F8FF;
    font-size: 16px;
    font-style: normal;
    border-radius: 10px!important;
    border: 4px #000000 solid!important;
    overflow-x: hidden;
    overflow-y: auto;
}





LABEL#placa{
    margin-left: 0px;
    position: absolute;
    left: 6.5%;
    font-size: 18px;
    font-style: normal;
    
}

LABEL#acesso{
    margin-left: 0px;
    position: absolute;
    left: 17.5%;
    font-size: 18px;
    font-style: normal;
    
}

LABEL#permanencia{
    margin-left: 0px;
    position: absolute;
    left: 37%;
    font-size: 18px;
    font-style: normal;
    
}
.t1{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    width:100px;
    height:20px;
    background-color: #FF4500;
    font-size: 18px;
    font-style: normal;
    
}


LABEL#lb_percentagem{
    padding-left:0px;
    margin-top:-12px;
    margin-left: 0px;
    position: absolute;
    color: rgb(0,0,0);
    left: 52%;
    font-size: 12px;
    font-style: bold;
    
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
    top: 88%;
}


#conexao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3.1%;
    top: 0%;
    width:93%;
    height:4.2%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 5%;
    top: 12%;
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
    top: 12%;
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
    font: normal 12pt times;
}
html{
background: url("./images/tela_gerdau.png");
margin-top: 0px !important;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>
    















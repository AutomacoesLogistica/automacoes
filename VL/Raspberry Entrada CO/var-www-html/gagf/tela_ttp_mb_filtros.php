<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script type="text/javascript" src="./charts_pizza.js"></script>
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`ttp_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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

<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->

<?php

$data_inicio = $_GET['data_inicio'];
$data_fim = $_GET['data_fim'];
echo"</br>";echo"</br>";echo"</br>";
echo"<h3><b> Realizando filtro dos dados com inicio em " .$data_inicio ." até " .$data_fim . "</b></h3>";


error_reporting(0);
$valores_mes=["-","janeiro","fevereiro","marco","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro"];
$valores_bd_ttp_mb = ["-","conexao_ttp_mb_2020.php","conexao_ttp_mb_2021.php","conexao_ttp_mb_2022.php","conexao_ttp_mb_2023.php","conexao_ttp_mb_2024.php","conexao_ttp_mb_2025.php"];
$valores_bd_ttp_mb_resultado = ["-","conexao_ttp_mb_2020_resultado.php","conexao_ttp_mb_2021_resultado.php","conexao_ttp_mb_2022_resultado.php","conexao_ttp_mb_2023_resultado.php","conexao_ttp_mb_2024_resultado.php","conexao_ttp_mb_2025_resultado.php"];

$valor_mes_inteiro = "";
$valor_ano_inteiro = "";
$vezes = 0;
$encontrado = 0;
$data_ok = 0;
$data_nok = 0;
$processo_ok = 0;
$processo_nok = 0;
$placa_ok = 0;
$placa_nok = 0;
$veiculo_ok = 0;
$veiculo_nok = 0;
$centro_ok = 0;
$centro_nok = 0;

$nomination_ok = 0;
$nomination_nok = 0;
$finalizado_ok = 0;
$finalizado_nok = 0;
$n_inseridos_ok = 0;
$n_inseridos_nok = 0;
$n_erros_inseridos_ok = 0;
$n_erros_inseridos_nok = 0;
$peso_bruto_mb = 0;
$tipo_operacao = "";
$mes = "";
$ano = "";
$data_entrada = "";
$data_segunda_pesagem = "";
$dia_entrada = "";
$dia_segunda_pesagem = "";
$hora_entrada= "";
$hora_segunda_pesagem= "";
$tempo_permanencia = ""; 
$h_entrada="";
$m_entrada="";
$s_entrada="";
$h_segunda_pesagem="";
$m_segunda_pesagem="";
$s_segunda_pesagem="";
$h_final="";
$m_final="";
$s_final="";
$minutos_totais="";
$somatorio_minutos_totais="";
$dentro_local="";
$cancelados="";
$outros="";


$letra_turno = "";
$letraA="";
$letraB="";
$letraC="";
$letraD="";

$uma_hora = 0;
$duas_horas = 0;
$tres_horas = 0;
$quatro_horas = 0;
$cinco_horas = 0;
$mais_cinco = 0;
$total=0;
$dentro_local=0;
$menos_1hora_dentro = 0;
$uma_hora_dentro = 0;
$duas_horas_dentro = 0;
$tres_horas_dentro = 0;
$quatro_horas_dentro = 0;
$cinco_horas_dentro = 0;
$mais_cinco_dentro = 0;
$cancelados=0;
$outros=0;

$letraA=0;
$letraB=0;
$letraC=0;
$letraD=0;











$encontrado_resultado = 0;
$real = 0;
$minimo = 0;
$planejado = 0;
$desafio = 0;
$id = 0;

$mes = substr($data_inicio,3,2);
$ano = substr($data_inicio,6,4); 

  //include_once "conexao.php";
  $ultimo_id = 0;
  $valor_mes_inteiro = intval($mes); // Busca o mes da data do processo e converte para posicao do array
  $valor_ano_inteiro = intval($ano)-2019; // Busca o mes da data do processo e converte para posicao do array
  $conexao_ttp = $valores_bd_ttp_mb[$valor_ano_inteiro];
  $conexao_ttp_resultado = $valores_bd_ttp_mb_resultado[$valor_ano_inteiro];
  $tabela_ttp = $valores_mes[$valor_mes_inteiro];
  $mes_ttp_resultado = $valores_mes[$valor_mes_inteiro];
  include_once $conexao_ttp_resultado;
  

  $sql_ttp_resultado = $aux_conexao_ttp_resultado->query("SELECT * FROM resultado");
  if(mysqli_num_rows($sql_ttp_resultado)>0)
  {
    while($dados = $sql_ttp_resultado->fetch_array())
   { 
    $id = $dados['id'];
    $encontrado_resultado++;
    if ( $id == 1) // Busca real
    {
    $real = $dados[$mes_ttp_resultado];
    
    }
    else if ( $id == 2) // Busca Minimo
    {
     $minimo = $dados[$mes_ttp_resultado];
    }
    else if ( $id == 3) // Busca Planejado
    {
     $planejado = $dados[$mes_ttp_resultado];
    }
    else if ( $id == 4) // Busca Desafio
    {
     $desafio = $dados[$mes_ttp_resultado];
    }
   }
  }
  
  ?>
   <script>
   var real = "<?php print $real ?>";
   var minimo = "<?php print $minimo ?>";
   var planejado = "<?php print $planejado ?>";
   var desafio = "<?php print $desafio ?>";
  </script>
  <?php
  $encontrado = 0;
  include_once $conexao_ttp;
  $sql_ttp = $aux_conexao_ttp->query("SELECT * FROM $tabela_ttp WHERE data_entrada between '$data_inicio' and '$data_fim'");
  if(mysqli_num_rows($sql_ttp)>0)
  {
    ?>
    <div id="tabela">
     <table border= 1px; >
      <thead >
       <tr>
    	<th class="th1">Data</th>
    	<th class="th2">Nº GSCS</th>
    	<th class="th3">Placa</th>
        <th class="th4">Transportadora</th>
        <th class="th5">C. Acesso</th>
        <th class="th6">Pesagem</th>
        <th class="th7">Permanência</th>
        <th class="th8">Min</th>
       </tr>
      </thead>
      <tbody>
     <?php   
     $somatorio_minutos_totais = 0;
   while($dados = $sql_ttp->fetch_array())
   { 
       $encontrado++;
       $barra = "/";   
       $placa_completa =  strval($dados['placa']) . $barra . strval($dados['estado']);
       $somatorio_minutos_totais = intval($somatorio_minutos_totais) + intval($dados['minutos_permanencia']);
       
 
       if ( intval($dados['minutos_permanencia'])>=60 )     
       { // Abre o if para somente tempos maiores que 60minutos
         $total++;
         if ( intval($dados['minutos_permanencia'])>=60 && intval($dados['minutos_permanencia'])<120)
         {
          $uma_hora++;
          if($dados['letra']=="A")
          {
           $letraA++;
          }
          else if ($dados['letra']=="B")
          {
           $letraB++;
          }
          else if ($dados['letra']=="C")
          {
           $letraC++;   
          }
          else
          {
           $letraD++;
          }
         }
         else if( intval($dados['minutos_permanencia'])>=120 && intval($dados['minutos_permanencia'])<180)
         {
          $duas_horas++;
          if($dados['letra']=="A")
          {
           $letraA++;
          }
          else if ($dados['letra']=="B")
          {
           $letraB++;
          }
          else if ($dados['letra']=="C")
          {
           $letraC++;   
          }
          else
          {
           $letraD++;
          }   
         }
         else if( intval($dados['minutos_permanencia'])>=180 && intval($dados['minutos_permanencia'])<240)
         {
          $tres_horas++;
          if($dados['letra']=="A")
          {
           $letraA++;
          }
          else if ($dados['letra']=="B")
          {
           $letraB++;
          }
          else if ($dados['letra']=="C")
          {
           $letraC++;   
          }
          else
          {
           $letraD++;
          }
         }
         else if( intval($dados['minutos_permanencia'])>=240 && intval($dados['minutos_permanencia'])<300)
         {
          $quatro_horas++;
          if($dados['letra']=="A")
          {
           $letraA++;
          }
          else if ($dados['letra']=="B")
          {
           $letraB++;
          }
          else if ($dados['letra']=="C")
          {
           $letraC++;   
          }
          else
          {
           $letraD++;
          }
         }
         else if( intval($dados['minutos_permanencia'])>=300 && intval($dados['minutos_permanencia'])<360)
         {
          $cinco_horas++;
          if($dados['letra']=="A")
          {
           $letraA++;
          }
          else if ($dados['letra']=="B")
          {
           $letraB++;
          }
          else if ($dados['letra']=="C")
          {
           $letraC++;   
          }
          else
          {
           $letraD++;
          } 
         }
         else
         {
          $mais_cinco++;
          if($dados['letra']=="A")
          {
           $letraA++;
          }
          else if ($dados['letra']=="B")
          {
           $letraB++;
          }
          else if ($dados['letra']=="C")
          {
           $letraC++;   
          }
          else
          {
           $letraD++;
          }
         }
         
         
        ?>
        <tr>
         <td class="th1"><?php print $dados['data_entrada'];?></td>
         <td class="th2"><?php print $dados['id_processo_gscs'];?></td>
         <td class="th3"><?php print strval($placa_completa);?></td>
         <td class="th4"><?php print $dados['transportadora'];?></td>
         <td class="th5"><?php print $dados['hora_entrada'];?></td>
         <td class="th6"><?php print $dados['hora_pesagem'];?></td>
         <td class="th7"><?php print $dados['tempo_permanecia'];?></td>
         <td class="th8"><?php print $dados['minutos_permanencia'];?></td>
        </tr>
        <?php
       } // Fecha o plota somente os maiores que 60minutos
      } // fecha while
     
      ?>
      </tbody>
     </table>
     </div>
     <?php
 } // fecha se sql>0
  else
  {
   //echo "não encontrado!";   
  }


   

   















?>
 <div id="relatorio">
  <?php
  if ( $encontrado != 0)
  {     
  echo"<h3>Relatorio dos Dados</h3>";
  echo "<b>Número de Pesagens : </b>" .$encontrado; 
  echo"</br>";echo"</br>";

 // $valor_media = number_format($somatorio_minutos_totais/$encontrado,1)
  //$v_hora = substr($valor_media,3,2);


  echo "<b>Média Permanência = </b>";echo number_format($somatorio_minutos_totais/$encontrado,1);echo " MIN";
  echo"</br>";echo"</br>";
  echo "<b>Total Acima 1 Hora = "; echo $total;echo "</b> - "; echo number_format($total/$encontrado*100, 2, '.', '') ; echo "%";
  echo"</br>";
  echo " > 1 Hora = "; echo $uma_hora;
  echo"</br>";
  echo " > 2 Horas = "; echo $duas_horas;
  echo"</br>";
  echo " > 3 Horas = "; echo $tres_horas;
  echo"</br>";
  echo " > 4 Horas = "; echo $quatro_horas;
  echo"</br>";
  echo " > 5 Horas = "; echo $cinco_horas;
  echo"</br>";
  echo " > 6 horas ou mais = "; echo $mais_cinco;
  echo"</br>";echo"</br>";
  echo"<b>Letra A = </b>";echo $letraA;echo " - ".number_format($letraA/$total*100, 2, '.', '') ; echo "%";echo"</br>";
  echo"<b>Letra B = </b>";echo $letraB;echo " - ".number_format($letraB/$total*100, 2, '.', '') ; echo "%";echo"</br>";
  echo"<b>Letra C = </b>";echo $letraC;echo " - ".number_format($letraC/$total*100, 2, '.', '') ; echo "%";echo"</br>";
  echo"<b>Letra D = </b>";echo $letraD;echo " - ".number_format($letraD/$total*100, 2, '.', '') ; echo "%";echo"</br>";
  echo"</br>";echo"</br>";
  
  echo "<b>Meta TTP : </b>";
  if ( intval(($total/$encontrado)*100)>intval($minimo)) // Esta muito ruim
  {
   echo "<b><font color='#FF0000'>Está acima do minimo! </font></b>";
   echo "</br>";echo "</br>";
   echo "Planejado = " .number_format($planejado, 2, '.', '')." %" ;
   echo "</br>";
   echo "Desafio = " .number_format($desafio, 2, '.', '') . " %";

  }
  else if ( intval(($total/$encontrado)*100)<intval($planejado) && intval(($total/$encontrado)*100)>intval($desafio)  ) // Atingiu o planejado!
  {
   echo "Atingiu o planejado !";
   echo "</br>";echo "</br>";
   echo "Desafio = " .number_format($desafio, 2, '.', '') . " %";
  }
  else // Se menor  é desafio
  {
   echo "Parabéns, atingiu o desafio !" ;
  } 
  
  }
  else
  {
   echo "Dados não encontrados!";
  }
  ?>
 </div>






<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>

.th1{
    width: 85px;  
    text-align: center;
}
.th2{
    width: 75px;
    text-align: center;  
}
.th3{
    width: 110px;
    text-align: center;  
}
.th4{
    width: 290px;
    
    text-align: center;  
}
.th5{
    width: 85px;
    text-align: center;  
}
.th6{
    width: 85px;
    text-align: center;  
}
.th7{
    width: 100px;
    text-align: center;  
}
.th8{
    width: 30px;
    text-align: center;  
}
table {
    width: 932px;
    display:inline-block;
    background-color:#ADD8E6;
    font: normal 12pt times;
}
thead {
    display: inline-block;
    width: 100%;
    height: 20px;
    background-color:#F5F5DC;
    color: #000000;
    padding-top:2px;
    padding-bottom:5px;
    
}
tbody {
    height: 500px;
    display: inline-block;
    width: 100%;
    background-color:#F8F8FF;
    overflow: auto;
    
}


#relatorio{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 80px;
    top: 105px;
    color: #000000;
}

div#tabela{
    margin-left: 0px;
    position: absolute;
    left: 370px;
    font: normal 12pt times;
    top: 100px;
    color: #000000;
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
margin-top: -25px !important;
padding-left:70px;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>
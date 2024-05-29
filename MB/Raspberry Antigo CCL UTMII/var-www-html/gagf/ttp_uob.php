<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body onload="atualiza_data();">



<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ttp_mb2.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>

    
<script>
var array_n_processo = [];
var array_n_placa = [];
var array_data_entrada = [];
var encontrados = 0;
for (i=0;i<200;i++)
  {
    array_n_processo[i]=0;
    array_data_entrada[i]=0;
    array_n_placa[i]=0;
  }


</script>



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




<form method="post" enctype="multipart/form-data">
<label id="lb_selecione" >Selecione arquivo .TXT que contenha os dados do TTP Usina de Ouro Branco vindos do TMC</label>
<div>  
<input id="btn_escolher" type="file" name="file"/>
<input id="btn_importar" type="submit" name="submit" value="Importar" class="btn btn-info"/>
</div>


</form>

<input id="btn_pesquisar" type="image" src="./images/pesquisar2.png" alt="button" onclick="atualiza_dados();" >

<label id="lbInicio">Data Inicio</label>
<label id="lbFim">Data Fim</label>
<input id="data_inicio" type="date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
<input id="data_fim" type="date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

<?php  
//error_reporting(0);
set_time_limit(800);
$valores_mes=["-","janeiro","fevereiro","marco","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro"];
$valores_bd_ttp_usina = ["-","conexao_ttp_uob_2020.php","conexao_ttp_uob_2021.php","conexao_ttp_uob_2022.php","conexao_ttp_uob_2023.php","conexao_ttp_uob_2024.php","conexao_ttp_uob_2025.php"];
$conexao = "";
$valor_mes_inteiro = "";
$valor_ano_inteiro = "";

include_once "conexao.php";
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'txt')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   //echo"<script>alert(sizeof('$handle')) </script>";
   
   $vezes = 0;
   $n_inseridos_ok = 0;
   $n_inseridos_nok = 0;
   $data_nok = 0;
   $placa_ok = 0;
   $placa_nok = 0;
   $status_placa = "";
   $movimento_ok = 0;
   $movimento_nok = 0;
   $status_movimento = "";
   $tipo_documento_ok = 0;
   $tipo_documento_nok = 0;
   $status_documento = "";
   $tipo_documento_TB = 0;
   $tipo_documento_NF = 0;
   $numero_documento_ok = 0;
   $numero_documento_nok = 0;
   $status_numero_documento = "";
   $material_ok = 0;
   $material_nok = 0;
   $status_material = "";
   $se_pesa_ok = 0;
   $se_pesa_nok = 0;
   $status_se_pesa = "";
   $tempo_entrada_ok = 0;
   $tempo_entrada_nok = 0;
   $saiu = 0;
   $dentro_local = 0;
   $n_corretos = 0;
   $pesou_tara = 0;
   $n_pesou_tara = 0;
   $letra_turno = "";
   $resultado = "";
   $data_entrada = "";
   $hora_entrada = "";
   $data_bruto = "";
   $hora_bruto = "";
   $data_tara = "";
   $hora_tara = "";
   $data_saida = "";
   $hora_saida = "";
   $data_pesagem_mb = "";
   $hora_pesagem_mb = "";
   $dia_pesagem_mb = "";
   $tempo_mb_usina = "";
   $tempo_entrada_saida_usina = "";
   $uma_hora = 0;
   $duas_horas = 0;
   $tres_horas = 0;
   $quatro_horas = 0;
   $cinco_horas = 0;
   $mais_cinco = 0;
   $total=0;
   $menos_1hora_dentro = 0;
   $uma_hora_dentro = 0;
   $duas_horas_dentro = 0;
   $tres_horas_dentro = 0;
   $quatro_horas_dentro = 0;
   $cinco_horas_dentro = 0;
   $mais_cinco_dentro = 0;
   $cancelados=0;
   $outros=0;
   $conaxao = "";
   $letraA=0;
   $letraB=0;
   $letraC=0;
   $letraD=0;
   $hora_usina_mb1="";
   $hora_usina_mb2="";
   $somatorio_minutos_totais=0;
  

   ?>

   <div id="tabela2">
   
     <table border= 1px; id="tblExport">
      <thead >
       <tr>
    	<th class="th1">Placa</th>
    	<th class="th2">Data</th>
    	<th class="th3">Nº TMC</th>
       </tr>
      </thead>
      <tbody>
   <?php   

   while($data = fgetcsv($handle,40000,"\t"))
   {
    if ( $vezes >=2 )
    {   
     $item1 = mysqli_real_escape_string($dbcon, isset($data[0])?$data[0]:"0"); // Placa
     if($item1==""){$item1= "vazio";}
     $item2 = mysqli_real_escape_string($dbcon, isset($data[1])?$data[1]:"0"); // Movimento
     if($item2==""){$item2= "vazio";}
     $item3 = mysqli_real_escape_string($dbcon, isset($data[2])?$data[2]:"0"); // Tipo Documento
     if($item3==""){$item3= "vazio";}
     $item4 = mysqli_real_escape_string($dbcon, isset($data[3])?$data[3]:"0"); // Numero Documento
     if($item4==""){$item4= "vazio";}
     $item5 = mysqli_real_escape_string($dbcon, isset($data[4])?$data[4]:"0"); // Material / NI
     if($item5==""){$item5= "vazio";}
     $item6 = mysqli_real_escape_string($dbcon, isset($data[5])?$data[5]:"0"); // Se pesa 
     if($item6==""){$item6= "vazio";}
     $item7 = mysqli_real_escape_string($dbcon, isset($data[6])?$data[6]:"0"); // Tempo que passou na saida da balanca MB
     if($item7==""){$item7= "vazio";}
     $item8 = mysqli_real_escape_string($dbcon, isset($data[7])?$data[7]:"0"); // Tempo da entrada usina
     if($item8==""){$item8= "vazio";}
     $item9 = mysqli_real_escape_string($dbcon, isset($data[8])?$data[8]:"0"); //Tempo pesou o bruto usina
     if($item9==""){$item9= "vazio";}
     $item10 = mysqli_real_escape_string($dbcon, isset($data[9])?$data[9]:"0"); // Tempo que tirou a tara na usina
     if($item10==""){$item10= "vazio";}
     $item11 = mysqli_real_escape_string($dbcon, isset($data[10])?$data[10]:"0"); //Bruto 2 
     if($item11==""){$item11= "vazio";}
     $item12 = mysqli_real_escape_string($dbcon, isset($data[11])?$data[11]:"0"); // Tempo entre bruto e tara ( Ficou la dentro)
     if($item12==""){$item12= "vazio";}
     $item13 = mysqli_real_escape_string($dbcon, isset($data[12])?$data[12]:"0"); // Tempo saiu da usina
     if($item13==""){$item13= "vazio";}
     $item14 = mysqli_real_escape_string($dbcon, isset($data[13])?$data[13]:"0"); // Tempo usina ( Tempo desde a pesagem em MB até a saida usina)
     if($item14==""){$item14= "vazio";}
          

     if ($item3=="TB") // SOMENTE ENTRA SE FOR TB
     {     
      if(strlen($item8)==16) // Ja entrou na usina
      {
      
      if (strlen($item1)==7) // Verifica se a placa esta ok ********************************************************************************
      {
       $placa_ok++;  
       $status_placa = "sim";         
       $placa = "";
       $placa = substr($item1,0,3) . "-" . substr($item1,3,4);
       //echo "$placa"; // Tamanho 7
       //echo"  -  ";
      }
      else
      {
       $placa_nok++;
       $status_placa = "nao";
      }
      
      if (strlen($item2)>=8) // Movimento **************************************************************************************************
      {
       $movimento_ok++;
       $status_movimento = "sim";
       //echo "$item2";// Tamanho >=8
       //echo"  -  ";
      }  
      else
      {
       $movimento_nok++;
       $status_movimento = "nao";
      }
      
      if (strlen($item3)!=0) // Tipo documento *********************************************************************************************
      {
       if ($item3=="TB")
       {
        $tipo_documento_ok++;
        $status_documento = "sim";  
        $tipo_documento_TB++;
       }
      }
      else
      {
       $tipo_documento_nok++;
       $status_documento = "nao"; 
      }

      if (strlen($item4)!=0) // Numero documento *******************************************************************************************
      {
       $numero_documento_ok++;
       $status_numero_documento = "sim";
       //echo "$item4";// != ""
       //echo"  -  ";
      }
      else
      {
       $numero_documento_nok++;
       $status_numero_documento = "nao";
      }

      if (strlen($item5)!=0) // Tipo de material *******************************************************************************************
      {
       $material_ok++;
       $status_material = "sim";  
       //echo "$item5";// != ""
       //echo"  -  ";
      }
      else
      {
       $material_nok++;
       $status_material = "nao";
      }

      if (strlen($item6)!=0) // Se pesa ****************************************************************************************************
      {
       $se_pesa_ok++;
       $status_se_pesa = "sim";
       //echo "$item6";// != ""
       //echo"  -  ";
      }
      else
      {
       $se_pesa_nok++;
       $status_se_pesa = "nao";
      } 
       
      if (strlen($item8)==16) // Tamanho 16 tempo de entrada na usina ***********************************************************************
      {
       //echo "$item8";
       //echo"  -  ";
       $tempo_entrada_ok++;
      }
      else
      {
       $tempo_entrada_nok++;  
      }
        
      if (strlen($item9)==16)
      {
       //echo "$item9";// Tamanho 16 tempo de que pesou o bruto na usina
       //echo"  -  ";
      }
      else
      {
       //echo "erro";
      }  
       
      if (strlen($item10)==16)
      {
       $pesou_tara++;  
       //echo "$item10";// Tamanho 16 tempo de que tirou a tara na usina
       //echo"-";
      }
      else
      {
       $n_pesou_tara++;
       //echo "erro";
      } 
      
      if (strlen($item12)==5)
      {
       //echo "$item12";// Tamanho 5 tempo de que ficou la dentro - diferenca entra tara e bruto
       //echo"  -  ";
      }
      else
      {
       //echo "erro";
      }
      
      if ( strlen($item8)==16 &&  strlen($item13)==16) // Tamanho 16 tempo de entrada e saida da usina ***********************************************************************
      {
       $saiu++; // saiu da usina    
       $n_corretos++;

       // FAZ AS TRATATIVAS POIS ESTAO FINALIZADOS, OS QUE ESTAO DENTO DO SITE SAO TRATADOS ABAIXO
       // FAZ AS TRATATIVAS POIS ESTAO FINALIZADOS, OS QUE ESTAO DENTO DO SITE SAO TRATADOS ABAIXO
       // FAZ AS TRATATIVAS POIS ESTAO FINALIZADOS, OS QUE ESTAO DENTO DO SITE SAO TRATADOS ABAIXO
       // FAZ AS TRATATIVAS POIS ESTAO FINALIZADOS, OS QUE ESTAO DENTO DO SITE SAO TRATADOS ABAIXO
       $data_entrada = substr($item8,0,10);
       $hora_entrada = substr($item8,11,5);
       $dia_entrada = substr($item8,0,2);
       $data_bruto = substr($item9,0,10);
       $hora_bruto = substr($item9,11,5);
       $dia_bruto = substr($item9,0,2);
       $data_tara = substr($item10,0,10);
       $hora_tara = substr($item10,11,5);
       $dia_tara = substr($item10,0,2);
       $data_pesagem_mb = substr($item7,0,10);
       $hora_pesagem_mb = substr($item7,11,5);
       $dia_pesagem_mb = substr($item7,0,2);
       $data_saida = substr($item13,0,10);
       $hora_saida = substr($item13,11,5);
 
       
       //Calculo dos tempos
       //Diferenca entre chegada na usina e o tempo que pesou na mina, calcula o tempo de deslocamento
       $hora_usina_mb1 = DateTime::createFromFormat('d/m/Y H:i', $data_pesagem_mb." ".$hora_pesagem_mb);
       $hora_usina_mb2 = DateTime::createFromFormat('d/m/Y H:i', $data_entrada." ".$hora_entrada);
       $tempo_mb_usina = $hora_usina_mb1->diff($hora_usina_mb2)->format('%H:%I');
       
       //Diferenca entre entrada na usina e e saida da usina
       $hora_usina1 = DateTime::createFromFormat('d/m/Y H:i', $data_entrada." ".$hora_entrada);
       $hora_usina2 = DateTime::createFromFormat('d/m/Y H:i', $data_saida." ".$hora_saida);
       $tempo_entrada_saida_usina = $hora_usina1->diff($hora_usina2)->format('%H:%I');
       
       $tempo_permanencia = $item12;
       $verifica_hora = intval(substr($tempo_permanencia,0,2));
       if($verifica_hora>0)
       {
         $somatorio_minutos_totais = $somatorio_minutos_totais + (( intval($verifica_hora)*60)+ intval(substr($tempo_permanencia,3,2) )    );
       }
       else
       {
         $somatorio_minutos_totais = $somatorio_minutos_totais + intval(substr($tempo_permanencia,3,2)); 
       }
 
       // BUSCA EM FUNCAO DA DATA O TURNO REFERENTE ********************************************************************************************
       // BUSCA EM FUNCAO DA DATA O TURNO REFERENTE ********************************************************************************************
       // BUSCA EM FUNCAO DA DATA O TURNO REFERENTE ********************************************************************************************
       // BUSCA EM FUNCAO DA DATA O TURNO REFERENTE ********************************************************************************************
       // BUSCA EM FUNCAO DA DATA O TURNO REFERENTE ********************************************************************************************
       include_once "conexao.php";
       $sql5 = $dbcon->query("SELECT * FROM lista_turno WHERE data='$data_entrada'");
       $resultado = intval(substr($hora_entrada,0,2)); 
       if(mysqli_num_rows($sql5)>0)
       {
        while($dados = $sql5->fetch_array())
        {
         if($resultado >= 0 && $resultado < 8) // Pertence ao primeiro turno
         {
          $letra_turno = $dados['turno1'];
         }
         else if($resultado >= 8 && $resultado < 17) // Pertence ao segundo turno
         {
          $letra_turno = $dados['turno2'];
         }
         else if($resultado >= 17 && $resultado <=23 )
         {
          $letra_turno = $dados['turno3'];
         }
         else
         {
          // Existe erro
         }
        } // Fecha while
       } // Fecha o if
       
       // *************************************************************************************************************************************
       // *************************************************************************************************************************************
       // *************************************************************************************************************************************
       // *************************************************************************************************************************************
       // *************************************************************************************************************************************
 
 
       // TRATA OS DADOS PARA SALVAR NO BANCO
       //echo $letra_turno;
       //echo"</br>";
       $mes = substr($data_entrada,3,2);
       $ano = substr($data_entrada,6,4); 
       $valor_mes_inteiro = intval($mes); // Busca o mes da data do processo e converte para posicao do array
       $valor_ano_inteiro = intval($ano)-2019;
       $conexao = $valores_bd_ttp_usina[$valor_ano_inteiro];
       $tabela = $valores_mes[$valor_mes_inteiro];
       $movimento = $item2;
       $tipo_documento = $item3;
       $numero_documento = $item4;
       $material = $item5;
       $se_pesa = $item6;
       include $conexao;
       $sql_ttp2 = $aux_conexao_ttp->query("SELECT * FROM `$tabela` WHERE movimento='$movimento'"); // Busca se ja existe o n do processo gscs no banco
       if(mysqli_num_rows($sql_ttp2)>0)
       {
        // Se entrar aqui e porque ja exsite este processo salvo no banco e nao deixa duplicas
        $n_inseridos_nok++;
       }
       else // PODE SALVAR POIS NÃO EXISTE ESTE PROCESSO NO BANCO
       {
        $n_inseridos_ok++;   
        $sql_ttp2 = $aux_conexao_ttp->query("INSERT INTO $tabela  (placa,estado,movimento,tipo_documento,numero_documento,material_ni,se_pesa,data_entrada_usina,hora_entrada_usina,dia_entrada,data_pesou_bruto,hora_pesou_bruto,dia_pesou_bruto,data_pesou_tara,hora_pesou_tara,dia_pesou_tara,tempo_permanencia,turno,data_pesagem_mb,hora_pesagem_mb,dia_pesagem_mb,tempo_mb_usina,tempo_entrada_saida_usina) VALUES ('$placa','-','$movimento','$tipo_documento','$numero_documento','$material','$se_pesa','$data_entrada','$hora_entrada','$dia_entrada','$data_bruto','$hora_bruto','$dia_bruto','$data_tara','$hora_tara','$dia_tara','$tempo_permanencia','$letra_turno','$data_pesagem_mb','$hora_pesagem_mb','$dia_pesagem_mb','$tempo_mb_usina','$tempo_entrada_saida_usina')");
       }
       
              
      
      }
      else
      {
        $dentro_local++;
        // TRATA OS VEICULOS QUE AINDA ESTAO DENTRO DA USINA 
        // TRATA OS VEICULOS QUE AINDA ESTAO DENTRO DA USINA 
        // TRATA OS VEICULOS QUE AINDA ESTAO DENTRO DA USINA 
        // TRATA OS VEICULOS QUE AINDA ESTAO DENTRO DA USINA 
        // TRATA OS VEICULOS QUE AINDA ESTAO DENTRO DA USINA 

       // Trata tempos para quebrar os valores
       $mes = substr($data_entrada,3,2);
       $ano = substr($data_entrada,6,4);
       
       $num_processo_tmc = $item4; // Numero do processo para exibir numeros dentro             
       $data_entrada = substr($item8,0,10); ;// Hora para exibir tabela dos dentro e outros
       $placa = substr($item1,0,3) . "-" . substr($item1,3,4);
           
       
       ?>
       <tr>
       <td class="th1"><?php print $placa;?></td>
       <td class="th2"><?php print $data_entrada;?></td>
       <td class="th3"><?php print $num_processo_tmc; ?></td>
       </tr>
       <?php
        
        // TRATANDO OS TEMPOS DOS QUE ESTÃO DENTRO DA USINA
        $data_entrada = substr($item8,0,10);
        $hora_entrada = substr($item8,11,5);
       
         date_default_timezone_set('America/Sao_Paulo');
         $data = date('d/m/Y');// data agora
         $hora = date('H:i');// hora de agora
          
         $hora1 = DateTime::createFromFormat('d/m/Y H:i', $data_entrada." ".$hora_entrada);
         $hora2 = DateTime::createFromFormat('d/m/Y H:i', $data." ".$hora);
         $resposta = $hora1->diff($hora2)->format('%H:%I');
         $minutos_totais = (intval(substr($resposta,0,2))*60)+ intval(substr($resposta,3,2));
          
         

         if ( $minutos_totais>0 && $minutos_totais<60)
         {
          $menos_1hora_dentro++;
         }
         else if ( $minutos_totais>=60 && $minutos_totais<120)
         {
          $uma_hora_dentro++; 
         }
         else if($minutos_totais>=120 && $minutos_totais<180)
         {
          $duas_horas_dentro++;
         }
         else if($minutos_totais>=180 && $minutos_totais<240)
         {
          $tres_horas_dentro++;
         }
         else if($minutos_totais>=240 && $minutos_totais<300)
         {
          $quatro_horas_dentro++;
         }
         else if($minutos_totais>=300 && $minutos_totais<360)
         {
          $cinco_horas_dentro++; 
         }
         else
         {
          $mais_cinco_dentro++;
         }







      } // Fecha o else de dentro do site



     }//Fecha o if (strlen($item8)==16) se ja chegou na usina
     else
     {
      // Contabiliza que esta em trânsito
      $tempo_entrada_nok++;    
     } 

     } // Fecha se é TB 
     else // É nota fiscal
     {
        $tipo_documento_NF++;   
     } 
    } // fecha if $vezes>=2
    $vezes++;
   }// Fecha while
   ?>
   </tbody>
   </table>
   </div>
   <?php   

   fclose($handle);
   ?>
   <div id="relatorio">
   <?php
   if ($vezes>=2 && $n_corretos>0)
   {
    //RELATORIO
    echo"<h3>Relatorio dos Dados</h3>";
    echo "Encontrados = "; echo $vezes-2;
    echo"</br>";echo"</br>";
    echo " > Corretos = "; echo $n_corretos;
    echo"</br>";
    echo " > Inseridos no Banco = "; echo $n_inseridos_ok;
    echo"</br>";
    echo " > Duplicados = "; echo $n_inseridos_nok;
    echo"</br>";
    echo " > Numero de NF = "; echo $tipo_documento_NF;
    echo "</br>";echo "</br>";
    echo "<b>Média Permanência = </b>";echo number_format($somatorio_minutos_totais/$n_corretos,1);echo " MIN";
    echo"</br>";
    echo"</br>";
    echo"<b>Em trânsito MB/UOB = </b>";echo($tempo_entrada_nok);    
    echo"</br>";
    echo"<h3>Dentro do Site</h3>";
    $dentro_local = $dentro_local;
    echo "<b>Total Veiculos = "; echo $dentro_local;echo "</b> - "; echo number_format($dentro_local/$n_corretos*100, 2, '.', '') ; echo "%";echo"</br>";
    echo"</br>";
    echo " < 1 Hora = "; echo $menos_1hora_dentro;
    echo"</br>";
    echo " > 1 Hora = "; echo $uma_hora_dentro;
    echo"</br>";
    echo " > 2 Horas = "; echo $duas_horas_dentro;
    echo"</br>";
    echo " > 3 Horas = "; echo $tres_horas_dentro;
    echo"</br>";
    echo " > 4 Horas = "; echo $quatro_horas_dentro;
    echo"</br>";
    echo " > 5 Horas = "; echo $cinco_horas_dentro;
    echo"</br>";
    echo " > 6 horas ou mais = "; echo $mais_cinco_dentro;



   } // Fecha o ($vezes>=2 && $n_corretos>0) do relatorio
   

  } // fecha if $filename[1] == 'txt'
  else
  {
   ?>
   <div id="relatorio">
   <?php   
   echo"</br><b>Arquivo Incorreto!</b></br>";
  }
 } // fecha if $_FILES['file']['name']
} // fecha if isset($_POST["submit"])

?>
</div>
   
<label id="lbInfo">Para realizar filtros selecione o período e  em seguida clique em pesquisar!</label>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>








</body>

<script>
    
function preencher_tabela(){
    var lnome = window.document.getElementById("tbNome")



}




function atualiza_data()
{
    <?php
  date_default_timezone_set('America/Sao_Paulo');
  $data_atual = date('Y-m-d');// data agora
  ?>
  var data_atual = "<?php print $data_atual ?>";
  var data_inicio = window.document.getElementById('data_inicio');
  var data_fim = window.document.getElementById('data_fim');
  data_inicio.value = data_atual;  
  data_fim.value = data_atual;  

}

function atualiza_dados()
{
 var data_inicio = window.document.getElementById('data_inicio');
 var data_fim = window.document.getElementById('data_fim');
 
 var dia_inicio = String(data_inicio.value);
 var mes_inicio = String(data_inicio.value);
 var ano_inicio = String(data_inicio.value);
 
 dia_inicio = (dia_inicio.substr(8,2));
 mes_inicio = (mes_inicio.substr(5,2));
 ano_inicio = (ano_inicio.substr(0,4));
 data_inicio = dia_inicio + "/" + mes_inicio + "/" + ano_inicio;
  
 var dia_fim = String(data_fim.value);
 var mes_fim = String(data_fim.value);
 var ano_fim = String(data_fim.value);
 
 dia_fim = (dia_fim.substr(8,2));
 mes_fim = (mes_fim.substr(5,2));
 ano_fim = (ano_fim.substr(0,4));
 data_fim = dia_fim + "/" + mes_fim + "/" + ano_fim;
  
  //alert(data_inicio);
 //alert(data_fim);
 location.href=`tela_ttp_uob_filtros.php?complemento=${criptografia2.value}&check=${criptografia.value}&data_inicio=${data_inicio}&data_fim=${data_fim}`;


}



$(document).ready(function () 
{
 $("#btnExport").click(function () 
 {
  $("#tblExport").btechco_excelexport({
    containerid: "tblExport"
    , datatype: $datatype.Table
    , filename: 'sample'
    });
   });
 });
  

</script>

<style>


.th1{
    width: 85px;  
    text-align: center;
}
.th2{
    width: 100px;
    text-align: center;  
}
.th3{
    width: 120px;
    text-align: center;  
}

table {
    width: 342px;
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
    padding-top:0px;
    padding-bottom:5px;
    
}
tbody {
    height: 150px;
    display: inline-block;
    width: 100%;
    background-color:#F8F8FF;
    overflow: auto;
    
}


#lbInfo{
    margin-left: 0px;
    position: absolute;
    font: bold 12pt verdana;
    left: 65px;
    top: 210px;
    color: #000000;
}
#lbInicio{
    margin-left: 0px;
    position: absolute;
    color:#000000;
    font: normal 12pt verdana;
    left: 65px;
    top: 260px;
}
#data_inicio{
    margin-left: 0px;
    position: absolute;
    color:#000000;
    font: normal 12pt verdana;
    left: 170px;
    top: 255px;
    width: 160px;
}

#lbFim{
    margin-left: 0px;
    position: absolute;
    color:#000000;
    font: normal 12pt verdana;
    left: 370px;
    top: 255px;
}
#data_fim{
    margin-left: 0px;
    position: absolute;
    color:#000000;
    font: normal 12pt verdana;
    left: 465px;
    top: 255px;
    width: 160px;
}

#btn_pesquisar
{
 position: absolute;
 left: 660px;
 top: 245px; 
 width: 45px;
 height: 45px;

}



#lb_selecione{
    margin-left: 0px;
    position: absolute;
    color:#000000;
    font: normal 11pt verdana;
    left: 55px;
    top: 60px;
}
#relatorio{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 955px;
    top: 75px;
    color: #000000;
}

div#tabela2{
    margin-left: 0px;
    position: absolute;
    left: 960px;
    font: normal 12pt times;
    top: 450px;
    color: #000000;
}

#btn_escolher {
  position: absolute;
  left:55px;
  top: 90px;
  font: normal 11pt verdana;
  width: 650px;
  padding: 8px;
  color:#000000;
  -webkit-border-radius: 8px;
  -moz-border-radius: 15px;
  border: 2px dashed #BBB;
  text-align: center;
  background-color: #DDD;
  cursor: pointer;
}
INPUT#btn_importar
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:740px;
    top: 90px;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,0,139,.7);
    border-radius: 8px!important;
    border: 2px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_importar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_importar:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}






















INPUT#btn_ccl_vl
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 13%;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: rgba(0,0,139,.7);
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_ccl_vl:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ccl_vl:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_gestao_ccl_mb
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 29%;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: rgba(0,0,139,.7);
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_gestao_ccl_mb:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_gestao_ccl_mb:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_gestao_ccl_vl
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 29%;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: rgba(0,0,139,.7);
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_gestao_ccl_vl:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_gestao_ccl_vl:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
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
    font: normal 13pt verdana;
    left: 600px;
    top: 620px;
    color: #000000;
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
    font: normal 12pt times;color: #000000;
    padding-top: 600px;
    padding-left:50px;
}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;

background-size: 100%;
font: normal 12pt times;
color:#000000;
}
</style>



</html>
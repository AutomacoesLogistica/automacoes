<?php  

//error_reporting(0);
$valores_mes=["-","janeiro","fevereiro","marco","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro"];
$valores_bd_ttp_usina = ["-","conexao_ttp_usina_2020.php","conexao_ttp_mb_2021.php","conexao_ttp_mb_2022.php","conexao_ttp_mb_2023.php","conexao_ttp_mb_2024.php","conexao_ttp_mb_2025.php"];

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
   $dentro_unidade = 0;
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
   $conaxao = "";
   $letraA=0;
   $letraB=0;
   $letraC=0;
   $letraD=0;
   $hora_usina_mb1="";
   $hora_usina_mb2="";


   while($data = fgetcsv($handle,1000,"\t"))
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
     

     

      if ($item3=="TB")
      {     
      if (strlen($item1)==7) // Verifica se a placa esta ok ********************************************************************************
      {
       $placa_ok++;  
       $status_placa = "sim";         
       $placa = "";
       $placa = substr($item1,0,3) . "-" . substr($item1,3,4);
       echo "$placa"; // Tamanho 7
       echo"  -  ";
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
       echo "$item2";// Tamanho >=8
       echo"  -  ";
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
       else if ($item3=="NF")
       {
        $tipo_documento_NF++;  
       }  
       echo "$item3"; // != ""
       echo"  -  ";
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
       echo "$item4";// != ""
       echo"  -  ";
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
       echo "$item5";// != ""
       echo"  -  ";
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
       echo "$item6";// != ""
       echo"  -  ";
      }
      else
      {
       $se_pesa_nok++;
       $status_se_pesa = "nao";
      } 
       
      if (strlen($item8)==16) // Tamanho 16 tempo de entrada na usina ***********************************************************************
      {
      echo "$item8";
      echo"  -  ";
      $tempo_entrada_ok++;
          
      }
      else
      {
       $tempo_entrada_nok++;  
       $dentro_unidade++;
       echo "ainda nao pesou, esta dentro da unidade ainda";
      }
        
      if (strlen($item9)==16)
      {
      echo "$item9";// Tamanho 16 tempo de que pesou o bruto na usina
      echo"  -  ";
      }
      else{
         echo "erro";
      }  
       
      if (strlen($item10)==16)
      {
       $pesou_tara++;  
       echo "$item10";// Tamanho 16 tempo de que tirou a tara na usina
       echo"-";
      }
      else
      {
       $n_pesou_tara++;
       echo "erro";
      } 
      
      
      if (strlen($item12)==5)
      {
      echo "$item12";// Tamanho 5 tempo de que ficou la dentro - diferenca entra tara e bruto
      echo"  -  ";
      }
      else{
         echo "erro";
      }
      

      if (strlen($item3)==16) // Tamanho 16 tempo de saida da usina ***********************************************************************
      {
       $saiu++; // saiu da usina    
      }


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

      include_once "conexao.php";
      // BUSCA EM FUNCAO DA DATA O TURNO REFERENTE
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
      
       // TRATA OS DADOS PARA SALVAR NO BANCO
       echo $letra_turno;
       echo"</br>";
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
       
       echo"</br>"; 
      }





      } // Fecha se é TB  
     } // fecha if $vezes>=2
     $vezes++;
    }// Fecha while



    //RELATORIO
    echo "Numero de Inseridos no banco = ";echo $n_inseridos_ok;echo "</br>";
    echo "Numero de TB = ";echo $tipo_documento_TB;echo "</br>";
    echo "Numero de NF = ";echo $tipo_documento_NF;echo "</br>";
    
   fclose($handle);
   } // fecha if $filename[1] == 'txt'
 } // fecha if $_FILES['file']['name']
} // fecha if isset($_POST["submit"])
?>  
<!DOCTYPE html>  
<html>  
 <head>  
  <title>Webslesson Tutorial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>  
 <body>  
  <h3 align="center">How to Import Data from CSV File to Mysql using PHP</h3><br />
  <form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
 </body>  
</html>
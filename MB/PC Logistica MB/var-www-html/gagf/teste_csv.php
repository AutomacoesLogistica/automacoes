<?php  
include_once "conexao.php";
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   $vezes = 0;
   $n_corretos = 0;
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
   $negativo_ok = 0;
   $negativo_nok = 0;
   $finalizado_ok = 0;
   $finalizado_nok = 0;
   $n_inseridos_ok = 0;
   $n_inseridos_nok = 0;
   
   
   while($data = fgetcsv($handle,1000,";"))
   {
    $item1 = mysqli_real_escape_string($dbcon, isset($data[0])?$data[0]:"0"); // ID Processo
     if($item1==""){$item1= "vazio";}
     $item2 = mysqli_real_escape_string($dbcon, isset($data[1])?$data[1]:"0"); // Centro
     if($item2==""){$item2= "vazio";}
     $item3 = mysqli_real_escape_string($dbcon, isset($data[2])?$data[2]:"0"); // Nome
     if($item3==""){$item3= "vazio";}
     $item4 = mysqli_real_escape_string($dbcon, isset($data[3])?$data[3]:"0"); // Placa Veiculo
     if($item4==""){$item4= "vazio";}
     $item5 = mysqli_real_escape_string($dbcon, isset($data[4])?$data[4]:"0"); // Tipo Veiculo
     if($item5==""){$item5= "vazio";}
     $item6 = mysqli_real_escape_string($dbcon, isset($data[5])?$data[5]:"0"); // Placa Carreta
     if($item6==""){$item6= "vazio";}
     $item7 = mysqli_real_escape_string($dbcon, isset($data[6])?$data[6]:"0"); // Tipo Carreta
     if($item7==""){$item7= "vazio";}
     $item8 = mysqli_real_escape_string($dbcon, isset($data[7])?$data[7]:"0"); // CPF Motorista
     if($item8==""){$item8= "vazio";}
     $item9 = mysqli_real_escape_string($dbcon, isset($data[8])?$data[8]:"0"); // Motorista
     if($item9==""){$item9= "vazio";}
     $item10 = mysqli_real_escape_string($dbcon, isset($data[9])?$data[9]:"0"); // Transportadora - CNPJ
     if($item10==""){$item10= "vazio";}
     $item11 = mysqli_real_escape_string($dbcon, isset($data[10])?$data[10]:"0"); // Transportadora
     if($item11==""){$item11= "vazio";}
     $item12 = mysqli_real_escape_string($dbcon, isset($data[11])?$data[11]:"0"); // Cod. Tipo Operacao
     if($item12==""){$item12= "vazio";}
     $item13 = mysqli_real_escape_string($dbcon, isset($data[12])?$data[12]:"0"); // Tipo Operacao
     if($item13==""){$item13= "vazio";}
     $item14 = mysqli_real_escape_string($dbcon, isset($data[13])?$data[13]:"0"); // Tipo Documento
     if($item14==""){$item14= "vazio";}
     $item15 = mysqli_real_escape_string($dbcon, isset($data[14])?$data[14]:"0"); // Nro. Documento
     if($item15==""){$item15= "vazio";}
     $item16 = mysqli_real_escape_string($dbcon, isset($data[15])?$data[15]:"0"); // Codigo Destinatario
     if($item16==""){$item16= "vazio";}
     $item17 = mysqli_real_escape_string($dbcon, isset($data[16])?$data[16]:"0"); // Destinatario
     if($item17==""){$item17= "vazio";}
     $item18 = mysqli_real_escape_string($dbcon, isset($data[17])?$data[17]:"0"); // Vigencia Inicial
     if($item18==""){$item18= "vazio";}
     $item19 = mysqli_real_escape_string($dbcon, isset($data[18])?$data[18]:"0"); // Vigencia Final
     if($item19==""){$item19= "vazio";}
     $item20 = mysqli_real_escape_string($dbcon, isset($data[19])?$data[19]:"0"); // Cod. Status Processo
     if($item20==""){$item20= "vazio";}
     $item21 = mysqli_real_escape_string($dbcon, isset($data[20])?$data[20]:"0"); // Status Processo
     if($item21==""){$item21= "vazio";}
     $item22 = mysqli_real_escape_string($dbcon, isset($data[21])?$data[21]:"0"); // Tipo Origem
     if($item22==""){$item22= "vazio";}
     $item23 = mysqli_real_escape_string($dbcon, isset($data[22])?$data[22]:"0"); // Data Registro
     if($item23==""){$item23= "vazio";}
     $item24 = mysqli_real_escape_string($dbcon, isset($data[23])?$data[23]:"0"); // Nro. Pesagem Tara
     if($item24==""){$item24= "vazio";}
     $item25 = mysqli_real_escape_string($dbcon, isset($data[24])?$data[24]:"0"); // Peso Tara
     if($item25==""){$item25= "vazio";}
     $item26 = mysqli_real_escape_string($dbcon, isset($data[25])?$data[25]:"0"); // Primeira Pesagem
     if($item26==""){$item26= "vazio";}
     $item27 = mysqli_real_escape_string($dbcon, isset($data[26])?$data[26]:"0"); // Nro. Pesagem Bruto
     if($item27==""){$item27= "vazio";}
     $item28 = mysqli_real_escape_string($dbcon, isset($data[27])?$data[27]:"0"); // Peso Bruto
     if($item28==""){$item28= "vazio";}
     $item29 = mysqli_real_escape_string($dbcon, isset($data[28])?$data[28]:"0"); // Segunda Pesagem
     if($item29==""){$item29= "vazio";}
     $item30 = mysqli_real_escape_string($dbcon, isset($data[29])?$data[29]:"0"); // Nro.Cartao
     if($item30==""){$item30= "vazio";}
     $item31 = mysqli_real_escape_string($dbcon, isset($data[30])?$data[30]:"0"); //Regime Especial
     if($item31==""){$item31= "vazio";}
     $item32 = mysqli_real_escape_string($dbcon, isset($data[31])?$data[31]:"0"); // Nro. Processo Especial
     if($item32==""){$item32= "vazio";}
     $item33 = mysqli_real_escape_string($dbcon, isset($data[32])?$data[32]:"0"); // Cod. Tipo Processo
     if($item33==""){$item33= "vazio";}
     $item34 = mysqli_real_escape_string($dbcon, isset($data[33])?$data[33]:"0"); // Data Processo
     if($item34==""){$item34= "vazio";}
     $item35 = mysqli_real_escape_string($dbcon, isset($data[34])?$data[34]:"0"); // Grupo Operacao
     if($item35==""){$item35= "vazio";}
     $item36 = mysqli_real_escape_string($dbcon, isset($data[35])?$data[35]:"0"); // Fluxo Operacao
     if($item36==""){$item36= "vazio";}
     $item37 = mysqli_real_escape_string($dbcon, isset($data[36])?$data[36]:"0"); // Cd. Tipo Documento
     if($item37==""){$item37= "vazio";}
     $item38 = mysqli_real_escape_string($dbcon, isset($data[37])?$data[37]:"0"); // Base
     if($item38==""){$item38= "vazio";}
     $item39 = mysqli_real_escape_string($dbcon, isset($data[38])?$data[38]:"0"); // Codigo Processo Tipo Transacao Bloqueio Alteracao
     if($item39==""){$item39= "vazio";}
     $item40 = mysqli_real_escape_string($dbcon, isset($data[39])?$data[39]:"0"); // Cod. Tipo Veiculo
     if($item40==""){$item40= "vazio";}
     $item41 = mysqli_real_escape_string($dbcon, isset($data[40])?$data[40]:"0"); // Observacao
     if($item41==""){$item41= "vazio";}
     $item42 = mysqli_real_escape_string($dbcon, isset($data[41])?$data[41]:"0"); // Processo TMC



       
        echo "$item1";
        echo"-";
        echo "$item2";
        echo"-";
        echo "$item3";
        echo"-";
        echo "$item4";
        echo"-";
        echo "$item5";
        echo"-";
        echo "$item6";
        echo"-";
        echo "$item7";
        echo"-";
        echo "$item8";
        echo"-";
        echo "$item9";
        echo"-";
        echo "$item10";
        echo"-";
        echo "$item11";
        echo"-";
        echo "$item12";
        echo"-";
        echo "$item13";
        echo"-";
        echo "$item14";
        echo"-";
        echo "$item15";
        echo"-";
        echo "$item16";
        echo"-";
        echo "$item17";
        echo"-";
        echo "$item18";
        echo"-";
        echo "$item19";
        echo"-";
        echo "$item20";
        echo"-";
        echo "$item21";
        echo"-";
        echo "$item22";
        echo"-";
        echo "$item23";
        echo"-";
        echo "$item24";
        echo"-";
        echo "$item25";
        echo"-";
        echo "$item26";
        echo"-";
        echo "$item27";
        echo"-";
        echo "$item28";
        echo"-";
        echo "$item29";
        echo"-";
        echo "$item30";
        echo"-";
        echo "$item31";
        echo"-";
        echo "$item32";
        echo"-";
        echo "$item33";
        echo"-";
        echo "$item34";
        echo"-";
        echo "$item35";
        echo"-";
        echo "$item36";
        echo"-";
        echo "$item37";
        echo"-";
        echo "$item38";
        echo"-";
        echo "$item39";
        echo"-";
        echo "$item40";
        echo"-";
        echo "$item41";
        echo"-";
        echo "$item42";
        echo"</br>";
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}
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
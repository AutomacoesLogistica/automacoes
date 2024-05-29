<!DOCTYPE html>  
<html>  
 <head>  
  <title>Importandos Arquivo PBT GSCS</title>
 </head>  
 <body>  
  <h3 align="center">Selecione arquivo .CSV que contenha os dados do PBT GSCS</h3><br />
  <form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Selecione arquivo .CSV:</label>
    <input type="file" name="file" />
    <br/>
    <input type="submit" name="submit2" value="Importar" class="btn btn-info" />
   </div>
  </form>
 

<div id="relatorio">
<?php  
include_once "conexao.php";

if(isset($_POST["submit2"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   //echo"<script>alert(sizeof('$handle')) </script>";
   
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
    if ($vezes >=2) // Para desconsiderar o campo data na primeira linha e o cabeçalho da segunda OBS Começa a contar com 0
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
    
     // TRATANDO OS DADOS
     // VERIFICA TUDO PRIMEIRO SE ESTA OK DEPOIS TRATA
     if($item21 == "PROCESSO FINALIZADO") //  Se o processao esta finalizado
     {
      $finalizado_ok++;   
      if (intval($item15)>1) // Se Nro. Documento está positivo
      {
       $negativo_ok++;   
       if($item5 == "BI-TRUCK-4EIXOS-29T" || $item5 == "CARRETA-5EIXOS-41,5T" || $item5 == "CARRETA TRUCADA-6EIXOS-16M-45T") // Se for os tipos
       {
        $veiculo_ok++;
        if($item2 == "8000") //  Se e 8000
        {
         $centro_ok++;
         // PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  
         // PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  
         // PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  
         
         //TRATANDO A DATA ******************************************************************************************************************
          // Trata tudo e caso algum erro nao deixa salvar para não colocar sujeira no banco de dados 
         $data = "";
         $mes = "";
         $ano = "";
         $hora= "";
         if(strlen($item23)==16) // Trata se a data esta certa
         {
          $data_ok++;  
          $data = substr($item23,0,10);
          $mes = substr($item23,3,2);
          $ano = substr($item23,6,4); 
          $hora = substr($item23,11,8);
         }
         else
         {
          $data_nok++;
          break; // Deixar
         }
         
         //TRATANDO ID PROCESSO GSCS *********************************************************************************************************
         if (strlen($item1)>=7)
         {
          $processo_ok++;
          $id_processo_gscs = "";
          $id_processo_gscs = $item1;
         }
         else
         {
          $processo_nok++;
          break; // Deixar
         }
         
         // TRATANDO AS PLACAS ****************************************************************************************************************
         // Retira placa e estado
         if (strlen($item4)==10)
         {
          $placa_ok++;           
          $placa = "";
          $estado = "";
          $placa = substr($item4,3,3) . "-" . substr($item4,6,4);
          $estado = substr($item4,0,2);
         }
         else
         {
          $placa_nok++;
          break; // Deixar
         }

         
         // TRATA TIPO DE VEICULO *************************************************************************************************************
         $tipo_veiculo = "";
         $tipo_veiculo = $item5;
              
         // TRATANDO O PESO BRUTO e TARA *******************************************************************************************************
         if (strlen($item25)==5 && strlen($item28)==5)
         {
          $capacidade = "";   
          if ($item5 == "BI-TRUCK-4EIXOS-29T")
          {
           $capacidade = 29000; 
          }
          elseif($item5 == "CARRETA-5EIXOS-41,5T")
          {
           $capacidade = 41500;
          }
          elseif($item5 == "CARRETA TRUCADA-6EIXOS-16M-45T")  
          {
           $capacidade = 45000;
          }
           
        $tara = "";
        $carregado = "";
        $assertividade = "";
        $tara = $item25;
        $carregado = $item28;
        $assertividade = strval(($carregado*100)/$capacidade);  
       }
       else
       {
        $ok = "nao"; 
        break; // Deixar
       }
       $transportadora = $item11;
       $assertividade = number_format($assertividade, 2, '.', '');
       /*      
        $n_corretos++;  
        echo "$data";
        echo" - ";
        echo"$mes";
        echo" - ";
        echo"$ano";
        echo" - ";
        echo"$hora";
        echo" - ";
        echo"$id_processo_gscs";
        echo" - ";
        echo"$placa";echo"/";echo"$estado";
        echo" - ";
        echo"$tipo_veiculo";
        echo" - ";
        echo"$tara";
        echo" - ";
        echo"$carregado"; 
        echo" - ";
        echo"$assertividade"; echo"%";         
        echo" - ";
        echo"$transportadora"; 
        
        echo"</br>";
        */
        
        $n_corretos++;

        $sql = $dbcon->query("SELECT * FROM pbt_mb WHERE id_processo_gscs='$id_processo_gscs'"); // Busca se ja existe o n do processo gscs no banco
        if(mysqli_num_rows($sql)>0)
        {
            // Se entrar aqui e porque ja exsite este processo salvo no banco e nao deixa duplicas
            $n_inseridos_nok++;
        }
        else // PODE SALVAR POIS NÃO EXISTE ESTE PROCESSO NO BANCO
        {
         $n_inseridos_ok++;   
         $sql = $dbcon->query("INSERT INTO pbt_mb (data,mes,ano,id_processo_gscs,placa,estado,tipo_veiculo,tara,peso_bruto,assertividade,transportadora) VALUES ('$data','$mes','$ano','$id_processo_gscs','$placa','$estado','$tipo_veiculo','$tara','$carregado','$assertividade','$transportadora')");
        }
        
        

       
        







        } // Fecha se centro 800
        else
        {
         $centro_nok++;
         //break;
        } 
       } // Fecha if Se for os tipos
       else
       {
        $veiculo_nok++;
        //break;
       } // fecha else Se for os tipos
      } // Fecha Se Nro. Documento está positivo
      else
      {
       $negativo_nok++;
       //break;
      } 
     }// Fecha Se o processao esta finalizado
     else
     {
      $finalizado_nok++;
      //break;  
     } 
    } // Fecha if  Para desconsiderar o campo data na primeira linha e o cabeçalho da segunda OBS Começa a contar com 0 
    $vezes++;         
   } // fecha while   
  } // fecha if csv
  fclose($handle);
 
 if ($vezes>=2 && $n_corretos>0)
 { 
  echo"Relatorio";
  echo"</br>";
  echo "Encontrados = "; echo $vezes-2;
  echo"</br>";
  echo "Corretos = "; echo $n_corretos;
  echo"</br>";
  echo "Inseridos no Banco = "; echo $n_inseridos_ok;
  echo"</br>";
  echo "Duplicados = "; echo $n_inseridos_nok;
  echo"</br>";
  echo "Errados = "; echo ($vezes-2)-$n_corretos;
  echo"</br>";
  echo " > Placas Erradas = "; echo $placa_nok;
  echo"</br>";
  echo " > Processos Errados = "; echo $processo_nok;
  echo"</br>";
  echo " > Datas Erradas = "; echo $data_nok;
  echo"</br>";
  echo " > Veiculos Errados = "; echo $veiculo_nok;
  echo"</br>";
  echo " > Processos Nao Finalizados = "; echo $finalizado_nok;
  echo"</br>";
  echo " > Negativos = "; echo $negativo_nok;
  echo"</br>";
  echo " > Centros Errados = "; echo $centro_nok;
 }
 else
 {
  echo"Arquivo Incorreto!";
 }
 } // fecha if $FILES ...
}// // fecha $isse_post
?>   



</div>







</body>  
</html>
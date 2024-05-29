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
<label id="lb_selecione" >Selecione arquivo .CSV que contenha os dados do TTP Miguel Burnier vindo do GSCS</label>
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
error_reporting(0);
$valores_mes=["-","janeiro","fevereiro","marco","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro"];
$valores_bd_ttp_mb = ["-","conexao_ttp_mb_2020.php","conexao_ttp_mb_2021.php","conexao_ttp_mb_2022.php","conexao_ttp_mb_2023.php","conexao_ttp_mb_2024.php","conexao_ttp_mb_2025.php"];


$valor_mes_inteiro = "";
$valor_ano_inteiro = "";

if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv' || $filename[1] == 'CSV')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   //echo"<script>alert(sizeof('$handle')) </script>";
   include_once "conexao.php";
   $resultado = 0;
   $letra_turno = "";
   
   
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
   ?>

   <div id="tabela2">
   
     <table border= 1px; id="tblExport">
      <thead >
       <tr>
    	<th class="th1">Data</th>
    	<th class="th2">Nº GSCS</th>
    	<th class="th3">Placa</th>
       </tr>
      </thead>
      <tbody>
   <?php   
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
      if ($item14 == "Nomination") // Se Nro. Documento está positivo  ALTERAR PARA SE É NOMINATION
      {
       $nomination_ok++;   
        if($item2 == "8000 ") //  Se e 8000
        {
         $centro_ok++;
         if(intval($item15) != 3330010 && intval($item15) != 999990010 && (intval($item15)>0)) // Se é positivo, nao é 3330010 999990010
         {
            $n_corretos++;
         // PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  
         // PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  
         // PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  PODE TRATAR OS DADOS  
         
         //TRATANDO A DATA ENTRADA ******************************************************************************************************************
         // Trata tudo e caso algum erro nao deixa salvar para não colocar sujeira no banco de dados 
         


         if(strlen($item23)==19 && strlen($item29)==19) // Trata se a data registro e segunda pesagem esta certa
         {
          $mes = substr($item23,3,2);
          $ano = substr($item23,6,4); 
          $data_ok++;
            
          $data_entrada = substr($item23,0,10);
          $data_segunda_pesagem = substr($item29,0,10);
          $dia_entrada = substr($item23,0,2);
          $dia_segunda_pesagem = substr($item29,0,2);
          $hora_entrada = substr($item23,11,8);
       
          $hora_segunda_pesagem = substr($item29,11,8);
          
          $hora1 = DateTime::createFromFormat('d/m/Y H:i:s', $data_entrada." ".$hora_entrada);
          $hora2 = DateTime::createFromFormat('d/m/Y H:i:s', $data_segunda_pesagem." ".$hora_segunda_pesagem);
          $resposta = $hora1->diff($hora2)->format('%H:%I:%S');
          $tempo_permanencia = $resposta;
          $minutos_totais = (intval(substr($resposta,0,2))*60)+ intval(substr($resposta,3,2));
          $somatorio_minutos_totais= intval($somatorio_minutos_totais)+intval($minutos_totais);

         }
         else
         {
          $data_nok++;
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
         }
         $tipo_veiculo = "";
         $tipo_veiculo = $item5;
         $transportadora = $item11; // Busca a transportadora
         $valor_mes_inteiro = intval($mes); // Busca o mes da data do processo e converte para posicao do array
         $valor_ano_inteiro = intval($ano)-2019; // Busca o mes da data do processo e converte para posicao do array
        
         
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
         
         if($letra_turno=="")
         {
          $letra_turno = "X"; // Existe erro e nao deixa o banco em branco, evitar travar!
         }
         $conexao = $valores_bd_ttp_mb[$valor_ano_inteiro];
         $tabela = $valores_mes[$valor_mes_inteiro];
         include_once $conexao;
         $sql_ttp = $aux_conexao_ttp->query("SELECT * FROM $tabela WHERE id_processo_gscs='$id_processo_gscs'"); // Busca se ja existe o n do processo gscs no banco
         if(mysqli_num_rows($sql_ttp)>0)
         {
          // Se entrar aqui e porque ja exsite este processo salvo no banco e nao deixa duplicas
          $n_inseridos_nok++;
         }
         else // PODE SALVAR POIS NÃO EXISTE ESTE PROCESSO NO BANCO
         {
          $n_inseridos_ok++;   
          $sql_ttp = $aux_conexao_ttp->query("INSERT INTO $tabela (mes,ano,id_processo_gscs,placa,estado,tipo_veiculo,transportadora,data_entrada,hora_entrada,dia_entrada,data_pesagem,hora_pesagem,dia_pesagem,tempo_permanecia,minutos_permanencia,letra) VALUES ('$mes','$ano','$id_processo_gscs','$placa','$estado','$tipo_veiculo','$transportadora','$data_entrada','$hora_entrada','$dia_entrada','$data_segunda_pesagem','$hora_segunda_pesagem','$dia_segunda_pesagem','$tempo_permanencia','$minutos_totais','$letra_turno')");
         }
        }//Fecha se documento + e se nao -e 3330010 999990010
        
        } // Fecha se centro 8000
        else
        {
         $centro_nok++;
        } 
      
      } // Fecha Se Nro. Documento está positivo
      else
      {
       $nomination_nok++;
      }// Fecha Else Nro. Documento está positivo 
     }// Fecha Se o processao esta finalizado
     else
     {
      $finalizado_nok++;
      //TRATA SE ESTA DENTRO DO SITE
      if($item21 != "PROCESSO CANCELADO")
      {
       if (intval(trim($item15))>1) // Se Nro. Documento está positivo
       {
        if($item2 == "8000 ") //  Se e 8000
        {
         $dentro_local++;

         // Trata tempos para quebrar os valores
         $mes = substr($item23,3,2);
         $ano = substr($item23,6,4); 
         
         $numero_processo_gscs = $item1; // Numero do processo para exibir numeros dentro             
         $data_entrada = substr($item23,0,10); ;// Hora para exibir tabela dos dentro e outros
         $placa = substr($item4,3,3) . "-" . substr($item4,6,4);
         $estado = substr($item4,0,2);
         $placa_completa = $placa ."/".$estado; // Placa para exibir tabela dos dentro 
         
         ?>
         <tr>
         <td class="th1"><?php print $numero_processo_gscs; ?></td>
         <td class="th2"><?php print $data_entrada;?></td>
         <td class="th3"><?php print $placa_completa;?></td>
         </tr>
         <?php
         
         $hora_entrada = substr($item23,11,8);
       
         date_default_timezone_set('America/Sao_Paulo');
         $data = date('d/m/Y');// data agora
         $hora = date('H:i:s');// hora de agora
          
         $hora1 = DateTime::createFromFormat('d/m/Y H:i:s', $data_entrada." ".$hora_entrada);
         $hora2 = DateTime::createFromFormat('d/m/Y H:i:s', $data." ".$hora);
         $resposta = $hora1->diff($hora2)->format('%H:%I:%S');
         $minutos_totais = (intval(substr($resposta,0,2))*60)+ intval(substr($resposta,3,2));
          
         $somatorio_minutos_totais= $somatorio_minutos_totais+$minutos_totais;

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
        }// Fecha se 8000 para os dentro da usina
       }// Fecha se documento é posivito para os dentro da usina
      }// Fecha se não é cancelado nem finalizado, ou seja, o que sobre esta dentro do site
      else
      {
       if($item2 == "8000 ") //  Se e 8000
       {
        $cancelados++;
       }// Fecha se 8000 para os cancelados
      }// Fecha else para os cancelados
     } 
    } // Fecha if  Para desconsiderar o campo data na primeira linha e o cabeçalho da segunda OBS Começa a contar com 0 
    $vezes++;         
   } // fecha while
   ?>
     </tbody>
    </table>
   </div>
   <?php   
  } // fecha if csv
  fclose($handle);
  
  ?>
  
 <div id="relatorio">
  <?php
  
 if ($vezes>=2 && $n_corretos>0)
 {
    echo"<h3>Relatorio dos Dados</h3>";
  
  echo "Encontrados = "; echo $vezes-2;
  echo"</br>";echo"</br>";
  echo " > Corretos = "; echo $n_corretos;
  echo"</br>";
  echo " > Inseridos no Banco = "; echo $n_inseridos_ok;
  echo"</br>";
  echo " > Duplicados = "; echo $n_inseridos_nok;
  echo"</br>";
  echo " > Não utilizados para ttp = "; echo ($vezes-2)-$n_corretos;
  echo"</br>";
  
  if(intval($cancelados) == 0)
  {
   echo " > Processos Cancelados = "; echo $cancelados;
  }
  else
  {
   echo "<font color='#FF0000'> > Processos Cancelados = "; echo $cancelados."</font>";
  }
  echo "</br>";echo "</br>";
  echo "<b>Média Permanência = </b>";echo number_format($somatorio_minutos_totais/$n_corretos,1);echo " MIN";
  
  echo"</br>";
  echo"<h3>Dentro do Site</h3>";
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
  
  
  //echo"<h3>Desvios Encontrados</h3>";
  //echo "Erros/Não utilizados para ttp = "; echo ($vezes-2)-$n_corretos;
  //echo"</br>";echo"</br>";
  //echo " > Placas Erradas = "; echo $placa_nok;
  //echo"</br>";
  //echo " > Processos Errados = "; echo $processo_nok;
  //echo"</br>";
  //echo " > Datas Erradas = "; echo $data_nok;
  //echo"</br>";
  //echo " > Veiculos Errados = "; echo $veiculo_nok;
  //echo"</br>";
  //echo " > Processos Nao Finalizados = "; echo $finalizado_nok;
  //echo"</br>";
  //echo " > Negativos(Conferência Bruto) = "; echo $nomination_nok;
  //echo"</br>";
  //echo " > > Inseridos = "; echo $n_erros_inseridos_ok;
  //echo"</br>";
  //echo " > > Duplicados = "; echo $n_erros_inseridos_nok;
  //echo"</br>";
  //echo " > Centros Errados = "; echo $centro_nok;   
 }
 else
 {
  echo"</br><b>Arquivo Incorreto!</b></br>";
  //EXIBIR ALERTA QUE ESTA INSERINDO ALGUM ARQUIVO QUE CONTENHA PONTO E NAO PODE APENAS O PONTO DO CSV
  if($filename[1] == 'csv' ||$filename[2] == 'csv' ||$filename[3] == 'csv' ||$filename[4] == 'csv' ||$filename[5] == 'csv' ||$filename[6] == 'csv')
  {
   echo"</br>";echo"</br>";
   echo"<b>Atenção!</b></br>";
   echo"Você inseriu um arquivo que contem ponto no nome!</br>";
   echo"O único ponto que pode existir no nome do arquivo é o .csv que é o da extensão do arquivo!";
   echo"</br></br>";
   echo"<b>Exemplo:</b></br>";
   echo"Seu arquivo não pode chamar ' ttp_10.02.2020.csv '";
   echo"</br>Este arvquivo para ser reconhecido deve chamar por exemplo ' ttp_10022020.csv '";
  }
 }
 } // fecha if $FILES ...
}// // fecha $isse_post
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
 location.href=`tela_ttp_mb_filtros.php?complemento=${criptografia2.value}&check=${criptografia.value}&data_inicio=${data_inicio}&data_fim=${data_fim}`;


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
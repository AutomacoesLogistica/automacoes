<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>



<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ttp_mb2.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>

    




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

         // TRATA TIPO DE VEICULO *************************************************************************************************************
         $tipo_veiculo = "";
         $tipo_veiculo = $item5;
              
         // TRATANDO O PESO BRUTO e TARA *******************************************************************************************************
         if (strlen($item25)==9 && strlen($item28)==9)
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
          $tara = intval(substr($item25,0,5));
          $carregado = intval(substr($item28,0,5));
          $assertividade = strval(($carregado*100)/$capacidade);  
         }
         else
         {
          $ok = "nao"; 
         }
         $transportadora = $item11;
         $assertividade = number_format($assertividade, 2, '.', '');
         
         
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
        else
        {

        }

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
        if($item5 == "BI-TRUCK-4EIXOS-29T" || $item5 == "CARRETA-5EIXOS-41,5T" || $item5 == "CARRETA TRUCADA-6EIXOS-16M-45T") // Se for os tipos
        {
         if($item2 == "8000 ") //  Se e 8000
         {
          $dentro_local++;

          // Trata tempos para quebrar os valores
          $mes = substr($item23,3,2);
          $ano = substr($item23,6,4); 
                      
          $data_entrada = substr($item23,0,10);
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
          else if ( $minutos_totais>60 && $minutos_totais<120)
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
        }// Fecha os tipos veiculos para dentro da usina
        else
        {
         $outros++; // Contra como outros veiculos   
        }
       }// Fecha se documento é posivito para os dentro da usina
      }// Fecha se não é cancelado nem finalizado, ou seja, o que sobre esta dentro do site
      else
      {
       if($item5 == "BI-TRUCK-4EIXOS-29T" || $item5 == "CARRETA-5EIXOS-41,5T" || $item5 == "CARRETA TRUCADA-6EIXOS-16M-45T") // Se for os tipos
       {
        if($item2 == "8000 ") //  Se e 8000
        {
         $cancelados++;
        }// Fecha se 8000 para os cancelados
       }// Fecha os tipos veiculos para cancelados
       else
       {
        $outros++; // Conta como outros veiculos   
       }
      }// Fecha else para os cancelados





      //break;  
     } 
    } // Fecha if  Para desconsiderar o campo data na primeira linha e o cabeçalho da segunda OBS Começa a contar com 0 
    $vezes++;         
   } // fecha while   
   
   $num = "";
  
   if($n_inseridos_ok>0 || $n_inseridos_nok >0)  //Se foram salvo dados, monta a tabela
   {
     // PLOTA A TABELA 
     $ultimo_id = 136; // salva o ultimo id da tabela
    
    if($n_inseridos_ok>0)
    {   
    $inicio = intval($ultimo_id)-intval($n_inseridos_ok);
    $num = $n_inseridos_ok;
    }
    else
    {
     $inicio = intval($ultimo_id)-intval($n_inseridos_nok);
     $num = $n_inseridos_nok;
    }
    
    //include_once "conexao.php";
    $ultimo_id = 0;
    $valor_mes_inteiro = intval($mes); // Busca o mes da data do processo e converte para posicao do array
    $valor_ano_inteiro = intval($ano)-2019; // Busca o mes da data do processo e converte para posicao do array
    $conexao_ttp = $valores_bd_ttp_mb[$valor_ano_inteiro];
    $tabela_ttp = $valores_mes[$valor_mes_inteiro];


    include_once $conexao_ttp;
    $sql_ttp = $aux_conexao_ttp->query("SELECT * FROM $tabela_ttp ORDER BY id DESC");
    if(mysqli_num_rows($sql_ttp)>0)
    {
     $dados = $sql_ttp->fetch_array();
     $ultimo_id= ($dados['id']); // busco a ultimo id
    }

    $sql_ttp = $aux_conexao_ttp->query("SELECT * FROM $tabela_ttp WHERE id>($ultimo_id-$num) AND id<=$ultimo_id ");
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
     while($dados = $sql_ttp->fetch_array())
     {
      $barra = "/";   
      $placa_completa =  strval($dados['placa']) . $barra . strval($dados['estado']);
      
      

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
    } // fecha se sql>0
     ?>
     </tbody>
    </table>
    </div>
    <?php













   } // fecha if $n_inseridos_ok>0

   

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
  echo"</br>";echo"</br>";
  echo "<b>Total Acima 1 Hora = "; echo $total;echo "</b> - "; echo number_format($total/$n_corretos*100, 2, '.', '') ; echo "%";
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





<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>








</body>

<script>
    
function preencher_tabela(){
    var lnome = window.document.getElementById("tbNome")



}





</script>

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
    height: 400px;
    display: inline-block;
    width: 100%;
    background-color:#F8F8FF;
    overflow: auto;
    
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
    left: 55px;
    top: 135px;
    color: #000000;
}

div#tabela{
    margin-left: 0px;
    position: absolute;
    left: 290px;
    font: normal 12pt times;
    top: 150px;
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
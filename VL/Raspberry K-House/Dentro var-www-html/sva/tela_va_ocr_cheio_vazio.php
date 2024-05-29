<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>VA DIPS VL</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="./video/video-js.css" rel="stylesheet">


<script src="./video/video.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="lb_complemento" hidden="hidden"></label>
<label id="lb_check" hidden="hidden"></label>
<label id="lb_registro" hidden="hidden"></label>
<label id="lb_cheio_vazio" hidden="hidden"></label>
<label id="lb_cameras" hidden="hidden"></label>
<label id="lb_cameras_outros_veiculos" hidden="hidden"></label>
<label id="lb_parecer" hidden="hidden"></label>
<label id="lb_parecer_outros_veiculos" hidden="hidden"></label>
<input type="text" id="data2" value="vazio" hidden="hidden" />
<input type="text" id="ref1" name="ref1" value="vazio" hidden="hidden"/>
<label id="funcao"></label>
<img id="voltar" src="./images/logoff.png" onclick="javascript: location.href=`ocr.php` "/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
<input type="text" id="lb_visualizar" value="vazio" hidden="hidden" />
</div>
<?php
error_reporting(0);
// Busca o usuario passado e verifica no sistema
$ip = $_SERVER['REMOTE_ADDR'];
$usuario = "";
$tipo = "";
$criptografia = "";
$usuario_criptografado = "";
include_once 'conexao2.php';
$complemento = $_GET['complemento'];
$check = $_GET['check'];
$criptografia = ((floatval($complemento))/1.5)-2021;
$nome = "";
$tipo = "VA GERDAU";
date_default_timezone_set('America/Sao_Paulo');
$valor_dia = date('d/m/Y');
$ler_data_recebida = isset($_GET['data'])?$_GET['data']:"nao_tem_data_passsada";

//Link com os filtros
$link_cameras = isset($_GET['cameras'])?$_GET['cameras']:"todas";
$link_cameras_outros_veiculos = isset($_GET['cameras_outros_veiculos'])?$_GET['cameras_outros_veiculos']:"todas";
$link_status = isset($_GET['status'])?$_GET['status']:"todos";
$link_parecer = isset($_GET['parecer'])?$_GET['parecer']:"todos";
$link_parecer_outros_veiculos = isset($_GET['parecer_outros_veiculos'])?$_GET['parecer_outros_veiculos']:"todos";


$link_visualizar = isset($_GET['visualizar'])?$_GET['visualizar']:"principal";

$pesquisa = "nada";
$registro = ((floatval($check))/0.5)-22.5;



// deixa rodar
include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM usuarios WHERE registro='$registro' AND criptografia='$criptografia'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $nome = $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
 }
}



$link_sirene_ccl = "";
$link_sinere_rom1 = "";
$link_sinere_rom2 = "";
$link_sinere_rom3 = "";
$link_sinere_rom4 = "";
$link_sinere_rom5 = "";

// deixa rodar
include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM referencia_audios");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $ref_audio = $dados['ref_audio'];
  $historico = $dados['historico'];

  if($ref_audio == "entrada_vazio_rom" )
  {
    $link_sinere_rom1 = "<b>Atuado: </b>" . $historico;
  }
  elseif($ref_audio == "saida_cheio_saida_rom")
  {
    $link_sinere_rom2 = "<b>Atuado: </b>" . $historico;
  }
  elseif($ref_audio == "saida_cheio_saida_alternativa_rom")
  {
    $link_sinere_rom3 = "<b>Atuado: </b>" . $historico;
  }
  elseif($ref_audio == "erro_gscs")
  {
    $link_sinere_rom4 = "<b>Atuado: </b>" . $historico;
  }
  elseif($ref_audio == "erro_sva")
  {
    $link_sinere_rom5 = "<b>Atuado: </b>" . $historico;
  }
  else
  {
    $link_sirene_ccl = "<b>Último Acionamento : </b>" . $historico;
  }


 }//Fecha while

}



?>
<script>
var link_complemento = window.document.getElementById('lb_complemento');
var link_registro = window.document.getElementById('lb_registro');
link_registro.innerHTML = '<?php print $registro ?>';

link_complemento.innerHTML = '<?php print $complemento?>';
var link_check = window.document.getElementById('lb_check');
link_check.innerHTML = '<?php print $check?>';

var usuario = window.document.getElementById('colaborador');
var colaborador = "<?php print $nome ?>";
usuario.innerHTML = "Usuario : "  + colaborador;
var lfuncao = window.document.getElementById('funcao');
var funcao = "<?php print $tipo ?>";
var valor_dia = '<?php print $valor_dia ?>';
lfuncao.innerHTML = funcao + "   " + valor_dia;
var lusuario_criptografado = "<?php print $check ?>";
var link_criptografia = window.document.getElementById('criptografia');
link_criptografia.value = lusuario_criptografado;
var lcriptografia = "<?php print $criptografia ?>";
var link_criptografia2 = window.document.getElementById('criptografia2');
link_criptografia2.value = lcriptografia;
</script>



<script>

function descartar_placa(link_video) // Para o principal ( Icone caminhao )
{
 //alert("Serve para descartar a placa no sistema e não considerá-la mais! \n\n EM DESENVOLVIMENTO!");
   //alert(link_video);
 //
 
 
 
 
 //AGORA PRECISO FAZER O DETECTAR SE A PLACA NAO ESTA NO BANCO DE DADOS
 
 
 
 
 
  document.getElementById('ref1').value = link_video;//atualiza a referencia para apagar
  document.getElementById('div_descartar_placa').style.display = 'block';
  document.getElementById("tabela").disabled = true;
  var link = document.getElementById('lb_info_zerar');
}
function lidar_altera_video(link_video)
{
 alert("Serve para exibir a imagem da báscula relacionada no sistema do lidar! \n\n EM DESENVOLVIMENTO!");
 }

function cheio_vazio_altera_video(link_video)
{
 
 //alert(link_video);
 var player = videojs('vcheio_vazio_player1');
 player.src(
 {
   src: link_video,
   type: 'application/x-mpegURL',
 }
 );

 

}
function outros_veiculos_altera_video(link_video)
{
 //alert(link_video);
 var player = videojs('voutros_veiculos_player1');
 player.src(
 {
   src: link_video,
   type: 'application/x-mpegURL',
 }
 );

 

}










function deteccao_falsa_cheio_vazio(link_video)
{
  //alert(link_video);
  document.getElementById('ref1').value = link_video;//atualiza a referencia para apagar
  document.getElementById('div_info_zerar_cheio_vazio').style.display = 'block';
  document.getElementById("tabela").disabled = true;
  var link = document.getElementById('lb_info_zerar');
  
}

function deteccao_falsa_outros_veiculos(link_video)
{
  //alert(link_video);
  document.getElementById('ref1').value = link_video;//atualiza a referencia para apagar
  document.getElementById('div_info_zerar_outros_veiculos').style.display = 'block';
  var link = document.getElementById('lb_info_zerar');
  
}



function justificar_cheio_vazio(id)
{
  //alert("justificar");
  document.getElementById('div_justificar_cheio_vazio').style.display = 'block';
  
}




function editar_cheio_vazio(id)
{
 alert("editar");
  //document.getElementById('div_justificar_cheio_vazio').style.display = 'block';
  
}








function justificar_outros_veiculos(id)
{
  //alert("justificar");
  document.getElementById('div_justificar_outros_veiculos').style.display = 'block';
  
}

function cheio_vazio_altera_justificar_cheio_vazio(link_justificar)
{
 var nome1 = '<?php print $nome ?>';
 
 //alert(link_justificar);
 document.getElementById('ref1').value = link_justificar;
 var b = document.getElementById('ref1').value;
 

 //alert(dados);
       $.ajax({
           url: 'consulta_va_ref1.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': b},
           success: function(resultado){
            const myArr2 = resultado.split(",");
           var justificado = myArr2[0];
           var registro = myArr2[1];
           var nome = myArr2[2];
           var justificativa = (myArr2[3]);
           justificativa = justificativa.replace(/>/g, ','); // O comando é /xxxx/g onde, xxxx é o valor desejado e /  /g da funcao para trocar varios, se nao, ele troca apenas o primeiro

           if(justificado == "NAO" || justificado=="")
           {
            document.getElementById('cheio_vazio_v_registro').value = "--";
            document.getElementById('cheio_vazio_v_nome').value = "--";
            document.getElementById('cheio_vazio_v_parecer').value = "Ainda não realizado ajustificativa";
            document.getElementById('btn_editar_cheio_vazio').style.display = 'none';
            document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'none';
            document.getElementById('cheio_vazio_v_parecer').style.backgroundColor = '#DCDCDC';
            justificar_cheio_vazio(link_justificar);

           }
           else
           {

            if( (String(nome1)).trim() == (String(nome)).trim())
            {
             //alert("O mesmo");
             //Pode efetuar a edição do texto que ja esta justificado por ele
             //editar_cheio_vazio(link_justificar);
             document.getElementById('btn_editar_cheio_vazio').style.display = 'block';
             document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'none';
            }
            else
            {
              //alert("outro");
              //alert(nome1 + " - " + nome);
              //Não pode editar
              document.getElementById('btn_editar_cheio_vazio').style.display = 'none';
              document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'none';
              document.getElementById('btn_editar_cheio_vazio').style.display = 'none';
              document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'none';
              document.getElementById('cheio_vazio_v_parecer').style.backgroundColor = '#DCDCDC';
              
            }
           
            document.getElementById('cheio_vazio_v_registro').value = registro;
            document.getElementById('cheio_vazio_v_nome').value = nome;
            document.getElementById('cheio_vazio_v_parecer').value = justificativa;

           }
           
           }
       });
}





function f_salvar_cheio_vazio()
{
  valor_id = document.getElementById('ref1').value;
  //alert(valor_id);
  document.getElementById('cheio_vazio_v_parecer').style.backgroundColor = '#DCDCDC';
  var link = document.getElementById('cheio_vazio_v_parecer');
  var parecer2 = link.value;
  
  $.ajax({
           url: 'valida_salvar_edicao_cheio_vazio.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': valor_id,'parecer': parecer2},
           success: function(resultado){
             if(resultado == "ok")
             {
              alert("Efetuado a alteração com sucesso!");
             }
             else
             {
              alert("Ocorreu um erro ao efetuar a edição!");
             }
             
           }
         });


  document.getElementById('btn_editar_cheio_vazio').style.display = 'none';
  document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'none';
}

function f_editar_cheio_vazio()
{
  valor_id = document.getElementById('ref1').value;
  //alert(valor_id);
  document.getElementById('cheio_vazio_v_parecer').style.backgroundColor = '#ADD8E6';
  document.getElementById('cheio_vazio_v_parecer').focus();
  document.getElementById('btn_editar_cheio_vazio').style.display = 'none';
  document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'block';
}




function f_editar_outros_veiculos()
{
  valor_id = document.getElementById('ref1').value;
  //alert(valor_id);
  document.getElementById('outros_veiculos_v_parecer').style.backgroundColor = '#ADD8E6';
  document.getElementById('outros_veiculos_v_parecer').focus();
  document.getElementById('btn_editar_outros_veiculos').style.display = 'none';
  document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'block';
}






function f_salvar_outros_veiculos()
{
  valor_id = document.getElementById('ref1').value;
  //alert(valor_id);
  document.getElementById('outros_veiculos_v_parecer').style.backgroundColor = '#DCDCDC';
  var link = document.getElementById('outros_veiculos_v_parecer');
  var parecer2 = link.value;
  
  $.ajax({
           url: 'valida_salvar_edicao_outros_veiculos.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': valor_id,'parecer': parecer2},
           success: function(resultado){
             if(resultado == "ok")
             {
              alert("Efetuado a alteração com sucesso!");
             }
             else
             {
              alert("Ocorreu um erro ao efetuar a edição!");
             }
             
           }
         });


  document.getElementById('btn_editar_outros_veiculos').style.display = 'none';
  document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'none';
}




function outros_veiculos_altera_justificar(link_justificar)
{
  var nome1 = '<?php print $nome ?>';
 
 //alert(link_justificar);
 document.getElementById('ref1').value = link_justificar;
 var b = document.getElementById('ref1').value;
 


 //alert(dados);
       $.ajax({
           url: 'consulta_va_ref1_outros_veiculos.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': b},
           success: function(resultado){
            const myArr2 = resultado.split(",");
           var justificado = myArr2[0];
           var registro = myArr2[1];
           var nome = myArr2[2];
           var justificativa = (myArr2[3]);
           justificativa = justificativa.replace(/>/g, ','); // O comando é /xxxx/g onde, xxxx é o valor desejado e /  /g da funcao para trocar varios, se nao, ele troca apenas o primeiro

           if(justificado == "NAO" || justificado=="")
           {
            document.getElementById('outros_veiculos_v_registro').value = "--";
            document.getElementById('outros_veiculos_v_nome').value = "--";
            document.getElementById('outros_veiculos_v_parecer').value = "Ainda não realizado ajustificativa";
            document.getElementById('btn_editar_outros_veiculos').style.display = 'none';
            document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'none';
            document.getElementById('outros_veiculos_v_parecer').style.backgroundColor = '#DCDCDC';
            
            justificar_outros_veiculos(link_justificar);

           }
           else
           {
            if( (String(nome1)).trim() == (String(nome)).trim())
            {
             //alert("O mesmo");
             //Pode efetuar a edição do texto que ja esta justificado por ele
             //editar_cheio_vazio(link_justificar);
             document.getElementById('btn_editar_outros_veiculos').style.display = 'block';
             document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'none';
            }
            else
            {
              //alert("outro");
              //alert(nome1 + " - " + nome);
              //Não pode editar
              document.getElementById('btn_editar_outros_veiculos').style.display = 'none';
              document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'none';
              document.getElementById('btn_editar_outros_veiculos').style.display = 'none';
              document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'none';
              document.getElementById('outros_veiculos_v_parecer').style.backgroundColor = '#DCDCDC';
              
            }




            document.getElementById('outros_veiculos_v_registro').value = registro;
            document.getElementById('outros_veiculos_v_nome').value = nome;
            document.getElementById('outros_veiculos_v_parecer').value = justificativa;

           }
           
           }
       });
}




</script>





<div id='menu'>
<input type='button' id='btn_cheio_vazio' name='btn_cheio_vazio' onclick='clicou_cheio_vazio()'/> 
<input type='button' id='btn_outros_veiculos' name='btn_outros_veiculos' onclick='clicou_outros_veiculos()'/> 
<input type='button' id='btn_radar' name='btn_radar' onclick='clicou_radar()'/>
<input type='button' id='btn_relatorio' name='btn_relatorio' onclick='clicou_relatorio()'/>
<input type='button' id='btn_dashboard' name='btn_dashboard' onclick='clicou_dashboard()'/>
<input type='button' id='btn_configuracoes' name='btn_configuracoes' onclick='clicou_configuracoes()'/>
<input type='button' id='btn_descartados' name='btn_descartados' onclick='clicou_descartados()'/>
<input type='button' id='btn_sirene' name='btn_sirene' onclick='clicou_sirene()'/>
</div>












<div id="v_cheio_vazio">
  <input type="button" id="btn_editar_cheio_vazio" name="btn_editar_cheio_vazio" value="Editar" onclick="f_editar_cheio_vazio()" />
  <input type="button" id="btn_salvar_editar_cheio_vazio" name="btn_salvar_editar_cheio_vazio" value="Salvar" onclick="f_salvar_cheio_vazio()" />
<div id='tabela'>


<img id='cheio_vazio_btn_calendario' src="./images/date_range.png" onclick="cheio_vazio_clicou_exibir_calendario();"/>
<img id='cheio_vazio_btn_filtro' src="./images/local_bar.png"  onclick="cheio_vazio_clicou_filtrar();" hidden="hidden"/>

<div id='dados'>
<label id='cheio_vazio_valor_registro'><b>Registro: </b></label>
<input type='text' id='cheio_vazio_v_registro' name='cheio_vazio_v_registro' value='--'/>
<label id='cheio_vazio_valor_nome'><b>Nome: </b></label>
<input type='text' id='cheio_vazio_v_nome' name='cheio_vazio_v_nome' value='--'/>
<label id='cheio_vazio_lb_valor_parecer'><b>Parecer: </b></label>
<textarea id='cheio_vazio_v_parecer' name='cheio_vazio_v_parecer' name="Text1" cols="48" rows="4">--</textarea>
</div>

<label id='cheio_vazio_info_eventos'>Eventos Detectados: 0 </label>
<label id='cheio_vazio_info_eventos2'>Eventos justitificados: 0 </label>
<label id='cheio_vazio_info_eventos3'>Aderência: 0% </label>
<label id='cheio_vazio_info_eventos4'>Detectados/Bloqueados: 0 </label>
<label id='cheio_vazio_info_eventos5'>Match: 0 </label>
<label id='cheio_vazio_info_eventos6'>P. Bloqueadas: 0 </label>
<label id='cheio_vazio_info_eventos7'>Erros OCR: 0 </label>
<label id='cheio_vazio_info_eventos8'>Assertividade: 0% </label>
<label id='cheio_vazio_info_eventos9'>Tags: 0 </label>


<?php
date_default_timezone_set('America/Sao_Paulo');

$mensagem  = isset($_GET['data'])?$_GET['data']:"vazio2";

if($mensagem == "vazio2")
{
 $data = date('d/m/Y');
}
else
{
  $data = $mensagem;
}
 

$mes = substr($data,3,2);




$ultimo_placa_descartada = "0";
$n_placas_bloqueadas ="0";
$ultimo_match = "0";

include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM deteccao ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
   $ultimo = $dados['id'];
   $ultima_data = $dados['data_leitura'] . "  " . $dados['hora_leitura'];
 }
}

include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM placas_descartadas ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
   $n_placas_bloqueadas = $dados['id'];
   
 }
}

include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM deteccao  WHERE deteccao_falsa = 'MAT' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
   $ultimo_match = $dados['data_leitura'] . "  " . $dados['hora_leitura'];
   
 }
}




?>
<label id='cheio_vazio_titulo'>DIPS VL - Eventos do dia  <?php print $data ?></label>
<script>
var data_selecionada = '<?php print $data ?>';
//alert($ultima_data); 
</script>




<label id='cheio_vazio_titulo2'> Ultima detecção: <?php print $ultima_data ?></label>
<label id='cheio_vazio_titulo3'> Ultimo MATCH: --</label>
     <table id='tabela_cheio_vazio'>
        
        <tbody id='t_cheio_vazio'>
            <?php
            $text = '';
            $url_do_arquivo = '';
            $foto = '';
            $registro = '';
            $nome = '';
            $justificativa = '';
            $primeira_url = "";
            $avaliado = 'NAO';
            $encontrado = 0;
            $hora_evento = '';
			$n_match = 0;
			$n_bloqueados = 0;
            $evento_justificado = 0;
			$n_erro_ocr = 0;
			$n_tag = 0;
            //$hora = date('H:i:s');
            //Dados das cameras
            //ms0742-cam00 - Entrada ROM Cheio
            //ms0742-cam01 - Saida ROM Vazio
            //ms0742-cam02 - Saida Alternativa ROM Vazio
            //ms0742-cam03 - Saida Alternativa ROM Cheio
            //ms0742-cam04 - Entrada ROM Vazio
            //ms0742-cam05 - Saida ROM Cheio
            //ms0742-cam06 - Saida Alternativa ROM Cheio
            $cameras  = isset($_GET['cameras'])?$_GET['cameras']:"todas";
            $status  = isset($_GET['status'])?$_GET['status']:"todos";
            $parecer  = isset($_GET['parecer'])?$_GET['parecer']:"todos";

            if($cameras == "todas") // OK
            {
             // Todas as câmeras

             if($status == "todos")
             {
              $pesquisa = "data_leitura='$data'";
             }
             elseif($status == "apenas_cheio")
             {
              $pesquisa = "data_leitura='$data'"." AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
              $pesquisa = "data_leitura='$data'"." AND text='Detect - Vazio'";
             }
              
            }
            elseif($cameras == "ckb_1") // OK
            {
             
              //Atribui a pesquisa para entrada do rom
             //ms0742-cam00 - Entrada ROM Cheio
             //ms0742-cam04 - Entrada ROM Vazio
             if($status == "todos")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04')";
            }
             elseif($status == "apenas_cheio")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04') AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04') AND text='Detect - Vazio'";
             }

            }
            elseif($cameras == "ckb_2") // OK
            {
             //Atribui a pesquisa para saida do rom
             //ms0742-cam01 - Saida ROM Vazio
             //ms0742-cam05 - Saida ROM Cheio
             if($status == "todos")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05')";
             }
             elseif($status == "apenas_cheio")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
              /*
              ?><script>alert("ckb_2");</script><?php 
              */
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Vazio'";
             }
             
            }
            elseif($cameras == "ckb_3") // OK
            {
             //Atribui a pesquisa para saida alternativa do rom
             //ms0742-cam02 - Saida Alternativa ROM Vazio
             //ms0742-cam03 - Saida Alternativa ROM Cheio
             //ms0742-cam06 - Saida Alternativa ROM Cheio
             if($status == "todos")
             {
             $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')";
             }
             elseif($status == "apenas_cheio")
             {
             $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')  AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
             $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')  AND text='Detect - Vazio'";
             }
            }
            elseif($cameras == "ckb_1,ckb_2") // OK
            {
              //Atribui a pesquisa para entrada  e saida do rom
              //ms0742-cam00 - Entrada ROM Cheio
              //ms0742-cam04 - Entrada ROM Vazio

              //ms0742-cam01 - Saida ROM Vazio
              //ms0742-cam05 - Saida ROM Cheio
              if($status == "todos")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam01' OR camera_id='ms0742-cam05')";
              }
              elseif($status == "apenas_cheio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Cheio'";
              }
              elseif($status == "apenas_vazio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Vazio'";
              }
            }
            elseif($cameras == "ckb_1,ckb_3") // OK
            {
              //Atribui a pesquisa para entrada  e saida alternativa do rom
              //ms0742-cam00 - Entrada ROM Cheio
              //ms0742-cam04 - Entrada ROM Vazio

              //ms0742-cam02 - Saida Alternativa ROM Vazio
              //ms0742-cam03 - Saida Alternativa ROM Cheio
              //ms0742-cam06 - Saida Alternativa ROM Cheio
              if($status == "todos")
              {
               
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')";
              }
              elseif($status == "apenas_cheio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Cheio'";
              }
              elseif($status == "apenas_vazio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Vazio'";
              }
            }
            elseif($cameras == "ckb_2,ckb_3")
            {
              //Atribui a pesquisa para saida  e saida alternativa do rom
              //ms0742-cam01 - Saida ROM Vazio
              //ms0742-cam05 - Saida ROM Cheio

              //ms0742-cam02 - Saida Alternativa ROM Vazio
              //ms0742-cam03 - Saida Alternativa ROM Cheio
              //ms0742-cam06 - Saida Alternativa ROM Cheio
              if($status == "todos")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')";
              }
              elseif($status == "apenas_cheio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Cheio'";
              }
              elseif($status == "apenas_vazio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Vazio'";
              }
            }

            if($parecer == "todos")
            {
              $pesquisa = $pesquisa; // Faz nada
            }
            elseif($parecer == "ckb_6")
            {
              $pesquisa = $pesquisa. " AND justificado='SIM'";
            }
            else
            {
             $pesquisa = $pesquisa. " AND justificado!='SIM'";
            }
            
            

            include_once 'conexao_balanca1.php';
            //$sql = $dbcon->query("SELECT * FROM deteccoes WHERE ".$pesquisa." AND deteccao_falsa != 'SIM' ORDER BY id DESC");
            $sql = $dbcon->query("SELECT * FROM deteccao WHERE ".$pesquisa." AND (deteccao_falsa != 'SIM')  ORDER BY id DESC");
            if(mysqli_num_rows($sql)>0)
            {
             while($dados = $sql->fetch_array())
             {
			        $deteccao_falsa = $dados['deteccao_falsa'];
			        if($deteccao_falsa == 'BLK')
			        {
			         $n_bloqueados = $n_bloqueados + 1;
			        }
			        else
			        {
               $status_evento = $dados['condicao'];
               $v_nome = $dados['nome'];
               $hora_evento = $dados['hora_leitura'];
               $data_evento = $dados['data_leitura'];
               $placa = $dados['valor_placa'];
               if($placa == ""){$placa = "--";}
               $cam = $dados['camera'];
               $saida_detectada = $dados['saida_detectada'];
               //Atualiza a camera detectada
               //ms0742-cam00 - Entrada ROM Cheio
               //ms0742-cam01 - Saida ROM Vazio
               //ms0742-cam02 - Saida Alternativa ROM Vazio
               //ms0742-cam03 - Saida Alternativa ROM Cheio
               //ms0742-cam04 - Entrada ROM Vazio
               //ms0742-cam05 - Saida ROM Cheio
               //ms0742-cam06 - Saida Alternativa ROM Cheio
               $url_do_arquivo = $dados['video_bascula'];
               $url_do_arquivo2 = $dados['video_placa'];
               $ip = $_SERVER['REMOTE_ADDR'];
               if($ip == "192.168.30.1") // Entrei remoto
               {
                //echo('remoto');
                $url_do_arquivo = str_replace("/gerdau1.","/138.",$url_do_arquivo);
                $url_do_arquivo = str_replace(".svatech.",".0.",$url_do_arquivo);
                $url_do_arquivo = str_replace(".com.",".77.",$url_do_arquivo);
                $url_do_arquivo = str_replace(".br:",".80:",$url_do_arquivo);
                $url_do_arquivo2 = str_replace("/gerdau1.","/138.",$url_do_arquivo2);
                $url_do_arquivo2 = str_replace(".svatech.",".0.",$url_do_arquivo2);
                $url_do_arquivo2 = str_replace(".com.",".77.",$url_do_arquivo2);
                $url_do_arquivo2 = str_replace(".br:",".80:",$url_do_arquivo2);
               }
              else
              {
                  // estou internamente
               $url_do_arquivo = str_replace("@gerdau1.","@192.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".svatech.",".168.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".com.",".30.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".br:",".79:",$url_do_arquivo);
               $url_do_arquivo = str_replace(":3499",":8554",$url_do_arquivo);
              }

              $foto = $dados['imagem'];
              $avaliado = $ados['justificado'];
              $justificado = $dados['justificado'];    
              $registro = $dados['registro'];
              $id = $dados['id'];
			  $deteccao_falsa = $dados['deteccao_falsa'];
              $local_api = $dados['local_api'];
              $nome = $dados['nome'];
			  $tag = $dados['tag'];
			  if($tag == "vazio")
			  {
			  $tag = 'Não identificada!';
			  }
			  else
			  {
			  //Achou a tag, entrou conto 1 encontrada
			  $n_tag = $n_tag + 1;
			  }
              $justificativa = $dados['justificativa'];
              $justificativa = str_replace(">",",",$justificativa); // Troca a virgula por > por , para exibir normalmente
              $url_video = $url_do_arquivo;
              $url_video2 = $url_do_arquivo2;
			  
              $encontrado = $encontrado+1; 
              
              if($encontrado == 1)
              {
               $primeira_url = $url_video2;
               $primeira_url2 = $url_video2; 
               ?>
               <script>
                

                if('<?php print $justificado?>' == "NAO" || '<?php print $justificado?>'=="")
                {
                 document.getElementById('cheio_vazio_v_registro').value = "--";
                 document.getElementById('cheio_vazio_v_nome').value = "--";
                 document.getElementById('cheio_vazio_v_parecer').value = "Ainda não realizado ajustificativa";
                }
                else
                {
                 document.getElementById('cheio_vazio_v_registro').value = '<?php print $registro ?>';
                 document.getElementById('cheio_vazio_v_nome').value = '<?php print $nome ?>';
                 document.getElementById('cheio_vazio_v_parecer').value = '<?php print $justificativa ?>';
                }
                </script>
              <?php
              }
              else{
                $id = $dados['id'];
                
              }   
              ?>
              <tr>
              <td class="cheio_vazio_th1">
              <div id='foto_cheio_vazio'>
                <img id='foto_cheio_vazio' src="data:image/jpeg;base64,<?php print $foto ?>";/>
                </br>
                <label><b>Data: </b> <?php print $data_evento ?></label>
                <label><b>&nbsp&nbsp&nbsp&nbspHora: </b> <?php print $hora_evento ?></label>
                </br> 
                <label><b>Local: </b><?php print $local_api ?></label>
                <label><b> &nbsp&nbsp &nbsp&nbspEvento: </b> <?php print $placa ?></label>
					      <?php
					      if($url_do_arquivo ==$url_do_arquivo2)
					      {
                 // Agora trata se foi detecção errada ou nao!
                 if($deteccao_falsa == "XXX")
						     {
						      $n_erro_ocr = $n_erro_ocr + 1;
						      ?>
					        <img id='foto_cheio_vazio_alerta' src="./images/erro_ocr.png"/>
                  <?php
						     }
						     else
						     {
						      ?>
					        <img id='foto_cheio_vazio_alerta' src="./images/alertas.png"/>
                  <?php
						     }
					      }
					      else
					      {
					       $n_match = $n_match + 1; // Valida o valor do match
					       ?>
					       <img id='foto_cheio_vazio_alerta' src="./images/validado.png"/>
                 <?php
					      }

                if($cam == 'cam06')
                {
                  $cam = '06 - Esquerda da frente'; 
                }
                else if($cam == 'cam07')
                {
                  $cam = '07 - Esquerda detrás'; 
                }
                else if($cam == 'cam08')
                {
                  $cam = '08 - Direita da frente'; 
                }
                else if($cam == 'cam09')
                {
                  $cam = '09 - Direita detrás'; 
                }
					      ?>
                </br> 
                <label><b>Câmera: </b><?php print $cam ?></label>  
                </br>
                <?php
                if($v_nome !='')
                {
                 ?> 
                  <label><b>Tratado por: </b><?php print $v_nome?></label>
                  <?php
                }
                else
                {
                  ?>
                  <label><b>Tratado por: </b> --</label>
                  <?php
                }
                ?>
					      </br>
                <a href="javascript:cheio_vazio_altera_video('<?php echo $url_do_arquivo2 ?>');" id='assistir'>Video DIPS</a>
                <?php
                if($justificado == "SIM")
                {
                 $evento_justificado = $evento_justificado+1;  
                 //COLOCA NA COR VERDE #228B22
                 ?> 
                 <input type='button' id='<?php echo $id ?>' name='<?php echo $id ?>' class='justificar' value='Parecer Video' onclick="cheio_vazio_altera_justificar_cheio_vazio('<?php echo $id ?>');"/> 
                 <script>
                 var link = document.getElementById('<?php echo $id ?>');
                 link.style="background-color:#228B22";
                 </script>
                 <?php
                }
                else
                {
                 //COLOCA NA COR VERMELHO #DC143C;
                 ?>
                 <input type='button' id='<?php echo $id ?>' name='<?php echo $id ?>' class='justificar' value='Parecer Video' onclick="cheio_vazio_altera_justificar_cheio_vazio('<?php echo $id ?>');"/> 
                 <script>
                 var link = document.getElementById('<?php echo $id ?>');
                 link.style="background-color:#DC143C";
                 </script>
                 <?php
                }
                ?>
                </br>
                <label><b>-----------------------------------------------------------------</label>
                </br>
                </div>
                </td>
                </tr>
                <?php
               }// Fecha o while 
               ?>
               <script>
               n_encontrado = '<?php print $encontrado ?>';
               n_justificado = '<?php print $evento_justificado ?>';
               n_aderencia = (n_justificado/n_encontrado * 100).toFixed(1) + "%";
				       n_bloqueados = '<?php print $n_bloqueados ?>';
				       n_match = '<?php print $n_match ?>';
				       n_placas_bloqueadas = '<?php print $n_placas_bloqueadas ?>';
				       n_erro_ocr = '<?php print $n_erro_ocr ?>';
				       n_tag = '<?php print $n_tag ?>';
               // alert(n_placas_bloqueadas);
               document.getElementById('cheio_vazio_info_eventos').innerHTML = 'Eventos Detectados : '+ n_encontrado;
               document.getElementById('cheio_vazio_info_eventos2').innerHTML = 'Pendente Justificativa : '+ (parseInt(n_encontrado)-parseInt(n_justificado)); 
               document.getElementById('cheio_vazio_info_eventos3').innerHTML = 'Aderência : '+ n_aderencia; 
				       document.getElementById('cheio_vazio_info_eventos4').innerHTML = 'Detectados/Bloqueados : '+ n_bloqueados;
				       document.getElementById('cheio_vazio_info_eventos5').innerHTML = 'Match : '+ n_match;
				       document.getElementById('cheio_vazio_info_eventos6').innerHTML = 'P. Bloqueadas : '+ n_placas_bloqueadas;
				       document.getElementById('cheio_vazio_info_eventos7').innerHTML = 'Erros OCR : '+ n_erro_ocr;
				       document.getElementById('cheio_vazio_info_eventos9').innerHTML = 'Tags : '+ n_tag;
				       </script>
			         <?php
			        } // Fecha que nao foi deteccao falsa
             }  // Fecha o if mysqli_num_rows($sql)>0
             if($encontrado==0)
             {
              //INFORMA QUE NÃO ENCONTROU EVENTOS
              ?>   
              <tr>
                <td class="cheio_vazio_th1">
                </br>
                <label><b>&nbsp&nbsp Não existe eventos para esta data! </b></label>
                </td>
              </tr>
              <script>
              <?php $primeira_url = "./video_erro/video.m3u8"; ?>
              cheio_vazio_altera_video('<?php echo $primeira_url ?>');
              var player = videojs('vcheio_vazio_player1');
              player.play();
              </script>
              <?php   
             }
             ?>
            </tbody>
            </table>
           <!-- HTML -->
    <div id='cheio_vazio_player1'> 
    <video id='vcheio_vazio_player1'  class="video-js vjs-default-skin"  data-setup='{"fluid": true}' controls autoplay>
    <source type="application/x-mpegURL" src="<?php print $primeira_url?>">
    </video>
    </div>
    <script>
    cheio_vazio_altera_video('<?php echo $primeira_url ?>');
    var player = videojs('vcheio_vazio_player1');
    player.play();

    </script>











</div> <!-- Fecha a div tabela-->


<div id="baixar">


<input type="button" id="btn_erros_ocr" name="btn_erros_ocr" value="" onclick="clicou_baixar_erros_ocr()" />
<label id="lb_btn_erros_ocr" >Exportar erros detectados!</label>

<input type="button" id="btn_placas_bloqueadas" name="btn_placas_bloqueadas" value="" onclick="clicou_baixar_placas()" />
<label id="lb_btn_placas_bloqueadas" >Exportar placas bloqueadas!</label>
</div>


</div> <!-- Fecha d div v_cheio_vazio-->

<script>

function clicou_baixar_erros_ocr()
{
alert("Esta em desenvolvimento!");
}
function clicou_baixar_placas()
{
alert("Esta em desenvolvimento!");
}
</script>

<div id="v_outros_veiculos">
<input type="button" id="btn_editar_outros_veiculos" name="btn_editar_outros_veiculos" value="Editar" onclick="f_editar_outros_veiculos()" />
  <input type="button" id="btn_salvar_editar_outros_veiculos" name="btn_salvar_editar_outros_veiculos" value="Salvar" onclick="f_salvar_outros_veiculos()" />
<img id='outros_veiculos_btn_calendario' src="./images/date_range.png" onclick="cheio_vazio_clicou_exibir_calendario();"/>
<img id='outros_veiculos_btn_filtro' src="./images/local_bar.png" onclick="outros_veiculos_clicou_filtrar();"/>

<div id='dados_outros_veiculos'>
<label id='outros_veiculos_valor_registro'><b>Registro: </b></label>
<input type='text' id='outros_veiculos_v_registro' name='outros_veiculos_v_registro' value='--'/>
<label id='outros_veiculos_valor_nome'><b>Nome: </b></label>
<input type='text' id='outros_veiculos_v_nome' name='outros_veiculos_v_nome' value='--'/>
<label id='outros_veiculos_lb_valor_parecer'><b>Parecer: </b></label>
<textarea id='outros_veiculos_v_parecer' name='outros_veiculos_v_parecer' name="Text1" cols="40" rows="4">--</textarea>
</div>

<label id='outros_veiculos_info_eventos'>Eventos Detectados: 0 </label>
<label id='outros_veiculos_info_eventos2'>Eventos justitificados: 0 </label>
<label id='outros_veiculos_info_eventos3'>Aderência: 0% </label>
<?php
date_default_timezone_set('America/Sao_Paulo');

$mensagem  = isset($_GET['data'])?$_GET['data']:"vazio2";

if($mensagem == "vazio2")
{
 $data = date('d/m/Y');
}
else
{
  $data = $mensagem;
}
 

$mes = substr($data,3,2);





include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM outros_veiculos ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
   $ultimo = $dados['id'];
   $ultima_data = $dados['data_leitura'];
 }
}







?>
<label id='outros_veiculos_titulo'> BLOQUEADOS - Eventos do dia  <?php print $data ?></label>
<script>
var data_selecionada = '<?php print $data ?>'; 
</script>




<label id='outros_veiculos_titulo2'> Ultima detecção: <?php print $ultima_data ?></label>

     <table id='tabela_outros_veiculos'>
        
        <tbody id='t_outros_veiculos'>
            <?php
            $text = '';
            $url_do_arquivo = '';
            $foto = '';
            $registro = '';
            $nome = '';
            $justificativa = '';
            $primeira_url = "";
            $avaliado = 'NAO';
            $encontrado = 0;
            $hora_evento = '';
            $evento_justificado = 0;
            //$hora = date('H:i:s');
            //Dados das cameras
            //ms0742-cam00 - Entrada ROM Cheio
            //ms0742-cam01 - Saida ROM Vazio
            //ms0742-cam02 - Saida Alternativa ROM Vazio
            //ms0742-cam03 - Saida Alternativa ROM Cheio
            //ms0742-cam04 - Entrada ROM Vazio
            //ms0742-cam05 - Saida ROM Cheio
            //ms0742-cam06 - Saida Alternativa ROM Cheio
            $cameras  = isset($_GET['cameras'])?$_GET['cameras']:"todas";
            $status  = isset($_GET['status'])?$_GET['status']:"todos";
            $parecer  = isset($_GET['parecer'])?$_GET['parecer']:"todos";

            if($cameras == "todas") // OK
            {
             // Todas as câmeras

             if($status == "todos")
             {
              $pesquisa = "data_leitura='$data'";
             }
             elseif($status == "apenas_cheio")
             {
              $pesquisa = "data_leitura='$data'"." AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
              $pesquisa = "data_leitura='$data'"." AND text='Detect - Vazio'";
             }
              
            }
            elseif($cameras == "ckb_1") // OK
            {
             
              //Atribui a pesquisa para entrada do rom
             //ms0742-cam00 - Entrada ROM Cheio
             //ms0742-cam04 - Entrada ROM Vazio
             if($status == "todos")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04')";
            }
             elseif($status == "apenas_cheio")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04') AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04') AND text='Detect - Vazio'";
             }

            }
            elseif($cameras == "ckb_2") // OK
            {
             //Atribui a pesquisa para saida do rom
             //ms0742-cam01 - Saida ROM Vazio
             //ms0742-cam05 - Saida ROM Cheio
             if($status == "todos")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05')";
             }
             elseif($status == "apenas_cheio")
             {
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
              /*
              ?><script>alert("ckb_2");</script><?php 
              */
              $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Vazio'";
             }
             
            }
            elseif($cameras == "ckb_3") // OK
            {
             //Atribui a pesquisa para saida alternativa do rom
             //ms0742-cam02 - Saida Alternativa ROM Vazio
             //ms0742-cam03 - Saida Alternativa ROM Cheio
             //ms0742-cam06 - Saida Alternativa ROM Cheio
             if($status == "todos")
             {
             $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')";
             }
             elseif($status == "apenas_cheio")
             {
             $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')  AND text='Detect - Cheio'";
             }
             elseif($status == "apenas_vazio")
             {
             $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')  AND text='Detect - Vazio'";
             }
            }
            elseif($cameras == "ckb_1,ckb_2") // OK
            {
              //Atribui a pesquisa para entrada  e saida do rom
              //ms0742-cam00 - Entrada ROM Cheio
              //ms0742-cam04 - Entrada ROM Vazio

              //ms0742-cam01 - Saida ROM Vazio
              //ms0742-cam05 - Saida ROM Cheio
              if($status == "todos")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam01' OR camera_id='ms0742-cam05')";
              }
              elseif($status == "apenas_cheio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Cheio'";
              }
              elseif($status == "apenas_vazio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam01' OR camera_id='ms0742-cam05') AND text='Detect - Vazio'";
              }
            }
            elseif($cameras == "ckb_1,ckb_3") // OK
            {
              //Atribui a pesquisa para entrada  e saida alternativa do rom
              //ms0742-cam00 - Entrada ROM Cheio
              //ms0742-cam04 - Entrada ROM Vazio

              //ms0742-cam02 - Saida Alternativa ROM Vazio
              //ms0742-cam03 - Saida Alternativa ROM Cheio
              //ms0742-cam06 - Saida Alternativa ROM Cheio
              if($status == "todos")
              {
               
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')";
              }
              elseif($status == "apenas_cheio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Cheio'";
              }
              elseif($status == "apenas_vazio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam00' OR camera_id='ms0742-cam04' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Vazio'";
              }
            }
            elseif($cameras == "ckb_2,ckb_3")
            {
              //Atribui a pesquisa para saida  e saida alternativa do rom
              //ms0742-cam01 - Saida ROM Vazio
              //ms0742-cam05 - Saida ROM Cheio

              //ms0742-cam02 - Saida Alternativa ROM Vazio
              //ms0742-cam03 - Saida Alternativa ROM Cheio
              //ms0742-cam06 - Saida Alternativa ROM Cheio
              if($status == "todos")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06')";
              }
              elseif($status == "apenas_cheio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Cheio'";
              }
              elseif($status == "apenas_vazio")
              {
               $pesquisa = "data_leitura='$data'"." AND (camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' OR camera_id='ms0742-cam02' OR camera_id='ms0742-cam03' OR camera_id='ms0742-cam06') AND text='Detect - Vazio'";
              }
            }

            if($parecer == "todos")
            {
              $pesquisa = $pesquisa; // Faz nada
            }
            elseif($parecer == "ckb_6")
            {
              $pesquisa = $pesquisa. " AND justificado='SIM'";
            }
            else
            {
             $pesquisa = $pesquisa. " AND justificado!='SIM'";
            }
            
            

            include_once 'conexao_balanca1.php';
            //$sql = $dbcon->query("SELECT * FROM deteccoes WHERE ".$pesquisa." AND deteccao_falsa != 'SIM' ORDER BY id DESC");
            $sql = $dbcon->query("SELECT * FROM deteccao_proibidas WHERE ".$pesquisa." AND (deteccao_falsa != 'SIM' AND deteccao_falsa != 'BLK')  ORDER BY id DESC");
            if(mysqli_num_rows($sql)>0)
            {
             while($dados = $sql->fetch_array())
             {

              $status_evento = $dados['condicao'];
              $hora_evento = $dados['hora_leitura'];
              $data_evento = $dados['data_leitura'];
              $placa = $dados['valor_placa'];
              if($placa == ""){$placa = "--";}
              $cam = $dados['camera'];
              $saida_detectada = $dados['saida_detectada'];

              //Atualiza a camera detectada
              //ms0742-cam00 - Entrada ROM Cheio
              //ms0742-cam01 - Saida ROM Vazio
              //ms0742-cam02 - Saida Alternativa ROM Vazio
              //ms0742-cam03 - Saida Alternativa ROM Cheio
              //ms0742-cam04 - Entrada ROM Vazio
              //ms0742-cam05 - Saida ROM Cheio
              //ms0742-cam06 - Saida Alternativa ROM Cheio
              if($cam == 'ms0742-cam00'){$cam = 'Câmera Entrada ROM';}
              else if ($cam == 'ms0742-cam01'){$cam = 'Câmera Saida ROM';}
              else if ($cam == 'ms0742-cam02'){$cam = 'Câmera Saida Alt. ROM';}
              else if ($cam == 'ms0742-cam03'){$cam = 'Câmera Saida Alt. ROM';}
              else if ($cam == 'ms0742-cam04'){$cam = 'Câmera Entrada ROM';}
              else if ($cam == 'ms0742-cam05'){$cam = 'Câmera Saida ROM';}
              else if ($cam == 'ms0742-cam06'){$cam = 'Câmera Saida Alt. ROM';}





              $url_do_arquivo = $dados['video_bascula'];
              $url_do_arquivo2 = $dados['video_placa'];
              $ip = $_SERVER['REMOTE_ADDR'];
              
              if($ip == "192.168.30.1") // Entrei localmente!
              {
               //echo('remoto');
               
               $url_do_arquivo = str_replace("/gerdau1.","/138.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".svatech.",".0.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".com.",".77.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".br:",".80:",$url_do_arquivo);

               $url_do_arquivo2 = str_replace("/gerdau1.","/138.",$url_do_arquivo2);
               $url_do_arquivo2 = str_replace(".svatech.",".0.",$url_do_arquivo2);
               $url_do_arquivo2 = str_replace(".com.",".77.",$url_do_arquivo2);
               $url_do_arquivo2 = str_replace(".br:",".80:",$url_do_arquivo2);
              }
              else
              {
                  // estou internamente
               $url_do_arquivo = str_replace("@gerdau1.","@192.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".svatech.",".168.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".com.",".30.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".br:",".79:",$url_do_arquivo);
               $url_do_arquivo = str_replace(":3499",":8554",$url_do_arquivo);
              }

              $foto = $dados['imagem'];
              $avaliado = $ados['justificado'];
              $justificado = $dados['justificado'];    
              $registro = $dados['registro'];
              $id = $dados['id'];
              $local_api = $dados['local_api'];
              $nome = $dados['nome'];
              $justificativa = $dados['justificativa'];
              $justificativa = str_replace(">",",",$justificativa); // Troca a virgula por > por , para exibir normalmente
              $url_video = $url_do_arquivo;
              $url_video2 = $url_do_arquivo2;
              $encontrado_outros = $encontrado_outros+1; 
              
              if($encontrado_outros == 1)
              {
               $primeira_url = $url_video;
               $primeira_url2 = $url_video2; 
               ?>
                <script>
                

                if('<?php print $justificado?>' == "NAO" || '<?php print $justificado?>'=="")
                {
                 document.getElementById('outros_veiculos_v_registro').value = "--";
                 document.getElementById('outros_veiculos_v_nome').value = "--";
                 document.getElementById('outros_veiculos_v_parecer').value = "Ainda não realizado ajustificativa";
                }
                else
                {
                 document.getElementById('outros_veiculos_v_registro').value = '<?php print $registro ?>';
                 document.getElementById('outros_veiculos_v_nome').value = '<?php print $nome ?>';
                 document.getElementById('outros_veiculos_v_parecer').value = '<?php print $justificativa ?>';
                }
                </script>
              <?php
              }
              else{
                $id = $dados['id'];
                
              }   
              ?>
              <tr>
                <td class="outros_veiculos_th1">
                  <div id='foto_outros_veiculos'>
                      <img id='foto_outros_veiculos' src="data:image/jpeg;base64,<?php print $foto ?>";/>
                      <label><b>Data: </b> <?php print $data_evento ?></label>
                      <label><b>&nbsp&nbsp&nbsp&nbspHora: </b> <?php print $hora_evento ?></label>
                      </br> 
                      <label><b>Local: </b><?php print $local_api ?></label>
                      <label><b> &nbsp&nbsp &nbsp&nbspPlaca: </b> <?php print $placa ?></label>
					  <?php
					  if($url_do_arquivo ==$url_do_arquivo2)
					  {
					  //Mesmo estando iguais pode validar na imagem, pois o OCR acertou e se trata de placa de veiculos que nao sao carreta, nunca ocorrerá MAT mesmo!
					  ?>
					  <img id='foto_outros_veiculos_alerta' src="./images/validado.png"/> 
                      <?php
					  }
					  ?>
                      </br> 
                      <label><b>Câmera: </b><?php print $cam ?></label>  
                      </br>
                      <label><b>Condição: </b><?php print $status_evento?></label>
                      
                      
                    </br>
                      
					  <a href="javascript:outros_veiculos_altera_video('<?php echo $url_do_arquivo2 ?>');" id='assistir'>Placa</a>
                      <?php
                      if($justificado == "SIM")
                      {
                        $evento_justificado = $evento_justificado+1;  
                          //COLOCA NA COR VERDE #228B22
                       ?> 
                       <a href="javascript:outros_veiculos_altera_justificar_outros_veiculos('<?php echo $id ?>');" style="background-color:#228B22;"  id='justificar' name='justificar'>Parecer Video</a>
                       <script>
                       //alert('verde');
                       </script>
                       <?php
                      }
                      else{
                          //COLOCA NA COR VERMELHO #DC143C;
                      ?>
                      <a href="javascript:outros_veiculos_altera_justificar_outros_veiculos('<?php echo $id ?>');" style="background-color:#DC143C;"  id='justificar' name='justificar'>Parecer Video</a>
                      <script>
                       //alert('vermelho');
                       </script>
                      <?php
                      }
                      ?>
                     
                    <a href="javascript:lidar_altera_video('<?php echo '2222' ?>');" style="background-color:#4169E1;" id='assistir'>Imagem Lidar</a>
                    
                    </br></br>
                    <label><b>-----------------------------------------------------------------</label>
                  </div>

                
                  

                </td>
           
              </tr>
             <?php
             }// Fecha o while 
             ?>
             <script>
                n_encontrado_outros = '<?php print $encontrado_outros ?>';
                n_justificado = '<?php print $evento_justificado ?>';
				
                n_aderencia = (n_justificado/n_encontrado * 100).toFixed(1) + "%";
                //alert(n_justificado);
                document.getElementById('outros_veiculos_info_eventos').innerHTML = 'Eventos Detectados : '+ n_encontrado_outros;
                document.getElementById('outros_veiculos_info_eventos2').innerHTML = 'Eventos Justificados : '+ n_justificado; 
                document.getElementById('outros_veiculos_info_eventos3').innerHTML = 'Aderência : '+ n_aderencia; 
                
				
				
				
				
				//AGORA ATUALIZO O VALOR GERAL DA ASSETITIVDADE
				total_encontrado = (parseInt(n_bloqueados) + parseInt(n_encontrado) + parseInt(n_encontrado_outros))-1; // Nao tirar o -1
				//alert(total_encontrado);
				total_acertos = parseInt(n_bloqueados) + parseInt(n_encontrado_outros);
				//alert(total_acertos);
				assertividade = ((total_acertos/total_encontrado)*100).toFixed(1) + "%";
				//alert(assertividade);
				document.getElementById('cheio_vazio_info_eventos8').innerHTML = 'Assertividade : '+ assertividade + " / " + total_acertos;
				document.getElementById('cheio_vazio_info_eventos').innerHTML = 'Eventos Detectados : '+ parseInt(total_encontrado);
				
              </script>
			  
             <?php
            } // Fecha o if mysqli_num_rows($sql)>0
            if($encontrado==0)
             {
              //INFORMA QUE NÃO ENCONTROU EVENTOS
              ?>   
              <tr>
                <td class="outros_veiculos_th1">
                </br>
                  <label><b>&nbsp&nbsp Não existe eventos para esta data! </b></label>
                  
                </td>
              </tr>
              <script>
                <?php $primeira_url = "./video_erro/video.m3u8"; ?>
                outros_veiculos_altera_video('<?php echo $primeira_url ?>');
                var player = videojs('voutros_veiculos_player1');
                player.play();
              </script>

              <?php   
             }
            ?>
            
        </tbody>
    </table>


<!-- HTML -->
<div id='outros_veiculos_player1'> 
<video id='voutros_veiculos_player1'  class="video-js vjs-default-skin"  data-setup='{"fluid": true}' controls autoplay>
<source type="application/x-mpegURL" src="<?php print $primeira_url?>">
</video>
</div>
<script>
outros_veiculos_altera_video('<?php echo $primeira_url ?>');
var player = videojs('voutros_veiculos_player1');
player.play();

</script>






</div>


<div id="v_radar">


<input type="button" id="btn_editar_radar" name="btn_editar_radar" value="Editar" onclick="f_editar_radar()" />
<input type="button" id="btn_salvar_editar_radar" name="btn_salvar_editar_radar" value="Salvar" onclick="f_salvar_radar()" />
<img id='radar_btn_calendario' src="./images/date_range.png" onclick="cheio_vazio_clicou_exibir_calendario();"/>
<img id='radar_btn_filtro' src="./images/local_bar.png" onclick="radar_clicou_filtrar();"/>

<div id='dados_radar'>
<label id='radar_valor_registro'><b>Registro: </b></label>
<input type='text' id='radar_v_registro' name='radar_v_registro' value='--'/>
<label id='radar_valor_nome'><b>Nome: </b></label>
<input type='text' id='radar_v_nome' name='radar_v_nome' value='--'/>
<label id='radar_lb_valor_parecer'><b>Parecer: </b></label>
<textarea id='radar_v_parecer' name='radar_v_parecer' name="Text1" cols="56" rows="4">--</textarea>
</div>

<label id='radar_info_eventos'>Eventos Detectados: 0 </label>
<label id='radar_info_eventos2'>Eventos justitificados: 0 </label>
<label id='radar_info_eventos3'>Aderência: 0% </label>
<?php
date_default_timezone_set('America/Sao_Paulo');

$mensagem  = isset($_GET['data'])?$_GET['data']:"vazio2";

if($mensagem == "vazio2")
{
 $data = date('d/m/Y');
}
else
{
  $data = $mensagem;
}
 

$mes = substr($data,3,2);





include_once 'conexao_radar.php';
$sql = $dbcon->query("SELECT * FROM radar_restaurante_mb ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
   $ultimo = $dados['id'];
   $ultima_data = $dados['data_leitura'];
 }
}







?>
<label id='radar_titulo'> VA Radar MB - Eventos do dia  <?php print $data ?></label>
<script>
var data_selecionada = '<?php print $data ?>'; 
</script>




<label id='radar_titulo2'> Ultima detecção: <?php print $ultima_data ?></label>

     <table id='tabela_radar'>
        
        <tbody id='t_radar'>
            <?php
            $text = '';
            $url_do_arquivo = '';
            $foto = '';
            $registro = '';
            $nome = '';
            $justificativa = '';
            $primeira_url = "";
            $avaliado = 'NAO';
            $encontrado = 0;
            $hora_evento = '';
            $evento_justificado = 0;
            //$hora = date('H:i:s');
            //Dados das cameras
            //ms0742-cam08 - Abertura I e II
            //ms0742-cam07 - Patio CCL
            
            $cameras_radar  = isset($_GET['cameras_radar'])?$_GET['cameras_radar']:"todas";
            $parecer_radar  = isset($_GET['parecer_radar'])?$_GET['parecer_radar']:"todos";
            
            if($cameras_radar == "todas") // OK
            {
             // Todas as câmeras
              $pesquisa_radar = "data_leitura='$data'";
            }
                       
            elseif($cameras_radar == "radar_ckb_1") // OK
            {
             
             //Atribui a pesquisa para Patio CCL
             //ms0742-cam07 - Patio CCL
             $pesquisa_radar = "data_leitura='$data'"." AND (camera_id='ms0742-cam07')";
            
            }
            else// radar_ckb_2
            {
             //Atribui a pesquisa para Abertura I e II
             //ms0742-cam08 - Abertura I e II
             $pesquisa_radar = "data_leitura='$data'"." AND (camera_id='ms0742-cam08')";
            }
            

            if($parecer_radar == "todos")
            {
              $pesquisa_radar = $pesquisa_radar; // Faz nada
            }
            elseif($parecer_radar == "radar_ckb_6")
            {
              $pesquisa_radar = $pesquisa_radar. " AND justificado='SIM'";
            }
            else
            {
             $pesquisa_radar = $pesquisa_radar. " AND justificado!='SIM'";
            }
            $pesquisa_radar="d";
            include_once 'conexao_balanca1.php';
            $sql = $dbcon->query("SELECT * FROM radar_restaurante_mb WHERE ".$pesquisa_radar."AND deteccao_falsa !='SIM' ORDER BY id DESC");
            if(mysqli_num_rows($sql)>0)
            {
             while($dados = $sql->fetch_array())
             {

              $status_evento = $dados['text'];
              $hora_evento = $dados['hora'];
              $data_evento = $dados['data_leitura'];
              $cam = $dados['camera_id'];
              $velocidade = $dados['tipo_evento'];
              $velocidade = $velocidade . " Km/h";
              // Atualiza o nome das câmeras
              //ms0742-cam08 - Abertura I e II
              //ms0742-cam07 - Patio CCL
              if($cam == 'ms0742-cam08'){$cam = 'Abertura I e II';}
              else if ($cam == 'ms0742-cam07'){$cam = 'Pátio CCL';}
             
              




              $url_do_arquivo = $dados['caminho'];
              $ip = $_SERVER['REMOTE_ADDR'];
              if($ip == "192.168.20.1")
              {
               //echo('remoto');
               $url_do_arquivo = str_replace("/192.","/138.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".168.",".0.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".20.",".77.",$url_do_arquivo);
               $url_do_arquivo = str_replace(".117:",".80:",$url_do_arquivo);
               $url_do_arquivo = str_replace(":8597",":5009",$url_do_arquivo);
              }

              $foto = $dados['imagem'];
              $avaliado = $ados['justificado'];
              $justificado = $dados['justificado'];    
              $registro = $dados['registro'];
              $id = $dados['id'];
              $nome = $dados['nome'];
              $justificativa = $dados['justificativa'];
              $justificativa = str_replace(">",",",$justificativa); // Troca a virgula por > por , para exibir normalmente
              $url_video = $url_do_arquivo;
               $encontrado = $encontrado+1; 
              
              if($encontrado == 1)
              {
               $primeira_url = $url_video; 
               ?>
                <script>
                

                if('<?php print $justificado?>' == "NAO" || '<?php print $justificado?>'=="")
                {
                 document.getElementById('radar_v_registro').value = "--";
                 document.getElementById('radar_v_nome').value = "--";
                 document.getElementById('radar_v_parecer').value = "Ainda não realizado a justificativa";
                }
                else
                {
                 document.getElementById('radar_v_registro').value = '<?php print $registro ?>';
                 document.getElementById('radar_v_nome').value = '<?php print $nome ?>';
                 document.getElementById('radar_v_parecer').value = '<?php print $justificativa ?>';
                }
                </script>
              <?php
              }
              else{
                $id = $dados['id'];
                
              }   
              ?>
              <tr>
                <td class="radar_th1">
                  <div id='foto_radar'>
                      <img id='foto_radar' src="data:image/jpeg;base64,<?php print $foto ?>";/>
                      <label><b>Data Evento: </b> <?php print $data_evento ?></label>
                      <label><b>Velocidade: </b> <?php print $velocidade ?></label>
                      </br>
                      <label><b>Horario Evento: </b> <?php print $hora_evento ?></label>
                      </br>
                      <label><b>Status Evento: </b><?php print $status_evento?></label>
                      </br>
                      <label><b>Local: </b><?php print $cam ?></label>
                      </br>
                      <a href="javascript:radar_altera_video('<?php echo $url_do_arquivo ?>');" id='assistir'>Assistir</a>
                      <?php
                      if($justificado == "SIM")
                      {
                        $evento_justificado = $evento_justificado+1;  
                          //COLOCA NA COR VERDE #228B22
                       ?> 
                       <a href="javascript:radar_altera_justificar('<?php echo $id ?>');" style="background-color:#228B22;"  id='justificar' name='justificar'>Parecer Video</a>
                       <script>
                       //alert('verde');
                       </script>
                       <?php
                      }
                      else{
                          //COLOCA NA COR VERMELHO #DC143C;
                      ?>
                      <a href="javascript:radar_altera_justificar('<?php echo $id ?>');" style="background-color:#DC143C;"  id='justificar' name='justificar'>Parecer Video</a>
                      <script>
                       //alert('vermelho');
                       </script>
                      <?php
                      }
                      ?>
                      <a href="javascript:deteccao_falsa_radar('<?php echo $id ?>');" id='ignorar' name='ignorar'>Detecção Falsa</a>
                      
                  </div>

                
                  

                </td>
           
              </tr>
             <?php
             }// Fecha o while 
             ?>
             <script>
                n_encontrado = '<?php print $encontrado ?>';
                n_justificado = '<?php print $evento_justificado ?>';
                n_aderencia = (n_justificado/n_encontrado * 100).toFixed(1) + "%";
                //alert(n_justificado);
                document.getElementById('radar_info_eventos').innerHTML = 'Eventos Detectados : '+ n_encontrado;
                document.getElementById('radar_info_eventos2').innerHTML = 'Eventos Justificados : '+ n_justificado; 
                document.getElementById('radar_info_eventos3').innerHTML = 'Aderência : '+ n_aderencia; 
              </script>
             <?php
            } // Fecha o if mysqli_num_rows($sql)>0
            if($encontrado==0)
             {
              //INFORMA QUE Não ENCONTROU EVENTOS
              ?>   
              <tr>
                <td class="radar_th1">
                </br>
                  <label><b>&nbsp&nbsp Não existe eventos para esta data! </b></label>
                  
                </td>
              </tr>
              <script>
                <?php $primeira_url = "./video_erro/video.m3u8"; ?>
                radar_altera_video('<?php echo $primeira_url ?>');
                var player = videojs('vradar_player1');
                player.play();
              </script>

              <?php   
             }
            ?>
            
        </tbody>
    </table>



<!-- HTML -->
<div id='radar_player1'> 
<video id='vradar_player1'  class="video-js vjs-default-skin"  controls autoplay>
<source type="application/x-mpegURL" src="<?php print $primeira_url?>">
</video>
</div>
<script>
radar_altera_video('<?php echo $primeira_url ?>');
var player = videojs('vradar_player1');
player.play();

</script>



</div> <!--Fecha div radar-->


<div id="v_relatorio">

<label id="v1">Relatorio</label>
<label id="v2">Relatorio</label>
<label id="v3">Relatorio</label>
<label id="v4">Relatorio</label>
<label id="v5">Relatorio</label>
<label id="v6">Relatorio</label>

</div>

<div id="v_dashboard">

<label id="v1">Dashboard</label>
<label id="v2">Dashboard</label>
<label id="v3">Dashboard</label>
<label id="v4">Dashboard</label>
<label id="v5">Dashboard</label>
<label id="v6">Dashboard</label>

</div>

<div id="v_configuracoes">

<label id="v1">Configuracoes</label>
<label id="v2">Configuracoes</label>
<label id="v3">Configuracoes</label>
<label id="v4">Configuracoes</label>
<label id="v5">Configuracoes</label>
<label id="v6">Configuracoes</label>

</div>


<div id="v_descartados">

<label id="v1">Descartados</label>
<label id="v2">Descartados</label>
<label id="v3">Descartados</label>
<label id="v4">Descartados</label>
<label id="v5">Descartados</label>
<label id="v6">Descartados</label>

</div>

<div id="v_sirene">





<label id='lb_titulo_sirene'>Controle dos Audios</label>
  
   <div id="sirene1">
    <label id='nome_sirene'><b>Sirene: </b> Pátio CCL</label>
    <label id='ultimo_acionamento_sirene1'><b>Último Acionamento : </b> 08/10/2021 10:44:21</label>
    <img id='foto_sirene' src="./images/sirene_1.jpg"/>
    <input type="button" id="ativar_sirene1" name="ativar_sirene1" value="Ativar" onclick="clicou_ativar_sirene_ccl();">
    <input type="button" id="desativar_sirene1" name="desativar_sirene1" value="Desativar" onclick="clicou_desativar_sirene_ccl();">
    <input type="button" id="testar_sirene1" name="testar_sirene1" value="Testar" onclick="clicou_teste_audio_sirene1();">
  </div>
  
   <div id='dados_sirene'>
    <label id='outros_veiculos_valor_registro'><b>Condição: </b></label>
    <input type='text' id='outros_veiculos_v_registro' name='outros_veiculos_v_registro' value='Ativada!'/>
    <label id='outros_veiculos_valor_nome'><b>Nome: </b></label>
    <input type='text' id='outros_veiculos_v_nome' name='outros_veiculos_v_nome' value='--'/>
    <label id='outros_veiculos_lb_valor_parecer'><b>Parecer: </b></label>
    <textarea id='outros_veiculos_v_parecer' name='outros_veiculos_v_parecer' name="Text1" cols="56" rows="4">--</textarea>
   </div>

   <label id='lb_titulo_sirene2'>Acionamentos teste CCL</label>
   
   <div id="div_testes_audios_ccl_rom">

    <label id='nome_sirene_rom'><b>Local: </b> Automações ROM</label>
    
    <label id='teste_sirene_rom1'>Entrando Vazio no ROM</label>
    <label id='ultimo_acionamento_sirene_rom1'><b>Atuado: </b> 08/10/2021 10:44:21</label>
    <input type="button" id="testar_audio_sirene1" name="testar_audio_sirene1" value="Testar" onclick="clicou_teste_rom1();">
  
    <label id='teste_sirene_rom2'>Saindo Cheio do ROM</label>
    <label id='ultimo_acionamento_sirene_rom2'><b>Atuado: </b> 08/10/2021 10:44:21</label>
    <input type="button" id="testar_audio_sirene2" name="testar_audio_sirene2" value="Testar" onclick="clicou_teste_rom2();">
  
    <label id='teste_sirene_rom3'>Saindo Cheio Alt. do ROM</label>
    <label id='ultimo_acionamento_sirene_rom3'><b>Atuado: </b> 08/10/2021 10:44:21</label>
    <input type="button" id="testar_audio_sirene3" name="testar_audio_sirene3" value="Testar" onclick="clicou_teste_rom3();">
  
    <label id='teste_sirene_rom4'>Erro GSCS</label>
    <label id='ultimo_acionamento_sirene_rom4'><b>Atuado: </b> 08/10/2021 10:44:21</label>
    <input type="button" id="testar_audio_sirene4" name="testar_audio_sirene4" value="Testar" onclick="clicou_teste_rom4();">
  
    <label id='teste_sirene_rom5'>Erro SVA</label>
    <label id='ultimo_acionamento_sirene_rom5'><b>Atuado: </b> 08/10/2021 10:44:21</label>
    <input type="button" id="testar_audio_sirene5" name="testar_audio_sirene5" value="Testar" onclick="clicou_teste_rom5();">
  
  
    <audio id='audio_sirene1' controls src="./audios/CCL_MB/Pessoa_detectada.mp3" hidden="hidden"></audio>
    <audio id='audio_rom1' controls src="./audios/ROM/Entrou_vazio.mp3" hidden="hidden"></audio>
    <audio id='audio_rom2' controls src="./audios/ROM/Saiu_carregado_saida_normal.mp3" hidden="hidden"></audio>
    <audio id='audio_rom3' controls src="./audios/ROM/Saiu_carregado_saida_alternativa.mp3" hidden="hidden"></audio>
    <audio id='audio_rom4' controls src="./audios/ROM/Erro_gscs.mp3" hidden="hidden"></audio>
    <audio id='audio_rom5' controls src="./audios/ROM/Erro_sva.mp3" hidden="hidden"></audio>
  </div>

  <div id="div_sirene"  >
<label id='lb_info_justificar2'>ATENÇÃO!</label>
<label id='lb_info_justificar'>Deseja realmente desativar a sirene?</label>
<input type="button" id="sim2_cheio_vazio" name="sim2_cheio_vazio" value="SIM" onclick="clicou_sim_justificar_sirene('sirene_ccl_mb');">
<input type="button" id="nao2_cheio_vazio" name="nao2_cheio_vazio" value="NÃO" onclick="clicou_nao_justificar_sirene();">
</div>


<div id="div_justificativa_sirene"  >
<label id='lb_justificativa'>ATENÇÃO!</label>
<label id='lb_parecer_justificativa'>Insira um parecer sobre o evento:</label>
<textarea id='valor_parecer' name='valor_parecer' cols="40" rows="6"></textarea>
<input type="button" id="salvar_justificativa" name="salvar_justificativa" value="Salvar" onclick="clicou_salvar_justificativa_sirene('sirene_ccl_mb');">
<input type="button" id="sair_justificativa" name="sair_justificativa" value="Cancelar" onclick="clicou_sair_justificativa_sirene();">

</div>



</div> <!--Fecha a DIV sirene-->










<div id="div_filtrar_cheio_vazio">
<label id="lb_filtro1">Selecione os filtros desejados:</label>
<label id="lb_filtro2">Seleção das câmeras:</label>
<input type="checkbox" id="ckb_1" name="ckb_1" checked>
<label id="lb_filtro2_1">CAM Entrada ROM</label>

<input type="checkbox" id="ckb_2" name="ckb_2" checked>
<label id="lb_filtro2_2">CAM Saída ROM</label>

<input type="checkbox" id="ckb_3" name="ckb_3" checked>
<label id="lb_filtro2_3">CAM Saída Alternativa ROM</label>


<label id="lb_filtro3">Seleção da detecção:</label>
<input type="checkbox" id="ckb_4" name="ckb_4" checked>
<label id="lb_filtro3_1">Detectado Cheio</label>
<input type="checkbox" id="ckb_5" name="ckb_5" checked>
<label id="lb_filtro3_2">Detectado Vazio</label>


<label id="lb_filtro4">Seleção do parecer:</label>
<input type="checkbox" id="ckb_6" name="ckb_6" checked>
<label id="lb_filtro4_1">Justificados</label>
<input type="checkbox" id="ckb_7" name="ckb_7" checked>
<label id="lb_filtro4_2">Não justificados</label>





<input type="button" id="salvar_filtro" name="salvar_filtro" value="Salvar" onclick="clicou_salvar_filtro_cheio_vazio(`${ref1.value}`);">
<input type="button" id="sair_filtro" name="sair_filtro" value="Cancelar" onclick="clicou_sair_filtro_cheio_vazio();">

</div>










<div id="div_filtrar_outros_veiculos">
<label id="outros_veiculos_lb_filtro1">Selecione os filtros desejados:</label>
<label id="outros_veiculos_lb_filtro2">Seleção das câmeras:</label>
<input type="checkbox" id="outros_veiculos_ckb_1" name="outros_veiculos_ckb_1" checked>
<label id="outros_veiculos_lb_filtro2_1">CAM Pátio CCL</label>

<input type="checkbox" id="outros_veiculos_ckb_2" name="outros_veiculos_ckb_2" checked>
<label id="outros_veiculos_lb_filtro2_2">CAM Abertura I e II</label>

<label id="outros_veiculos_lb_filtro4">Seleção do parecer:</label>
<input type="checkbox" id="outros_veiculos_ckb_6" name="outros_veiculos_ckb_6" checked>
<label id="outros_veiculos_lb_filtro4_1">Justificados</label>
<input type="checkbox" id="outros_veiculos_ckb_7" name="outros_veiculos_ckb_7" checked>
<label id="outros_veiculos_lb_filtro4_2">Não justificados</label>

<input type="button" id="outros_veiculos_salvar_filtro" name="outros_veiculos_salvar_filtro" value="Salvar" onclick="clicou_salvar_filtro_outros_veiculos(`${ref1.value}`);">
<input type="button" id="outros_veiculos_sair_filtro" name="outros_veiculos_sair_filtro" value="Cancelar" onclick="clicou_sair_filtro_outros_veiculos();">

</div>














<script>


function cheio_vazio_clicou_filtrar()
{
 document.getElementById('div_filtrar_cheio_vazio').style.display = 'block';
}

function outros_veiculos_clicou_filtrar()
{
 document.getElementById('div_filtrar_outros_veiculos').style.display = 'block';
}







function clicou_salvar_filtro_cheio_vazio()
{
//alert('salvar');
var val_cheio_vazio = "";
var val_cameras = "";
var valor_parecer = "";

//Verifica o filtro das cargas
if (document.getElementById('ckb_4').checked == true && document.getElementById('ckb_5').checked == true)
{
 val_cheio_vazio = "todos";
}
else if (document.getElementById('ckb_4').checked == true && document.getElementById('ckb_5').checked == false)
{
  val_cheio_vazio = "apenas_cheio";
}

else if (document.getElementById('ckb_4').checked == false && document.getElementById('ckb_5').checked == true)
{
  val_cheio_vazio = "apenas_vazio";
}

//CAMERAS
if (document.getElementById('ckb_1').checked == true && document.getElementById('ckb_2').checked == true && document.getElementById('ckb_3').checked == true)
{
 val_cameras = "todas";
}

else if (document.getElementById('ckb_1').checked == true && document.getElementById('ckb_2').checked == false && document.getElementById('ckb_3').checked == false)
{
 val_cameras = "ckb_1";
}
else if (document.getElementById('ckb_1').checked == false && document.getElementById('ckb_2').checked == true && document.getElementById('ckb_3').checked == false)
{
 val_cameras = "ckb_2";
}
else if (document.getElementById('ckb_1').checked == false && document.getElementById('ckb_2').checked == false && document.getElementById('ckb_3').checked == true)
{
 val_cameras = "ckb_3";
}

else if (document.getElementById('ckb_1').checked == true && document.getElementById('ckb_2').checked == true && document.getElementById('ckb_3').checked == false)
{
 val_cameras = "ckb_1,ckb_2";
}
else if (document.getElementById('ckb_1').checked == true && document.getElementById('ckb_2').checked == false && document.getElementById('ckb_3').checked == true)
{
 val_cameras = "ckb_1,ckb_3";
}
else if (document.getElementById('ckb_1').checked == false && document.getElementById('ckb_2').checked == true && document.getElementById('ckb_3').checked == true)
{
 val_cameras = "ckb_2,ckb_3";
}

//VERIFICA A CONDIÇÃO DO PARECER
if (document.getElementById('ckb_6').checked == true && document.getElementById('ckb_7').checked == true)
{
 val_parecer = "todos";
}
else if (document.getElementById('ckb_6').checked == true && document.getElementById('ckb_7').checked == false)
{
 val_parecer = "ckb_6";
}
else
{
 val_parecer = "ckb_7;"
}



//alert(val_cameras);
//alert(val_cheio_vazio);

document.getElementById('lb_cheio_vazio').innerHTML = val_cheio_vazio;
document.getElementById('lb_cameras').innerHTML = val_cameras;
document.getElementById('lb_parecer').innerHTML = val_parecer;

var resp_cheio_vazio = document.getElementById('lb_cheio_vazio');
var resp_cameras = document.getElementById('lb_cameras');
var resp_parecer = document.getElementById('lb_parecer');

resp_cheio_vazio = resp_cheio_vazio.innerHTML;
resp_cameras = resp_cameras.innerHTML;
resp_parecer = resp_parecer.innerHTML;

var link_complemento = window.document.getElementById('lb_complemento');
link_complemento = link_complemento.innerHTML;
var link_check = window.document.getElementById('lb_check');
link_check = link_check.innerHTML;

var link_data = window.document.getElementById('data2');
link_data = link_data.value;

//alert(resp_cameras);
document.getElementById('div_filtrar_cheio_vazio').style.display = 'none';
location.href=`tela_va_ocr_cheio_vazio.php?complemento=${criptografia2.value}&check=${criptografia.value}&data=`+link_data+`&complemento=`+link_complemento+`&check=`+ link_check+`&cameras=`+resp_cameras+`&status=`+resp_cheio_vazio+`&parecer=`+resp_parecer;

}





function clicou_salvar_filtro_outros_veiculos()
{
 //alert('salvar');
 var val_cameras_outros_veiculos = "";
 var val_parecer_outros_veiculos = "";

 //CAMERAS
 if (document.getElementById('outros_veiculos_ckb_1').checked == true && document.getElementById('outros_veiculos_ckb_2').checked == true)
 {
  val_cameras_outros_veiculos = "todas";
 }
 else if (document.getElementById('outros_veiculos_ckb_1').checked == true && document.getElementById('outros_veiculos_ckb_2').checked == false)
 {
  val_cameras_outros_veiculos = "outros_veiculos_ckb_1";
 }
 else 
 {
  val_cameras_outros_veiculos = "outros_veiculos_ckb_2";
 }
 
 //VERIFICA A CONDIÇÃO DO PARECER
 if (document.getElementById('outros_veiculos_ckb_6').checked == true && document.getElementById('outros_veiculos_ckb_7').checked == true)
 {
  val_parecer_outros_veiculos = "todos";
 }
 else if (document.getElementById('outros_veiculos_ckb_6').checked == true && document.getElementById('outros_veiculos_ckb_7').checked == false)
 {
  val_parecer_outros_veiculos = "outros_veiculos_ckb_6";
 }
 else
 {
  val_parecer_outros_veiculos = "outros_veiculos_ckb_7";
 }

 document.getElementById('lb_cameras_outros_veiculos').innerHTML = val_cameras_outros_veiculos;
 document.getElementById('lb_parecer_outros_veiculos').innerHTML = val_parecer_outros_veiculos;

 var resp_cameras_outros_veiculos = document.getElementById('lb_cameras_outros_veiculos');
 var resp_parecer_outros_veiculos = document.getElementById('lb_parecer_outros_veiculos');
 var resp_cameras = document.getElementById('lb_cameras');
 var resp_parecer = document.getElementById('lb_parecer');
 var resp_cheio_vazio = document.getElementById('lb_cheio_vazio');

 resp_cameras_outros_veiculos = resp_cameras_outros_veiculos.innerHTML;
 resp_parecer_outros_veiculos = resp_parecer_outros_veiculos.innerHTML;

 resp_cameras = resp_cameras.innerHTML;
 resp_parecer = resp_parecer.innerHTML;
 resp_cheio_vazio = resp_cheio_vazio.innerHTML;

 var link_complemento = window.document.getElementById('lb_complemento');
 link_complemento = link_complemento.innerHTML;
 var link_check = window.document.getElementById('lb_check');
 link_check = link_check.innerHTML;

 var link_data = window.document.getElementById('data2');
 link_data = link_data.value;

 //alert(resp_cameras);


 document.getElementById('div_filtrar_outros_veiculos').style.display = 'none';
 location.href=`tela_va_ocr_cheio_vazio.php?complemento=${criptografia2.value}&check=${criptografia.value}&data=`+link_data+`&complemento=`+link_complemento+`&check=`+link_check+`&status=`+resp_cheio_vazio+`&cameras=`+resp_cameras+`&cameras_outros_veiculos=`+resp_cameras_outros_veiculos+`&parecer=`+resp_parecer+`&parecer_outros_veiculos=`+resp_parecer_outros_veiculos;

}









function clicou_sair_filtro_cheio_vazio()
{
  //alert('sair');
  document.getElementById('div_filtrar_cheio_vazio').style.display = 'none';
}


function clicou_sair_filtro_outros_veiculos()
{
  //alert('sair');
  document.getElementById('div_filtrar_outros_veiculos').style.display = 'none';
}


//  CHAMA AS TELAS DE ACORDO COM O BOTAO CLICADO ********************************************************
//  CHAMA AS TELAS DE ACORDO COM O BOTAO CLICADO ********************************************************
//  CHAMA AS TELAS DE ACORDO COM O BOTAO CLICADO ********************************************************
//  CHAMA AS TELAS DE ACORDO COM O BOTAO CLICADO ********************************************************
//  CHAMA AS TELAS DE ACORDO COM O BOTAO CLICADO ********************************************************
//  CHAMA AS TELAS DE ACORDO COM O BOTAO CLICADO ********************************************************
function clicou_cheio_vazio()
{

    //alert('relatorio');
    document.getElementById('v_cheio_vazio').style.display = 'block';
    document.getElementById('v_outros_veiculos').style.display = 'none';
    document.getElementById('v_radar').style.display = 'none';
    document.getElementById('v_relatorio').style.display = 'none';
    document.getElementById('v_dashboard').style.display = 'none';
    document.getElementById('v_configuracoes').style.display = 'none';
    document.getElementById('v_descartados').style.display = 'none';
    document.getElementById('v_sirene').style.display = 'none';
    document.getElementById('div_info_zerar_cheio_vazio').style.display='none'; // inicia ocultando div zerar
    document.getElementById('div_descartar_placa').style.display='none'; // inicia ocultando div zerar
    document.getElementById('div_info_zerar_outros_veiculos').style.display='none'; // inicia ocultando div zerar
    document.getElementById('div_justificar_cheio_vazio').style.display='none'; // inicia ocultando div justificar
    document.getElementById('div_justificar_outros_veiculos').style.display='none'; // inicia ocultando div justificar
    document.getElementById('parecer_padrao_entrada').style.display = 'none';
    document.getElementById('parecer_padrao_saida').style.display = 'none';
    document.getElementById('div_calendario').style.display = 'none'; // inicia calendario oculto
    document.getElementById('div_justificativa_cheio_vazio').style.display = 'none';// Inicia a tela justificativa oculta
    document.getElementById('div_justificativa_outros_veiculos').style.display = 'none';// Inicia a tela justificativa oculta
    document.getElementById('div_filtrar_cheio_vazio').style.display = 'none'; // Inicia tela do filtro escondida
    document.getElementById('div_filtrar_outros_veiculos').style.display = 'none'; // Inicia tela do filtro escondida
    document.getElementById('btn_salvar_editar_cheio_vazio').style.display = 'none';
    document.getElementById('btn_editar_cheio_vazio').style.display = 'none';
    document.getElementById('btn_editar_outros_veiculos').style.display = 'none';
    document.getElementById('btn_salvar_editar_outros_veiculos').style.display = 'none';
    document.getElementById('btn_editar_radar').style.display = 'none';
    document.getElementById('btn_salvar_editar_radar').style.display = 'none';
    
}

function clicou_outros_veiculos()
{

    //alert('relatorio');
    document.getElementById('v_cheio_vazio').style.display = 'none';
    document.getElementById('v_outros_veiculos').style.display = 'block';
    document.getElementById('v_radar').style.display = 'none';
    document.getElementById('v_relatorio').style.display = 'none';
    document.getElementById('v_dashboard').style.display = 'none';
    document.getElementById('v_configuracoes').style.display = 'none';
    document.getElementById('v_descartados').style.display = 'none';
    document.getElementById('v_sirene').style.display = 'none';
}

function clicou_radar()
{

    //alert('relatorio');
    document.getElementById('v_cheio_vazio').style.display = 'none';
    document.getElementById('v_outros_veiculos').style.display = 'none';
    document.getElementById('v_radar').style.display = 'block';
    document.getElementById('v_relatorio').style.display = 'none';
    document.getElementById('v_dashboard').style.display = 'none';
    document.getElementById('v_configuracoes').style.display = 'none';
    document.getElementById('v_descartados').style.display = 'none';
    document.getElementById('v_sirene').style.display = 'none';
}


function clicou_relatorio()
{

    //alert('relatorio');
    document.getElementById('v_cheio_vazio').style.display = 'none';
    document.getElementById('v_outros_veiculos').style.display = 'none';
    document.getElementById('v_radar').style.display = 'none';
    document.getElementById('v_relatorio').style.display = 'block';
    document.getElementById('v_dashboard').style.display = 'none';
    document.getElementById('v_configuracoes').style.display = 'none';
    document.getElementById('v_descartados').style.display = 'none';
    document.getElementById('v_sirene').style.display = 'none';

    //$("#v_relatorio").load("tela_deteccoes_cheio_vazio_mb.php");
    //Oculta
    
    
    
}

function clicou_dashboard()
{
  document.getElementById('v_cheio_vazio').style.display = 'none';
  document.getElementById('v_outros_veiculos').style.display = 'none';
  document.getElementById('v_radar').style.display = 'none';
  document.getElementById('v_relatorio').style.display = 'none';
  document.getElementById('v_dashboard').style.display = 'block';
  document.getElementById('v_configuracoes').style.display = 'none';
  document.getElementById('v_descartados').style.display = 'none';
  document.getElementById('v_sirene').style.display = 'none';
  
  //alert('dashboard');
  //document.getElementById('tabela').style.display = 'block'; // Mostra div tabela
  //Oculta

   
}



function clicou_configuracoes()
{
  //alert('relatorio');
  document.getElementById('v_cheio_vazio').style.display = 'none';
  document.getElementById('v_outros_veiculos').style.display = 'none';
  document.getElementById('v_radar').style.display = 'none';
  document.getElementById('v_relatorio').style.display = 'none';
  document.getElementById('v_dashboard').style.display = 'none';
  document.getElementById('v_configuracoes').style.display = 'block';
  document.getElementById('v_descartados').style.display = 'none';
  document.getElementById('v_sirene').style.display = 'none';
}


function clicou_descartados()
{
  //alert('relatorio');
  document.getElementById('v_cheio_vazio').style.display = 'none';
  document.getElementById('v_outros_veiculos').style.display = 'none';
  document.getElementById('v_radar').style.display = 'none';
  document.getElementById('v_relatorio').style.display = 'none';
  document.getElementById('v_dashboard').style.display = 'none';
  document.getElementById('v_configuracoes').style.display = 'none';
  document.getElementById('v_descartados').style.display = 'block';
  document.getElementById('v_sirene').style.display = 'none';
}

function clicou_sirene()
{
  //alert('relatorio');
  document.getElementById('v_cheio_vazio').style.display = 'none';
  document.getElementById('v_outros_veiculos').style.display = 'none';
  document.getElementById('v_radar').style.display = 'none';
  document.getElementById('v_relatorio').style.display = 'none';
  document.getElementById('v_dashboard').style.display = 'none';
  document.getElementById('v_configuracoes').style.display = 'none';
  document.getElementById('v_descartados').style.display = 'none';
  document.getElementById('v_sirene').style.display = 'block';
}



</script>











<div id='div_calendario' class="app-container" ng-app="dateTimeApp" ng-controller="dateTimeCtrl as ctrl" ng-cloak>
		
        <div date-picker
             datepicker-title="Selecione a data desejada"
             picktime="true"
             pickdate="true"
             pickpast="true"
             mondayfirst="true"
             custom-message="Você selecionou"
             selecteddate="ctrl.selected_date"
             updatefn="ctrl.updateDate(newdate)">
             
            <div class="datepicker"
                 ng-class="{
                    'am': timeframe == 'am',
                    'pm': timeframe == 'pm',
                    'compact': compact
                }">
                <div class="datepicker-header">
                    <div class="datepicker-title" ng-if="datepicker_title">{{ datepickerTitle }}</div>
                    <div class="datepicker-subheader" id="data">{{ customMessage }} {{ selectedDay }}, {{ localdate.getDate() }} de {{ monthNames[localdate.getMonth()] }} de {{ localdate.getFullYear() }}</div>
                </div>
                <div class="datepicker-calendar">
                    <div class="calendar-header">
                        <div class="goback" ng-click="moveBack()" ng-if="pickdate">
                            <svg width="30" height="30">
                                <path fill="none" stroke="#1C1C1C" stroke-width="3" d="M19,6 l-9,9 l9,9"/>
                            </svg>
                        </div>
                        <div class="current-month-container">{{ currentViewDate.getFullYear() }} {{ currentMonthName() }}</div>
                        <div class="goforward" ng-click="moveForward()" ng-if="pickdate">
                            <svg width="30" height="30">
                                <path fill="none" stroke="#1C1C1C" stroke-width="3" d="M11,6 l9,9 l-9,9" />
                            </svg>
                        </div>
                    </div>
                    <div class="calendar-day-header">
                        <span ng-repeat="day in days" class="day-label">{{ day.short }}</span>
                    </div>
                    <div class="calendar-grid" ng-class="{false: 'no-hover'}[pickdate]">
                        <div
                            ng-class="{'no-hover': !day.showday}"
                            ng-repeat="day in month"
                            class="datecontainer"
                            ng-style="{'margin-left': calcOffset(day, $index)}"
                            track by $index>
                            <div class="datenumber" ng-class="{'day-selected': day.selected }" ng-click="selectDate(day)">
                                {{ day.daydate }}
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timepicker" ng-if="picktime == 'true'">
                    <div ng-class="{'am': timeframe == 'am', 'pm': timeframe == 'pm' }">
                        <div class="timepicker-container-outer" selectedtime="time" timetravel>
                            <div class="timepicker-container-inner">
                                <div class="timeline-container" ng-mousedown="timeSelectStart($event)" sm-touchstart="timeSelectStart($event)">
                                    <div class="current-time">
                                        <div class="actual-time">{{ time }}</div>
                                    </div>
                                    <div class="timeline">
                                    </div>
                                    <div class="hours-container">
                                        <div class="hour-mark" ng-repeat="hour in getHours() track by $index"></div>
                                    </div>
                                </div>
                                <div class="display-time">
                                    <div class="decrement-time" ng-click="adjustTime('decrease')">
                                        <svg width="24" height="24">
                                            <path stroke="white" stroke-width="2" d="M8,12 h8"/>
                                        </svg>
                                    </div>
                                    <div class="time" ng-class="{'time-active': edittime.active}">
                                        <input type="text" class="time-input" ng-model="edittime.input" ng-keydown="changeInputTime($event)" ng-focus="edittime.active = true; edittime.digits = [];" ng-blur="edittime.active = false"/>
                                        <div class="formatted-time">{{ edittime.formatted }}</div>
                                    </div>
                                    <div class="increment-time" ng-click="adjustTime('increase')">
                                        <svg width="24" height="24">
                                            <path stroke="white" stroke-width="2" d="M12,7 v10 M7,12 h10"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="am-pm-container">
                                    <div class="am-pm-button" ng-click="changetime('am');">am</div>
                                    <div class="am-pm-button" ng-click="changetime('pm');">pm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="buttons-container">
                    <div class="cancel-button"onclick="clicou_cancelar();">Cancelar</div>
                    <div class="save-button"onclick="clicou_selecionar();">Selecionar </div>
                </div>
                
            </div>
        </div>
    </div>






<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<div id="div_info_zerar_cheio_vazio"  >
<label id='lb_info_zerar2'>ATENÇÃO!</label>
<label id='lb_info_zerar'>Deseja confirmar que este evento é uma detecção falsa?</label>
<input type="button" id="sim" name="sim" value="SIM" onclick="clicou_sim_cheio_vazio(`${ref1.value}`);">
<input type="button" id="nao" name="nao" value="NÃO" onclick="clicou_nao_cheio_vazio();">
</div>


<div id="div_descartar_placa"  >
<label id='lb_info_zerar2'>ATENÇÃO!</label>
<label id='lb_info_zerar'>Deseja descartar essa placa do sistema?</label>
<input type="button" id="sim" name="sim" value="SIM" onclick="clicou_sim_descartar_placa(`${ref1.value}`);">
<input type="button" id="nao" name="nao" value="NÃO" onclick="clicou_nao_descartar_placa();">
</div>


<div id="div_info_zerar_outros_veiculos"  >
<label id='lb_info_zerar2'>ATENÇÃO!</label>
<label id='lb_info_zerar'>Deseja confirmar que este evento é uma detecção falsa?</label>
<input type="button" id="sim" name="sim" value="SIM" onclick="clicou_sim_outros_veiculos(`${ref1.value}`);">
<input type="button" id="nao" name="nao" value="NÃO" onclick="clicou_nao_outros_veiculos();">
</div>



<div id="div_justificar_cheio_vazio"  >
<label id='lb_info_justificar2'>ATENÇÃO!</label>
<label id='lb_info_justificar'>Deseja justificar este evento?</label>
<input type="button" id="sim2_cheio_vazio" name="sim2_cheio_vazio" value="SIM" onclick="clicou_sim_justificar_cheio_vazio(`${ref1.value}`);">
<input type="button" id="nao2_cheio_vazio" name="nao2_cheio_vazio" value="NÃO" onclick="clicou_nao_justificar_cheio_vazio();">
</div>

<div id="div_justificar_outros_veiculos"  >
<label id='lb_info_justificar2'>ATENÇÃO!</label>
<label id='lb_info_justificar'>Deseja justificar este evento?</label>
<input type="button" id="sim2_outros_veiculos" name="sim2_outros_veiculos" value="SIM" onclick="clicou_sim_justificar_outros_veiculos(`${ref1.value}`);">
<input type="button" id="nao2_outros_veiculos" name="nao2_outros_veiculos" value="NÃO" onclick="clicou_nao_justificar_outros_veiculos();">
</div>



<div id="div_justificativa_cheio_vazio"  >
<label id='lb_justificativa'>ATENÇÃO!</label>
<label id='lb_parecer_justificativa'>Insira um parecer sobre o evento:</label>
<textarea id='valor_parecer_cheio_vazio' name='valor_parecer_cheio_vazio' cols="40" rows="6"></textarea>
<input type="button" id="salvar_justificativa" name="salvar_justificativa" value="Salvar" onclick="clicou_salvar_justificativa_cheio_vazio(`${ref1.value}`);">
<input type="button" id="parecer_padrao_entrada" name="parecer_padrao_entrada" value="Erro OCR" onclick="clicou_parecer_entrada_cheio_vazio();">
<input type="text" id="erro_ocr" name="erro_ocr" value="VAZIO" hidden="hidden"/>
<input type="button" id="parecer_padrao_saida" name="parecer_padrao_saida" value="Padrão" onclick="clicou_parecer_saida_cheio_vazio();">
<input type="button" id="sair_justificativa" name="sair_justificativa" value="Cancelar" onclick="clicou_sair_justificativa_cheio_vazio();">

</div>



<div id="div_justificativa_outros_veiculos"  >
<label id='lb_justificativa'>ATENÇÃO!</label>
<label id='lb_parecer_justificativa'>Insira um parecer sobre o evento:</label>
<textarea id='valor_parecer_outros_veiculos' name='valor_parecer_outros_veiculos' cols="40" rows="6"></textarea>
<input type="button" id="salvar_justificativa" name="salvar_justificativa" value="Salvar" onclick="clicou_salvar_justificativa_outros_veiculos(`${ref1.value}`);">
<input type="button" id="parecer_padrao_entrada" name="parecer_padrao_entrada" value="Padrão" hidden="hidden" onclick="clicou_parecer_entrada();">
<input type="button" id="parecer_padrao_saida" name="parecer_padrao_saida" value="Padrão" hidden="hidden"  onclick="clicou_parecer_saida();">
<input type="button" id="sair_justificativa" name="sair_justificativa" value="Cancelar" onclick="clicou_sair_justificativa_outros_veiculos();">

</div>








<script src='calendario/js/b.js'></script>
<script src='calendario/js/c.js'></script>

<script>
    var app = angular.module('dateTimeApp', []);

app.controller('dateTimeCtrl', function ($scope) {
	var ctrl = this;
	
	ctrl.selected_date = new Date();
	ctrl.selected_date.setHours(10);
	ctrl.selected_date.setMinutes(0);
	
	ctrl.updateDate = function (newdate) {
		
		// Do something with the returned date here.
		
		//console.log(newdate);
	};
});



// Date Picker
app.directive('datePicker', function ($timeout, $window) {
    
    return {
        restrict: 'AE',
        scope: {
            selecteddate: "=",
            updatefn: "&",
            open: "=",
            datepickerTitle: "@",
            customMessage: "@",
            picktime: "@",
            pickdate: "@",
            pickpast: '=',
			mondayfirst: '@'
        },
		transclude: true,
        link: function (scope, element, attrs, ctrl, transclude) {
			transclude(scope, function(clone, scope) {
				element.append(clone);
			});
			
            if (!scope.selecteddate) {
                scope.selecteddate = new Date();
            }

            if (attrs.datepickerTitle) {
                scope.datepicker_title = attrs.datepickerTitle;
            }

            scope.days = [
                { "long":"Domingo","short":"Dom" },
                { "long":"Segunda","short":"Seg" },
                { "long":"Terça","short":"Ter" },
                { "long":"Quarta","short":"Qua" },
                { "long":"Quinta","short":"Qui" },
                { "long":"Sexta","short":"Sex" },
                { "long":"Sabado","short":"Sab" },
            ];
			if (scope.mondayfirst == 'true') {
				var sunday = scope.days[0];
				scope.days.shift();
				scope.days.push(sunday);
			}

            scope.monthNames = [
                "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];

            function getSelected() {
                if (scope.currentViewDate.getMonth() == scope.localdate.getMonth()) {
                    if (scope.currentViewDate.getFullYear() == scope.localdate.getFullYear()) {
                        for (var number in scope.month) {
                            if (scope.month[number].daydate == scope.localdate.getDate()) {
                                scope.month[number].selected = true;
								if (scope.mondayfirst == 'true') {
									if (parseInt(number) === 0) {
										number = 6;
									} else {
										number = number - 1;
									}
								}
								scope.selectedDay = scope.days[scope.month[number].dayname].long;
							}
                        }
                    }
                }
            }

            function getDaysInMonth() {
                var month = scope.currentViewDate.getMonth();
                var date = new Date(scope.currentViewDate.getFullYear(), month, 1);
                var days = [];
                var today = new Date();
                while (date.getMonth() === month) {
                    var showday = true;
                    if (!scope.pickpast && date < today) {
                        showday = false;
                    }
                    if (today.getDate() == date.getDate() &&
                        today.getYear() == date.getYear() &&
                        today.getMonth() == date.getMonth()) {
                        showday = true;
                    }
                    var day = new Date(date);
                    var dayname = day.getDay();
                    var daydate = day.getDate();
                    days.push({ 'dayname': dayname, 'daydate': daydate, 'showday': showday });
                    date.setDate(date.getDate() + 1);
                }
                scope.month = days;
                
            }

            function initializeDate() {
                scope.currentViewDate = new Date(scope.localdate);
                scope.currentMonthName = function () {
                    return scope.monthNames[scope.currentViewDate.getMonth()];
                };
                getDaysInMonth();
                getSelected();
            }

            // Takes selected time and date and combines them into a date object
            function getDateAndTime(localdate) {
                var time = scope.time.split(':');
                if (scope.timeframe == 'am' && time[0] == '12') {
                    time[0] = 0;
                } else if (scope.timeframe == 'pm' && time[0] !== '12') {
                    time[0] = parseInt(time[0]) + 12;
                }
                return new Date(localdate.getFullYear(), localdate.getMonth(), localdate.getDate(), time[0], time[1]);                
            }

            // Convert to UTC to account for different time zones
            function convertToUTC(localdate) {
                var date_obj = getDateAndTime(localdate);
                var utcdate = new Date(date_obj.getUTCFullYear(), date_obj.getUTCMonth(), date_obj.getUTCDate(), date_obj.getUTCHours(), date_obj.getUTCMinutes());
                return utcdate;
            }
            // Convert from UTC to account for different time zones
            function convertFromUTC(utcdate) {
                localdate = new Date(utcdate);
                return localdate;
            }

            // Returns the format of time desired for the scheduler, Also I set the am/pm
            function formatAMPM(date) {
                
                var hours = date.getHours();
                var minutes = date.getMinutes();
                hours >= 12 ? scope.changetime('pm') : scope.changetime('am');
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var strTime = hours + ':' + minutes;
                return strTime;
            }
			
            scope.$watch('open', function() {
                if (scope.selecteddate !== undefined && scope.selecteddate !== null) {
                    scope.localdate = convertFromUTC(scope.selecteddate);
                } else {
                    scope.localdate = new Date();
                    scope.localdate.setMinutes(Math.round(scope.localdate.getMinutes() / 60) * 30);
                }
				scope.time = formatAMPM(scope.localdate);
				scope.setTimeBar(scope.localdate);
				initializeDate();
				scope.updateInputTime();
            });

            scope.selectDate = function (day) {
                
                if (scope.pickdate == "true" && day.showday) {
                    for (var number in scope.month) {
                        var item = scope.month[number];
                        if (item.selected === true) {
                            item.selected = false;
                        }
                    }
                    day.selected = true;
                    scope.selectedDay = scope.days[day.dayname].long;
                    scope.localdate = new Date(scope.currentViewDate.getFullYear(), scope.currentViewDate.getMonth(), day.daydate);
                    //alert(scope.localdate); //Exibe a data selecionada
                    initializeDate(scope.localdate);
                    scope.updateDate();
                }
            };

            scope.updateDate = function () {
                if (scope.localdate) {
                    var newdate = getDateAndTime(scope.localdate);
                    scope.updatefn({newdate:newdate});
                   
                }
            };

            scope.moveForward = function () {
                scope.currentViewDate.setMonth(scope.currentViewDate.getMonth() + 1);
                if (scope.currentViewDate.getMonth() == 12) {
                    scope.currentViewDate.setDate(scope.currentViewDate.getFullYear() + 1, 0, 1);
                }
                getDaysInMonth();
                getSelected();
            };

            scope.moveBack = function () {
                scope.currentViewDate.setMonth(scope.currentViewDate.getMonth() - 1);
                if (scope.currentViewDate.getMonth() == -1) {
                    scope.currentViewDate.setDate(scope.currentViewDate.getFullYear() - 1, 0, 1);
                }
                getDaysInMonth();
                getSelected();
            };

            scope.calcOffset = function (day, index) {
                if (index === 0) {
                    var offset = (day.dayname * 14.2857142) + '%';
					if (scope.mondayfirst == 'true') {
						offset = ((day.dayname - 1) * 14.2857142) + '%';
					}
                    return offset;
                }
            };
            
			///////////////////////////////////////////////
			// Check size of parent element, apply class //
			///////////////////////////////////////////////
			scope.checkWidth = function (apply) {
				var parent_width = element.parent().width();
				if (parent_width < 620) {
					scope.compact = true;
				} else {
					scope.compact = false;
				}
				if (apply) {
					scope.$apply();
				}
			};
			scope.checkWidth(false);
			
            //////////////////////
            // Time Picker Code //
            //////////////////////
            if (scope.picktime) {
                var currenttime;
                var timeline;
                var timeline_width;
                var timeline_container;
                var sectionlength;

                scope.getHours = function () {
                    var hours = new Array(11);
                    return hours;
                };

                scope.time = "12:00";
                scope.hour = 12;
                scope.minutes = 0;
                scope.currentoffset = 0;

                scope.timeframe = 'am';

                scope.changetime = function(time) {
                    scope.timeframe = time;
                    scope.updateDate();
					scope.updateInputTime();					
                };
				
				scope.edittime = {
					digits: []
				};
				
				scope.updateInputTime = function () {
					scope.edittime.input = scope.time + ' ' + scope.timeframe;
					scope.edittime.formatted = scope.edittime.input;
				};
				
				scope.updateInputTime();
				
				function checkValidTime (number) {
					validity = true;
					switch (scope.edittime.digits.length) {
						case 0:
							if (number === 0) {
								validity = false;
							}
							break;
						case 1:
							if (number > 5) {
								validity = false;
							} else {
								validity = true;
							}
							break;
						case 2:
							validity = true;
							break;
						case 3:
							if (scope.edittime.digits[0] > 1) {
								validity = false;
							} else if (scope.edittime.digits[1] > 2) {
								validity = false;
							} else if (scope.edittime.digits[2] > 5) {
								validity = false;
							}
							else {
								validity = true;								
							}
							break;
						case 4:
							validity = false;
							break;
					}
					return validity;
				}
				
				function formatTime () {
					var time = "";
					if (scope.edittime.digits.length == 1) {
						time = "--:-" + scope.edittime.digits[0];
					} else if (scope.edittime.digits.length == 2) {
						time = "--:" + scope.edittime.digits[0] + scope.edittime.digits[1];
					} else if (scope.edittime.digits.length == 3) {
						time = "-" + scope.edittime.digits[0] + ':' + scope.edittime.digits[1] + scope.edittime.digits[2];
					} else if (scope.edittime.digits.length == 4) {
						time = scope.edittime.digits[0] + scope.edittime.digits[1].toString() + ':' + scope.edittime.digits[2] + scope.edittime.digits[3];
						console.log(time);
					}
					return time + ' ' + scope.timeframe;
				};
				
				scope.changeInputTime = function (event) {
					var numbers = {48:0,49:1,50:2,51:3,52:4,53:5,54:6,55:7,56:8,57:9};
					if (numbers[event.which] !== undefined) {
						if (checkValidTime(numbers[event.which])) {
							scope.edittime.digits.push(numbers[event.which]);
							console.log(scope.edittime.digits);
							scope.time_input = formatTime();
							scope.time = numbers[event.which] + ':00';
							scope.updateDate();
							scope.setTimeBar();
						}
					} else if (event.which == 65) {
						scope.timeframe = 'am';
						scope.time_input = scope.time + ' ' + scope.timeframe;
					} else if (event.which == 80) {
						scope.timeframe = 'pm';
						scope.time_input = scope.time + ' ' + scope.timeframe;
					} else if (event.which == 8) {
						scope.edittime.digits.pop();
						scope.time_input = formatTime();
						console.log(scope.edittime.digits);
					}
					scope.edittime.formatted = scope.time_input;
					// scope.edittime.input = formatted;
				};
				
                var pad2 = function (number) {
                    return (number < 10 ? '0' : '') + number;
                };
           
                scope.moving = false;
                scope.offsetx = 0;
                scope.totaloffset = 0;
                scope.initializeTimepicker = function () {
                    currenttime = $('.current-time');
                    timeline = $('.timeline');
                    if (timeline.length > 0) {
                        timeline_width = timeline[0].offsetWidth;
                    }
                    timeline_container = $('.timeline-container');
                    sectionlength = timeline_width / 24 / 6;
                };

                angular.element($window).on('resize', function () {
                    scope.initializeTimepicker();
                    if (timeline.length > 0) {
                        timeline_width = timeline[0].offsetWidth;
                    }
                    sectionlength = timeline_width / 24;
					scope.checkWidth(true);
                });
           
                scope.setTimeBar = function (date) {
					currenttime = $('.current-time');
					var timeline_width = $('.timeline')[0].offsetWidth;
                    var hours = scope.time.split(':')[0];
					if (hours == 12) {
						hours = 0;
					}
					var minutes = scope.time.split(':')[1];
					var minutes_offset = (minutes / 60) * (timeline_width / 12);
					var hours_offset = (hours / 12) * timeline_width;
					scope.currentoffset = parseInt(hours_offset + minutes_offset - 1);
                    currenttime.css({
						transition: 'transform 0.4s ease',
                        transform: 'translateX(' + scope.currentoffset + 'px)',
                    });
                };

                scope.getTime = function () {
                    // get hours
                    var percenttime = (scope.currentoffset + 1) / timeline_width;
                    var hour = Math.floor(percenttime * 12);
                    var percentminutes = (percenttime * 12) - hour;
					var minutes = Math.round((percentminutes * 60) / 5) * 5;
                    if (hour === 0) {
                        hour = 12;
                    }
					if (minutes == 60) {
						hour += 1;
						minutes = 0;
					}

                    scope.time = hour + ":" + pad2(minutes);
					scope.updateInputTime();
                    scope.updateDate();
                };
           
                var initialized = false;

                element.on('touchstart', function() {
                    if (!initialized) {
                        element.find('.timeline-container').on('touchstart', function (event) {
                            scope.timeSelectStart(event);
                        });
                        initialized = true;
                    }
                });

                scope.timeSelectStart = function (event) {
                    scope.initializeTimepicker();
                    var timepicker_container = element.find('.timepicker-container-inner');
					var timepicker_offset = timepicker_container.offset().left;
                    if (event.type == 'mousedown') {
                        scope.xinitial = event.clientX;
                    } else if (event.type == 'touchstart') {
                        scope.xinitial = event.originalEvent.touches[0].clientX;
                    }
                    scope.moving = true;
                    scope.currentoffset = scope.xinitial - timepicker_container.offset().left;
                    scope.totaloffset = scope.xinitial - timepicker_container.offset().left;
					console.log(timepicker_container.width());
					if (scope.currentoffset < 0) {
						scope.currentoffset = 0;
					} else if (scope.currentoffset > timepicker_container.width()) {
						scope.currentoffset = timepicker_container.width();
					}
					currenttime.css({
                        transform: 'translateX(' + scope.currentoffset + 'px)',
                        transition: 'none',
                        cursor: 'ew-resize',
                    });
                    scope.getTime();
                };
           
                angular.element($window).on('mousemove touchmove', function (event) {
                    if (scope.moving === true) {
                        event.preventDefault();
                        if (event.type == 'mousemove') {
                            scope.offsetx = event.clientX - scope.xinitial;
                        } else if (event.type == 'touchmove') {
                            scope.offsetx = event.originalEvent.touches[0].clientX - scope.xinitial;
                        }
                        var movex = scope.offsetx + scope.totaloffset;
                        if (movex >= 0 && movex <= timeline_width) {
                            currenttime.css({
                                transform: 'translateX(' + movex + 'px)',
                            });
                            scope.currentoffset = movex;
                        } else if (movex < 0) {
                            currenttime.css({
                                transform: 'translateX(0)',
                            });
                            scope.currentoffset = 0;
                        } else {
                            currenttime.css({
                                transform: 'translateX(' + timeline_width + 'px)',
                            });
                            scope.currentoffset = timeline_width;
                        }
                        scope.getTime();
                        scope.$apply();
                    }
                });
           
                angular.element($window).on('mouseup touchend', function (event) {
                    if (scope.moving) {
                        // var roundsection = Math.round(scope.currentoffset / sectionlength);
                        // var newoffset = roundsection * sectionlength;
                        // currenttime.css({
                        //     transition: 'transform 0.25s ease',
                        //     transform: 'translateX(' + (newoffset - 1) + 'px)',
                        //     cursor: 'pointer',
                        // });
                        // scope.currentoffset = newoffset;
                        // scope.totaloffset = scope.currentoffset;
                        // $timeout(function () {
                        //     scope.getTime();
                        // }, 250);
                    }
                    scope.moving = false;
                });

                scope.adjustTime = function (direction) {
                    event.preventDefault();
                    scope.initializeTimepicker();
                    var newoffset;
                    if (direction == 'decrease') {
                        newoffset = scope.currentoffset - sectionlength;
                    } else if (direction == 'increase') {
                        newoffset = scope.currentoffset + sectionlength;
                    }
                    if (newoffset < 0 || newoffset > timeline_width) {
                        if (newoffset < 0) {
                            newoffset = timeline_width - sectionlength;
                        } else if (newoffset > timeline_width) {
                            newoffset = 0 + sectionlength;
                        }
                        if (scope.timeframe == 'am') {
                            scope.timeframe = 'pm';
                        }
                        else if (scope.timeframe == 'pm') {
                            scope.timeframe = 'am';
                        }
                    }
                    currenttime.css({
                        transition: 'transform 0.4s ease',
                        transform: 'translateX(' + (newoffset - 1) + 'px)',
                    });
                    scope.currentoffset = newoffset;
                    scope.totaloffset = scope.currentoffset;
                    scope.getTime();
                };
            }
 
            // End Timepicker Code //

        }
    };
});

function clicou_selecionar(){
var info = document.getElementById('data');
var nome = document.getElementById('colaborador');
info = info.innerHTML;
const myArr = info.split(" ");
var dia_semana = myArr[2]; 
dia_semana = dia_semana.split(',');
dia_semana = dia_semana[0];//ok
var dia = myArr[3];//ok
var mes = myArr[5];//ok
var ano = myArr[7];//ok

if(dia.length == 1)
{
 dia = "0"+dia;
}

if(mes =="Janeiro"){mes="01";}
else if (mes=="Fevereiro"){mes="02";}
else if (mes=="Março"){mes="03";}
else if (mes=="Abril"){mes="04";}
else if (mes=="Maio"){mes="05";}
else if (mes=="Junho"){mes="06";}
else if (mes=="Julho"){mes="07";}
else if (mes=="Agosto"){mes="08";}
else if (mes=="Setembro"){mes="09";}
else if (mes=="Outubro"){mes="10";}
else if (mes=="Novembro"){mes="11";}
else {mes="12";}


document.getElementById('cheio_vazio_titulo').innerHTML = "VA Cheio/Vazio MB - Detecções realizadas em " + dia+"/"+mes+"/"+ano;


document.getElementById('menu').style.display='display';
//document.getElementById('tabela').style.display = 'display';
//alert(dia_semana+","+dia+"/"+mes+"/"+ano);
document.getElementById('div_calendario').style.display = 'none'; // oculta o calendario
document.getElementById('data2').value = dia+"/"+mes+"/"+ano;
document.getElementById('cheio_vazio_btn_calendario').style.display = 'block';


var resp_cheio_vazio = document.getElementById('lb_cheio_vazio');
var resp_cameras = document.getElementById('lb_cameras');
var resp_parecer = document.getElementById('lb_parecer');

resp_cheio_vazio = resp_cheio_vazio.innerHTML;
resp_cameras = resp_cameras.innerHTML;
resp_parecer = resp_parecer.innerHTML;

var link_complemento = window.document.getElementById('lb_complemento');
link_complemento = link_complemento.innerHTML;
var link_check = window.document.getElementById('lb_check');
link_check = link_check.innerHTML;

location.href=`tela_va_ocr_cheio_vazio.php?complemento=${criptografia2.value}&check=${criptografia.value}&data=${data2.value}&complemento=`+link_complemento+`&check=`+ link_check+`&cameras=`+resp_cameras+`&status=`+resp_cheio_vazio+`&parecer=`+resp_parecer;


}
function clicou_cancelar(){
    document.getElementById('div_calendario').style.display = 'none';
    document.getElementById('cheio_vazio_btn_calendario').style.display = 'block';

}
function cheio_vazio_clicou_exibir_calendario()
{

    document.getElementById('div_calendario').style.display = 'block';
    document.getElementById('cheio_vazio_btn_calendario').style.display = 'none';
}



</script>













<script>
    

  
  // INICIANDO O PROGRAMA SEMPRE COM TUDO OCULTO E EXIBINDO O CHEIO/VAZIO ******************************
  // INICIANDO O PROGRAMA SEMPRE COM TUDO OCULTO E EXIBINDO O CHEIO/VAZIO ******************************
  // INICIANDO O PROGRAMA SEMPRE COM TUDO OCULTO E EXIBINDO O CHEIO/VAZIO ******************************
  // INICIANDO O PROGRAMA SEMPRE COM TUDO OCULTO E EXIBINDO O CHEIO/VAZIO ******************************
  // INICIANDO O PROGRAMA SEMPRE COM TUDO OCULTO E EXIBINDO O CHEIO/VAZIO ******************************

  //alert('relatorio');
  document.getElementById('v_outros_veiculos').style.display = 'none';
  document.getElementById('v_radar').style.display = 'none';
  document.getElementById('v_relatorio').style.display = 'none';
  document.getElementById('v_dashboard').style.display = 'none';
  document.getElementById('v_configuracoes').style.display = 'none';
  document.getElementById('v_descartados').style.display = 'none';
  document.getElementById('v_sirene').style.display = 'none';
  document.getElementById('v_cheio_vazio').style.display = 'block'; // Exibe a tela
  document.getElementById('div_sirene').style.display="block";
  clicou_cheio_vazio();
  





    var ler_data_recebida = '<?php print $ler_data_recebida ?>';

    var lerdia = document.getElementById('data2');
    
    if(ler_data_recebida =="nao_tem_data_passsada")
    {
      if(lerdia.value =="vazio")
      {
        //alert('esta vazio');
        //alert(valor_dia);
        var link = document.getElementById('data2'); // Atribui a data ao textbox da data
        link.value = valor_dia;
        var link2 = document.getElementById('data2'); // Atribui a data ao textbox da data
        link2 = link2.value;
        //alert(link2);
      }
      else
      {
        //alert('tem data');
        var dia = '<?php print $data ?>';
        document.getElementById('data2').value = dia; // Atribui a data ao textbox da data
      }
    }
    else
    {
      //alert('tem data2');
      var dia = '<?php print $data ?>';
      document.getElementById('data2').value = dia; // Atribui a data ao textbox da data
    }
    
    var link_cameras = '<?php print $link_cameras ?>';
    var link_cameras_outros_veiculos = '<?php print $link_cameras_outros_veiculos ?>';
    var link_status = '<?php print $link_status ?>';
    var link_parecer = '<?php print $link_parecer ?>';
    var link_parecer_outros_veiculos = '<?php print $link_parecer_outros_veiculos ?>';
    var link_visualizar = '<?php print $link_visualizar ?>';
    document.getElementById('lb_visualizar').innerHTML = link_visualizar;
    document.getElementById('lb_cheio_vazio').innerHTML = link_status;
    document.getElementById('lb_cameras').innerHTML = link_cameras;
    document.getElementById('lb_cameras_outros_veiculos').innerHTML = link_cameras_outros_veiculos;
    document.getElementById('lb_parecer').innerHTML = link_parecer;
    document.getElementById('lb_parecer_outros_veiculos').innerHTML = link_parecer_outros_veiculos;


//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************
//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************
//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************
//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************
//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************
//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************
//TRATA O QUE FAZER VISUALIZAR **************************************************************************************************************


if (link_visualizar == "principal")
{ 
 clicou_cheio_vazio();
}
else if(link_visualizar == "bloqueados")
{
 clicou_outros_veiculos();
}
else
{
//Faz nada!
}



















    if(link_cameras == "todas")
    {
      //alert('todas');
      document.getElementById('ckb_1').checked = true;
      document.getElementById('ckb_2').checked = true;
      document.getElementById('ckb_3').checked = true;
    }
    else if(link_cameras == "ckb_1")
    {
      //alert('ckb_1');
      document.getElementById('ckb_1').checked = true;
      document.getElementById('ckb_2').checked = false;
      document.getElementById('ckb_3').checked = false;
    }
    else if(link_cameras == "ckb_2")
    {
      //alert('ckb_2');
      document.getElementById('ckb_1').checked = false;
      document.getElementById('ckb_2').checked = true;
      document.getElementById('ckb_3').checked = false;
    }
    else if(link_cameras == "ckb_3")
    {
      //alert('ckb_3');
      document.getElementById('ckb_1').checked = false;
      document.getElementById('ckb_2').checked = false;
      document.getElementById('ckb_3').checked = true;
    }
    else if(link_cameras == "ckb_1,ckb_2")
    {
      //alert('ckb_1,ckb_2');
      document.getElementById('ckb_1').checked = true;
      document.getElementById('ckb_2').checked = true;
      document.getElementById('ckb_3').checked = false;
    }
    else if(link_cameras == "ckb_1,ckb_3")
    {
      //alert('ckb_1,ckb_3');
      document.getElementById('ckb_1').checked = true;
      document.getElementById('ckb_2').checked = false;
      document.getElementById('ckb_3').checked = true;
    }
    else
    {
      //ckb_2,ckb_3
      //alert('ckb_2,ckb_3');
      document.getElementById('ckb_1').checked = false;
      document.getElementById('ckb_2').checked = true;
      document.getElementById('ckb_3').checked = true;
    }
    
    //AGORA TRATA A SELEÇÃO DO FILTRO PARA CHEIO/VAZIO
    if(link_status == "todos")
    {
      document.getElementById('ckb_4').checked = true;
      document.getElementById('ckb_5').checked = true;
    }
    else if(link_status == "apenas_cheio")
    {
      document.getElementById('ckb_4').checked = true;
      document.getElementById('ckb_5').checked = false;
    }
    else
    {
      //Apenas vazio
      document.getElementById('ckb_4').checked = false;
      document.getElementById('ckb_5').checked = true;
    } 

    //AGORA TRATA A SELEÇÃO DO PARECER
    if(link_parecer == "todos")
    {
      document.getElementById('ckb_6').checked = true;
      document.getElementById('ckb_7').checked = true;
    }
    else if(link_parecer == "ckb_6")
    {
      document.getElementById('ckb_6').checked = true;
      document.getElementById('ckb_7').checked = false;
    }
    else
    {
      document.getElementById('ckb_6').checked = false;
      document.getElementById('ckb_7').checked = true;
    }

    // TRATANDO OS FILTRO PARA outros_veiculos
    if(link_cameras_outros_veiculos == "todas")
    {
      //alert('todas');
      document.getElementById('outros_veiculos_ckb_1').checked = true;
      document.getElementById('outros_veiculos_ckb_2').checked = true;
    }
    else if(link_cameras_outros_veiculos == "outros_veiculos_ckb_1")
    {
      //alert('outros_veiculos_ckb_1');
      document.getElementById('outros_veiculos_ckb_1').checked = true;
      document.getElementById('outros_veiculos_ckb_2').checked = false;
    }
    else
    {
      //alert('outros_veiculos_ckb_2');
      document.getElementById('outros_veiculos_ckb_1').checked = false;
      document.getElementById('outros_veiculos_ckb_2').checked = true;
    }
    //AGORA TRATA A SELEÇÃO DO PARECER outros_veiculos
    if(link_parecer_outros_veiculos == "todos")
    {
      document.getElementById('outros_veiculos_ckb_6').checked = true;
      document.getElementById('outros_veiculos_ckb_7').checked = true;
    }
    else if(link_parecer_outros_veiculos == "outros_veiculos_ckb_6")
    {
      document.getElementById('outros_veiculos_ckb_6').checked = true;
      document.getElementById('outros_veiculos_ckb_7').checked = false;
    }
    else
    {
      document.getElementById('outros_veiculos_ckb_6').checked = false;
      document.getElementById('outros_veiculos_ckb_7').checked = true;
    }
    
    //alert(link_cameras_outros_veiculos);

function clicou_sim_descartar_placa(link_video)
{
 //alert(link_video);
  var id = document.getElementById('ref1');
 id = id.value;
 var nome = document.getElementById('colaborador');
 nome = nome.innerHTML;
 const myArr2 = nome.split(":");
 nome = myArr2[1];
 var registro = document.getElementById('lb_registro');
 registro = registro.innerHTML;
 //alert(link_video);
 $.ajax({
           url: 'salvar_descartar_placa.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id,'registro': registro,'nome': nome},
           success: function(resultado){
             if(resultado == "salvo")
             {
			  document.getElementById('div_descartar_placa').style.display = 'none';
              document.getElementById("tabela").disabled = false;
			  alert("Placa descartada do sistema com sucesso!");
              document.location.reload(true);//recarrega a pagina!
             }
             else
             {
              alert('Ocorreu um erro ao descartar essa placa!');
			  alert(resultado);
             }
            }
          });
 

}

function clicou_sim_cheio_vazio(link_video)
{
 //alert(link_video);
  var id = document.getElementById('ref1');
 id = id.value;
 var nome = document.getElementById('colaborador');
 nome = nome.innerHTML;
 const myArr2 = nome.split(":");
 nome = myArr2[1];
 var registro = document.getElementById('lb_registro');
 registro = registro.innerHTML;
 var parecer = 'SIM'; // Para descartar o video no banco de dados
 //alert(link_video);
 $.ajax({
           url: 'salvar_deteccao_falsa_ocr_cheio_vazio.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id,'registro': registro,'nome': nome,'parecer': parecer},
           success: function(resultado){
             if(resultado == "salvo")
             {
              document.getElementById('div_info_zerar_cheio_vazio').style.display = 'none';
              document.getElementById("tabela").disabled = false;
              document.location.reload(true);//recarrega a pagina!
             }
             else
             {
              alert('Ocorreu um erro ao classificar o evento como detecção falsa!');
             }
            }
          });
 

}

function clicou_sim_outros_veiculos(link_video)
{
  var id = document.getElementById('ref1');
 id = id.value;
 var nome = document.getElementById('colaborador');
 nome = nome.innerHTML;
 const myArr2 = nome.split(":");
 nome = myArr2[1];
 var registro = document.getElementById('lb_registro');
 registro = registro.innerHTML;
 var parecer = 'SIM'; // Para descartar o video no banco de dados
 //alert(link_video);
 $.ajax({
           url: 'salvar_deteccao_falsa_ocr_outros_veiculos.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id,'registro': registro,'nome': nome,'parecer': parecer},
           success: function(resultado){
             if(resultado == "salvo")
             {
              document.getElementById('div_info_zerar_outros_veiculos').style.display = 'none';
              document.location.reload(true);//recarrega a pagina!
             }
             else
             {
              alert('Ocorreu um erro ao classificar o evento como detecção falsa!');
             }
            }
          });
 

}


function clicou_parecer_entrada_cheio_vazio() // Usado para marcar que ocorreu um erro de OCR!
{
 //alert('Clicou erro ORC!');
 var link_parecer = document.getElementById('valor_parecer_cheio_vazio');
 var link_erro_ocr = document.getElementById('erro_ocr'); // Marca ele como SIM!
 link_parecer.value = "A placa detectada está errada!";
 link_erro_ocr.value="XXX";
}

function clicou_parecer_saida_cheio_vazio()
{
 //alert('saida');
 var link_parecer = document.getElementById('valor_parecer_cheio_vazio');
 link_parecer.innerHTML = "Condição normal de saída do processo!";
}






function clicou_salvar_justificativa_cheio_vazio(link_video)
{
 //alert("clicou_salvar_justificativa_cheio_vazio")
 var parecer = document.getElementById('valor_parecer_cheio_vazio');
 parecer = parecer.value;
 var id = document.getElementById('ref1');
 id = id.value;
 var nome = document.getElementById('colaborador');
 nome = nome.innerHTML;
 const myArr2 = nome.split(":");
 nome = myArr2[1];
 var registro = document.getElementById('lb_registro');
 registro = registro.innerHTML;
 var erro_ocr = document.getElementById('erro_ocr');
 erro_ocr = (erro_ocr.value).trim();
 
 if(parecer == "")
 {
  var alertList = document.querySelectorAll('.alert')
  alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
  } )
 }
 else
 {
  //alert('entrou');
  //alert(parecer);
  $.ajax({
           url: 'salvar_parecer_ocr_cheio_vazio.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id,'registro': registro,'nome': nome,'parecer': parecer,'erro_ocr': erro_ocr},
           success: function(resultado){
             if(resultado == "salvo")
             {
              document.getElementById('div_justificativa_cheio_vazio').style.display = 'none';
              document.getElementById("tabela").disabled = false;
              //Antes de recarregar, limpar os dados da justificativa
              document.getElementById('valor_parecer_cheio_vazio').value = "";
              
              var link = document.getElementById(link_video);
              //vermelho
              //link.style="background-color:#DC143C";
              
              //verde
              link.style="background-color:#228B22"; 
              
              var erro_ocr = document.getElementById('erro_ocr');
              erro_ocr.value = ''; // Limpa proximo erro!
              
              //document.location.reload(true);//recarrega a pagina!
             }
             else
             {
              //alert("Ocorreu algum erro ao salvar!");
			        alert(resultado);
             }
           }
          });
 }
}


function clicou_salvar_justificativa_outros_veiculos(link_video)
{
 //alert('entrou');
 var parecer = document.getElementById('valor_parecer_outros_veiculos');
 parecer = parecer.value;
 var id = document.getElementById('ref1');
 id = id.value;
 var nome = document.getElementById('colaborador');
 nome = nome.innerHTML;
 const myArr2 = nome.split(":");
 nome = myArr2[1];
 var registro = document.getElementById('lb_registro');
 registro = registro.innerHTML;
 
 //alert(parecer);
 if(parecer == "")
 {
  var alertList = document.querySelectorAll('.alert')
  alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
  } )
  alert('erro');
 }
 else
 {
  //alert('entrou');
  $.ajax({
           url: 'salvar_parecer_ocr_outros_veiculos.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id,'registro': registro,'nome': nome,'parecer': parecer},
           success: function(resultado){
             if(resultado == "salvo")
             {
              document.getElementById('div_justificativa_outros_veiculos').style.visibility = 'hidden';
              //Antes de recarregar, limpar os dados da justificativa
              document.getElementById('valor_parecer_outros_veiculos').value = "";
              document.location.reload(true);//recarrega a pagina!
             }
             else
             {
              alert("Ocorreu algum erro ao salvar!");
             }
           }
          });
 }
}





function clicou_sair_justificativa_cheio_vazio()
{
 //alert("clicou_sair_justificativa");  
 var link_parecer = document.getElementById('valor_parecer');
 link_parecer.innerHTML = "";
 
 document.getElementById('div_justificativa_cheio_vazio').style.display = 'none';
 document.getElementById("tabela").disabled = false;
}



function clicou_sair_justificativa_outros_veiculos()
{
 //alert("clicou_sair_justificativa");  
 var link_parecer = document.getElementById('valor_parecer');
 link_parecer.innerHTML = "";
 
 document.getElementById('div_justificativa_outros_veiculos').style.display = 'none';
 
}














function clicou_sim_justificar_cheio_vazio(link_video)
{
 //alert("clicou_sim_justificar - ID: " + link_video);
 // Pesquisa se o parecer pode ser padrao!
 $.ajax({
           url: 'validar_parecer_cheio_vazio.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': link_video},
           success: function(resultado)
           {
            if(resultado == "entrada")
            {
              document.getElementById('parecer_padrao_entrada').style.display = 'block';
              document.getElementById('parecer_padrao_saida').style.display = 'none';
            }
            else if(resultado == "saida")
            {
              document.getElementById('parecer_padrao_entrada').style.display = 'none';
              document.getElementById('parecer_padrao_saida').style.display = 'block';
            }
            else
            {
              //Chegou erro
              document.getElementById('parecer_padrao_entrada').style.display = 'block'; // Usado para permitir marcar que foi erro OCR!
              document.getElementById('parecer_padrao_saida').style.display = 'none';
            }
           }
        });
           




 document.getElementById('div_justificar_cheio_vazio').style.display = 'none';
 document.getElementById("tabela").disabled = false;
 document.getElementById('div_justificativa_cheio_vazio').style.display = 'block';
}

function clicou_sim_justificar_outros_veiculos(link_video)
{
 //alert("clicou_sim_justificar");
 // Pesquisa se o parecer pode ser padrao!
 $.ajax({
           url: 'validar_parecer_outros_veiculos.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': link_video},
           success: function(resultado)
           {
            resultado == "erro"; // trava por enquanto pois nao temos parecer padrao para deteccoa de outros_veiculos ainda
            if(resultado == "abertura1e2")
            {
              //document.getElementById('parecer_padrao_entrada').style.display = 'block';
              //document.getElementById('parecer_padrao_saida').style.display = 'none';
            }
            else if(resultado == "patio_ccl")
            {
              //document.getElementById('parecer_padrao_entrada').style.display = 'none';
              //document.getElementById('parecer_padrao_saida').style.display = 'block';
            }
            else
            {
              //Chegou erro
              document.getElementById('parecer_padrao_entrada').style.display = 'none';
              document.getElementById('parecer_padrao_saida').style.display = 'none';
            }
           }
        });
           




 document.getElementById('div_justificar_outros_veiculos').style.display = 'none';
 document.getElementById('div_justificativa_outros_veiculos').style.display = 'block';
}



function clicou_nao_descartar_placa()
{
 //alert("clicou_nao");   
 
 document.getElementById('div_descartar_placa').style.display = 'none';
 document.getElementById("tabela").disabled = false;
}

function clicou_nao_cheio_vazio()
{
 //alert("clicou_nao");   
 
 document.getElementById('div_info_zerar_cheio_vazio').style.display = 'none';
 document.getElementById("tabela").disabled = false;
}


function clicou_nao_outros_veiculos()
{
 //alert("clicou_nao");   
 
 document.getElementById('div_info_zerar_outros_veiculos').style.display = 'none';
 
}







function clicou_nao_justificar_cheio_vazio()
{
 //alert("clicou_nao_justificar");   
 document.getElementById('div_justificar_cheio_vazio').style.display = 'none';
 document.getElementById("tabela").disabled = false;
}

function clicou_nao_justificar_outros_veiculos()
{
 //alert("clicou_nao_justificar");   
 document.getElementById('div_justificar_outros_veiculos').style.display = 'none';

}








function clicou_ativar_sirene_ccl()
{
  //alert("Clicou Ativar");
  document.getElementById('div_sirene').style.display="block";

}

function clicou_desativar_sirene_ccl()
{
  //alert("Clicou Desativar");
  document.getElementById('div_sirene').style.display="none";
}


function clicou_sim_justificar_sirene()
{
  //alert("Clicou Ativar");
  document.getElementById('div_sirene').style.display="none";
  document.getElementById('div_justificativa_sirene').style.display="block";

}

function clicou_nao_justificar_sirene()
{
  //alert("Clicou Desativar");
  document.getElementById('div_sirene').style.display="none";
}



function clicou_teste_audio_sirene1()
{
 //alert('entrou'); 
 var reproduzir = document.getElementById('audio_sirene1');
 reproduzir.play();
 var ref_audio = "sirene_ccl_mb";
 $.ajax({
           url: 'enviar_teste_audio.php',
           type: 'GET',
           dataType: 'json',
           data: {'ref_audio': ref_audio},
           success: function(resultado)
           {
            //alert(resultado); 
            var link_info = document.getElementById('ultimo_acionamento_sirene1');
            link_info.innerHTML = "<b>Último Acionamento : </b>"+resultado; 
           }
        });
 
}

function clicou_teste_rom1()
{
 //alert('entrou'); 
 var reproduzir = document.getElementById('audio_rom1');
 reproduzir.play();
 var ref_audio = "entrada_vazio_rom";
 $.ajax({
           url: 'enviar_teste_audio.php',
           type: 'GET',
           dataType: 'json',
           data: {'ref_audio': ref_audio},
           success: function(resultado)
           {
            //alert(resultado); 
            var link_info = document.getElementById('ultimo_acionamento_sirene_rom1');
            link_info.innerHTML = "<b>Atuado: </b>"+resultado; 
           }
        });

}
function clicou_teste_rom2()
{
 //alert('entrou'); 
 var reproduzir = document.getElementById('audio_rom2');
 reproduzir.play();
 var ref_audio = "saida_cheio_saida_rom";
 $.ajax({
           url: 'enviar_teste_audio.php',
           type: 'GET',
           dataType: 'json',
           data: {'ref_audio': ref_audio},
           success: function(resultado)
           {
            //alert(resultado); 
            var link_info = document.getElementById('ultimo_acionamento_sirene_rom2');
            link_info.innerHTML = "<b>Atuado: </b>"+resultado; 
           }
        });
}
function clicou_teste_rom3()
{
 //alert('entrou'); 
 var reproduzir = document.getElementById('audio_rom3');
 reproduzir.play();
 var ref_audio = "saida_cheio_saida_alternativa_rom";
 $.ajax({
           url: 'enviar_teste_audio.php',
           type: 'GET',
           dataType: 'json',
           data: {'ref_audio': ref_audio},
           success: function(resultado)
           {
            //alert(resultado); 
            var link_info = document.getElementById('ultimo_acionamento_sirene_rom3');
            link_info.innerHTML = "<b>Atuado: </b>"+resultado; 
           }
        });
 
}
function clicou_teste_rom4()
{
 //alert('entrou'); 
 var reproduzir = document.getElementById('audio_rom4');
 reproduzir.play();
 var ref_audio = "erro_gscs";
 $.ajax({
           url: 'enviar_teste_audio.php',
           type: 'GET',
           dataType: 'json',
           data: {'ref_audio': ref_audio},
           success: function(resultado)
           {
            //alert(resultado); 
            var link_info = document.getElementById('ultimo_acionamento_sirene_rom4');
            link_info.innerHTML = "<b>Atuado: </b>"+resultado; 
           }
        });
}
function clicou_teste_rom5()
{
 //alert('entrou'); 
 var reproduzir = document.getElementById('audio_rom5');
 reproduzir.play();
 var ref_audio = "erro_sva";
 $.ajax({
           url: 'enviar_teste_audio.php',
           type: 'GET',
           dataType: 'json',
           data: {'ref_audio': ref_audio},
           success: function(resultado)
           {
            //alert(resultado); 
            var link_info = document.getElementById('ultimo_acionamento_sirene_rom5');
            link_info.innerHTML = "<b>Atuado: </b>"+resultado; 
           }
        });
}










//ATUALIZA OS VALORES DE HISTORICO DOS TESTES
var link_sinere_ccl = document.getElementById('ultimo_acionamento_sirene1');
link_sinere_ccl.innerHTML = '<?php print $link_sirene_ccl ?>';

var link_sinere_rom1 = document.getElementById('ultimo_acionamento_sirene_rom1');
link_sinere_rom1.innerHTML = '<?php print $link_sinere_rom1 ?>';

var link_sinere_rom2 = document.getElementById('ultimo_acionamento_sirene_rom2');
link_sinere_rom2.innerHTML = '<?php print $link_sinere_rom2 ?>';

var link_sinere_rom3 = document.getElementById('ultimo_acionamento_sirene_rom3');
link_sinere_rom3.innerHTML = '<?php print $link_sinere_rom3 ?>';

var link_sinere_rom4 = document.getElementById('ultimo_acionamento_sirene_rom4');
link_sinere_rom4.innerHTML = '<?php print $link_sinere_rom4 ?>';

var link_sinere_rom5= document.getElementById('ultimo_acionamento_sirene_rom5');
link_sinere_rom5.innerHTML = '<?php print $link_sinere_rom5 ?>';
</script>


</body>

<script>
//$("#btn_dashboard").mouseover(function(){
//  som.pause();
//  som.currentTime = 0;
//  som.play();
//});
var link_data2 = document.getElementById('data2');
link_data2.value = data_selecionada;









document.getElementById('div_sirene').style.display="none";
document.getElementById('div_justificativa_sirene').style.display="none";

//clicou_cheio_vazio();
//trata os visualizar



</script>


</html>

<style>

 ****//RADAR***********************************************************************************************************



 INPUT#btn_editar_radar{
    position: absolute;
    left: 85%;
    top:-2%;
    padding: 0px;
    margin: 0px;
    width: 110px;
    height: 30px;
    color: #ffffff;
    background-color: rgba(0,0,200,0.8);
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
INPUT#btn_editar_radar:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_editar_radar:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_salvar_editar_radar{
    position: absolute;
    left: 85%;
    top: -2%;
    padding: 2px;
    margin-left: 0px;
    width: 110px;
    height: 30px;
    color: #ffffff;
    background-color: rgba(200,0,10,0.8);
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
INPUT#btn_salvar_editar_radar:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_salvar_editar_radar:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


IMG#radar_btn_calendario{
    position: absolute;
    left: 34%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#radar_btn_calendario:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#radar_btn_calendario:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

IMG#radar_btn_filtro{
    position: absolute;
    left: 38.5%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#radar_btn_filtro:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#radar_btn_filtro:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


LABEL#radar_valor_registro{
    position: absolute;
    left: 4%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#radar_v_registro{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:17%;
    top: 3%;
    background-color: transparent;
    width:100px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#radar_valor_nome{
    position: absolute;
    left: 32%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#radar_v_nome{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:42%;
    top: 3%;
    background-color: transparent;
    width:300px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#radar_lb_valor_parecer{
    position: absolute;
    left: 4%;
    top: 30%;
    font: normal 12pt verdana;
    color:	#000000;
}

TEXTAREA#radar_v_parecer{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:17%;
    top: 30%;
    
    background-color: transparent;
   
    border: transparent;
    cursor: pointer;

}


DIV#div_info_zerar_radar{
  position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}







DIV#div_filtrar_radar{
    position: absolute;
    left: 25%;
    top: 18%;
    background-color: #D3D3D3;
    width:52%;
    height: 52%;
    text-align:left;

    border-radius: 8px!important;
    border: 6px #000000 solid!important;
  
}



LABEL#radar_lb_filtro1{
    position: absolute;
    left: -0.1%;
    top: -0.5%;
    font: bold 16pt verdana;
    padding-left: 4%;
    background-color: rgba(20,20,20,0.8);
    padding-right: 45.7%;
    padding-top:20px;
    padding-bottom: 15px;
    color:	rgba(250,250,250,1);
    border: 1px rgba(20,20,20,0.8) solid!important;
}
LABEL#radar_lb_filtro2{
    position: absolute;
    left: 4%;
    top: 21%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}
LABEL#radar_lb_filtro2_1{
    position: absolute;
    left: 9%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}
INPUT#radar_ckb_1{
    position: absolute;
    left: 4%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
     color:	#000000;
}

LABEL#radar_lb_filtro2_2{
    position: absolute;
    left: 38.5%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#radar_ckb_2{
    position: absolute;
    left: 33.5%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

LABEL#radar_lb_filtro4{
    position: absolute;
    left: 4%;
    top: 50%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}


LABEL#radar_lb_filtro4_1{
    position: absolute;
    left: 9%;
    top: 63%;
    font: bold 12pt verdana;
    color:	#000000;
}



INPUT#radar_ckb_6{
    position: absolute;
    left: 4%;
    top: 62%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

LABEL#radar_lb_filtro4_2{
    position: absolute;
    left: 38.5%;
    top: 63%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#radar_ckb_7{
    position: absolute;
    left: 33.5%;
    top: 62%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#radar_salvar_filtro
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:8.5%;
    top: 86%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#radar_salvar_filtro:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#radar_salvar_filtro:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#radar_sair_filtro
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:27%;
    top: 86%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#radar_sair_filtro:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#radar_sair_filtro:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



DIV#div_justificar_radar{
    position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
  
}




INPUT#sim2_radar
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim2_radar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim2_radar:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#nao2_radar
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao2_radar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao2_radar:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


DIV#div_justificativa_radar{
    position: absolute;
    left: 32%;
    top: 23%;
    background-color: rgba(10,20,20,1);
    width:31%;
    height: 31%;
    text-align:left;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}



TEXTAREA#valor_parecer_radar{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:4%;
    top: 28%;    
    background-color: rgba(200,200,200,0.8);
    border: transparent;
    cursor: pointer;
    text-align:left;
    border-radius: 4px!important;
    border: 1px #000000 solid!important;

}



DIV#radar_player1{
    margin-left: 0px;
    position: absolute;
    top: 165px;
    left: 580px;
    width:  710px;
    height: 485px;
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}


DIV#dados_radar{
    padding-top: 15px;
    padding-left: 10px;
    position: absolute;
    top: 4.4%;
    left: 44.6%;
    width:  710px;
    height: 125px;
    background-color: #DCDCDC; 
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}


.radar_th1{
    width: 580px;
    height: -100px;
    background-color: 	#F5FFFA; 
     
}


IMG#foto_radar{
    margin-left: 0px;
    position: absolute;
    left: -170px;
    top: 5px;
    padding: 0px;
    width:  160px;
    height: 140px;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
}
DIV#foto_radar{
    margin-left: 0px;
    position: relative;
    left: 180px;
    top: 0px;
    padding-top: 15px;
    width:  350px;
    height: 144px;
    background-color: transparent;
    margin-bottom: 10px;
}




LABEL#radar_titulo{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -6%;
}
LABEL#radar_titulo2{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -1.9%;
}

LABEL#radar_info_eventos{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 46%;
    top: -6%;
}

LABEL#radar_info_eventos2{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 46%;
    top: -2%;
}

LABEL#radar_info_eventos3{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 64%;
    top: -6%;
}









*****************************************************************************************************************


INPUT#data2{
    position: absolute;
    left: 70%;
    top: 5%;
    font: normal 12pt verdana;
    color:	#000000;
    width:110px;
    height: 25px;
}
INPUT#ref1{
    position: absolute;
    left: 80%;
    top: 8%;
    font: normal 12pt verdana;
    color:	#000000;
    width:110px;
    height: 25px;
}
IMG#cheio_vazio_btn_calendario{
    position: absolute;
    left: 34%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#cheio_vazio_btn_calendario:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#cheio_vazio_btn_calendario:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

IMG#cheio_vazio_btn_filtro{
    position: absolute;
    left: 38.5%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#cheio_vazio_btn_filtro:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#cheio_vazio_btn_filtro:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


LABEL#cheio_vazio_valor_registro{
    position: absolute;
    left: 4%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#cheio_vazio_v_registro{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:17%;
    top: 3%;
    background-color: transparent;
    width:100px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#cheio_vazio_valor_nome{
    position: absolute;
    left: 32%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#cheio_vazio_v_nome{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:42%;
    top: 3%;
    background-color: transparent;
    width:300px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#cheio_vazio_lb_valor_parecer{
    position: absolute;
    left: 4%;
    top: 30%;
    font: normal 12pt verdana;
    color:	#000000;
}

TEXTAREA#cheio_vazio_v_parecer{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:17%;
    top: 30%;
    
    background-color: transparent;
   
    border: transparent;
    cursor: pointer;

}




INPUT#btn_editar_cheio_vazio{
    position: absolute;
    left: 93%;
    top: 2%;
    padding: 0px;
    margin: 0px;
    width: 110px;
    height: 30px;
    color: #ffffff;
    background-color: rgba(0,0,200,0.8);
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
INPUT#btn_editar_cheio_vazio:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_editar_cheio_vazio:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_salvar_editar_cheio_vazio{
    position: absolute;
    left: 93%;
    top: 2%;
    padding: 2px;
    margin-left: 0px;
    width: 110px;
    height: 30px;
    color: #ffffff;
    background-color: rgba(200,0,10,0.8);
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
INPUT#btn_salvar_editar_cheio_vazio:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_salvar_editar_cheio_vazio:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

IMG#outros_veiculos_btn_calendario{
    position: absolute;
    left: 34%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#outros_veiculos_btn_calendario:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#outros_veiculos_btn_calendario:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

IMG#outros_veiculos_btn_filtro{
    position: absolute;
    left: 38.5%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#outros_veiculos_btn_filtro:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#outros_veiculos_btn_filtro:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


LABEL#outros_veiculos_valor_registro{
    position: absolute;
    left: 4%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#outros_veiculos_v_registro{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:17%;
    top: 3%;
    background-color: transparent;
    width:100px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#outros_veiculos_valor_nome{
    position: absolute;
    left: 32%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#outros_veiculos_v_nome{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:42%;
    top: 3%;
    background-color: transparent;
    width:300px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#outros_veiculos_lb_valor_parecer{
    position: absolute;
    left: 4%;
    top: 30%;
    font: normal 12pt verdana;
    color:	#000000;
}

TEXTAREA#outros_veiculos_v_parecer{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:17%;
    top: 30%;
    
    background-color: transparent;
   
    border: transparent;
    cursor: pointer;

}




INPUT#btn_editar_outros_veiculos{
    position: absolute;
    left: 85%;
    top: 2%;
    padding: 0px;
    margin: 0px;
    width: 110px;
    height: 30px;
    color: #ffffff;
    background-color: rgba(0,0,200,0.8);
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
INPUT#btn_editar_outros_veiculos:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_editar_outros_veiculos:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_salvar_editar_outros_veiculos{
    position: absolute;
    left: 85%;
    top: 2%;
    padding: 2px;
    margin-left: 0px;
    width: 110px;
    height: 30px;
    color: #ffffff;
    background-color: rgba(200,0,10,0.8);
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
INPUT#btn_salvar_editar_outros_veiculos:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_salvar_editar_outros_veiculos:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}













DIV#div_descartar_placa{
  position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}

LABEL#lb_info_zerar2{
  margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 8%;
    font: bold 14pt verdana;
    color:	red;
}
LABEL#lb_info_zerar{
  margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 25%;
    font: normal 14pt verdana;
    color:	#ffffff;
}


INPUT#sim
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color:  rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#nao
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




DIV#div_filtrar_cheio_vazio{
    position: absolute;
    left: 25%;
    top: 18%;
    background-color: #D3D3D3;
    width:52%;
    height: 52%;
    text-align:left;

    border-radius: 8px!important;
    border: 6px #000000 solid!important;
  
}

DIV#div_filtrar_outros_veiculos{
    position: absolute;
    left: 25%;
    top: 18%;
    background-color: #D3D3D3;
    width:52%;
    height: 52%;
    text-align:left;

    border-radius: 8px!important;
    border: 6px #000000 solid!important;
  
}

LABEL#lb_filtro1{
    position: absolute;
    left: -0.1%;
    top: -0.5%;
    font: bold 16pt verdana;
    padding-left: 4%;
    background-color: rgba(20,20,20,0.8);
    padding-right: 45.7%;
    padding-top:20px;
    padding-bottom: 15px;
    color:	rgba(250,250,250,1);
    border: 1px rgba(20,20,20,0.8) solid!important;
}
LABEL#lb_filtro2{
    position: absolute;
    left: 4%;
    top: 21%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}
LABEL#lb_filtro2_1{
    position: absolute;
    left: 9%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}
INPUT#ckb_1{
    position: absolute;
    left: 4%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
     color:	#000000;
}

LABEL#lb_filtro2_2{
    position: absolute;
    left: 38.5%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#ckb_2{
    position: absolute;
    left: 33.5%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}



LABEL#lb_filtro2_3{
    position: absolute;
    left: 65%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#ckb_3{
    position: absolute;
    left: 60.5%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}


LABEL#lb_filtro3{
    position: absolute;
    left: 4%;
    top: 43%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}

LABEL#lb_filtro3_1{
    position: absolute;
    left: 9%;
    top: 53%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#ckb_4{
    position: absolute;
    left: 4%;
    top: 52%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

LABEL#lb_filtro3_2{
    position: absolute;
    left: 38.5%;
    top: 53%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#ckb_5{
    position: absolute;
    left: 33.5%;
    top: 52%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}




LABEL#lb_filtro4{
    position: absolute;
    left: 4%;
    top: 62%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}


LABEL#lb_filtro4_1{
    position: absolute;
    left: 9%;
    top: 73%;
    font: bold 12pt verdana;
    color:	#000000;
}



INPUT#ckb_6{
    position: absolute;
    left: 4%;
    top: 72%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

LABEL#lb_filtro4_2{
    position: absolute;
    left: 38.5%;
    top: 73%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#ckb_7{
    position: absolute;
    left: 33.5%;
    top: 72%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#salvar_filtro
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:8.5%;
    top: 86%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#salvar_filtro:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#salvar_filtro:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#sair_filtro
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:27%;
    top: 86%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sair_filtro:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sair_filtro:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





DIV#div_filtrar_outros_veiculos{
    position: absolute;
    left: 25%;
    top: 18%;
    background-color: #D3D3D3;
    width:52%;
    height: 52%;
    text-align:left;

    border-radius: 8px!important;
    border: 6px #000000 solid!important;
  
}



LABEL#outros_veiculos_lb_filtro1{
    position: absolute;
    left: -0.1%;
    top: -0.5%;
    font: bold 16pt verdana;
    padding-left: 4%;
    background-color: rgba(20,20,20,0.8);
    padding-right: 45.7%;
    padding-top:20px;
    padding-bottom: 15px;
    color:	rgba(250,250,250,1);
    border: 1px rgba(20,20,20,0.8) solid!important;
}
LABEL#outros_veiculos_lb_filtro2{
    position: absolute;
    left: 4%;
    top: 21%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}
LABEL#outros_veiculos_lb_filtro2_1{
    position: absolute;
    left: 9%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}
INPUT#outros_veiculos_ckb_1{
    position: absolute;
    left: 4%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
     color:	#000000;
}

LABEL#outros_veiculos_lb_filtro2_2{
    position: absolute;
    left: 38.5%;
    top: 31%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#outros_veiculos_ckb_2{
    position: absolute;
    left: 33.5%;
    top: 30%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

LABEL#outros_veiculos_lb_filtro4{
    position: absolute;
    left: 4%;
    top: 50%;
    font: bold 14pt verdana;
    color:	rgba(0,0,200,0.8);
}


LABEL#outros_veiculos_lb_filtro4_1{
    position: absolute;
    left: 9%;
    top: 63%;
    font: bold 12pt verdana;
    color:	#000000;
}



INPUT#outros_veiculos_ckb_6{
    position: absolute;
    left: 4%;
    top: 62%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

LABEL#outros_veiculos_lb_filtro4_2{
    position: absolute;
    left: 38.5%;
    top: 63%;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#outros_veiculos_ckb_7{
    position: absolute;
    left: 33.5%;
    top: 62%;
    width: 28px;
    height: 28px;
    font: bold 12pt verdana;
    color:	#000000;
}

INPUT#outros_veiculos_salvar_filtro
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:8.5%;
    top: 86%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#outros_veiculos_salvar_filtro:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#outros_veiculos_salvar_filtro:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#outros_veiculos_sair_filtro
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:27%;
    top: 86%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#outros_veiculos_sair_filtro:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#outros_veiculos_sair_filtro:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


















DIV#div_justificar_cheio_vazio{
    position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
  
}

DIV#div_justificar_outros_veiculos{
    position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
  
}



LABEL#lb_info_justificar2{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 8%;
    font: bold 14pt verdana;
    color:	red;
}
LABEL#lb_info_justificar{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 25%;
    font: normal 14pt verdana;
    color:	#ffffff;
}


INPUT#sim2_cheio_vazio
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim2_cheio_vazio:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim2_cheio_vazio:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#nao2_cheio_vazio
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao2_cheio_vazio:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao2_cheio_vazio:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#sim2_outros_veiculos
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim2_outros_veiculos:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim2_outros_veiculos:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#nao2_outros_veiculos
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao2_outros_veiculos:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao2_outros_veiculos:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



DIV#div_justificativa_cheio_vazio{
    position: absolute;
    left: 32%;
    top: 23%;
    background-color: rgba(10,20,20,1);
    width:31%;
    height: 31%;
    text-align:left;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}


DIV#div_justificativa_outros_veiculos{
    position: absolute;
    left: 32%;
    top: 23%;
    background-color: rgba(10,20,20,1);
    width:31%;
    height: 31%;
    text-align:left;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}



LABEL#lb_justificativa{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 4%;
    font: bold 14pt verdana;
    color:	red;
}
LABEL#lb_parecer_justificativa{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 14%;
    font: normal 14pt verdana;
    color:	#ffffff;
}

TEXTAREA#valor_parecer_cheio_vazio{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:4%;
    top: 28%;    
    background-color: rgba(200,200,200,0.8);
    border: transparent;
    cursor: pointer;
    text-align:left;
    border-radius: 4px!important;
    border: 1px #000000 solid!important;

}
TEXTAREA#valor_parecer_outros_veiculos{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:4%;
    top: 28%;    
    background-color: rgba(200,200,200,0.8);
    border: transparent;
    cursor: pointer;
    text-align:left;
    border-radius: 4px!important;
    border: 1px #000000 solid!important;

}

INPUT#salvar_justificativa
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:7.5%;
    top: 80%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#salvar_justificativa:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#salvar_justificativa:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#parecer_padrao_entrada
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:36%;
    top: 80%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,0,200,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#parecer_padrao_entrada:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#parecer_padrao_entrada:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#parecer_padrao_saida
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:36%;
    top: 80%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,0,200,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#parecer_padrao_saida:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#parecer_padrao_saida:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}















INPUT#sair_justificativa
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:65%;
    top: 80%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sair_justificativa:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sair_justificativa:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_cheio_vazio {
    background-image: url( './images/local_shipping.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    padding: 2px;
    position:absolute;
    top: 2%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_cheio_vazio:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_cheio_vazio:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}




INPUT#btn_outros_veiculos {
    background-image: url( './images/directions_car.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    padding: 2px;
    position:absolute;
    top: 10.5%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_outros_veiculos:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_outros_veiculos:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}




INPUT#btn_radar {
    background-image: url( './images/delete_sweep.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    padding: 2px;
    position:absolute;
    top: 19%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_radar:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_radar:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}



INPUT#btn_relatorio {
    background-image: url( './images/assignment.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    padding: 2px;
    position:absolute;
    top: 27.5%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_relatorio:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_relatorio:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}





INPUT#btn_dashboard {
    background-image: url( './images/assessment.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 36%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_dashboard:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_dashboard:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}




INPUT#btn_configuracoes {
    background-image: url( './images/build.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 44.5%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_configuracoes:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_configuracoes:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}




INPUT#btn_descartados {
    background-image: url( './images/videocam_off.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 53%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_descartados:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_descartados:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}



INPUT#btn_sirene {
    background-image: url( './images/volume_up.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 61.5%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_sirene:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_sirene:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}












DIV#menu{
    margin-left: 0px;
    position: absolute;
    top: 4%;
    left: 0%;
    width:  80px;
    height: 96%;
    background-color: #1C1C1C;
    border-radius: 1px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
}


DIV#cheio_vazio_player1{
    margin-left: 0px;
    position: absolute;
    top: 165px;
    left: 580px;
    width:  645px;
    height: 485px;
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}

DIV#outros_veiculos_player1{
    margin-left: 0px;
    position: absolute;
    top: 165px;
    left: 580px;
    width:  645px;
    height: 485px;
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}
DIV#dados{
    padding-top: 15px;
    padding-left: 10px;
    position: absolute;
    top: 4.4%;
    left: 44.6%;
    width:  646px;
    height: 125px;
    background-color: #DCDCDC; 
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}
DIV#dados_outros_veiculos{
    padding-top: 15px;
    padding-left: 10px;
    position: absolute;
    top: 4.4%;
    left: 44.6%;
    width:  646px;
    height: 125px;
    background-color: #DCDCDC; 
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}

.cheio_vazio_th1{
    width: 580px;
    height: -100px;
    background-color: 	#F5FFFA; 
     
}


.outros_veiculos_th1{
    width: 580px;
    height: -100px;
    background-color: 	#F5FFFA;
     
}

table {
    width: 550px;
    height: 600px;
    position: absolute;
    left: 0px;
    top: 30px;
    display:inline-block;
    background-color: blue;
    font: normal 12pt times;
}


tbody {
    height: 618px;
    display: inline-block;
    width: 100%;
    background-color:#F8F8FF;
    overflow: auto;

}


IMG#foto_cheio_vazio{
    margin-left: 0px;
    position: absolute;
    left: -170px;
    top: 45px;
    padding: 0px;
    width:  160px;
    height: 140px;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    
}
IMG#foto_cheio_vazio_alerta{
    width:  30px;
    height: 30px;
}
DIV#foto_cheio_vazio{
    margin-left: 0px;
    position: relative;
    left: 180px;
    top: 0px;
    padding-top: 15px;
    width:  350px;
    height: 220px;
    background-color: transparent;
    margin-bottom: 10px;
}

IMG#foto_outros_veiculos{
    margin-left: 0px;
    position: absolute;
    left: -170px;
    top: 25px;
    padding: 0px;
    width:  160px;
    height: 140px;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    
}
IMG#foto_outros_veiculos_alerta{
    width:  30px;
    height: 30px;
}
DIV#foto_outros_veiculos{
    margin-left: 0px;
    position: relative;
    left: 180px;
    top: 0px;
    padding-top: 15px;
    width:  350px;
    height: 220px;
    background-color: transparent;
    margin-bottom: 10px;
}



DIV#tabela{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 6%;
    left: 0px;
    height: 680px;
    width: 1300px;
     
   
}



DIV#v_cheio_vazio{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 680px;
    width: 1300px;
    background-color: transparent;

   
}

DIV#v_outros_veiculos{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 11.8%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: transparent; 
   
}

DIV#v_radar{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 11.8%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: transparent; 

}


DIV#v_relatorio{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: pink; 
}


DIV#v_dashboard{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: rgb(11,32,55); 
   
}


DIV#v_configuracoes{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: rgb(20,100,23); 
   
}



DIV#v_descartados{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: rgb(33,124,32); 
   
}

DIV#v_sirene{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: transparent; 
   
}







a#assistir {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: #1C1C1C;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 6px;
    padding-bottom: 7px;
    border-style: 5px,solid!important;
    cursor: pointer;
    text-align: center;

}
.justificar {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: 5px,none;
    cursor: pointer;
    text-align: center;

}

a#ignorar {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: #DAA520;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: 5px,solid!important;
    cursor: pointer;
    text-align: center;

}



LABEL#cheio_vazio_titulo{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -8%;
}
LABEL#cheio_vazio_titulo2{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -4.5%;
}
LABEL#cheio_vazio_titulo3{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -1%;
}
LABEL#cheio_vazio_info_eventos{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 44.5%;
    top: -8%;
}

LABEL#cheio_vazio_info_eventos2{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 44.5%;
    top: -4.5%;
}

LABEL#cheio_vazio_info_eventos3{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 44.5%;
    top: -1%;
}
LABEL#cheio_vazio_info_eventos4{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 62.5%;
    top: -4.5%;
}
LABEL#cheio_vazio_info_eventos5{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 83%;
    top: -4.5%;
}
LABEL#cheio_vazio_info_eventos6{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 83%;
    top: -8%;
}
LABEL#cheio_vazio_info_eventos7{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 62.5%;
    top: -8%;
}
LABEL#cheio_vazio_info_eventos9{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 83%;
    top: -1%;
}
DIV#baixar{
  position: absolute;
    left: 44.5%;
    top: 82%;
    background-color: #DCDCDC;
    width:49.8%;
    height: 20%;
    text-align:left;

    border-radius: 2px!important;
    border: 4px #000000 solid!important;
}


INPUT#btn_erros_ocr {
    background-image: url( './images/csv.png' );
    background-size: 40px 40px;
    height: 40px;  
    width: 40px;
    padding: 2px;
    position:absolute;
    top: 5%;
    left: 2%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_erros_ocr:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_erros_ocr:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}

LABEL#lb_btn_erros_ocr{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#000000;
    left: 12%;
    top: 9%;
}


INPUT#btn_placas_bloqueadas {
    background-image: url( './images/csv.png' );
    background-size: 40px 40px;
    height: 40px;  
    width: 40px;
    padding: 2px;
    position:absolute;
    top: 41%;
    left: 2%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_placas_bloqueadas:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
 transform: translateX(8px);
}
INPUT#btn_placas_bloqueadas:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
  transform: translateX(8px);
}

LABEL#lb_btn_placas_bloqueadas{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#000000;
    left: 12%;
    top: 42%;
}




LABEL#cheio_vazio_info_eventos8{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 62.5%;
    top: -1%;
}
  LABEL#outros_veiculos_titulo{
      margin-left: 0%;
      position: absolute;
      font: normal 12pt verdana;
      color:#ffffff;
      left: 0%;
      top: -6%;
  }
  LABEL#outros_veiculos_titulo2{
      margin-left: 0%;
      position: absolute;
      font: normal 12pt verdana;
      color:#ffffff;
      left: 0%;
      top: -1.9%;
  }

  LABEL#outros_veiculos_info_eventos{
      margin-left: 0%;
      position: absolute;
      font: normal 12pt verdana;
      color:#ffffff;
      left: 46%;
      top: -6%;
  }

  LABEL#outros_veiculos_info_eventos2{
      margin-left: 0%;
      position: absolute;
      font: normal 12pt verdana;
      color:#ffffff;
      left: 46%;
      top: -2%;
  }

  LABEL#outros_veiculos_info_eventos3{
      margin-left: 0%;
      position: absolute;
      font: normal 12pt verdana;
      color:#ffffff;
      left: 64%;
      top: -6%;
  }



IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 8px;
    top: 2%;
    width: 32px;
    height: 32px;
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
    left: 38%;
    top: 95%;
    font: normal 11pt verdana;
    color:#ffffff;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 0%;
    top: 0%;
    width:100%;
    height:4.2%;
    background-color:#1C1C1C;
    border-radius: 0px!important;
    border: 2px #222 solid!important;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 3%;
    top: -36%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 80%;
    top: 5%;
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























































LABEL#lb_titulo_sirene{
    position: absolute;
    left: 0.5%;
    top: 0.5%;
    font: bold 20pt verdana;
    color:	#ffffff;
}

DIV#sirene1{
    margin-left: 0px;
    position: relative;
    left: -1%;
    top: 8%;
    padding-top: 15px;
    width:  46%;
    height: 20%;
    background-color: #DCDCDC; 
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
    margin-bottom: 10px;
}
IMG#foto_sirene{
    margin-left: 0px;
    position: absolute;
    left: 1%;
    top: 5%;
    padding: 0px;
    width:  22%;
    height: 90%;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
}
LABEL#nome_sirene{
    position: absolute;
    left: 24%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
LABEL#ultimo_acionamento_sirene1{
    position: absolute;
    left: 24%;
    top: 28%;
    font: normal 12pt verdana;
    color:	#000000;
}

INPUT#ativar_sirene1
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 70%;
    width:16.5%;
    height:27%;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#ativar_sirene1:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#ativar_sirene1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#desativar_sirene1
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:43%;
    top: 70%;
    width:22%;
    height:27%;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#desativar_sirene1:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#desativar_sirene1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666; 
  transform: translateY(4px);
}


INPUT#testar_sirene1
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:68%;
    top: 70%;
    width:18%;
    height:27%;
    padding-left: 5px;
    background-color: rgba(0,20,200,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#testar_sirene1:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#testar_sirene1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




DIV#dados_sirene{
    padding-top: 15px;
    padding-left: 10px;
    position: absolute;
    top: 8%;
    left: 46%;
    width:  53%;
    height: 20%;
    background-color: #DCDCDC; 
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}




LABEL#lb_titulo_sirene2{
    position: absolute;
    left: 0.5%;
    top: 33%;
    font: bold 16pt verdana;
    color:	#ffffff;
}

DIV#div_testes_audios_ccl_rom{
    margin-left: 0px;
    position: relative;
    left: -1%;
    top: 17%;
    padding-top: 15px;
    width:  46%;
    height: 40%;
    background-color: #DCDCDC; 
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
    margin-bottom: 10px;
}


LABEL#nome_sirene_rom{
    position: absolute;
    left: 2%;
    top: 5%;
    font: normal 12pt verdana;
    color:	#000000;
}


LABEL#teste_sirene_rom1{
    position: absolute;
    left: 12%;
    top: 18%;
    font: normal 12pt verdana;
    color:	#000000;
}
LABEL#ultimo_acionamento_sirene_rom1{
    position: absolute;
    left: 50%;
    top: 18%;
    font: normal 12pt verdana;
    color:	#000000;
}

INPUT#testar_audio_sirene1
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:1%;
    top: 17%;
    width:10%;
    height:10%;
    padding-left: 5px;
    background-color: rgba(0,20,200,0.9);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#testar_audio_sirene1:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#testar_audio_sirene1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





LABEL#teste_sirene_rom2{
    position: absolute;
    left: 12%;
    top: 30%;
    font: normal 12pt verdana;
    color:	#000000;
}
LABEL#ultimo_acionamento_sirene_rom2{
    position: absolute;
    left: 50%;
    top: 30%;
    font: normal 12pt verdana;
    color:	#000000;
}

INPUT#testar_audio_sirene2
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:1%;
    top: 29%;
    width:10%;
    height:10%;
    padding-left: 5px;
    background-color: rgba(0,20,200,0.9);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#testar_audio_sirene2:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#testar_audio_sirene2:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}






LABEL#teste_sirene_rom3{
    position: absolute;
    left: 12%;
    top: 42%;
    font: normal 12pt verdana;
    color:	#000000;
}
LABEL#ultimo_acionamento_sirene_rom3{
    position: absolute;
    left: 50%;
    top: 42%;
    font: normal 12pt verdana;
    color:	#000000;
}

INPUT#testar_audio_sirene3
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:1%;
    top: 41%;
    width:10%;
    height:10%;
    padding-left: 5px;
    background-color: rgba(0,20,200,0.9);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#testar_audio_sirene3:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#testar_audio_sirene3:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


LABEL#teste_sirene_rom4{
    position: absolute;
    left: 12%;
    top: 54%;
    font: normal 12pt verdana;
    color:	#000000;
}
LABEL#ultimo_acionamento_sirene_rom4{
    position: absolute;
    left: 50%;
    top: 54%;
    font: normal 12pt verdana;
    color:	#000000;
}

INPUT#testar_audio_sirene4
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:1%;
    top: 53%;
    width:10%;
    height:10%;
    padding-left: 5px;
    background-color: rgba(0,20,200,0.9);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#testar_audio_sirene4:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#testar_audio_sirene4:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



LABEL#teste_sirene_rom5{
    position: absolute;
    left: 12%;
    top: 66%;
    font: normal 12pt verdana;
    color:	#000000;
}
LABEL#ultimo_acionamento_sirene_rom5{
    position: absolute;
    left: 50%;
    top: 66%;
    font: normal 12pt verdana;
    color:	#000000;
}

INPUT#testar_audio_sirene5
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:1%;
    top: 65%;
    width:10%;
    height:10%;
    padding-left: 5px;
    background-color: rgba(0,20,200,0.9);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;

}
INPUT#testar_audio_sirene5:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#testar_audio_sirene5:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

DIV#div_sirene{
    position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 6px!important;
    border: 4px #000000 solid!important;
  
}


DIV#div_justificativa_sirene{
    position: absolute;
    left: 32%;
    top: 23%;
    background-color: rgba(10,20,20,1);
    width:31%;
    height: 31%;
    text-align:left;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}



































[ng\:cloak], [ng-cloak], .ng-cloak {
  display: none;
}

* {
  box-sizing: border-box;
}

html, body {
  margin: 0;
  background: #363636; 
}

.app-container { 
  border-radius: 4px;
  overflow: hidden;
  width: 720px;
  height: auto;
  max-width: 100%;
  position: absolute;
  top: 50px;
  left: 0;
  right: 0;
  margin: auto;
  border-radius: 8px!important;
    border: 10px #000000 solid!important;
}

.buttons-container {
  position: absolute;
  bottom: 15px;
  right: 0;
  height: 40px;
  font-family: "Roboto", sans-serif;
}

.cancel-button,
.save-button {
  float: left;
  height: 40px;
  line-height: 40px;
  padding: 0 15px;
  border-radius: 2px;
  margin-right: 15px;
  cursor: pointer;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.cancel-button {
  background: white;
  color: #1C1C1C;
}

.save-button {
  background: #1C1C1C;
  color: white;
}

/* Datepicker Stuff */
.datepicker {
  position: relative;
  width: 100%;
  display: block;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  font-family: "Roboto", sans-serif;
  overflow: hidden;
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.datepicker.am {
  background: white;
}

.datepicker.pm {
  background: #1C1C1C;
}

.datepicker-header {
  width: 100%;
  color: white;
  overflow: hidden;
}

.datepicker-title {
  width: 50%;
  float: left;
  height: 60px;
  line-height: 60px;
  padding: 0 15px;
  text-align: left;
  font-size: 20px;
}

.datepicker-subheader {
  width: 50%;
  float: left;
  height: 60px;
  line-height: 60px;
  font-size: 14px;
  padding: 0 15px;
  text-align: right;
}

.datepicker-calendar {
  width: 50%;
  float: left;
  padding: 20px 15px 15px;
  max-width: 400px;
  display: block;
}

.calendar-header {
  color: black;
  font-weight: bolder;
  text-align: center;
  font-size: 18px;
  padding: 10px 0;
  position: relative;
}

.current-month-container {
  display: inline-block;
  height: 30px;
  position: relative;
}

.goback,
.goforward {
  height: 30px;
  width: 30px;
  border-radius: 30px;
  display: inline-block;
  cursor: pointer;
  position: relative;
  top: -4px;
}

.goback path,
.goforward path {
  -webkit-transition: stroke 0.15s ease;
  transition: stroke 0.15s ease;
}

.goback {
  float: left;
  margin-left: 3.8%;
}

.goforward {
  float: right;
  margin-right: 3.8%;
}

.calendar-day-header {
  width: 100%;
  position: relative;
}

.day-label {
  color: #8A8A8A;
  padding: 5px 0;
  width: 14.2857142%;
  display: inline-block;
  text-align: center;
}

.datecontainer {
  width: 14.2857142%;
  display: inline-block;
  text-align: center;
  padding: 4px 0;
}

.datenumber {
  max-width: 35px;
  max-height: 35px;
  line-height: 35px;
  margin: 0 auto;
  color: #8A8A8A;
  position: relative;
  text-align: center;
  cursor: pointer;
  z-index: 1;
  -webkit-transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
  transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
}

.no-hover .datenumber,
.no-hover .datenumber:hover,
.no-hover .datenumber:before,
.no-hover .datenumber:hover::before {
  cursor: default;
  color: #8A8A8A;
  background: transparent;
  opacity: 0.5;
}

.no-hover .datenumber.day-selected {
  color: white;
}

.datenumber:hover {
  color: white;
}

.datenumber:before {
  content: '';
  display: block;
  position: absolute;
  height: 35px;
  width: 35px;
  border-radius: 100px;
  z-index: -1;
  background: transparent;
  -webkit-transform: scale(0.75);
  transform: scale(0.75);
  -webkit-transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
  transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
  -webkit-transition-property: background, color, border, -webkit-transform;
  transition-property: background, color, border, -webkit-transform;
  transition-property: background, transform, color, border;
  transition-property: background, transform, color, border, -webkit-transform;
}

.datenumber:hover::before {
  background: #FFAB91;
  -webkit-transform: scale(1);
  transform: scale(1);
}

.day-selected {
  color: white;
}

.datenumber.day-selected:before {
  background: #FF6E40;
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-animation: select-date .25s forwards;
  animation: select-date .25s forwards;
}

@-webkit-keyframes select-date {
  0% {
    background: #FFAB91;
  }
  100% {
    background: #FF6E40;
  }
}
@keyframes select-date {
  0% {
    background: #FFAB91;
  }
  100% {
    background: #FF6E40;
  }
}
/* timepicker styles */
.timepicker-container-outer {
  width: 50%;
  max-width: 700px;
  float: left;
  display: block;
  padding: 40px 30px 30px;
  position: relative;
  top: 50px;
  overflow: hidden;
  -webkit-tap-highlight-color: transparent;
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.timepicker-container-inner {
  width: 100%;
  height: 100%;
  max-width: 320px;
  margin: 0 auto;
  position: relative;
  display: block;
}

.timeline-container {
  display: block;
  float: left;
  position: relative;
  width: 100%;
  height: 36px;
}

.current-time {
  display: block;
  position: absolute;
  z-index: 1;
  width: 40px;
  height: 40px;
  border-radius: 20px;
  top: -25px;
  left: -20px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.current-time::after {
  content: '';
  display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  background: #FF6E40;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  border-radius: 20px 20px 3px 20px;
  z-index: -1;
  top: 0;
}

.actual-time {
  color: white;
  line-height: 40px;
  font-size: 12px;
  text-align: center;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.timeline {
  display: block;
  z-index: 1;
  width: 100%;
  height: 2px;
  position: absolute;
  bottom: 0;
}

.timeline::before, .timeline::after {
  content: '';
  display: block;
  width: 2px;
  height: 10px;
  top: -6px;
  position: absolute;
  background: #1C1C1C;
  left: -1px;
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.timeline::after {
  left: auto;
  right: -1px;
}

.hours-container {
  display: block;
  z-index: 0;
  width: 100%;
  height: 10px;
  position: absolute;
  top: 31px;
  left: 1px;
}

.hour-mark {
  width: 2px;
  display: block;
  float: left;
  height: 4px;
  background: #1C1C1C;
  position: relative;
  margin-left: calc((100% / 12) - 2px);
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.hour-mark:nth-child(3n) {
  height: 6px;
  top: -1px;
}

.display-time {
  width: calc(60% - 30px);
  display: block;
  margin-top: 30px;
  height: 36px;
  line-height: 36px;
  overflow: hidden;
  float: left;
  position: relative;
  font-size: 20px;
  text-align: center;
  -webkit-transition: color 0.15s ease;
  transition: color 0.15s ease;
}

.decrement-time,
.increment-time {
  cursor: pointer;
  position: absolute;
  display: block;
  width: 24px;
  height: 24px;
  line-height: 24px;
  top: 6px;
  font-size: 20px;
}

.decrement-time {
  left: 0;
  text-align: left;
}

.increment-time {
  right: 0;
  text-align: right;
}

.increment-time path,
.decrement-time path {
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.time {
  width: calc(100% - 48px);
  position: relative;
  left: 24px;
  height: 36px;
}
.time:after {
  content: '';
  height: 2px;
  width: 100%;
  position: absolute;
  bottom: 0;
  background: white;
  left: 0;
  right: 0;
  opacity: 0.5;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.time.time-active:after {
  display: none;
}

.time-input {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 34px;
  line-height: 34px;
  bottom: 2px;
  width: 100%;
  border: none;
  background: none;
  text-align: center;
  color: white;
  font-size: inherit;
  opacity: 0;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
  cursor: pointer;
}
.time-input:focus, .time-input:active {
  outline: none;
}

.formatted-time {
  cursor: pointer;
}

.time-input:focus {
  cursor: auto;
}
.time-input:focus ~ .formatted-time {
  border-radius: 2px;
  background: #1C1C1C;
  color: white;
  cursor: default;
}

.am-pm-container {
  width: 40%;
  padding-left: 15px;
  float: right;
  height: 36px;
  line-height: 36px;
  display: block;
  position: relative;
  margin-top: 30px;
}

.am-pm-button {
  width: calc(50% - 5px);
  height: 36px;
  line-height: 36px;
  background: #2196F3;
  text-align: center;
  color: white;
  border-radius: 4px;
  float: left;
  cursor: pointer;
}

.am-pm-button:first-child {
  background: #1C1C1C;
  color: white;
}

.am-pm-button:last-child {
  background: white;
  color: #1C1C1C;
  margin-left: 10px;
}

@-webkit-keyframes select-date-pm {
  0% {
    background: rgba(255, 255, 255, 0.5);
  }
  100% {
    background: #FFF;
  }
}
@keyframes select-date-pm {
  0% {
    background: rgba(255, 255, 255, 0.5);
  }
  100% {
    background: #FFF;
  }
}
.datepicker.am .datepicker-header {
  color: white;
  background: #1C1C1C;
}
.datepicker.am .current-time::after {
  background: #1C1C1C;
}
.datepicker.am .actual-time {
  color: white;
}
.datepicker.am .display-time {
  color: #FF6E40;
}
.datepicker.am .time-input {
  color: #FF693C;
}
.datepicker.am .time:after {
  background: #FF693C;
}
.datepicker.am .increment-time path,
.datepicker.am .decrement-time path {
  stroke: #FF693C;
}

.datepicker.pm .datepicker-header {
  background: white;
  color: #FF693C;
}
.datepicker.pm .datepicker-subheader {
  color: #1C1C1C;
}
.datepicker.pm .goback:before,
.datepicker.pm .goback:after,
.datepicker.pm .goforward:before,
.datepicker.pm .goforward:after {
  background: white;
}
.datepicker.pm .day-label {
  color: white;
}
.datepicker.pm .datenumber {
  color: white;
}
.datepicker.pm .datenumber:hover::before {
  background: rgba(255, 255, 255, 0.5);
  -webkit-transform: scale(1);
  transform: scale(1);
}
.datepicker.pm .datenumber.day-selected {
  color: #FF693C;
}
.datepicker.pm .datenumber.day-selected:before {
  background: white;
  -webkit-animation: select-date-pm .25s forwards;
  animation: select-date-pm .25s forwards;
}
.datepicker.pm .current-month-container {
  color: white;
}
.datepicker.pm .current-time::after {
  background: white;
}
.datepicker.pm .actual-time {
  color: #FF6E40;
}
.datepicker.pm .display-time {
  color: white;
}
.datepicker.pm .timeline::before, .datepicker.pm .pm .timeline::after {
  background: white;
}
.datepicker.pm .hour-mark {
  background: white;
}
.datepicker.pm .am-pm-button:last-child {
  color: #FF6E40;
}
.datepicker.pm .cancel-button {
  background: none;
  color: white;
}
.datepicker.pm .save-button {
  background: white;
  color: #FF693C;
}
.datepicker.pm .goback path,
.datepicker.pm .goforward path {
  stroke: white;
}
.datepicker.pm .time-input:focus ~ .formatted-time {
  background: white;
  color: #FF693C;
}

.datepicker.compact .datepicker-title,
.datepicker.compact .datepicker-subheader {
  width: 100%;
  text-align: center;
}
.datepicker.compact .datepicker-title {
  height: 50px;
  line-height: 50px;
}
.datepicker.compact .datepicker-subheader {
  height: 30px;
  line-height: 30px;
}
.datepicker.compact .display-time {
  width: 60%;
  font-size: 20px;
  line-height: 36px;
}
.datepicker.compact .app-container {
  width: 100%;
}
.datepicker.compact .datepicker-calendar {
  width: 100%;
  margin: 0 auto;
  float: none;
}
.datepicker.compact .timepicker-container-outer {
  width: 100%;
  margin: 0 auto;
  float: none;
  top: -15px;
}
.datepicker.compact .buttons-container {
  position: relative;
  float: right;
}


</style>
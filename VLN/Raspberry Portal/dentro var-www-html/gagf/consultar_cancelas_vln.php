<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body onload="carragar_cancelas()">
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ccl_vln.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
$registro = ceil((floatval($complemento))/1.5);
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
link_criptografia2.value = lcriptografia;07
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


<!-- Cancelas MB *******************************************************************************************-->
<div id="cancelas_vln" style="display:block">
<form method="post" action="consultar_cancela.php">
<fieldset id="formulario_vln" ><legend>Cancelas Mineração Varzea Leste Norte</legend>
<img class="foto" id="can1_vln"  alt="" onclick="clicou_cancela1_vln()" hidden="hidden"/>
<img class="foto" id="can2_vln"  alt="" onclick="clicou_cancela2_vln()" hidden="hidden"/>
<img class="foto" id="can3_vln"  alt="" onclick="clicou_cancela3_vln()"/>
<img class="foto" id="can4_vln"  alt="" onclick="clicou_cancela4_vln()" />
<img class="foto" id="can5_vln"  alt="" onclick="clicou_cancela5_vln()" hidden="hidden"/>

<div hidden="hidden">
<label id="lb_titulo_can1_vln"></label>
<label id="lb_titulo_status_can1_vln">Condição :</label>
<label id="lb_titulo_resp_status_can1_vln"></label>
<label id="lb_titulo_tag_can1_vln">TAG :</label>
<label id="lb_titulo_resp_tag_can1_vln"></label>
<label id="lb_titulo_info_can1_vln">Informações :</label>
<label id="lb_titulo_resp_info_can1_vln"></label>

<label id="lb_titulo_can2_vln"></label>
<label id="lb_titulo_status_can2_vln">Condição :</label>
<label id="lb_titulo_resp_status_can2_vln"></label>
<label id="lb_titulo_tag_can2_vln">TAG :</label>
<label id="lb_titulo_resp_tag_can2_vln"></label>
<label id="lb_titulo_info_can2_vln">Informações :</label>
<label id="lb_titulo_resp_info_can2_vln"></label>

<label id="lb_titulo_can5_vln"></label>
<label id="lb_titulo_status_can5_vln">Condição :</label>
<label id="lb_titulo_resp_status_can5_vln"></label>
<label id="lb_titulo_tag_can5_vln">TAG :</label>
<label id="lb_titulo_resp_tag_can5_vln"></label>
<label id="lb_titulo_info_can5_vln">Informações :</label>
<label id="lb_titulo_resp_info_can5_vln"></label>

</div>

<label id="lb_titulo_can3_vln"></label>
<label id="lb_titulo_status_can3_vln">Condição :</label>
<label id="lb_titulo_resp_status_can3_vln"></label>
<label id="lb_titulo_tag_can3_vln">TAG :</label>
<label id="lb_titulo_resp_tag_can3_vln"></label>
<label id="lb_titulo_info_can3_vln">Informações :</label>
<label id="lb_titulo_resp_info_can3_vln"></label>

<label id="lb_titulo_can4_vln"></label>
<label id="lb_titulo_status_can4_vln">Condição :</label>
<label id="lb_titulo_resp_status_can4_vln"></label>
<label id="lb_titulo_tag_can4_vln">TAG :</label>
<label id="lb_titulo_resp_tag_can4_vln"></label>
<label id="lb_titulo_info_can4_vln">Informações :</label>
<label id="lb_titulo_resp_info_can4_vln"></label>




</fieldset>
</form>


</div>

<input id="btn_ca_le"  type="button" value="Abrir Cancela LE"  onclick="abrir_cancela_le();"/>
<input id="btn_ca_ld"  type="button" value="Abrir Cancela LD"  onclick="abrir_cancela_ld();"/>






<input type="button" id="rom" name="rom" value="Voltar para Automações ROM" onclick="clicou_voltar_automacao_rom();" hidden="hidden">


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<script>
var valor = 0;


function carragar_cancelas()
{
  <?php
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');// data agora
 $hora = date('H:i:s');// hora de agora
   include_once 'conexao2.php';
   $sq1 = $dbcon->query("SELECT * FROM id_cancelas_vln WHERE local_instalacao ='Várzea do Lopes Norte' OR local_instalacao ='Várzea do Lopes Norte'");
   if(mysqli_num_rows($sq1)>0)
   {
    while($dados = $sq1->fetch_array())
    {
     $id = $dados['id'];
     if($id =="3" || $id =='4')
     {
        $Nome = $dados['nomecancela'];
        $Codigo = $dados['cod'];
        $Status = $dados['condicao'];
        $TAG = $dados['tag_lida'];
        $Info = $dados['info']. "</BR><b>".$dados['data'].' '. $dados['hora'].'</b>';
        $data_banco = $dados['data'];
        $hora_banco = $dados['hora'];
        $tipo = $dados['tipo'];

        if($data_banco ==""){$data_banco = "01/01/2000";}
        if($hora_banco==""){$hora_banco = "00:00:00";}

        //Diferenca entre horario atual e historico no banco
        $hora_1 = DateTime::createFromFormat('d/m/Y H:i:s', $data_banco." ".$hora_banco);
        $hora_2 = DateTime::createFromFormat('d/m/Y H:i:s', $data." ".$hora);
        $tempo = $hora_1->diff($hora_2)->format('%H:%I:%S');
        $tempo = intval(substr($tempo,0,2))+ intval(substr($tempo,3,2));
        // Descarrega os dados
        ?>
        var nome = "<?php print $Nome ?>";
        var foto = "";
        var tempo = "<?php print $tempo ?>";
        var codigo = "<?php print $Codigo ?>";
        var status = "<?php print $Status ?>";
        


        


        if (status == "Aberta!")
        {
        status = "Aberta!";
        if(tempo>=3)
        {
            foto = "aberta_alerta";
            document.getElementById(codigo).style.background='#ffff22';
        }else
        {
            foto = "aberta";
            document.getElementById(codigo).style.background='#ffffff';
        }
            
        
        }
        else if (status == "Fechada!"){status = "Fechada!";foto = "fechada";document.getElementById(codigo).style.background='#ffffff';}
        else if (status == "Defeito!"){status = "Defeito!";foto = "defeito";document.getElementById(codigo).style.background='#ffffff';}
        else{status = "-----------";foto = "erro";document.getElementById(codigo).style.background='#ffffff';}
        
        var tag = "<?php print $TAG ?>"
        if (tag !="0" && tag!="" ){tag = tag}else{tag = "-----------------";}
        
        var info = "<?php print $Info ?>"
        
        // TITULO DA CANCELA
        var titulo  = "lb_titulo_" + codigo;  
        var lbtitulo = document.getElementById(titulo)
        lbtitulo.innerHTML = nome;

        // CONDICAO DA CANCELA
        var condicao  = "lb_titulo_resp_status_" + codigo;  
        var lbcondicao = document.getElementById(condicao)
        lbcondicao.innerHTML = status;
        // altera a foto tambem da cancela
        var imagem = document.getElementById(codigo)
        imagem.src="./images/cancela_"+foto+".png"

        
        
        // TAG DA CANCELA
        var vtag  = "lb_titulo_resp_tag_" + codigo;  
        var lbtag = document.getElementById(vtag)
        lbtag.innerHTML = tag;
        

        
        // INFO DA CANCELA
        var vinfo  = "lb_titulo_resp_info_" + codigo;  
        var lbinfo = document.getElementById(vinfo)
        lbinfo.innerHTML = info;

        <?php
     }
    } // fecha while
   } // fecha o if
   ?>

    
}


function clicou_cancela1_vln()
{
    window.location.href = `cadastrar_alteracao_cancelas.php?complemento=${criptografia2.value}&check=${criptografia.value}&local=Miguel Burnier&cancela=can1_vln&tipo=entrada`;
  
 
}
function clicou_cancela2_vln()
{
    window.location.href = `cadastrar_alteracao_cancelas.php?complemento=${criptografia2.value}&check=${criptografia.value}&local=Miguel Burnier&cancela=can2_vln&tipo=saida`;
  
 
}
function clicou_cancela3_vln()
{
    window.location.href = `cadastrar_alteracao_cancelas.php?complemento=${criptografia2.value}&check=${criptografia.value}&local=Miguel Burnier&cancela=can3_vln&tipo=entrada`;
  
 
}
function clicou_cancela4_vln()
{
    window.location.href = `cadastrar_alteracao_cancelas.php?complemento=${criptografia2.value}&check=${criptografia.value}&local=Miguel Burnier&cancela=can4_vln&tipo=saida`;
  
 
}
function clicou_cancela5_vln()
{
    window.location.href = `cadastrar_alteracao_cancelas.php?complemento=${criptografia2.value}&check=${criptografia.value}&local=Miguel Burnier&cancela=can5_vln&tipo=saida`;
  
 
}

function clicou_voltar_automacao_rom()
{
 location.href=`tela_rom.php?complemento=${criptografia2.value}&check=${criptografia.value}`;  
}




function abrir_cancela_le()
{
 nome_colaborador = '<?php print $nome ?>';
 cancela = 'Saida VLN LE';
 $.ajax({
           url: 'salva_abertura_cancelas.php',
           type: 'GET',
           dataType: 'text',
           data: {'nome': nome_colaborador,'cancela': cancela},
           success: function(resultado)
           {
            alert(resultado);  
           }
                     
         });  
}

function abrir_cancela_ld()
{
 nome_colaborador = '<?php print $nome ?>';
 cancela = 'Saida VLN LD';
 $.ajax({
           url: 'salva_abertura_cancelas.php',
           type: 'GET',
           dataType: 'text',
           data: {'nome': nome_colaborador,'cancela': cancela},
           success: function(resultado)
           {
            alert(resultado);  
           }
                     
         });  
}





setTimeout("location.reload(true);",10000); // recarrega a pagina em 10 segundos
</script>






<style>
INPUT#btn_ca_le
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:6%;
    top: 31.5%;
    width:220px;
    height:45px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 10px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_ca_le:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ca_le:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#btn_ca_ld
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:27%;
    top: 31.5%;
    width:220px;
    height: 45px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 10px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_ca_ld:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ca_ld:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





img#can3_vln{
    margin-left: 0px;
    position: absolute;
    left: 81px;
    top: 80px;
}

img#can4_vln{
    margin-left: 0px;
    position: absolute;
    left: 480px;
    top: 80px;
}


/*Labels da Cancela 1 MB  ***********************************************************************************/
label#lb_titulo_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 220px;
    top: 80px;
}

label#lb_titulo_status_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 125px;
}

label#lb_titulo_resp_status_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 295px;
    top: 125px;
}

label#lb_titulo_tag_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 150px;
}

label#lb_titulo_resp_tag_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 265px;
    top: 150px;
}


label#lb_titulo_info_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 175px;
}

label#lb_titulo_resp_info_can4_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 195px;
}





/*Labels da Cancela 2 MB  ***********************************************************************************/
label#lb_titulo_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 619px;
    top: 80px;
}

label#lb_titulo_status_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 125px;
}

label#lb_titulo_resp_status_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 694px;
    top: 125px;
}

label#lb_titulo_tag_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 150px;
}

label#lb_titulo_resp_tag_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 664px;
    top: 150px;
}


label#lb_titulo_info_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 175px;
}

label#lb_titulo_resp_info_can3_vln{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 195px;
}




DIV#cancelas_vln
{
 position: absolute;
 left: 0px;
 top: -25px;
}



#formulario_vln{
    position: absolute;
    top: 45px;
    left: 10px;
    margin-left:0px;
    margin-top:0px;
    padding-top:0px;
    padding-bottom:0px;
    padding-left:0px;
    width:1205px;
    height:450px;
    text-align:left;
    color: transparent;
    border-radius: 6px!important;
    border-color: transparent;
    border-style: solid!important;
}







IMG.foto{
    margin-left:0px;
    margin-right:10px;
    padding-top: 0px;
    padding-bottom:10px;
    padding-left:10px;
    padding-right:10px;
    background-color: #FFFFFF;
    width:100px;
    text-align:left;
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}
#text-can1{
    margin-left:0px;
    margin-right:10px;
    padding-top: 0px;
    padding-bottom:5px;
    padding-left:5px;
    width:100px;
    text-align:left;
    border-color: #191970;
    border-style: inative!important;
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


INPUT#rom
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:7%;
    top: 75%;
    width:280px;
    height:50px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;
}
INPUT#rom:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#rom:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


body{
    font: normal 12pt times;
}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>
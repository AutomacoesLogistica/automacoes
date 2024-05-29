<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<link rel="stylesheet" type="text/css" href="./css/menu_ccl_mb.css" media="screen" />

</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ccl2.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
link_criptografia2.value = lcriptografia;
</script>
<?php


}else{
?>
<script language="JavaScript">
//window.Notification="Senha Incorreta!";
//window.location="login.php";
</script>
<?php
}
?>
<center>



<input id="btn_automacoes_bal1"  type="button" value="Automações Balança 01" onclick="javascript: location.href=`http://138.0.77.80:3062/sva/ocr.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_cancelamento_tickets" class="button" type="button" value="Cancelamento Tickets" disabled='disabled' />
<input id="btn_controle_ttp" class="button" type="button" value="Controle TTP" onclick="javascript: location.href=`menu_ttp_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_gestao_bypass" class="button"  type="button" value="Gestão ByPass Automação" disabled='disabled' />
<input id="btn_conferencia_automacao_recebimento_rom" class="button" type="button" value="Conferência Automação Rec.ROM" disabled='disabled' />
<input id="btn_cancelas_mb" type="button" value="Cancelas Miguel Burnier" onclick="javascript: location.href=`consultar_cancelas_utmii.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_divergencia_pesagens" type="button" value="Divergência de Pesagens" disabled='disabled' />
<input id="btn_controle_chamados" type="button" value="Controle de Chamados" disabled='disabled' />
<input id="btn_controle_maquinas" type="button" value="Controle das Máquinas" disabled='disabled' />
<input id="btn_controle_excesso" type="button" class="BotaoMenu" value="Controle de Excessos" onclick="javascript: location.href=`http://138.0.77.80:3145/gagf/dashboard_excesso_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_pbt" type="button" value="PBT" onclick="javascript: location.href=`menu_pbt_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" disabled='disabled'/>
<input id="btn_controle_ferias" type="button" value="Controle de Férias" disabled='disabled' />
<input id="btn_df_balancas_rodoviarais" type="button" value="DF Balanças Rodoviarias" disabled='disabled' />
<input id="btn_contingencia" type="button" value="Contingência" disabled='disabled' />
<input id="btn_fechamento_turno" type="button"value="Fechamento Turno" disabled='disabled'/>
<input id="btn_diversos" type="button" value="Diversos" disabled='disabled'/>
<input id="btn_dashboard_carretas" type="button" value="DahsBoard Carretas" onclick="javascript: location.href=`grafico_colunas_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" disabled='disabled'/>
<input id="btn_display" type="button" value="Display Balanças" onclick="javascript: location.href=`display_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" disabled='disabled'/>
<input id="btn_Pires" type="button" value="Pires" onclick="javascript: location.href=`menu_pires.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_rom" type="button" value="ROM" onclick="javascript: location.href=`menu_rom.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>



<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


</body>



<style>


INPUT#btn_automacoes_bal1
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 11pt verdana;
    left:6%;
    top: 80px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_automacoes_bal1:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_automacoes_bal1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_cancelamento_tickets
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:28.5%;
    top: 80px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_cancelamento_tickets:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_cancelamento_tickets:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





INPUT#btn_controle_ttp
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:51%;
    top: 80px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer

}
INPUT#btn_controle_ttp:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_controle_ttp:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_gestao_bypass
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:73.5%;
    top: 80px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer

}
INPUT#btn_gestao_bypass:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_gestao_bypass:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_conferencia_automacao_recebimento_rom
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 11pt verdana;
    left:28.5%;
    top: 190px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer

}
INPUT#btn_conferencia_automacao_recebimento_rom:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_conferencia_automacao_recebimento_rom:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#btn_divergencia_pesagens
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:6%;
    top: 190px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_divergencia_pesagens:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_divergencia_pesagens:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_controle_chamados
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:73.5%;
    top: 190px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_controle_chamados:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px); 
}
INPUT#btn_controle_chamados:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_controle_maquinas
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:6%;
    top: 300px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_controle_maquinas:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_controle_maquinas:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_controle_excesso
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:28.5%;
    top: 300px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_controle_excesso:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_controle_excesso:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_pbt
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:51%;
    top: 300px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_pbt:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_pbt:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_controle_ferias
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:73.5%;
    top: 300px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_controle_ferias:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_controle_ferias:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}






INPUT#btn_df_balancas_rodoviarais
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:6%;
    top: 410px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_df_balancas_rodoviarais:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_df_balancas_rodoviarais:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_contingencia
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:28.5%;
    top: 410px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_contingencia:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_contingencia:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





INPUT#btn_fechamento_turno
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:51%;
    top: 410px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_fechamento_turno:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_fechamento_turno:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#btn_diversos
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:73.5%;
    top: 410px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_diversos:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_diversos:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#btn_dashboard_carretas
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:6%;
    top: 520px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_dashboard_carretas:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_dashboard_carretas:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_cancelas_mb
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:51%;
    top: 190px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_cancelas_mb:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_cancelas_mb:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_display
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:28.5%;
    top: 520px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_display:hover
{
 background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_display:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#btn_Pires
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:51%;
    top: 520px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_Pires:hover
{
  background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_Pires:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_rom
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:73.5%;
    top: 520px;
    width:21%;
    height:12%;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_rom:hover
{
  background-color: #555555; /* Preto */
 color: white;
 box-shadow: 0 5px #666;
 transform: translateY(2px);
}
INPUT#btn_rom:active {
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
    left: 40%;
    top: 88%;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3%;
    top: 0%;
    width:92.9%;
    height:3%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 6%;
    top: -10%;
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

body{

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>



</html>
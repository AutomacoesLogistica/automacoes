<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Dados Cadastrais</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">

<script type="text/javascript">



 function alterar_foto(){
   

  alert("entrou");
 
  
 
  
    <?php
  
    $variavelphp = "<script>document.write(variaveljs)</script>";
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE lista_usuarios SET nome_usuario='$variavelphp'WHERE id='2'");
    
     
    
    ?>
   //UPDATE `lista_usuarios` SET `nome_usuario` = 'bru' WHERE `lista_usuarios`.`id` = 2;
   alert("Salvo com sucesso no banco de dados");
    
   
    
 }



 function alterar_dados_motorista()
 {
     
    var linkbtnEditarMotorista = window.document.getElementById("btnEditarDadosMotorista")
    

    
    if (linkbtnEditarMotorista.value=="Salvar")
    {

    window.document.getElementById("tbNome").disabled = true;
    window.document.getElementById("tbNascimento").disabled = true;
    window.document.getElementById("tbCPF").disabled = true;
    window.document.getElementById("tbCNH").disabled = true;
    window.document.getElementById("tbvalCNH").disabled = true;
    window.document.getElementById("tbContato").disabled = true;
    window.document.getElementById("tbtagMotorista_atual").disabled = true;
    window.document.getElementById("tbtagMotorista_antiga").disabled = true;
    //window.document.getElementById("tbPontuacao").disabled = true;
    linkbtnEditarMotorista.value="Alterar";
    var linksalvar = window.document.getElementById('btnTesteSalvar').click();
    
    
    }
    else
    {
    window.document.getElementById("tbNome").disabled = false;
    window.document.getElementById("tbNascimento").disabled = false;
    window.document.getElementById("tbCPF").disabled = false;
    window.document.getElementById("tbCNH").disabled = false;
    window.document.getElementById("tbvalCNH").disabled = false;
    window.document.getElementById("tbContato").disabled = false;
    window.document.getElementById("tbtagMotorista_atual").disabled = false;
    window.document.getElementById("tbtagMotorista_antiga").disabled = false;
    //window.document.getElementById("tbPontuacao").disabled = false;
    linkbtnEditarMotorista.value="Salvar";
    }
  
 }

function alterar_dados_endereco()
{
    var linkbtnEditarEndereco = window.document.getElementById("btnEditarDadosEndereco")

    if (linkbtnEditarEndereco.value=="Salvar")
    {
     // Aqui vira a parte de salvar no banco de dados 

     window.document.getElementById("tbRua").disabled = true;
     window.document.getElementById("tbBairro").disabled = true;
     window.document.getElementById("tbCidade").disabled = true;
     window.document.getElementById("tbCep").disabled = true;
     window.document.getElementById("tbEstado").disabled = true;
     linkbtnEditarEndereco.value= "Alterar"
     var linksalvar = window.document.getElementById('btnSalvarEndereco').click();
    }
    else{
    window.document.getElementById("tbRua").disabled = false;
    window.document.getElementById("tbBairro").disabled = false;
    window.document.getElementById("tbCidade").disabled = false;
    window.document.getElementById("tbCep").disabled = false;
    window.document.getElementById("tbEstado").disabled = false;
    linkbtnEditarEndereco.value= "Salvar"
    }
}







function alterar_dados_complementares()
{
    var linkbtnEditarDadosomplementares = window.document.getElementById("btnAlterarDadosComplementares")
   
    if (linkbtnEditarDadosomplementares.value=="Salvar")
    {
     // Aqui vira a parte de salvar no banco de dados 
     window.document.getElementById("select_TransportadoraA").style.backgroundColor = "#ebebe4";
     window.document.getElementById("select_TransportadoraU").style.backgroundColor = "#ebebe4";
     window.document.getElementById("select_TransportadoraA").disabled = true;
     window.document.getElementById("spot_sim").disabled = true;
     window.document.getElementById("lbspot_sim").disabled = true;
     window.document.getElementById("spot_nao").disabled = true;
     window.document.getElementById("lbspot_nao").disabled = true;
     window.document.getElementById("ativo_sim").disabled = true;
     window.document.getElementById("lbativo_sim").disabled = true;
     window.document.getElementById("ativo_nao").disabled = true;
     window.document.getElementById("lbativo_nao").disabled = true;
     window.document.getElementById("select_TransportadoraU").disabled = true;
     window.document.getElementById("tbTipo").disabled = true;
     linkbtnEditarDadosomplementares.value= "Alterar"
     var linksalvar = window.document.getElementById('btnSalvarComplemento').click();
    }
    else{
     window.document.getElementById("select_TransportadoraA").style.backgroundColor = "#ffffff";
     window.document.getElementById("select_TransportadoraU").style.backgroundColor = "#ffffff";
     window.document.getElementById("select_TransportadoraA").disabled = false;
     window.document.getElementById("spot_sim").disabled = false;
     window.document.getElementById("lbspot_sim").disabled = false;
     window.document.getElementById("spot_nao").disabled = false;
     window.document.getElementById("lbspot_nao").disabled = false;
     window.document.getElementById("ativo_sim").disabled = false;
     window.document.getElementById("lbativo_sim").disabled = false;
     window.document.getElementById("ativo_nao").disabled =false;
     window.document.getElementById("lbativo_nao").disabled = false;
     window.document.getElementById("select_TransportadoraU").disabled = false;
     window.document.getElementById("tbTipo").disabled = false;
    linkbtnEditarDadosomplementares.value= "Salvar"
    }
}











function buscar_motorista()
{
    document.getElementById("lbStatus").style.visibility = "hidden"; // Inicia se está bloqueado invisivel


var nome = ""
var data = ""
var cpf = ""
var cnh = ""
var vcnh = ""
var cel = ""
var atual = ""
var antiga = ""
var ponto = ""
var bloqueado = ""
var retorno = ""

var rua = ""
var bairro = ""
var cidade = ""
var cep = ""
var estado =""

var transportadoraA =""
var spot =""
var cadastro_ativo =""
var transportadoraU =""
var tipo_veiculo =""

var encontrado = 0

  <?php
 include_once 'conexao.php';
 $cpf = $_POST['cpf'];
 $sql = $dbcon->query("SELECT * FROM lista_motoristas WHERE cpf='$cpf'");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $nome = mb_strtoupper($dados['nome'],'UTF8');
   $data = mb_strtoupper($dados['data_nascimento'],'UTF8');
   $cpf = mb_strtoupper($dados['cpf'],'UTF8');
   $cnh = mb_strtoupper($dados['cnh'],'UTF8');
   $vcnh = mb_strtoupper($dados['validadecnh'],'UTF8');
   $cel = mb_strtoupper($dados['celular'],'UTF8');
   $atual = mb_strtoupper($dados['tag_motorista_atual'],'UTF8');
   if($atual == ""){$atual = "NÃO ESPECIFICADO!";}
   $antiga = mb_strtoupper($dados['tag_motorista_antiga'],'UTF8');
   if($antiga == ""){$antiga = "NÃO ESPECIFICADO!";}
   $ponto = mb_strtoupper($dados['ponto'],'UTF8');
   if($ponto == ""){$ponto = "PENDENTE";}
   $bloqueado = mb_strtoupper($dados['bloqueio'],'UTF8');
   if($bloqueado == ""){ $bloqueado = "LIBERADO";}
   $retorno = mb_strtoupper($dados['retorno'],'UTF8');
   if($retorno == ""){$retorno = "";}
   
   $rua = $dados['rua'];
   $bairro = mb_strtoupper($dados['bairro'],'UTF8');
   $cidade = mb_strtoupper($dados['cidade'],'UTF8');
   $cep = mb_strtoupper($dados['cep'],'UTF8');
   $estado = mb_strtoupper($dados['uf'],'UTF8');


   $transportadoraA = mb_strtoupper($dados['nome_transportadora_a'],'UTF8');
   $spot = mb_strtoupper($dados['motorista_spot'],'UTF8');
   $cadastro_ativo = mb_strtoupper($dados['cadastro_ativo'],'UTF8');
   $transportadoraU = mb_strtoupper($dados['nome_transportadora_u'],'UTF8');
   $tipo_veiculo = mb_strtoupper($dados['tipo_veiculo_2'],'UTF8');
 
  ?>
   encontrado = 1
   nome ="<?php print $nome ?>"
   data ="<?php print $data ?>"
   cpf ="<?php print $cpf ?>"
   cnh ="<?php print $cnh ?>"
   vcnh ="<?php print $vcnh ?>"
   cel ="<?php print $cel ?>"
   atual ="<?php print $atual ?>"
   antiga ="<?php print $antiga ?>"
   ponto ="<?php print $ponto ?>"
   bloqueado ="<?php print $bloqueado ?>"
   retorno ="<?php print $retorno ?>"

   rua ="<?php print $rua ?>"
   bairro ="<?php print $bairro ?>"
   cidade ="<?php print $cidade ?>"
   cep ="<?php print $cep ?>"
   estado ="<?php print $estado ?>"

   transportadoraA ="<?php print $transportadoraA ?>"
   spot ="<?php print $spot ?>"
   cadastro_ativo ="<?php print $cadastro_ativo ?>"
   transportadoraU ="<?php print $transportadoraU ?>"
   tipo_veiculo ="<?php print $tipo_veiculo ?>"

  
  <?php
  
 
  }
 }
 else
 {
    ?>
    encontrado = 0
    alert("CPF Não consta no banco de dados do sistema!")
    <?php
 }
 ?>


if ( encontrado == 1)
{
var lnome = window.document.getElementById("tbNome")
var lnascimento = window.document.getElementById("tbNascimento")
var lCPF = window.document.getElementById("tbCPF")
var lCNH = window.document.getElementById("tbCNH")
var lvalCNH = window.document.getElementById("tbvalCNH")
var lcel = window.document.getElementById("tbContato")
var ltagAtual = window.document.getElementById("tbtagMotorista_atual")
var ltagAntiga = window.document.getElementById("tbtagMotorista_antiga")
var lpontuacao = window.document.getElementById("tbPontuacao")
var lbloqueio = window.document.getElementById("lbStatus")



var lrua = window.document.getElementById("tbRua")
var lbairro = window.document.getElementById("tbBairro")
var lcidade = window.document.getElementById("tbCidade")
var lcep = window.document.getElementById("tbCep")
var lestado = window.document.getElementById("tbEstado")

var ltransportadoraA = window.document.getElementById("select_TransportadoraA")
var lspot_sim = window.document.getElementById("spot_sim")
var lspot_nao = window.document.getElementById("spot_nao")
var lativo_sim = window.document.getElementById("ativo_sim")
var lativo_nao = window.document.getElementById("ativo_nao")
var ltransportadoraU = window.document.getElementById("select_TransportadoraU")
var ltipo_veiculo = window.document.getElementById("tbTipo")

lnome.value= nome
lnascimento.value= data
lCPF.value= cpf
lCNH.value= cnh
lvalCNH.value=vcnh
lcel.value=cel
ltagAtual.value=atual
ltagAntiga.value=antiga
lpontuacao.value=ponto
lbloqueio.value=bloqueado


lrua.value=rua
lbairro.value=bairro
lcidade.value=cidade
lcep.value=cep
lestado.value=estado

ltransportadoraA.value = transportadoraA
ltransportadoraU.value = transportadoraU
ltipo_veiculo.value = tipo_veiculo


if (cadastro_ativo == "SIM")
{
    document.getElementById('ativo_sim').checked = true;
}
else if (cadastro_ativo=="NÃO")
{
    document.getElementById('ativo_nao').checked = true;
}
else
{
    document.getElementById('ativo_sim').checked = false;
    document.getElementById('ativo_nao').checked = false;  
}







if (spot == "SIM")
{
    document.getElementById('spot_sim').checked = true;
}
else if (spot=="NÃO")
{
    document.getElementById('spot_nao').checked = true;
}
else
{
    document.getElementById('spot_sim').checked = false; 
    document.getElementById('spot_nao').checked = false;
}


if (bloqueado == "LIBERADO")
{
    document.getElementById("lbStatus").style.visibility = "hidden"; // Inicia se está bloqueado invisivel
}
else
{
    lbloqueio.innerHTML= "BLOQUEADO! <br/> Retorno previsto em : " + retorno;

    document.getElementById("lbStatus").style.visibility = "visible"; // Inicia se está bloqueado invisivel
}



}


}

</script>







<script type="text/javascript">
  var variaveljs = 'Mauricio Programador';
 </script>





 </head>
<body onload="buscar_motorista()">






<div>
<form method="get" action="consultar_cancela.php">

<fieldset id="formulario_nome" ><legend>Dados Motorista</legend>
<label id="lbNome">Nome :</label>
<input id="tbNome" type="text" name="tbNome" value="" disabled />
<label id="lbNascimento">Nascimento :</label>
<input id="tbNascimento" type="text" name="data" value="" disabled />

<?php
// Busca a foto da pessoa
$cpf = $_POST['cpf'];

if(is_file("C:/xampp/htdocs/GAGF/cadastros/$cpf/$cpf.JPG"))// Verifica se a pasta existe
  {
   
  }
  else{
   $cpf = "000.000.000-00"; // para puxar o padrao
  }



?>



<img id="foto" src="./cadastros/<?php echo $cpf?>/<?php echo $cpf?>.JPG" id="foto" onclick="alterar_foto()">

<label id="lbCPF">CPF :</label>
<input id="tbCPF" type="text" name="cpf" value="" disabled />
<label id="lbCNH">CNH :</label>
<input id="tbCNH" type="text" name="cnh" value="" disabled />
<label id="lbvalCNH" >Validade da CNH :</label>
<input id="tbvalCNH" type="text" name="validade_cnh" value="" disabled />
<label id="lbContato">Contato :</label>
<input id="tbContato" type="text" name="contato" value="" disabled />
<label id="lbtagMotorista_atual">TAG Motorista ( Atual )</label>
<input id="tbtagMotorista_atual" type="text" name="tagMotorista_atual" value="" disabled />
<label id="lbtagMotorista_antiga">TAG Motorista ( Antiga )</label>
<input id="tbtagMotorista_antiga" type="text" name="tagMotorista_antiga" value="" disabled />
<label id="lbPontuacao">Pontuação do Motorista :</label> 
<input id="tbPontuacao" type="text" name="pontuacao" value="" disabled />
<label id="lbStatus">BLOQUEADO! Retorno: 00/00/0000</label>
<input id="btnEditarDadosMotorista" type="button" value="Alterar" onclick="alterar_dados_motorista()" />
<input id="btnImprimirDadosMotorista" type="button" value="Imprimir"  onclick="window.print();" />
<input id="btnAplicarSancao" type="button" value="Aplicar Sanção" onclick="javascript: location.href=`aplicar_sancao.php?cpf=${tbCPF.value}`;"/>
<input id="btnTesteSalvar" type="button" value="btnTesteSalvar" hidden="hidden" onclick="javascript: location.href=`salvar_dadosmotorista.php?nome=${tbNome.value}&nas=${tbNascimento.value}&cpf=${tbCPF.value}&cnh=${tbCNH.value}&val_cnh=${tbvalCNH.value}&contato=${tbContato.value}&tag_atual=${tbtagMotorista_atual.value}&tag_antiga=${tbtagMotorista_antiga.value}&pontuacao=${tbPontuacao.value}`;">
</fieldset>

</form>
</div>
<div>

<form method="get" action="consultar_cancela2.php">
<!-- DADOS DO ENDEREÇO *****************************************************************************************************************-->

<fieldset id="formulario_endereco" ><legend>Endereço</legend>
<label id="lbRua" >Rua :</label>
<input id="tbRua" type="text" name="rua" value="" disabled />
<label id="lbBairro">Bairro :</label>
<input id="tbBairro" type="text" name="bairro" value="" disabled />
<label id="lbCidade">Cidade :</label>
<input id="tbCidade" type="text" name="cidade" value="" disabled />
<label id="lbCep">CEP :</label>
<input id="tbCep" type="text" name="cep" value="" disabled />
<label id="lbEstado">Estado (UF):</label>
<input id="tbEstado" type="text" name="estado" value="" disabled />
<input id="btnEditarDadosEndereco" type="button" value="Alterar" onclick="alterar_dados_endereco()" />
<input id="btnSalvarEndereco" type="button" value="btnSalvarEndereco" hidden="hidden"  onclick="javascript: location.href=`salvar_dados_endereco.php?rua=${tbRua.value}&bairro=${tbBairro.value}&cidade=${tbCidade.value}&cep=${tbCep.value}&uf=${tbEstado.value}&cpf=${tbCPF.value}`;">
</fieldset>


<!-- DADOS DO COMPLEMENTARES ***********************************************************************************************************-->
<fieldset id="formulario_complementares" ><legend>Dados Complementares</legend>
<label id="lbTransportadoraA">Transportadora Atual:</label>


<?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_transportadoras");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="select_TransportadoraA" id="select_TransportadoraA" disabled>
 <?php
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome_transportadora'];
  echo"<option>$mensagem</option>";
 }
}
?>
<option SELECTED></option>
</select>


<label id="lbSpot">SPOT :</label>
<input type="radio" name="spot" id="spot_sim" value="Sim" checked  disabled  />
<label id="lbspot_sim" for="spot_sim">Sim</label>
<input type="radio" name="spot" id="spot_nao" value="Não"  disabled />
<label id="lbspot_nao" for="spot_nao">Não</label>
<label id="lbCadastro"> Cadastro Ativo : </label>
<input id="ativo_sim"   type="radio" name="ativo" value="Sim" checked  disabled  />
<label id="lbativo_sim" for="ativo_sim">Sim</label>
<input id="ativo_nao"   type="radio" name="ativo" value="Não"  disabled />
<label id="lbativo_nao" for="ativo_nao">Não</label>
<label id="lbTransportadoraU">Transportadora Anterior:</label>

<?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_transportadoras");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="select_TransportadoraU" id="select_TransportadoraU" disabled>
 <?php
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome_transportadora'];
  echo"<option>$mensagem</option>";
 }
}
?>
<option SELECTED></option>

</select>
<label id="lbTipo">Tipo Veículo :</label>
<input id="tbTipo" type="text" name="tbTipo" value="" disabled />

<input id="btnAlterarDadosComplementares" type="button" value="Alterar" onclick="alterar_dados_complementares()" />
<input id="btnDocumentacao" type="button" value="Documentação" onclick="javascript: location.href=`exibir_documentos.php?documentos=${tbCPF.value}`;" />

<input id="btnSalvarComplemento" type="button" value="btnSalvarComplemento"  hidden="hidden" onclick="javascript: location.href=`salvar_dados_complemento.php?select_TransportadoraA=${select_TransportadoraA.value}&select_TransportadoraU=${select_TransportadoraU.value}&cpf=${tbCPF.value}&spot=${spot.value}&ativo=${ativo.value}&tipo=${tbTipo.value}`;">
</fieldset>

<br/>

<input style="margin-left: 10px;" class="BotaoMenu" type="button" value="Voltar" onclick="javascript: location.href='consultar_motorista1.php';" />
<input style="margin-left: 10px;" class="BotaoMenu_historico" type="button" value="Consultar Histórico" onclick="javascript: location.href=`consultar_historico1.php?documentos=${tbCPF.value}`;" />
<br/>
</form> 
</div>




















</body>


<style>
body{
    text-align: left;
    margin-top: 30px !important;
    margin-left: 60px !important;
    
}

html{
margin-top: 0px !important;
margin-left: 0px !important;
background: url("./images/q.png");
background-size: 100%;
}

INPUT.BotaoMenu {
     width: 140px;
     height: 26px;
     font-weight: bold
     font-family: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}
INPUT.BotaoMenu_historico {
     width: 150px;
     height: 26px;
     font-weight: bold
     font-family: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

INPUT.BotaoMenu_documentacao {
     width: 150px;
     height: 26px;
     font: bold 10pt Arial;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

#foto{
    margin-left: 0px;
    position: absolute;
    left: 1105px;
    top: 38px;
    width: 190px;
    height: 210px;
    border-radius: 10px!important;
    border-color: #191970;
    border-style: solid!important;

}

Label#lbNome{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 80px;
    top: 70px;
}
input#tbNome{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 140px;
    top: 70px;
    width:590px;
    height:18px;
    padding-left: 5px;
}

Label#lbNascimento{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 754px;
    top: 70px;   
}

input#tbNascimento{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 850px;
    top: 70px;
    width:120px;
    height:18px;
    padding-left: 5px;
}

Label#lbCPF{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 80px;
    top: 108px;   
}

input#tbCPF{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 140px;
    top: 105px;
    width:120px;
    height:18px;
    padding-left: 5px;
}
Label#lbCNH{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 280px;
    top: 108px;   
}

input#tbCNH{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 330px;
    top: 105px;
    width:120px;
    height:18px;
    padding-left: 5px;
}

Label#lbvalCNH{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 470px;
    top: 108px;   
}

input#tbvalCNH{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 210px;
    top: 140px;
    left: 600px;
    top: 105px;
    padding-left: 5px;
}

Label#lbContato{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 780px;
    top: 108px;   
}

input#tbContato{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 850px;
    top: 105px;
    width:140px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbtagMotorista_atual{
    margin-left: 0px;
    position: absolute;
    left: 80px;
    top: 143px;
}
INPUT#tbtagMotorista_atual{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 250px;
    top: 140px;
    width:210px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbtagMotorista_antiga{
    margin-left: 0px;
    position: absolute;
    left: 500px;
    top: 143px;
}
INPUT#tbtagMotorista_antiga{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 680px;
    top: 140px;
    width:210px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbPontuacao{
    margin-left: 0px;
    position: absolute;
    left: 80px;
    top: 177px;
}
INPUT#tbPontuacao{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 250px;
    top: 174px;
    width:90px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbStatus{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: red;
    background-color: none;
    left: 835px;
    top: 200px;
 
}



INPUT#btnEditarDadosMotorista{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 80px;
    top: 215px;
    width:90px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

INPUT#btnImprimirDadosMotorista{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 185px;
    top: 215px;
    width:90px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

INPUT#btnAplicarSancao{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 290px;
    top: 215px;
    width:130px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

INPUT#btnTesteSalvar{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 590px;
    top: 215px;
    width:130px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

fieldset#formulario_endereco{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    height: 105px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}


LABEL#lbRua{
    margin-left: 0px;
    position: absolute;
    left: 80px;
    top: 290px;
}
INPUT#tbRua{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left:124px;
    top: 288px;
    width:705px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbBairro{
    margin-left: 0px;
    position: absolute;
    left: 864px;
    top: 290px;
}
INPUT#tbBairro{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left:924px;
    top: 288px;
    width:330px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbCidade{
    margin-left: 0px;
    position: absolute;
    left: 80px;
    top: 325px;
}
INPUT#tbCidade{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left:140px;
    top: 323px;
    width:689px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbCep{
    margin-left: 0px;
    position: absolute;
    left: 876px;
    top: 325px;
}
INPUT#tbCep{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left:924px;
    top: 323px;
    width:120px;
    height:18px;
    padding-left: 5px;
}

LABEL#lbEstado{
    margin-left: 0px;
    position: absolute;
    left: 1080px;
    top: 325px;
}
INPUT#tbEstado{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left:1174px;
    top: 323px;
    width:80px;
    height:18px;
    padding-left: 5px;
}

INPUT#btnEditarDadosEndereco{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 80px;
    top: 365px;
    width:90px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

INPUT#btnSalvarEndereco{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 590px;
    top: 365px;
    width:130px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}




fieldset#formulario_complementares{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    height: 105px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}


LABEL#lbTransportadoraA{
    margin-left: 0px;
    position: absolute;
    left: 80px;
    top: 440px;
}
SELECT#select_TransportadoraA{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: #ebebe4;
    left:245px;
    top: 438px;
    width:510px;
    height:25px;
    padding-left: 5px;
}

LABEL#lbSpot{
    margin-left: 0px;
    position: absolute;
    left: 780px;
    top: 440px;
}

INPUT#spot_sim{
    margin-left: 0px;
    position: absolute;
    left: 840px;
    top: 440px;
}
LABEL#lbspot_sim{
    margin-left: 0px;
    position: absolute;
    left: 860px;
    top: 440px;
}

INPUT#spot_nao{
    margin-left: 0px;
    position: absolute;
    left: 900px;
    top: 440px;
}
LABEL#lbspot_nao{
    margin-left: 0px;
    position: absolute;
    left: 920px;
    top: 440px;
}

LABEL#lbCadastro{
    margin-left: 0px;
    position: absolute;
    left: 990px;
    top: 440px;
}

INPUT#ativo_sim{
    margin-left: 0px;
    position: absolute;
    left: 1105px;
    top: 440px;
}
LABEL#lbativo_sim{
    margin-left: 0px;
    position: absolute;
    left: 1125px;
    top: 440px;
}

INPUT#ativo_nao{
    margin-left: 0px;
    position: absolute;
    left: 1165px;
    top: 440px;
}
LABEL#lbativo_nao{
    margin-left: 0px;
    position: absolute;
    left: 1185px;
    top: 440px;
}






LABEL#lbTransportadoraU{
    margin-left: 0px;
    position: absolute;
    left: 80px;
    top: 470px;
}
SELECT#select_TransportadoraU{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: #ebebe4;
    left:245px;
    top: 468px;
    width:510px;
    height:25px;
    padding-left: 5px;
}
LABEL#lbTipo{
    margin-left: 0px;
    position: absolute;
    left: 780px;
    top: 470px;
}

INPUT#tbTipo{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left:880px;
    top: 468px;
    width:330px;
    height:18px;
    padding-left: 5px;
}

INPUT#btnAlterarDadosComplementares{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 80px;
    top: 515px;
    width:90px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

INPUT#btnDocumentacao{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 185px;
    top: 515px;
    width:130px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}


INPUT#btnSalvarComplemento{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left: 590px;
    top: 515px;
    width:130px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}
















fieldset#formulario_nome{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:30px;
    padding-left:20px;
    width:1000px;
    height: 170px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}


#formulario2{
    loat:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1163px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;

}









</style>









</html>

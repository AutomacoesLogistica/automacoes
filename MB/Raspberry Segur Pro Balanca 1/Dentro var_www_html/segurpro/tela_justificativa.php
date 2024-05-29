<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Automações Saida Balanca 1</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>


<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href='./tela_segur_pro.php';"/>

<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>


<?php
$id = isset($_GET['id'])?$_GET['id']:'vazio';



include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM historico_display WHERE id='$id'  LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $v_placa_cavalo = $dados['placa_cavalo'];
 if($v_placa_cavalo == ''){$v_placa_cavalo = '--';}
 $v_placa_carreta = $dados['placa_carreta'];
 if($v_placa_carreta == ''){$v_placa_carreta = '--';}
 $v_ponto = $dados['ponto'];
 if($v_ponto == 'mg')
 {
  $v_ponto = 'MG030';
 }
 else if($v_ponto == 'balanca')
 {
  $v_ponto  = 'Balança';
 }
 else
 {
  $v_ponto = 'Saida Automações';
 }
 $v_condicao = $dados['condicao1'];
 if($v_condicao == '')
 {
  $v_condicao ='Aguardando';
 }
 /*
  echo '</BR>';  echo '</BR>';  echo '</BR>';  echo '</BR>';
  echo $id;
  echo '</BR>';
  echo 'Placa do cavalo: ' .$v_placa_cavalo;
  echo '</BR>';
  echo 'Placa da carreta: ' .$v_placa_carreta;
  echo '</BR>';
  echo 'Ponto : '. $v_ponto;
  echo '</BR>';
  echo 'Condição : ' . $v_condicao;
  */
}
?>
<label id="lb_titulo">Validações Segur PRO </label>

<label id="lb_id">ID da detecção: <?php print $id ?></label>
<label id="lb_placa_cavalo">Placa do Cavalo: <?php print $v_placa_cavalo ?></label>
<label id="lb_placa_carreta">Placa do Carreta: <?php print $v_placa_carreta ?></label>
<label id="lb_ponto">Ponto que foi o veículo foi validado: <?php print $v_ponto ?></label>
<label id="lb_condicao">Condição atual do veículo: <?php print $v_condicao ?></label>
<label id="lb_registro">Registro:</label> 
<input type="number" id="txt_registro" name="txt_registro" value="">
<label id="lb_senha">Senha:</label> 
<input type="password" id="txt_password" name="txt_password" value="" autocomplete="off">
<input type="text" id="txt_id" name="txt_id" value="<?php print $id ?>" hidden="hidden">
<label id="lb_justificativa">Descrição da Justificativa:</label> 
<textarea id="t_justificativa" name="t_justificativa" rows="4" cols="75" maxlength="300"></textarea>

<input type="button" id="salvar" name="salvar" value="Salvar Dados" onclick="salvar()"/>



<label id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </label>




</body>

<script> 


function salvar(){

    var link_registro = document.getElementById("txt_registro");
    var link_password = document.getElementById("txt_password");
    var link_justificativa = document.getElementById("t_justificativa");
    var link_id = document.getElementById("txt_id");
    console.log(link_id.value);
    console.log(link_password.value);
    console.log(link_registro.value);
    console.log(link_justificativa.value);
    if( link_registro.value != "" && link_password.value != "" && link_justificativa.value != "" )
    {
        //alert("OK");
        
        $.ajax({
           url: 'salvar_justificativa.php',
           type: 'GET',
           dataType: 'html',
           data: {"registro":link_registro.value,"vsenha":link_password.value,"justificativa":link_justificativa.value,"id":link_id.value},
           success: function(resultado)
           {
            
            //alert(resultado);
            //recarregar_configuracoes(); 
            if(resultado == "ok")
            {
                alert('salvo');
                location.href="./tela_poste_display.php";   
            }
            else if(resultado == "nok2")
            {
             alert("ATENÇÃO: Usuario não cadastrado no sistema, verifique se não foi digitado o usuario errado!");
             link_registro.value="";
             link_registro.focus();
             link_password.value="";
            }
            else if(resultado == "nok3")
            {
             alert("ATENÇÃO: A senha inserida não está correta, favor verificar!");
             link_password.value = "";
             link_password.focus();
            }
          }
         });
    
    
    }
    else if(link_registro.value =="")
    {
        alert("Favor preencher seu registro!");
        link_registro.focus();
    }
    else if(link_senha.value =="")
    {
        alert("Favor preencher a sua senha!");
        link_senha.focus();
    }
    else{
        alert("Favor preencher a sua justificativa!");
        link_justificativa.focus();
    }


    
    //alert(link_rb_automacao_completa);
    
}

</script>



<style>


LABEL#lb_titulo{
    margin-left: 0px;
    position: absolute;
    left: 31%;
    top: 3%;
    font: bold 30pt verdana;
    color:rgb(0,0,220);
}

LABEL#lb_id{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 15%;
    font: bold 20pt verdana;
    color:#000000;
}
LABEL#lb_placa_cavalo{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 25%;
    font: bold 20pt verdana;
    color:#000000;
}

LABEL#lb_placa_carreta{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 25%;
    font: bold 20pt verdana;
    color:#000000;
}
LABEL#lb_ponto{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 35%;
    font: bold 20pt verdana;
    color:#000000;
}
LABEL#lb_condicao{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 15%;
    font: bold 20pt verdana;
    color:#000000;
}

LABEL#lb_registro{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 45%;
    font: bold 20pt verdana;
    color:#000000;
}
INPUT#txt_registro{
    margin-left: 0px;
    position: absolute;
    left: 15%;
    top: 45%;
    width: 13%;
    font: bold 20pt verdana;
    color:#000000;
}

LABEL#lb_senha{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 45%;
    font: bold 20pt verdana;
    color:#000000;
}
INPUT#txt_password{
    margin-left: 0px;
    position: absolute;
    left: 43%;
    top: 45%;
    width: 20%;
    font: bold 20pt verdana;
    color:#000000;
}


LABEL#lb_justificativa{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 55%;
    font: bold 20pt verdana;
    color:#000000;
}
TEXTAREA#t_justificativa{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 60%;
    font: bold 20pt verdana;
    color:#000000;
}


INPUT#salvar
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 18pt verdana;
    width:20%;
    height:10%;
    text-align: center;
    left: 5%;
    top: 81%;
    background-color: #29A1AB;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}
INPUT#salvar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#salvar:active {
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


LABEL#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 92%;
    font: normal 22pt verdana;
    color:rgb(0,0,0);
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
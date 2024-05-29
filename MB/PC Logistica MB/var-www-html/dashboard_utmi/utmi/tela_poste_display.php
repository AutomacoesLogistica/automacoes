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
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" hidden="hidden"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" hidden="hidden"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>







<div id='base_eventos' name='base_eventos' >


<div id="tabela" name="tabela">
<table border= 2px; >
  <thead >
    <tr>
      <th class="th1_1">Data/Hora</th>
      <th class="th2_1">Placa Cavalo</th>
      <th class="th3_1">Placa Carreta</th>
      <th class="th5_1">Condição</th>
      <th class="th6_1">SegurPro</th>
      <th class="th7_1">CCL</th>
      

    </tr>
  </thead>
  <tbody>

 <?php
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');

include_once 'conexao_excesso.php';
$encontrado = 0;
$array_placa_cavalo=array();
$array_placa_carreta=array();
$array_data_hora=array();
$array_ponto=array();
$array_condicao=array();
$array_tratado_por_segurpro=array();
$array_tratado_por_ccl=array();
$array_id=array();
$array_motorista=array();
$array_destino=array();


$sql = $dbcon->query("SELECT * FROM historico_display WHERE condicao1 != 'Aguardando' ORDER BY id DESC LIMIT 6");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrado = intval($encontrado)+1;  
  if($encontrado == 1)
  {
    $ultimo_id = $dados['id']; //Guardo o ultimo id do banco para saber se tem dado novo e pode atualizar
  }
  
  $v_placa_cavalo = $dados['placa_cavalo'];
  if($v_placa_cavalo == ''){$v_placa_cavalo = '--';}
  $array_placa_cavalo[$encontrado] =$v_placa_cavalo;
  $v_placa_carreta = $dados['placa_carreta'];
  if($v_placa_carreta == ''){$v_placa_carreta = '--';}
  $array_placa_carreta[$encontrado] = $v_placa_carreta;
  $v_ponto = $dados['ponto'];
  $v_motorista = $dados['motorista'];
  $array_destino[$encontrado] = $dados['destino'];

  if($v_ponto == 'mg')
  {
   $array_ponto[$encontrado] = 'MG030';
  }
  else if($v_ponto == 'balanca')
  {
   $array_ponto[$encontrado] = 'Balança';
  }
  else
  {
   $array_ponto[$encontrado] = 'Saida Automações';
  }
  $v_data =$dados['data_aqui1'];
  $v_hora =$dados['hora_aqui1'];
  if($v_data == ''){$array_data_hora[$encontrado] = '--';}else{$array_data_hora[$encontrado] = ($v_data . ' ' . $v_hora);}
  $v_condicao = $dados['condicao1'];
  if($v_condicao == ''){$array_condicao[$encontrado] ='Aguardando';}else{$array_condicao[$encontrado] =$v_condicao;}
  
  $v_tratado_por_segurpro = $dados['tratado_por_segurpro'];
  if($v_tratado_por_segurpro == ''){$array_tratado_por_segurpro[$encontrado] ='--';}else{$array_tratado_por_segurpro[$encontrado] =$v_tratado_por_segurpro;}
  
  $v_tratado_por_ccl = $dados['tratado_por_ccl'];
  if($v_tratado_por_ccl == ''){$array_tratado_por_ccl[$encontrado] ='--';}else{$array_tratado_por_ccl[$encontrado] =$v_tratado_por_ccl;}
  $array_id[$encontrado] = $dados['id'];
  



  if($array_condicao[$encontrado]=="Tratando" || $array_condicao[$encontrado]=="Tratando!")
  {
   $cor_da_base = "#F5DEB3";
   }
  else if ($array_condicao[$encontrado]=="Concluído")
  {
   $cor_da_base = "#32CD32"; // Verde
  }
  else if ($array_condicao[$encontrado]=="Concluido2")
  {
   $cor_da_base = "#228B22"; // Verde Escuro
   $array_condicao[$encontrado]="Concluido</BR><b>Saindo Vazio da Mina!</b>";
  }
  else if ($array_condicao[$encontrado]=="Carga Descentralizada!" || $array_condicao[$encontrado]=="Excesso/Falta")
  {
   $cor_da_base = "#FFD700"; // GOLD
   if($array_condicao[$encontrado]=="Excesso/Falta")
   {
   $array_condicao[$encontrado]="Excesso ou Falta</BR><b>Ação CCL Logistica</b>";
   }
   else if($array_condicao[$encontrado]=="Carga Descentralizada")
   {
   $array_condicao[$encontrado]="Carga Descentralizada</BR><b>Ação CCL Logistica</b>";
   }
  }
  else if ($array_condicao[$encontrado]=="Patrimonial Validar!")
  {
   $cor_da_base = "red"; // Vermelho
   $array_condicao[$encontrado]="Verificar Ticket</BR><b>Ação Patrimonial</b>";
  }

  if($v_motorista == "")
  {
    $v_motorista = "Não identificado!";
  }
  else
  {
   $nome_reduzido = explode(" ",$v_motorista);
   $nome_reduzido = $nome_reduzido[0];
   $v_motorista = $nome_reduzido;
  }

  $array_motorista[$encontrado] = $v_motorista;

  
   ?>
    <tr>
    	<td class="th1" style="background-color:<?php print $cor_da_base ?>;"><?php print $array_data_hora[$encontrado]."</BR>Saída: <b>".$array_ponto[$encontrado]."</b></BR>Motorista: <b>". $array_motorista[$encontrado]."</b>"?></td>
        <td class="th2" style="background-color:<?php print $cor_da_base ?>;"><img id="img_fundo_placas" src="./images/placas/placa_fundo.png"/>
        <div id='v_placa_cavalo'>
        <?php print $array_placa_cavalo[$encontrado]?>
        </div>
        </td>
        <td class="th3" style="background-color:<?php print $cor_da_base ?>;"><img id="img_fundo_placas" src="./images/placas/placa_fundo.png"/>
        <div id='v_placa_carreta'>
        <?php print $array_placa_carreta[$encontrado]?>
        </div>
        </td>
        <?php
        if($array_condicao[$encontrado]=="Concluído")
        {
        ?>
        <td class="th5" style="background-color:<?php print $cor_da_base ?>;"><?php print $array_condicao[$encontrado]."</BR><b>".$array_destino[$encontrado]."</b>"?></td>
        <?php
        }
        else
        {
         ?>
         <td class="th5" style="background-color:<?php print $cor_da_base ?>;"><?php print $array_condicao[$encontrado]?></td>
         <?php
         }
        ?>
         <td class='th6' style="background-color:<?php print $cor_da_base ?>;">
        <?php
        if( $array_tratado_por_segurpro[$encontrado] == '--' || $array_condicao[$encontrado] == 'Tratando')
        {
         ?>   
         <input type='button' id='btn_segurpro1' value='Validar' onclick="validar(<?php print $array_id[$encontrado]?>)" />
         <?php
        }
        else
        {
         ?>   
         <input type='button'  id='btn_segurpro2' value='Não é necessário!' />
         <?php
        }

        ?>
        </td>
        
        <td class='th7' style="background-color:<?php print $cor_da_base ?>;">
        <?php
        if( $array_tratado_por_ccl[$encontrado] == '--')
        {
         ?>  
         <input type='button' id='btn_ccl1' value='Validar' disabled/>
         <?php
        }
        else
        {
         ?>   
         <input type='button'  id='btn_ccl2' value='Não é necessário!' disabled />
         <?php
        }

        ?>
        </td>

   
    </tr>
  <?php








 }
} 

?>





</div>
<h3 id="lb_hora"><?php print $data .' '. $hora ?> </h3>
<h3 id="lb_titulo">Acompanhamentos Segur PRO </h3>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

<input id="btn_normalizar" type="button" value="Normalizar Semáforos" onclick='normalizar()' />

</body>

<script> 
function normalizar()
{
    $.ajax({
           url: 'acionamentos_lora.php',
           type: 'GET',
           dataType: 'html',
           data: {'mensagem': 'normalizar'},
           success: function(resultado)
           {
            if(resultado == "ok")
            {
                alert("Atenção!\n\nAcabou de ser enviado o comando para normalizar os semáforos!");  
            }
            else
            {
                alert("Atenção!\n\nOcorreu um erro ao enviar o comando para normalizar os semáforos! \n TENTE NOVAMENTE!");  
            }
            
           }
       });  
 
}
function validar(id)
{
 //alert(id);  
 location.href="./tela_justificativa.php?id="+id; 
}



$(document).ready(function(){
setInterval(function(){
     $("#tabela").load(window.location.href + " #tabela");
    
}, 1000);
});






function salvar(){

    var link_ckb_atualizar_display = document.getElementById('ckb_atualizar_display').checked;
    var link_ckb_consultar_gagf = document.getElementById('ckb_consultar_gagf').checked;
    var link_rb_apenas_placas = document.getElementById('rd_apenas_placas').checked;
    var link_rb_automacao_completa = document.getElementById('rd_automacao_completa').checked;
    
    $.ajax({
           url: 'salvar_configuracoes.php',
           type: 'GET',
           dataType: 'html',
           data: {'display': link_ckb_atualizar_display, 'gagf': link_ckb_consultar_gagf, 'apenas_placas': link_rb_apenas_placas},
           success: function(resultado)
           {
            //recarregar_configuracoes(); 
            alert('Atualizado os dados com sucesso!');
           }
       });
    
    
    
    //alert(link_rb_automacao_completa);
    
}

</script>



<style>


DIV#base_eventos{
    margin-left: 0%;
    position: absolute;
    left: 1%;
    top: 2%;
    width:97%;
    height:95%;
    background-color: #F8F8FF;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
}

DIV#tabela{
    margin-left: 0%;
    position: relative;
    left: 0.2%;
    top: 4.5%;
    width:99.5%;
    height:90%;
    background-color: #F8F8FF;
}

IMG#img_fundo_placas{
    width: 200px;
    height: 86px;
    padding-top: 1px;
    padding-left:2px;
    padding-right:2px;

}
IMG#img_fundo_placas:hover
{
 background-color: #555555; /* Preto */
 color: white;
 transform: translateX(10px);
}
IMG#img_fundo_placas:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

DIV#v_placa_cavalo{
    position: absolute;
    padding-top: 0.3%;
    margin-top: -4.8%;
    margin-left: 3%;
    padding-right: 0.3%;
    font: bold 26pt verdana;
    background-color: transparent;
    width: 14%;
    height: 5%;
    text-align: center;
}
DIV#v_placa_carreta{
    position: absolute;
    padding-top: 0.3%;
    margin-top: -4.8%;
    margin-left: 3%;
    padding-right: 0.3%;
    font: bold 26pt verdana;
    background-color: transparent;
    width: 14%;
    height: 5%;
    text-align: center;
}

.th1_1{
    width: 4%;
    padding-top: 5px;
    padding-bottom: 5px;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}

.th1{
    text-align: center;
    font: normal 12pt verdana;
    background-color: #F0F8FF;
}


.th2_1{
    width: 2%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}
.th2{
   
   text-align: center;
   font: normal 12pt verdana;
   background-color: #F0F8FF;
}

.th3_1{
    width: 2%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}
.th3{
    text-align: center;
    font: normal 12pt verdana;
    background-color: #F0F8FF;
}


.th5_1{
    width: 3.5%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}
.th5{
    text-align: center;
    font: normal 12pt verdana;
    background-color: #F0F8FF;
}
.th6_1{
    width: 4%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}
.th6{
    text-align: center;
    font: normal 12pt verdana;
    background-color: #F0F8FF;
}
.th7_1{
    width: 4.5%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}
.th7{
    text-align: center;
    font: normal 12pt verdana;
    background-color: #F0F8FF;
}

INPUT#btn_segurpro1
{
    color: #FFFFFF;
    margin-left: -0.3%;
    position: absolute;
    font: normal 12pt verdana;
    color: #ffffff;
    width:12%;
    height:10%;
    left: 72%;
    margin-top: -2%;
    background-color: #29A1AB;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_segurpro1:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_segurpro1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#btn_segurpro2
{
    color: #FFFFFF;
    margin-left: -0.3%;
    position: absolute;
    font: normal 12pt verdana;
    color: #000000;
    width:12%;
    height:10%;
    left: 72%;
    margin-top: -2%;
    background-color: #29A1AB;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}




INPUT#btn_ccl1
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    width:12.5%;
    height:10%;
    left: 86.3%;
    margin-top: -2%;
    background-color: #29A1AB;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_ccl1:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ccl1:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_ccl2
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    width:12.5%;
    height:10%;
    left: 86.3%;
    margin-top: -2%;
    background-color: #29A1AB;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_ccl2:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ccl2:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}







INPUT#btn_normalizar
{
    color: #ffffff;
    margin-left: 0px;
    position: absolute;
    font: bold 14pt verdana;
    left:0.3%;
    top: -9%;
    width:17%;
    height:8%;
    padding-bottom: 2px;
    background-color: #29A1AB;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;
    text-align: center;
}
INPUT#btn_normalizar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_normalizar:active {
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

#lb_titulo{
    margin-left: 0px;
    position: absolute;
    left: 26%;
    top: -17%;
    font: bold 30pt verdana;
    color:#000000;
}
#lb_hora{
    margin-left: 0px;
    position: absolute;
    left: 77%;
    top: -13%;
    font: bold 20pt verdana;
    color:rgb(0,0,190);
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 103%;
    color: rgba(0,0,0,0.7)
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
    background-color: #29A1AB;
}

</style>



</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<title>Tela confernecia Excesso</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>

<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" hidden="hidden"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>

<?php


$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
if($tempo == '-1'){$tempo = 20000;}
if($nvezes == '-1'){$nvezes = 3;}
if($vezes != '-1'){$vezes = intval($vezes)+1;}

?>


<div id='justificar' name='justificar' >
<h3 id="lb_titulo2">Acompanhamentos Carga Descentralizada </h3>
</BR>
<h3 id="lb_registro">Insira seu registro: </h3>
<input type='text' id='txt_registro' name='txt_registro' maxlength='8' minlength='8' value=''/>
<input type='text' id='txt_id' name='txt_id' value='' hidden='hidden'/>
<h3 id="lb_justificativa">Insira sua tratativa: </h3>
<textarea id="txt_tratativa" name="txt_tratativa"  maxlength='200' minlength='20' rows="4" cols="50">

</textarea>
<input type='button' id='btn_tratativa' value='Validar Ação' onclick='salvar()'/>
<input type='button' id='btn_sair' value='Cancelar' onclick='sair()'/>
</div>



<div id='base_eventos' name='base_eventos' >


<div id="tabela" name="tabela">
<table border= 2px; >
    <thead >
        <tr>
            <th class="th1_1">Data/Hora</th>
            <th class="th2_1">Dados Motorista</th>
            <th class="th3_1">Placa Carreta</th>
            <th class="th5_1">Condição</th>
            <th class="th7_1">Tratado por CCL</th>
        </tr>
    </thead>
    <tbody>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    $encontrado = 0;
    $encontrado_notificar = 0;
    $array_placa_carreta=array();
    $array_data_hora=array();
    $array_celular=array();
    $array_condicao=array();
    $array_motivo=array();
    $array_tratado_por_ccl=array();
    $array_tratativa_ccl=array();
    $array_registro=array();
    $array_id=array();
    $array_motorista=array();
    $array_transportadora=array();
    $array_destino=array();
    $array_tempo=array();
    $consulta = 'Carga Descentralizada!';
    //$consulta = "Excesso/Falta";
    $data_consulta = $data;
    include_once 'conexao_poste.php';
    $sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE (condicao = '$consulta' AND  data_leitura='$data_consulta')ORDER BY id DESC LIMIT 6");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $encontrado = intval($encontrado)+1;  
      $v_tratado = $dados['tratado'];
       
       $ultimo_id = $dados['id']; //Guardo o ultimo id do banco para saber se tem dado novo e pode atualizar
       $data_banco = $dados['data_leitura'];
       $hora_banco = $dados['hora_leitura'];
       $condicao_banco = $dados['condicao'];
       $id = $dados['id'];
       $v_placa_carreta = $dados['placa'];
       if($v_placa_carreta == ''){$v_placa_carreta = '--';}
       $array_placa_carreta[$encontrado] = $v_placa_carreta;
       $v_celular = $dados['telefone'];
       $array_celular[$encontrado] =$v_celular;
       $v_motorista = $dados['motorista'];
       $array_destino[$encontrado] = $dados['destino'];
       $array_transportadora[$encontrado] = $dados['transportadora'];
       $v_data =$dados['data_leitura'];
       $v_hora =$dados['hora_leitura'];
       if($v_data == ''){$array_data_hora[$encontrado] = '--';}else{$array_data_hora[$encontrado] = ($v_data . ' ' . $v_hora);}
       $v_condicao = $dados['condicao'];
       $array_condicao[$encontrado] =$v_condicao;
       $v_tratado_por_ccl = $dados['tratado'];
       $v_registro = $dados['registro_tratado'];
       $v_tratativa = $dados['tratativa'];
       $array_tempo[$encontrado] = $dados['tempo_confirmacao'];
       if($v_tratado_por_ccl == 'nao'){$v_tratado_por_ccl = "Não";}
       $array_tratado_por_ccl[$encontrado] =$v_tratado_por_ccl;
       $array_registro[$encontrado] = $v_registro;
       $array_tratativa_ccl[$encontrado] = $v_tratativa;
       $array_id[$encontrado] = $dados['id'];
       
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
       $array_motivo[$encontrado] = $dados['motivo'];
       if($v_tratado == 'nao')
       {
         $cor_da_base = '#FF6347'; //Estorou o tempo! > vermelho
         ?>
         <script>console.log("Tratado NAO");</script>
         <?php
       }
       else
       {
         $cor_da_base = "#FFD700"; // Verde tudo OK!
         ?>
         <script>console.log("Tratado SIM");</script>
         <?php
       }
       $tamanho_data  = intval(strlen($data_banco));
       $tamanho_hora  = intval(strlen($hora_banco));
       if($tamanho_data==10 && $tamanho_hora == 8)
       {
        //Inverte o padrao da hora para efetuar o calculo
        $mensagem = explode('/',$data_banco);
        $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
        $horario_banco = $mensagem . ' ' . $hora_banco; 
        //Agora calculo a diferença
        $data_inicio = new DateTime($data_agora);
        $data_fim = new DateTime($hora_banco);
        // Resgata diferença entre as datas
        $dateInterval = $data_inicio->diff($data_fim);
        $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
        if($publica==1)
        {
         echo $mensagem;
        }
        $mensagem1 = explode(' ',$mensagem);
        $vmensagem1 = explode('/',$mensagem1[0]);
        $dia = $vmensagem1[0];
        $mes = $vmensagem1[1];
        $ano = $vmensagem1[2];
        $mensagem = explode(':',$mensagem1[1]);
        $hora = $mensagem[0];
        $minuto = $mensagem[1];
        $segundo = $mensagem[2];
        if($publica==1)
        {
         echo("*********************************Resumo ****************************</BR>");
         echo('ID: '.$id);echo("</BR>");
         echo('Dia: '.$dia);echo("</BR>");
         echo('Mês: '.$mes);echo("</BR>");
         echo('Ano: '.$ano);echo("</BR>");
         echo('Hora: '.$hora);echo("</BR>");
         echo('Minuto: '.$minuto);echo("</BR>");
         echo('Segundo: '.$segundo);echo("</BR>");
        }
        if($dia>0 || $mes>0 || $ano>0)
        {
         ?>
         <script>console.log("Tempo excedido maior que dia/hora/ano");</script>
         <?php
         if($publica == 1)
         {
          echo '</br>';
          echo '</br>';
          echo 'Esta com erro!';
          echo'</BR>';
         } // Fecha if($publica == 1)
        }// fecha if($dia>0 || $mes>0 || $ano>0)
        else
        {
         if((intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!' && $v_tratado == 'nao')
         {

            if($v_tratado == 'nao')
            {
             if(intval($hora)>0)
             {
                
                if($encontrado_notificar == "nao")
                {
                    $encontrado_notificar = "nao";
                }
                else
                {
                  //Nao mudo pois existe algum outro que ja mudou para sim!;  
                }



             ?>
             <script>console.log("Tempo excedido maior que dia/hora/ano");</script>
             <?php
             }
             else
             {
                $encontrado_notificar = "sim"; //qualquer um dos 6 que for nao muda isso para sim e sempre mandara audio na tela!    
             }
            }

            ?>
            <script>console.log("Tempo excedido");</script>
            <?php
          ?>
          <tr>
            <td class="th1" style="background-color:<?php print $cor_da_base ?>;"><?php print $array_data_hora[$encontrado]?></td>
            <td class="th2" style="background-color:<?php print $cor_da_base ?>;"><?php print "</b>Motorista: <b>". $array_motorista[$encontrado]."</b></BR>Tel: <b>". $array_celular[$encontrado]."</b>" ."</BR>Transp.: <b>". $array_transportadora[$encontrado]."</b>"  ."</BR>Destino: <b>". $array_destino[$encontrado]."</b>"        ?></div></td>
            <td class="th3" style="background-color:<?php print $cor_da_base ?>;"><img id="img_fundo_placas" src="./images/placas/placa_fundo.png"/><div id='v_placa_carreta'><?php print $array_placa_carreta[$encontrado]?></div></td>
            <?php
            if($v_tratado == 'nao')
            {
             if(intval($hora)>0) 
             {
                ?>            
                <td class="th5" style="background-color:<?php print $cor_da_base ?>"><?php print "<b>Tempo superior a 1 hora</b></BR><b>>> PENDENTE TRATATIVA! <<</b>"?></td>
                <?php
             }  
             else
             {
                ?>            
                <td class="th5" style="background-color:<?php print $cor_da_base ?>"><?php print $array_condicao[$encontrado] . "</BR><b>>> PENDENTE TRATATIVA! <<</b>"?></td>
                <?php
             }
             
            }
            else
            {
             ?>   
             <td class="th5" style="background-color: <?php print $cor_da_base ?>"><?php print $array_condicao[$encontrado]?></td>
            <?php
            }
            ?>
            
            <td class='th7' style="background-color:<?php print $cor_da_base ?>;">
            <?php
            if( $array_tratado_por_ccl[$encontrado] == '--' || $array_tratado_por_ccl[$encontrado] == 'Não')
            {
             if(intval($hora)>0) 
             {
              ?>  
              <input type='button' id='btn_ccl1' value='TEMPO ESGOTADO!'/>
              <?php
             }
             else
             {
                ?>  
                <input type='button' id='btn_ccl1' value='Validar' onclick='clicou("<?php print $id.";".$minuto ?> ?>")' />
                <?php
                $validar='Sim';
             }




            }
            else
            {
             ?>   
             <label  id='btn_ccl1' ><?php print $array_motivo[$encontrado] ?></label>
             <?php
            }
            ?>
            </td>
          </tr>
          <?php
         } // Fecha if((intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!')
         else
         {
          //echo "Achou porem nao tem mais do que 25 minutos!";
          if( ( (intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!' && $v_tratado != 'nao') || $v_tratado != 'nao' )
          {
            ?>
            <script>console.log("Ja validado!");</script>
            <?php
            $cor_da_base = "rgb(20,200,0)"; // Verde tudo OK!  
          }
          else
          {
          ?>
          <script>console.log("Ainda nao deu tempo!");</script>
          <?php
          $cor_da_base = "#FFD700"; // GOLD
          }
          ?>
          <tr>
            <td class="th1" style="background-color:<?php print $cor_da_base ?>;"><?php print $array_data_hora[$encontrado]."</b>"?></td>
            <td class="th2" style="background-color:<?php print $cor_da_base ?>;"><?php print "</b>Motorista: <b>". $array_motorista[$encontrado]."</b></BR>Tel: <b>". $array_celular[$encontrado]."</b>" ."</BR>Transp.: <b>". $array_transportadora[$encontrado]."</b>"  ."</BR>Destino: <b>". $array_destino[$encontrado]."</b>"        ?></div></td>
            <td class="th3" style="background-color:<?php print $cor_da_base ?>;"><img id="img_fundo_placas" src="./images/placas/placa_fundo.png"/><div id='v_placa_carreta'><?php print $array_placa_carreta[$encontrado]?></div></td>
            <?php
            if($v_tratado == 'nao')
            {
             ?>            
             <td class="th5" style="background-color:<?php print $cor_da_base ?>"><?php print $array_condicao[$encontrado] .'</BR>Tempo: '.$minuto . ' MIN > ( <b>25</b> )'?></td>
             <?php
            }
            else
            {
             ?>   
             <td class="th5" style="background-color: <?php print $cor_da_base ?>"><?php print $array_condicao[$encontrado]?></td>
            <?php
            }
            ?>
            <td class='th7' style="background-color:<?php print $cor_da_base ?>;">
            <?php
            if( $array_tratado_por_ccl[$encontrado] == '--' || $array_tratado_por_ccl[$encontrado] == 'Não')
            {
             ?>  
             <!--<input type='button' id='btn_ccl1' value='Validar' onclick='clicou("<?php print $id.";".$minuto ?> ");'/>-->
             <label  id='btn_ccl1' ><?php print "<h2>Aguardando validação</h2>"  ?></label>
             <?php
            }
            else
            {
             ?>   
             <label  id='btn_ccl1' ><?php print "<b>Registro: </b>" . $array_registro[$encontrado]."</BR>".$array_tratativa_ccl[$encontrado] ?></label>
             <?php
            }
            ?>
            </td>
          </tr>
          <?php

         } // Fecha o else if((intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!')
        } // fecha else  ($dia>0 || $mes>0 || $ano>0)
       } //Fecha if($tamanho_data==10 && $tamanho_hora == 8)
     
     } // Fecha o while($dados = $sql->fetch_array())
    } // Fecha if
    






?>
<script>
    var validar = '<?php print $validar ?>';
    if(validar == "Sim")
    {
     //Passo via ajax para inserir na lista de audios e o ccl chamar a atençao com a caixinha de som
     $.ajax({
       url: 'script_inserir_audio.php',
       type: 'GET',
       dataType: 'text',
       data: {'a': 'a'},
       success: function(resultado)
       {
        console.log('atualizado audio');
       }
      });
    }
    //alert(validar);

</script>




</div>
<!--<h3 id="lb_hora"><?php print $data .' '. $hora ?> </h3>-->
<h3 id="lb_titulo">Acompanhamentos Carga Descentralizada </h3>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<label id="mensagem">Sem eventos de carga descentralizada até o momento!</label>

</body>
 <script>
    document.getElementById('mensagem').style.display='none';

var encontrado = '<?php print $encontrado ?>';

var encontrado_notificar = '<?php print $encontrado_notificar ?>';
if(encontrado_notificar == "sim")
{
    document.getElementById('mensagem').style.display='none';   
 var numero = Math.floor(Math.random() * 2);
const clickSound = new Audio('./audios/audio_'+String(numero)+'.mp3');
clickSound.play().catch(function (error) {
    console.log("Chrome cannot play sound without user interaction first")});
}
else
{
  if(parseInt(encontrado)>0)
  {
    console.log("Todos ja estao tratados!");
    document.getElementById('mensagem').style.display='none';
  }
  else
  {
    console.log("Não foram encontrado dados!")
    document.getElementById('mensagem').style.display='block';
  }
  
}


function clicou(text)
{
    const myArray = text.split(";");
    var id = myArray[0];
    var tempo = myArray[1];
    if(parseInt(tempo)<25)
    {
     alert("Não é possivel validar manualmente pois ainda está dentro do prazo limite de 25 minutos para validação automática!\n\n\nCaso estore esse tempo, favor fazer as tratativas!\n\n\nO tempo desde a detecção do evento até o momento é de "+ tempo + " minutos!");
    }
    else
    {
        //Oculto a tela toda e exibo o campo para justificar!
        document.getElementById('base_eventos').style.display='none';
      
        //Exibo a div para justificar
        document.getElementById('justificar').style.display='block';
        //alert(id);
        document.getElementById('txt_id').value=id;
            



    }
    

}

function sair()
{
    document.getElementById('justificar').style.display='none';
    document.getElementById('base_eventos').style.display='block';
}

function salvar()
{
 //passo via ajax para salvar!
 var link_registro = document.getElementById('txt_registro').value;
 var link_tratativa = document.getElementById('txt_tratativa').value;
 var link_id = document.getElementById('txt_id').value;
 var tamanho_registro = link_registro.length;
 var tamanho_tratativa = link_tratativa.length;
 if (tamanho_tratativa > 20 && tamanho_registro == 8 )
 {
  //Passo via ajax para finalizar a tratativa
  $.ajax({
  url: 'script_salvar_justificativa.php',
  type: 'GET',
  dataType: 'text',
  data: {'registro': link_registro, 'tratativa': link_tratativa,'id': link_id },
  success: function(resultado)
  {
    if(resultado.includes("salvo_com_sucesso")==true)
    {
      alert("Salvo com sucesso!");
      document.getElementById('txt_registro').value = '';
      document.getElementById('txt_tratativa').value = '';
      document.getElementById('justificar').style.display='none';
      document.getElementById('base_eventos').style.display='block';
      var link = "/dashboard_utmi/utmi/tela_conferencia_excesso.php";
      window.location.href = link;
      
    }
    else
    {
     alert("Erro ao tentar salvar, favor tentar novamnete!");
    }
  }
  });


 }  
 else
 {
    if(tamanho_registro != 8 )
    {
     alert("Favor inserir o registro corretamente!");
     document.getElementById('txt_registro').focus();
    }
    else
    {
      alert("Favor inserir uma ação de tratativa mais detalhada!");  
      document.getElementById('txt_tratativa').focus();
    }
 } 
}

document.getElementById('justificar').style.display='none';





var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= link_nvezes)
{
 //location.href='./tela_resumo_giro_detalhado.php?vezes=0$nvezes=3';//Por default passo 2
 location.href='./tela_ttp.php?vezes=0$nvezes=3';//Por default passo 2
 //window.setTimeout( "location.href=`./dashboard_utmi.php?vezes=${'<?php print $vezes ?>'}&nvezes=0&tempo=${'<?php print $tempo ?>'}`",link_tempo);
}
else
{
 if(link_vezes != '-1')
 {
    window.setTimeout( "location.href=`./tela_conferencia_excesso.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   


}


    </script>

<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_utmi.php?vezes=0'"/>

<style>

#lb_registro{
    position: absolute;
    text-align:center;
    font: bold 18pt verdana;
    color: #000000;
    left: 6%;
    top: 20%;
}

#txt_registro{
    position: absolute;
    text-align:center;
    font: bold 18pt verdana;
    color: #000000;
    left: 26%;
    top: 22.5%;
    width:15%;
    height:5%;
}

#lb_justificativa{
    position: absolute;
    text-align:center;
    font: bold 18pt verdana;
    color: #000000;
    left: 6%;
    top: 31%;
}
#txt_tratativa{
    position: absolute;
    text-align:left;
    font: bold 18pt verdana;
    color: #000000;
    left: 6%;
    top: 40.5%;
    width:84%;
    height:40%;
}

INPUT#btn_tratativa
{
    color: #FFFFFF;
    margin-left: 0px;
    text-align: center;
    position: absolute;
    font: normal 14pt verdana;
    width:17%;
    height: 8%;
    left:6%;
    top: 90%;
    margin-top: -2%;
    background-color: rgb(0,0,190);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_tratativa:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_tratativa:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_sair
{
    color: #FFFFFF;
    margin-left: 0px;
    text-align: center;
    position: absolute;
    font: normal 14pt verdana;
    width:17%;
    height: 8%;
    left:26%;
    top: 90%;
    margin-top: -2%;
    background-color: rgb(200,0,20);
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_sair:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_sair:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}






LABEL#mensagem{
    position: absolute;
    text-align:center;
    font: bold 50pt verdana;
    color: #B22222;
    left: 4%;
    top: 26%;
    padding-top: 60px;
    padding-bottom: 0px;
    width:92%;
    height:38%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 8px #B22222 solid!important;
}
DIV#justificar{
    margin-left: 0%;
    position: absolute;
    left: 1.5%;
    top: 6%;
    width:97%;
    height:90%;
    background-color: #F8F8FF;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
}
DIV#base_eventos{
    margin-left: 0%;
    position: absolute;
    left: 1.5%;
    top: 6%;
    width:97%;
    height:90%;
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
    height:89%;
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

DIV#v_placa_carreta{
    position: absolute;
    padding-top: 0.3%;
    margin-top: -4.8%;
    margin-left: 3%;
    padding-right: 0.3%;
    font: bold 26pt verdana;
    background-color: transparent;
    width: 13%;
    height: 5%;
    text-align: center;
}

.th1_1{
    width: 2%;
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
    width: 4%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
    
}


.th2{
   
   text-align: center;
   font: normal 12pt verdana;
   background-color: #F0F8FF;
   padding-bottom: 10px;   
   padding-top: 10px;   
}

.th3_1{
    width: 1.4%;  
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
    width: 3.9%;  
    text-align: center;
    font: bold 12pt verdana;
    background-color: #87CEEB;
}
.th5{
    text-align: center;
    font: normal 14pt verdana;
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
    background-color: transparent;
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
    background-color: transparent;
    border-radius: 5px!important;
    border: 3px #000000 solid!important;
    cursor: pointer
}




INPUT#btn_ccl1
{
    color: #FFFFFF;
    margin-left: 0px;
    text-align: center;
    position: absolute;
    font: normal 14pt verdana;
    width:17%;
    height:10%;
    left:79%;
    margin-top: -2%;
    background-color: rgb(0,0,190);
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
    background-color: transparent;
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
    background-color: transparent;
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
    left: -1%;
    top: -12%;
    width: 30px;
    height: 30px;
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
    text-align: center;
    top: -18%;
    font: bold 30pt verdana;
    background-color: transparent;
    width: 100%;
    color:#000000;
}
#lb_titulo2{
    margin-left: 0px;
    position: absolute;
    text-align: center;
    top: 3%;
    font: bold 30pt verdana;
    background-color: transparent;
    width: 100%;
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
    top: 105%; 
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
    background-color:transparent;
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

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}

</style>



</html>
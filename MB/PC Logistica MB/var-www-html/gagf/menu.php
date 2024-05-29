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
<img id="sair" src="./images/btn_sair.png" onclick="javascript: location.href='login.php';">
<img id="logo" src="./images/logo.png">
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss"hidden="hidden"/>
</div>

<?php
error_reporting(0);
$usuario = "";
$tipo = "";
$criptografia = "";
$usuario_criptografado = "";
include_once 'conexao2.php';
$registro = $_POST['registro'];
$senha = $_POST['senha'];
$validado_alterar_senha = 0;

if($registro == $senha)
{
 $sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND senha='$senha' AND alterar ='1' ");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $validado_alterar_senha = 1;
  }
 }
 else // Não deixa alterar a senha pois ja foi alterada, será necessário zerar a senha
 {
    $validado_alterar_senha = 0;
 }
  

  if($validado_alterar_senha == 1)
  {
   // Muda de tela para validar a alteração da senha
   $valor = (((int)$registro)*14)*2020+155;
   ?>
   <script language="JavaScript">

   window.location="altera_senha.php?registro=<?php echo $valor ?>";
   </script>
   <?php
  }
  else
  {
   // Muda de tela para validar a alteração da senha
   ?>
   <script language="JavaScript">
   alert("Senha para este usuário já está definida, caso realmente deseje alterar a senha, eviar email para >  bruno.goncalves@gerdau.com.br  < solicitando zerar a senha deste usuário!");
   window.location="login.php";
   </script>
   <?php
  }
  

}else
{ 
    $validado_alterar_senha = 0;
    $validado = 0; 
    $sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND senha='$senha'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $usuario = $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
      $tipo = $dados['tipo_usuario'];
      $criptografia = $dados['criptografia'];
      $acesso_portal = $dados['acesso_portal']; // Busca o valor que esta em relação a numero de acessos
      if($acesso_portal == "")
      {
       $acesso_portal = '0';
      }
      $validado = 1; // Encontrou
     }// Fecha While
     if($validado == 1)
     {
      $acesso_portal = intval($acesso_portal) + 1;
      $sql = $dbcon->query("UPDATE pessoas SET acesso_portal='$acesso_portal' WHERE nome='$usuario'");
     }

    // faz a criptografia
    for ($i=0; $i < strlen($usuario); $i++)
    {
    $usuario_criptografado .= dechex(ord($usuario[$i]));
    }



    }else{
    ?>
    <script language="JavaScript">
    //window.Notification="Senha Incorreta!";
    window.location="login.php";
    </script>
    <?php
    }

    ?>
    <center>



    <input id="btn_automacao"  type="button" value="Automação Logística"  onclick="javascript: location.href=`menu_automacao_logistica_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" />
    <input id="btn_cco" type="button" value="Centro Controle Operacional" onclick="javascript: location.href='';"/>
    <input id="btn_ccl" type="button" value="Centro Controle Logístico"  onclick="javascript: location.href=`menu_ccl.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
    <input id="btn_gestao_gagf" type="button" value="Gestão GAGF"  onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
    
    
    <h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
    <div id="links">
    <a href="#" onclick="abreLink();">GAGF</a>
    <a href="#" onclick="abreLink2();">IoT</a>
    <a href="#" onclick="abreLink3();">Grafana</a>
    <a href="#" onclick="abreLink4();">Automação Logistica</a>
    </link>
    </div>
    





    <script>
        
    function abreLink(){
    window.open('https://ya7da335bbb3.us2.hana.ondemand.com/gagf/ui/index.html');
    }
    </script>
    
    <script>
    function abreLink2(){
    window.open('https://flpnwc-da335bbb3.dispatcher.us2.hana.ondemand.com/sites/iot4decision#Shell-home');
    }
    </script>
    
    <script>
    function abreLink3(){
    window.open('http://monitoracao.firstdecision.com.br:3000/login');
    }
    </script>
    
    <script>
    function abreLink4(){
    window.open('http://138.0.77.81:8123/lovelace/default_view');
    }
    </script>
    
    
    
    
    
    
    
    <script>
    window.document.getElementById('btn_automacao').disabled=true;
    window.document.getElementById('btn_ccl').disabled=true;
    window.document.getElementById('btn_cco').disabled=true;
    window.document.getElementById('btn_gestao_gagf').disabled=true;
    
    var usuario = window.document.getElementById('colaborador');
    var colaborador = "<?php print $usuario ?>";
    usuario.innerHTML = "Usuario : "  + colaborador;
    var lfuncao = window.document.getElementById('funcao');
    var funcao = "<?php print $tipo ?>";
    lfuncao.innerHTML = "Perfil : " + funcao;
    
    
    // Verificando as funcoes e permissoes
    var lusuario_criptografado = "<?php print $usuario_criptografado ?>";
    var link_criptografia = window.document.getElementById('criptografia');
    link_criptografia.value = lusuario_criptografado;
    
    var lcriptografia = "<?php print $criptografia ?>";
    var link_criptografia2 = window.document.getElementById('criptografia2');
    link_criptografia2.value = lcriptografia;
    
    funcao = funcao.trim();
    
    console.log(funcao);
    
    if (funcao =="Desenvolvedor" || funcao =="Administrador")
    {
     console.log('entrou');
        window.document.getElementById('btn_automacao').disabled=false;
        window.document.getElementById('btn_ccl').disabled=false;
        window.document.getElementById('btn_cco').disabled=false;
        window.document.getElementById('btn_gestao_gagf').disabled=false;
    
    }
    else if(funcao=="Gestão GAGF")
    {
        console.log('entrou2');
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=true;
        window.document.getElementById('btn_cco').disabled=true;
        window.document.getElementById('btn_gestao_gagf').disabled=false;
    }
    
    else if(funcao=="Operador CCL MB" || funcao=="Gestão CCL MB" || funcao=="Operador CCL VL" || funcao=="Gestão CCL VL")
    {
        console.log('entrou3');
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=false;
        window.document.getElementById('btn_cco').disabled=true;
        window.document.getElementById('btn_gestao_gagf').disabled=true;
    }
    else if(funcao=="Operador CCO MB" || funcao=="Operador CCO VL" || funcao=="Gestão CCO")
    {
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=true;
        window.document.getElementById('btn_cco').disabled=false;
        window.document.getElementById('btn_gestao_gagf').disabled=true;
    }
    
    
    
    // Caso não seja algo definido bloqueia tudo
    else
    {
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=true;
        window.document.getElementById('btn_cco').disabled=true;
        window.document.getElementById('btn_gestao_gagf').disabled=true; 
    }
    
    </script>
    
    <?php
    

}// Fecha Else de senha == registro 
?>









</body>

<script>

</script>

<style>





INPUT#btn_automacao
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 200px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_automacao:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_automacao:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_cco
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 200px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_cco:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_cco:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_ccl
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 320px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_ccl:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ccl:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_gestao_gagf
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 320px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_gestao_gagf:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_gestao_gagf:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


IMG#logo{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 70px;
    width: 190px;
    height: 60px;
    cursor: pointer;

}





IMG#sair{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 15%;
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
div#links{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
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
    left: 35%;
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
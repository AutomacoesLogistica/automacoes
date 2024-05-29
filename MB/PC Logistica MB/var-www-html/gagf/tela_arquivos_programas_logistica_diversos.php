<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`tela_arquivos_programas_logistica_tipo.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
window.location="login.php";
</script>
<?php
}
?>






<div >
 <table  id="tabela"  border="3" class="table table-striped table table-hover">
        <thead class="table table-striped table-dark">
            <tr>
                <td >Nome</td>
                <td align="center">Download</td>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'conexao_portal_gestao.php';
            $sql = $dbcon->query("SELECT * FROM arquivos_programas_mb WHERE tipo='Diversos' ORDER BY id ASC");
            if(mysqli_num_rows($sql)>0)
            {
             while($dados = $sql->fetch_array())
             {
              $nome_do_arquivo = $dados['nome'];
              $nome_exibir = $dados['nome_exibir'];
              $localidade = $dados['localidade'];   
             ?>
              <tr class="table-info">
                <td><?php echo $nome_exibir ?></td>
                <td><a href="<?php echo $localidade ?>">Download</a></td>
              </tr>
             <?php
             }// Fecha o while 
            } // Fecha o if mysqli_num_rows($sql)>0
            ?>
            
        </tbody>
    </table>
    
</div>














<h3 id="lb_titulo">Gerenciador de Arquivos e Programas Logística MB</h3>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>


<style>

#lb_titulo{
    margin-left: 0px;
    position: absolute;
    left: 20%;
    top: 10%;
    color: rgba(0,0,0,0.8);
    font: bold 20pt verdana;
}



#tabela {
    position: absolute;
    top:23%;
    left: 10%;
    width: 80%;
    text-align: center;

}




INPUT#arquivo{
    padding-right: 10px;
 
}
a:link {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: #1C1C1C;
    border-radius: 5px!important;
    padding-left: 18px;
    padding-right: 18px;
    padding-top: 6px;
    padding-bottom: 6px;
    border-style: 5px,solid!important;
    cursor: pointer;
    text-align: center;

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
    left: 38%;
    top: 92%;
    font: bold 12pt verdana;
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
    width:93.9%;
    height:5%;
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
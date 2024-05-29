<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gerdau :: GAGF - Bruno Gonçalves</title>
   <link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
</head>
<body>
    

<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.PNG" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>




 













<?php
error_reporting(0);
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
//window.location="login.php";
</script>
<?php
}
?>
<center>

<?php
require_once("conexao.php");
?>

<div id="info">
    <img id='foto1' src="images/foto.jpg" alt="">
    <img id='foto2' src="images/sxt.png" alt="">
    <label id="descricao">Modelo:</label>
    <label id="descricao2">SXT</label>
    <textarea id="descricao3" rows="14" cols="10" wrap="soft"></textarea>
</div>

<table border="3" class="table-hover">
        <thead >
            <tr>
                <td class="th1_1">Nome do arquivo para download</td>
                <td class="th2_1">Informações</td>
                <td class="th3_1">Download</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = $dbcon->query("SELECT * FROM arquivos ORDER BY nome ASC");
            if(mysqli_num_rows($sql)>0)
            {
             $encontrado = 0;
             while($dados = $sql->fetch_array())
             {
              $nome_do_arquivo = $dados['nome'];
              $localidade = $dados['localidade'];
              $informacao = $dados['info'];
              $foto1 = $dados['foto1']; 
              $foto2 = $dados['foto2'];   
              if($informacao ==""){$informacao = "Detalhes";}
              if($foto1 ==""){$foto1 = "carregando.gif";}
              if($foto2 ==""){$foto2 = "carregando.gif";}
              
             ?>
              <tr class="table-secondary">
                <td class="th1"><?php echo $nome_do_arquivo ?></td>
                <td class="th2"><input id="btn_info" type="submit" value="Detalhes" onclick="teste('<?php echo $foto1 ?>','<?php echo $foto2 ?>','<?php echo $informacao ?>')"></input></td>
                <td class="th3"><a href="arquivos/<?php echo $nome_do_arquivo ?>" id="btn_donwload">Download</a></td>
              
              </tr>
             <?php
             if($encontrado == 0)
             {
              ?>
               <script>
                var caminhoFoto1 = 'images/'+'<?php echo $foto1 ?>';
                var caminhoFoto2 = 'images/'+'<?php echo $foto2 ?>';
                document.getElementById('foto1').src = caminhoFoto1; 
                document.getElementById('foto2').src = caminhoFoto2; 
                //alert(caminhoFoto2);
                document.getElementById('descricao3').value = '<?php echo $informacao ?>';
               </script>
              <?php   
             }
             $encontrado++;
             }// Fecha o while 
            } // Fecha o if mysqli_num_rows($sql)>0
            ?>
            
        </tbody>
    </table>





<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>

<script>
var foto1 = "ola";
var foto2 = "ola";
var informacao = "ola";

function teste(foto1,foto2,informacao){
    //alert(foto1);
    //alert(foto2);
    var caminhoFoto1 = 'images/'+foto1;
    var caminhoFoto2 = 'images/'+foto2;
    var informacao2 = informacao; 
    document.getElementById('foto1').src = caminhoFoto1; 
    document.getElementById('foto2').src = caminhoFoto2; 
    document.getElementById('descricao3').value = informacao2;
}
</script>

<style>

.th1_1{
    width: 350px;  
    text-align: left;
    padding-bottom: 18px;
    padding-top: 6px;
    

}
.th2_1{
    width: 100px;
    text-align: center;  
    padding-bottom: 18px;
    padding-top: 6px;
}
.th3_1{
    width: 130px;
    text-align: center;  
    padding-bottom: 18px;
    padding-top: 6px;
}


.th1{
    width: 390px;  
    text-align: left;
    padding: 8px;
    

}
.th2{
    width: 130px;
    text-align: center;  
    padding: 8px;
}
.th3{
    width: 130px;
    text-align: center;  
    padding: 8px;
}

table {
    width: 627px;
    height: 450px;
    display:inline-block;
    background-color:#000000;
    font: normal 13pt times;/**Lista dados */
    position: absolute;
    left: 85px;
    top: 9%;
    
}

thead {
    display: inline-block;
    width: 615px;
    height: 25px;
    background-color:#000000;
    font: normal 12pt verdana; /**Cabeçalho */
    color:#ffffff;
    background-color:#000000;
    padding: 2px;
    padding-left: 10px;
    border-color: #000000;
    border-style: 10px,solid!important;

}

tbody {
    height: 400px;
    display: inline-block;
    width: 600px;
    background-color:#1C1C1C;
    overflow: auto;
    position: absolute;
    left: 10px;
    top: 9%;
    
    
}





DIV#info {
    width: 565px;
    height: 450px;
    background-color: transparent;
    font: normal 12pt verdana;
    color:#ffffff;
    padding: 2px;
    padding-left: 10px;
    border-color: #000000;
    border-style: 10px,solid!important;
    position: absolute;
    left: 52.5%;
    top: 9%;
}

IMG#foto1 {
    width: 350px;
    height: 300px;
    background-color:#FFFFFF;
    position: absolute;
    left: 10px;
    top: 0px;
    border-radius: 18px!important;
    border-color: #000000;
    border-style: solid!important;
}
IMG#foto2 {
    width: 220px;
    height: 220px;
    background-color:#FFFFFF;
    position: absolute;
    left: 370px;
    top: 0px;
    border-radius: 18px!important;
    border-color: #000000;
    border-style: solid!important;
    
}

LABEL#descricao {
    position: absolute;
    left: 370px;
    top: 230px;
    color: #0000CD;
    font-weight: bold;
    font-family: verdana;font-size: 12pt;
}

LABEL#descricao2 {
    position: absolute;
    left: 370px;
    top: 250px;
    color: #000000;
    font-weight: bold;
    font-family: verdana;font-size: 20pt;
}

TEXTAREA#descricao3 {
    position: absolute;
    left: 10px;
    top: 310px;
    padding-left: 10px;
    background-color:#FFFFFF;
    color: #000000;
    font-weight: bold;
    font-family: verdana;font-size: 12pt;
    border-radius: 8px!important;
    border-color: #000000;
    border-style: solid!important;
    width: 580px;
    height: 140px;
    word-wrap: break-word;
    word-break: break-all;
}

INPUT#btn_info {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: 	#008000;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 6px;
    padding-bottom: 6px;
    border-style: 5px,solid!important;
    cursor: pointer;
    text-align: center;

}

a#btn_donwload {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
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
    left: 40%;
    top: 90%;
    font: bold 12pt verdana;
    color:#000000;
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
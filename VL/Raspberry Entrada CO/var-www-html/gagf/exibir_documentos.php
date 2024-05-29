<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Modelo PHP</title>
</head>
<body>
<h2>Consultando Documentação Motorista</h2>
<input id="Voltar"  type="button" value="Voltar" onclick="clicou()" />
<div>
<form method="post" action="exibir_motorista_1.php">
<?php
    
    $cpf = mb_strtoupper($_GET['documentos'],'UTF8'); 
    
    
    if(is_file("C:/xampp/htdocs/GAGF/cadastros/$cpf/$cpf.PDF"))// Verifica se a pasta existe
    {
    $msg= "Encontrou"; 
    }
    else{
     $cpf = "000.000.000-00"; // para puxar o padrao
     $msg= "Padrao";
    }
  
?>
 
 <script>
 var info ="<?php print $cpf ?>"
//alert(info)
</script>

<!-- trocar depois para cpf mesmo -->
<iframe id="pdf" src="./cadastros/<?php echo $cpf?>/<?php echo $cpf?>.pdf" width="1200" height="1000" style="border: none;"></iframe>

<?php
$cpf = mb_strtoupper($_GET['documentos'],'UTF8'); 
?>

<input id="cpf" type="text" name="cpf" value="" hidden="hidden">

<input id="enviar" type="submit" value="clique" hidden="hidden">


</div>

<script>
    var vcpf ="<?php print $cpf ?>"
var bcpf = window.document.getElementById('cpf'); 
bcpf.value = vcpf;

    function clicou(){

var clicar = window.document.getElementById('enviar').click();
    }
</script>

</form>
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

iframe#pdf{
    margin-left: 0px;
    position: absolute;
    background-color: none;
    left:85px;
    top: 90px;
    width:1200px;
    height:600px;
    

}

fieldset#formulario{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    height: 70px; 
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
INPUT#Voltar {
     width: 140px;
     height: 26px;
     position: absolute;
     left:472px;
     top: 30px;
     font: bold 9pt verdana;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer;
     margin-bottom: 5px;
}


</style>


<script>



</script>




</html>

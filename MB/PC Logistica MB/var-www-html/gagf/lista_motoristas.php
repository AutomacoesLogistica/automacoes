<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onload="buscar_cpf()">
    


 </body>

 <form method="post" action="exibir_motorista_1.php">
 <input id="cpf" type="text" name="cpf" value=""/>
 <input type="submit" name="b" id="b" value="clicar"/>

 </form>



<script>


function buscar_cpf()
{
    
var cpf = "";
    <?php
    include_once 'conexao.php';
    $nome = $_POST['select_motoristas'];

    $sql = $dbcon->query("SELECT * FROM lista_motoristas WHERE nome='$nome'");
    if(mysqli_num_rows($sql)>0)
    {
    while($dados = $sql->fetch_array())
    {
    $cpf = $dados['cpf'];
    ?>
    cpf ="<?php print $cpf ?>"
    <?php
    }
    }
    ?>

    //window.open(`exibir_motorista_1.php?cpf=${$cpf}`,"_self");
    var valor =  window.document.getElementById("cpf");
    valor.value = cpf;
    window.document.getElementById('b').click();

}


</script>





</html>
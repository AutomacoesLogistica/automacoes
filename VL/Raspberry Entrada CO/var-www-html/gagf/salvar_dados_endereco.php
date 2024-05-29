<html>
<head>
 <title>Salvando dados de Endereco</title>

</head>
<body>
<form method="post" action="exibir_motorista_1.php">
<?php
    
    $rua = mb_strtoupper($_GET['rua'],'UTF8'); 
    $bairro = mb_strtoupper($_GET['bairro'],'UTF8'); 
    $cidade = mb_strtoupper($_GET['cidade'],'UTF8');
    $cep = mb_strtoupper($_GET['cep'],'UTF8');
    $uf = mb_strtoupper($_GET['uf'],'UTF8'); 
    $cpf = mb_strtoupper($_GET['cpf'],'UTF8');
    

    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE lista_motoristas SET rua='$rua', bairro='$bairro', cidade='$cidade', cep='$cep', uf='$uf'  WHERE cpf='$cpf'");
    


?>
<br/>

<br/>






<input id="cpf" type="text" name="cpf" value="">
<input id="enviar" type="submit" value="clique">
<script>
var vcpf ="<?php print $cpf ?>"
var bcpf = window.document.getElementById('cpf'); 
bcpf.value = vcpf;



var clicar = window.document.getElementById('enviar').click();
</script>
</form>
</body>
</html>
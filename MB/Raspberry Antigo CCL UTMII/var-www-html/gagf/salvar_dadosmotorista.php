<html>
<head>
 <title>Salvando dados do Motorista</title>

</head>
<body>
<form method="post" action="exibir_motorista_1.php">
<?php
    
    $nome =mb_strtoupper($_GET['nome'],'UTF8'); 
    $nascimento = mb_strtoupper($_GET['nas'],'UTF8'); 
    $cpf = mb_strtoupper($_GET['cpf'],'UTF8');
    $cnh = mb_strtoupper($_GET['cnh'],'UTF8');
    $val_cnh = mb_strtoupper($_GET['val_cnh'],'UTF8'); 
    $contato = mb_strtoupper($_GET['contato'],'UTF8'); 
    $tag_atual = mb_strtoupper($_GET['tag_atual'],'UTF8'); 
    $tag_antiga = mb_strtoupper($_GET['tag_antiga'],'UTF8');
    $pontuacao = mb_strtoupper($_GET['pontuacao'],'UTF8');
    
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE lista_motoristas SET nome='$nome', data_nascimento='$nascimento', cpf='$cpf', cnh='$cnh', validadecnh='$val_cnh', celular='$contato', tag_motorista_atual='$tag_atual', tag_motorista_antiga='$tag_antiga'                   WHERE cpf='$cpf'");
    


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
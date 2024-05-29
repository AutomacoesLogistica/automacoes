<html>
<head>
 <title>Salvando dados de Complemento</title>

</head>
<body>
<form method="post" action="exibir_motorista_1.php">
<?php
    
    $nome_transportadora_a = isset($_GET['select_TransportadoraA'])?mb_strtoupper($_GET['select_TransportadoraA'],'UTF8'):""; 
    $nome_transportadora_u = isset($_GET['select_TransportadoraU'])?mb_strtoupper($_GET['select_TransportadoraU'],'UTF8'):""; 
    $cpf = mb_strtoupper($_GET['cpf'],'UTF8');
    $spot = isset($_GET['spot'])?mb_strtoupper($_GET['spot'],'UTF8'):"";

    if ($spot=="NÃO")
    {
    $spot = "NÃO";
    }else if($spot=="SIM")
    {
    $spot = "SIM";
    }else
    {
    $spot = "";
    }

    $ativo = isset($_GET['ativo'])?mb_strtoupper($_GET['ativo'],'UTF8'):"";
    
    if ($ativo=="NÃO")
    {
     $ativo = "NÃO";
    }else if ($ativo = "SIM")
    {
     $ativo = "SIM";
    }else
    {
     $ativo = "xxx";
    }



    $tipo2 = isset($_GET['tipo'])?mb_strtoupper($_GET['tipo'],'UTF8'):"";

    if ($tipo2 == "AGREGADO")
    {
     $tipo2 = "AGREGADO";
     $tipo = "AG";
    }else if ($tipo2 == "FROTA"){
    $tipo2 = "FROTA";
    $tipo = "FR";
    }else{
     $tipo2 = "TERCEIRO";
     $tipo = "TR";
    }
    

    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE lista_motoristas SET nome_transportadora_a='$nome_transportadora_a', nome_transportadora_u='$nome_transportadora_u', motorista_spot='$spot', cadastro_ativo='$ativo', tipo_veiculo='$tipo', tipo_veiculo_2='$tipo2'  WHERE cpf='$cpf'");
    


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
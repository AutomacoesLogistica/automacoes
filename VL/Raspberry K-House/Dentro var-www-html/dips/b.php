<?php



$erro = 0;
include_once 'conexao_dashboard.php';
$sqt = $dbcon->query("SELECT * FROM atualizacao WHERE condicao='Erro'");
if(mysqli_num_rows($sqt)>0)
{
 while($dados = $sqt->fetch_array())
 {
  $erro2 = intval($erro2)+1;
 }
}
//echo $erro;
?>
<script>

console.log('<?php print $erro2 ?>');

var encontrados_erro = '<?php print $erro2 ?>';
if(encontrados_erro==0)
{

    console.log('Nao tem erros, todos estao OK!');
}
else
{
console.log( 'Existem '+ encontrados_erro + ' dispositivos com problema!');
}

</script>
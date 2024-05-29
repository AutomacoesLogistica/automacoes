<?php 
    $host = "192.168.10.35";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_poste_balanca1";

try {
  $conn = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE display_balanca1 SET  mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',ponto='$ponto' WHERE id='1'";

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
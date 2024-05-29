<?php
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistica</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid mt-3">

    <h2> Gerenciador de Arquivos</h2>
    <div class="card">
        <div class="card-body">
            <form action="envia.php" method="POST" enctype="multipart/form-data">
                <input id='arquivo' type="file" name="arquivo">
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
    <h6 class="mt-3">ARQUIVOS BANCO DE DADOS</h6>
    <table border="3" class="table table-striped table table-hover">
        <thead class="table table-striped table-dark">
            <tr>
                <td >Nome</td>
                <td align="center">Download</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = $dbcon->query("SELECT * FROM arquivos ORDER BY id DESC");
            if(mysqli_num_rows($sql)>0)
            {
             while($dados = $sql->fetch_array())
             {
              $nome_do_arquivo = $dados['nome'];
              $localidade = $dados['localidade'];   
             ?>
              <tr class="table-info">
                <td><?php echo $nome_do_arquivo ?></td>
                <td><a href="arquivos/<?php echo $nome_do_arquivo ?>">Download</a></td>
              </tr>
             <?php
             }// Fecha o while 
            } // Fecha o if mysqli_num_rows($sql)>0
            ?>
            
        </tbody>
    </table>
    
</div>
</body>
</html>
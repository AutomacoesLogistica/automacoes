<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <input type="button" id="btn_Extrair" name="btn_Extrair" value="Exportar Eventos" onclick="Exportar()"/> 
  
  <table border= 1px; >
  <thead >
    <tr>
    	<th class="th1">Foto Evento</th>
    	<th class="th2">Dados Evento</th>
    	
    </tr>
  </thead>
  
  <tbody>
    
  
  <?php
    $data_leitura = isset($_GET['data_leitura'])?$_GET['data_leitura']:"08/10/2021";
    $local = "Miguel Burnier";
    $encontrado = 0;
    include_once 'conexao_sva.php';
    $sql = $dbcon->query("SELECT * FROM pessoas_descartado WHERE data_leitura='$data_leitura' ");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      
      $encontrado = $encontrado + 1;   
      $tipo_evento = $dados['tipo_evento'];   
      $media_server_id = $dados['media_server_id'];
      $horario1 = $dados['data_leitura'];
      $horario2 = $dados['hora'];
      $horario = $horario1. "  - " .$horario2;
      $text = $dados['text'];
      $caminho1 = $dados['caminho'];
      $caminho2 = $dados['caminho_video'];
      $foto = $dados['imagem'];

      if($encontrado == 1)
      {
        echo ("</BR>");
        echo("<H2>Dados do site de ");
        echo ($local);
        echo("</H2>");
      }
      ?>
      <tr>
      <td>
      <?php
      echo ("</BR>");
      ?>
      <img id='foto' src="data:image/jpeg;base64,<?php print $foto ?>";/>
     </td>
     <td>
      <?php  
      echo ("<b>Tipo Evento : </b>".$tipo_evento); 
      echo ("</BR>"); 
      echo ("<b>Media Server ID : </b>".$media_server_id); 
      echo ("</BR>"); 
      echo ("<b>Horario Detecção : </b>".$horario);
      echo ("</BR>"); 
      echo ("<b>Texto do Evento : </b>".$text);
      echo ("</BR>"); 
      echo ("<b>URL 1 : </b><a href>".$caminho1."</a>");
      echo ("</BR>"); 
      echo ("<b>URL 2 : </b><a href>".$caminho2."</a>");    
      ?>
      </td>
     </tr>
      <?php
     }
     
    }

   


     ?> 
<?php


?>

<script>
function Exportar()
{
    alert("entrou");
   
}


</script>


</body>
</html>
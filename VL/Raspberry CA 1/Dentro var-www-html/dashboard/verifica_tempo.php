<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>
    <script>
         var array_id = [];
         var msg = '';
         var encontrado = 0;

        
  for (i=0;i<100;i++)
  {
    array_id[i]=0;
  }
</script>

    <?php
     error_reporting(0);
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     $mensagem2 = explode('/',$data);
     $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
     $data_agora = $mensagem2 . ' ' . $hora;  
     //echo($data_agora);    
     //echo'</BR>';

    // Conecto no banco e busco os valores
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM dashboard ORDER BY id DESC");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrados = 0;
     while($dados = $sql->fetch_array())
     { 
       
        $id= $dados['id'];
        $data_banco = $dados['data_leitura'];
        $hora_banco = $dados['hora_leitura'];
		$tipo = $dados['tipo'];
		
             //Inverte o padrao da hora para efetuar o calculo
             $mensagem = explode('/',$data_banco);
             $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
             $horario_banco = $mensagem . ' ' . $hora_banco; 
     
            
             //Agora calculo a diferença
             $data_inicio = new DateTime($data_agora);
             $data_fim = new DateTime($hora_banco);
         
             // Resgata diferença entre as datas
             $dateInterval = $data_inicio->diff($data_fim);
             $mensagem = $dateInterval->format("%H:%I:%S");
             //echo $mensagem;
             
             $mensagem = explode(':',$mensagem);
             $hora = $mensagem[0];
             $minuto = $mensagem[1];
             $segundo = $mensagem[2];
             /*
             echo("</BR>");
             echo($hora);
             echo("</BR>");
             echo($minuto);
             echo("</BR>");
             echo($segundo);
             */
             if((intval($minuto)>10 || intval($hora)>0 ) && $tipo == 'Saida')
			 {
			  echo $id;echo'</BR>';
			  ?>
              <script>
                  encontrado = '<?php print $encontrados ?>';
                  array_id[encontrado] = '<?php print $id ?>';
                  msg += '<?php print $id ?>,';
              </script>
              <?php
              $encontrados = $encontrados + 1; 
			 }
			 else if (intval($hora)>3)
             {
               
             echo $id;echo'</BR>';
              ?>
              <script>
                  encontrado = '<?php print $encontrados ?>';
                  array_id[encontrado] = '<?php print $id ?>';
                   
                    msg += '<?php print $id ?>,';
                  

              
             </script>
              <?php
              $encontrados = $encontrados + 1; 
             }
     }
    }
	echo json_encode($encontrados);
   ?>

<script>
   tamanho = msg.length;
   
   msg = msg.substring(0,tamanho-1);  // valores para publicação!
   
  // console.log(msg);
  
  //Passa para tratar
  $.ajax({
           url: 'valida_verifica_tempo.php',
           type: 'GET',
           dataType: 'json',
           data: {'msg': msg},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
    </script>

</body>
</html>
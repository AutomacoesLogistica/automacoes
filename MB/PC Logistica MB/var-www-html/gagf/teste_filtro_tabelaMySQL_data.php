<html>
 <head>

 </head>
 <body>
   
        <?php
        $encontrado = 0;
        include_once 'conexao_ttp_mb_2020.php';
        $sql = $aux_conexao_ttp->query("SELECT * FROM abril WHERE data_entrada between '01/04/2020' and '03/04/2020'");
        if(mysqli_num_rows($sql)>0)
        {
         while($dados = $sql->fetch_array())
         { 
             $encontrado++;
         //$mensagem= $dados['id_processo_gscs'];
         //echo $mensagem;echo"</br>";
         }
        }
        echo $encontrado;
         ?>

 </body>
</html
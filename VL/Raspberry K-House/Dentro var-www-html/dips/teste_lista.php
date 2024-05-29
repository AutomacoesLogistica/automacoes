<?php

//Primeiro busco as 10 ultimas tags no banco
      $encontrado = 0;
      $epcs = array();
      $ultima_epc = '';
      $tag_carreta = $_GET['epc'];

      echo  'Tag Nova = ' . $tag_carreta;
      echo '</BR>';

      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM historico_validacoes ORDER BY id DESC LIMIT 10");
      if(mysqli_num_rows($sql)>0)
      {
       while($dados = $sql->fetch_array())
       { 
        $encontrado = intval($encontrado)+1;
        $v_epc = trim($dados['placa_ou_tag']);
        if($encontrado == 1){$ultima_epc = $v_epc;}
        $epcs[$encontrado] = trim($v_epc);
       } 
      }
      
      echo 'Encontrados : ' . $encontrado;
      echo '</BR>';echo '</BR>';
      for ($x = 1; $x <= intval($encontrado); $x++) {
         echo "Valor " . $x. "  - EPC = " . $epcs[$x]." <br>";
       }
       echo '</BR>';
       echo '</BR>';
       echo ' Ultima EPC banco = ' . $ultima_epc;
       echo '</BR>';
       echo '</BR>';
       if(trim($tag_carreta) != $ultima_epc)
       {
        if (in_array($tag_carreta, $epcs))
        { 
         //echo "Tem a tag, nao pode salvar!";
         echo 'nao pode';
        }
        else
        {
        //echo ' Nao tem a tag, pode salvar!';  
        include_once 'conexao_dashboard.php';
        echo 'pode';
         //$sql = $dbcon->query("INSERT INTO tabela_validacoes (placa_ou_tag,validado) VALUES ('$tag_carreta','0')");
        }   
       }
       else
       {
         echo 'Igual a ultima, nao podendo ser salvo!';
       }
      ?>
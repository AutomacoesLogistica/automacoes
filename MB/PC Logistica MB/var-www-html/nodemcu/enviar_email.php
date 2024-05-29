<!DOCTYPE html>
<html lang="pt-br">
    <head>
     <meta charset="utf-8"/>
     <title>Publica Emails</title>
    </head>
<body onload="verificar_emails()">

</body>


<script>



function verificar_emails()
{
<?php
require_once(".\PHPMailer\PHPMailerAutoload.php");
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM tbl_email");
$linha = 0;
$local = "";
$condicao = "";
$data = "";
$hora = "";
$encontrado = 0;  
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrado++;
  if($encontrado == 1)
  {
   $local = $dados['ponto'];
   $condicao = $dados['condicao'];
   $data = $dados['data'];
   $hora = $dados['hora'];
   $linha = $dados['id']; // busco o ID para poder apagar em seguida
   }  
 } // fecha o while
}
else
{
 echo"sem_emails";
 $encontrado = 0;
 $linha = 0;   
}





$nome_email = "";

if ($linha != 0)
{

    $nome_email = "brunogoncalves170889@gmail.com";





 // ENVIA O EMAIL
 $mail = new PHPMailer();
 $mail->isSMTP();
 $mail->SMTPOptions = array(
      'ssl'=>array(
      'verify_peer'=> false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
 );
 $mail->SMTPDebug=2;
 $mail->Host = "smtp.gmail.com";
 $mail->SMTPSecure = "tls";
 $mail->Port = 587;
 $mail->SMTPAuth = true;
 $mail->Username='automacaologistica2020@gmail.com';
 $mail->Password='2020logistica';
 $mail->WordWrap = 50; // Definição de quebra de linha
 $mail->IsHTML(true); // envio como HTML se 'true'
 $mail->setFrom($nome_email, 'Automacao Logistica'); // 1 parametro mesmo para quem vai, 2 aparece ao lado de quem enviou
 $mail->addAddress($nome_email); // Email Destinatario
 $mail->Subject = 'LINK '.$local; // Titulo do Email
 $mail->CharSet = 'utf-8';

 if($condicao == "OFFLINE")
 { 
  // Estava ONLINE e acabou de cair
  $mail->Body = "Link/Sistema do(a) $local está $condicao <br> $data as $hora";
 
}
 else if($condicao == "ONLINE")
{
 // Estava OFFLINE e acabou de voltar
  $mail->Body = "Link/Sistema do(a) $local estava OFFLINE e voltou a comunicar! <br> Neste momento se encontra ONLINE! <br> $data as $hora";

}else if($condicao == "BAT")
{
 // Estava sendo alimentado por AC e agora está por bateria
 $mail->Body = "Link/Sistema do(a) $local está sem alimentação AC, o mesmo está sendo alimentado agora por BATERIA! <br> ATENÇÃO : <br> Solicitar verificação do sistema antes que o mesmo fique inoperante, pois a bateria consegue alimentar o sistema por poucas horas! <br> $data as $hora";
 
}else if($condicao == "AC")
{
 // O link estava sendo alimentado por BATERIA mais a alimentação AC normalizou
    $mail->Body = "Link/Sistema do(a) $local estava sendo alimentado por BATERIA, porém a energia foi restabelecida! ( AC ) <br> $data as $hora";
 }
 
 
 if($mail->send())
 {
  //echo "Enviado com sucesso!";
 }else{
 //echo " Falha ao enviar o email!";   
 }
 


 // APAGA DO BANCO O EMAIL PARA NÃO FICAR REENVIANDO 
 $sql = $dbcon->query("DELETE FROM `tbl_email` WHERE `tbl_email`.`id` = '$linha'");
 ?>
 document.location.reload(true);
 <?php
} // Fecha se linha == 0

?>

} // Fecha verificar emails

setTimeout("location.reload(true);",10000); // recarrega a pagina em 5 segundos
</script>
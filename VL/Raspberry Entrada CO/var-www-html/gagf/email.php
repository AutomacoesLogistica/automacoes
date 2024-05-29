<!DOCTYPE html>
<html lang="pt-br">
    <head>
     <meta charset="utf-8"/>
     <title>Publica Emails</title>
    </head>
<body onload="verificar_emails();">

 

</body>


<script>



function verificar_emails()
{
<?php
$nome  = $_GET['valor'];
if($nome == "")
{
   $nome = 'vazio';
}


require_once(".\PHPMailer\PHPMailerAutoload.php");
$nome_email = "";
$nome_email = "brunogoncalves170889@gmail.com";
 // ENVIA O EMAIL
 $mail = new PHPMailer();
 $mail->isSMTP();
 $mail->SMTPDebug=0;
 $mail->setLanguage('pt-br');
 $mail->Host = 'smtp.gmail.com';
 $mail->SMTPSecure = 'tls';
 $mail->Port = 587;
 $mail->SMTPAuth = true;
 $mail->Username='automacaologistica2020@gmail.com';
 $mail->Password='bruno2683@@';
 $mail->IsHTML(true); // envio como HTML se 'true'
 $mail->setFrom($nome_email, 'Automacao Logistica'); // 1 parametro mesmo para quem vai, 2 aparece ao lado de quem enviou
 $mail->addAddress($nome_email); // Email Destinatario
 $mail->Subject = 'Excesso VL'; // Titulo do Email
 $mail->CharSet = 'utf-8';
 $mail->AddEmbeddedImage('upload/grafico1.png', 'logo_ref');
 $mail->Body = "<!DOCTYPE html>
 <html lang='pt-br'>
 <head>
 <meta charset='utf-8'/>
 <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
 <title>Título da Página (Estrutura básica de uma página com HTML 5)</title>
 <link href='css/seu-stylesheet.css' rel='stylesheet'/>
 <script src='scripts/seu-script.js'></script>
 </head>
 <body>
 <font color='black' face='arial'  size='4px'>Olá,$nome<p>
 <h3>Recebemos o seu pedido!</h3><p> Deposite Nessa Conta o Valor da compra: 4752564814 01 Apos o deposito entraremos em contato para o envio!
 <img src='cid:logo_ref'/>
 </font>
 </html>
 ";

 if(!$mail->send())
 {
  echo "Enviado com sucesso!";
 }
 else
 {
  echo " Falha ao enviar o email!";   
 }
 
?>

} // Fecha verificar emails

//setTimeout("location.reload(true);",10000); // recarrega a pagina em 5 segundos
</script>
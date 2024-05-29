<?php

// Para funcionar voce deve habilitar autenticação em 2 etapas no seu email
// tambem cadastrar uma senha app e usa-la embaixo, nao a senha de login no email!

// Outro ponto que deve ser habilitado:
// Clicar na engrenagem do email > Mostrar todas as configuracoes > Encaminhamento e POP/IMAP > 
// >>> Em Acesso IMAP   >  selecione Ativar IMAP e role para baixo e salve as alterações


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';



try {
    $mail= new PHPMailer;
    $mail->IsSMTP();        // Ativar SMTP
    $mail->SMTPDebug = false;       // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
    $mail->SMTPAuth = true;     // Autenticação ativada
    $mail->SMTPSecure = 'ssl';  // SSL REQUERIDO pelo GMail
    $mail->Host = 'smtp.gmail.com'; // SMTP utilizado
    $mail->Port = 465;
    $mail->Username = 'automacoeslogistica2023@gmail.com';
    $mail->Password = 'wnfcfwkrncoxdoju';


    // Remetente e Destinatários
    $mail->setFrom('automacoeslogistica2023@gmail.com', 'AUTOMACOES LOGISTICA');
    $mail->addAddress('brunogoncalves170889@gmail.com','Automacoes Logistica');
    
    // Anexos
    //$mail->addAttachment('/var/tmp/arquivo.tar.gz');
    //$mail->addAttachment('/tmp/imagem.jpg', 'novo-nome.jpg');

    // Conteúdo
    $mes = 'novembro';
    $site = 'Miguel Burnier';
    $mail->isHTML(true);
    $mail->Subject='Relatorio TTP Automatizado';
    $menssagem = ('Olá,<br> segue o relatório do TTP referente ao mês de '.$mes.' do site de ' .$site);
    
    
    
    
    
    
    
    
    $mail->Body = $menssagem;
    if ($mail->send()){
        $ok = 'Sim';
    }else{
        $ok = 'Não';
    }  
    echo "Enviado email? " . $ok;
} catch (Exception $exception) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}
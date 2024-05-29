<?php
if (isset($_FILES['meu_arquivo']) && !empty($_FILES['meu_arquivo']['name'])) {
    /*Arquivo está sendo enviado para pasta UPLOAD */
    $move_upload_rs = move_uploaded_file($_FILES['file']['tmp_name'], "upload/" . $_FILES['meu_arquivo']['name']);
    if($move_upload_rs){
    $resultado = array('status' => 'ok');
    }else{
    $resultado = array('error' => 'fail');
    }
    } else {
    $resultado = array('error' => 'fail');
    }
    header('Content-Type: application/json');
    echo json_encode($resultado);
    die();

?>


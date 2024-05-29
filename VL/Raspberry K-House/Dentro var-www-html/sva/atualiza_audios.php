<?php
$audio  = isset($_GET['audio'])?$_GET['audio']:"vazio";

if($audio == "vazio")
{
echo json_encode('erro');
}
else
{
    echo json_encode('ok');
}


 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<img id="caminhoes" src="./images/caminhoes.png" />
<img id="logo" src="./images/logo.png" hidden="hidden" />

<?php





?>
<center>
<div id="login">
<form method="post" autocomplete="off">
<input type="text" name="registro" class="campos" id="registro" a rel="ajuda" placeholder ="Digite seu registro" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />

<br/><br/>
<input type="text" name="nome" class="campos" id="nome" a rel="ajuda" placeholder ="Digite seu nome completo" autocomplete="off" onkeypress="return ApenasLetras(event,this);"/>
<br/><br/>
<input type="password" name="passwd" class="campos" id="passwd" a rel="ajuda" placeholder="Digite sua senha de acesso" autocomplete="off"  />
<br/><br/>
<input type="password" name="passwd2" class="campos" id="passwd2" a rel="ajuda" placeholder="Repita a senha" autocomplete="off"  />
<br/><br/>
<input id='verificar'  type="button" value="Efetuar Cadastro" class="BotaoMenu" onclick="validar()"/>
</BR></BR>
<input id='primeiro_acesso' type="button" value="Voltar" class="BotaoMenu" onclick="javascript: location.href=`login.php`;"/>


<script>

function validar()
{
 var passwd = document.getElementById('passwd');
 var passwd2 = document.getElementById('passwd2');
 var nome = document.getElementById('nome');
 var registro = document.getElementById('registro');
 if(passwd.value != '' && passwd2.value != '' && nome.value != '' && registro.value != '')
 {
  
  if(passwd.value == passwd2.value)
  {
    if((registro.value).length != 8)
    {
     alert("Favor inserir um registro válido GERDAU, com 8 digitos!");   
     registro.focus();
    }
    else
    {
      if((nome.value).length < 12)
      {
        alert("Favor inserir um nome completo!");
        nome.focus();
      }
      else
      {
        // alert("ok");
        //Agora posso salvar os dados
        nome = (nome.value).toUpperCase();
        passwd = passwd.value;
        //alert(passwd);
        registro = registro.value;
        var criptografia = (parseInt(registro)*1.5).toFixed(1);
        $.ajax({
           url: 'salvar_primeiro_acesso.php',
           type: 'GET',
           dataType: 'text',
           data: {'nome': nome,'passwd': passwd, 'registro': registro, 'criptografia': criptografia },
           success: function(resultado)
           {
            alert(resultado);  
            if(resultado == 'Usuario já está cadastrado no sistema!')
            {
             document.getElementById('nome').value='';
             document.getElementById('passwd').value = '';
             document.getElementById('passwd2').value = '';
             document.getElementById('registro').value= '';
             document.getElementById('registro').focus();
            }
            else if(resultado == 'Cadastro efetuado com sucesso!\n\n\nBasta agora voltar a tela inicia e logar!')
            {
             document.getElementById('nome').value='';
             document.getElementById('passwd').value = '';
             document.getElementById('passwd2').value = '';
             document.getElementById('registro').value= '';                
             location.href=`login.php`;
            }
            
           }
                     
         });  
        

      }
    }
   
  }
  else
  {
    alert("As senhas não conferem, favor verificar!");
    passwd.focus();
  }
 }
 else
 {
    if(registro.value == '')
    {
    alert ( "Favor inserir o valor do registro!") ;
    registro.focus();
    }  
    else if(nome.value == '')
    {
    alert ( "Favor inserir o valor do nome!") ;
    nome.focus();
    }  
    else if(passwd.value == '')
    {
    alert ( "Favor inserir o valor para a senha!") ;
    passwd.focus();
    }  
    else if(passwd2.value == '')
    {
    alert ( "Favor inserir o valor para confirmação da senha!") ;
    passwd2.focus();
   }    
  }

}


var link_registro = window.document.getElementById('registro');
link_registro.focus();
function ApenasLetras(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        } else if (e) {
            var charCode = e.which;
        } else {
            return true;
        }
        if (
            (charCode > 7 && charCode <48 ) ||
            (charCode > 64 && charCode < 91) || 
            (charCode > 96 && charCode < 123) ||
            (charCode > 191 && charCode <= 255) // letras com acentos
        ){
            return true;
        } else {
            return false;
        }
    } catch (err) {
        alert(err.Description);
    }
}
</script>


</form>



</body>



<style>


.mensagem{
  display:none;
  position:absolute;
  top: 40%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:250px;
  right:0;
  margin: auto;
  width:400px;
  height:20px;
  border:0px solid red;
}

#primeiro_acesso
{
 text-align: center;   
}

IMG#caminhoes{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 120px;
    width: 250px;
    height: 170px;
    cursor: pointer;

}
IMG#logo{
    margin-left: 0px;
    position: absolute;
    left: 43%;
    top: 20px;
    width: 130px;
    height: 45px;
    cursor: pointer;

}
INPUT.BotaoMenu {
     width: 250px;
     height: 35px;
     font-weight: bold;
     font-family: verdana;font-size: 12pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 8px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

DIV#login{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 330px;
    
}

.campos{
    float:top;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    font-family: verdana;font-size: 8pt;
    width:240px;
    height:10px;
    text-align:left;
    border-radius: 9px!important;
    border-color: #191970;
    border-style: solid!important;
}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    font-family: verdana;font-size: 12pt;
    left: 40%;
    top: 90%;
}
body{

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}















</style>



</html>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  display: none;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #000000; 
}










#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  color: #FFFFFF;
  background-color: #00008B;
}


  

</style>
</head>
<body>

<h2>Ocorrências Turno</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquise o que desejar." title="Type in a name" >

<ul id="myUL">
<div class="panel"><li><a href="#" class="accordion">14/03/2020 - Quebra carreta</a><p>Motorista ao tentar retornar para o controle de acesso o cavalinho veio a apresentar falhas de lubrificação!</p></li></div>
<div class="panel"><li><a href="#" class="accordion">15/03/2020 - Quebra carreta</a><p>Motorista ao tentar retornar!</p></li></div>
  <li><a href="#">18/03/2020 - Quebra carreta</a></li>

  <li><a href="#">22/03/2020 - Agarramento carreta</a></li>
  <li><a href="#">24/03/2020 - Falta de energia</a></li>

 
</ul>

<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

var acc = document.getElementsByClassName("accordion");
var i;




for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}


var panel = window.document.getElementsByClassName('accordion')
         panel.style.display = "none";
    
</script>
</body>
</html>

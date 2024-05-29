<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<template id="tmplDialog">
<div class="modal hidden">

 </div>
  <div class="dialog">
  <div class="icon">
  <img id="voltar" src="./images/logoff.PNG"/>
  
    </div>
    <div class="content">
    </div>
    <div class="menu">
        
    </div>
  </div>
</template>

<script>
var Dialog = function () {
  this.fragment = document.importNode(this.template, true);
  this.elements = {};
  this.elements.modal = this.fragment.querySelector(".modal");
  this.elements.container = this.fragment.querySelector(".dialog");

  this.elements.icon = this.elements.container.querySelector(".icon");
  this.elements.content = this.elements.container.querySelector(".content");
  this.elements.menu = this.elements.container.querySelector(".menu");  
  this.iconUrl = "";
  
  document.body.appendChild(this.fragment);  
}

Dialog.prototype.template = document.getElementById("tmplDialog").content;
Dialog.prototype.addAcao = function (texto, callback) {
  var self = this;
  var button = document.createElement("button");
  button.textContent = texto;
  button.addEventListener("click", function (event) {
    callback(self);
  });
  this.elements.menu.insertBefore(button, this.elements.menu.children[0]);
}

Dialog.prototype.close = function () {
  document.body.removeChild(this.elements.modal);
  document.body.removeChild(this.elements.container);
}

Object.defineProperty(Dialog.prototype, "icon", {
  get: function () {
    return this.iconUrl;
  },
  set: function (value) {
    this.iconUrl = value;
    this.elements.icon.style.backgroundImage = "url(" + value + ")";
  }
});

Object.defineProperty(Dialog.prototype, "texto", {
  get: function () {
    return this.elements.content.textContent;
  },
  set: function (value) {
    this.elements.content.textContent = value;
  }
});

Object.defineProperty(Dialog.prototype, "modal", {
  get: function () {
    return !this.elements.modal.classList.contains("hidden");
  },
  set: function (value) {
    if (value != this.modal) {
      if (value)
        this.elements.modal.classList.remove("hidden");
      else
        this.elements.modal.classList.add("hidden");
    }
  }
});

var dialog = new Dialog();

dialog.texto = "Deseja realmente justificar o evento?     </BR> Data: 16/08/2021";
dialog.modal = true;
dialog.addAcao("Sim", function (self) {
  
  alert("Sim");
  self.close();
})
dialog.addAcao("Não", function (self) {
  
  alert("Não");
  self.close();
})
</script>

<style>



IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 0px;
    top: 0%;
    width: 130px;
    height: 130px;
    cursor: pointer;

}



.modal, .dialog {
  position: fixed;
  top: 0px;
  right: 0px;
  bottom: 0px;
  left: 0px;
  margin: auto;
}

.modal {
  background-color: rgba(0, 0, 0, 0.3);
}

.hidden {
  display: none;
}

.dialog {
  background-color: white;
  box-shadow: 0px 0px 5px black;
  border-radius: 5px;
  width: 448px;
  height: 128px;
  overflow: hidden;
}

.dialog .icon {
  position: absolute;
  top: 0px;
  left: 0px;
  background-color: whitesmoke;
  width: 128px;
  height: 128px;
  border-right: 1px solid gainsboro;
  
  background-size: calc(100% - 10px);
  background-position: center;
  background-repeat: no-repeat;
}

.dialog .content {
  position: absolute;
  top: 0px;
  right: 0px;
  bottom: 35px;
  left: 128px;
  padding: 10px;
}

.dialog .menu {
  position: absolute;
  box-sizing: border-box;
  right: 0px;
  bottom: 0px;
  left: 128px;
  height: 40px;
  border-top: 1px solid gainsboro;
  padding: 5px;
}

.dialog .menu button {
  float: right;
  box-sizing: border-box;
  padding: 5px;
  line-height: 15px;
  background-color: whitesmoke;
  border: 1px solid gray;
}

.dialog .menu button:hover {
  background-color: gainsboro;
}

</style>

</body>
</html>
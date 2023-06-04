function showHint(str) {
    str = this.value;
      if (str.length == 0) {
          document.getElementById("txtHint").innerHTML = "";
          return;
      } else {
          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function() {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        xmlhttp.open("GET", "../../src/Infraestructura/buscadorAccesoDatos.php?q=" + str);
        xmlhttp.send();
      }
  }
  
  window.onload = function(){
    texto = document.getElementById("texto");
    texto.addEventListener("keyup",this.showHint);
  }

function showHint(str) {
  str = this.value;
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
          
          document.getElementById("table").innerHTML = "";

          separadas = this.responseText.split(",");
          document.getElementById("txtHint").innerHTML = "";

          tablaH = document.createElement("th");
          document.getElementById("table").appendChild(tablaH);
          tablaH.innerHTML="PAÏSOS";
          for (let i = 0; i < separadas.length; i++) {
            tablaR = document.createElement("tr");
            document.getElementById("table").appendChild(tablaR)
            tablaD = document.createElement("td");
            tablaR.appendChild(tablaD);

            tablaD.innerHTML = separadas[i];
          }
        }
      xmlhttp.open("GET", "ejer2.php?q=" + str);
      xmlhttp.send();
    }
}

window.onload = function(){
  texto = document.getElementById("eleccion");
  texto.addEventListener("change",this.showHint);
}
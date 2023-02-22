
function showHint(str) {
  str = this.value;
  p = document.getElementById("selectPais").value;

  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {

    separadas = this.responseText.split(",");

    contenedor = document.getElementById("contenedor");
    contenedor.innerHTML = "";

    h2 = document.createElement("h2");
    contenedor.appendChild(h2);
    
    for (let i = 0; i < separadas.length; i++) {

      h2.innerHTML = document.getElementById("selectCiudad").value;
      text = document.createElement("p");
      contenedor.appendChild(text);

      text.innerHTML = separadas[i];
      }
  }
xmlhttp.open("GET", "ejer3_3.php?q=" + str+"&p="+p);
xmlhttp.send();
}

contador = 0;

function showHint2() {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
      
        contador = 0;
        if (contador === 0){
        separadas = this.responseText.split(",");
      
        selectPais = document.getElementById("selectPais");
        selectPais.innerHTML = "";
        option = document.createElement("option");
        selectPais.appendChild(option);
        option.innerHTML = "Tria un país";
        option.disabled = true;
        for (let i = 1; i < separadas.length; i++) {

          option = document.createElement("option");
          selectPais.appendChild(option);

          option.innerHTML = separadas[i];
          contador++;
          }
        }
      }
    xmlhttp.open("GET", "ejer3.php?");
    xmlhttp.send();
  }

  function showHint3(str) {
    str = this.value;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {

      separadas = this.responseText.split(",");
    
      selectPais = document.getElementById("selectCiudad");
      selectPais.innerHTML = "";

      option = document.createElement("option");
      selectPais.appendChild(option);
      option.innerHTML = "Tria una ciutat";
      option.disabled = true;
      for (let i = 0; i < separadas.length; i++) {

        option = document.createElement("option");
        selectPais.appendChild(option);

        option.innerHTML = separadas[i];
        }
    }
  xmlhttp.open("GET", "ejer3_2.php?q=" + str);
  xmlhttp.send();
}
window.onload = function(){
  texto = document.getElementById("selectPais");
  showHint2();
  texto.addEventListener("change",this.showHint3);
  texto2 = document.getElementById("selectCiudad");
  texto2.addEventListener("change",this.showHint);
}
    
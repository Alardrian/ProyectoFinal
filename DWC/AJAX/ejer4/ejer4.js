
function showHint(str) {
  str = this.value;
  p = document.getElementById("selectPais").value;

  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {


    respuesta = JSON.parse(this.response);

    contenedor = document.getElementById("contenedor");
    contenedor.innerHTML = "";

    h2 = document.createElement("h2");
    contenedor.appendChild(h2);
    
    for (let i = 0; i < respuesta.length; i++) {

      h2.innerHTML = document.getElementById("selectCiudad").value;
      text = document.createElement("p");
      contenedor.appendChild(text);

      text.innerHTML = "Distrito: "+respuesta[i].District +"<br><br>Poblacio: "+respuesta[i].Population;
      }
  }
xmlhttp.open("GET", "ejer4_3.php?q=" + str+"&p="+p);
xmlhttp.send();
}

contador = 0;

function showHint2() {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
      
        contador = 0;
        if (contador === 0){
        respuesta = JSON.parse(this.response);
        
        selectPais = document.getElementById("selectPais");
        selectPais.innerHTML = "";
        option = document.createElement("option");
        selectPais.appendChild(option);
        option.innerHTML = "Tria un país";
        option.disabled = true;
        for (let i = 1; i < respuesta.length; i++) {

          option = document.createElement("option");
          selectPais.appendChild(option);

          option.innerHTML = respuesta[i].Name;
          contador++;
          }
        }
      }
    xmlhttp.open("GET", "ejer4.php?");
    xmlhttp.send();
  }

  function showHint3(str) {
    str = this.value;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      respuesta = JSON.parse(this.response);
    
      selectPais = document.getElementById("selectCiudad");
      selectPais.innerHTML = "";

      option = document.createElement("option");
      selectPais.appendChild(option);
      option.innerHTML = "Tria una ciutat";
      option.disabled = true;
      for (let i = 0; i < respuesta.length; i++) {

        option = document.createElement("option");
        selectPais.appendChild(option);

        option.innerHTML = respuesta[i].Name;
        }
    }
  xmlhttp.open("GET", "ejer4_2.php?q=" + str);
  xmlhttp.send();
}
window.onload = function(){
  texto = document.getElementById("selectPais");
  showHint2();
  texto.addEventListener("change",this.showHint3);
  texto2 = document.getElementById("selectCiudad");
  texto2.addEventListener("change",this.showHint);
}
    
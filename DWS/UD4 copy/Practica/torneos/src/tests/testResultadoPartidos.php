
<?php
    require("../Infraestructura/gestionTorneosAccesoDatos.php");
    
    function test_torneoReciente() {
        $u = new GestionTorneosAccesoDatos();

        $u->obtenerPartidos();

        return ($u != null);
      
      }
      var_dump(test_torneoReciente());
    

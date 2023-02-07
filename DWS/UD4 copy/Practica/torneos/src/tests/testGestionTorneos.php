
<?php
    require("../Infraestructura/gestionTorneosAccesoDatos.php");
    
    function test_torneoReciente() {
        $u = new GestionTorneosAccesoDatos();

        $u->obtenerTorneoReciente();

        return ($u != null);
      
      }
      var_dump(test_torneoReciente());
    

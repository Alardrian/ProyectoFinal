
<?php
    require("../Infraestructura/torneosAccesoDatos.php");
    
    function test_listaTorneos() {
        $u = new TorneosAccesoDatos();

        $u->obtenerTorneos();

        return ($u != null);
      
      }
      var_dump(test_listaTorneos());
    

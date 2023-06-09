<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>sungla</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="../../css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="../../css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="../../css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="../../images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   <script src="../../js/buscador/buscador.js"></script>
</head>
<!-- body -->

<body class="main-layout position_head">
   <?php
   session_start();
   if (!isset($_SESSION['usuario'])) {
      header("Location: loginVista.php");
   }
   ?>
   <!-- loader  
      <div class="loader_bg">
         <div class="loader"><img src="../../images/loading.gif" alt="#" /></div>
      </div>-->
   <!-- end loader -->
   <!-- header -->
   <header>
      <!-- header inner -->
      <div class="header">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo">
                           <a href="index.php"><img src="../../images/logo.png" alt="#" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item ">
                              <a class="nav-link" href="index.php">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="about.php">About</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="glasses.php">Our Glasses</a>
                           </li>
                           <li class="nav-item active">
                              <a class="nav-link" href="shop.php">Shop</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="contact.php">Contact Us</a>
                           </li>
                           <li class="nav-item d_none login_btn">
                              <a class="nav-link" href="#">Login</a>
                           </li>
                           <li class="nav-item d_none">
                              <a class="nav-link" href="#">Register</a>
                           </li>
                           <li class="nav-item d_none sea_icon">
                              <a class="nav-link" href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i><i
                                    class="fa fa-search" aria-hidden="true"></i></a>
                           </li>images
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <?php echo "<div class='usuario'>Bienvenido: " . $_SESSION['usuario'] . " <br><a href='logOutVista.php'> Cerrar sesion </a></div>"; ?>
      <form>
         Introduce el coche que buscas: <input type="text" id="texto">
      </form>

      <p><span id="txtHint"></span></p>
      <h2>Alquiler de Coches</h2>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <label>Fecha de Inicio:</label>
         <input type="date" name="fecha_inicio" required><br>

         <label>Fecha de Fin:</label>
         <input type="date" name="fecha_fin" required><br>

         <label>Tipo de Vehículo:</label>
         <select name="tipo_vehiculo" required>
            <option value="1">Compacto</option>
            <option value="2">SUV</option>
            <option value="3">Furgonetas</option>
         </select><br>
         <label>Tipo de seguro:</label>
         <select name="tipo_seguro" required>
            <option value="allin">Todo riesgo</option>
            <option value="deposito">Depósito</option>
         </select><br>

         <input type="submit" name="submit" value="Buscar ofertas">
      </form>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         require_once("../Negocio/ShopReglasNegocio.php");
         $shopBL = new ShopReglasNegocio();
         $datosCoches = $shopBL->obtenerCoches($_POST['tipo_vehiculo']);
         if (count($shopBL->obtenerCoches($_POST['tipo_vehiculo'])) > 0) {
            echo "
            <div id='contenedor'>
                    </div>
                    <div>
                        <table>
                            <thead>
                                 <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Capacidad</th>
                                    <th>Precio diario</th>
                                </tr>
                            </thead>
                            <tbody>";
         }

      }
      foreach ($datosCoches as $coches) {
         echo "
                <tr>
                    <td>" . $coches->getIDVehiculo() . "</td>
                    <td>" . $coches->getIDTipo_de_vehiculo() . "</td>
                    <td>" . $coches->getMarca() . "</td>
                    <td>" . $coches->getModelo() . "</td>
                    <td>" . $coches->getAnio() . "</td>
                    <td>" . $coches->getCapacidad() . " pax</td>
                    <td>" . $coches->getPrecio() . "</td>
                    <td>
                  <form method='POST' action='reserva.php'>
                     <input type='hidden' name='nombreUsuario' value='".$_SESSION['usuario'] ."'>
                     <input type='hidden' name='id_vehiculo' value='".$coches->getIDVehiculo() ."'>
                     <input type='hidden' name='fecha_inicio' value='".$_POST['fecha_inicio']."'>
                     <input type='hidden' name='fecha_fin' value='".$_POST['fecha_fin']."'>
                     <input type='hidden' name='costo_diario' value='".$coches->getPrecio()."'>
                     <input type='hidden' name='seguro' value='".$_POST['tipo_seguro']."'>
                     <input type='submit' name='submit' value='Reservar'>
                  </form>
</td>
                </tr>";
      }
      echo "</tbody>
                </table>
                    </div>
                </div>
            </div>";
      ?>


</html>
</header>
<!-- end header inner -->
<!-- end header -->
<!-- Our shop section -->
<div id="about" class="shop">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-5">
            <div class="shop_img">
               <figure><img src="../../images/shop_img.png" alt="#" /></figure>
            </div>
         </div>
         <div class="col-md-7 padding_right0">
            <div class="max_width">
               <div class="titlepage">
                  <h2>Best SunGlasses At Our shop</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                     et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                     aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                     cillum dolore</p>
                  <a class="read_more" href="#">Shop Now</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end Our shop section -->
<!--  footer -->
<footer>
   <div class="footer">
      <div class="container">
         <div class="row">
            <div class="col-md-8 offset-md-2">
               <ul class="location_icon">
                  <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> Location</li>
                  <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><br> +01 1234567890</li>
                  <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> demo@gmail.com</li>
               </ul>
            </div>
         </div>
      </div>
      <div class="copyright">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- end footer -->
<!-- Javascript files-->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/jquery-3.0.0.min.js"></script>
<!-- sidebar -->
<script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../../js/custom.js"></script>
</body>

</html>
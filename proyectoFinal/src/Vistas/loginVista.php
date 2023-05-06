<?php
    require ("../Negocio/usuarioReglasNegocio.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $usuarioBL = new UsuarioReglasNegocio();
        $perfil =  $usuarioBL->verificar($_POST['usuario'],$_POST['clave']);

        if($perfil==="usuario") {
            session_start();
            $_SESSION['usuario'] = $_POST['usuario'];
            header("Location: shop.php");
        }
        } else{
            $error = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../../css/loginVista.css">
</head>
<body>
    
    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h3>Login Here</h3>
        <label for="username">Username</label>
        <input type="text" placeholder="Usuario" id="username" name = "usuario">

        <label for="password">Password</label>
        <input type="password" placeholder="Contraseña" id="password" name="clave">

        <input id = "button" type = "submit">
    </form>
</body>
</html>
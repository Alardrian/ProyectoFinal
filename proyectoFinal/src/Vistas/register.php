<?php
    require ("../Negocio/usuarioReglasNegocio.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $usuarioBL = new UsuarioReglasNegocio();
        $perfil =  $usuarioBL->insertar($_POST['usuario'],$_POST['clave'],'usuario');
        $cliente = $usuarioBL->insertarCliente($_POST['nombre'],$_POST['email'],$_POST['birthdate'],$_POST['phone'],$_POST['address'],$_POST['tarjeta'],$_POST['caducidad'],$_POST['pin']);

        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Usuario:</label>
        <input type="text" name="usuario" required><br>

        <label>Contraseña:</label>
        <input type="password" name="clave" required><br>

        <label>Nombre completo:</label>
        <input type="text" name="nombre" required><br>

        <label>Correo Electrónico:</label>
        <input type="email" name="email" required><br>

        <label>Fecha de Nacimiento:</label>
        <input type="date" name="birthdate" required><br>

        <label>Número de Teléfono:</label>
        <input type="tel" name="phone" required><br>

        <label>Dirección:</label>
        <input type="text" name="address" required><br>

        <label>Tarjeta de credito:</label>
        <input type="text" name="tarjeta" required><br>

        <label>Caducidad tarjeta:</label>
        <input type="text" name="caducidad" required><br>

        <label>PIN tarjeta:</label>
        <input type="text" name="pin" required><br>

        <input type="submit" name="submit" value="Registrarse">
    </form>
</body>
</html>

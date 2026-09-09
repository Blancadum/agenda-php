<?php

/**
 * Pagina de bienvenida despues de iniciar sesion.
 */

//primera acción del script: inicia/reanuda la sesión
//y hace que el array $_SESSION[] quede disponible para este script
session_start();

//mostramos el identificador de la sesión
echo session_id();

echo '<hr>' . $_COOKIE["PHPSESSID"];

if (!isset($_SESSION["usuario"])) {
    //si previamente NO se asignó la clave "usuario", es porque no se ha iniciado sesión previamente
    //no se han rellenado los datos del formulario
    //y redirigimos a la página para hacer el login

    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
</head>

<body>

    <h1>¡Bienvenido!</h1>

    <p>Hola, <?php echo $_SESSION["usuario"]; ?> </p>

    <!-- enlace para poder hacer el cierre de sesión -->
    <a href="logout.php" title="Cierra la sesión">Cerrar sesión <img src=".\img\final.png" alt="Ícono de cierre de sesión"></a>

</body>

</html>
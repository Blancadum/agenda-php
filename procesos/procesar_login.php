<?php

/**
 * Procesa un inicio de sesion del formulario antiguo.
 */

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $password = $_POST["password"] ?? "";

    if ((strtolower($usuario) === "blanca" || $usuario === "admin") && $password === "1234") {
        $_SESSION["usuario"] = "Blanca";
        header("Location: ../pages/bienvenida.php");
        exit;
    } else {
        echo "<p>Usuario o contraseña incorrectos.</p>";
        echo '<p><a href="../pages/login.html">Volver</a></p>';
    }
}

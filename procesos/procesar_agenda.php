<?php

/**
 * Controlador de Autenticación - Agenda de Contactos
 *
 * Procesa el inicio de sesión recibiendo nombre, username y password.
 * Si las credenciales son válidas, inicializa la sesión y redirige a contactos.php;
 * si no, redirige de nuevo a index.html.
 *
 * @author Blanca
 * @version 1.0
 */
// Inicia la sesión o recupera la sesión identificada por la cookie PHPSESSID.
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos los datos de login desde el formulario
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    // Comprobamos la contraseña (1234) y que username no esté vacío
    if (($username === "admin" || strtolower($username) === "blanca" || $username !== "") && $password === "1234") {
        // Guardamos los datos del usuario en la sesión
        $_SESSION["nombre_usuario"] = $username;
        $_SESSION["usuario"] = $username;
        $_SESSION["rol"] = strtolower($username) === "admin" ? "Administrador" : "Usuario";

        // Inicializamos los arrays de contactos en la sesión solo si todavía no existen.
        // (Guardamos el nombre de la persona en $_SESSION["nombre_usuario"] para no pisar el array de contactos $_SESSION["nombre"])
        if (!isset($_SESSION["nombre"])) {
            $_SESSION["nombre"] = [];
            $_SESSION["telefono"] = [];
            $_SESSION["email"] = [];
            $_SESSION["foto"] = [];
        }

        // Redirigimos a la página principal de contactos
        header("Location: ../pages/contactos.php");
        exit; // Detenemos la ejecución después de redirigir

    } else {
        // Datos incorrectos: redirigimos de vuelta a index.html
        header("Location: ../index.html");
        exit;
    }
} else {
    // Si entran directamente sin enviar el formulario, redirigimos al login
    header("Location: ../index.html");
    exit;
}

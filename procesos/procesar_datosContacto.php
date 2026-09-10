<?php

/**
 * Procesamiento de Contactos - Agenda de Contactos
 *
 * Recibe por POST los datos de un nuevo contacto (nombre, teléfono y email)
 * y los añade a los arrays paralelos de sesión ($_SESSION['nombre'][], etc.).
 *
 * @author Blanca
 * @version 1.0
 */

// Seguimos con la sesión actual
session_start();

// Control de seguridad: si no ha iniciado sesión, redirigimos al login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos y limpiamos los datos enviados desde el formulario
    $nombre = trim($_POST["nombre"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $email = trim($_POST["email"] ?? "");

    // Nos aseguramos de que los arrays existan en la sesión
    if (!isset($_SESSION["nombre"])) {
        $_SESSION["nombre"] = [];
        $_SESSION["telefono"] = [];
        $_SESSION["email"] = [];
        $_SESSION["foto"] = [];
    }
    if (!isset($_SESSION["foto"])) {
        $_SESSION["foto"] = [];
    }

    // Solo guardamos si al menos el nombre no está vacío
    if ($nombre !== "") {
        $_SESSION["nombre"][] = $nombre;
        $_SESSION["telefono"][] = $telefono;
        $_SESSION["email"][] = $email;
        $_SESSION["foto"][] = "../img/avatar.svg";
    }

    // Una vez agregado el contacto, volvemos a la lista de contactos
    header("Location: ../pages/contactos.php");
    exit; // Detenemos la ejecución
} else {
    // Si acceden por GET, redirigimos directamente a contactos.php
    header("Location: ../pages/contactos.php");
    exit;
}

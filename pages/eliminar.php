<?php

/**
 * Módulo de Eliminación - Agenda de Contactos
 *
 * Elimina un contacto de la sesión a partir de su ID utilizando array_splice()
 * para preservar los índices numéricos consecutivos (0, 1, 2...).
 *
 * @author Blanca
 * @version 1.0
 */

// Continuamos con la sesión
session_start();

require_once "../includes/funciones.php";

// Control de seguridad
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.html");
    exit;
}

// Nos aseguramos de que los arrays existan
if (!isset($_SESSION["nombre"])) {
    $_SESSION["nombre"] = [];
    $_SESSION["telefono"] = [];
    $_SESSION["email"] = [];
    $_SESSION["foto"] = [];
}
if (!isset($_SESSION["foto"])) {
    $_SESSION["foto"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_a_eliminar = trim($_POST["nombre"] ?? "");
    $posicion = buscarContacto($nombre_a_eliminar);

    if ($posicion !== -1) {
        eliminarContacto($posicion);
    }

    header("Location: contactos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Contacto - Agenda</title>
    <link rel="stylesheet" href="../css/estilosAgenda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php include_once "../includes/header.php"; ?>
    <?php include_once "../includes/nav.php"; ?>
    <!-- include_once porque no quiero que se incluya varias veces porque puede dar error -->

    <main>
        <section>
            <h2>Eliminar contacto</h2>

            <!-- Formulario para eliminar por nombre -->
            <form method="post">
                <label for="nombre">Nombre del contacto a eliminar:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre exacto..." required><br><br>
                <button type="submit">Eliminar</button>
            </form>
        </section>
    </main>

    <?php include_once "../includes/footer.php"; ?>
</body>

</html>
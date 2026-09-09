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

// Control de seguridad
if (!isset($_SESSION["usuario"])) {
    header("Location: agenda.html");
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

    for ($i = 0; $i < count($_SESSION["nombre"]); $i++) {
        if ($_SESSION["nombre"][$i] === $nombre_a_eliminar) {
            array_splice($_SESSION["nombre"], $i, 1);
            array_splice($_SESSION["telefono"], $i, 1);
            array_splice($_SESSION["email"], $i, 1);
            array_splice($_SESSION["foto"], $i, 1);
            break;
        }
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
    <link rel="stylesheet" href="css/estilosAgenda.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <main>
        <section>
            <h2>Eliminar contacto</h2>

            <!-- Formulario para eliminar por nombre -->
            <form method="post">
                <label for="nombre">Nombre del contacto a eliminar:</label><br>
                <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre exacto..." required><br><br>
                <button type="submit">Eliminar</button>
            </form>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>
</body>

</html>
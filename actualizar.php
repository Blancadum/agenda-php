<?php

/**
 * Busca un contacto por nombre y prepara su edicion.
 *
 * Guarda en la sesion la posicion del contacto y redirige a editar.php.
 */

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: agenda.html");
    exit;
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_buscado = trim($_POST["nombre"] ?? "");

    for ($i = 0; $i < count($_SESSION["nombre"]); $i++) {
        if ($_SESSION["nombre"][$i] === $nombre_buscado) {
            $_SESSION["contacto_actual"] = $i;
            header("Location: editar.php");
            exit;
        }
    }

    $mensaje = "Contacto no encontrado";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar contacto</title>
    <link rel="stylesheet" href="css/estilosAgenda.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <main>
        <section>
            <h2>Actualizar contacto</h2>

            <?php if ($mensaje !== ""): ?>
                <p><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <form method="post">
                <label for="nombre">Nombre del contacto:</label><br>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <button type="submit">Buscar</button>
            </form>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>
</body>

</html>
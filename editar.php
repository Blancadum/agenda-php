<?php

/**
 * Muestra el formulario para editar un contacto y guarda sus cambios.
 */

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: agenda.html");
    exit;
}

if (!isset($_SESSION["contacto_actual"])) {
    header("Location: actualizar.php");
    exit;
}

$id_contacto = $_SESSION["contacto_actual"];

if (!isset($_SESSION["nombre"][$id_contacto])) {
    header("Location: actualizar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cambiado = trim($_POST["nombre"] ?? "");
    $telefono_cambiado = trim($_POST["telefono"] ?? "");
    $email_cambiado = trim($_POST["email"] ?? "");

    if ($nombre_cambiado !== "") {
        $_SESSION["nombre"][$id_contacto] = $nombre_cambiado;
        $_SESSION["telefono"][$id_contacto] = $telefono_cambiado;
        $_SESSION["email"][$id_contacto] = $email_cambiado;
    }

    unset($_SESSION["contacto_actual"]);
    header("Location: contactos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar contacto</title>
    <link rel="stylesheet" href="css/estilosAgenda.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <main>
        <section>
            <h2>Editar contacto</h2>

            <form method="post">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION["nombre"][$id_contacto]); ?>" required><br>

                <label for="telefono">Teléfono:</label><br>
                <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($_SESSION["telefono"][$id_contacto]); ?>" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION["email"][$id_contacto]); ?>" required><br><br>

                <button type="submit">Guardar cambios</button>
                <a href="contactos.php">Cancelar</a>
            </form>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>
</body>

</html>
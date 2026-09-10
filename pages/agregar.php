<?php

/**
 * Formulario de Alta - Agenda de Contactos
 *
 * Presenta el formulario para capturar los datos de un nuevo contacto
 * (nombre, teléfono y correo electrónico) y enviarlos a procesar_datosContacto.php.
 *
 * @author Blanca
 * @version 1.0
 */

// Continuamos con la sesión actual
session_start();

// Control de seguridad: si no ha iniciado sesión, redirigimos al login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Contacto - Agenda</title>
    <!-- Enlazamos la hoja de estilos CSS -->
    <link rel="stylesheet" href="../css/estilosAgenda.css">
</head>

<body>
    <?php include_once "../includes/header.php"; ?>
    <?php include_once "../includes/nav.php"; ?>

    <main>
        <section>
            <h2>Agregar nuevo contacto</h2>

            <!-- Formulario que envía los tres datos a procesar_datosContacto.php -->
            <form method="post" action="../procesos/procesar_datosContacto.php">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_GET['nombre'] ?? ''); ?>" placeholder="Nombre completo" required><br>

                <label for="telefono">Teléfono:</label><br>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej: 600123456" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="Ej: contacto@ejemplo.com" required><br><br>

                <!-- Botones de acción -->
                <?php echo '<button type="submit">Guardar contacto</button>' ?>
                <a href="contactos.php" style="margin-left: 15px; color: #176b87; text-decoration: none;">Cancelar</a>
            </form>
        </section>
    </main>

    <?php include_once "../includes/footer.php"; ?>

</body>

</html>
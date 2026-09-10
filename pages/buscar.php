<?php

/**
 * Módulo de Búsqueda - Agenda de Contactos
 *
 * Permite buscar un contacto existente por su nombre dentro de los arrays
 * almacenados en la sesión ($_SESSION['nombre']).
 *
 * @author Blanca
 * @version 1.0
 */

// Continuamos con la sesión
session_start();

require_once "../includes/funciones.php"; // Incluimos todas las funciones

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
// Sincronizamos las fotos con los contactos existentes
while (count($_SESSION["foto"]) < count($_SESSION["nombre"])) {
    $_SESSION["foto"][] = "img/avatar.svg";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Contacto - Agenda</title>
    <link rel="stylesheet" href="../css/estilosAgenda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php include_once "../includes/header.php"; ?>
    <?php include_once "../includes/nav.php"; ?>

    <main>
        <section>
            <h2>Buscar contacto por nombre</h2>

            <!-- Formulario de búsqueda -->
            <!-- El método get es para buscar información porque lo que estoy haciendo es buscar un contacto, no añadir info -->
            <form method="get" action="buscar.php">
                <label for="nombreBuscado">Nombre a buscar:</label>
                <input type="text" id="nombreBuscado" name="nombreBuscado" value="<?php echo htmlspecialchars($_GET['nombreBuscado'] ?? $_GET['nombre'] ?? ''); ?>" placeholder="Escribe el nombre a buscar..." required><br><br>
                <button type="submit">Buscar contacto</button>
                <?php if (isset($_GET["nombreBuscado"]) || isset($_GET["nombre"])): ?>
                    <a href="buscar.php" style="margin-left: 15px; color: #176b87; font-weight: bold;">Limpiar</a>
                <?php endif; ?>
            </form>

            <?php
            /** @var string $nombreBuscado Nombre introducido por el usuario en el formulario */
            $nombreBuscado = trim($_GET["nombreBuscado"] ?? $_GET["nombre"] ?? "");

            // Si el usuario ha enviado un nombre para buscar
            if ($nombreBuscado !== "") {
                $indiceContacto = buscarContacto($nombreBuscado);

                if ($indiceContacto !== -1) {
                    mostrarContacto($indiceContacto);
                    echo "<p>";
                    echo '<a href="actualizar.php" style="color: #176b87; font-weight: bold; margin-right: 20px;">&#9998; Editar contacto</a>';
                    echo "</p>";
                } else {
                    echo "<article>";
                    echo "<p>No se encontró ningún contacto con el nombre: <strong>" . htmlspecialchars($nombreBuscado) . "</strong>.</p>";
                    echo "<p>¿Deseas agregarlo a la agenda?</p>";
                    echo '<p><a href="agregar.php?nombre=' . urlencode($nombreBuscado) . '" style="background-color: #f28c28; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; display: inline-block;">&plus; Crear contacto &quot;' . htmlspecialchars($nombreBuscado) . '&quot;</a></p>';
                    echo "</article>";
                }
            }
            ?>
        </section>
    </main>

    <?php include_once "../includes/footer.php"; ?>
</body>

</html>
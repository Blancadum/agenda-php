<?php

/**
 * Vista Principal - Agenda de Contactos
 *
 * Muestra el listado de todos los contactos guardados en la sesión actual
 * organizados en tarjetas semánticas HTML5 (<article>).
 *
 * @author Blanca
 * @version 1.0
 */

// Continuamos la sesión existente
session_start();

// Control de seguridad: si el usuario no ha iniciado sesión, lo enviamos al login
if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
    exit;
}

// Nos aseguramos de que los arrays existan en la sesión para evitar errores con count()
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

// Calculamos cuántos contactos tenemos guardados
$totalContactos = count($_SESSION["nombre"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agenda de contactos</title>
    <!-- Enlazamos la hoja de estilos CSS -->
    <link rel="stylesheet" href="css/estilosAgenda.css">
</head>

<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/nav.php"; ?>

    <main>
        <section>
            <h2>Mis contactos - Total: <?php echo $totalContactos; ?></h2>

            <?php if ($totalContactos === 0): ?>
                <!-- Mensaje cuando la agenda está vacía -->
                <article>
                    <p>No tienes ningún contacto guardado todavía.</p>
                    <p><a href="agregar.php">&plus; Haz clic aquí para agregar tu primer contacto</a></p>
                </article>
            <?php else: ?>
                <!-- Grid de contactos con fotos y tarjetitas -->
                <div class="grid-contactos">
                    <?php for ($i = 0; $i < $totalContactos; $i++): ?>
                        <?php $fotoContacto = !empty($_SESSION["foto"][$i]) ? $_SESSION["foto"][$i] : "img/avatar.svg"; ?>
                        <article class="tarjeta-contacto">
                            <div class="tarjeta-avatar">
                                <img src="<?php echo htmlspecialchars($fotoContacto); ?>" alt="Foto de perfil de <?php echo htmlspecialchars($_SESSION["nombre"][$i]); ?>" class="avatar-foto">
                            </div>

                            <div class="tarjeta-info">
                                <h2><?php echo htmlspecialchars($_SESSION["nombre"][$i]); ?></h2>
                                <p><strong>📞 Teléfono:</strong><br><?php echo htmlspecialchars($_SESSION["telefono"][$i]); ?></p>
                                <p><strong>✉ Email:</strong><br><?php echo htmlspecialchars($_SESSION["email"][$i]); ?></p>
                            </div>

                            <div class="tarjeta-acciones">
                                <a href="actualizar.php" class="btn-editar">
                                    &#9998; Actualizar por nombre
                                </a>
                                <a href="eliminar.php?id=<?php echo $i; ?>"
                                    onclick="return confirm('¿Seguro que deseas eliminar este contacto?');"
                                    class="btn-eliminar">
                                    &times; Eliminar
                                </a>
                            </div>
                        </article>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php include_once "includes/footer.php"; ?>
</body>

</html>
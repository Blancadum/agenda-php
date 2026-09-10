<?php

/**
 * Busca y actualiza contactos en un solo archivo.
 */

session_start();

require_once "../includes/funciones.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.html");
    exit;
}

$_SESSION["nombre"] = $_SESSION["nombre"] ?? [];
$_SESSION["telefono"] = $_SESSION["telefono"] ?? [];
$_SESSION["email"] = $_SESSION["email"] ?? [];

$contacto_actual = -1;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"] ?? "buscar";

    if ($accion === "buscar") {
        $nombre_buscado = trim($_POST["nombre"] ?? "");

        $contacto_actual = buscarContacto($nombre_buscado);

        if ($contacto_actual === -1) {
            $mensaje = "Contacto no encontrado";
        }
    }

    if ($accion === "actualizar") {
        $contacto_actual = (int)($_POST["contacto_actual"] ?? -1);
        $nombre_cambiado = trim($_POST["nombre"] ?? "");
        $telefono_cambiado = trim($_POST["telefono"] ?? "");
        $email_cambiado = trim($_POST["email"] ?? "");

        if (actualizarContacto($contacto_actual, $nombre_cambiado, $telefono_cambiado, $email_cambiado)) {
            header("Location: contactos.php");
            exit;
        }

        $mensaje = "No se han podido guardar los cambios";
        $contacto_actual = -1;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar contacto</title>
    <link rel="stylesheet" href="../css/estilosAgenda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php include_once "../includes/header.php"; ?>
    <?php include_once "../includes/nav.php"; ?>

    <main>
        <section>
            <h2>Actualizar contacto</h2>

            <?php if ($mensaje !== ""): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endif; ?>

            <?php if ($contacto_actual === -1): ?>
                <form method="post">
                    <label for="nombre_buscado">Nombre del contacto:</label>
                    <input type="text" id="nombre_buscado" name="nombre" required><br><br>
                    <input type="hidden" name="accion" value="buscar">
                    <button type="submit">Buscar</button>
                </form>
            <?php else: ?>
                <form method="post">
                    <h3>Editar contacto</h3>
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="contacto_actual" value="<?php echo $contacto_actual; ?>">

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION["nombre"][$contacto_actual]); ?>" required><br>

                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($_SESSION["telefono"][$contacto_actual]); ?>" required><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION["email"][$contacto_actual]); ?>" required><br><br>

                    <button type="submit">Guardar cambios</button>
                    <a href="actualizar.php">Cancelar</a>
                </form>
            <?php endif; ?>
        </section>
    </main>

    <?php include_once "../includes/footer.php"; ?>
</body>

</html>
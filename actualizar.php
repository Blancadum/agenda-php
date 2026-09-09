<?php

/**
 * Busca y actualiza contactos en un solo archivo.
 */

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
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

        for ($i = 0; $i < count($_SESSION["nombre"]); $i++) {
            if ($_SESSION["nombre"][$i] === $nombre_buscado) {
                $contacto_actual = $i;
                break;
            }
        }

        if ($contacto_actual === -1) {
            $mensaje = "Contacto no encontrado";
        }
    }

    if ($accion === "actualizar") {
        $contacto_actual = (int)($_POST["contacto_actual"] ?? -1);
        $nombre_cambiado = trim($_POST["nombre"] ?? "");
        $telefono_cambiado = trim($_POST["telefono"] ?? "");
        $email_cambiado = trim($_POST["email"] ?? "");

        if (isset($_SESSION["nombre"][$contacto_actual]) && $nombre_cambiado !== "") {
            $_SESSION["nombre"][$contacto_actual] = $nombre_cambiado;
            $_SESSION["telefono"][$contacto_actual] = $telefono_cambiado;
            $_SESSION["email"][$contacto_actual] = $email_cambiado;

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
    <link rel="stylesheet" href="css/estilosAgenda.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <?php include "includes/nav.php"; ?>

    <main>
        <section>
            <h2>Actualizar contacto</h2>

            <?php if ($mensaje !== ""): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endif; ?>

            <?php if ($contacto_actual === -1): ?>
                <form method="post">
                    <label for="nombre_buscado">Nombre del contacto:</label><br>
                    <input type="text" id="nombre_buscado" name="nombre" required><br><br>
                    <input type="hidden" name="accion" value="buscar">
                    <button type="submit">Buscar</button>
                </form>
            <?php else: ?>
                <form method="post">
                    <h3>Editar contacto</h3>
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="contacto_actual" value="<?php echo $contacto_actual; ?>">

                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION["nombre"][$contacto_actual]); ?>" required><br>

                    <label for="telefono">Teléfono:</label><br>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($_SESSION["telefono"][$contacto_actual]); ?>" required><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION["email"][$contacto_actual]); ?>" required><br><br>

                    <button type="submit">Guardar cambios</button>
                    <a href="actualizar.php">Cancelar</a>
                </form>
            <?php endif; ?>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>
</body>

</html>
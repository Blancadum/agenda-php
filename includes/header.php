<?php

/**
 * Cabecera comun de las paginas de la agenda.
 */
?>
<header>
    <h1>Agenda de contactos</h1>
    <p>
        <?php echo htmlspecialchars($_SESSION["nombre_usuario"] ?? "Blanca"); ?>
        <?php
        // Mostramos el rol solo si existe en la sesión.
        if (!empty($_SESSION["rol"])): ?>
            (<?php echo htmlspecialchars($_SESSION["rol"]); ?>)
        <?php endif; // endif marca el final de esta condición. 
        ?>
    </p>
</header>
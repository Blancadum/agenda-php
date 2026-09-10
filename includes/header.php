<?php

/**
 * Cabecera comun de las paginas de la agenda. Se aplica a todo menos a index.html y logout.php, porque no necesitan cabecera.
 */
?>
<header>
    <h1><i class="fas fa-address-book"></i> Agenda de contactos</h1>
    <p>
        <?php echo htmlspecialchars($_SESSION["nombre_usuario"] ?? "Blanca"); ?>
        <?php
        // Mostramos el rol solo si existe en la sesión.
        if (!empty($_SESSION["rol"])): ?>
            (<?php echo htmlspecialchars($_SESSION["rol"]); ?>)
        <?php endif; // endif marca el final de esta condición. 
        ?>
        <a class="logout-icon" href="logout.php" title="Cerrar sesión" aria-label="Cerrar sesión">
            <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
        </a>
    </p>
</header>
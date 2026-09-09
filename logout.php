<?php

/**
 * Cierra la sesion actual y vuelve a la pantalla de acceso.
 */

// Recuperamos la sesión para poder cerrarla.
session_start();

/* Vaciamos todas las variables de sesión */
$_SESSION = [];

// Eliminamos los datos de la sesión en el servidor.
session_destroy();

// Redirigimos a la pantalla de acceso de la agenda
header("Location: index.html");
exit;

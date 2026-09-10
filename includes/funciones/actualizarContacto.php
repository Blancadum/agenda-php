<?php

/**
 * Actualiza los datos de un contacto guardado en la sesión.
 *
 * @param int $indice Índice del contacto que se actualizará.
 * @param string $nombre Nuevo nombre del contacto.
 * @param string $telefono Nuevo teléfono del contacto.
 * @param string $email Nuevo email del contacto.
 * @return bool True si se actualizó; false si el índice o el nombre no son válidos.
 */
function actualizarContacto(int $indice, string $nombre, string $telefono, string $email): bool
{
    if ($nombre === "" || !isset($_SESSION["nombre"][$indice])) {
        return false;
    }

    $_SESSION["nombre"][$indice] = $nombre;
    $_SESSION["telefono"][$indice] = $telefono;
    $_SESSION["email"][$indice] = $email;

    return true;
}

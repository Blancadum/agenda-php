<?php

/**
 * Busca un contacto por su nombre en la sesión actual.
 *
 * @param string $nombre Nombre exacto del contacto.
 * @return int Índice del contacto o -1 si no existe.
 */
function buscarContacto($nombre)
{
    for ($i = 0; $i < count($_SESSION["nombre"]); $i++) {
        if ($_SESSION["nombre"][$i] == $nombre) {
            return $i;
        }
    }

    return -1;
}

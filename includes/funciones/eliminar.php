<?php

/**
 * Elimina un contacto por su nombre de la sesión actual.
 *
 * @param int $posicion Índice del contacto que se eliminará.
 * @return void
 * 
 */

function eliminarContacto($posicion)
{
    array_splice($_SESSION["nombre"], $posicion, 1);
    array_splice($_SESSION["telefono"], $posicion, 1);
    array_splice($_SESSION["email"], $posicion, 1);
    array_splice($_SESSION["foto"], $posicion, 1);
}

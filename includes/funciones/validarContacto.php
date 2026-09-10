<?php

// Comprueba que los datos del contacto no estén vacíos.
function validarContacto($nombre, $telefono, $email)
{
    $nombre = trim($nombre);
    $telefono = trim($telefono);
    $email = trim($email);

    if ($nombre === "" || $telefono === "" || $email === "") {
        return false;
    }

    return true;
}

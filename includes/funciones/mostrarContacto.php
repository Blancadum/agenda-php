<?php

function mostrarContacto($posicion)
{
    echo '<article class="tarjeta">';
    echo '<div class="tarjeta-info">';
    echo '<h2>' . htmlspecialchars($_SESSION["nombre"][$posicion]) . '</h2>';
    echo '<p><strong>Teléfono:</strong><br>' . htmlspecialchars($_SESSION["telefono"][$posicion]) . '</p>';
    echo '<p><strong>Email:</strong><br>' . htmlspecialchars($_SESSION["email"][$posicion]) . '</p>';
    echo '</div>';
    echo '</article>';
}
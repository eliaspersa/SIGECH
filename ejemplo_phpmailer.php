<?php

require_once __DIR__ . '/php_classes/cliente.php';
require_once __DIR__ . '/php_classes/solicitud.php';

// Simular datos reales
$cliente = new Cliente("Luis", "Hernández", "Rojas", "correo@example.com");
$solicitud = new Solicitud($cliente, 700000.00);

$idUsuarioCliente = 6;

// Guardar en BD
if ($solicitud->guardarEnBD($idUsuarioCliente)) {

    $solicitud->notificarRegistro();

    echo "Solicitud guardada en la base y correo enviado.";
} else {
    echo "Error al guardar solicitud.";
}

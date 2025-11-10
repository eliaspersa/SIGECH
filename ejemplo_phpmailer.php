<?php

require_once __DIR__ . '/php_classes/cliente.php';
require_once __DIR__ . '/php_classes/solicitud.php';

// Crear cliente con el constructor desde cliente.php. Esto es así para cumplir con el ejemplo de implmentación
$cliente = new Cliente(
    "Juan",
    "Pérez",
    "Ramírez",
    "correo@example.com"
);

// Crear solicitud
$solicitud = new Solicitud($cliente, 850000.00);

// Enviar notificación
$solicitud->notificarRegistro();

echo "Solicitud registrada y notificación generada.";
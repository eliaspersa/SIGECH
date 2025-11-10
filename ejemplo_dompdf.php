<?php

require_once __DIR__ . '/php_classes/cliente.php';
require_once __DIR__ . '/php_classes/solicitud.php';

// Crear cliente de prueba
$cliente = new Cliente(
    "María",
    "López",
    "García",
    "correo@example.com"
);

// Crear solicitud
$solicitud = new Solicitud($cliente, 650000.00);

// Generar PDF
$solicitud->generarComprobantePDF();

echo "Comprobante en PDF generado correctamente.";

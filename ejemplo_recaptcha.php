<?php

require_once __DIR__ . '/php_classes/cliente.php';
require_once __DIR__ . '/php_classes/solicitud.php';
require_once __DIR__ . '/php_classes/captchaValidator.php';

// Token simulado (en producción lo envía el formulario)
$token = "TOKEN_RECAPTCHA_DE_EJEMPLO";

// Crear cliente
$cliente = new Cliente("Luis", "Hernández", "Rojas", "correo@example.com");

// Crear solicitud
$solicitud = new Solicitud($cliente, 700000.00);

// Validar CAPTCHA antes de registrar
if ($solicitud->validarAntesDeRegistrar($token)) {
    echo "Captcha válido. Se puede proceder con el registro.";
} else {
    echo "Captcha inválido. Bloqueando registro.";
}

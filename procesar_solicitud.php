<?php

require_once __DIR__ . '/php_classes/cliente.php';
require_once __DIR__ . '/php_classes/solicitud.php';
require_once __DIR__ . '/php_classes/CaptchaValidator.php';

$nombre  = $_POST['nombre'];
$apP     = $_POST['apellido_paterno'];
$apM     = $_POST['apellido_materno'];
$correo  = $_POST['correo'];
$monto   = floatval($_POST['monto']);
$ingreso = floatval($_POST['ingreso']);

$cliente = new Cliente($nombre, $apP, $apM, $correo);

$solicitud = new Solicitud($cliente, $monto, $ingreso);

// Usuario dueño de esta solicitud (se haría login después)
$idUsuarioCliente = 6;

$tokenCaptcha = $_POST['g-recaptcha-response'];

if (!CaptchaValidator::validarCaptcha($tokenCaptcha)) {
    die("Error: CAPTCHA inválido. No se puede continuar.");
}

// ----------------------------
// USAMOS MÉTODOS OOP
// ----------------------------
if ($solicitud->guardarEnBD($idUsuarioCliente)) {
    
    $solicitud->notificarRegistro();
    $solicitud->generarComprobantePDF();

    echo "<h2>Solicitud registrada correctamente</h2>";
    echo "<p>Se ha registrado la solicitud en la base de datos.</p>";
    echo "<p>Se envió correo de notificación.</p>";
    echo "<p>Se generó el PDF de comprobante.</p>";

} else {

    echo "<h2>Error al registrar la solicitud</h2>";

}

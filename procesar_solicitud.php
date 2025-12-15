<?php

require_once __DIR__ . '/php_classes/cliente.php';
require_once __DIR__ . '/php_classes/solicitud.php';
require_once __DIR__ . '/php_classes/CaptchaValidator.php';

$nombre  = $_POST['nombre'] ?? '';
$apP     = $_POST['apellido_paterno'] ?? '';
$apM     = $_POST['apellido_materno'] ?? '';
$correo  = $_POST['correo'] ?? '';
$monto   = floatval($_POST['monto'] ?? 0);
$ingreso = floatval($_POST['ingreso'] ?? 0);

$cliente = new Cliente($nombre, $apP, $apM, $correo);
$solicitud = new Solicitud($cliente, $monto, $ingreso);

// Usuario dueño de esta solicitud (se haría login después)
$idUsuarioCliente = 6;

$tokenCaptcha = $_POST['g-recaptcha-response'] ?? '';

$ok = false;
$titulo = "";
$mensaje = "";
$detalles = [];

if (!CaptchaValidator::validarCaptcha($tokenCaptcha)) {
    $titulo = "CAPTCHA inválido";
    $mensaje = "No se puede continuar porque la verificación anti-bots falló.";
    $detalles[] = "Verifica que marcaste el reCAPTCHA.";
    $detalles[] = "Intenta de nuevo desde el formulario.";
} else {
    if ($solicitud->guardarEnBD($idUsuarioCliente)) {
        $solicitud->notificarRegistro();
        $solicitud->generarComprobantePDF();

        $ok = true;
        $titulo = "Solicitud registrada correctamente";
        $mensaje = "La solicitud se registró en la base de datos y se ejecutaron las acciones de notificación y comprobante.";
        $detalles[] = "Correo de notificación: enviado (PHPMailer).";
        $detalles[] = "Comprobante PDF: generado.";
    } else {
        $titulo = "Error al registrar la solicitud";
        $mensaje = "Ocurrió un problema al guardar la solicitud en la base de datos.";
        $detalles[] = "Revisa la conexión a BD y los logs.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $titulo; ?> - SIGECH</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand sigech-brand" href="registro_solicitud.php">SIGECH</a>
  </div>
</nav>

<div class="container mt-4" style="max-width: 980px;">
  <div class="card shadow sigech-card">
    <div class="card-header <?php echo $ok ? 'bg-success' : 'bg-danger'; ?> text-white">
      <h3 class="mb-0 sigech-title">
        <?php echo $ok ? '<i class="bi bi-check-circle"></i>' : '<i class="bi bi-x-circle"></i>'; ?>
        <?php echo htmlspecialchars($titulo); ?>
      </h3>
    </div>

    <div class="card-body">
      <p class="mb-3"><?php echo htmlspecialchars($mensaje); ?></p>

      <?php if (!empty($detalles)): ?>
        <ul class="mb-4">
          <?php foreach ($detalles as $d): ?>
            <li><?php echo htmlspecialchars($d); ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-outline-secondary" href="registro_solicitud.php">
          <i class="bi bi-arrow-left"></i> Volver al formulario
        </a>

        <?php if ($ok): ?>
          <a class="btn btn-primary" href="registro_solicitud.php">
            <i class="bi bi-plus-circle"></i> Registrar otra solicitud
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <footer class="py-4 mt-4">
    <div class="container text-center text-muted sigech-footer">
      SIGECH · Iteración 1 · Resultado del registro (PHP + HTML5 + CSS + Bootstrap)
    </div>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

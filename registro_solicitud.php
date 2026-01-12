<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Solicitud - SIGECH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow sigech-card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 sigech-title">Registro de Solicitud</h3>
        </div>

        <div class="card-body">

            <form id="formSolicitud" action="procesar_solicitud.php" method="POST" class="row g-3 needs-validation" novalidate>

            <div id="msgBox" class="col-12"></div>

            <div class="col-md-4">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
                <div class="invalid-feedback">Captura tu nombre.</div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Apellido paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" required>
                <div class="invalid-feedback">Captura tu apellido paterno.</div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Apellido materno</label>
                <input type="text" name="apellido_materno" class="form-control" required>
                <div class="invalid-feedback">Captura tu apellido materno.</div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" required>
                <div class="invalid-feedback">Escribe un correo válido.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Monto solicitado</label>
                <input type="number" name="monto" class="form-control" min="1" step="0.01" required>
                <div class="invalid-feedback">Captura un monto válido.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Ingreso mensual</label>
                <input type="number" name="ingreso" class="form-control" min="1" step="0.01" required>
                <div class="invalid-feedback">Captura un ingreso válido.</div>
            </div>

            <div class="col-12">
                <div class="g-recaptcha" data-sitekey="6LfbRhYsAAAAAP2ei-6D0pPxJ_poA9oDV5fnr7gi"></div>
                <div class="form-text">Verificación anti-bots obligatoria.</div>
            </div>

            <div class="col-12 text-end">
                <button id="btnEnviar" class="btn btn-success" type="submit">
                <span id="btnText">Enviar Solicitud</span>
                <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>

            </form>


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/registro_solicitud.js"></script>
</body>
</html>
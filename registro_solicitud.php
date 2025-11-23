<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Solicitud - SIGECH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Registro de Solicitud</h3>
        </div>

        <div class="card-body">

            <form action="procesar_solicitud.php" method="POST" class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Apellido paterno</label>
                    <input type="text" name="apellido_paterno" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Apellido materno</label>
                    <input type="text" name="apellido_materno" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Monto solicitado</label>
                    <input type="number" name="monto" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Ingreso mensual</label>
                    <input type="number" name="ingreso" class="form-control" required>
                </div>

                <div class="col-12">
                    <div class="g-recaptcha" data-sitekey="6LfbRhYsAAAAAP2ei-6D0pPxJ_poA9oDV5fnr7gi"></div>
                </div>

                <div class="col-12 text-end">
                    <button class="btn btn-success">Enviar Solicitud</button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
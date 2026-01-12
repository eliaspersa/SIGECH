<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Solicitudes - SIGECH (Interno)</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">SIGECH</a>
    <span class="navbar-text text-white">Panel interno · Solicitudes</span>
  </div>
</nav>

<div class="container-fluid mt-4">
  <div class="row g-3">

    <!-- Lista -->
    <div class="col-12 col-lg-7">
      <div class="card shadow">
        <div class="card-header d-flex align-items-center justify-content-between">
          <strong>Solicitudes registradas</strong>
          <button id="btnRecargar" class="btn btn-outline-primary btn-sm">Recargar</button>
        </div>

        <div class="card-body">
          <div class="table-responsive" style="max-height: 70vh; overflow:auto;">
            <table class="table table-hover table-sm align-middle mb-0" id="tblSolicitudes">
              <thead class="table-light sticky-top">
                <tr>
                  <th>ID</th>
                  <th>Folio</th>
                  <th>Estatus</th>
                  <th class="text-end">Monto</th>
                  <th class="text-end">Ingreso</th>
                  <th>Creado</th>
                </tr>
              </thead>
              <tbody>
                <tr><td colspan="6" class="text-muted">Cargando...</td></tr>
              </tbody>
            </table>
          </div>
          <div class="form-text mt-2">Haz clic en una fila para ver el detalle.</div>
        </div>
      </div>
    </div>

    <!-- Detalle -->
    <div class="col-12 col-lg-5">
      <div class="card shadow">
        <div class="card-header">
          <strong>Detalle de la solicitud</strong>
        </div>
        <div class="card-body" id="detalleBox">
          <div class="text-muted">Selecciona una solicitud para ver sus datos.</div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/solicitudes_admin.js"></script>
</body>
</html>

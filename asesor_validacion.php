<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Validación de Solicitud (Asesor) - SIGECH</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand sigech-brand" href="#">SIGECH</a>
    <span class="navbar-text text-white opacity-75">
      Módulo Asesor (maquetación)
    </span>
  </div>
</nav>

<div class="container mt-4" style="max-width: 1100px;">

  <!-- Encabezado -->
  <div class="card shadow sigech-card mb-3">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div>
        <h3 class="mb-1 sigech-title">Validación de Solicitud</h3>
        <div class="text-muted">Folio: <strong>SOL-00123</strong> · Estatus: <span class="badge text-bg-warning">EN REVISIÓN</span></div>
      </div>

      <div class="d-flex gap-2">
        <a class="btn btn-outline-secondary" href="lista_solicitudes.php">
          <i class="bi bi-arrow-left"></i> Volver a Solicitudes
        </a>
        <button class="btn btn-outline-primary" type="button">
          <i class="bi bi-printer"></i> Imprimir / PDF
        </button>
      </div>
    </div>
  </div>

  <div class="row g-3">

    <!-- Datos del solicitante -->
    <div class="col-lg-6">
      <div class="card shadow sigech-card h-100">
        <div class="card-header bg-white">
          <h5 class="mb-0 sigech-title"><i class="bi bi-person-vcard"></i> Datos del solicitante</h5>
        </div>

        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="text-muted small">Nombre</div>
              <div class="fw-semibold">María López García</div>
            </div>
            <div class="col-md-6">
              <div class="text-muted small">Correo</div>
              <div class="fw-semibold">maria@correo.com</div>
            </div>

            <div class="col-md-6">
              <div class="text-muted small">Teléfono</div>
              <div class="fw-semibold">55 0000 0000</div>
            </div>
            <div class="col-md-6">
              <div class="text-muted small">CURP</div>
              <div class="fw-semibold">LOPG900101HDFXXX00</div>
            </div>

            <div class="col-12">
              <div class="alert alert-secondary mb-0">
                <strong>Nota:</strong> Pantalla estática para la actividad. En el sistema final estos datos provienen de BD.
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Datos del crédito -->
    <div class="col-lg-6">
      <div class="card shadow sigech-card h-100">
        <div class="card-header bg-white">
          <h5 class="mb-0 sigech-title"><i class="bi bi-cash-coin"></i> Datos del crédito</h5>
        </div>

        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="text-muted small">Monto solicitado</div>
              <div class="fw-semibold">$ 250,000.00</div>
            </div>

            <div class="col-md-6">
              <div class="text-muted small">Ingreso mensual</div>
              <div class="fw-semibold">$ 25,000.00</div>
            </div>

            <div class="col-md-6">
              <div class="text-muted small">Fecha de registro</div>
              <div class="fw-semibold">2025-12-14</div>
            </div>

            <div class="col-md-6">
              <div class="text-muted small">Canal</div>
              <div class="fw-semibold">Web / Formulario</div>
            </div>

            <div class="col-12">
              <div class="p-3 border rounded-3 bg-white">
                <div class="text-muted small mb-1">Semáforo de validación (maquetación)</div>
                <div class="d-flex flex-wrap gap-2">
                  <span class="badge text-bg-success"><i class="bi bi-check-circle"></i> Datos completos</span>
                  <span class="badge text-bg-warning"><i class="bi bi-exclamation-triangle"></i> Requiere revisión</span>
                  <span class="badge text-bg-secondary"><i class="bi bi-clock"></i> Pendiente</span>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- Documentos -->
    <div class="col-12">
      <div class="card shadow sigech-card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h5 class="mb-0 sigech-title"><i class="bi bi-folder2-open"></i> Documentos del expediente</h5>
          <button class="btn btn-outline-primary btn-sm" type="button">
            <i class="bi bi-upload"></i> Solicitar documentos
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portal del Cliente - SIGECH</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand sigech-brand" href="#">SIGECH</a>
    <span class="navbar-text text-white opacity-75">Portal del Cliente (maquetación)</span>
  </div>
</nav>

<div class="container mt-4" style="max-width: 1200px;">

  <!-- Encabezado -->
  <div class="card shadow sigech-card mb-3">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div>
        <h3 class="mb-1 sigech-title">Mi solicitud de crédito</h3>
        <div class="text-muted">
          Cliente: <strong>María López García</strong> · Folio: <strong>SOL-00123</strong>
        </div>
      </div>

      <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-outline-secondary" href="registro_solicitud.php">
          <i class="bi bi-file-earmark-plus"></i> Nueva solicitud
        </a>
        <button class="btn btn-outline-light bg-primary border-0" type="button">
          <i class="bi bi-person-circle"></i> Mi perfil
        </button>
      </div>
    </div>
  </div>

  <!-- Progreso / Seguimiento -->
  <div class="card shadow sigech-card mb-3">
    <div class="card-header bg-white">
      <h5 class="mb-0 sigech-title"><i class="bi bi-diagram-3"></i> Seguimiento del proceso</h5>
    </div>
    <div class="card-body">
      <div class="d-flex flex-wrap gap-2 mb-3">
        <span class="badge text-bg-success"><i class="bi bi-check2-circle"></i> Registrada</span>
        <span class="badge text-bg-warning"><i class="bi bi-hourglass-split"></i> En revisión</span>
        <span class="badge text-bg-secondary"><i class="bi bi-clipboard-data"></i> Validación de documentos</span>
        <span class="badge text-bg-secondary"><i class="bi bi-shield-check"></i> Dictamen</span>
        <span class="badge text-bg-secondary"><i class="bi bi-patch-check"></i> Autorización</span>
      </div>

      <div class="alert alert-secondary mb-0">
        <strong>Estatus actual:</strong> En revisión. <span class="text-muted">Tiempo estimado de respuesta: 24–72 hrs (ejemplo).</span>
      </div>
    </div>
  </div>

  <div class="row g-3">

    <!-- Panel: simulación -->
    <div class="col-lg-6">
      <div class="card shadow sigech-card h-100">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
          <h5 class="mb-0 sigech-title"><i class="bi bi-calculator"></i> Simulación del crédito</h5>
          <button class="btn btn-sm btn-outline-primary" type="button">
            <i class="bi bi-arrow-repeat"></i> Recalcular
          </button>
        </div>

        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Monto solicitado</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input class="form-control" type="number" value="250000">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Plazo (años)</label>
              <select class="form-select">
                <option>10</option>
                <option selected>20</option>

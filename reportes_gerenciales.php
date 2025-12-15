<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reportes Operativos y Gerenciales - SIGECH</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand sigech-brand" href="#">SIGECH</a>
    <span class="navbar-text text-white opacity-75">Panel Empresa (Reportes) · Maquetación</span>
  </div>
</nav>

<div class="container mt-4" style="max-width: 1200px;">

  <!-- Encabezado -->
  <div class="card shadow sigech-card mb-3">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div>
        <h3 class="mb-1 sigech-title">Reportes Operativos y Gerenciales</h3>
        <div class="text-muted">Indicadores para seguimiento, control y toma de decisiones (ejemplo).</div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary" type="button">
          <i class="bi bi-download"></i> Exportar
        </button>
        <button class="btn btn-outline-primary" type="button">
          <i class="bi bi-funnel"></i> Filtros
        </button>
      </div>
    </div>
  </div>

  <!-- Filtros (estático) -->
  <div class="card shadow sigech-card mb-3">
    <div class="card-header bg-white">
      <h5 class="mb-0 sigech-title"><i class="bi bi-sliders"></i> Filtros</h5>
    </div>
    <div class="card-body">
      <form class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Periodo</label>
          <select class="form-select">
            <option selected>Últimos 30 días</option>
            <option>Mes actual</option>
            <option>Trimestre</option>
            <option>Año</option>
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Estatus</label>
          <select class="form-select">
            <option selected>Todos</option>
            <option>Registrada</option>
            <option>En revisión</option>
            <option>Autorizada</option>
            <option>Rechazada</option>
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Sucursal / Región</label>
          <select class="form-select">
            <option selected>Todas</option>
            <option>CDMX</option>
            <option>Edo. Méx</option>
            <option>GDL</option>
            <option>MTY</option>
          </select>
        </div>

        <div class="col-md-3 d-grid">
          <label class="form-label opacity-0">.</label>
          <button class="btn btn-primary" type="button">
            <i class="bi bi-check2-circle"></i> Aplicar
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- KPIs -->
  <div class="row g-3 mb-3">
    <div class="col-md-3">
      <div class="card shadow sigech-card h-100">
        <div class="card-body">
          <div class="text-muted small">Solicitudes registradas</div>
          <div class="fs-3 fw-bold">128</div>
          <div class="text-success small"><i class="bi bi-arrow-up"></i> +12% vs periodo anterior</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow sigech-card h-100">
        <div class="card-body">
          <div class="text-muted small">Autorizadas</div>
          <div class="fs-3 fw-bold">54</div>
          <div class="text-muted small">Tasa de autorización: <strong>42%</strong></div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow sigech-card h-100">
        <div class="card-body">
          <div class="text-muted small">Rechazadas</div>
          <div class="fs-3 fw-bold">21</div>
          <div class="text-muted small">Principales causas: Docs / Ingreso</div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow sigech-card h-100">
        <div class="card-body">
          <div class="text-muted small">Tiempo promedio de respuesta</div>
          <div class="fs-3 fw-bold">36 hrs</div>
          <div class="text-warning small"><i class="bi bi-exclamation-triangle"></i> Meta: 24 hrs</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Ope

$(function () {
  const $tbody = $("#tblSolicitudes tbody");
  const $detalle = $("#detalleBox");
  const $btnRecargar = $("#btnRecargar");

  function escapeHtml(str) {
    return String(str ?? "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function fmtMoney(n) {
    const num = Number(n ?? 0);
    return num.toLocaleString("es-MX", { style: "currency", currency: "MXN" });
  }

  function fmtDate(s) {
    if (!s) return "";
    // Si viene timestamp, lo dejamos simple (puedes refinarlo)
    return String(s).replace("T", " ").slice(0, 19);
  }

  function setLoadingList() {
    $tbody.html(`<tr><td colspan="6" class="text-muted">Cargando...</td></tr>`);
  }

  function setLoadingDetail() {
    $detalle.html(`
      <div class="d-flex align-items-center gap-2">
        <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>
        <div class="text-muted">Cargando detalle...</div>
      </div>
    `);
  }

  function renderList(rows) {
    if (!rows.length) {
      $tbody.html(`<tr><td colspan="6" class="text-muted">No hay solicitudes.</td></tr>`);
      return;
    }

    const html = rows.map(r => `
      <tr class="fila-solicitud" data-id="${escapeHtml(r.id_solicitud)}" style="cursor:pointer;">
        <td>${escapeHtml(r.id_solicitud)}</td>
        <td><span class="badge text-bg-secondary">${escapeHtml(r.folio_unico)}</span></td>
        <td>${escapeHtml(r.estatus)}</td>
        <td class="text-end">${fmtMoney(r.monto_solicitado)}</td>
        <td class="text-end">${fmtMoney(r.ingreso_declarado)}</td>
        <td>${escapeHtml(fmtDate(r.creado_en))}</td>
      </tr>
    `).join("");

    $tbody.html(html);
  }

  function renderDetail(d) {
    $detalle.html(`
      <div class="mb-3">
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Folio: ${escapeHtml(d.folio_unico)}</h5>
          <span class="badge text-bg-primary">${escapeHtml(d.estatus)}</span>
        </div>
        <div class="text-muted">ID Solicitud: ${escapeHtml(d.id_solicitud)} · Cliente (id_usuario): ${escapeHtml(d.id_usuario_cliente)}</div>
      </div>

      <div class="row g-2">
        <div class="col-6">
          <div class="p-2 border rounded">
            <div class="text-muted small">Monto solicitado</div>
            <div class="fw-semibold">${fmtMoney(d.monto_solicitado)}</div>
          </div>
        </div>
        <div class="col-6">
          <div class="p-2 border rounded">
            <div class="text-muted small">Ingreso declarado</div>
            <div class="fw-semibold">${fmtMoney(d.ingreso_declarado)}</div>
          </div>
        </div>

        <div class="col-12">
          <div class="p-2 border rounded">
            <div class="text-muted small">Observaciones</div>
            <div>${escapeHtml(d.observaciones || "—")}</div>
          </div>
        </div>

        <div class="col-6">
          <div class="p-2 border rounded">
            <div class="text-muted small">Estado registro</div>
            <div>${escapeHtml(d.estado_registro || "—")}</div>
          </div>
        </div>
        <div class="col-6">
          <div class="p-2 border rounded">
            <div class="text-muted small">Fecha aprobación</div>
            <div>${escapeHtml(fmtDate(d.fecha_aprobacion) || "—")}</div>
          </div>
        </div>

        <div class="col-6">
          <div class="p-2 border rounded">
            <div class="text-muted small">Creado en</div>
            <div>${escapeHtml(fmtDate(d.creado_en) || "—")}</div>
            <div class="text-muted small mt-1">Creado por: ${escapeHtml(d.creado_por || "—")}</div>
          </div>
        </div>
        <div class="col-6">
          <div class="p-2 border rounded">
            <div class="text-muted small">Modificado en</div>
            <div>${escapeHtml(fmtDate(d.modificado_en) || "—")}</div>
            <div class="text-muted small mt-1">Modificado por: ${escapeHtml(d.modificado_por || "—")}</div>
          </div>
        </div>
      </div>
    `);
  }

  function cargarLista() {
    setLoadingList();
    $.getJSON("api_solicitudes_list.php")
      .done(res => {
        if (!res.ok) {
          $tbody.html(`<tr><td colspan="6" class="text-danger">${escapeHtml(res.message || "Error al cargar")}</td></tr>`);
          return;
        }
        renderList(res.data || []);
      })
      .fail(() => {
        $tbody.html(`<tr><td colspan="6" class="text-danger">No se pudo conectar con el servidor.</td></tr>`);
      });
  }

  function cargarDetalle(id) {
    setLoadingDetail();
    $.getJSON("api_solicitud_detalle.php", { id })
      .done(res => {
        if (!res.ok) {
          $detalle.html(`<div class="text-danger">${escapeHtml(res.message || "Error al cargar detalle")}</div>`);
          return;
        }
        renderDetail(res.data);
      })
      .fail(() => {
        $detalle.html(`<div class="text-danger">No se pudo conectar con el servidor.</div>`);
      });
  }

  // Click en filas (delegación)
  $tbody.on("click", "tr.fila-solicitud", function () {
    const id = $(this).data("id");

    // Resaltar fila seleccionada
    $tbody.find("tr").removeClass("table-active");
    $(this).addClass("table-active");

    cargarDetalle(id);
  });

  $btnRecargar.on("click", function () {
    cargarLista();
    $detalle.html(`<div class="text-muted">Selecciona una solicitud para ver sus datos.</div>`);
  });

  // Inicial
  cargarLista();
});

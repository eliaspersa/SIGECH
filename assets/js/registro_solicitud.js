$(function () {
  const $form = $("#formSolicitud");
  const $msgBox = $("#msgBox");
  const $btn = $("#btnEnviar");
  const $spinner = $("#btnSpinner");
  const $btnText = $("#btnText");

  function setLoading(isLoading) {
    $btn.prop("disabled", isLoading);
    $spinner.toggleClass("d-none", !isLoading);
    $btnText.text(isLoading ? "Enviando..." : "Enviar Solicitud");
  }

  function setFormLocked(isLocked) {
    // Bloquea/desbloquea inputs (pero deja habilitado el botón principal )
    $form.find("input, select, textarea").prop("disabled", isLocked);
    // El botón lo controlamos con setLoading, pero al terminar éxito lo bloqueamos también:
    if (isLocked) $btn.prop("disabled", true);
  }

  function escapeHtml(str) {
    return String(str)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function showAlert(type, title, message, detalles = [], folio = null, showResetBtn = false) {
    const detHtml = detalles.length
      ? `<ul class="mb-0 mt-2">${detalles.map(d => `<li>${escapeHtml(d)}</li>`).join("")}</ul>`
      : "";

    const folioHtml = folio
      ? `<div class="mt-2"><strong>Folio:</strong> ${escapeHtml(folio)}</div>`
      : "";

    const resetBtnHtml = showResetBtn
      ? `
        <div class="mt-3 d-flex gap-2">
          <button type="button" id="btnNuevaSolicitud" class="btn btn-primary btn-sm">
            Registrar otra solicitud
          </button>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="alert">
            Cerrar
          </button>
        </div>
      `
      : "";

    $msgBox.html(`
      <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        <strong>${escapeHtml(title)}</strong>
        <div>${escapeHtml(message)}</div>
        ${folioHtml}
        ${detHtml}
        ${resetBtnHtml}
        <button type="button" class="btn-close ${showResetBtn ? "d-none" : ""}" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    `);

    // Si mostramos botón de “Registrar otra”, lo conectamos aquí
    if (showResetBtn) {
      $("#btnNuevaSolicitud").on("click", function () {
        // Ahora sí limpiamos, pero porque el usuario lo pidió
        setFormLocked(false);
        $form.removeClass("was-validated");
        $form[0].reset();
        if (typeof grecaptcha !== "undefined") grecaptcha.reset();
        $msgBox.empty();
        // Reactivar el botón principal
        $btn.prop("disabled", false);
        $btnText.text("Enviar Solicitud");
      });
    }
  }

  $form.on("submit", function (e) {
    e.preventDefault();

    // Validación Bootstrap
    if (!this.checkValidity()) {
      e.stopPropagation();
      $form.addClass("was-validated");
      showAlert("warning", "Campos incompletos", "Revisa los campos marcados antes de enviar.");
      return;
    }

    // Envío asíncrono
    setLoading(true);
    $msgBox.empty();

    const formData = new FormData(this);

    $.ajax({
      url: $form.attr("action"),
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      headers: { "X-Requested-With": "XMLHttpRequest" },
      dataType: "json"
    })
      .done(function (res) {
        if (res.ok) {
          // No hacemos reset: los datos se quedan
          $form.removeClass("was-validated");

          // Señal clara de que ya se envió: bloqueamos el formulario
          setFormLocked(true);

          showAlert(
            "success",
            res.titulo || "Solicitud enviada",
            res.mensaje || "La solicitud se envió correctamente sin recargar la página.",
            res.detalles || [],
            res.folio || null,
            true // muestra botón “Registrar otra solicitud”
          );

          // Nota: no reset de captcha porque el usuario verá que quedó enviado.
          // pero se puede dejar
          // if (typeof grecaptcha !== "undefined") grecaptcha.reset();

        } else {
          // Error desde backend: dejamos campos como están para corregir
          showAlert(
            "danger",
            res.titulo || "Error",
            res.mensaje || "No se pudo registrar.",
            res.detalles || []
          );
          if (typeof grecaptcha !== "undefined") grecaptcha.reset();
        }
      })
      .fail(function () {
        showAlert("danger", "Error", "No se pudo conectar con el servidor. Intenta de nuevo.");
      })
      .always(function () {
        setLoading(false);
      });
  });
});

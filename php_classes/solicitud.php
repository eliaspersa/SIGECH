<?php

require_once __DIR__ . '/cliente.php';
require_once __DIR__ . '/correo.php';

class Solicitud {
    private string $folio;
    private string $fechaSolicitud;
    private float $montoSolicitado;
    private string $estatus;
    private ?string $motivoRechazo;
    private Cliente $cliente; 

    public function __construct(Cliente $cliente, float $montoSolicitado) {
        $this->cliente = $cliente;
        $this->montoSolicitado = $montoSolicitado;
        $this->folio = ""; // Se generará más adelante
        $this->fechaSolicitud = date("Y-m-d");
        $this->estatus = "EN REVISION";
        $this->motivoRechazo = null;
    }

    public function generarFolio() {
        // Implementación futura
    }

    public function generarConfirmacion() {
        // Implementación futura
    }

    public function verEstado() {
        // Implementación futura
    }

    public function subirDocumento() {
        // Implementación futura
    }

    public function autorizarSolicitud() {
        // Implementación futura
    }

    public function rechazarSolicitud() {
        // Implementación futura
    }

    public function notificarRegistro() {
        $mensaje = "
            <p>Estimado(a) {$this->cliente->getNombre()},</p>
            <p>Su solicitud ha sido registrada correctamente.</p>
            <p>Folio: <strong>{$this->folio}</strong></p>
        ";

        Correo::enviar(
            $this->cliente->getEmail(),
            "Registro de Solicitud - SIGECH",
            $mensaje
        );
    }

    public function generarComprobantePDF() {
        require_once __DIR__ . '/PdfService.php';

        $html = "
            <h2>Comprobante de Solicitud</h2>
            <p><strong>Cliente:</strong> {$this->cliente->getNombre()}</p>
            <p><strong>Monto Solicitado:</strong> $ {$this->montoSolicitado}</p>
            <p><strong>Estatus:</strong> {$this->estatus}</p>
            <p><strong>Fecha de Solicitud:</strong> {$this->fechaSolicitud}</p>
        ";

        PdfService::generarPDF($html, "solicitud_{$this->folio}.pdf");
    }

    public function validarAntesDeRegistrar(string $tokenCaptcha): bool {
        require_once __DIR__ . '/CaptchaValidator.php';

        return CaptchaValidator::validarCaptcha($tokenCaptcha);
    }
}

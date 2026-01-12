<?php

require_once __DIR__ . '/cliente.php';
require_once __DIR__ . '/correo.php';

class Solicitud {
    private string $folio;
    private string $fechaSolicitud;
    private float $montoSolicitado;
    private float $ingresoDeclarado;
    private string $estatus;
    private ?string $motivoRechazo;
    private Cliente $cliente;

    public function __construct(Cliente $cliente, float $montoSolicitado, float $ingresoDeclarado) {
        $this->cliente = $cliente;
        $this->montoSolicitado = $montoSolicitado;
        $this->ingresoDeclarado = $ingresoDeclarado;

        $this->folio = ""; // se asigna al guardar en BD
        $this->fechaSolicitud = date("Y-m-d");

        // ATENCION: esto es solo “visual” en el objeto; en BD realmente se guarda 'registrada'
        $this->estatus = "registrada";

        $this->motivoRechazo = null;
    }

    // ---------------------------
    // Acciones futuras (placeholder)
    // ---------------------------
    public function generarFolio() {}
    public function generarConfirmacion() {}
    public function verEstado() {}
    public function subirDocumento() {}
    public function autorizarSolicitud() {}
    public function rechazarSolicitud() {}

    // ---------------------------
    // Funciones actuales
    // ---------------------------
    public function notificarRegistro(): void {
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

    public function generarComprobantePDF(): void {
        require_once __DIR__ . '/PdfService.php';

        $html = "
            <h2>Comprobante de Solicitud</h2>
            <p><strong>Cliente:</strong> {$this->cliente->getNombre()}</p>
            <p><strong>Monto Solicitado:</strong> $ {$this->montoSolicitado}</p>
            <p><strong>Ingreso declarado:</strong> $ {$this->ingresoDeclarado}</p>
            <p><strong>Estatus:</strong> {$this->estatus}</p>
            <p><strong>Fecha de Solicitud:</strong> {$this->fechaSolicitud}</p>
        ";

        PdfService::generarPDF($html, "solicitud_{$this->folio}.pdf");
    }

    public function validarAntesDeRegistrar(string $tokenCaptcha): bool {
        require_once __DIR__ . '/CaptchaValidator.php';
        return CaptchaValidator::validarCaptcha($tokenCaptcha);
    }

    public function guardarEnBD(int $idUsuarioCliente): bool {
        require_once __DIR__ . '/../conexion.php';

        $db = ConexionBD::obtener();

        // Generar folio
        $this->folio = uniqid("SOL-");

        $query = "
            INSERT INTO solicitudes (
                id_usuario_cliente, folio_unico, estatus, monto_solicitado, ingreso_declarado, creado_por
            ) VALUES (
                :id_usuario_cliente, :folio_unico, :estatus, :monto_solicitado, :ingreso_declarado, :creado_por
            )
            RETURNING id_solicitud
        ";

        $stmt = $db->prepare($query);

        $stmt->execute([
            ':id_usuario_cliente' => $idUsuarioCliente,
            ':folio_unico'        => $this->folio,
            ':estatus'            => 'registrada',
            ':monto_solicitado'   => $this->montoSolicitado,
            ':ingreso_declarado'  => $this->ingresoDeclarado,
            ':creado_por'         => $idUsuarioCliente
        ]);

        $resultado = $stmt->fetch();
        return $resultado ? true : false;
    }

    // getter 
    public function getFolio(): string {
        return $this->folio;
    }
}

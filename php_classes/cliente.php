<?php
class Cliente {
    private int $idCliente;
    private string $nombres;
    private string $primerApellido;
    private string $segundoApellido;
    private string $curp;
    private string $email;
    private string $telefono;
    private float $ingresosMensuales;
    private string $fechaNacimiento;
    private string $estatus;
    private string $rfc;
    private string $sexo;

    // Constructor para facilitar creación del cliente
    public function __construct(string $nombres, string $primerApellido, string $segundoApellido, string $email) {
        $this->nombres = $nombres;
        $this->primerApellido = $primerApellido;
        $this->segundoApellido = $segundoApellido;
        $this->email = $email;
        $this->estatus = "ACTIVO"; // Valor por defecto
    }

    // Getters necesarios para Solicitud::notificarRegistro()
    public function getNombre(): string {
        return $this->nombres . ' ' . $this->primerApellido . ' ' . $this->segundoApellido;
    }

    public function getEmail(): string {
        return $this->email;
    }

    // Setters útiles (por si los necesitas después)
    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function setIngresosMensuales(float $ingresos): void {
        $this->ingresosMensuales = $ingresos;
    }

    // Métodos futuros
    public function crearSolicitud() { /* Implementación futura */ }

    public function obtenerSolicitudes() { /* Implementación futura */ }

    public function actualizarDatos() { /* Implementación futura */ }

    public function agregarDireccion() { /* Implementación futura */ }
}
?>

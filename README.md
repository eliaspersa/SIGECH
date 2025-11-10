# SIGECH - Sistema de Gestión de Créditos Hipotecarios

SIGECH es un sistema web orientado a la automatización del proceso de gestión de créditos hipotecarios dentro de una institución. Actualmente, dicho proceso se realiza de manera manual mediante hojas de cálculo y documentos dispersos, lo que genera errores, demoras y dificultades para dar seguimiento a las solicitudes. SIGECH centraliza la información, reduce tiempos de respuesta y proporciona transparencia tanto para el cliente como para el personal interno.

El sistema permitirá a los clientes registrar solicitudes, cargar documentos, consultar el estado de su trámite y visualizar su tabla de amortización. Por otro lado, el personal autorizado podrá revisar solicitudes, aprobarlas o rechazarlas, generar reportes y administrar los créditos otorgados.

## Características Principales

- Registro de solicitudes de crédito hipotecario.
- Carga y validación de documentos en formato digital.
- Evaluación y aprobación/rechazo por parte del personal.
- Cálculo automático del monto del crédito y generación de tabla de amortización.
- Notificaciones por correo electrónico al solicitante.
- Consulta de saldo, pagos próximos y estatus del crédito.
- Generación de reportes operativos y gerenciales.
- Gestión de usuarios, roles y permisos.

## Tecnologías y Herramientas

| Categoría | Herramienta | Motivo de Elección |
|----------|-------------|-------------------|
| Lenguaje Backend | **PHP** | Permite desarrollo web ágil con integración eficiente a PostgreSQL y cuenta con una amplia comunidad y soporte. |
| Base de Datos | **PostgreSQL** | Fiable, seguro y orientado a transacciones, ideal para operaciones financieras. |
| Frontend | HTML5, CSS3, JavaScript | Desarrollo de interfaces claras, responsivas y compatibles con navegadores modernos. |
| IDE / Editor | **Visual Studio Code** | Ligero, gratuito, extensible y con soporte para depuración y control de versiones. |
| Control de Versiones | **Git + GitHub** | Historial de cambios, colaboración y despliegue controlado. |

## Diseño del Sistema

El sistema se desarrolla bajo una arquitectura **MVC** (Modelo-Vista-Controlador) y programación orientada a objetos.  
Se retoma el diagrama de clases elaborado durante la etapa de análisis del proyecto, el cual define las entidades principales del dominio, tales como:

- Cliente
- Solicitud
- Documento
- Crédito
- Pago
- Usuario y Roles

El diagrama de clases y demás documentación se encuentra disponible en la carpeta `/docs` del repositorio.

## Instalación (Versión en Desarrollo)

1. Clonar el repositorio:
git clone https://github.com/eliaspersa/SIGECH.git
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
| Lenguaje Backend | **PHP** | Lenguaje ampliamente utilizado en aplicaciones web con soporte continuo y comunidad activa. |
| Base de Datos | **PostgreSQL** | Fiable, seguro y adecuado para operaciones financieras y consultas relacionales. |
| Frontend | HTML5, CSS3, JavaScript | Permite interfaces responsivas y amigables para el usuario final. |
| Editor / IDE | **Visual Studio Code** | Ligero, extensible y con soporte integrado para Git y depuración. |
| Control de Versiones | **Git + GitHub** | Permite colaboración, historial de cambios y despliegue ordenado. |

## Diseño del Sistema

El sistema se desarrolla usando **Programación Orientada a Objetos (POO)** y evolucionará hacia una arquitectura **MVC (Modelo-Vista-Controlador)** conforme avance el desarrollo.

### Modelo de Dominio (Clases del Proyecto)

Actualmente se cuenta con las siguientes clases base del modelo:

- `cliente.php` — Datos personales del solicitante.
- `direccion.php` — Información de ubicación relacionada al cliente.
- `solicitud.php` — Representa la solicitud de crédito y su estado.
- `documento.php` — Archivos y documentos adjuntos.
- `asesor.php` — Usuario interno encargado de revisar solicitudes.

El **diagrama de clases** que representa estas entidades se encuentra en:
class_diagram.png

## Estructura Actual del Proyecto
SIGECH/
  php_classes/
    cliente.php
    ...
  class_diagram.png
  README.md


Esta estructura crecerá posteriormente para incorporar controladores, vistas y conexión con la base de datos PostgreSQL.

## Instalación (Versión en Desarrollo)

1. Clonar el repositorio:
   `git clone https://github.com/eliaspersa/SIGECH.git`
2. Abrir el proyecto en Visual Studio Code.
3. Verificar las clases dentro de la carpeta `php_classes` para comenzar la implementación de lógica de negocio.
4. Posteriormente, se integrará la base de datos y la interfaz del sistema.

## Estado del Proyecto

El proyecto se encuentra en la fase de **modelado y definición de clases**.  
Las siguientes iteraciones incluirán conexión a base de datos, controladores y vistas.

## Autor

**Elías Pérez Saldaña**  
Desarrollador Web y Analista de Datos  
GitHub: https://github.com/eliaspersa
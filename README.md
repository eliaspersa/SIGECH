# SIGECH - Sistema de Gestión de Créditos Hipotecarios

SIGECH es un sistema web orientado a la automatización del proceso de gestión de créditos hipotecarios dentro de una institución. Actualmente, dicho proceso se realiza de manera manual mediante hojas de cálculo y documentos dispersos, lo que genera errores, demoras y dificultades para dar seguimiento a las solicitudes. SIGECH centraliza la información, reduce tiempos y proporciona transparencia tanto para el cliente como para el personal interno.

En la Iteración 1, el sistema permite registrar solicitudes, validar anti-bots mediante reCAPTCHA, insertar datos reales en PostgreSQL, generar un folio único y realizar acciones de notificación y comprobante.

---

## Características Principales (Iteración 1)

### Módulo Cliente (Registro)
- Registro de solicitudes de crédito mediante un formulario web (Bootstrap 5).
- Validación anti-bots mediante **Google reCAPTCHA**.
- Envío **asíncrono (AJAX + jQuery)** del formulario sin recargar la página.
- Mensajes dinámicos de éxito/error en pantalla (alertas Bootstrap).
- Inserción real de solicitudes en la base de datos PostgreSQL.
- Generación automática de folio único por solicitud.
- Notificación por correo mediante **PHPMailer** (modo simulación con log).
- Generación de comprobante **PDF** usando DOMPDF (en modo no-AJAX).

### Módulo Interno (Panel de Solicitudes)
- Pantalla interna para visualizar solicitudes registradas:
  - Lista (tabla) de solicitudes.
  - Vista de detalle al seleccionar una fila.
  - Carga del detalle sin recargar (AJAX).
- Endpoints API en PHP para consulta:
  - `api_solicitudes_list.php`
  - `api_solicitud_detalle.php`

---

## Tecnologías y Herramientas

| Categoría | Herramienta |
|----------|-------------|
| Backend | PHP 8.0+ |
| Dependencias | Composer |
| Base de datos | PostgreSQL 13+ |
| Frontend | HTML5 + Bootstrap 5 |
| JS/AJAX | JavaScript + jQuery |
| Librerías | PHPMailer, DOMPDF, Google reCAPTCHA |
| IDE | VS Code |
| Control de versiones | Git + GitHub |

---

## Modelo de Dominio (Clases del Proyecto)

El sistema emplea Programación Orientada a Objetos e incluye las siguientes clases principales:

- `asesor.php` — Asesor asignado a la solicitud (futuro).
- `cliente.php` — Información del solicitante.
- `solicitud.php` — Modelo de una solicitud (incluye `guardarEnBD()` y `getFolio()`).
- `correo.php` — Envío de notificaciones (con log).
- `PdfService.php` — Generación de comprobantes PDF.
- `CaptchaValidator.php` — Validación reCAPTCHA (**puede excluirse del repositorio por seguridad**).
- `conexion.php` — Conexión centralizada a PostgreSQL mediante PDO.
- `direccion.php` — Para futuras iteraciones.
- `documento.php` — Para adjuntar documentos en iteraciones posteriores.

---

## Estructura del Proyecto
SIGECH/
│── php_classes/
│ ├── asesor.php
│ ├── cliente.php
│ ├── solicitud.php
│ ├── correo.php
│ ├── PdfService.php
│ ├── CaptchaValidator.php (opcional / ignorado en .gitignore)
│ ├── direccion.php
│ ├── documento.php
│
│── assets/
│ ├── css/
│ └── js/
│ ├── registro_solicitud.js
│ └── solicitudes_admin.js
│
│── registro_solicitud.php
│── procesar_solicitud.php
│── solicitudes_admin.php
│── api_solicitudes_list.php
│── api_solicitud_detalle.php
│── conexion.php
│── script_base_3_correcciones.sql
│── correo_log.txt
│── README.md


# Instalación y Ejecución

## 1. Requisitos
- PHP 8.0 o superior  
- Composer 2.x  
- PostgreSQL 13 o superior  
- Navegador moderno  
- Extensiones `pdo_pgsql` y `openssl` habilitadas

## 2. Crear la base de datos

```sql
CREATE DATABASE sigech;
```

Ejecutar:

```bash
psql -U postgres -d sigech -f script_base_3_correcciones.sql
```

## 3. Instalar dependencias

```bash
composer install
```

## 4. Configurar conexión a PostgreSQL

Editar `conexion.php`:

```php
$host = "localhost";
$puerto = "5432";
$dbname = "sigech";
$usuario = "postgres";
$password = "PASSWORD";
```

## 5. Configuración opcional de correo

En `php_classes/Correo.php`:

```php
$mail->Username = 'TU_CORREO@gmail.com';
$mail->Password = 'TU_APP_PASSWORD';
```

Si no se configura, los intentos se registran en `correo_log.txt`.

## 6. Configurar Google reCAPTCHA

En `CaptchaValidator.php`:

```php
$secretKey = "TU_SECRET_KEY";
```

En `registro_solicitud.php`:

```html
<div class="g-recaptcha" data-sitekey="TU_SITE_KEY"></div>
```


Abrir:

http://localhost:8000/registro_solicitud.php

# Funcionalidades Actuales (Iteración 1 Completada)

- Captura de solicitudes mediante formulario web
- Validación anti-bots con Google reCAPTCHA
- Envío de formulario **asíncrono (AJAX + jQuery)** sin recargar la página
- Mensajes dinámicos de éxito/error en pantalla (alertas Bootstrap)
- Inserción real en PostgreSQL
- Generación de folio único de solicitud
- Generación de comprobante PDF (DOMPDF, en modo no-AJAX)
- Notificación por correo con PHPMailer
- Log de correo en `correo_log.txt`
- Arquitectura basada en POO
- Interfaz con Bootstrap 5
- Panel interno de solicitudes con vista de detalle **sin recarga (AJAX)**


## Estado del Proyecto

SIGECH se encuentra en la Iteración 1 con funcionalidad base completa.  
Las próximas iteraciones incluirán login, panel administrativo, carga de documentos, aprobación/rechazo y tablas de amortización.

## Autor

**eliaspersa*  
Desarrollador Web y Analista de Datos  
GitHub: https://github.com/eliaspersa

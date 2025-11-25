# SIGECH - Sistema de Gestión de Créditos Hipotecarios

SIGECH es un sistema web orientado a la automatización del proceso de gestión de créditos hipotecarios dentro de una institución. Actualmente, dicho proceso se realiza de manera manual mediante hojas de cálculo y documentos dispersos, lo que genera errores, demoras y dificultades para dar seguimiento a las solicitudes. SIGECH centraliza la información, reduce tiempos y proporciona transparencia tanto para el cliente como para el personal interno.

El sistema permite a los clientes registrar solicitudes, declarar su información financiera, validar su identidad mediante reCAPTCHA y generar un comprobante en PDF. En futuras iteraciones el sistema integrará carga de documentos, aprobación/rechazo por parte de analistas, tablas de amortización y panel administrativo.

## Características Principales (Iteración 1)

- Registro de solicitudes de crédito mediante un formulario web.
- Validación de identidad mediante **Google reCAPTCHA**.
- Inserción real de solicitudes en la base de datos PostgreSQL.
- Generación automática de un folio único de solicitud.
- Generación de un **comprobante PDF** usando DOMPDF.
- Notificaciones por correo mediante **PHPMailer** (modo simulación con log).
- Registro de intentos de envío en `correo_log.txt`.
- Arquitectura basada en Programación Orientada a Objetos (POO).
- Interfaz del formulario mejorada con **Bootstrap 5**.

## Tecnologías y Herramientas

| Categoría | Herramienta | Motivo |
|----------|-------------|--------|
| Lenguaje backend | **PHP 8.5** | Sencillo, ampliamente usado y compatible con OOP. |
| Gestión de dependencias | **Composer** | Integración de PHPMailer, DOMPDF y reCAPTCHA. |
| Base de datos | **PostgreSQL 13+** | Fiable y robusto para sistemas financieros. |
| Frontend | HTML5 + Bootstrap 5 | Formularios responsivos y profesionales. |
| Librerías | PHPMailer, DOMPDF, Google reCAPTCHA | Envío de correos, PDF y seguridad. |
| IDE | VS Code | Ligero y extensible. |
| Control de versiones | Git + GitHub | Historial y despliegue ordenado. |

## Modelo de Dominio (Clases del Proyecto)

El sistema emplea Programación Orientada a Objetos e incluye las siguientes clases principales:

- `asesor.php` — Asesor asignado a la solicitud.
- `Cliente.php` — Información del solicitante.
- `Solicitud.php` — Modelo de una solicitud de crédito.
- `Correo.php` — Envío de notificaciones (con log).
- `PdfService.php` — Generación de comprobantes PDF.
- `CaptchaValidator.php` — Validación reCAPTCHA.
- `Conexion.php` — Conexión centralizada a PostgreSQL mediante PDO.
- `direccion.php` — Para futuras iteraciones.
- `documento.php` — Para adjuntar documentos en iteraciones posteriores.

El diagrama de clases se encuentra en:  
`class_diagram.png`

## Estructura del Proyecto

```
SIGECH/
│── php_classes/
│     ├── asesor.php
│     ├── Cliente.php
│     ├── Solicitud.php
│     ├── Correo.php
│     ├── PdfService.php
│     ├── CaptchaValidator.php
│     ├── direccion.php
│     ├── documento.php
│
│── registro_solicitud.php
│── procesar_solicitud.php
│── conexion.php
│── script_base_3_correcciones.sql
│── correo_log.txt
│── class_diagram.png
│── README.md
│── ejemplo_recaptcha.php
│── ejemplo_dompdf.php
│── ejemplo_phpmailer.php
```

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

- Captura de solicitudes
- Validación reCAPTCHA
- Inserción real en PostgreSQL
- Generación de folio
- PDF automático
- Intento de envío con PHPMailer
- Log en `correo_log.txt`
- Arquitectura POO
- Formularios con Bootstrap 5

## Estado del Proyecto

SIGECH se encuentra en la Iteración 1 con funcionalidad base completa.  
Las próximas iteraciones incluirán login, panel administrativo, carga de documentos, aprobación/rechazo y tablas de amortización.

## Autor

**eliaspersa*  
Desarrollador Web y Analista de Datos  
GitHub: https://github.com/eliaspersa

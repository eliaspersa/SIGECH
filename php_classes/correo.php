<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo {

    /**
     * Envía un correo utilizando PHPMailer.
     * Agrega un registro en correo_log.txt por cada intento.
     */
    public static function enviar($para, $asunto, $mensajeHTML) {

        require_once __DIR__ . '/../vendor/autoload.php';

        $mail = new PHPMailer(true);

        // Ruta del log
        $logFile = __DIR__ . '/../correo_log.txt';

        try {

            // Configuración del servidor SMTP (ajusta si usas servidor real)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'CORREO@gmail.com';     // correo real
            $mail->Password   = 'PASSWORD';             // app password real
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Remitente
            $mail->setFrom('TU_CORREO@gmail.com', 'SIGECH - Notificaciones');

            // Destinatario
            $mail->addAddress($para);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = $mensajeHTML;
            $mail->AltBody = strip_tags($mensajeHTML);

            // Enviar correo
            $mail->send();

            // Si se logró enviar o se intentó correctamente, escribir en el log
            $logEntry =
                "[" . date("Y-m-d H:i:s") . "] " .
                "ENVÍO EXITOSO a: $para | Asunto: $asunto\n";

            file_put_contents($logFile, $logEntry, FILE_APPEND);

            return true;

        } catch (Exception $e) {

            // En caso de error, escribir mensaje en el log
            $logEntry =
                "[" . date("Y-m-d H:i:s") . "] " .
                "ERROR al enviar a: $para | Asunto: $asunto | " .
                "Mensaje PHPMailer: " . $e->getMessage() . "\n";

            file_put_contents($logFile, $logEntry, FILE_APPEND);

            return false;
        }
    }
}


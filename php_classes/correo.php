<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo {

    public static function enviar($para, $asunto, $mensajeHTML) {

        require_once __DIR__ . '/../vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {

            // Configuración del servidor SMTP (ajustar cuando se tenga el servidor real)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';        // Servidor SMTP (Ejemplo Gmail)
            $mail->SMTPAuth   = true;
            $mail->Username   = 'CORREO@gmail.com';   // Reemplazar con correo real
            $mail->Password   = 'PASSWORD';           // Reemplazar con contraseña o App Password
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

            return true;

        } catch (Exception $e) {
            // PSi da error, podría guardarse en un log para revisión futura
            // file_put_contents('error_log.txt', $e->getMessage(), FILE_APPEND);
            return false;
        }
    }
}
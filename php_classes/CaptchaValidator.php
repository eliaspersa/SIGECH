<?php

class CaptchaValidator {

    /**
     * Verifica el token enviado por Google reCAPTCHA con la API de validación.
     */
    public static function validarCaptcha(string $token): bool {

        // Clave secreta (se configurará en producción)
        $secretKey = "CLAVE_SECRETA_RECAPTCHA";

        // Endpoint oficial de verificación
        $url = "https://www.google.com/recaptcha/api/siteverify";

        // Construcción de solicitud POST
        $data = [
            'secret' => $secretKey,
            'response' => $token
        ];

        // Enviar petición
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $resultado = file_get_contents($url, false, $context);
        $resultado = json_decode($resultado, true);

        // Google devuelve "success": true si el captcha es válido
        return isset($resultado["success"]) && $resultado["success"] === true;
    }
}
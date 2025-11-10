<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService {

    /**
     * Genera un archivo PDF a partir de contenido HTML utilizando dompdf.
     */
    public static function generarPDF(string $htmlContenido, string $nombreArchivo = "documento.pdf") {

        // Opciones recomendadas
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Cargar HTML
        $dompdf->loadHtml($htmlContenido);

        // Tamaño y orientación del documento
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar
        $dompdf->render();

        // Mostrar o descargar documento
        $dompdf->stream($nombreArchivo, ["Attachment" => false]); 
    }
}
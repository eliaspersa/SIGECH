<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';

try {
    $db = ConexionBD::obtener();

    // Traemos lo básico para la tabla 
    $sql = "
      SELECT
        id_solicitud,
        folio_unico,
        estatus,
        monto_solicitado,
        ingreso_declarado,
        creado_en
      FROM public.solicitudes
      ORDER BY creado_en DESC
      LIMIT 300
    ";

    $stmt = $db->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['ok' => true, 'data' => $rows], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    echo json_encode(['ok' => false, 'message' => 'Error al consultar solicitudes', 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

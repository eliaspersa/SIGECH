<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';

$id = $_GET['id'] ?? '';
if (!ctype_digit($id)) {
    echo json_encode(['ok' => false, 'message' => 'ID inválido'], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $db = ConexionBD::obtener();

    $sql = "
      SELECT
        id_solicitud, id_usuario_cliente, folio_unico, estatus,
        monto_solicitado, ingreso_declarado, observaciones,
        fecha_aprobacion, estado_registro, creado_en, creado_por,
        modificado_en, modificado_por
      FROM public.solicitudes
      WHERE id_solicitud = :id
      LIMIT 1
    ";

    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => (int)$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(['ok' => false, 'message' => 'No existe la solicitud'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode(['ok' => true, 'data' => $row], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    echo json_encode(['ok' => false, 'message' => 'Error al consultar detalle', 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

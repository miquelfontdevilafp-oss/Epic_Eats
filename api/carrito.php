<?php
// API per processar una comanda des del carrito (localStorage)
// Usa la BD i noms de taules d'Epic Eats: comanda, linea_comandes

include_once __DIR__ . '/../entorn.php';
include_once __DIR__ . '/../model/Usuari/Usuari.php';
include_once __DIR__ . '/../database/DataBase.php';

session_start();

header('Content-Type: application/json; charset=utf-8');

$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($metodo !== 'POST') {
    http_response_code(405);
    echo json_encode(['estado' => 'Fallido', 'mensaje' => 'Método no permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$accion = $data['accion'] ?? '';

if ($accion !== 'procesar') {
    http_response_code(400);
    echo json_encode(['estado' => 'Fallido', 'mensaje' => 'Acción no válida']);
    exit;
}

if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
    http_response_code(401);
    echo json_encode(['estado' => 'Fallido', 'mensaje' => 'Debes iniciar sesión para realizar un pedido']);
    exit;
}

$productos = $data['productos'] ?? [];
$total = isset($data['total']) ? floatval($data['total']) : 0.0;

if (empty($productos)) {
    http_response_code(400);
    echo json_encode(['estado' => 'Fallido', 'mensaje' => 'El carrito está vacío']);
    exit;
}

$usuario = $_SESSION['usuario'];

if (is_object($usuario) && method_exists($usuario, 'getId')) {
    $id_usuario = (int)$usuario->getId();
} else {
    $id_usuario = (int)($usuario['id'] ?? 0);
}


if ($id_usuario <= 0) {
    http_response_code(500);
    echo json_encode(['estado' => 'Fallido', 'mensaje' => 'Sesión inválida']);
    exit;
}

try {
    $con = DataBase::connect();
    $con->begin_transaction();

    // Crear comanda
    $stmt = $con->prepare('INSERT INTO comanda (preu_total, id_usuaris) VALUES (?, ?)');
    $stmt->bind_param('di', $total, $id_usuario);
    $stmt->execute();
    $id_comanda = $con->insert_id;
    $stmt->close();

    if (!$id_comanda) {
        throw new Exception('No se ha podido crear la comanda');
    }

    // Crear línies
    foreach ($productos as $item) {
        $id_producte = intval($item['id_producto'] ?? $item['id'] ?? 0);
        $cantidad = intval($item['cantidad'] ?? 1);
        $precio_unidad = floatval($item['precio'] ?? 0);

        if ($id_producte <= 0 || $cantidad <= 0) {
            continue;
        }

        // Alguns esquemes poden tenir "quantitat" i d'altres no. Intentem amb quantitat primer.
        $inserted = false;
        try {
            $stmtL = $con->prepare('INSERT INTO linea_comandes (preu_unitat, id_comanda, id_producte, quantitat) VALUES (?, ?, ?, ?)');
            $stmtL->bind_param('diii', $precio_unidad, $id_comanda, $id_producte, $cantidad);
            $stmtL->execute();
            $stmtL->close();
            $inserted = true;
        } catch (Throwable $e) {
            // fallback sense quantitat
        }

        if (!$inserted) {
            $stmtL = $con->prepare('INSERT INTO linea_comandes (preu_unitat, id_comanda, id_producte) VALUES (?, ?, ?)');
            $stmtL->bind_param('dii', $precio_unidad, $id_comanda, $id_producte);
            // Si no hi ha quantitat, inserim tantes línies com unitats (com a mínim 1)
            $times = max(1, $cantidad);
            for ($i = 0; $i < $times; $i++) {
                $stmtL->execute();
            }
            $stmtL->close();
        }
    }

    $con->commit();
    $con->close();

    http_response_code(201);
    echo json_encode(['estado' => 'Exito', 'data' => ['id_comanda' => $id_comanda], 'mensaje' => 'Comanda creada correctamente']);
    exit;

} catch (Throwable $e) {
    try {
        if (isset($con) && $con) {
            $con->rollback();
            $con->close();
        }
    } catch (Throwable $e2) {
        // ignore
    }
    http_response_code(500);
    echo json_encode(['estado' => 'Fallido', 'mensaje' => 'Error al crear el pedido', 'detalle' => $e->getMessage()]);
    exit;
}

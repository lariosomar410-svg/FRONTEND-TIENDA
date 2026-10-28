<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Tarea.php';

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->obtenerConexion();
$tareaModelo = new Tarea($db);

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        $tareas = $tareaModelo->obtenerTodas();
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $tareas
        ]);
        break;

    case 'POST':
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!isset($datos['titulo']) || empty(trim($datos['titulo']))) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'mensaje' => 'El título es obligatorio']);
            break;
        }

        $descripcion = $datos['descripcion'] ?? '';
        $tareaModelo->crear($datos['titulo'], $descripcion);

        http_response_code(201);
        echo json_encode(['status' => 'success', 'mensaje' => 'Tarea creada correctamente']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['status' => 'error', 'mensaje' => 'Método no permitido']);
        break;
}
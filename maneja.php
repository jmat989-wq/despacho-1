<?php
require_once __DIR__ . "/../models/tarea.php";

header("content-type: application/json; charset=utf-8");

$action = $_GET["action"] ??"";
$tareaModel = new tarea();

try {
    if ($action === "clientes") {
        echo json_encode($tareaModel->obtenerClientes());
        exit;
    }

    if ($action === "crear" && $_SERVER["REQUEST_METHOD"] === "POST") {
        $concepto = trim($_POST["completo"] ??"");
        $clienteId = !empty($_POST["clienteReferido"]) ? (int) $_POST["clienteReferido"] : null;
        $fechaFin = $_POST["fechaFin"] ??"";

        if ($concepto === "" || $fechaFin ==="") {
            echo json_encode(["success" => false, "message" => "concepto y fecha fin son obligatorios."]);
            exit;
        }
        $ok = $tareaModel->crear($concepto, $cienteId, $fechaFin);
        echo json_encode([
            "success" => $ok,
            "message" => $ok ? "Tarea guardada." : "Error al guardar la tarea."
        ]);
        exit;
    }
echo json_encode(["success" => false, "message" => "accnion no valida."]);
}catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => "error en el servidor."]);
}
?>
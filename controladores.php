<?php
session_start();
require_once __DIR__ . "/../models/Usuario.php";

header("Content-Type: application/json; charset=utf-8");

$action = $_GET["action"] ?? "";
$usuarioModel = new Usuario();

try {
    if ($action === "login" && $_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST["username"] ?? "");
        $pass = $_POST["pass"] ?? "";

        if ($username === "" || $pass === "") {
            echo json_encode(["success" => false, "message" => "Complete todos los campos."]);
            exit;
        }

        $usuario = $usuarioModel->buscarPorNombre($username);

        if ($usuario && password_verify($pass, $usuario["password"])) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
            echo json_encode(["success" => true, "message" => "Inicio de sesión correcto."]);
        } else {
            echo json_encode(["success" => false, "message" => "Usuario o contraseña incorrectos."]);
        }
        exit;
    }

    if ($action === "registro" && $_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = trim($_POST["rUsername"] ?? "");
        $pass = $_POST["pass"] ?? "";
        $pass2 = $_POST["pass2"] ?? "";

        if ($nombre === "" || $pass === "" || $pass2 === "") {
            echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
            exit;
        }

        if ($pass !== $pass2) {
            echo json_encode(["success" => false, "message" => "Las contraseñas no coinciden."]);
            exit;
        }

        if ($usuarioModel->buscarPorNombre($nombre)) {
            echo json_encode(["success" => false, "message" => "El usuario ya existe."]);
            exit;
        }

        $creado = $usuarioModel->registrar($nombre, $pass);
        echo json_encode([
            "success" => $creado,
            "message" => $creado ? "Usuario registrado con éxito." : "No se pudo registrar."
        ]);
        exit;
    }

    echo json_encode(["success" => false, "message" => "Acción no válida."]);
} catch (Throwable $e) {
    echo json_encode(["success" => false, "message" => "Error en el servidor."]);
}

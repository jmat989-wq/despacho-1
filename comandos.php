<?php
require_once "conexion.php";

header("content-type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "metodo no permitido."]);
    exit;
}

$username = trim($_POST["username"] ?? "");
$pass = $_POST["pass"] ??"";

if ($username === "" || $pass === "") {
    echo json_encode(["success" => false, "message" => "por favor complete todos los campos"]);
    exit;
}

try {
    // 1. Buscar el usuario en la tabla `usuarios`
    $sql = "SELECT id, nombre, password FROM usuarios WHERE nombre = :nombre LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => $username]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Comprobar que existe y verificar la contraseña contra el hash de la BD
    if ($usuario && password_verify($pass, $usuario['password'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        echo json_encode([
            'success' => true,
            'message' => 'Inicio de sesión correcto.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Usuario o contraseña incorrectos.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al consultar la base de datos.'
    ]);
}
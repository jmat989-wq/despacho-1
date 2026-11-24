<?php
require_once "conexion.php";
header("content-type: appication/json");

if ($_SERVER["REQUEST_METHOD"] === "post") {
    $username = trim($_post["username"] ?? "");
    $pass = $_POST["pass"] ?? "";

    if (empty($username) || empty($pass)) {
        echo json_encode(["success" => false, "message => por favor complete todos los campos"]);
        exit;
    }
}

try {
    $stmt = $pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE nombre = :nombre");
    $stmt->execute([":nombre" => $username]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($pass, $usuario["pasword"])) {

        session_start();
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["USUARIO_NOMBRE"] = $usuario["nombre"];

        echo json_encode(["success" => true, "message" => "!Bienvenido!"]);
    } else {
        echo json_encode(["sucess" => false, "message" => "Usuario o contraseña incorrectos"]);
    }
} catch (exception $e) {
    echo json_encode(["uccess" => false, "message" => "Error en el servidor:" . $e->getMessage()]);
}
?>
<?php

require_once 'conexion.php'; 

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = trim($_POST['rUsername'] ?? '');
    $pass = $_POST['pass'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';

    
    if (empty($nombre) || empty($pass) || empty($pass2)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    if ($pass !== $pass2) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    try {
       
        $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE nombre = :nombre");
        $stmtCheck->execute([':nombre' => $nombre]);
        
        if ($stmtCheck->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'El nombre de usuario ya está en uso.']);
            exit;
        }

        
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT);

       
        $sql = "INSERT INTO usuarios (nombre, password) VALUES (:nombre, :password)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':nombre' => $nombre,
            ':password' => $passwordHash
        ]);

        echo json_encode(['success' => true, 'message' => 'Usuario registrado con éxito.']);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
    }
}
?>
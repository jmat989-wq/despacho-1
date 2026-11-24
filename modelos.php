<?php
require_once __DIR__ . '/../config/conexion.php';

class Usuario {
    private PDO $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function buscarPorNombre(string $nombre): ?array {
        $sql = "SELECT id, nombre, password FROM usuarios WHERE nombre = :nombre LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nombre' => $nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ?: null;
    }

    public function registrar(string $nombre, string $passwordPlano): bool {
        $hash = password_hash($passwordPlano, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, password) VALUES (:nombre, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':password' => $hash
        ]);
    }
}
?>
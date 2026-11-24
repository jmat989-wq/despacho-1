<?php
require_once __DIR__ . '/../config/conexion.php';

class Tarea {
    private PDO $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerClientes(): array {
        $stmt = $this->db->query("SELECT id, nombre FROM clientes ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear(string $concepto, ?int $clienteId, string $fechaFin): bool {
        $sql = "INSERT INTO tareas (concepto, cliente_id, fecha_fin)
                VALUES (:concepto, :cliente_id, :fecha_fin)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':concepto' => $concepto,
            ':cliente_id' => $clienteId,
            ':fecha_fin' => $fechaFin
        ]);
    }

    public function listar(): array {
        $sql = "SELECT 
                    t.id,
                    t.fecha_creacion, 
                    t.concepto, 
                    COALESCE(c.nombre, 'Sin cliente') AS cliente, 
                    t.fecha_fin,
                    t.estado
                FROM tareas t
                LEFT JOIN clientes c ON t.cliente_id = c.id
                ORDER BY t.fecha_creacion DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
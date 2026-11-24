<?php
class Conexion {
    public static function conectar(): PDO {
        $host = "localhost";
        $dbname = "sistema_gestion";
        $username = "root";
        $password = "";

        $pdo = new PDO(
            "mysql:host=$host;dbname;charset=utf8mb4",
            $username,
            $password
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
?>


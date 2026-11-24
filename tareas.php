<?php
$host = "localhost";
$dbname = "sistema_gestion";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header("content-type: aplication/json");
    echo json_encode(["sucess" => false, "error" => "error de conexion" . $e->getmessage()]);
    exit;
}
?>





<?php
require_once "conexion.php";
header("content-type: aplication/json");

try {
    $stmt = $pdo->query("select id, nombre FROM clientes ORDER BY nombre ASC");
    $clientes = $stmet->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($clientes);
} catch(exception $e) {
    echo json_encode(["error" => $e->getmessage()]);
}
?>





<?php
require_once "conexion.php";
header("content-type: aplication/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $concepto = $_POST["concepto"] ?? "";
    $cliente_id = !empty($_POST["clienteReferido"]) ? $_POST["clienteReferido"] : null;
    exit;
}

try {
    $sql = "INSERT INTO tareas (concepto, cliente_id, fecha fin) VALUES (:concepto, :clinte_id, :fecha_fin)";
    $stmt = $pdo->prepare($sql);

   $stmt->execute([
    ":concepto" => $concepto,
    ":cliente_id" => $cliente_id,
    ":fecha_fin" => $fecha_fin
   ]);

   echo json_encode(["sucess" => true, "message" => "Tarea guardada con exito"]);
}catch (Exception $e) {
    echo json_encode([ "sucess" => false, "message" => "Error al guardar" . $e->getMessage()]);
}
?>






<?php
require_once "conexion.php";
header("content-type: application/json");

try {
    $sql = "SELECT
                t.fecha_creacion,
                t.concepto,
                COALESCE(c.nombre, `Sin cliente`) AS cliente,
                t.fecha_fin
            FROM tareas t
            LEFT JOIN clientes c ON t.cliente_id = c.id
            ORDER BY t.fecha_creacion DESC";

    $STMT = $pdo->query($sql);
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ECHO json_encode($tareas);
} catch (Exception $e){
    echo json_encode(["error" => $e->getMessage()]);
}
?>


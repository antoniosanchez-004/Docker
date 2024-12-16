<?php
header("Access-Control-Allow-Origin: *");  // Permite cualquier origen, para pruebas
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");  // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type");  // Cabeceras permitidas

// Si la solicitud es OPTIONS (preflight), se puede responder aquí
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true); // Decodificar el cuerpo de la solicitud JSON

        if (isset($input['nombre'])) {  // Acceder correctamente al campo 'nombre' del JSON
            $nombre = $input['nombre'];

            $dsn = 'mysql:host=db;dbname=nombres;charset=utf8';
            $username = 'root';
            $password = 'root';

            try {
                // Conectar a la base de datos usando PDO
                $conn = new PDO($dsn, $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("INSERT INTO users (nombre) VALUES (:nombre)");
                $stmt->bindParam(':nombre', $nombre);
                $stmt->execute();

                 // Nombre guardado correctamente
                http_response_code(201);  
                echo json_encode(["success" => true, "data" => ["nombre" => $nombre]]);

                
            } catch (PDOException $e) {
                http_response_code(500);  // Error de servidor
                echo json_encode(["success" => false, "message" => "Error de conexión: " . $e->getMessage()]);
            }
            
        } else {
            // Datos insuficientes en la solicitud
            http_response_code(400);  
            echo json_encode(["success" => false, "message" => "Faltan campos requeridos (nombre)"]);
        }
    
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $dsn = 'mysql:host=db;dbname=nombres;charset=utf8';
    $username = 'root';
    $password = 'root';

    try {
        // Conectar a la base de datos usando PDO
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener correos de la base de datos
        $stmt = $conn->query("SELECT nombre FROM users");
        $nombres = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if ($nombres) {
            // Devolver los nombres en formato JSON
            http_response_code(200); 
            echo json_encode(['success' => true, 'data' => $nombres]);
        } else {
            // No se encontraron nombres en la base de datos
            http_response_code(404); 
            echo json_encode(['success' => false, 'message' => 'No se encontraron nombres en la base de datos.']);
        }
    } catch (PDOException $e) {
        http_response_code(500); 
        echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
    }
}



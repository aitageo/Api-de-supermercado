<?php

// JWT json web tokens en PHP para protección de rutas
require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define('JWT_SECRET', 'aitageo2hbc45og');

require_once "../model/database.php";

class UsuariosController {
    private $conexion;

    public function __construct() {
        $database = new Database();
        $this->conexion = $database->getConexion();
    }

    public function login() {
        header('Content-Type: application/json');

        // Obtiene los datos del frontend
        $data = json_decode(file_get_contents('php://input'), true);
        $correo = $data['correo'];
        $password = $data['password'];
        
        $sql = "SELECT correo, password FROM administradores WHERE correo = :correo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $usuario['password'])) {
                $issuedAt = time();
                $expirationTime = $issuedAt + 3600; // Token válido por 1 hora , 15 minutos

                $payload = [
                    'iat' => $issuedAt,
                    'exp' => $expirationTime,
                    'data' => [
                        'correo' => $correo
                    ]
                ];

                $jwt = JWT::encode($payload, JWT_SECRET, 'HS256');
                echo json_encode([
                    'token' => $jwt,
                    'success' => "Usuario logueado con éxito"
                ]);
                http_response_code(200);
                return;
            } else {
                echo json_encode(["error" => "Usuario o contraseña incorrectos"]);
                http_response_code(401); // prohibido
                return;
            }
        } else {
            echo json_encode(["error" => "Usuario no encontrado"]);
            http_response_code(404); // No encontrado
            return;
        }
    }
}

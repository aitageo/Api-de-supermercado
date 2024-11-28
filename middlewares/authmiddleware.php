<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function verificarToken($required = true) {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        if ($required) {
            http_response_code(401);
            echo json_encode(['error' => 'Acceso no autorizado']);
            exit();
        }
        return null;
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $secret_key = "aitageo2hbc45og";
    
    try {
        $payload = JWT::decode($token, new Key($secret_key, 'HS256'));
        return $payload;
    } catch (Exception $error) {
        http_response_code(401);
        echo json_encode(["error" => "Token inválido o expirado"]);
        exit();
    }
}

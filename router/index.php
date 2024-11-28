<?php

//CORS  Intercambio de Recursos de Origen Cruzado (CORS)
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD']==='OPTIONS'){//el 500 error interno del servidor
    http_response_code(200);//el codigo de estado 200 significa exitoso
    exit();
};


require '../controllers/ProductosController.php';
require '../controllers/UsuariosController.php';
require '../middlewares/authmiddleware.php';

$url = str_replace('/api/router/index.php','', parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
$id = $_GET['id']?? null;
$productos = new ProductosController();//esto es un objeto lo reconozco por el new
$usuarios = new UsuariosController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($url) {
    case '/api/productos/CreateProducto':
        if($method === 'POST'){
            verificarToken();
            $productos->CreateProducto();
        }
        break;

    case '/api/productos/getProductos':
     if($method === 'GET'){
        verificarToken();
        $productos->getProductos();
    }
    break;
    
    case '/api/productos/updateProducto':
        if($method === 'PUT'){
            verificarToken();
            $productos->updateProducto();
        }
        break;
        
        case '/api/productos/DeleteProducto':
            if($method === 'DELETE'){
            verificarToken();
            if($id){
                $productos->deleteProducto($id);
            }
        }
        break;




    //------------------Usuarios------------------------------------//    
    case '/api/usuarios/login':
        if($method === 'POST'){
            $usuarios->login();
        }
        break;

    
    default:
        http_response_code(404);
        echo json_encode(['message'=> 'Ruta no encontrada']);
        break;
}

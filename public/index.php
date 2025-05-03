<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json; charset=UTF-8");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriParts = array_values(array_filter(explode('/', $uri)));
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($uriParts[1])) {
    switch ($uriParts[1]) {
        case 'users':
            include_once '../routes/users.php';
            break;
        case 'media':
            include_once '../routes/media.php';
            break;
        case 'history':
            include_once '../routes/history.php';
            break;
        case 'collaboration':
            include_once '../routes/collaboration.php';
            break;
        case 'note':
            include_once '../routes/note.php';
            break;
        default:
            http_response_code(404);
            echo json_encode(["error" => "Route not found"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["error" => "No route provided"]);
}

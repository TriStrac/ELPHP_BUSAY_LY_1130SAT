<?php
include_once '../controllers/usercontroller.php';
$userController = new UserController();

$idOrEmail = $uriParts[2] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($idOrEmail) {
            $userController->getUserByEmail($idOrEmail);
        } else {
            $userController->getUsers();
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->username, $data->email, $data->password) &&
            !empty($data->username) && !empty($data->email) && !empty($data->password)
        ) {
            $userController->createUser(
                $data->username, $data->email, $data->password,
                $data->profilePicture ?? null
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Fill all fields"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->username, $data->email) &&
            !empty($data->username) && !empty($data->email)
        ) {
            $userController->updateUser(
                $idOrEmail, $data->username, $data->email,
                $data->profilePicture ?? null
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Fill all fields"]);
        }
        break;

    case 'DELETE':
        if (!empty($idOrEmail)) {
            $userController->deleteUser($idOrEmail);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "User ID is required"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
}

<?php
include_once '../controllers/collaborationcontroller.php';
$collaborationController = new CollaborationController();

$collaborationID = $uriParts[2] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($collaborationID) {
            $collaborationController->getCollaborationByID($collaborationID);
        } else {
            $collaborationController->getAllCollaborations();
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->noteID, $data->userID, $data->permission, $data->createdAt, $data->updatedAt)
            && !empty($data->noteID) && !empty($data->userID) && !empty($data->permission)
        ) {
            $collaborationController->createCollaboration(
                $data->noteID, $data->userID, $data->permission,
                $data->createdAt, $data->updatedAt
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Fill all fields"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->noteID, $data->userID, $data->permission, $data->updatedAt)
            && !empty($data->noteID) && !empty($data->userID) && !empty($data->permission)
        ) {
            $collaborationController->updateCollaboration(
                $collaborationID, $data->noteID, $data->userID,
                $data->permission, $data->updatedAt
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Fill all fields"]);
        }
        break;

    case 'DELETE':
        $collaborationController->deleteCollaboration($collaborationID);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
}
?>

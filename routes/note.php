<?php
include_once '../controllers/notecontroller.php';
$noteController = new NoteController();

$noteID = $uriParts[2] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($noteID) {
            $noteController->getNoteByID($noteID);
        } else {
            $noteController->getAllNotes();
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->ownerID, $data->mediaID, $data->title, $data->content, $data->createdAt, $data->updatedAt)
            && !empty($data->ownerID) && !empty($data->mediaID) && !empty($data->title)
        ) {
            $noteController->createNote(
                $data->ownerID, $data->mediaID, $data->title, $data->content,
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
            isset($data->ownerID, $data->mediaID, $data->title, $data->content, $data->updatedAt)
            && !empty($data->ownerID) && !empty($data->mediaID) && !empty($data->title)
        ) {
            $noteController->updateNote(
                $noteID, $data->ownerID, $data->mediaID, $data->title, 
                $data->content, $data->updatedAt
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Fill all fields"]);
        }
        break;

    case 'DELETE':
        $noteController->deleteNote($noteID);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
}
?>

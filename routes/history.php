<?php
include_once '../controllers/historycontroller.php';
$historyController = new HistoryController();

$historyID = $uriParts[2] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($historyID) {
            $historyController->getHistoryByID($historyID);
        } else {
            $historyController->getAllHistory();
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->noteID, $data->userID, $data->contentSnap, $data->dateEdite, $data->editedBy)
            && !empty($data->noteID) && !empty($data->userID)
        ) {
            $historyController->createHistory(
                $data->noteID,
                $data->userID,
                $data->contentSnap ?? null,
                $data->dateEdite ?? date("Y-m-d H:i:s"),
                $data->editedBy ?? null
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Required fields missing"]);
        }
        break;
        
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->noteID, $data->userID, $data->contentSnap, $data->dateEdite, $data->editedBy)
            && !empty($data->noteID) && !empty($data->userID) && !empty($data->contentSnap)
        ) {
            $historyController->updateHistory(
                $historyID,
                $data->noteID,
                $data->userID,
                $data->contentSnap,
                $data->dateEdite ?? date("Y-m-d H:i:s"),
                $data->editedBy ?? null
            );
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Required fields missing"]);
        }
        break;

    case 'DELETE':
        $historyController->deleteHistory($historyID);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
}

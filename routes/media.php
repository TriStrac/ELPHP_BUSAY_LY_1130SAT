<?php
include_once '../controllers/mediacontroller.php';
$mediaController = new MediaController();

$mediaID = $uriParts[2] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($mediaID) {
            $mediaController->getMediaByID($mediaID);
        } else {
            $mediaController->getAllMedia();
        }
        break;

        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            if (
                isset($data->userID, $data->mediaName, $data->mediaType, 
                      $data->dateUploaded, $data->attributes, $data->positionXY)
                && !empty($data->userID) && !empty($data->mediaName) && !empty($data->mediaType)
                && !empty($data->dateUploaded) && !empty($data->attributes) && !empty($data->positionXY)
            ) {
                $mediaController->createMedia(
                    $data->userID, $data->mediaName, $data->mediaType,
                    $data->dateUploaded, $data->attributes, $data->positionXY
                );
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Fill all fields"]);
            }
            break;
    
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"));
            if (
                isset($data->mediaName, $data->mediaType, $data->attributes, $data->positionXY)
                && !empty($data->mediaName) && !empty($data->mediaType)
                && !empty($data->attributes) && !empty($data->positionXY)
            ) {
                $mediaController->updateMedia(
                    $mediaID, $data->mediaName, $data->mediaType,
                    $data->attributes, $data->positionXY
                );
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Fill all fields"]);
            }
            break;
    

    case 'DELETE':
        $mediaController->deleteMedia($mediaID);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
}

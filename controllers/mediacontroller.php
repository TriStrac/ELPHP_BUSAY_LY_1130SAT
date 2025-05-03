<?php
include_once '../models/mediamodel.php';
include_once '../config/database.php';

class MediaController {
    private $mediaModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->mediaModel = new MediaModel($db);
    }

    public function createMedia($userID, $mediaName, $mediaType, $dateUploaded, $attributes, $positionXY) {
        if ($this->mediaModel->create($userID, $mediaName, $mediaType, $dateUploaded, $attributes, $positionXY)) {
            echo json_encode(["message" => "Media created successfully"]);
        } else {
            echo json_encode(["message" => "Media creation failed"]);
        }
    }

    public function getAllMedia() {
        $media = $this->mediaModel->findAll();
        echo json_encode($media);
    }

    public function getMediaByID($mediaID) {
        $media = $this->mediaModel->findByID($mediaID);
        if ($media) {
            echo json_encode($media);
        } else {
            echo json_encode(["message" => "Media not found"]);
        }
    }

    public function updateMedia($mediaID, $mediaName, $mediaType, $attributes, $positionXY) {
        if ($this->mediaModel->update($mediaID, $mediaName, $mediaType, $attributes, $positionXY)) {
            echo json_encode(["message" => "Media updated successfully"]);
        } else {
            echo json_encode(["message" => "Media ID doesn't exist"]);
        }
    }

    public function deleteMedia($mediaID) {
        if ($this->mediaModel->delete($mediaID)) {
            echo json_encode(["message" => "Media deleted successfully"]);
        } else {
            echo json_encode(["message" => "Media ID doesn't exist"]);
        }
    }
}
?>
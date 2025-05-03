<?php
include_once '../models/collaborationmodel.php';
include_once '../config/database.php';

class CollaborationController {
    private $collaborationModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->collaborationModel = new CollaborationModel($db);
    }

    public function createCollaboration($noteID, $userID, $permission, $createdAt, $updatedAt) {
        if ($this->collaborationModel->create($noteID, $userID, $permission, $createdAt, $updatedAt)) {
            echo json_encode(["message" => "Collaboration created successfully"]);
        } else {
            echo json_encode(["message" => "Collaboration creation failed"]);
        }
    }

    public function getAllCollaborations() {
        $collaborations = $this->collaborationModel->findAll();
        echo json_encode($collaborations);
    }

    public function getCollaborationByID($collaborationID) {
        $collaboration = $this->collaborationModel->findByID($collaborationID);
        if ($collaboration) {
            echo json_encode($collaboration);
        } else {
            echo json_encode(["message" => "Collaboration not found"]);
        }
    }

    public function updateCollaboration($collaborationID, $noteID, $userID, $permission, $updatedAt) {
        if ($this->collaborationModel->update($collaborationID, $noteID, $userID, $permission, $updatedAt)) {
            echo json_encode(["message" => "Collaboration updated successfully"]);
        } else {
            echo json_encode(["message" => "Collaboration ID doesn't exist"]);
        }
    }

    public function deleteCollaboration($collaborationID) {
        if ($this->collaborationModel->delete($collaborationID)) {
            echo json_encode(["message" => "Collaboration deleted successfully"]);
        } else {
            echo json_encode(["message" => "Collaboration ID doesn't exist"]);
        }
    }
}
?>

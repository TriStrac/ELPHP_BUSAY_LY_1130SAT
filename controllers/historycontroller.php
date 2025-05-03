<?php
include_once '../models/historymodel.php';
include_once '../config/database.php';

class HistoryController {
    private $historyModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->historyModel = new HistoryModel($db);
    }

    public function createHistory($noteID, $userID, $contentSnap, $dateEdite, $editedBy) {
        if ($this->historyModel->create($noteID, $userID, $contentSnap, $dateEdite, $editedBy)) {
            echo json_encode(["message" => "History entry created successfully"]);
        } else {
            echo json_encode(["message" => "Failed to create history entry"]);
        }
    }

    public function getAllHistory() {
        echo json_encode($this->historyModel->findAll());
    }

    public function getHistoryByID($historyID) {
        $history = $this->historyModel->findByID($historyID);
        if ($history) {
            echo json_encode($history);
        } else {
            echo json_encode(["message" => "History not found"]);
        }
    }

    public function updateHistory($historyID, $noteID, $userID, $contentSnap, $dateEdite, $editedBy) {
        if ($this->historyModel->update($historyID, $noteID, $userID, $contentSnap, $dateEdite, $editedBy)) {
            echo json_encode(["message" => "History updated successfully"]);
        } else {
            echo json_encode(["message" => "History ID doesn't exist"]);
        }
    }    

    public function deleteHistory($historyID) {
        if ($this->historyModel->delete($historyID)) {
            echo json_encode(["message" => "History entry deleted"]);
        } else {
            echo json_encode(["message" => "History ID not found"]);
        }
    }
}

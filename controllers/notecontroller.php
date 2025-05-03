<?php
include_once '../models/notemodel.php';
include_once '../config/database.php';

class NoteController {
    private $noteModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->noteModel = new NoteModel($db);
    }

    public function createNote($ownerID, $mediaID, $title, $content, $createdAt, $updatedAt) {
        if ($this->noteModel->create($ownerID, $mediaID, $title, $content, $createdAt, $updatedAt)) {
            echo json_encode(["message" => "Note created successfully"]);
        } else {
            echo json_encode(["message" => "Note creation failed"]);
        }
    }

    public function getAllNotes() {
        $notes = $this->noteModel->findAll();
        echo json_encode($notes);
    }

    public function getNoteByID($noteID) {
        $note = $this->noteModel->findByID($noteID);
        if ($note) {
            echo json_encode($note);
        } else {
            echo json_encode(["message" => "Note not found"]);
        }
    }

    public function updateNote($noteID, $ownerID, $mediaID, $title, $content, $updatedAt) {
        if ($this->noteModel->update($noteID, $ownerID, $mediaID, $title, $content, $updatedAt)) {
            echo json_encode(["message" => "Note updated successfully"]);
        } else {
            echo json_encode(["message" => "Note ID doesn't exist"]);
        }
    }

    public function deleteNote($noteID) {
        if ($this->noteModel->delete($noteID)) {
            echo json_encode(["message" => "Note deleted successfully"]);
        } else {
            echo json_encode(["message" => "Note ID doesn't exist"]);
        }
    }
}
?>

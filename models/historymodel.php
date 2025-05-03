<?php
class HistoryModel {
    private $conn;
    private $table = "history";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($noteID, $userID, $contentSnap, $dateEdite, $editedBy) {
        $query = "INSERT INTO $this->table (NoteID, UserID, contentSnap, dateEdite, editedBy)
                  VALUES (:noteID, :userID, :contentSnap, :dateEdite, :editedBy)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':noteID', $noteID);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':contentSnap', $contentSnap);
        $stmt->bindParam(':dateEdite', $dateEdite);
        $stmt->bindParam(':editedBy', $editedBy);

        return $stmt->execute();
    }

    public function findAll() {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByID($historyID) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE HistoryID = :historyID");
        $stmt->bindParam(':historyID', $historyID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($historyID, $noteID, $userID, $contentSnap, $dateEdite, $editedBy) {
        $checkQuery = "SELECT 1 FROM $this->table WHERE HistoryID = :historyID";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':historyID', $historyID);
        $checkStmt->execute();

        if (!$checkStmt->fetch()) {
            return false;
        }

        $query = "UPDATE $this->table 
                SET NoteID = :noteID, UserID = :userID, contentSnap = :contentSnap, 
                    dateEdite = :dateEdite, editedBy = :editedBy
                WHERE HistoryID = :historyID";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':noteID', $noteID);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':contentSnap', $contentSnap);
        $stmt->bindParam(':dateEdite', $dateEdite);
        $stmt->bindParam(':editedBy', $editedBy);
        $stmt->bindParam(':historyID', $historyID);

        return $stmt->execute();
    }


    public function delete($historyID) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE HistoryID = :historyID");
        $stmt->bindParam(':historyID', $historyID);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}

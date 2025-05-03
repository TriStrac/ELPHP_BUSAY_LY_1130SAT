<?php
class NoteModel {
    private $conn;
    private $table = "note";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($ownerID, $mediaID, $title, $content, $createdAt, $updatedAt) {
        $query = "INSERT INTO $this->table (OwnerID, MediaID, Title, Content, createdAt, updatedAt)
                  VALUES (:ownerID, :mediaID, :title, :content, :createdAt, :updatedAt)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':ownerID', $ownerID);
        $stmt->bindParam(':mediaID', $mediaID);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':createdAt', $createdAt);
        $stmt->bindParam(':updatedAt', $updatedAt);

        return $stmt->execute();
    }

    public function findAll() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByID($noteID) {
        $query = "SELECT * FROM $this->table WHERE NoteID = :noteID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':noteID', $noteID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($noteID, $ownerID, $mediaID, $title, $content, $updatedAt) {
        $checkQuery = "SELECT 1 FROM $this->table WHERE NoteID = :noteID";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':noteID', $noteID);
        $checkStmt->execute();

        if (!$checkStmt->fetch()) {
            return false;
        }

        $query = "UPDATE $this->table 
                  SET OwnerID = :ownerID, MediaID = :mediaID, Title = :title, 
                      Content = :content, updatedAt = :updatedAt
                  WHERE NoteID = :noteID";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':ownerID', $ownerID);
        $stmt->bindParam(':mediaID', $mediaID);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':updatedAt', $updatedAt);
        $stmt->bindParam(':noteID', $noteID);

        return $stmt->execute();
    }

    public function delete($noteID) {
        $query = "DELETE FROM $this->table WHERE NoteID = :noteID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':noteID', $noteID);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }

        return false;
    }
}
?>

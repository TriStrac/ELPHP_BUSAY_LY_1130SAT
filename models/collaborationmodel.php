<?php
class CollaborationModel {
    private $conn;
    private $table = "collaboration";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($noteID, $userID, $permission, $createdAt, $updatedAt) {
        $query = "INSERT INTO $this->table (NoteID, UserID, Permission, createdAt, updatedAt)
                  VALUES (:noteID, :userID, :permission, :createdAt, :updatedAt)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':noteID', $noteID);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':permission', $permission);
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

    public function findByID($collaborationID) {
        $query = "SELECT * FROM $this->table WHERE CollaborationID = :collaborationID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':collaborationID', $collaborationID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($collaborationID, $noteID, $userID, $permission, $updatedAt) {
        $checkQuery = "SELECT 1 FROM $this->table WHERE CollaborationID = :collaborationID";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':collaborationID', $collaborationID);
        $checkStmt->execute();

        if (!$checkStmt->fetch()) {
            return false;
        }

        $query = "UPDATE $this->table 
                  SET NoteID = :noteID, UserID = :userID, Permission = :permission, 
                      updatedAt = :updatedAt
                  WHERE CollaborationID = :collaborationID";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':noteID', $noteID);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':permission', $permission);
        $stmt->bindParam(':updatedAt', $updatedAt);
        $stmt->bindParam(':collaborationID', $collaborationID);

        return $stmt->execute();
    }

    public function delete($collaborationID) {
        $query = "DELETE FROM $this->table WHERE CollaborationID = :collaborationID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':collaborationID', $collaborationID);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }

        return false;
    }
}
?>

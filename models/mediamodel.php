<?php
class MediaModel {
    private $conn;
    private $table = "media";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($userID, $mediaName, $mediaType, $dateUploaded, $attributes, $positionXY) {
        $query = "INSERT INTO " . $this->table . " 
            (UserID, mediaName, mediaType, dateUploaded, Attributes, PositionXY)
            VALUES (:userID, :mediaName, :mediaType, :dateUploaded, :attributes, :positionXY)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':mediaName', $mediaName);
        $stmt->bindParam(':mediaType', $mediaType);
        $stmt->bindParam(':dateUploaded', $dateUploaded);
        $stmt->bindParam(':attributes', $attributes);
        $stmt->bindParam(':positionXY', $positionXY);

        return $stmt->execute();
    }

    public function findAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByID($mediaID) {
        $query = "SELECT * FROM " . $this->table . " WHERE MediaID = :mediaID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mediaID', $mediaID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($mediaID, $mediaName, $mediaType, $attributes, $positionXY) {
        $checkQuery = "SELECT 1 FROM " . $this->table . " WHERE MediaID = :mediaID";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':mediaID', $mediaID);
        $checkStmt->execute();
    
        if (!$checkStmt->fetch()) {
            return false;
        }

        $query = "UPDATE " . $this->table . " 
            SET mediaName = :mediaName, mediaType = :mediaType, 
                Attributes = :attributes, PositionXY = :positionXY
            WHERE MediaID = :mediaID";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':mediaName', $mediaName);
        $stmt->bindParam(':mediaType', $mediaType);
        $stmt->bindParam(':attributes', $attributes);
        $stmt->bindParam(':positionXY', $positionXY);
        $stmt->bindParam(':mediaID', $mediaID);
    
        $stmt->execute();
        return true;
    }    

    public function delete($mediaID) {
        $query = "DELETE FROM " . $this->table . " WHERE MediaID = :mediaID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mediaID', $mediaID);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
    
        return false;
    }
}
?>
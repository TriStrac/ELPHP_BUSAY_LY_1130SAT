<?php
class UserModel {
    private $conn;
    private $table = "user";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new user
    public function create($username, $email, $password, $profilePicture = null) {
        $query = "INSERT INTO " . $this->table . " 
                  (Username, Email, Password, ProfilePicture) 
                  VALUES (:username, :email, :password, :profilePicture)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':profilePicture', $profilePicture);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Get all users
    public function findAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find user by email
    public function findByEmail($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE Email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user
    public function updateUser($userID, $username, $email, $profilePicture = null) {
        // First, check if the user exists
        $checkQuery = "SELECT 1 FROM " . $this->table . " WHERE UserID = :userID";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':userID', $userID);
        $checkStmt->execute();
    
        if (!$checkStmt->fetch()) {
            return false; // User doesn't exist
        }
    
        // Proceed with update
        $query = "UPDATE " . $this->table . " 
                  SET Username = :username, Email = :email, ProfilePicture = :profilePicture 
                  WHERE UserID = :userID";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profilePicture', $profilePicture);
        $stmt->bindParam(':userID', $userID);
    
        $stmt->execute();
    
        return true;
    }

    // Delete user
    public function deleteUser($userID) {
        $query = "DELETE FROM " . $this->table . " WHERE UserID = :userID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        
        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
    
        return false;
    }
    
}
?>

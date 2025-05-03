<?php
// Include the necessary files
include_once '../models/usermodel.php';
include_once '../config/database.php';

// Create the UserController class
class UserController {

    private $userModel;

    public function __construct() {
        // Create a database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // Create a new UserModel instance
        $this->userModel = new UserModel($db);
    }

    // Method to create a new user (POST)
    public function createUser($username, $email, $password, $profilePicture = null) {
        if ($this->userModel->create($username, $email, $password, $profilePicture)) {
            echo json_encode(["message" => "User created successfully"]);
        } else {
            echo json_encode(["message" => "User creation failed"]);
        }
    }

    // Method to get all users (GET)
    public function getUsers() {
        $users = $this->userModel->findAll();
        echo json_encode($users);
    }

    // Method to get a user by email (GET)
    public function getUserByEmail($email) {
        $user = $this->userModel->findByEmail($email);
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["message" => "User not found"]);
        }
    }

    // Method to update a user (PUT)
    public function updateUser($userID, $username, $email, $profilePicture = null) {
        if ($this->userModel->updateUser($userID, $username, $email, $profilePicture)) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            echo json_encode(["message" => "User ID doesn't exist"]);
        }
    }

    // Method to delete a user (DELETE)
    public function deleteUser($userID) {
        if ($this->userModel->deleteUser($userID)) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            echo json_encode(["message" => "User ID doesn't exist"]);
        }
    }
}
?>
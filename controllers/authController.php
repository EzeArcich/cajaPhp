<?php


// controllers/AuthController.php
require_once __DIR__ . '/../config/db.php';



class authController {
    
    
    private $db;
    

    public function __construct($db) {
        $this->db = $db;
    }


    public function handleRequest() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->login();
        }
    }

    public function login() {
        $username = $_POST['email'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../dashboard.php");
        } else {
            header("Location: login.php?error=1");
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
    }
}

$authController = new AuthController($db);
$authController->handleRequest();

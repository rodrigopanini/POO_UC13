<?php

require_once __DIR__ . "/db.php";

class Auth {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($email, $senha) {
        $query = "SELECT * FROM login WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $senha == $user['senha']) {
            $_SESSION['login_id'] = $user['id'];
            $_SESSION['login_email'] = $user['email'];
            return true;
        }

        return false;
    }
}
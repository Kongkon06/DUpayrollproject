<?php
class Auth {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function login($username, $password) {
        $username = $this->db->escape($username);
        $password = hash('sha256', $password . AUTH_SALT);
        
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['last_activity'] = time();
            return true;
        }
        return false;
    }
    
    public function isLoggedIn() {
        if (isset($_SESSION['user_id']) && isset($_SESSION['last_activity'])) {
            if (time() - $_SESSION['last_activity'] < SESSION_TIMEOUT) {
                $_SESSION['last_activity'] = time();
                return true;
            }
            $this->logout();
        }
        return false;
    }
    
    public function logout() {
        session_destroy();
    }
}
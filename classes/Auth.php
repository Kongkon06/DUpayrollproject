<?php
require_once __DIR__ . '/../classes/Database.php';

class Auth {
    private $db;
    
    public function __construct() {
        try {
            $this->db = Database::getInstance();
        } catch (Exception $e) {
            error_log("Auth initialization error: " . $e->getMessage());
            throw new Exception("Authentication system initialization failed");
        }
    }
    
    private function ensureSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($email, $password) {
        try {
            $this->ensureSession();
            // Prepare statement to prevent SQL injection
            $stmt = $this->db->prepare("SELECT id, email, password, role FROM users WHERE email = ? AND is_active = 1 LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 0) {
                return [
                    'success' => false,
                    'message' => 'Invalid credentials'
                ];
            }
            
            $user = $result->fetch_assoc();
            
            if (!password_verify($password, $user['password'])) {
                return [
                    'success' => false,
                    'message' => 'Invalid credentials'
                ];
            }
            
            // Start session and store user data
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_activity'] = time();
            
            return [
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]
            ];
            
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred during login'
            ];
        }
    }

    public function logout() {
        $this->ensureSession();
        session_destroy();
        return [
            'success' => true,
            'message' => 'Logout successful'
        ];
    }
    
    public function isLoggedIn() {
        $this->ensureSession();
        return isset($_SESSION['user_id']);
    }
    
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        try {
            $stmt = $this->db->prepare("SELECT id, email, name, role FROM users WHERE id = ? AND is_active = 1");
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_assoc();
            
        } catch (Exception $e) {
            error_log("Error getting current user: " . $e->getMessage());
            return null;
        }
    }
    
    public function checkPermission($requiredRole) {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        return $_SESSION['role'] === $requiredRole;
    }
}
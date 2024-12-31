<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'payroll_management');
$database = 'payroll_management';

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->connection->connect_error) {
            $this->createDatabaseIfNotExists();
        }
        $this->connection->set_charset("utf8");
    }
    
    private function createDatabaseIfNotExists() {
        $query = "CREATE DATABASE " . $database;
        if (!$this->connection->query($query)) {
            die("Database creation failed: " . $this->connection->error);
        }
        $this->createTables();
    }

    private function createTables() {
        $queries = [
            // Employee Profile Table
            "CREATE TABLE IF NOT EXISTS Employee_Profile (
                emp_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_name VARCHAR(100) NOT NULL,
                father_name VARCHAR(100),
                mother_name VARCHAR(100),
                permanent_address TEXT,
                pin_code VARCHAR(10),
                pan_number VARCHAR(20),
                aadhaar_no VARCHAR(20),
                dob DATE,
                hire_date DATE,
                blood_group VARCHAR(5),
                email_address VARCHAR(100),
                marital_status VARCHAR(20),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Emergency Contacts Table
            "CREATE TABLE IF NOT EXISTS Emergency_Contacts (
                contact_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                contact_no VARCHAR(20),
                relationship VARCHAR(50),
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )",
            
            // Legislative Data Table
            "CREATE TABLE IF NOT EXISTS Legislative_Data (
                legis_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                block VARCHAR(100),
                constituency VARCHAR(100),
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )",
            
            // Work Profile Table
            "CREATE TABLE IF NOT EXISTS Work_Profile (
                work_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                current_designation VARCHAR(100),
                joining_date DATE,
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )",
            
            // Previous Company Details Table
            "CREATE TABLE IF NOT EXISTS Previous_Company (
                prev_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                company_name VARCHAR(100),
                previous_designation VARCHAR(100),
                years_of_service DECIMAL(4,2),
                reason_for_leaving TEXT,
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )",
            
            // Employee Skills Table
            "CREATE TABLE IF NOT EXISTS Employee_Skills (
                skill_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                skill VARCHAR(100),
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )",
            
            // Salary Profile Table
            "CREATE TABLE IF NOT EXISTS Salary_Profile (
                salary_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                provident_fund DECIMAL(10,2),
                gratuity DECIMAL(10,2),
                tax DECIMAL(10,2),
                dearness_allowance DECIMAL(10,2),
                travel_allowance DECIMAL(10,2),
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )",
            
            // Attendance Table
            "CREATE TABLE IF NOT EXISTS Attendance (
                attendance_id INT PRIMARY KEY AUTO_INCREMENT,
                emp_id INT,
                date DATE,
                absences INT DEFAULT 0,
                overtime_hours DECIMAL(4,2) DEFAULT 0,
                work_hours DECIMAL(4,2),
                FOREIGN KEY (emp_id) REFERENCES Employee_Profile(emp_id)
            )"
        ];

        foreach ($queries as $query) {
            if (!$this->connection->query($query)) {
                die("Table creation failed: " . $this->connection->error);
            }
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    // Add error method to get the last error message
    public function error() {
        return $this->connection->error;  // This will return the last error message from MySQL
    }
}


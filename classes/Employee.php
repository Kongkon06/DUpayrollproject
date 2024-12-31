<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/config.php';

class Employee {
    private static $instance = null;
    private $db;
    
    private function __construct() {
        $this->db = Database::getInstance();
        if (!$this->db) {
            die("Database connection failed");
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    
    public function createWorkProfile($data) {
        $empId = $this->db->insert_id; // Get last inserted employee ID
        $workId = $this->db->escape($data['work_id']);
        $designation = $this->db->escape($data['current_designation']);
        $joinDate = $this->db->escape($data['joining_date']);
        
        $sql = "INSERT INTO Work_Profile (emp_id, work_id, current_designation, joining_date) 
                VALUES ('$empId', '$workId', '$designation', '$joinDate')";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            error_log("Error creating employee work profile: " . $this->db->error());
            return false;
        }
    }
    
    public function createSalaryProfile($data) {
        $empId = $this->db->insert_id;
        $pf = $this->db->escape($data['provident_fund']);
        $gratuity = $this->db->escape($data['gratuity']);
        $tax = $this->db->escape($data['tax']);
        $da = $this->db->escape($data['dearness_allowance']);
        $ta = $this->db->escape($data['travel_allowance']);
        
        $sql = "INSERT INTO Salary_Profile (emp_id, provident_fund, gratuity, tax, 
                dearness_allowance, travel_allowance) 
                VALUES ('$empId', '$pf', '$gratuity', '$tax', '$da', '$ta')";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            error_log("Error creating employee salary profile: " . $this->db->error());
            return false;
        }
    }

    public function createDummy($combinedData) {
        try {
            $connection = $this->db->getConnection();
            $connection->begin_transaction();
    
            // Insert Employee Profile
            $name = $this->db->escape($combinedData['employee']['emp_name']);
            $fatherName = $this->db->escape($combinedData['employee']['father_name']);
            $motherName = $this->db->escape($combinedData['employee']['mother_name']);
            $email = $this->db->escape($combinedData['employee']['email_address']);
            $panNo = $this->db->escape($combinedData['employee']['pan_no']);
            $aadharNo = $this->db->escape($combinedData['employee']['aadhar_no']);
            $dob = $this->db->escape($combinedData['employee']['dob']);
            $hireDate = $this->db->escape($combinedData['employee']['hire_date']);
    
            $employeeSQL = "INSERT INTO Employee_Profile (
                emp_name, father_name, mother_name, email_address, 
                pan_number, aadhaar_no, dob, hire_date
            ) VALUES (
                '$name', '$fatherName', '$motherName', '$email', 
                '$panNo', '$aadharNo', '$dob', '$hireDate'
            )";
    
            if (!$connection->query($employeeSQL)) {
                throw new Exception("Error creating employee profile: " . $connection->error);
            }
    
            $empId = $connection->insert_id;
    
            // Insert Work Profile
            $workId = $this->db->escape($combinedData['work']['work_id']);
            $designation = $this->db->escape($combinedData['work']['current_designation']);
            $joinDate = $this->db->escape($combinedData['work']['joining_date']);
    
            $workSQL = "INSERT INTO Work_Profile (
                emp_id, work_id, current_designation, joining_date
            ) VALUES (
                '$empId', '$workId', '$designation', '$joinDate'
            )";
    
            if (!$connection->query($workSQL)) {
                throw new Exception("Error creating work profile: " . $connection->error);
            }
    
            // Insert Salary Profile
            $pf = $this->db->escape($combinedData['salary']['provident_fund']);
            $gratuity = $this->db->escape($combinedData['salary']['gratuity']);
            $tax = $this->db->escape($combinedData['salary']['tax']);
            $da = $this->db->escape($combinedData['salary']['dearness_allowance']);
            $ta = $this->db->escape($combinedData['salary']['travel_allowance']);
    
            $salarySQL = "INSERT INTO Salary_Profile (
                emp_id, provident_fund, gratuity, tax, 
                dearness_allowance, travel_allowance
            ) VALUES (
                '$empId', '$pf', '$gratuity', '$tax', '$da', '$ta'
            )";
    
            if (!$connection->query($salarySQL)) {
                throw new Exception("Error creating salary profile: " . $connection->error);
            }
    
            // If all queries succeeded, commit the transaction
            $connection->commit();
            return true;
    
        } catch (Exception $e) {
            // If any error occurs, rollback the transaction
            if (isset($connection)) {
                $connection->rollback();
            }
            error_log("Error creating employee: " . $e->getMessage());
            return false;
        }
    }

    public function getAll($page = 1, $limit = ITEMS_PER_PAGE) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM Employee_Profile LIMIT $offset, $limit";
        return $this->db->query($sql);
    }
    
    public function getById($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM Employee_Profile WHERE emp_id = '$id'";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    
    public function create($data) {
        $name = $this->db->escape($data['emp_name']);
        $fatherName = $this->db->escape($data['father_name']);
        $motherName = $this->db->escape($data['mother_name']);
        $panNo = $this->db->escape($data['pan_no']);
        $aadharNo = $this->db->escape($data['aadhar_no']);
        $dob = $this->db->escape($data['dob']); 
        $hireDate = $this->db->escape($data['hire_date']); 
        $email = $this->db->escape($data['email_address']);
        
        $sql = "INSERT INTO Employee_Profile (
                    emp_name, father_name, mother_name, pan_number, 
                    aadhaar_no, dob, hire_date, email_address
                ) VALUES (
                    '$name', '$fatherName', '$motherName', '$panNo', 
                    '$aadharNo', '$dob', '$hireDate', '$email'
                )";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            error_log("Error creating employee: " . $this->db->error());
            return false;
        }
    }
    
    public function update($data) {
        $id = $this->db->escape($data['id']);
        $name = $this->db->escape($data['emp_name']);
        $fatherName = $this->db->escape($data['father_name']);
        $motherName = $this->db->escape($data['mother_name']);
        $email = $this->db->escape($data['email_address']);
        $panNo = $this->db->escape($data['pan_no']);
        $aadharNo = $this->db->escape($data['aadhar_no']);
        $dob = $this->db->escape($data['dob']);
        $hireDate = $this->db->escape($data['hire_date']);
        
        $sql = "UPDATE employee_profile SET 
                emp_name = '$name',
                father_name = '$fatherName',
                mother_name = '$motherName',
                email_address = '$email',
                pan_number = '$panNo',
                aadhaar_no = '$aadharNo',
                dob = '$dob',
                hire_date = '$hireDate'
                WHERE emp_id = '$id'";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            error_log("Error updating employee: " . $this->db->error());
            return false;
        }
    }
    
    public function search($term = '') {
        $term = $this->db->escape($term);
        $sql = "SELECT ep.*, wp.current_designation 
        FROM Employee_Profile ep
        LEFT JOIN Work_Profile wp ON ep.emp_id = wp.emp_id";
        
        if (!empty($term)) {
            $sql .= " WHERE ep.emp_name LIKE '%$term%' 
                      OR ep.email_address LIKE '%$term%' 
                      OR wp.current_designation LIKE '%$term%'";
        }
        
        $result = $this->db->query($sql);
        if (!$result) {
            error_log("Error searching employees: " . $this->db->error());
            return [];
        }
        
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        return $employees;
    }

    public function getTotalCount() {
        $sql = "SELECT COUNT(*) as total FROM Employee_Profile";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function delete($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM Employee_Profile WHERE emp_id = '$id'";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            error_log("Error deleting employee: " . $this->db->error());
            return false;
        }
    }
    public function updateAll($employeeData, $workData, $salaryData) {
        try {
            $connection = $this->db->getConnection();
            $connection->begin_transaction();

            // Update Employee Profile
            $empId = $this->db->escape($employeeData['id']);
            $name = $this->db->escape($employeeData['emp_name']);
            $fatherName = $this->db->escape($employeeData['father_name']);
            $email = $this->db->escape($employeeData['email_address']);
            $address = $this->db->escape($employeeData['permanent_address']);

            $employeeQuery = "UPDATE Employee_Profile SET 
                emp_name = '$name',
                father_name = '$fatherName',
                email_address = '$email',
                permanent_address = '$address'
                WHERE emp_id = '$empId'";

            // Execute employee update
            if (!$connection->query($employeeQuery)) {
                throw new Exception("Error updating employee record: " . $connection->error);
            }
            
            $position = $this->db->escape($workData['current_designation']);
            $joinDate = $this->db->escape($workData['join_date']);
            echo $joinDate;
            $workQuery =  "UPDATE Work_Profile SET 
                        current_designation = '$position'
                         WHERE emp_id = $empId";
            
            if (!$connection->query($workQuery)) {
                throw new Exception("Error updating employee record: " . $connection->error);
            }
            
            
            $connection->commit();
            return [
                'status' => true,
                'message' => 'Employee updated successfully'
            ];

        } catch (Exception $e) {
            // If any error occurs, rollback the transaction
            if (isset($connection)) {
                $connection->rollback();
            }

            return [
                'status' => false,
                'message' => 'Error updating employee data: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ];
        }
    }

}
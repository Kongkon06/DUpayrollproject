<?php
class Salary {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function calculateSalary($empId, $month, $year) {
        $empId = $this->db->escape($empId);
        
        // Get basic salary details
        $sql = "SELECT * FROM Salary_Profile WHERE emp_id = '$empId'";
        $salary = $this->db->query($sql)->fetch_assoc();
        
        // Get attendance
        $sql = "SELECT SUM(work_hours) as total_hours, SUM(overtime_hours) as total_overtime 
                FROM Attendance 
                WHERE emp_id = '$empId' 
                AND MONTH(date) = '$month' 
                AND YEAR(date) = '$year'";
        $attendance = $this->db->query($sql)->fetch_assoc();
        
        // Calculate final salary
        // Add your salary calculation logic here
        
        return [
            'basic' => $salary['basic_salary'] ?? 0,
            'allowances' => [
                'da' => $salary['dearness_allowance'] ?? 0,
                'travel' => $salary['travel_allowance'] ?? 0
            ],
            'deductions' => [
                'pf' => $salary['provident_fund'] ?? 0,
                'tax' => $salary['tax'] ?? 0
            ],
            'overtime' => $attendance['total_overtime'] ?? 0
        ];
    }
}
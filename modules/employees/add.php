<?php
require_once '../../config/config.php';
require_once '../../classes/Employee.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee = Employee::getInstance();
    if ($employee->create($_POST)) {
        header('Location: list.php?success=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <h2>Add New Employee</h2>
        <form method="POST">
    <div class="form-group">
        <label>Employee Name</label>
        <input type="text" name="emp_name" required>
    </div>
    <div class="form-group">
        <label>Father's Name</label>
        <input type="text" name="father_name" required>
    </div>
    <div class="form-group">
        <label>Mother's Name</label>
        <input type="text" name="mother_name" required>
    </div>
    <div class="form-group">
        <label>PAN Number</label>
        <input type="text" name="pan_no" required>
    </div>
    <div class="form-group">
        <label>Aadhar Number</label>
        <input type="text" name="aadhar_no" required>
    </div>
    <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" required>
    </div>
    <div class="form-group">
        <label>Hire Date</label>
        <input type="date" name="hire_date" required>
    </div>
    <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email_address" required>
    </div>
    <button type="submit">Add Employee</button>
</form>

    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
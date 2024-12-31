<?php
require_once '../../config/config.php';
require_once '../../classes/Employee.php';
require_once '../../classes/Salary.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $salary = new Salary();
    $calculation = $salary->calculateSalary(
        $_POST['emp_id'],
        $_POST['month'],
        $_POST['year']
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calculate Salary - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container">
        <h2>Calculate Salary</h2>
        <?php
include '../../includes/header.php'; 
$employee = Employee::getInstance();
$list = $employee->getAll();

$form = '<div class="container">
            <h2>Calculate Salary</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Employee</label>
                    <select name="emp_id" required>';

while($row = $list->fetch_assoc()){
    $form .= '<option value="' . $row["emp_id"] . '">' . $row["emp_name"] . '</option>';
}

$form .= '  </select>
            </div>
            <div class="form-group">
                <label>Month</label>
                <input type="month" name="salary_month" required>
            </div>
            <button type="submit">Calculate</button>
        </form>
    </div>';

echo $form;
?>
        
        <?php if (isset($calculation)): ?>
            <!-- Display calculation results -->
        <?php endif; ?>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
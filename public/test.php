<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="flex justify-center">
        <ul class="flex text-xl gap-10 p-4 text-slate-950">
            <li><a href="admin.php">Add data</a></li>
            <li><a href="index.php">Empoylee table</a></li>
            <li><a href="edit.php">Admin Page</a></li>
            <li><a href="report.php">Payroll</a></li>
        </ul>
    </div>
    <div class="flex mt-4 justify-center items-center gap-10">
        <label for="column">How many entries do you want to add?</label>
        <input id="column" name="column" class="p-2 border-2 border-gray-300" type="number" placeholder="0" min="1" required />
        <button onclick="createTable()" class="p-2 bg-indigo-500 text-white">Submit</button>
        <form action="" method="post" class="inline">
            <input type="hidden" name="generate_dummy" value="1">
            <button type="submit" class="p-2 bg-green-500 text-white">Generate Dummy Data</button>
        </form>
    </div>
    <div id="table-container" class="mt-8 flex justify-center"></div>

    <script>
        function createTable() {
            const column = document.getElementById('column').value;
            const tableContainer = document.getElementById('table-container');
            tableContainer.innerHTML = ''; // Clear previous table if any

            if (column <= 0) {
                alert('Please enter a valid number greater than 0.');
                return;
            }

            let table = '<form action="" method="post">';
            table += `<input type="hidden" name="column" value="${column}">`;  // Include the column value as a hidden input field
            table += '<table class="min-w-full bg-white">';
            table += '<thead><tr>';
            table += '<th class="py-2 px-4 border-b">Row Number</th>';
            table += '<th class="py-2 px-4 border-b">Name</th>';
            table += '<th class="py-2 px-4 border-b">Father</th>';
            table += '<th class="py-2 px-4 border-b">Mother</th>';
            table += '<th class="py-2 px-4 border-b">Email</th>';
            table += '<th class="py-2 px-4 border-b">Pan number</th>';
            table += '<th class="py-2 px-4 border-b">Adhaar number</th>';
            table += '<th class="py-2 px-4 border-b">D.O.B</th>';
            table += '<th class="py-2 px-4 border-b">Hire Date</th>';
            table += '</tr></thead>';
            table += '<tbody>';

            for (let i = 0; i < column; i++) {
                table += '<tr>';
                table += `<td class="py-2 px-4 border-b">${i + 1}</td>`;
                table += `<td class="py-2 px-4 border-b"><input type="text" name="name${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Name ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="text" name="father${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Father ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="text" name="mother${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Mother ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="email" name="email${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Email ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="text" name="pan${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Pan ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="text" name="aadhaar${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Adhaar ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="date" name="dob${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Mother ${i + 1}" required /></td>`;
                table += `<td class="py-2 px-4 border-b"><input type="date" name="hire_date${i + 1}" class="p-2 border-2 border-gray-300" placeholder="Hire Date ${i + 1}" required /></td>`;
                table += '</tr>';
            }

            table += '</tbody></table>';
            table += '<div class="flex mt-4 justify-center">';
            table += '<button type="submit" class="p-2 bg-indigo-500 text-slate-200">Submit</button>';
            table += '</div>';
            table += '</form>';

            tableContainer.innerHTML = table;
        }
    </script>
    <?php
    require_once __DIR__ . '/../classes/Employee.php';

    // Handle dummy data generation
    if (isset($_POST['generate_dummy'])) {
        require_once 'generate_dummy_data.php';
        generateDummyData(10); // Generate 10 dummy records
        echo "<script>alert('Dummy data generated successfully!');</script>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['generate_dummy'])) {
        $employee = Employee::getInstance();

        // Extract column count from the hidden input
        $columnCount = (int)$_POST['column'];

        for ($i = 1; $i <= $columnCount; $i++) {
            $data = [
                'emp_name' => $_POST["name$i"],
                'father_name' => $_POST["father$i"],
                'mother_name' => $_POST["mother$i"],
                'email_address' => $_POST["email$i"],
                'pan_no' => $_POST["pan$i"],
                'aadhar_no' => $_POST["aadhaar$i"],
                'dob' => $_POST["dob$i"],
                'hire_date' => $_POST["hire_date$i"],
            ];

            // Validate fields
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    die("Error: Missing $key for row $i.");
                }
            }

            // Insert data
            if (!$employee->create($data)) {
                die("Error inserting data for row $i.");
            }
        }
        exit;
    }
    ?>
</body>
    <?php
    require_once __DIR__ . '/../classes/Employee.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee = Employee::getInstance();

    // Extract column count from the hidden input
    $columnCount = (int)$_POST['column'];

    for ($i = 1; $i <= $columnCount; $i++) {
        $data = [
            'emp_name' => $_POST["name$i"],
            'father_name' => $_POST["father$i"],
            'mother_name' => $_POST["mother$i"],
            'email_address' => $_POST["email$i"],
            'pan_no' => $_POST["pan$i"],
            'aadhar_no' => $_POST["aadhaar$i"],
            'dob' => $_POST["dob$i"],
            'hire_date' => $_POST["hire_date$i"],
        ];

        // Validate fields
        foreach ($data as $key => $value) {
            if (empty($value)) {
                die("Error: Missing $key for row $i.");
            }
        }

        // Insert data
        if (!$employee->create($data)) {
            die("Error inserting data for row $i.");
        }
    }
    exit;
}
?>
</body>
</html>
<?php
require_once '../classes/Employee.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    function generateDummyData($count = 10) {
        $employee = Employee::getInstance();
        
        // Arrays for random data generation
        $firstNames = ['John', 'Jane', 'Michael', 'Sarah', 'David', 'Emma', 'Robert', 'Lisa', 'William', 'Mary', 
                       'Raj', 'Priya', 'Amit', 'Sneha', 'Rahul', 'Neha', 'Suresh', 'Anjali'];
        
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Kumar', 
                      'Singh', 'Patel', 'Sharma', 'Verma', 'Gupta'];
        
        $designations = ['Software Engineer', 'Project Manager', 'Business Analyst', 'HR Manager', 
                         'Sales Executive', 'Marketing Manager', 'System Administrator', 'Team Lead',
                         'Quality Analyst', 'Technical Writer'];
    
        for ($i = 1; $i <= $count; $i++) {
            // Generate random names
            $empName = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
            $fatherName = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
            $motherName = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
            
            // Generate random email
            $email = strtolower(str_replace(' ', '.', $empName)) . rand(100, 999) . '@example.com';
            
            // Generate PAN (Format: AAAAA9999A)
            $pan = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . 
                   chr(rand(65, 90)) . chr(rand(65, 90)) . 
                   rand(1000, 9999) . chr(rand(65, 90));
            
            // Generate Aadhaar (12 digits)
            $aadhaar = sprintf('%012d', rand(100000000000, 999999999999));
            
            // Generate dates
            $dob = date('Y-m-d', strtotime('-' . rand(25, 45) . ' years'));
            $hireDate = date('Y-m-d', strtotime('-' . rand(1, 10) . ' years'));
            
            // Generate Work ID (Format: EMP followed by 4 digits)
            $workId = 'EMP' . sprintf('%04d', $i);
            
            // Generate random salary components
            $baseSalary = rand(300000, 1500000);
            $pf = $baseSalary * 0.12;  // 12% of base salary
            $gratuity = $baseSalary * 0.0481;  // 4.81% of base salary
            $tax = $baseSalary * rand(10, 30) / 100;  // 10-30% of base salary
            $da = $baseSalary * 0.1;  // 10% of base salary
            $ta = rand(24000, 60000);  // 2000-5000 per month
    
            $combinedData = [
                'employee' => [
                    'emp_name' => $empName,
                    'father_name' => $fatherName,
                    'mother_name' => $motherName,
                    'email_address' => $email,
                    'pan_no' => $pan,
                    'aadhar_no' => $aadhaar,
                    'dob' => $dob,
                    'hire_date' => $hireDate
                ],
                'work' => [
                    'work_id' => $workId,
                    'current_designation' => $designations[array_rand($designations)],
                    'joining_date' => $hireDate
                ],
                'salary' => [
                    'provident_fund' => round($pf, 2),
                    'gratuity' => round($gratuity, 2),
                    'tax' => round($tax, 2),
                    'dearness_allowance' => round($da, 2),
                    'travel_allowance' => round($ta, 2)
                ]
            ];
    
            try {
                if (!$employee->createDummy($combinedData)) {
                    echo "Error inserting dummy data for record $i<br>";
                } else {
                    echo "Successfully inserted dummy data for record $i<br>";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    // Generate 20 dummy records
    generateDummyData(20);
}

echo "Dummy data generation complete!";
?>
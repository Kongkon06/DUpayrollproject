<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 ">
<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-center">
            <ul class="flex items-center space-x-8 py-4">
                <li>
                    <a href="admin.php" class="text-gray-800 hover:text-blue-600 px-3 py-2 rounded-md text-lg font-medium transition duration-300 ease-in-out">
                        Add Data
                    </a>
                </li>
                <li>
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 px-3 py-2 rounded-md text-lg font-medium transition duration-300 ease-in-out">
                        Employee Table
                    </a>
                </li>
                <li>
                    <a href="edit.php" class="text-gray-800 hover:text-blue-600 px-3 py-2 rounded-md text-lg font-medium transition duration-300 ease-in-out">
                        Admin Page
                    </a>
                </li>
                <li>
                    <a href="report.php" class="text-gray-800 hover:text-blue-600 px-3 py-2 rounded-md text-lg font-medium transition duration-300 ease-in-out">
                        Payroll
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="flex mt-4 justify-center items-center gap-10">
        <label for="column">How many entries do you want to add?</label>
        <input id="column" name="column" class="p-2 border-2 border-gray-300" type="number" placeholder="0" min="1" required />
        <button onclick="createTable()" class="p-2 bg-indigo-500 text-white">Submit</button>
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
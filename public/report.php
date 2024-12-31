<?php
require_once '../classes/Employee.php';
require_once '../config/database.php';

$selectedFields = []; // Ensure the variable is initialized

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = isset($_POST['field']) ? $_POST['field'] : [];
    $emp = [];
    $salary = [];
    $work = [];

    // Categorize fields
    foreach ($data as $field) {
        switch ($field) {
            case 'emp_id':
            case 'emp_name':
            case 'email_address':
                $emp[] = $field;
                break;
            case 'tax':
            case 'travel_allowance':
            case 'dearness_allowance':
            case 'provident_fund':
                $salary[] = $field;
                break;
            case 'designation':
            case 'joining_date':
            case 'current_designation':
                $work[] = $field;
                break;
        }
    }

    // Combine all selected fields into a single array
    $selectedFields = array_merge($emp, $salary, $work);

    // Build SQL query
    if (!empty($selectedFields)) {
        $select_clause = [];
        $from_clause = 'employee_profile';
        $join_clause = [];

        foreach ($emp as $field) {
            $select_clause[] = "employee_profile.$field";
        }

        if (!empty($salary)) {
            $join_clause[] = "LEFT JOIN salary_profile ON employee_profile.emp_id = salary_profile.emp_id";
            foreach ($salary as $field) {
                $select_clause[] = "salary_profile.$field";
            }
        }

        if (!empty($work)) {
            $join_clause[] = "LEFT JOIN work_profile ON employee_profile.emp_id = work_profile.emp_id";
            foreach ($work as $field) {
                $select_clause[] = "work_profile.$field";
            }
        }

        $sql = "SELECT " . implode(', ', $select_clause) . 
               " FROM " . $from_clause . " " .
               implode(' ', $join_clause);

        try {
            $db = Database::getInstance();
            $result = $db->query($sql);
            $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        } catch (Exception $e) {
            $error = "An error occurred while fetching the data: " . $e->getMessage();
        }
    } else {
        $error = "No fields selected.";
        $rows = [];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Report Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
require_once '../classes/Employee.php';
require_once '../config/database.php';

$selectedFields = []; // Initialize variable
$filters = []; // Store filter conditions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = isset($_POST['field']) ? $_POST['field'] : [];
    $emp = [];
    $salary = [];
    $work = [];

    // Categorize fields
    foreach ($data as $field) {
        switch ($field) {
            case 'emp_id':
            case 'emp_name':
            case 'email_address':
                $emp[] = $field;
                break;
            case 'tax':
            case 'travel_allowance':
            case 'dearness_allowance':
            case 'provident_fund':
                $salary[] = $field;
                break;
            case 'designation':
            case 'joining_date':
            case 'current_designation':
                $work[] = $field;
                break;
        }
    }

    // Combine selected fields
    $selectedFields = array_merge($emp, $salary, $work);

    // Build SQL query with filtering
    if (!empty($selectedFields)) {
        $select_clause = [];
        $from_clause = 'employee_profile';
        $join_clause = [];
        $where_conditions = [];
        $params = [];

        foreach ($emp as $field) {
            $select_clause[] = "employee_profile.$field";
        }

        // Handle employee ID filter
        if (in_array('emp_id', $emp)) {
            if (!empty($_POST['min_emp_id'])) {
                $where_conditions[] = "employee_profile.emp_id >= ?";
                $params[] = $_POST['min_emp_id'];
            }
            if (!empty($_POST['max_emp_id'])) {
                $where_conditions[] = "employee_profile.emp_id <= ?";
                $params[] = $_POST['max_emp_id'];
            }
        }

        if (!empty($salary)) {
            $join_clause[] = "LEFT JOIN salary_profile ON employee_profile.emp_id = salary_profile.emp_id";
            foreach ($salary as $field) {
                $select_clause[] = "salary_profile.$field";
                
                // Handle numeric filters for salary fields
                if (!empty($_POST["min_$field"])) {
                    $where_conditions[] = "salary_profile.$field >= ?";
                    $params[] = $_POST["min_$field"];
                }
                if (!empty($_POST["max_$field"])) {
                    $where_conditions[] = "salary_profile.$field <= ?";
                    $params[] = $_POST["max_$field"];
                }
            }
        }

        if (!empty($work)) {
            $join_clause[] = "LEFT JOIN work_profile ON employee_profile.emp_id = work_profile.emp_id";
            foreach ($work as $field) {
                $select_clause[] = "work_profile.$field";
            }
            
            // Handle designation filter
            if (!empty($_POST['designation'])) {
                $where_conditions[] = "work_profile.current_designation = ?";
                $params[] = $_POST['designation'];
            }
            
            // Handle joining date filter
            if (!empty($_POST['joining_date'])) {
                $where_conditions[] = "work_profile.joining_date = ?";
                $params[] = $_POST['joining_date'];
            }
        }

        $sql = "SELECT " . implode(', ', $select_clause) . 
               " FROM " . $from_clause . " " .
               implode(' ', $join_clause);

        if (!empty($where_conditions)) {
            $sql .= " WHERE " . implode(' AND ', $where_conditions);
        }

        try {
            $db = Database::getInstance();
            $stmt = $db->prepare($sql);
            
            if (!empty($params)) {
                $types = str_repeat('s', count($params)); // Assume all strings for simplicity
                $stmt->bind_param($types, ...$params);
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
            $stmt->close();
        } catch (Exception $e) {
            $error = "An error occurred while fetching the data: " . $e->getMessage();
        }
    } else {
        $error = "No fields selected.";
        $rows = [];
    }
}
?>
<body class="bg-gray-50">
     <!-- Navigation Menu -->
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
    <div class="max-w-7xl mx-auto">

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($rows)): ?>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex justify-between items-center p-6 border-b">
                    <h2 class="text-2xl font-bold">Generated Report</h2>
                    <button onclick="exportToCSV()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                        Export to CSV
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table id="reportTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <?php foreach ($selectedFields as $field): ?>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <?= htmlspecialchars(str_replace('_', ' ', $field)) ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($rows as $row): ?>
                                <tr class="hover:bg-gray-50">
                                    <?php foreach ($selectedFields as $field): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-field="<?= htmlspecialchars($field) ?>">
                                            <?= htmlspecialchars($row[$field] ?? 'N/A') ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <script>
            // Function to export table data to CSV
            function exportToCSV() {
                const table = document.getElementById('reportTable');
                let csv = [];
                
                // Get headers
                let headers = [];
                table.querySelectorAll('thead th').forEach(th => {
                    headers.push('"' + th.textContent.trim() + '"');
                });
                csv.push(headers.join(','));
                
                // Get data
                table.querySelectorAll('tbody tr').forEach(tr => {
                    let row = [];
                    tr.querySelectorAll('td').forEach(td => {
                        row.push('"' + td.textContent.trim() + '"');
                    });
                    csv.push(row.join(','));
                });
                
                // Download CSV file
                const csvContent = csv.join('\n');
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.setAttribute('download', 'report.csv');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            // Handle form submission
            document.getElementById('reportForm').addEventListener('submit', function(e) {
                const checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
                if (checkedBoxes.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one field to generate the report.');
                }
            });

            // Toggle filter fields visibility
            document.querySelectorAll('.toggle-input').forEach((checkbox) => {
                checkbox.addEventListener('change', (e) => {
                    const target = document.getElementById(e.target.dataset.target);
                    if (target) {
                        target.classList.toggle('hidden', !e.target.checked);
                    }
                });
            });
        </script>
    </div>
    <div class="flex justify-center my-3 text-2xl">Custom Report Generator</div>
    
    <div class="max-w-7xl mx-auto">
        <form method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Employee Details -->
                <div class="space-y-4">
                    <h3 class="font-medium">Employee Details</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="field[]" value="emp_id" class="toggle-input rounded text-blue-500" data-target="emp-id-fields">
                                <span>Employee ID</span>
                            </label>
                            <div id="emp-id-fields" class="hidden mt-2 space-y-2 pl-6">
                                <input type="number" name="min_emp_id" class="w-full p-2 border rounded" placeholder="Min Employee ID">
                                <input type="number" name="max_emp_id" class="w-full p-2 border rounded" placeholder="Max Employee ID">
                            </div>
                        </div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="field[]" value="emp_name" class="rounded text-blue-500">
                            <span>Name</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="field[]" value="email_address" class="rounded text-blue-500">
                            <span>Email</span>
                        </label>
                    </div>
                </div>

                <!-- Salary Details -->
                <div class="space-y-4">
                    <h3 class="font-medium">Salary Details</h3>
                    <div class="space-y-3">
                        <?php foreach(['tax', 'travel_allowance', 'provident_fund'] as $field): ?>
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="field[]" value="<?= $field ?>" class="toggle-input rounded text-blue-500" data-target="<?= $field ?>-fields">
                                <span><?= ucwords(str_replace('_', ' ', $field)) ?></span>
                            </label>
                            <div id="<?= $field ?>-fields" class="hidden mt-2 space-y-2 pl-6">
                                <input type="number" name="min_<?= $field ?>" class="w-full p-2 border rounded" placeholder="Min <?= ucwords(str_replace('_', ' ', $field)) ?>">
                                <input type="number" name="max_<?= $field ?>" class="w-full p-2 border rounded" placeholder="Max <?= ucwords(str_replace('_', ' ', $field)) ?>">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Work Profile -->
                <div class="space-y-4">
                    <h3 class="font-medium">Work Profile</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="field[]" value="current_designation" class="toggle-input rounded text-blue-500" data-target="designation-fields">
                                <span>Designation</span>
                            </label>
                            <div id="designation-fields" class="hidden mt-2 pl-6">
                                <select name="designation" class="w-full p-2 border rounded">
                                    <option value="">Select Designation</option>
                                    <option value="manager">Manager</option>
                                    <option value="developer">Marketing Manager</option>
                                    <option value="analyst">CEO</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="field[]" value="joining_date" class="toggle-input rounded text-blue-500" data-target="joining-date-fields">
                                <span>Joining Date</span>
                            </label>
                            <div id="joining-date-fields" class="hidden mt-2 pl-6">
                                <input type="date" name="joining_date" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-6 bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition-colors">
                Generate Report
            </button>
        </form>

        <?php if (isset($error)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (!empty($rows)): ?>
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <h2 class="text-2xl font-bold p-6 border-b">Generated Report</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <?php foreach ($selectedFields as $field): ?>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <?= htmlspecialchars(str_replace('_', ' ', $field)) ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($rows as $row): ?>
                        <tr class="hover:bg-gray-50">
                            <?php foreach ($selectedFields as $field): ?>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($row[$field] ?? 'N/A') ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<script>
    document.querySelectorAll('.filter-input').forEach(input => {
        input.addEventListener('input', () => {
            const rows = document.querySelectorAll('#data-table tbody tr');
            rows.forEach(row => {
                let show = true;
                document.querySelectorAll('.filter-input').forEach(filter => {
                    const field = filter.classList[1].split('-')[1]; // Extract field name
                    const value = parseFloat(filter.value);
                    const cell = row.querySelector(`[data-field="${field}"]`);
                    const cellValue = parseFloat(cell?.textContent) || 0;

                    if (filter.classList.contains(`min-${field}`) && value && cellValue < value) {
                        show = false;
                    }
                    if (filter.classList.contains(`max-${field}`) && value && cellValue > value) {
                        show = false;
                    }
                });
                row.style.display = show ? '' : 'none';
            });
        });
    });
</script>

    </div>

    <script>
        document.querySelectorAll('.toggle-input').forEach((checkbox) => {
            checkbox.addEventListener('change', (e) => {
                const target = document.getElementById(e.target.dataset.target);
                if (target) {
                    target.classList.toggle('hidden', !e.target.checked);
                }
            });
        });
    </script>
</body>
</html>
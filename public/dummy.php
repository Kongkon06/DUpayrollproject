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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Report Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
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
        <form method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-sm" id="reportForm">
            <!-- [Previous form fields remain the same] -->
        </form>

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
</body>
</html>
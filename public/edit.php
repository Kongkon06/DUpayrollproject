<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
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

    <!-- Search Form -->
    <div class="max-w-6xl mx-auto mt-8">
        <form action="" method="GET" class="mb-8">
            <div class="flex gap-4">
                <input type="text" name="search" placeholder="Search by name or email" 
                    class="flex-1 p-2 border-2 border-gray-300 rounded"
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded">Search</button>
            </div>
        </form>

        <?php
        require_once __DIR__ . '/../classes/Employee.php';
        $employee = Employee::getInstance();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            // Handle Employee Profile Update
           // In edit.php, modify the data arrays to match the expected keys:

// Handle Employee Profile Update
$employeeData = [
    'id' => $_POST['emp_id'],
    'emp_name' => $_POST['emp_name'],
    'father_name' => $_POST['father_name'],
    'mother_name' => $_POST['mother_name'],
    'email_address' => $_POST['email_address'],
    'pan_number' => $_POST['pan_no'],         // Changed from pan_no to pan_number
    'permanent_address' => $_POST['permanent_address'],
    'aadhaar_no' => $_POST['aadhaar_no'],      // Changed from aadhar_no to aadhaar_no
    'dob' => $_POST['dob'],
    'hire_date' => $_POST['hire_date'],
    'phone' => $_POST['phone'] ?? ''          // Added missing phone field
];

// Handle Work Profile Update
$workData = [
    'emp_id' => $_POST['emp_id'],
    'current_designation' => $_POST['current_designation'],
    'join_date' => $_POST['joining_date'],    // Changed from joining_date to join_date
    'department' => $_POST['department'] ?? '' // Added missing department field
];

// Handle Salary Profile Update
$salaryData = [
    'emp_id' => $_POST['emp_id'],
    'base_salary' => $_POST['base_salary'] ?? 0,     // Added missing base_salary
    'allowance' => $_POST['allowance'] ?? 0,         // Added missing allowance
    'deductions' => $_POST['deductions'] ?? 0,       // Added missing deductions
    'provident_fund' => $_POST['provident_fund'],
    'gratuity' => $_POST['gratuity'],
    'tax' => $_POST['tax'],
    'dearness_allowance' => $_POST['dearness_allowance'],
    'travel_allowance' => $_POST['travel_allowance']
];

            if ($employee->updateAll($employeeData, $workData, $salaryData)) {
                echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">Employee information updated successfully!</div>';
            } else {
                echo '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">Error updating employee information.</div>';
            }
        }

        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $employees = $employee->search($searchTerm);
        ?>

        <!-- Employee List -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Designation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($employees as $emp): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($emp['emp_name']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($emp['email_address']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($emp['current_designation'] ?? 'N/A'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($emp)); ?>)"
                                class="bg-blue-500 text-white px-4 py-2 rounded">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Enhanced Edit Modal with Tabs -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Edit Employee Information</h2>
                    
                    <!-- Tabs -->
                    <div class="border-b border-gray-200">
                        <nav class="flex gap-7 text-indigo-500 -mb-px">
                            <button onclick="switchTab('personal')" id="personal-tab" class="tab-btn active-tab">
                                Personal Details
                            </button>
                            <button onclick="switchTab('work')" id="work-tab" class="tab-btn">
                                Work Profile
                            </button>
                            <button onclick="switchTab('salary')" id="salary-tab" class="tab-btn">
                                Salary Details
                            </button>
                        </nav>
                    </div>

                    <form action="" method="POST">
                        <input type="hidden" name="emp_id" id="emp_id">
                        
                        <!-- Personal Details Tab -->
                        <div id="personal-content" class="tab-content">
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block mb-2">Name</label>
                                    <input type="text" name="emp_name" id="emp_name" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Father's Name</label>
                                    <input type="text" name="father_name" id="father_name" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Mother's Name</label>
                                    <input type="text" name="mother_name" id="mother_name" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Email</label>
                                    <input type="email" name="email_address" id="email_address" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">PAN Number</label>
                                    <input type="text" name="pan_no" id="pan_no" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Address</label>
                                    <input type="text" name="permanent_address" id="permanent_address" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Aadhaar Number</label>
                                    <input type="text" name="aadhaar_no" id="aadhaar_no" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" 
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Hire Date</label>
                                    <input type="date" name="hire_date" id="hire_date" 
                                        class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>

                        <!-- Work Profile Tab -->
                        <div id="work-content" class="tab-content hidden">
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block mb-2">Current Designation</label>
                                    <input type="text" name="current_designation" id="current_designation"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Joining Date</label>
                                    <input type="date" name="joining_date" id="joining_date"
                                        class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>

                        <!-- Salary Details Tab -->
                        <div id="salary-content" class="tab-content hidden">
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block mb-2">Provident Fund</label>
                                    <input type="number" name="provident_fund" id="provident_fund" step="0.01"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Gratuity</label>
                                    <input type="number" name="gratuity" id="gratuity" step="0.01"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Tax</label>
                                    <input type="number" name="tax" id="tax" step="0.01"
                                        class="w-full p-2 border rounded">
                                </div>

                                <!-- Add to Salary Details Tab -->
                                <div>
                                    <label class="block mb-2">Base Salary</label>
                                    <input type="number" name="base_salary" id="base_salary" step="0.01"
                                           class="w-full p-2 border rounded">
                                </div>
                                <div>
                                <label class="block mb-2">Allowance</label>
                                <input type="number" name="allowance" id="allowance" step="0.01"
                                      class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Deductions</label>
                                    <input type="number" name="deductions" id="deductions" step="0.01"
                                           class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Dearness Allowance</label>
                                    <input type="number" name="dearness_allowance" id="dearness_allowance" step="0.01"
                                        class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block mb-2">Travel Allowance</label>
                                    <input type="number" name="travel_allowance" id="travel_allowance" step="0.01"
                                        class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-4">
                            <button type="button" onclick="closeEditModal()"
                                class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                            <button type="submit" name="update"
                                class="px-4 py-2 bg-blue-500 text-white rounded">Update All</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .tab-btn {
            @apply px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300;
        }
        .active-tab {
            @apply border-b-2 border-blue-500 text-blue-600;
        }
    </style>

    <script>
        function openEditModal(employee) {
            document.getElementById('editModal').classList.remove('hidden');
            
            // Personal Details
            document.getElementById('emp_id').value = employee.emp_id;
            document.getElementById('emp_name').value = employee.emp_name;
            document.getElementById('father_name').value = employee.father_name;
            document.getElementById('mother_name').value = employee.mother_name;
            document.getElementById('email_address').value = employee.email_address;
            document.getElementById('permanent_address').value = employee.permanent_address;
            document.getElementById('pan_no').value = employee.pan_number;
            document.getElementById('aadhaar_no').value = employee.aadhaar_no;
            document.getElementById('dob').value = employee.dob;
            document.getElementById('hire_date').value = employee.hire_date;
            
            // Work Profile
            document.getElementById('current_designation').value = employee.current_designation || '';
            document.getElementById('joining_date').value = employee.joining_date || '';
            
            // Salary Details
            document.getElementById('provident_fund').value = employee.provident_fund || '';
            document.getElementById('base_salary').value = employee.base_salary || '';
            document.getElementById('gratuity').value = employee.gratuity || '';
            document.getElementById('tax').value = employee.tax || '';
            document.getElementById('dearness_allowance').value = employee.dearness_allowance || '';
            document.getElementById('travel_allowance').value = employee.travel_allowance || '';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show selected tab content
            document.getElementById(`${tabName}-content`).classList.remove('hidden');
            
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active-tab');
            });
            document.getElementById(`${tabName}-tab`).classList.add('active-tab');
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
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
    <?php
    require_once __DIR__ . '/../classes/Employee.php';
    require_once __DIR__ . '/../config/database.php';

    $employee = Employee::getInstance();
    $db = Database::getInstance();

    // Fetch all required data
    $employee_list = $employee->getAll();
    
    $salary_sql = "SELECT employee_profile.emp_id, employee_profile.emp_name, salary_profile.provident_fund, 
        salary_profile.gratuity, salary_profile.tax, 
        salary_profile.travel_allowance, salary_profile.dearness_allowance 
        FROM employee_profile 
        INNER JOIN salary_profile ON employee_profile.emp_id = salary_profile.emp_id";
    
    $workprofile_sql = "SELECT employee_profile.emp_id, employee_profile.emp_name, work_profile.current_designation, 
        work_profile.joining_date 
        FROM employee_profile 
        INNER JOIN work_profile ON employee_profile.emp_id = work_profile.emp_id";

    $salary_table = $db->query($salary_sql);
    $work_table = $db->query($workprofile_sql);
    ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Employee List Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transition-all hover:shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Employee List
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Phone</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($row = $employee_list->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($row['emp_id']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['email_address'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Salary Details Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transition-all hover:shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Salary Details
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">PF</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Gratuity</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tax</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">TA</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">DA</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($row = $salary_table->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['provident_fund']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['gratuity']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['tax']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['travel_allowance']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['dearness_allowance']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Work Profile Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transition-all hover:shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Work Profile
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Designation</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Joining Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($row = $work_table->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['current_designation']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['joining_date']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <script>
        let currentIndex = 0;
        const slides = document.getElementById('slides');
        const totalSlides = slides.children.length;
        const indicators = document.querySelectorAll('.bottom-4 button');

        function updateIndicators() {
            indicators.forEach((indicator, index) => {
                indicator.className = `h-2 w-2 rounded-full ${index === currentIndex ? 'bg-blue-500' : 'bg-gray-300'}`;
            });
        }

        function showSlide(index) {
            currentIndex = index;
            const offset = -index * 100;
            slides.style.transform = `translateX(${offset}%)`;
            updateIndicators();
        }

        function prevSlide() {
            currentIndex = (currentIndex === 0) ? totalSlides - 1 : currentIndex - 1;
            showSlide(currentIndex);
        }

        function nextSlide() {
            currentIndex = (currentIndex === totalSlides - 1) ? 0 : currentIndex + 1;
            showSlide(currentIndex);
        }

        function goToSlide(index) {
            showSlide(index);
        }

    </script>
</body>
</html>
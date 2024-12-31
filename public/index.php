<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex justify-center">
<ul class="flex text-xl gap-10 p-4 text-slate-950">
              <li><a href="admin.php">Add data</a></li>
              <li><a href="index.php">Empoylee table</a></li>
              <li><a href="edit.php">Admin page</a></li>
              <li><a href="report.php">Payroll</a></li>
          </ul>
</div>
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

    <div class="relative overflow-hidden w-4/5 mx-auto mt-10">
        <!-- Slider Container -->
        <div class="flex transition-transform duration-500 ease-in-out" id="slides">
            <!-- Employee List Slide -->
            <div class="w-full flex-shrink-0 bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Employee List</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">ID</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Name</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Email</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Phone</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php while ($row = $employee_list->fetch_assoc()): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['emp_id']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['email_address'] ?? 'N/A'); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Salary Details Slide -->
            <div class="w-full flex-shrink-0 bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Salary Details</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Name</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">PF</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Gratuity</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Tax</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">TA</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">DA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php while ($row = $salary_table->fetch_assoc()): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['provident_fund']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['gratuity']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['tax']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['travel_allowance']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['dearness_allowance']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Work Profile Slide -->
            <div class="w-full flex-shrink-0 bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Work Profile</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Name</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Designation</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600">Joining Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php while ($row = $work_table->fetch_assoc()): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['current_designation']); ?></td>
                                    <td class="px-6 py-4 text-sm"><?php echo htmlspecialchars($row['joining_date']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button 
            class="absolute top-1/2 left-5 -translate-y-1/2 bg-blue-500 text-white p-3 rounded-full hover:bg-blue-600 transition-colors" 
            onclick="prevSlide()">←</button>
        <button 
            class="absolute top-1/2 right-5 -translate-y-1/2 bg-blue-500 text-white p-3 rounded-full hover:bg-blue-600 transition-colors" 
            onclick="nextSlide()">→</button>

        <!-- Slide Indicators -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-6">
            <button onclick="goToSlide(0)" class="h-2 w-2 rounded-full bg-blue-500"></button>
            <button onclick="goToSlide(1)" class="h-2 w-2 rounded-full bg-gray-300"></button>
            <button onclick="goToSlide(2)" class="h-2 w-2 rounded-full bg-gray-300"></button>
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
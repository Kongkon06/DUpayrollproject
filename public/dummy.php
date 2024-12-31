<script src="https://cdn.tailwindcss.com"></script>
<?php
require_once '../classes/Employee.php';
require_once '../config/database.php';

$error = null;
$rows = [];
$data = ['emp_id', 'emp_name', 'tax', 'travel_allowance']; // Fields to display

try {
    // Corrected SQL Query
    $sql = "
        SELECT 
            employee_profile.emp_id, 
            employee_profile.emp_name, 
            salary_profile.tax, 
            salary_profile.travel_allowance 
        FROM employee_profile 
        LEFT JOIN salary_profile 
        ON employee_profile.emp_id = salary_profile.emp_id
    ";
    $db = Database::getInstance();
    $result = $db->query($sql);

    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error = "No data found or an error occurred during the query.";
    }
} catch (Exception $e) {
    $error = "An error occurred: " . $e->getMessage();
}
?>

<?php if (isset($error)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<?php if (isset($result) && !empty($data)): ?>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <h2 class="text-2xl font-bold p-6 border-b">Generated Report</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <?php foreach ($data as $field): ?>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <?php echo htmlspecialchars(str_replace('_', ' ', $field)); ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($rows as $row): ?>
                                <tr class="hover:bg-gray-50">
                                    <?php foreach ($data as $field): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo htmlspecialchars($row[$field] ?? 'N/A'); ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
<?php else: ?>
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
        No data available to display.
    </div>
<?php endif; ?>

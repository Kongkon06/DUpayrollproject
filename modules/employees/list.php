<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
require_once '../classes/Employee.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['field'])){
        $data = $_POST['field'];
        $table ='<table class="min-w-full bg-white">';
        $table .='<thead><tr>';

        foreach ($data as $i) {
            $table .= '<td class="py-2 px-4 border-b">' . $i . '</td>'; // Output each table cell
        };
        $table .='</tr></thead><tbody>';

        echo $table;
    };
}
?>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Employee List</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                    <tr>
                    <?php  foreach ($data as $i): ?>
                    <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-600"><?php echo $i; ?></th>
                    <?php endforeach; ?>
                    </tr>
                    </thead>


                    </table>
                </div>
</body>
</html>

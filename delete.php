<?php
session_start();

$employees = [];
if (file_exists('employees.json')) {
    $employees = json_decode(file_get_contents('employees.json'), true);
}

if (isset($_GET['id'])) {
    foreach ($employees as $index => $employee) {
        if ($employee['id'] === $_GET['id']) {
            unset($employees[$index]);
            file_put_contents('employees.json', json_encode(array_values($employees)));
            $_SESSION['success'] = "Employee deleted successfully!";
            break;
        }
    }
}

header('Location: list.php');
exit();

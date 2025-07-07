<?php include 'hrfo/header.php';

$employees = [];
if (file_exists('employees.json')) {
    $employees = json_decode(file_get_contents('employees.json'), true);
}

$employee = null;
if (isset($_GET['id'])) {
    foreach ($employees as $emp) {
        if ($emp['id'] === $_GET['id']) {
            $employee = $emp;
            break;
        }
    }
}

if (!$employee) {
    header('Location: list.php');
    exit();
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Employee Details</h2>
        <a href="list.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Employee ID Card</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3><?php echo htmlspecialchars($employee['name']); ?></h3>
                            <hr>
                            <p><strong>Position:</strong> <?php echo htmlspecialchars($employee['position']); ?></p>
                            <p><strong>Department:</strong> <?php echo htmlspecialchars($employee['department']); ?></p>
                            <p><strong>ID:</strong> <?php echo $employee['id']; ?></p>
                            <p><strong>Created At:</strong> <?php echo $employee['created_at']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">

                    </a>
                    <a href="delete.php?id=<?php echo $employee['id']; ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Are you sure you want to delete this employee?')">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'hrfo/footer.php'; ?>
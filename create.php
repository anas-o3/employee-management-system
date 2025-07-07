<?php include 'hrfo/header.php';

$employees = [];
if (file_exists('employees.json')) {
    $employees = json_decode(file_get_contents('employees.json'), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'] ?? '';
    $position = $_POST['position'] ?? '';
    $department = $_POST['department'] ?? '';
    
    if (!empty($name) && !empty($position) && !empty($department)) {
        $newEmployee = [
            'id' => uniqid(),
            'name' => $name,
            'position' => $position,
            'department' => $department,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $employees[] = $newEmployee;
        file_put_contents('employees.json', json_encode($employees));
        
        $_SESSION['success'] = "Employee added successfully!";
        header('Location: list.php');
        exit();
    } else {
        $error = "Please fill all fields!";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add New Employee</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="IT">IT</option>
                                <option value="HR">HR</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Sales">Sales</option>
                                <option value="Customer Service">Customer Service</option>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'hrfo/footer.php'; ?>
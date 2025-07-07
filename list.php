<?php include 'hrfo/header.php';

$employees = [];
if (file_exists('employees.json')) {
    $employees = json_decode(file_get_contents('employees.json'), true);
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Employee List</h2>
        <a href="create.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    <?php if (empty($employees)): ?>
    <div class="alert alert-info">
        No employees found. <a href="create.php" class="alert-link">Add new employee</a>.
    </div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $index => $employee): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($employee['name'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($employee['position'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($employee['department'] ?? ''); ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="view.php?id=<?php echo $employee['id']; ?>" 
                               class="btn btn-sm btn-outline-primary" 
                               title="View">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="delete.php?id=<?php echo $employee['id']; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               title="Delete"
                               onclick="return confirm('Are you sure you want to delete this employee?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<?php include 'hrfo/footer.php'; ?>
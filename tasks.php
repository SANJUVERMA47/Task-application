
 <?php
include("./config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete record']);
        }
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link rel="stylesheet" href="task.css">
</head>
<body>
    <div class="container">
        <a class="exit" href="login.php?">Exit</a>
        <h1 class="list">My Tasks</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>task_name</th>
                    <th>task</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="student-table">
                <?php foreach ($students as $student): ?>
                    <tr id="row-<?= $student['id'] ?>">
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['task_name']) ?></td>
                        <td><?= htmlspecialchars($student['task']) ?></td>
                        <td>
                          <div class="button">
                            <button class="btn btn-danger" onclick="deleteStudent(<?= $student['id'] ?>)">Delete</button>
                            <a href="editdata.php?id=<?= htmlspecialchars($student['id']) ?>" class="btn btn-primary">Edit</a>
                          </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn data"><a href="adddata.php">Add Data</a></button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this task?')) {
                $.ajax({
                    type: 'POST',
                    url: 'tasks.php',
                    data: { delete: id },
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.status === 'success') {
                            $('#row-' + id).remove();
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        }
    </script>
</body>
</html>

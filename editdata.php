<?php
include("./config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Get the student ID from the URL

    // Fetch student data from the database based on ID
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch();

    if (!$student) {
        die("Student not found!");
    }
}

// When the form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];  // Get the ID of the student
    $task_name = $_POST['task_name'];  // Get the updated task name
    $task = $_POST['task'];  // Get the updated task description

    // Update student data in the database
    $stmt = $conn->prepare("UPDATE tasks SET task_name = ?, task = ? WHERE id = ?");
    if ($stmt->execute([$task_name, $task, $id])) {
        echo "<h2>Record updated successfully!</h2>";  // Simple success message
    } else {
        echo "Failed to update record.";  // Error message if update fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="container">
    <h1>Edit Task</h1>
    <!-- Display the form with existing student data -->
    <form action="editdata.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">
        <div>
            <label for="task_name">Task Name:</label>
            <input type="text" id="task_name" name="task_name" value="<?= htmlspecialchars($student['task_name']) ?>" required>
        </div>
        <div>
            <label for="task">Task:</label>
            <textarea id="task" name="task" required><?= htmlspecialchars($student['task']) ?></textarea>
        </div>
        <button type="submit">Update</button>
        <a href="tasks.php">Back to Task List</a>
    </form>
    </div>


</body>
</html>

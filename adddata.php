<?php
include("./config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];  // Get task name from the form
    $task = $_POST['task'];  // Get task description from the form

    // Insert new task into the database
    $stmt = $conn->prepare("INSERT INTO tasks (task_name, task) VALUES (?, ?)");
    if ($stmt->execute([$task_name, $task])) {
        echo "<h2>New task added successfully!</h2>";  // Success message
    } else {
        echo "Failed to add task.";  // Error message if insertion faill
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task</title>
    <link rel="stylesheet" href="add.css">

</head>
<body>
    <div class="container">
    <h1>Add New Task</h1>
    <!-- Form to collect task details -->
    <form action="adddata.php" method="post">
        <div>
            <label for="task_name">Task Name:</label>
            <input type="text" id="task_name" name="task_name" required>
        </div>
        <div>
            <label for="task">Task Description:</label>
            <textarea id="task" name="task" required></textarea>
        </div>
        <button type="submit">Add Task</button>
        <a href="tasks.php">Back to Student List</a>
    </form>
    </div>
    
</body>
</html>

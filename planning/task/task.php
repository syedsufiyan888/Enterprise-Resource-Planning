<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}

include('../../db_connect.php');
include('../../sidebar.php');

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// CRUD Operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_task'])) {
        // Sanitize input data for adding
        $task_number = sanitize_input($_POST['task_number']);
        $task_name = sanitize_input($_POST['task_name']);
        $duration = sanitize_input($_POST['duration']);
        $plan_start = sanitize_input($_POST['plan_start']);
        $plan_end = sanitize_input($_POST['plan_end']);
        $assigned = sanitize_input($_POST['assigned']);
        $percent_complete = sanitize_input($_POST['percent_complete']);

        // SQL query to insert data into tasks table
        $sql = "INSERT INTO tasks (task_number, task_name, duration, plan_start, plan_end, assigned, percent_complete) 
                VALUES ('$task_number', '$task_name', '$duration', '$plan_start', '$plan_end', '$assigned', '$percent_complete')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Task added successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['update_task'])) {
        // Sanitize input data for updating
        $id = sanitize_input($_POST['id']);
        $task_number = sanitize_input($_POST['task_number']);
        $task_name = sanitize_input($_POST['task_name']);
        $duration = sanitize_input($_POST['duration']);
        $plan_start = sanitize_input($_POST['plan_start']);
        $plan_end = sanitize_input($_POST['plan_end']);
        $assigned = sanitize_input($_POST['assigned']);
        $percent_complete = sanitize_input($_POST['percent_complete']);

        // SQL query to update data in tasks table
        $sql = "UPDATE tasks SET 
                task_number='$task_number', task_name='$task_name', duration='$duration', 
                plan_start='$plan_start', plan_end='$plan_end', assigned='$assigned', percent_complete='$percent_complete' 
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Task updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['delete_task'])) {
        // Sanitize input data for deleting
        $id = sanitize_input($_POST['id']);

        // SQL query to delete data from tasks table
        $sql = "DELETE FROM tasks WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Task deleted successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Query the database for existing tasks
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../istyle.css">
	 <style>
        .back-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button">Back</a>
    <div class="content">
    <section id="task_management">
        <h2>Task Management</h2>
        <form method="post">
            <input type="hidden" id="id" name="id">
            <label for="task_number">Task Number:</label>
            <input type="text" id="task_number" name="task_number" required>
            <label for="task_name">Task Name:</label>
            <input type="text" id="task_name" name="task_name" required>
            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration">
            <label for="plan_start">Plan Start:</label>
            <input type="date" id="plan_start" name="plan_start">
            <label for="plan_end">Plan End:</label>
            <input type="date" id="plan_end" name="plan_end">
            <label for="assigned">Assigned:</label>
            <input type="text" id="assigned" name="assigned">
            <label for="percent_complete">% Complete:</label>
            <input type="number" id="percent_complete" name="percent_complete" min="0" max="100">
            <input type="submit" name="add_task" value="Add Task">
            <input type="submit" name="update_task" value="Update Task">
            <input type="submit" name="delete_task" value="Delete Task">
        </form>
        
        <h3>Task List</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='task-table'>";
            echo "<thead><tr><th>ID</th><th>Task Number</th><th>Task Name</th><th>Duration</th><th>Plan Start</th><th>Plan End</th><th>Assigned</th><th>% Complete</th><th>Action</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['task_number'] . "</td>";
                echo "<td>" . $row['task_name'] . "</td>";
                echo "<td>" . $row['duration'] . "</td>";
                echo "<td>" . $row['plan_start'] . "</td>";
                echo "<td>" . $row['plan_end'] . "</td>";
                echo "<td>" . $row['assigned'] . "</td>";
                echo "<td>" . $row['percent_complete'] . "</td>";
                echo "<td>
                        <button onclick=\"editTask(" . $row['id'] . ", '" . $row['task_number'] . "', '" . $row['task_name'] . "', " . $row['duration'] . ", '" . $row['plan_start'] . "', '" . $row['plan_end'] . "', '" . $row['assigned'] . "', " . $row['percent_complete'] . ")\">Edit</button>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No tasks found.</p>";
        }
        ?>
    </section>
    </div>
    <script>
        function editTask(id, task_number, task_name, duration, plan_start, plan_end, assigned, percent_complete) {
            document.getElementById('id').value = id;
            document.getElementById('task_number').value = task_number;
            document.getElementById('task_name').value = task_name;
            document.getElementById('duration').value = duration;
            document.getElementById('plan_start').value = plan_start;
            document.getElementById('plan_end').value = plan_end;
            document.getElementById('assigned').value = assigned;
            document.getElementById('percent_complete').value = percent_complete;
        }
    </script>
</body>
</html>

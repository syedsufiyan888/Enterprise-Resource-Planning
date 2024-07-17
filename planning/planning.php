<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../includes/login.php');
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "erp0");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <base href="/erp0/">
    <title>Dashboard</title>
    <!-- Include CSS styles -->
    <link rel="stylesheet" type="text/css" href="planning/style.css">
    <link rel="stylesheet" type="text/css" href="istyle.css">
</head>
<body>
    <!-- Include sidebar -->
    <?php include __DIR__ . '/../sidebar.php'; ?>
    
    <div class="main-content">
        <h1>Planning</h1>
        <div class="options">
            <h2><a href="planning/project/project.php" class="button">Projects</a></h2>
            <h2><a href="planning/task/task.php" class="button">Tasks</a></h2>
        </div>
        
        <div class="overviews">
            <div class="overview">
                <h3>Projects Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Assigned</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, project_name, assigned, deadline FROM projects LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['project_name']}</td><td>{$row['assigned']}</td><td>{$row['deadline']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No projects found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="overview">
                <h3>Tasks Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Progress</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, task_name, percent_complete, plan_end FROM tasks LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['task_name']}</td><td>{$row['percent_complete']}%</td><td>{$row['plan_end']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No tasks found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>

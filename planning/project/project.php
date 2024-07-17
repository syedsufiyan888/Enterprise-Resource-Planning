<?php
session_start();

// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}

// Include necessary files
include('../../db_connect.php'); // Adjust the path as per your setup
include('../../sidebar.php'); // Adjust the path as per your setup

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// CRUD Operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_project'])) {
        // Sanitize input data for adding
        $project_id = sanitize_input($_POST['project_id']);
        $project_name = sanitize_input($_POST['project_name']);
        $budget = sanitize_input($_POST['budget']);
        $assigned = sanitize_input($_POST['assigned']);
        $deadline = sanitize_input($_POST['deadline']);

        // File upload handling
        $file_name = $_FILES['resources']['name'];
        $file_tmp_name = $_FILES['resources']['tmp_name'];
        $file_upload_path = 'uploads/' . $file_name; // Adjust as per your desired upload path

        // Move uploaded file to destination folder
        move_uploaded_file($file_tmp_name, $file_upload_path);

        // SQL query to insert data into projects table
        $sql = "INSERT INTO projects (project_id, project_name, budget, assigned, deadline, resources) 
                VALUES ('$project_id', '$project_name', '$budget', '$assigned', '$deadline', '$file_upload_path')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Project added successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['update_project'])) {
        // Sanitize input data for updating
        $id = sanitize_input($_POST['id']);
        $project_id = sanitize_input($_POST['project_id']);
        $project_name = sanitize_input($_POST['project_name']);
        $budget = sanitize_input($_POST['budget']);
        $assigned = sanitize_input($_POST['assigned']);
        $deadline = sanitize_input($_POST['deadline']);

        // SQL query to update data in projects table
        $sql = "UPDATE projects SET 
                project_id='$project_id', project_name='$project_name', budget='$budget', 
                assigned='$assigned', deadline='$deadline' 
                WHERE id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Project updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['delete_project'])) {
        // Sanitize input data for deleting
        $id = sanitize_input($_POST['id']);

        // SQL query to delete data from projects table
        $sql = "DELETE FROM projects WHERE id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Project deleted successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Query the database for existing projects
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
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
        <section id="project_management">
            <h2>Project Management</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <label for="project_id">Project ID:</label>
                <input type="text" id="project_id" name="project_id" required>
                <label for="project_name">Project Name:</label>
                <input type="text" id="project_name" name="project_name" required>
                <label for="budget">Budget:</label>
                <input type="number" id="budget" name="budget">
                <label for="assigned">Assigned:</label>
                <input type="text" id="assigned" name="assigned">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline">
                <label for="resources">Resources:</label>
                <input type="file" id="resources" name="resources">
                <input type="submit" name="add_project" value="Add Project">
                <input type="submit" name="update_project" value="Update Project">
                <input type="submit" name="delete_project" value="Delete Project">
            </form>
            
            <h3>Project List</h3>
            <?php
            if ($result->num_rows > 0) {
                echo "<table class='project-table'>";
                echo "<thead><tr><th>ID</th><th>Project ID</th><th>Project Name</th><th>Budget</th><th>Assigned</th><th>Deadline</th><th>Resources</th><th>Action</th></tr></thead>";
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['project_id'] . "</td>";
                    echo "<td>" . $row['project_name'] . "</td>";
                    echo "<td>" . $row['budget'] . "</td>";
                    echo "<td>" . $row['assigned'] . "</td>";
                    echo "<td>" . $row['deadline'] . "</td>";
                    echo "<td><a href='" . $row['resources'] . "' target='_blank'>Download</a></td>";
                    echo "<td>
                            <button onclick=\"editProject(" . $row['id'] . ", '" . $row['project_id'] . "', '" . $row['project_name'] . "', '" . $row['budget'] . "', '" . $row['assigned'] . "', '" . $row['deadline'] . "')\">Edit</button>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No projects found.</p>";
            }
            ?>
        </section>
    </div>
    <script>
        function editProject(id, project_id, project_name, budget, assigned, deadline) {
            document.getElementById('id').value = id;
            document.getElementById('project_id').value = project_id;
            document.getElementById('project_name').value = project_name;
            document.getElementById('budget').value = budget;
            document.getElementById('assigned').value = assigned;
            document.getElementById('deadline').value = deadline;
        }
    </script>
</body>
</html>

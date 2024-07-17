<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}
?>

<?php
include('../../db_connect.php');
include '../../sidebar.php';

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_employee'])) {
        $employee_name = sanitize_input($_POST['employee_name']);
        $employee_id = sanitize_input($_POST['employee_id']);
        $contact_information = sanitize_input($_POST['contact_information']);
        $department = sanitize_input($_POST['department']);
        $job_title = sanitize_input($_POST['job_title']);
        $date_of_joining = sanitize_input($_POST['date_of_joining']);

        $sql = "INSERT INTO employee_info (employee_name, employee_id, contact_information, department, job_title, date_of_joining) 
                VALUES ('$employee_name', '$employee_id', '$contact_information', '$department', '$job_title', '$date_of_joining')";
       
    } elseif (isset($_POST['update_employee'])) {
        $id = intval($_POST['id']);
        $employee_name = sanitize_input($_POST['employee_name']);
        $employee_id = sanitize_input($_POST['employee_id']);
        $contact_information = sanitize_input($_POST['contact_information']);
        $department = sanitize_input($_POST['department']);
        $job_title = sanitize_input($_POST['job_title']);
        $date_of_joining = sanitize_input($_POST['date_of_joining']);

        $sql = "UPDATE employee_info SET employee_name='$employee_name', employee_id='$employee_id', contact_information='$contact_information', department='$department', job_title='$job_title', date_of_joining='$date_of_joining' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Employee information updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
        }
    } elseif (isset($_POST['delete_employee'])) {
        $id = intval($_POST['id']);

        $sql = "DELETE FROM employee_info WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Employee information deleted successfully</p>";
        } else {
            echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
        }
    }
}

// Query the database for existing employee information
$sql = "SELECT * FROM employee_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information Management</title>
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
    <section id="employee_info_management">
        <h2>Employee Information Management</h2>
        <form method="post">
            <input type="hidden" id="id" name="id">
            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name" required>
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" required>
            <label for="contact_information">Contact Information:</label>
            <input type="text" id="contact_information" name="contact_information" required>
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>
            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" required>
            <label for="date_of_joining">Date of Joining:</label>
            <input type="date" id="date_of_joining" name="date_of_joining" required>
            <input type="submit" name="add_employee" value="Add Employee">
            <input type="submit" name="update_employee" value="Update Employee">
            
        </form>
        
        <h3>Employee List</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='employee-table'>";
            echo "<thead><tr><th>Employee Name</th><th>Employee ID</th><th>Contact Information</th><th>Department</th><th>Job Title</th><th>Date of Joining</th><th>Actions</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['employee_name'] . "</td>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>" . $row['contact_information'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $row['job_title'] . "</td>";
                echo "<td>" . $row['date_of_joining'] . "</td>";
                echo "<td>
                    <form method='post' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='employee_name' value='" . $row['employee_name'] . "'>
                        <input type='hidden' name='employee_id' value='" . $row['employee_id'] . "'>
                        <input type='hidden' name='contact_information' value='" . $row['contact_information'] . "'>
                        <input type='hidden' name='department' value='" . $row['department'] . "'>
                        <input type='hidden' name='job_title' value='" . $row['job_title'] . "'>
                        <input type='hidden' name='date_of_joining' value='" . $row['date_of_joining'] . "'>
                        <input type='submit' name='edit_employee' value='Edit'>
                    </form>
                    <form method='post' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' name='delete_employee' value='Delete'>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No employee records found.</p>";
        }
        ?>
    </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll("input[name='edit_employee']");
            editButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = event.target.closest('form');
                    const id = form.querySelector("input[name='id']").value;
                    const employee_name = form.querySelector("input[name='employee_name']").value;
                    const employee_id = form.querySelector("input[name='employee_id']").value;
                    const contact_information = form.querySelector("input[name='contact_information']").value;
                    const department = form.querySelector("input[name='department']").value;
                    const job_title = form.querySelector("input[name='job_title']").value;
                    const date_of_joining = form.querySelector("input[name='date_of_joining']").value;

                    document.getElementById('id').value = id;
                    document.getElementById('employee_name').value = employee_name;
                    document.getElementById('employee_id').value = employee_id;
                    document.getElementById('contact_information').value = contact_information;
                    document.getElementById('department').value = department;
                    document.getElementById('job_title').value = job_title;
                    document.getElementById('date_of_joining').value = date_of_joining;

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        });
    </script>
</body>
</html>

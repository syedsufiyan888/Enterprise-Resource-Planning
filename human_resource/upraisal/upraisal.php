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

// Handle Update Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_appraisal'])) {
    $id = sanitize_input($_POST['id']);
    $employee_id = sanitize_input($_POST['employee_id']);
    $employee_name = sanitize_input($_POST['employee_name']);
    $appraisal_date = sanitize_input($_POST['appraisal_date']);
    $performance_score = sanitize_input($_POST['performance_score']);
    $comments = sanitize_input($_POST['comments']);

    $sql = "UPDATE appraisal SET 
            employee_id = '$employee_id', 
            employee_name = '$employee_name', 
            appraisal_date = '$appraisal_date', 
            performance_score = '$performance_score', 
            comments = '$comments' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Appraisal information updated successfully</p>";
    } else {
        echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
    }
}

// Handle Delete Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_appraisal'])) {
    $id = sanitize_input($_POST['id']);
    
    $sql = "DELETE FROM appraisal WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Appraisal information deleted successfully</p>";
    } else {
        echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
    }
}

// Handle Insert (Create) Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_appraisal'])) {
    $employee_id = sanitize_input($_POST['employee_id']);
    $employee_name = sanitize_input($_POST['employee_name']);
    $appraisal_date = sanitize_input($_POST['appraisal_date']);
    $performance_score = sanitize_input($_POST['performance_score']);
    $comments = sanitize_input($_POST['comments']);

    $sql = "INSERT INTO appraisal (employee_id, employee_name, appraisal_date, performance_score, comments) 
            VALUES ('$employee_id', '$employee_name', '$appraisal_date', '$performance_score', '$comments')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Appraisal information added successfully</p>";
    } else {
        echo "<p style='color: red;'>Error adding record: " . $conn->error . "</p>";
    }
}

// Fetch Appraisal Data for Editing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_appraisal'])) {
    $id = sanitize_input($_POST['id']);
    
    $sql = "SELECT * FROM appraisal WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $employee_id = $row['employee_id'];
        $employee_name = $row['employee_name'];
        $appraisal_date = $row['appraisal_date'];
        $performance_score = $row['performance_score'];
        $comments = $row['comments'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appraisal Management</title>
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
    <section id="appraisal_management">
        <h2>Appraisal Management</h2>
        
        <!-- Form for adding and updating appraisals -->
        <form method="post">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" value="<?php echo isset($employee_id) ? $employee_id : ''; ?>" required>
            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name" value="<?php echo isset($employee_name) ? $employee_name : ''; ?>" required>
            <label for="appraisal_date">Appraisal Date:</label>
            <input type="date" id="appraisal_date" name="appraisal_date" value="<?php echo isset($appraisal_date) ? $appraisal_date : ''; ?>" required>
            <label for="performance_score">Performance Score:</label>
            <input type="number" id="performance_score" name="performance_score" value="<?php echo isset($performance_score) ? $performance_score : ''; ?>" required>
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" required><?php echo isset($comments) ? $comments : ''; ?></textarea>

            <?php if (isset($id)): ?>
                <input type="submit" name="update_appraisal" value="Update Appraisal">
            <?php else: ?>
                <input type="submit" name="add_appraisal" value="Add Appraisal">
            <?php endif; ?>
        </form>
        
        <h3>Appraisal Records</h3>
        <?php
        // Query the database for existing appraisals
        $sql = "SELECT * FROM appraisal";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='appraisal-table'>";
            echo "<thead><tr><th>Employee ID</th><th>Employee Name</th><th>Appraisal Date</th><th>Performance Score</th><th>Comments</th><th>Actions</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>" . $row['employee_name'] . "</td>";
                echo "<td>" . $row['appraisal_date'] . "</td>";
                echo "<td>" . $row['performance_score'] . "</td>";
                echo "<td>" . $row['comments'] . "</td>";
                echo "<td>
                        <form method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='edit_appraisal' value='Edit'>
                        </form>
                        <form method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='delete_appraisal' value='Delete'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No appraisal records found.</p>";
        }
        ?>
    </section>
    </div>
</body>
</html>

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
    <title>Dashboard</title>
    <!-- Include CSS styles -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../istyle.css">
</head>
<body>
    <!-- Include sidebar -->
    <?php include '../sidebar.php'; ?>

    <div class="content">
        <h1>Human Resource</h1>
        <div class="options">
            <h2><a href="employee/employee.php" class="button">Employee Info</a></h2>
            <h2><a href="payroll/payroll.php" class="button">Payroll</a></h2>
            <h2><a href="upraisal/upraisal.php" class="button">Appraisal</a></h2>
        </div>

        <div class="overviews">
            <div class="overview">
                <h3>Employee Info Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, employee_name, employee_id, department FROM employee_info LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['employee_name']}</td><td>{$row['employee_id']}</td><td>{$row['department']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No employee info found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="overview">
                <h3>Payroll Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Net Salary</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, employee_id, employee_name, net_salary, payment_date FROM payroll LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['employee_id']}</td><td>{$row['employee_name']}</td><td>{$row['net_salary']}</td><td>{$row['payment_date']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No payroll info found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div><br>

        <div class="overview full-width">
            <h3>Appraisal Overview</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Appraisal Date</th>
                        <th>Performance Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, employee_id, employee_name, appraisal_date, performance_score FROM appraisal LIMIT 5";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['id']}</td><td>{$row['employee_id']}</td><td>{$row['employee_name']}</td><td>{$row['appraisal_date']}</td><td>{$row['performance_score']}</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No appraisal info found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>

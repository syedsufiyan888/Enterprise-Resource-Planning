<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}

include('../../db_connect.php'); // Adjust path as per your file structure
include('../../sidebar.php');    // Adjust path as per your file structure

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle Update Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_payroll'])) {
    $id = sanitize_input($_POST['id']);
    $employee_id = sanitize_input($_POST['employee_id']);
    $employee_name = sanitize_input($_POST['employee_name']);
    $basic_salary = sanitize_input($_POST['basic_salary']);
    $allowances = sanitize_input($_POST['allowances']);
    $deductions = sanitize_input($_POST['deductions']);
    $payment_date = sanitize_input($_POST['payment_date']);
    $total_working_days = sanitize_input($_POST['total_working_days']);
    $days_worked = sanitize_input($_POST['days_worked']);
    $leave_taken = sanitize_input($_POST['leave_taken']);
    $overtime = sanitize_input($_POST['overtime']);
    $performance_bonus = sanitize_input($_POST['performance_bonus']);
    $other_incentives = sanitize_input($_POST['other_incentives']);
    $tax_deductions = sanitize_input($_POST['tax_deductions']);
    $provident_fund = sanitize_input($_POST['provident_fund']);
    $insurance_contributions = sanitize_input($_POST['insurance_contributions']);
    $bank_account_number = sanitize_input($_POST['bank_account_number']);
    $bank_name = sanitize_input($_POST['bank_name']);
    $bank_branch = sanitize_input($_POST['bank_branch']);

    $sql = "UPDATE payroll SET 
            employee_id = '$employee_id', 
            employee_name = '$employee_name', 
            basic_salary = '$basic_salary', 
            allowances = '$allowances', 
            deductions = '$deductions', 
            payment_date = '$payment_date', 
            total_working_days = '$total_working_days', 
            days_worked = '$days_worked', 
            leave_taken = '$leave_taken', 
            overtime = '$overtime', 
            performance_bonus = '$performance_bonus', 
            other_incentives = '$other_incentives', 
            tax_deductions = '$tax_deductions', 
            provident_fund = '$provident_fund', 
            insurance_contributions = '$insurance_contributions', 
            bank_account_number = '$bank_account_number', 
            bank_name = '$bank_name', 
            bank_branch = '$bank_branch' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Payroll information updated successfully</p>";
    } else {
        echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
    }
}

// Handle Delete Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_payroll'])) {
    $id = sanitize_input($_POST['id']);
    
    $sql = "DELETE FROM payroll WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Payroll information deleted successfully</p>";
    } else {
        echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
    }
}

// Handle Insert (Create) Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_payroll'])) {
    $employee_id = sanitize_input($_POST['employee_id']);
    $employee_name = sanitize_input($_POST['employee_name']);
    $basic_salary = sanitize_input($_POST['basic_salary']);
    $allowances = sanitize_input($_POST['allowances']);
    $deductions = sanitize_input($_POST['deductions']);
    $payment_date = sanitize_input($_POST['payment_date']);
    $total_working_days = sanitize_input($_POST['total_working_days']);
    $days_worked = sanitize_input($_POST['days_worked']);
    $leave_taken = sanitize_input($_POST['leave_taken']);
    $overtime = sanitize_input($_POST['overtime']);
    $performance_bonus = sanitize_input($_POST['performance_bonus']);
    $other_incentives = sanitize_input($_POST['other_incentives']);
    $tax_deductions = sanitize_input($_POST['tax_deductions']);
    $provident_fund = sanitize_input($_POST['provident_fund']);
    $insurance_contributions = sanitize_input($_POST['insurance_contributions']);
    $bank_account_number = sanitize_input($_POST['bank_account_number']);
    $bank_name = sanitize_input($_POST['bank_name']);
    $bank_branch = sanitize_input($_POST['bank_branch']);

    $sql = "INSERT INTO payroll (employee_id, employee_name, basic_salary, allowances, deductions, payment_date, total_working_days, days_worked, leave_taken, overtime, performance_bonus, other_incentives, tax_deductions, provident_fund, insurance_contributions, bank_account_number, bank_name, bank_branch) 
            VALUES ('$employee_id', '$employee_name', '$basic_salary', '$allowances', '$deductions', '$payment_date', '$total_working_days', '$days_worked', '$leave_taken', '$overtime', '$performance_bonus', '$other_incentives', '$tax_deductions', '$provident_fund', '$insurance_contributions', '$bank_account_number', '$bank_name', '$bank_branch')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Payroll information added successfully</p>";
    } else {
        echo "<p style='color: red;'>Error adding record: " . $conn->error . "</p>";
    }
}

// Fetch Payroll Data for Editing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_payroll'])) {
    $id = sanitize_input($_POST['id']);
    
    $sql = "SELECT * FROM payroll WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $employee_id = $row['employee_id'];
        $employee_name = $row['employee_name'];
        $basic_salary = $row['basic_salary'];
        $allowances = $row['allowances'];
        $deductions = $row['deductions'];
        $payment_date = $row['payment_date'];
        $total_working_days = $row['total_working_days'];
        $days_worked = $row['days_worked'];
        $leave_taken = $row['leave_taken'];
        $overtime = $row['overtime'];
        $performance_bonus = $row['performance_bonus'];
        $other_incentives = $row['other_incentives'];
        $tax_deductions = $row['tax_deductions'];
        $provident_fund = $row['provident_fund'];
        $insurance_contributions = $row['insurance_contributions'];
        $bank_account_number = $row['bank_account_number'];
        $bank_name = $row['bank_name'];
        $bank_branch = $row['bank_branch'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management</title>
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
    <section id="payroll_management">
        <h2>Payroll Management</h2>
        
        <!-- Form for adding and updating payroll -->
        <form method="post">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" value="<?php echo isset($employee_id) ? $employee_id : ''; ?>" required>
			            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name" value="<?php echo isset($employee_name) ? $employee_name : ''; ?>" required>
            <label for="basic_salary">Basic Salary:</label>
            <input type="text" id="basic_salary" name="basic_salary" value="<?php echo isset($basic_salary) ? $basic_salary : ''; ?>" required>
            <label for="allowances">Allowances:</label>
            <input type="text" id="allowances" name="allowances" value="<?php echo isset($allowances) ? $allowances : ''; ?>" required>
            <label for="deductions">Deductions:</label>
            <input type="text" id="deductions" name="deductions" value="<?php echo isset($deductions) ? $deductions : ''; ?>" required>
            <label for="payment_date">Payment Date:</label>
            <input type="date" id="payment_date" name="payment_date" value="<?php echo isset($payment_date) ? $payment_date : ''; ?>" required>
            <label for="total_working_days">Total Working Days:</label>
            <input type="number" id="total_working_days" name="total_working_days" value="<?php echo isset($total_working_days) ? $total_working_days : ''; ?>" required>
            <label for="days_worked">Days Worked:</label>
            <input type="number" id="days_worked" name="days_worked" value="<?php echo isset($days_worked) ? $days_worked : ''; ?>" required>
            <label for="leave_taken">Leave Taken:</label>
            <input type="number" id="leave_taken" name="leave_taken" value="<?php echo isset($leave_taken) ? $leave_taken : ''; ?>" required>
            <label for="overtime">Overtime:</label>
            <input type="text" id="overtime" name="overtime" value="<?php echo isset($overtime) ? $overtime : ''; ?>" required>
            <label for="performance_bonus">Performance Bonus:</label>
            <input type="text" id="performance_bonus" name="performance_bonus" value="<?php echo isset($performance_bonus) ? $performance_bonus : ''; ?>" required>
            <label for="other_incentives">Other Incentives:</label>
            <input type="text" id="other_incentives" name="other_incentives" value="<?php echo isset($other_incentives) ? $other_incentives : ''; ?>" required>
            <label for="tax_deductions">Tax Deductions:</label>
            <input type="text" id="tax_deductions" name="tax_deductions" value="<?php echo isset($tax_deductions) ? $tax_deductions : ''; ?>" required>
            <label for="provident_fund">Provident Fund:</label>
            <input type="text" id="provident_fund" name="provident_fund" value="<?php echo isset($provident_fund) ? $provident_fund : ''; ?>" required>
            <label for="insurance_contributions">Insurance Contributions:</label>
            <input type="text" id="insurance_contributions" name="insurance_contributions" value="<?php echo isset($insurance_contributions) ? $insurance_contributions : ''; ?>" required>
            <label for="bank_account_number">Bank Account Number:</label>
            <input type="text" id="bank_account_number" name="bank_account_number" value="<?php echo isset($bank_account_number) ? $bank_account_number : ''; ?>" required>
            <label for="bank_name">Bank Name:</label>
            <input type="text" id="bank_name" name="bank_name" value="<?php echo isset($bank_name) ? $bank_name : ''; ?>" required>
            <label for="bank_branch">Bank Branch:</label>
            <input type="text" id="bank_branch" name="bank_branch" value="<?php echo isset($bank_branch) ? $bank_branch : ''; ?>" required>

            <?php if (isset($id)): ?>
                <input type="submit" name="update_payroll" value="Update Payroll">
            <?php else: ?>
                <input type="submit" name="add_payroll" value="Add Payroll">
            <?php endif; ?>
        </form>
        
        <h3>Payroll Records</h3>
        <?php
        // Query the database for existing payroll records
        $sql = "SELECT * FROM payroll";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='payroll-table'>";
            echo "<thead><tr><th>Employee ID</th><th>Employee Name</th><th>Payment Date</th><th>Basic Salary</th><th>Actions</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>" . $row['employee_name'] . "</td>";
                echo "<td>" . $row['payment_date'] . "</td>";
                echo "<td>" . $row['basic_salary'] . "</td>";
                echo "<td>
                        <form method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='edit_payroll' value='Edit'>
                        </form>
                        <form method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='delete_payroll' value='Delete'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No payroll records found.</p>";
        }
        ?>
    </section>
    </div>
</body>
</html>

           

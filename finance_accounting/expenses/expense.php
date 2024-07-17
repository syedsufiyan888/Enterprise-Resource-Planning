<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erp0";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$expenseName = '';
$expenseAmount = 0;
$expenseDate = '';
$expenseCategory = '';
$expenses = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_expense'])) {
        // Retrieve form data for adding
        $expenseName = sanitize_input($_POST['expense_name']);
        $expenseAmount = floatval($_POST['expense_amount']);
        $expenseDate = date('Y-m-d', strtotime($_POST['expense_date']));
        $expenseCategory = sanitize_input($_POST['expense_category']);

        // Insert expense into database
        $stmt = $conn->prepare("INSERT INTO expenses (name, amount, date, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $expenseName, $expenseAmount, $expenseDate, $expenseCategory);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update_expense'])) {
        // Retrieve form data for updating
        $id = intval($_POST['id']);
        $expenseName = sanitize_input($_POST['expense_name']);
        $expenseAmount = floatval($_POST['expense_amount']);
        $expenseDate = date('Y-m-d', strtotime($_POST['expense_date']));
        $expenseCategory = sanitize_input($_POST['expense_category']);

        // Update expense in database
        $stmt = $conn->prepare("UPDATE expenses SET name=?, amount=?, date=?, category=? WHERE id=?");
        $stmt->bind_param("sdssi", $expenseName, $expenseAmount, $expenseDate, $expenseCategory, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_expense'])) {
        // Retrieve form data for deleting
        $id = intval($_POST['id']);

        // Delete expense from database
        $stmt = $conn->prepare("DELETE FROM expenses WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch expenses from database
$sql = "SELECT * FROM expenses";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
}

// Function to calculate total expenses
function calculateTotalExpenses($expenses) {
    $total = 0;
    foreach ($expenses as $expense) {
        $total += $expense['amount'];
    }
    return $total;
}

// Function to calculate average expenses
function calculateAverageExpense($expenses) {
    $total = calculateTotalExpenses($expenses);
    $count = count($expenses);
    if ($count > 0) {
        return $total / $count;
    } else {
        return 0;
    }
}

// Function to group expenses by category
function groupExpensesByCategory($expenses) {
    $groupedExpenses = [];
    foreach ($expenses as $expense) {
        $category = $expense['category'];
        if (!isset($groupedExpenses[$category])) {
            $groupedExpenses[$category] = [];
        }
        $groupedExpenses[$category][] = $expense;
    }
    return $groupedExpenses;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Expense Tracker</title>
    <!-- Include CSS styles -->
    <link rel="stylesheet" type="text/css" href="estyle.css">
    <link rel="stylesheet" type="text/css" href="../../istyle.css">
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
<body class="content">
<a href="javascript:history.back()" class="back-button">Back</a>
    <!-- Include sidebar -->
    <?php include '../../sidebar.php'; ?>

    <main>
        <h1>Expense Tracker</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" id="id" name="id">
            <label for="expense_name">Expense Name:</label>
            <input type="text" id="expense_name" name="expense_name" required><br><br>
            
            <label for="expense_amount">Amount:</label>
            <input type="number" id="expense_amount" name="expense_amount" min="0" step="0.01" required><br><br>
            
            <label for="expense_date">Date:</label>
            <input type="date" id="expense_date" name="expense_date" required><br><br>

            <label for="expense_category">Category:</label>
            <input type="text" id="expense_category" name="expense_category"><br><br>
            
            <input type="submit" name="add_expense" value="Add Expense"><br>
            <input type="submit" name="update_expense" value="Update Expense"><br>
            <input type="submit" name="delete_expense" value="Delete Expense">
        </form>

        <h2>Expenses:</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php foreach ($expenses as $expense): ?>
                <tr>
                    <td><?php echo $expense['name']; ?></td>
                    <td><?php echo $expense['amount']; ?></td>
                    <td><?php echo $expense['date']; ?></td>
                    <td><?php echo $expense['category']; ?></td>
                    <td>
                        <button onclick="editExpense(<?php echo $expense['id']; ?>, '<?php echo $expense['name']; ?>', <?php echo $expense['amount']; ?>, '<?php echo $expense['date']; ?>', '<?php echo $expense['category']; ?>')">Edit</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Expense Summary:</h2>
        <p>Total Expenses: <?php echo calculateTotalExpenses($expenses); ?></p>
        <p>Average Expense: <?php echo number_format(calculateAverageExpense($expenses), 2); ?></p>

        <h2>Expenses by Category:</h2>
        <?php $groupedExpenses = groupExpensesByCategory($expenses); ?>
        <?php foreach ($groupedExpenses as $category => $expenses): ?>
            <h3><?php echo $category; ?></h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td><?php echo $expense['name']; ?></td>
                        <td><?php echo $expense['amount']; ?></td>
                        <td><?php echo $expense['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endforeach; ?>
    </main>
</body>
</html>

<script>
function editExpense(id, name, amount, date, category) {
    document.getElementById('id').value = id;
    document.getElementById('expense_name').value = name;
    document.getElementById('expense_amount').value = amount;
    document.getElementById('expense_date').value = date;
    document.getElementById('expense_category').value = category;
}
</script>

<?php
// Close the database connection
$conn->close();
?>

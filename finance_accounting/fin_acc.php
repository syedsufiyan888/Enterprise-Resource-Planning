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
    
    <div class="main-content">
        <h1>Finance & Accounting</h1>
        <div class="options">
            <h2><a href="expenses/expense.php" class="button">Expense</a></h2>
            <h2><a href="purchase/purchase.php" class="button">Purchase</a></h2>
            <h2><a href="sales/sales.php" class="button">Sales</a></h2>
        </div>

        <div class="overviews">
            <div class="overview">
                <h3>Expenses Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, name, amount, date, category FROM expenses LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['amount']}</td><td>{$row['date']}</td><td>{$row['category']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No expenses found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="overview">
                <h3>Purchases Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PO Number</th>
                            <th>Vendor Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, po_number, vendor_name, quantity, total_price FROM purchase_orders LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['po_number']}</td><td>{$row['vendor_name']}</td><td>{$row['quantity']}</td><td>{$row['total_price']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No purchases found</td></tr>";
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

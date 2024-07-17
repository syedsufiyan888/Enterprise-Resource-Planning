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
        <h1>Customer Relationship Management</h1>
        <div class="options">
            <h2><a href="cm/cm.php" class="button">Customer Management</a></h2>
        </div>

        <div class="overviews">
            <div class="overview">
                <h3>Customer Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, first_name, last_name FROM customers LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No customers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="overview">
                <h3>Sales Orders Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Number</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, so_number, so_date, customer_name, total_price FROM sales_orders LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['so_number']}</td><td>{$row['so_date']}</td><td>{$row['customer_name']}</td><td>{$row['total_price']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No sales orders found</td></tr>";
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

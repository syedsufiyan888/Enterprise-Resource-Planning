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
        <h1>Product & Inventory</h1>
        <div class="options">
            <h2><a href="product_detail/stock.php" class="button">Product Detail</a></h2>
            <h2><a href="stk_mg/stkmg.php" class="button">Stock Management</a></h2>
        </div>

        <div class="overviews">
            <div class="overview">
                <h3>Product Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, product_name, category, price, stock FROM products LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['product_name']}</td><td>{$row['category']}</td><td>{$row['price']}</td><td>{$row['stock']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No products found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="overview">
                <h3>Stock Movement Overview</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, product_id, quantity, movement_type, created_at FROM stock_movement LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>{$row['id']}</td><td>{$row['product_id']}</td><td>{$row['quantity']}</td><td>{$row['movement_type']}</td><td>{$row['created_at']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No stock movements found</td></tr>";
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

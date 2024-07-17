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

// Fetch sales data from the database
$sql = "SELECT * FROM sales_orders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../istyle.css">
	
</head>
<body>
    <div class="content">
        <section id="sales_report">
            <h2>Sales Report</h2>
            
            <h3>Sales Orders</h3>
            <?php if ($result->num_rows > 0): ?>
            <table class="sales-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>SO Number</th>
                        <th>SO Date</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Item Name</th>
                        <th>Item Code</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Shipping Address</th>
                        <th>Sales Tax</th>
                        <th>Discounts</th>
                        <th>Final Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['so_number']; ?></td>
                        <td><?php echo $row['so_date']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['customer_contact']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['item_code']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['total_price']; ?></td>
                        <td><?php echo $row['payment_method']; ?></td>
                        <td><?php echo $row['shipping_address']; ?></td>
                        <td><?php echo $row['sales_tax']; ?></td>
                        <td><?php echo $row['discounts']; ?></td>
                        <td><?php echo $row['final_price']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No sales orders found.</p>
            <?php endif; ?>
            
            <button onclick="window.print()">Print Report</button>
        </section>
    </div>
</body>
</html>

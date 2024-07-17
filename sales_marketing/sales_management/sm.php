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
$sales_query = "SELECT * FROM sales_orders";
$sales_result = $conn->query($sales_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../istyle.css">
    <style>
        .invoice {
            display: none;
        }
    </style>
    <script>
        function printInvoice(orderId) {
            var invoice = document.getElementById('invoice-' + orderId);
            var newWin = window.open('');
            newWin.document.write(invoice.outerHTML);
            newWin.document.close();
            newWin.focus();
            newWin.print();
            newWin.close();
        }
    </script>
</head>
<body>
    <div class="content">
        <section id="sales_management">
            <h2>Sales Invoice</h2>
            
            <?php if ($sales_result->num_rows > 0): ?>
            <table class="sales-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Sales Order Number</th>
                        <th>Sales Order Date</th>
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
                        <th>Created At</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $sales_result->fetch_assoc()): ?>
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
                        <td>
                            <button onclick="printInvoice(<?php echo $row['id']; ?>)">Print Invoice</button>
                        </td>
                    </tr>
                    <tr id="invoice-<?php echo $row['id']; ?>" class="invoice">
                        <td colspan="15">
                            <div class=invoicecss>
                                <h2>Sales Invoice</h2>
                                <p><strong>Order ID:</strong> <?php echo $row['id']; ?></p>
                                <p><strong>Sales Order Number:</strong> <?php echo $row['so_number']; ?></p>
                                <p><strong>Customer Name:</strong> <?php echo $row['customer_name']; ?></p>
                                <p><strong>Item Name:</strong> <?php echo $row['item_name']; ?></p>
                                <p><strong>Sales Tax(%):</strong> <?php echo $row['sales_tax']; ?></p>
                                <p><strong>Total Price:</strong> <?php echo $row['total_price']; ?></p>
                                <!-- Add more necessary details as needed -->
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No sales orders found.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>

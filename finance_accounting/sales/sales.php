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
    if (isset($_POST['add_sales_order'])) {
        $so_number = sanitize_input($_POST['so_number']);
        $so_date = sanitize_input($_POST['so_date']);
        $customer_name = sanitize_input($_POST['customer_name']);
        $customer_contact = sanitize_input($_POST['customer_contact']);
        $item_name = sanitize_input($_POST['item_name']);
        $item_code = sanitize_input($_POST['item_code']);
        $quantity = sanitize_input($_POST['quantity']);
        $total_price = sanitize_input($_POST['total_price']);
        $payment_method = sanitize_input($_POST['payment_method']);
        $shipping_address = sanitize_input($_POST['shipping_address']);
        $sales_tax = sanitize_input($_POST['sales_tax']);
        $discounts = sanitize_input($_POST['discounts']);
        $final_price = $total_price + $sales_tax - $discounts;

        $sql = "INSERT INTO sales_orders (so_number, so_date, customer_name, customer_contact, item_name, item_code, quantity, total_price, payment_method, shipping_address, sales_tax, discounts, final_price) 
                VALUES ('$so_number', '$so_date', '$customer_name', '$customer_contact', '$item_name', '$item_code', '$quantity', '$total_price', '$payment_method', '$shipping_address', '$sales_tax', '$discounts', '$final_price')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>New sales order added successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['update_sales_order'])) {
        $id = intval($_POST['id']);
        $so_number = sanitize_input($_POST['so_number']);
        $so_date = sanitize_input($_POST['so_date']);
        $customer_name = sanitize_input($_POST['customer_name']);
        $customer_contact = sanitize_input($_POST['customer_contact']);
        $item_name = sanitize_input($_POST['item_name']);
        $item_code = sanitize_input($_POST['item_code']);
        $quantity = sanitize_input($_POST['quantity']);
        $total_price = sanitize_input($_POST['total_price']);
        $payment_method = sanitize_input($_POST['payment_method']);
        $shipping_address = sanitize_input($_POST['shipping_address']);
        $sales_tax = sanitize_input($_POST['sales_tax']);
        $discounts = sanitize_input($_POST['discounts']);
        $final_price = $total_price + $sales_tax - $discounts;

        $sql = "UPDATE sales_orders SET so_number='$so_number', so_date='$so_date', customer_name='$customer_name', customer_contact='$customer_contact', item_name='$item_name', item_code='$item_code', quantity='$quantity', total_price='$total_price', payment_method='$payment_method', shipping_address='$shipping_address', sales_tax='$sales_tax', discounts='$discounts', final_price='$final_price' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Sales order updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
        }
    } elseif (isset($_POST['delete_sales_order'])) {
        $id = intval($_POST['id']);

        $sql = "DELETE FROM sales_orders WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Sales order deleted successfully</p>";
        } else {
            echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
        }
    }
}

// Query the database for existing sales orders
$sql = "SELECT * FROM sales_orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Order Management</title>
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
    <section id="sales_order_management">
        <h2>Sales Order Management</h2>
        <form method="post">
            <input type="hidden" id="id" name="id">
            <label for="so_number">SO Number:</label>
            <input type="text" id="so_number" name="so_number" required>
            <label for="so_date">SO Date:</label>
            <input type="date" id="so_date" name="so_date" required>
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <label for="customer_contact">Customer Contact:</label>
            <input type="text" id="customer_contact" name="customer_contact" required>
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required>
            <label for="item_code">Item Code:</label>
            <input type="text" id="item_code" name="item_code" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="total_price">Total Price:</label>
            <input type="number" step="0.01" id="total_price" name="total_price" required>
            <label for="payment_method">Payment Method:</label>
            <input type="text" id="payment_method" name="payment_method" required>
            <label for="shipping_address">Shipping Address:</label>
            <input type="text" id="shipping_address" name="shipping_address" required>
            <label for="sales_tax">Sales Tax:</label>
            <input type="number" step="0.01" id="sales_tax" name="sales_tax" required>
            <label for="discounts">Discounts:</label>
            <input type="number" step="0.01" id="discounts" name="discounts" required>
            <input type="submit" name="add_sales_order" value="Add Sales Order">
            <input type="submit" name="update_sales_order" value="Update Sales Order">
            
        </form>
        
        <h3>Sales Orders List</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='so-table'>";
            echo "<thead><tr><th>SO Number</th><th>SO Date</th><th>Customer Name</th><th>Customer Contact</th><th>Item Name</th><th>Item Code</th><th>Quantity</th><th>Total Price</th><th>Sales Tax</th><th>Payment Method</th><th>Shipping Address</th><th>Discounts</th><th>Final Price</th><th>Actions</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['so_number'] . "</td>";
                echo "<td>" . $row['so_date'] . "</td>";
                echo "<td>" . $row['customer_name'] . "</td>";
                echo "<td>" . $row['customer_contact'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['item_code'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['total_price'] . "</td>";
                echo "<td>" . $row['sales_tax'] . "</td>";
                echo "<td>" . $row['payment_method'] . "</td>";
                echo "<td>" . $row['shipping_address'] . "</td>";
                echo "<td>" . $row['discounts'] . "</td>";
                echo "<td>" . $row['final_price'] . "</td>";
                echo "<td>
                    <form method='post' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='so_number' value='" . $row['so_number'] . "'>
                        <input type='hidden' name='so_date' value='" . $row['so_date'] . "'>
                        <input type='hidden' name='customer_name' value='" . $row['customer_name'] . "'>
                        <input type='hidden' name='customer_contact' value='" . $row['customer_contact'] . "'>
                        <input type='hidden' name='item_name' value='" . $row['item_name'] . "'>
                        <input type='hidden' name='item_code' value='" . $row['item_code'] . "'>
                        <input type='hidden' name='quantity' value='" . $row['quantity'] . "'>
                        <input type='hidden' name='total_price' value='" . $row['total_price'] . "'>
                        <input type='hidden' name='sales_tax' value='" . $row['sales_tax'] . "'>
                        <input type='hidden' name='payment_method' value='" . $row['payment_method'] . "'>
                        <input type='hidden' name='shipping_address' value='" . $row['shipping_address'] . "'>
                        <input type='hidden' name='discounts' value='" . $row['discounts'] . "'>
                        <input type='hidden' name='final_price' value='" . $row['final_price'] . "'>
                        <input type='submit' name='edit_sales_order' value='Edit'>
                    </form>
                    <form method='post' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' name='delete_sales_order' value='Delete'>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No sales orders found.</p>";
        }
        ?>
    </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll("input[name='edit_sales_order']");
            editButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = event.target.closest('form');
                    const id = form.querySelector("input[name='id']").value;
                    const so_number = form.querySelector("input[name='so_number']").value;
                    const so_date = form.querySelector("input[name='so_date']").value;
                    const customer_name = form.querySelector("input[name='customer_name']").value;
                    const customer_contact = form.querySelector("input[name='customer_contact']").value;
                    const item_name = form.querySelector("input[name='item_name']").value;
                    const item_code = form.querySelector("input[name='item_code']").value;
                    const quantity = form.querySelector("input[name='quantity']").value;
                    const total_price = form.querySelector("input[name='total_price']").value;
                    const sales_tax = form.querySelector("input[name='sales_tax']").value;
                    const payment_method = form.querySelector("input[name='payment_method']").value;
                    const shipping_address = form.querySelector("input[name='shipping_address']").value;
                    const discounts = form.querySelector("input[name='discounts']").value;
                    const final_price = form.querySelector("input[name='final_price']").value;

                    document.getElementById('id').value = id;
                    document.getElementById('so_number').value = so_number;
                    document.getElementById('so_date').value = so_date;
                    document.getElementById('customer_name').value = customer_name;
                    document.getElementById('customer_contact').value = customer_contact;
                    document.getElementById('item_name').value = item_name;
                    document.getElementById('item_code').value = item_code;
                    document.getElementById('quantity').value = quantity;
                    document.getElementById('total_price').value = total_price;
                    document.getElementById('sales_tax').value = sales_tax;
                    document.getElementById('payment_method').value = payment_method;
                    document.getElementById('shipping_address').value = shipping_address;
                    document.getElementById('discounts').value = discounts;
                    document.getElementById('final_price').value = final_price;

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        });
    </script>
</body>
</html>

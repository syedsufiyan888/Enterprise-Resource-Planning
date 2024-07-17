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
    if (isset($_POST['add_purchase_order'])) {
        $po_number = sanitize_input($_POST['po_number']);
        $po_date = sanitize_input($_POST['po_date']);
        $vendor_name = sanitize_input($_POST['vendor_name']);
        $vendor_contact = sanitize_input($_POST['vendor_contact']);
        $item_name = sanitize_input($_POST['item_name']);
        $item_code = sanitize_input($_POST['item_code']);
        $quantity = sanitize_input($_POST['quantity']);
        $unit_price = sanitize_input($_POST['unit_price']);
        $total_price = $quantity * $unit_price;
        $delivery_date = sanitize_input($_POST['delivery_date']);
        $payment_method = sanitize_input($_POST['payment_method']);
        $payment_terms = sanitize_input($_POST['payment_terms']);
        $shipping_address = sanitize_input($_POST['shipping_address']);
        $shipping_method = sanitize_input($_POST['shipping_method']);
        $freight_charges = sanitize_input($_POST['freight_charges']);

        $sql = "INSERT INTO purchase_orders (po_number, po_date, vendor_name, vendor_contact, item_name, item_code, quantity, unit_price, total_price, delivery_date, payment_method, payment_terms, shipping_address, shipping_method, freight_charges) 
                VALUES ('$po_number', '$po_date', '$vendor_name', '$vendor_contact', '$item_name', '$item_code', '$quantity', '$unit_price', '$total_price', '$delivery_date', '$payment_method', '$payment_terms', '$shipping_address', '$shipping_method', '$freight_charges')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>New purchase order added successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['update_purchase_order'])) {
        $id = intval($_POST['id']);
        $po_number = sanitize_input($_POST['po_number']);
        $po_date = sanitize_input($_POST['po_date']);
        $vendor_name = sanitize_input($_POST['vendor_name']);
        $vendor_contact = sanitize_input($_POST['vendor_contact']);
        $item_name = sanitize_input($_POST['item_name']);
        $item_code = sanitize_input($_POST['item_code']);
        $quantity = sanitize_input($_POST['quantity']);
        $unit_price = sanitize_input($_POST['unit_price']);
        $total_price = $quantity * $unit_price;
        $delivery_date = sanitize_input($_POST['delivery_date']);
        $payment_method = sanitize_input($_POST['payment_method']);
        $payment_terms = sanitize_input($_POST['payment_terms']);
        $shipping_address = sanitize_input($_POST['shipping_address']);
        $shipping_method = sanitize_input($_POST['shipping_method']);
        $freight_charges = sanitize_input($_POST['freight_charges']);

        $sql = "UPDATE purchase_orders SET po_number='$po_number', po_date='$po_date', vendor_name='$vendor_name', vendor_contact='$vendor_contact', item_name='$item_name', item_code='$item_code', quantity='$quantity', unit_price='$unit_price', total_price='$total_price', delivery_date='$delivery_date', payment_method='$payment_method', payment_terms='$payment_terms', shipping_address='$shipping_address', shipping_method='$shipping_method', freight_charges='$freight_charges' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Purchase order updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
        }
    } elseif (isset($_POST['delete_purchase_order'])) {
        $id = intval($_POST['id']);

        $sql = "DELETE FROM purchase_orders WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Purchase order deleted successfully</p>";
        } else {
            echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
        }
    }
}

// Query the database for existing purchase orders
$sql = "SELECT * FROM purchase_orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order Management</title>
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
    <section id="purchase_order_management">
        <h2>Purchase Order Management</h2>
        <form method="post">
            <input type="hidden" id="id" name="id">
            <label for="po_number">PO Number:</label>
            <input type="text" id="po_number" name="po_number" required>
            <label for="po_date">PO Date:</label>
            <input type="date" id="po_date" name="po_date" required>
            <label for="vendor_name">Vendor Name:</label>
            <input type="text" id="vendor_name" name="vendor_name" required>
            <label for="vendor_contact">Vendor Contact:</label>
            <input type="text" id="vendor_contact" name="vendor_contact" required>
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required>
            <label for="item_code">Item Code:</label>
            <input type="text" id="item_code" name="item_code" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="unit_price">Unit Price:</label>
            <input type="number" step="0.01" id="unit_price" name="unit_price" required>
            <label for="delivery_date">Delivery Date:</label>
            <input type="date" id="delivery_date" name="delivery_date" required>
            <label for="payment_method">Payment Method:</label>
            <input type="text" id="payment_method" name="payment_method" required>
            <label for="payment_terms">Payment Terms:</label>
            <input type="text" id="payment_terms" name="payment_terms" required>
            <label for="shipping_address">Shipping Address:</label>
            <input type="text" id="shipping_address" name="shipping_address" required>
            <label for="shipping_method">Shipping Method:</label>
            <input type="text" id="shipping_method" name="shipping_method" required>
            <label for="freight_charges">Freight Charges:</label>
            <input type="number" step="0.01" id="freight_charges" name="freight_charges" required>
            <input type="submit" name="add_purchase_order" value="Add Purchase Order">
            <input type="submit" name="update_purchase_order" value="Update Purchase Order">
           
        </form>
        
        <h3>Purchase Orders List</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='po-table'>";
            echo "<thead><tr><th>PO Number</th><th>PO Date</th><th>Vendor Name</th><th>Vendor Contact</th><th>Item Name</th><th>Item Code</th><th>Quantity</th><th>Unit Price</th><th>Total Price</th><th>Delivery Date</th><th>Payment Method</th><th>Payment Terms</th><th>Shipping Address</th><th>Shipping Method</th><th>Freight Charges</th><th>Actions</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['po_number'] . "</td>";
                echo "<td>" . $row['po_date'] . "</td>";
                echo "<td>" . $row['vendor_name'] . "</td>";
                echo "<td>" . $row['vendor_contact'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['item_code'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['unit_price'] . "</td>";
                echo "<td>" . $row['total_price'] . "</td>";
                echo "<td>" . $row['delivery_date'] . "</td>";
                echo "<td>" . $row['payment_method'] . "</td>";
                echo "<td>" . $row['payment_terms'] . "</td>";
                echo "<td>" . $row['shipping_address'] . "</td>";
                echo "<td>" . $row['shipping_method'] . "</td>";
                echo "<td>" . $row['freight_charges'] . "</td>";
                echo "<td>
                    <form method='post' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='po_number' value='" . $row['po_number'] . "'>
                        <input type='hidden' name='po_date' value='" . $row['po_date'] . "'>
                        <input type='hidden' name='vendor_name' value='" . $row['vendor_name'] . "'>
                        <input type='hidden' name='vendor_contact' value='" . $row['vendor_contact'] . "'>
                        <input type='hidden' name='item_name' value='" . $row['item_name'] . "'>
                        <input type='hidden' name='item_code' value='" . $row['item_code'] . "'>
                        <input type='hidden' name='quantity' value='" . $row['quantity'] . "'>
                        <input type='hidden' name='unit_price' value='" . $row['unit_price'] . "'>
                        <input type='hidden' name='total_price' value='" . $row['total_price'] . "'>
                        <input type='hidden' name='delivery_date' value='" . $row['delivery_date'] . "'>
                        <input type='hidden' name='payment_method' value='" . $row['payment_method'] . "'>
                        <input type='hidden' name='payment_terms' value='" . $row['payment_terms'] . "'>
                        <input type='hidden' name='shipping_address' value='" . $row['shipping_address'] . "'>
                        <input type='hidden' name='shipping_method' value='" . $row['shipping_method'] . "'>
                        <input type='hidden' name='freight_charges' value='" . $row['freight_charges'] . "'>
                        <input type='submit' name='edit_purchase_order' value='Edit'>
                    </form>
                    <form method='post' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' name='delete_purchase_order' value='Delete'>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No purchase orders found.</p>";
        }
        ?>
    </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll("input[name='edit_purchase_order']");
            editButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = event.target.closest('form');
                    const id = form.querySelector("input[name='id']").value;
                    const po_number = form.querySelector("input[name='po_number']").value;
                    const po_date = form.querySelector("input[name='po_date']").value;
                    const vendor_name = form.querySelector("input[name='vendor_name']").value;
                    const vendor_contact = form.querySelector("input[name='vendor_contact']").value;
                    const item_name = form.querySelector("input[name='item_name']").value;
                    const item_code = form.querySelector("input[name='item_code']").value;
                    const quantity = form.querySelector("input[name='quantity']").value;
                    const unit_price = form.querySelector("input[name='unit_price']").value;
                    const delivery_date = form.querySelector("input[name='delivery_date']").value;
                    const payment_method = form.querySelector("input[name='payment_method']").value;
                    const payment_terms = form.querySelector("input[name='payment_terms']").value;
                    const shipping_address = form.querySelector("input[name='shipping_address']").value;
                    const shipping_method = form.querySelector("input[name='shipping_method']").value;
                    const freight_charges = form.querySelector("input[name='freight_charges']").value;

                    document.getElementById('id').value = id;
                    document.getElementById('po_number').value = po_number;
                    document.getElementById('po_date').value = po_date;
                    document.getElementById('vendor_name').value = vendor_name;
                    document.getElementById('vendor_contact').value = vendor_contact;
                    document.getElementById('item_name').value = item_name;
                    document.getElementById('item_code').value = item_code;
                    document.getElementById('quantity').value = quantity;
                    document.getElementById('unit_price').value = unit_price;
                    document.getElementById('delivery_date').value = delivery_date;
                    document.getElementById('payment_method').value = payment_method;
                    document.getElementById('payment_terms').value = payment_terms;
                    document.getElementById('shipping_address').value = shipping_address;
                    document.getElementById('shipping_method').value = shipping_method;
                    document.getElementById('freight_charges').value = freight_charges;

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        });
    </script>
</body>
</html>

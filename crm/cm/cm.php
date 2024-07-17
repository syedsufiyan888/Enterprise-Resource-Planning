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

// Add or Update Customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_customer'])) {
        $first_name = sanitize_input($_POST['first_name']);
        $last_name = sanitize_input($_POST['last_name']);
        $email = sanitize_input($_POST['email']);
        $phone = sanitize_input($_POST['phone']);
        $address = sanitize_input($_POST['address']);
        $city = sanitize_input($_POST['city']);
        $state = sanitize_input($_POST['state']);
        $zip_code = sanitize_input($_POST['zip_code']);
        $country = sanitize_input($_POST['country']);
        $purchase_history = sanitize_input($_POST['purchase_history']);
        $communication_preferences = sanitize_input($_POST['communication_preferences']);

        $sql = "INSERT INTO customers (first_name, last_name, email, phone, address, city, state, zip_code, country, purchase_history, communication_preferences) 
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$city', '$state', '$zip_code', '$country', '$purchase_history', '$communication_preferences')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Customer added successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    if (isset($_POST['update_customer'])) {
        $id = $_POST['customer_id'];
        $first_name = sanitize_input($_POST['first_name']);
        $last_name = sanitize_input($_POST['last_name']);
        $email = sanitize_input($_POST['email']);
        $phone = sanitize_input($_POST['phone']);
        $address = sanitize_input($_POST['address']);
        $city = sanitize_input($_POST['city']);
        $state = sanitize_input($_POST['state']);
        $zip_code = sanitize_input($_POST['zip_code']);
        $country = sanitize_input($_POST['country']);
        $purchase_history = sanitize_input($_POST['purchase_history']);
        $communication_preferences = sanitize_input($_POST['communication_preferences']);

        $sql = "UPDATE customers 
                SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', address='$address', city='$city', state='$state', zip_code='$zip_code', country='$country', purchase_history='$purchase_history', communication_preferences='$communication_preferences' 
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Customer updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Retrieve all customers from the database
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
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
    <section id="customer_management">
        <h2>Customer Management</h2>
        
        <!-- Add Customer Form -->
        <h3>Add Customer</h3>
        <form method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
            <label for="city">City:</label>
            <input type="text" id="city" name="city">
            <label for="state">State:</label>
            <input type="text" id="state" name="state">
            <label for="zip_code">ZIP Code:</label>
            <input type="text"
			id="zip_code" name="zip_code">
<label for="country">Country:</label>
<input type="text" id="country" name="country">
<label for="purchase_history">Purchase History:</label>
<textarea id="purchase_history" name="purchase_history"></textarea>
<label for="communication_preferences">Communication Preferences:</label>
<textarea id="communication_preferences" name="communication_preferences"></textarea>
<input type="submit" name="add_customer" value="Add Customer">
</form>
    <!-- Display customer records -->
    <h3>Customer Records</h3>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='customer-table'>";
        echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>City</th><th>State</th><th>ZIP Code</th><th>Country</th><th>Purchase History</th><th>Communication Preferences</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['zip_code'] . "</td>";
            echo "<td>" . $row['country'] . "</td>";
            echo "<td>" . $row['purchase_history'] . "</td>";
            echo "<td>" . $row['communication_preferences'] . "</td>";
            echo "<td><a href='edit_customer.php?id=" . $row['id'] . "'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No customers found.</p>";
    }
    ?>
</section>
</div>
</body>
</html>
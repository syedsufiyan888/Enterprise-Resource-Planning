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

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    
    // Fetch customer details from the database
    $sql = "SELECT * FROM customers WHERE id = $customer_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
    } else {
        echo "<p>No customer found with ID: $customer_id</p>";
        exit;
    }
} else {
    echo "<p>Invalid request</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_customer'])) {
    $id = $_POST['id'];
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
        echo "<p style='color: red;'>Error updating customer: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
        <section id="edit_customer">
            <h2>Edit Customer</h2>
			<form method="post" action="update_customer.php">



			
                <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $customer['first_name']; ?>" required>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $customer['last_name']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $customer['phone']; ?>">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $customer['address']; ?>">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $customer['city']; ?>">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" value="<?php echo $customer['state']; ?>">
                <label for="zip_code">ZIP Code:</label>
                <input type="text" id="zip_code" name="zip_code" value="<?php echo $customer['zip_code']; ?>">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $customer['country']; ?>">
                <label for="purchase_history">Purchase History:</label>
                <textarea id="purchase_history" name="purchase_history"><?php echo $customer['purchase_history']; ?></textarea>
                <label for="communication_preferences">Communication Preferences:</label>
                <textarea id="communication_preferences" name="communication_preferences"><?php echo $customer['communication_preferences']; ?></textarea>
                
				<input type="submit" name="update_customer" value="Update Customer">
            </form>
        </section>
    </div>
</body>
</html>

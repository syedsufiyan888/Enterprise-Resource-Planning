<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}
?>



<?php
include('../../db_connect.php');

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
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
        // Update successful, redirect back to customer management panel
        header("Location: cm.php");
        exit();
    } else {
        echo "<p style='color: red;'>Error updating customer: " . $conn->error . "</p>";
    }
} else {
    echo "<p>Invalid request</p>";
}
?>

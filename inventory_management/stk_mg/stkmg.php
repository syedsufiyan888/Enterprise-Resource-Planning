<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../includes/login.php');
    exit;
}

include('../../db_connect.php');
include '../../sidebar.php';

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle Add Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_stock'])) {
    $product_id = sanitize_input($_POST['product_id']);
    $quantity = sanitize_input($_POST['quantity']);
    $movement_type = sanitize_input($_POST['movement_type']);
    $notes = sanitize_input($_POST['notes']);

    $sql = "INSERT INTO stock_movement (product_id, quantity, movement_type, notes) 
            VALUES ('$product_id', '$quantity', '$movement_type', '$notes')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Stock movement added successfully</p>";
    } else {
        echo "<p style='color: red;'>Error adding stock movement: " . $conn->error . "</p>";
    }
}

// Handle Update Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_stock'])) {
    $id = sanitize_input($_POST['id']);
    $product_id = sanitize_input($_POST['product_id']);
    $quantity = sanitize_input($_POST['quantity']);
    $movement_type = sanitize_input($_POST['movement_type']);
    $notes = sanitize_input($_POST['notes']);

    $sql = "UPDATE stock_movement SET 
            product_id = '$product_id', 
            quantity = '$quantity', 
            movement_type = '$movement_type', 
            notes = '$notes' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Stock movement updated successfully</p>";
    } else {
        echo "<p style='color: red;'>Error updating stock movement: " . $conn->error . "</p>";
    }
}

// Handle Delete Operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_stock'])) {
    $id = sanitize_input($_POST['id']);
    
    $sql = "DELETE FROM stock_movement WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Stock movement deleted successfully</p>";
    } else {
        echo "<p style='color: red;'>Error deleting stock movement: " . $conn->error . "</p>";
    }
}

// Fetch Stock Movement Data for Editing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_stock'])) {
    $id = sanitize_input($_POST['id']);
    
    $sql = "SELECT * FROM stock_movement WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $movement_type = $row['movement_type'];
        $notes = $row['notes'];
    }
}

// Query the database for existing stock movements
$sql = "SELECT * FROM stock_movement";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
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
        .inline-form {
            display: inline-block;
            margin-right: 10px; /* Adjust margin as needed */
        }
    </style>
</head>
<body>
 <a href="javascript:history.back()" class="back-button">Back</a>
    <div class="content">
        <section id="stock_management">
            <h2>Stock Management</h2>
            
            <!-- Form for adding and updating stock movements -->
            <form method="post">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                <label for="product_id">Product ID:</label>
                <input type="text" id="product_id" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>" required>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>" required>
                <label for="movement_type">Movement Type:</label>
                <select id="movement_type" name="movement_type" required>
                    <option value="inbound" <?php if (isset($movement_type) && $movement_type == 'inbound') echo 'selected'; ?>>Inbound</option>
                    <option value="outbound" <?php if (isset($movement_type) && $movement_type == 'outbound') echo 'selected'; ?>>Outbound</option>
                </select>
                <label for="notes">Notes:</label>
                <textarea id="notes" name="notes"><?php echo isset($notes) ? $notes : ''; ?></textarea>

                <?php if (isset($id)): ?>
                    <input type="submit" name="update_stock" value="Update Stock Movement">
                <?php else: ?>
                    <input type="submit" name="add_stock" value="Add Stock Movement">
                <?php endif; ?>
            </form>
            
            <h3>Stock Movements List</h3>
            <?php
            if ($result->num_rows > 0) {
                echo "<table class='stock-table'>";
                echo "<thead><tr><th>Product ID</th><th>Quantity</th><th>Movement Type</th><th>Notes</th><th>Actions</th></tr></thead>";
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['movement_type'] . "</td>";
                    echo "<td>" . $row['notes'] . "</td>";
                    echo "<td>";
                    echo "<form method='post' class='inline-form'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' name='edit_stock' value='Edit'>";
                    echo "</form>";
                    echo "<form method='post' class='inline-form'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' name='delete_stock' value='Delete'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No stock movements found.</p>";
            }
            ?>
        </section>
    </div>
</body>
</html>

<?php
$conn->close();
?>

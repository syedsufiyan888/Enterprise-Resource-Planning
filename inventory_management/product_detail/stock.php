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
    if (isset($_POST['add_product'])) {
        // Sanitize input data for adding
        $product_name = sanitize_input($_POST['product_name']);
        $sku = sanitize_input($_POST['sku']);
        $category = sanitize_input($_POST['category']);
        $description = sanitize_input($_POST['description']);
        $price = sanitize_input($_POST['price']);
        $stock = sanitize_input($_POST['stock']);

        // SQL query to insert data into products table
        $sql = "INSERT INTO products (product_name, sku, category, description, price, stock) 
                VALUES ('$product_name', '$sku', '$category', '$description', '$price', '$stock')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Product added successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['update_product'])) {
        // Sanitize input data for updating
        $id = sanitize_input($_POST['id']);
        $product_name = sanitize_input($_POST['product_name']);
        $sku = sanitize_input($_POST['sku']);
        $category = sanitize_input($_POST['category']);
        $description = sanitize_input($_POST['description']);
        $price = sanitize_input($_POST['price']);
        $stock = sanitize_input($_POST['stock']);

        // SQL query to update data in products table
        $sql = "UPDATE products SET product_name='$product_name', sku='$sku', category='$category', description='$description', price='$price', stock='$stock' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Product updated successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } elseif (isset($_POST['delete_product'])) {
        // Sanitize input data for deleting
        $id = sanitize_input($_POST['id']);

        // SQL query to delete data from products table
        $sql = "DELETE FROM products WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Product deleted successfully</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Query the database for existing products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
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
    <section id="product_management">
        <h2>Product Management</h2>
        <form method="post">
            <input type="hidden" id="id" name="id">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <label for="sku">SKU:</label>
            <input type="text" id="sku" name="sku" required>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
            <input type="submit" name="add_product" value="Add Product">
            <input type="submit" name="update_product" value="Update Product">
            <input type="submit" name="delete_product" value="Delete Product">
        </form>
        
        <h3>Product List</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='product-table'>";
            echo "<thead><tr><th>ID</th><th>Product Name</th><th>SKU</th><th>Category</th><th>Description</th><th>Price</th><th>Stock</th><th>Action</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['sku'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>
                        <button onclick=\"editProduct(" . $row['id'] . ", '" . $row['product_name'] . "', '" . $row['sku'] . "', '" . $row['category'] . "', '" . $row['description'] . "', " . $row['price'] . ", " . $row['stock'] . ")\">Edit</button>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </section>
    </div>
    <script>
        function editProduct(id, product_name, sku, category, description, price, stock) {
            document.getElementById('id').value = id;
            document.getElementById('product_name').value = product_name;
            document.getElementById('sku').value = sku;
            document.getElementById('category').value = category;
            document.getElementById('description').value = description;
            document.getElementById('price').value = price;
            document.getElementById('stock').value = stock;
        }
    </script>
</body>
</html>

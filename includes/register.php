<?php
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db_connect.php');
    
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect to login.php after successful sign-up
        header("Location: login.php");
        exit();
    } else {
        $message = "<p class='error'>Error creating user</p>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="rstyle.css">
</head>
<body>
    <div class="login-form">
        <?php echo $message; ?>
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Sign Up">
        </form>
		<p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
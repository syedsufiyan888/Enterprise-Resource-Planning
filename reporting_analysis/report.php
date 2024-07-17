<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../includes/login.php');
    exit;
}
?>



<!DOCTYPE html>
<html>
<head>
    <base href="/erp0/">
    <title>Dashboard</title>
    <!-- Include CSS styles -->
    <link rel="stylesheet" type="text/css" href="planning/style.css">
    <link rel="stylesheet" type="text/css" href="istyle.css">
</head>
<body>
    <!-- Include sidebar -->
	<?php include __DIR__ . '/../sidebar.php'; ?>
    
    
    <div class="content">
        <h1>Reports</h1>
        <div class="options">
            <h2><a href="reporting_analysis/s_r/sreport.php" class="button">Sales Report</a></h2>
            <h2><a href="reporting_analysis/i_r/ireport.php" class="button">Inventory Report</a></h2>
        </div>
    </div>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: includes/login.php');
    exit;
}

function getItemColor($index) {
    $colors = ['#3498db', '#2ecc71', '#e74c3c', '#f39c12', '#9b59b6', '#1abc9c'];
    return $colors[$index % count($colors)];
}

function displayData($conn, $table, $field, $icon, $title, $link, $index) {
    $sql = "SELECT COUNT(*) as count FROM $table";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $color = getItemColor($index);
    echo '<a href="' . $link . '" class="dashboard-item" style="--item-color: ' . $color . ';">';
    echo '<i class="' . $icon . '"></i>';
    echo '<h3>' . $title . '</h3>';
    echo '<p>' . $row['count'] . ' ' . $field . '</p>';
    echo '</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Resource Planning - Dashboard</title>
    <link rel="stylesheet" href="fonts/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="istyle.css">
    <script src="js/chart.js"></script>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <header>
            <h1>Enterprise Resource Planning</h1>
            <div class="header-actions">
                <a href="includes/logout.php" class="logout-btn">Logout</a>
            </div>
        </header>

        <div class="dashboard-grid">
            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "erp0");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $index = 0;
            displayData($conn, "customers", "Customers", "fas fa-users", "Total Customers", "/erp0/crm/crm.php", $index++);
            displayData($conn, "employee_info", "Employees", "fas fa-id-badge", "Total Employees", "/erp0/human_resource/hr.php", $index++);
            displayData($conn, "products", "Products", "fas fa-box", "Total Products", "/erp0/inventory_management/inventory.php", $index++);
            displayData($conn, "projects", "Projects", "fas fa-project-diagram", "Active Projects", "/erp0/planning/planning.php", $index++);
            ?>

            <div class="dashboard-item financial" style="--item-color: <?php echo getItemColor($index++); ?>;">
                <i class="fas fa-chart-line"></i>
                <h3>Financial Overview</h3>
                <canvas id="financialChart"></canvas>
            </div>

            <div class="dashboard-item tasks" style="--item-color: <?php echo getItemColor($index++); ?>;">
                <i class="fas fa-tasks"></i>
                <h3>Task Progress</h3>
                <canvas id="taskChart"></canvas>
            </div>

            <div class="dashboard-item stock" style="--item-color: <?php echo getItemColor($index++); ?>;">
                <i class="fas fa-warehouse"></i>
                <h3>Stock Overview</h3>
                <canvas id="stockChart"></canvas>
            </div>

            <div class="dashboard-item sales" style="--item-color: <?php echo getItemColor($index++); ?>;">
                <i class="fas fa-dollar-sign"></i>
                <h3>Sales Trend</h3>
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Enterprise Resource Planning. All rights reserved.</p>
        </footer>
    </div>

    <script>
        // Financial Overview Chart
        const financialCtx = document.getElementById('financialChart').getContext('2d');
        new Chart(financialCtx, {
            type: 'doughnut',
            data: {
                labels: ['Total Sales', 'Total Expenses'],
                datasets: [{
                    data: [
                        <?php
                        $sql = "SELECT SUM(total_price) as total_sales FROM sales_orders";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo $row['total_sales'];
                        ?>,
                        <?php
                        $sql = "SELECT SUM(amount) as total_expenses FROM expenses";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo $row['total_expenses'];
                        ?>
                    ],
                    backgroundColor: ['#2ecc71', '#e74c3c']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Task Progress Chart
        const taskCtx = document.getElementById('taskChart').getContext('2d');
        new Chart(taskCtx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    $sql = "SELECT task_name FROM tasks ORDER BY plan_end ASC LIMIT 5";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "'" . $row['task_name'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Task Progress',
                    data: [
                        <?php
                        $sql = "SELECT percent_complete FROM tasks ORDER BY plan_end ASC LIMIT 5";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['percent_complete'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: '#3498db'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Stock Overview Chart
        const stockCtx = document.getElementById('stockChart').getContext('2d');
        new Chart(stockCtx, {
            type: 'pie',
            data: {
                labels: [
                    <?php
                    $sql = "SELECT product_name FROM products LIMIT 5";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "'" . $row['product_name'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    data: [
                        <?php
                        $sql = "SELECT stock FROM products LIMIT 5";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['stock'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c', '#f39c12', '#9b59b6']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Sales Trend Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                            $sql = "SELECT SUM(total_price) as monthly_sales FROM sales_orders WHERE MONTH(so_date) = $i";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['monthly_sales'] . ",";
                        }
                        ?>
                    ],
                    borderColor: '#3498db',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const body = document.body;

            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-collapsed');
            });

            const dropdowns = document.querySelectorAll('.sidebar-dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.classList.toggle('open');
                });
            });
        });
    </script>
    <?php $conn->close(); ?>
</body>
</html>
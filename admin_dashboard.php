<?php
session_start();
include("dbconfig.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit;
}

// Fetch admin details
$email = $_SESSION['admin_email'];
$adminQuery = "SELECT name FROM admin WHERE email = '$email'";
$result = $conn->query($adminQuery);
if ($result->num_rows > 0) {
    $adminRow = $result->fetch_assoc();
    $adminName = $adminRow['name'];
} else {
    echo "Admin user not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="customer_dashboard_style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="logout-button">
            <form method="POST" action="logout_admin.php">
                <button type="submit">Logout</button>
            </form>
        </div>
        <h1>Welcome, <?php echo $adminName; ?>!</h1>
        <div class="options">
            <h2>Customer Management</h2>
            <ul>
                <li><a href="view_customers.php">View Customers</a></li>
            </ul>

            <h2>Staff Management</h2>
            <ul>
                <li><a href="view_staffs.php">View Staffs</a></li>
                <li><a href="add_staff.php">Add New Staff</a></li>
            </ul>

            <h2>Trainer Management</h2>
            <ul>
                <li><a href="view_trainers.php">View Trainers</a></li>
                <li><a href="add_trainer.php">Add Trainer</a></li>
            </ul>

            <h2>Membership Management</h2>
            <ul>
                <li><a href="view_memberships.php">View Memberships</a></li>
                <li><a href="add_membership.php">Add Membership</a></li>
            </ul>

            <h2>Payments Log</h2>
            <ul>
                <li><a href="view_payments.php">View Payments Log</a></li>
            </ul>

            <h2>Feedback Management</h2>
            <ul>
                <li><a href="view_feedbacks.php">View Feedback</a></li>
            </ul>
        </div>
    </div>
</body>
</html>

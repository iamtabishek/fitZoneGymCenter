<?php
session_start();

// Database connection
include("dbconfig.php");

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check user type
    $userTypeQuery = "SELECT user_type FROM usertypes WHERE email = '$email'";
    $userTypeResult = $conn->query($userTypeQuery);

    if ($userTypeResult->num_rows > 0) {
        $userTypeRow = $userTypeResult->fetch_assoc();
        $type = $userTypeRow['user_type'];

        if ($type === 'customer') {
            // Check credentials in `customers` table
            $customerQuery = "SELECT first_name, password FROM customers WHERE email = '$email'";
            $customerResult = $conn->query($customerQuery);

            if ($customerResult->num_rows > 0) {
                $customerRow = $customerResult->fetch_assoc();
                if (password_verify($password, $customerRow['password'])) {
                    // Password is correct; redirect to customer dashboard
                    $_SESSION['email'] = $email;
                    $_SESSION['type'] = $type;
                    $_SESSION['first_name'] = $customerRow['first_name'];
                    header("Location: customer_dashboard.php");
                    exit;
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No customer account found for this email.";
            }
        } elseif ($type === 'management') {
            // Check credentials in `management` table
            $managementQuery = "SELECT first_name, password FROM management WHERE email = '$email'";
            $managementResult = $conn->query($managementQuery);

            if ($managementResult->num_rows > 0) {
                $managementRow = $managementResult->fetch_assoc();
                if (password_verify($password, $managementRow['password'])) {
                    // Password is correct; redirect to management dashboard
                    $_SESSION['email'] = $email;
                    $_SESSION['type'] = $type;
                    $_SESSION['first_name'] = $managementRow['first_name'];
                    header("Location: management_dashboard.php");
                    exit;
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No management account found for this email.";
            }
        } else {
            echo "Invalid user type.";
        }
    } else {
        echo "No account found for this email.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginstyle.css">
    <script defer src="login.js"></script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST" id="loginForm">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <input type="checkbox" id="showPassword"> 
                <label for="showPassword">Show Password</label>
            </div>
            <button type="submit" class="login-btn">Log In</button>
            <p class="signup-link">Don't have an account? <a href="register.php">Sign up</a></p>
        </form>
    </div>

    
</body>
</html>


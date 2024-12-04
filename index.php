<?php
// Include database configuration file
include("dbconfig.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare SQL query to insert the data into the "questions" table
    $query = "INSERT INTO questions (name, email, message) VALUES (?, ?, ?)";

    // Prepare statement
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters to the SQL query
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to a success page or show a success message
            header("Location: index.php");
        } else {
            // If query execution fails
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If preparation of the SQL query fails
        echo "Error preparing the SQL query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone Fitness Center</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header Section -->
<header>
    <nav>
        <div class="logo">
            <h1>FitZone Fitness Center</h1>
        </div>
        <ul>
            <li><a href="#about">About Us</a></li>
            <li><a href="#classes">Classes</a></li>
            <li><a href="#trainers">Trainers</a></li>
            <li><a href="#membership">Membership</a></li>
            <li><a href="#blog">Blog</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h2>Welcome to FitZone Fitness Center</h2>
        <p>Your fitness journey starts here. Achieve your goals with the best trainers and facilities.</p>
        <a href="register.php" class="cta-button">Join Now</a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section">
    <h2>About FitZone</h2>
    <p>FitZone Fitness Center in Kurunegala offers a wide range of fitness programs, state-of-the-art equipment, and expert trainers to help you achieve your fitness goals. Our services include personalized training sessions, group classes, and nutrition counseling.</p>
</section>

<!-- Classes Section -->
<section id="classes" class="section">
    <h2>Our Classes</h2>
    <div class="classes">
        <div class="class-card">
            <h3>Cardio</h3>
            <p>Boost your heart health with intense cardio workouts.</p>
        </div>
        <div class="class-card">
            <h3>Strength Training</h3>
            <p>Build muscle and strength with our specialized programs.</p>
        </div>
        <div class="class-card">
            <h3>Yoga</h3>
            <p>Enhance flexibility and mindfulness with our yoga sessions.</p>
        </div>
    </div>
</section>

<!-- Trainers Section -->
<section id="trainers" class="section">
    <h2>Meet Our Trainers</h2>
    <div class="trainers">
        <div class="trainer-card">
            <img src="trainer1.jpg" alt="Trainer 1">
            <h3>Albert Einstein</h3>
            <p>Specialty: Strength Training</p>
        </div>
        <div class="trainer-card">
            <img src="trainer2.jpg" alt="Trainer 2">
            <h3>Isaac Newton</h3>
            <p>Specialty: Yoga & Pilates</p>
        </div>
        <div class="trainer-card">
            <img src="trainer3.jpg" alt="Trainer 3">
            <h3>Nikola Tesla</h3>
            <p>Specialty: Pilates</p>
        </div>
    </div>
</section>

<!-- Membership Plans Section -->
<section id="membership" class="section">
    <h2>Membership Plans</h2>
    <div class="membership-plans">
        <div class="plan">
            <h3>Basic Plan</h3>
            <p>Enjoy full access to all fitness equipment and participate in group classes.</p>
            <p>Price: LKR 2000</p>
        </div>
        
        <div class="plan">
            <h3>Standard Plan</h3>
            <p>Gain access to all gym facilities and a variety of group fitness classes.</p>
            <p>Price: LKR 3500</p>
        </div>
        
        <div class="plan">
            <h3>Premium Plan</h3>
            <p>Unlock premium access to all equipment, group classes, and exclusive perks.</p>
            <p>Price: LKR 5000</p>
        </div>
        
        <div class="plan">
            <h3>Student Plan</h3>
            <p>Designed for students, offering full access to gym equipment and group sessions.</p>
            <p>Price: LKR 3000</p>
        </div>
        
        <div class="plan">
            <h3>Online Plan</h3>
            <p>Receive personalized training sessions and expert nutrition guidance from the comfort of your home.</p>
            <p>Price: LKR 1500</p>
        </div>
        
    </div>
</section>

<!-- Blog Section -->
<section id="blog" class="section">
    <h2>Latest Blog Posts</h2>
    <div class="blog-posts">
        <div class="blog-post">
            <h3>Workout Tips for Beginners</h3>
            <p>Learn how to start your fitness journey with these simple tips.</p>
        </div>
        <div class="blog-post">
            <h3>Healthy Meal Plans</h3>
            <p>Fuel your body with nutritious meals that support your workout routine.</p>
        </div>
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact" class="section">
    <h2>Contact Us</h2>
    <p>Have questions? Reach out to us for more information or to get started with your fitness journey!</p>
    <form action="index.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        
        <button type="submit" class="cta-button">Send Message</button>
    </form>
</section>


<!-- Footer -->
<footer>
    <p>&copy; 2024 FitZone Fitness Center. All Rights Reserved.</p>
</footer>

</body>
</html>

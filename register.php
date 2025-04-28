<?php
// Include database connection
include("connection/connect.php");  

// Enable error reporting for debugging (remove or comment out in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "onlinefoodphp"); // Update with your credentials

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind (without created_at)
    $stmt = $conn->prepare("INSERT INTO admin (username, password, email) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Set parameters
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Debugging: Check if parameters are set correctly
    if (empty($username) || empty($password) || empty($email)) {
        die("Error: One or more fields are empty.");
    }

    // Optional: Check if username or email already exists
    $checkStmt = $conn->prepare("SELECT * FROM admin WHERE username = ? OR email = ?");
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Bind parameters and execute
        $stmt->bind_param("sss", $username, $password, $email);
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close connections
    $checkStmt->close();
    $stmt->close();
    $conn->close();
}
?>

<form action="register.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <input type="submit" value="Register">
</form>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "onlinefoodphp";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert user if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password
    $address = $_POST['address'];
    $status = $_POST['status'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, f_name, l_name, email, phone, password, address, status, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssis", $username, $f_name, $l_name, $email, $phone, $password, $address, $status, $role);
    $stmt->execute();
    echo "User added successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
    <h2>Add New User</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        
        <label>First Name:</label>
        <input type="text" name="f_name" required>
        
        <label>Last Name:</label>
        <input type="text" name="l_name" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Phone:</label>
        <input type="text" name="phone" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <label>Address:</label>
        <textarea name="address" required></textarea>
        
        <label>Status:</label>
        <select name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        
        <label>Role:</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        
        <button type="submit">Add User</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>

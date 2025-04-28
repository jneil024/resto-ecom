<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$db = 'onlinefoodphp';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'] ?? null;
    $new_status = $_POST['order_status'] ?? null;

    // Check if order_id and status exist
    if (empty($order_id) || empty($new_status)) {
        die("❌ Missing order ID or status.");
    }

    // Debugging output
    echo "✅ Order ID: " . htmlspecialchars($order_id) . "<br>";
    echo "✅ New Status: " . htmlspecialchars($new_status) . "<br>";

    // Update order status in the database
    $stmt = $pdo->prepare("UPDATE users_orders SET status = ? WHERE o_id = ?");
    if ($stmt->execute([$new_status, $order_id])) {
        header("Location: all_orders.php?status=updated");
        exit();
    } else {
        die("❌ Update failed.");
    }
}
?>

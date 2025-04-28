<?php
session_start();
include("connection/connect.php");

if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION["user_id"];
$username = trim($_POST['username']);
$f_name = trim($_POST['f_name']);
$l_name = trim($_POST['l_name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$password = trim($_POST['password']);
$address = trim($_POST['address']);


$sql = "UPDATE users SET ";
$updates = [];

if (!empty($username)) {
    $updates[] = "username = '".mysqli_real_escape_string($db, $username)."'";
}
if (!empty($f_name)) {
    $updates[] = "f_name = '".mysqli_real_escape_string($db, $f_name)."'";
}
if (!empty($l_name)) {
    $updates[] = "l_name = '".mysqli_real_escape_string($db, $l_name)."'";
}
if (!empty($email)) {
    $updates[] = "email = '".mysqli_real_escape_string($db, $email)."'";
}
if (!empty($phone)) {
    $updates[] = "phone = '".mysqli_real_escape_string($db, $phone)."'";
}
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
    $updates[] = "password = '$hashed_password'";
}
if (!empty($address)) {
    $updates[] = "address = '".mysqli_real_escape_string($db, $address)."'";
}

if (!empty($updates)) {
    $sql .= implode(", ", $updates) . " WHERE u_id = $user_id";

    if (mysqli_query($db, $sql)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($db) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('No changes were made.'); window.history.back();</script>";
}

mysqli_close($db); // Corrected from $conn to $db
?>

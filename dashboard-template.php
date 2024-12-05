<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<?php
session_start();
include('db.php');
include('sidebar.php');
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle Create Operation
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $name = $_POST['name'];
    $admin_type = $_POST['admin_type'];

    $sql = "INSERT INTO user_tbl (username, password, name, admin_type) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $name, $admin_type); 

    if ($stmt->execute()) {
        echo "User created successfully!";
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}

// Handle Update Operation
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $admin_type = $_POST['admin_type'];

    $sql = "UPDATE user_tbl SET username = ?, name = ?, admin_type = ? WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi", $username, $name, $admin_type, $user_id); // Correct order and types

    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
// Handle Delete Operation
if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM user_tbl WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
}

// Fetch All Users
$sql = "SELECT * FROM user_tbl";
$result = $con->query($sql);
?>

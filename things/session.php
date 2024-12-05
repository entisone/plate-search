<?php 
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /plate-search/login.php");
    exit();
}
?>
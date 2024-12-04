<?php
include('db.php');
include('template.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Login Form</title>
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="POST" action="">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
            <?php 
                include('login-process.php');
            ?>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
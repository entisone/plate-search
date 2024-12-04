<?php
session_start();
include('db.php');

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard <?php echo htmlspecialchars($_SESSION['name']); ?></title>
</head>
<body>
    <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <a href="logout.php">Logout</a>

    <h2>Manage Users</h2>

    <!-- Create User Form -->
    <form method="POST" action="">
        <h3>Create User</h3>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>User Type:</label>
        <select name="admin_type" id="admin_type">
            <?php 
                $query = "SELECT * FROM `admin_table`;"; 
                $AdminResult = $con->query($query); 
                
                if ($AdminResult->num_rows > 0)  
                { 
                    while($row = $AdminResult->fetch_assoc()) 
                    { 
                        echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                    } 
                }  
                else { 
                    echo "0 results"; 
                } 
            ?>
        </select>
        <button type="submit" name="create">Add User</button>
    </form>

    <!-- List of Users -->
    <h3>Users List</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>User Type</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['admin_type']); ?></td>
            <td>
                <!-- Update Form -->
                <form method="POST" action="" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                    <select name="admin_type" id="admin_type">
                        <option value="<?php echo $row['admin_type'] ?>"><?php echo $row['admin_type'] ?></option>
                    </select>
                    <button type="submit" name="update">Update</button>
                </form>

                <!-- Delete Form -->
                <form method="POST" action="" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php $con->close(); ?>
</body>
</html>

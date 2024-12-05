<?php 
include('dashboard-template.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="search.php">Plate Search</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li>
                    <label class="switch">
                        <input type="checkbox" id="theme-toggle">
                        <span class="slider"></span>
                    </label>
                </li>
            </ul>
        </div>
    <!-- Main Content -->
    <div class="main-content">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    
    <?php 
        if($_SESSION["admin_type"] == "Admin") {
    ?>
            <h1>Dashboard</h1>
            <div class="bento-grid">
                <div class="tile large" style="background-color: #0078D7;">
                <p>Total Plate Numbers: </p>
                    <br/>
                    <?php 
                        $PlateQuery = "SELECT COUNT(plate_numbers) AS total_count FROM plate_table;";
                        $PlateResult = $con->query($PlateQuery);
                        
                        if ($PlateResult->num_rows > 0) {
                            // Fetch and display the total count
                            $row = $PlateResult->fetch_assoc();
                            echo "<br/> " . $row['total_count'];
                        } else {
                            echo "No results found.";
                        }
                    ?>
            </div>
                <div class="tile medium" style="background-color: #E81123;">Tile 2</div>
                <div class="tile small" style="background-color: #F7630C;">Tile 3</div>
                <div class="tile medium" style="background-color: #FFF100;">Tile 4</div>
                <div class="tile large" style="background-color: #00B294;">Tile 5</div>
                <div class="tile small" style="background-color: #8E8CD8;">Tile 6</div>
            </div>
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
            <table border="1" id="userTable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Admin Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
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
                <?php } ?>
            </table>
        </div>
        <!-- ---------------------- -->
        <!-- Hamburger script -->
        <script>
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                sidebar.classList.toggle('open');
                mainContent.classList.toggle('shifted');
            });
            // <!-- Toggling Light and  Dark mode -->
            const themeToggle = document.getElementById('theme-toggle');
            const body = document.body;
    
            // Check localStorage for theme preference
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme) {
                body.classList.add(currentTheme);
                themeToggle.checked = currentTheme === 'dark-mode';
            }
    
            // Toggle theme on switch change
            themeToggle.addEventListener('change', () => {
                if (themeToggle.checked) {
                    body.classList.remove('light-mode');
                    body.classList.add('dark-mode');
                    localStorage.setItem('theme', 'dark-mode');
                } else {
                    body.classList.remove('dark-mode');
                    body.classList.add('light-mode');
                    localStorage.setItem('theme', 'light-mode');
                }
            });
            $(document).ready(function() {
                    $('#userTable').DataTable({
                        // Optional settings
                        paging: true,       // Enable pagination
                        searching: true,    // Enable search functionality
                        ordering: true,     // Enable column sorting
                        info: false,          // Show table information
                        pageLength: 10,
                        columnDefs: [
                            { orderable: false, targets: 3 } // Disable sorting on the 4th column (0-indexed)
                        ], // Show 10 rows per page
                        columns: [
                            { data: 'username' },
                            { data: 'name' },
                            { data: 'admin_type' },
                            { data: 'actions' }
                        ]
                    });
                });
        </script>
    </div>
</body>
<?php $con->close(); ?>
</html>



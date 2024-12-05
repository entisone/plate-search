<?php
include("db.php");

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
include("sidebar.php");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Live Search using AJAX</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="dashboard">
    <!-- Main Content -->
    <div class="main-content">
      <h1>Plate Search <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
      <input type="text" id="search" placeholder="Search" />
  <br>
  <br />
  <!-- Suggestions will be displayed in below div. -->
  <div id="display"></div>
  <?php
  $query = "select * from plate_table where office";
  $result = $con->query($query);
  ?>
    </div>
    <!-- Search box. -->
  
  </div>

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
  </script>
</body>

</html>
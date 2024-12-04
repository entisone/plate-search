<?php 
    include ("db.php");
    include ("template.php");
    session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
echo "Welcome, " . htmlspecialchars($_SESSION['name']) . "! <a href='logout.php'>Logout</a>";
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
<!-- Search box. -->
  <input type="text" id="search" placeholder="Search" />
  <br>
  <br />
  <!-- Suggestions will be displayed in below div. -->
  <div id="display"></div>
  <?php 
    $query = "select * from plate_table where office";
    $result = $con->query($query);
  ?>
</body>
</html>
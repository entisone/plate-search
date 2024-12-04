<?php

include "db.php";

if (isset($_POST['search'])) {

    $plate_numbers = $_POST['search'];

    // Updated query
    $Query = "SELECT plate_numbers FROM plate_table WHERE plate_numbers LIKE '%$plate_numbers%' LIMIT 1";

    $ExecQuery = MySQLi_query($con, $Query);

    // Check for results
    if (MySQLi_num_rows($ExecQuery) > 0) {
        echo '<ul>';
        while ($Result = MySQLi_fetch_array($ExecQuery)) {
            // Escape output for safety
            $plate_number = htmlspecialchars($Result['plate_numbers'], ENT_QUOTES, 'UTF-8');
            ?>
            <li onclick="fill('<?php echo $plate_number; ?>')">
                <a><?php echo $plate_number; ?></a> - Available
            </li>
            <?php
        }
        echo '</ul>';
    } else {
        echo '<ul><li>No results found</li></ul>';
    }
}
?>

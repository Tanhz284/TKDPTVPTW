<?php
// set_cookie.php - Set username cookie for 1 hour

$username = "Gulnara Serik";
setcookie("username", $username, time() + 3600, "/");

echo "<h2>Cookie 'username' has been set to: <strong>$username</strong></h2>";
echo "<p>It will expire in 1 hour.</p>";
echo '<p><a href="check_cookie.php">Click here to check the cookie</a></p>';
?>
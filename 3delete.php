<?php
// Delete cookie by setting expiry in the past
setcookie("username", "", time() - 3600, "/");
echo "<h2>Cookie 'username' has been deleted!</h2>";
echo '<a href="2-retrieve-cookie.php">Check if cookie is gone</a>';
?>
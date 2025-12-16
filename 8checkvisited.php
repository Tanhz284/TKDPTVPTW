<?php
if (isset($_COOKIE['visited'])) {
    echo "<h2>Welcome back! You've visited before.</h2>";
    echo "<p>Last visit: " . htmlspecialchars($_COOKIE['visited']) . "</p>";
} else {
    setcookie("visited", date("Y-m-d H:i:s"), time() + (86400 * 30), "/");
    echo "<h2>Welcome first-time visitor!</h2>";
}
?>
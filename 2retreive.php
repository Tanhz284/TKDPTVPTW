<?php
if (isset($_COOKIE['username'])) {
    echo "<h2>Welcome back, " . htmlspecialchars($_COOKIE['username']) . "!</h2>";
} else {
    echo "<h2>No username cookie found.</h2>";
}
?>
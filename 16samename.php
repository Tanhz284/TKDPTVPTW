<?php
session_start();

// Set both with same name
$_SESSION['username'] = "Session: Gulnara Serik";
setcookie("username", "Cookie: Gulnara Serik", time() + 3600, "/");

echo "<h2>Both set with name 'username'</h2>";
echo "<ul>";
echo "<li><strong>Session username:</strong> " . ($_SESSION['username'] ?? 'Not set') . "</li>";
echo "<li><strong>Cookie username:</strong> " . ($_COOKIE['username'] ?? 'Not available yet') . "</li>";
echo "</ul>";
echo "<p><a href=''>Refresh</a> to see cookie value appear</p>";
?>
<?php
session_start();

$now = date("Y-m-d H:i:s");
$_SESSION['last_access'] = $now;

if (isset($_SESSION['previous_access'])) {
    echo "<h2>Last access: " . $_SESSION['previous_access'] . "</h2>";
}
echo "<h2>Current access: $now</h2>";

$_SESSION['previous_access'] = $now;
?>
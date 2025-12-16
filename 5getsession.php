<?php
session_start();
if (isset($_SESSION['userid'])) {
    echo "<h2>User ID: " . $_SESSION['userid'] . "</h2>";
} else {
    echo "<h2>No userid in session.</h2>";
}
?>
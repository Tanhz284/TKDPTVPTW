<?php
session_start();

// Regenerate session ID and delete old one
session_regenerate_id(true);

$_SESSION['userid'] = 10020;
echo "<h2>Session ID regenerated securely!</h2>";
echo "New Session ID: " . session_id();
?>
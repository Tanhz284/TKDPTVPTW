<?php
session_start();

if (isset($_SESSION['preferences'])) {
    echo "<h2>Your Preferences:</h2><ul>";
    foreach ($_SESSION['preferences'] as $key => $value) {
        $val = is_bool($value) ? ($value ? 'Yes' : 'No') : htmlspecialchars($value);
        echo "<li><strong>" . ucfirst($key) . ":</strong> $val</li>";
    }
    echo "</ul>";
} else {
    echo "<h2>No preferences found.</h2>";
}
?>
<?php
session_start();

$timeout_duration = 1800; // 30 minutes

if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $timeout_duration) {
        session_unset();
        session_destroy();
        echo "<h2>Session expired due to inactivity!</h2>";
        exit;
    }
}

$_SESSION['last_activity'] = time();

if (!isset($_SESSION['userid'])) {
    $_SESSION['userid'] = 10020;
    echo "<h2>Session started! Active for 30 minutes.</h2>";
} else {
    echo "<h2>Session still active!</h2>";
}
?>
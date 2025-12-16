<?php
session_start();

$_SESSION['preferences'] = [
    'theme' => 'dark',
    'language' => 'en',
    'notifications' => true,
    'timezone' => 'Asia/Almaty'
];

echo "<h2>User preferences saved in session!</h2>";
?>
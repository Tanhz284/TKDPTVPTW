<?php
session_start();

$max_sessions = 3;
$session_file = "sessions/" . session_id() . ".txt";

if (!is_dir("sessions")) mkdir("sessions");

$file = "active_sessions.txt";
$sessions = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$sessions[session_id()] = time();
file_put_contents($file, json_encode($sessions));

// Clean old sessions (>30 min)
foreach ($sessions as $sid => $time) {
    if (time() - $time > 1800) unset($sessions[$sid]);
}

if (count($sessions) > $max_sessions) {
    session_destroy();
    die("<h2>Too many sessions! Max 3 allowed.</h2>");
}

echo "<h2>Session allowed. Total active: " . count($sessions) . "</h2>";
?>
<?php
session_start();
$file = "session_counter.txt";

if (!file_exists($file)) {
    file_put_contents($file, 0);
}

$count = (int)file_get_contents($file);
$count++;
file_put_contents($file, $count);

echo "<h2>Active sessions today: $count</h2>";
// Note: This is a simple example. Real tracking needs cleanup logic.
?>
<?php
session_start();
$role = $_GET['role'] ?? 'guest';
$names = ['admin'=>'Gulnara', 'user'=>'Alice', 'guest'=>'Bob'];
$_SESSION['user_role'] = $role;
$_SESSION['username'] = $names[$role];
$_SESSION['user_id'] = $role === 'admin' ? 1 : ($role === 'user' ? 2 : 3);
header("Location: index.php");
?>
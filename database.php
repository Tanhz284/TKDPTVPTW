<?php
function getUserPermissions($user_id) {
    $conn = mysqli_connect("localhost", "root", "", "rbac_demo");
    if (!$conn) die("Connection failed");

    $user_id = (int)$user_id;
    $sql = "SELECT p.permission_name 
            FROM users u
            JOIN roles r ON u.role_id = r.role_id
            JOIN role_permissions rp ON r.role_id = rp.role_id
            JOIN permissions p ON rp.permission_id = p.permission_id
            WHERE u.user_id = $user_id";

    $result = mysqli_query($conn, $sql);
    $permissions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $permissions[] = $row['permission_name'];
    }
    mysqli_close($conn);
    return $permissions;
}

// Demo
session_start();
$_SESSION['user_id'] = 1; // Change to test
$perms = getUserPermissions($_SESSION['user_id']);
echo "<h1>Database Permissions for User ID {$_SESSION['user_id']}</h1>";
echo "<ul>";
foreach ($perms as $p) echo "<li>$p</li>";
echo "</ul>";
?>
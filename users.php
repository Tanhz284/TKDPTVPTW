<?php
session_start();

// Exercise 1: Roles and Permissions
$roles = [
    'admin' => ['view_user', 'create_user', 'edit_user', 'delete_user', 'ban_user'],
    'user'  => ['view_user', 'edit_own_profile', 'change_password'],
    'guest' => ['view_user']
];

// Exercise 1: Assign roles to users
$users = [
    1 => ['name' => 'Gulnara', 'role' => 'admin'],
    2 => ['name' => 'Alice',  'role' => 'user'],
    3 => ['name' => 'Bob',    'role' => 'guest']
];

// Exercise 2: Permission checking function
function hasPermission($user_id, $permission) {
    global $users, $roles;
    if (!isset($users[$user_id])) return false;
    $role = $users[$user_id]['role'];
    return in_array($permission, $roles[$role] ?? []);
}

// Exercise 3: Session-based role management
function checkAccess($required_permission) {
    global $roles;
    $user_role = $_SESSION['user_role'] ?? 'guest';
    return in_array($required_permission, $roles[$user_role] ?? []);
}

// Demo
echo "<h1>Array-Based RBAC Demo</h1>";

// Simulate logged in user (change this)
$_SESSION['user_id'] = 1;        // Try 1 (admin), 2 (user), 3 (guest)
$_SESSION['user_role'] = $users[$_SESSION['user_id']]['role'] ?? 'guest';

echo "Logged in as: <strong>" . $users[$_SESSION['user_id']]['name'] . " ({$_SESSION['user_role']})</strong><br><br>";

$actions = ['view_user', 'edit_user', 'delete_user', 'ban_user', 'edit_own_profile'];

foreach ($actions as $action) {
    $has = checkAccess($action) ? "Yes" : "No";
    echo "Can <strong>$action</strong>: $has<br>";
}
?>
<br><a href="index.php">Back to Menu</a>
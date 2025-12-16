<?php
// check_permission.php  ← UPDATED VERSION (no duplicate session_start)

// Only start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Role → Permissions array
$roles = [
    'admin' => ['view_user', 'create_user', 'edit_user', 'delete_user', 'edit_own_profile'],
    'user'  => ['view_user', 'edit_own_profile'],
    'guest' => ['view_user']
];

function checkAccess($required_permission) {
    global $roles;
    $user_role = $_SESSION['user_role'] ?? 'guest';
    return in_array($required_permission, $roles[$user_role] ?? []);
}

function requirePermission($permission) {
    if (!checkAccess($permission)) {
        header("Location: unauthorized.php");
        exit();
    }
}
?>
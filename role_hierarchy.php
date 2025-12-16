<?php
// role_hierarchy.php - Get permissions with inheritance

if (session_status() === PHP_SESSION_NONE) session_start();

function getAllPermissions($user_id) {
    $conn = mysqli_connect("localhost", "root", "", "rbac_demo");
    if (!$conn) return [];

    $user_id = (int)$user_id;
    $sql = "SELECT r.role_id, r.role_name, r.parent_role_id 
            FROM users u 
            JOIN roles r ON u.role_id = r.role_id 
            WHERE u.user_id = $user_id";
    
    $result = mysqli_query($conn, $sql);
    $role = mysqli_fetch_assoc($result);
    if (!$role) return [];

    $permissions = [];
    $visited = []; // prevent infinite loops

    $current_role_id = $role['role_id'];

    while ($current_role_id && !in_array($current_role_id, $visited)) {
        $visited[] = $current_role_id;

        $sql = "SELECT p.permission_name FROM role_permissions rp
                JOIN permissions p ON rp.permission_id = p.permission_id
                WHERE rp.role_id = $current_role_id";
        
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            if (!in_array($row['permission_name'], $permissions)) {
                $permissions[] = $row['permission_name'];
            }
        }

        // Go to parent
        $sql = "SELECT parent_role_id FROM roles WHERE role_id = $current_role_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $current_role_id = $row['parent_role_id'] ?? null;
    }

    mysqli_close($conn);
    return $permissions;
}

// Demo
if (isset($_GET['test_user'])) {
    echo "<pre>";
    print_r(getAllPermissions($_GET['test_user']));
    echo "</pre>";
}
?>
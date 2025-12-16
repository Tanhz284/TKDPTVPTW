<?php
session_start();
if ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'super_admin') {
    die("Access denied. Admins only.");
}

$conn = mysqli_connect("localhost", "root", "", "rbac_demo");

// Add permission to role
if (isset($_POST['add'])) {
    $role_id = (int)$_POST['role_id'];
    $perm_id = (int)$_POST['permission_id'];
    mysqli_query($conn, "INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES ($role_id, $perm_id)");
}

// Remove permission
if (isset($_POST['remove'])) {
    $role_id = (int)$_POST['role_id'];
    $perm_id = (int)$_POST['permission_id'];
    mysqli_query($conn, "DELETE FROM role_permissions WHERE role_id = $role_id AND permission_id = $perm_id");
}

$roles_result = mysqli_query($conn, "SELECT * FROM roles");
$permissions_result = mysqli_query($conn, "SELECT * FROM permissions");
?>

<!DOCTYPE html>
<html>
<head><title>Manage Roles & Permissions</title></head>
<body>
<h1>Role & Permission Management (Admin)</h1>

<h2>Add/Remove Permissions</h2>
<form method="POST">
    <select name="role_id" required>
        <?php while($r = mysqli_fetch_assoc($roles_result)): ?>
            <option value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
        <?php endwhile; mysqli_data_seek($roles_result, 0); ?>
    </select>

    <select name="permission_id" required>
        <?php while($p = mysqli_fetch_assoc($permissions_result)): ?>
            <option value="<?= $p['permission_id'] ?>"><?= $p['permission_name'] ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit" name="add" style="background:green;color:white">Add Permission</button>
    <button type="submit" name="remove" style="background:red;color:white">Remove Permission</button>
</form>

<h2>Current Role Permissions</h2>
<table border="1" cellpadding="10">
<tr><th>Role</th><th>Permissions</th></tr>
<?php
mysqli_data_seek($roles_result, 0);
while($role = mysqli_fetch_assoc($roles_result)):
    $rid = $role['role_id'];
    $res = mysqli_query($conn, "SELECT p.permission_name FROM role_permissions rp JOIN permissions p ON rp.permission_id = p.permission_id WHERE rp.role_id = $rid");
?>
<tr>
    <td><strong><?= $role['role_name'] ?></strong><br>
        <small><?php if($role['parent_role_id']) {
            $pr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT role_name FROM roles WHERE role_id = {$role['parent_role_id']}"));
            echo "← inherits from <em>{$pr['role_name']}</em>";
        } ?></small>
    </td>
    <td>
        <?php
        $perms = [];
        while($p = mysqli_fetch_assoc($res)) $perms[] = $p['permission_name'];
        echo $perms ? implode(", ", $perms) : "<em>none</em>";
        ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br><a href="index.php">← Back to Menu</a>
</body>
</html>
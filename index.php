<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>RBAC Demo</title></head>
<body>
<h1>Welcome <?php echo $_SESSION['username'] ?? 'Guest'; ?>!</h1>

<h3>Menu:</h3>
<ul>
    <li><a href="login.php?role=admin">Login as Admin (Gulnara)</a></li>
    <li><a href="login.php?role=user">Login as User (Alice)</a></li>
    <li><a href="login.php?role=guest">Login as Guest (Bob)</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<?php if (isset($_SESSION['user_id'])): ?>
    <hr>
    <h3>Available Actions:</h3>
    <?php include 'check_permission.php'; ?>
    <ul>
        <?php if (checkAccess('view_user')): ?>
            <li><a href="users.php">View Users</a></li>
        <?php endif; ?>
        <?php if (checkAccess('create_user')): ?>
            <li><a href="#">Create User</a></li>
        <?php endif; ?>
        <?php if (checkAccess('edit_user')): ?>
            <li><a href="admin-page.php">Edit Users (Admin Only)</a></li>
        <?php endif; ?>
        <?php if (checkAccess('delete_user')): ?>
            <li><a href="#">Delete User (Danger!)</a></li>
        <?php endif; ?>
        <?php if (checkAccess('edit_own_profile')): ?>
            <li><a href="profile.php">Edit My Profile</a></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
</body>
</html>
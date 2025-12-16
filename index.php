<?php
include "connection.php";
?>
<html lang="en">
<head>
    <title>User Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="col-lg-4">
        <h2>User data form</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="firstname">First name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact" required>
            </div>
            <button type="submit" name="insert" class="btn btn-default">Insert</button>
            <button type="submit" name="update" class="btn btn-default">Update</button>
            <button type="submit" name="delete" class="btn btn-default">Delete</button>
        </form>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $res = mysqli_query($link, "SELECT * FROM table1") or die(mysqli_error($link));
            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["firstname"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["lastname"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
                echo "<td><a href='edit.php?id=" . $row["id"] . "'><button type='button' class='btn btn-success'>Edit</button></a></td>";
                echo "<td><a href='confirm_delete.php?id=" . $row["id"] . "'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
if (isset($_POST["insert"])) {
    mysqli_query($link, "INSERT INTO table1 VALUES (NULL, '" . mysqli_real_escape_string($link, $_POST['firstname']) . "', '" . mysqli_real_escape_string($link, $_POST['lastname']) . "', '" . mysqli_real_escape_string($link, $_POST['email']) . "', '" . mysqli_real_escape_string($link, $_POST['contact']) . "')") or die(mysqli_error($link));
    header("Location: index.php");
    exit();
}

if (isset($_POST["delete"])) {
    $res = mysqli_query($link, "SELECT id FROM table1 WHERE firstname='" . mysqli_real_escape_string($link, $_POST['firstname']) . "'");
    $row = mysqli_fetch_array($res);
    $id = $row['id'];
    mysqli_query($link, "DELETE FROM table1 WHERE id=$id") or die(mysqli_error($link));
    header("Location: index.php");
    exit();
}

if (isset($_POST["update"])) {
    $res = mysqli_query($link, "SELECT id FROM table1 WHERE firstname='" . mysqli_real_escape_string($link, $_POST['firstname']) . "'");
    $row = mysqli_fetch_array($res);
    $id = $row['id'];
    mysqli_query($link, "UPDATE table1 SET firstname='" . mysqli_real_escape_string($link, $_POST['firstname']) . "', lastname='" . mysqli_real_escape_string($link, $_POST['lastname']) . "', email='" . mysqli_real_escape_string($link, $_POST['email']) . "', contact='" . mysqli_real_escape_string($link, $_POST['contact']) . "' WHERE id=$id") or die(mysqli_error($link));
    header("Location: index.php");
    exit();
}
?>
</body>
</html>
<?php
include "connection.php";
$id = $_GET["id"];
$firstname = $lastname = $email = $contact = "";

$res = mysqli_query($link, "SELECT * FROM table1 WHERE id=$id") or die(mysqli_error($link));
while ($row = mysqli_fetch_array($res)) {
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $email = $row["email"];
    $contact = $row["contact"];
}
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
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-default">Update</button>
        </form>
    </div>
</div>
</body>
<?php
if (isset($_POST["update"])) {
    mysqli_query($link, "UPDATE table1 SET firstname='" . mysqli_real_escape_string($link, $_POST['firstname']) . "', lastname='" . mysqli_real_escape_string($link, $_POST['lastname']) . "', email='" . mysqli_real_escape_string($link, $_POST['email']) . "', contact='" . mysqli_real_escape_string($link, $_POST['contact']) . "' WHERE id=$id") or die(mysqli_error($link));
    header("Location: index.php");
    exit();
}
?>
</html>
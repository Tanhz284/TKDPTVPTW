<?php
include "connection.php";
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit();
}
?>
<html lang="en">
<head>
    <title>Confirm Delete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="col-lg-4">
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this item?</p>
        <form action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="confirm" value="yes" class="btn btn-danger">Yes</button>
            <a href="index.php" class="btn btn-default">No</a>
        </form>
    </div>
</div>
</body>
</html>
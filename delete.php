<?php
include "connection.php";
if (isset($_POST["confirm"]) && $_POST["confirm"] === "yes") {
    $id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    if ($id > 0) {
        mysqli_query($link, "DELETE FROM table1 WHERE id=$id") or die(mysqli_error($link));
    }
}
header("Location: index.php");
exit();
?>
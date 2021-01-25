<?php
require_once "db_connect.php";

$id = $_POST['id'];
$sqlDelete = "DELETE from tbl_events WHERE `category` = 2 AND id=".$id;

mysqli_query($conn, $sqlDelete);
echo mysqli_affected_rows($conn);

mysqli_close($conn);
?>
<?php
    require_once "db_connect.php";

    $json = array();
    $sqlQuery = "SELECT * FROM tbl_events where `category` = 2 ORDER BY id ";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($eventArray);
?>
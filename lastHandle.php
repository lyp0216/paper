<?php
if (isset($_GET["articleID"])) {
    require_once("cfg.php");
    require_once("sqlLink.php");

    $aid = $_GET["articleID"];

    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
    $sql = "UPDATE `article` SET `state`='5' WHERE `articleID`='$aid'";

    if (mysqli_query($link, $sql)){
        echo 1;
    }
    else {
        echo 0;
    }
    mysqli_close($link);
}
?>
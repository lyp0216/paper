<?php
require_once("cfg.php");
require_once("sqlLink.php");

$mail = $_REQUEST["m"];
$articleID = $_REQUEST["id"];
//$mail = $_REQUEST["mail"];

if ($mail != "") {
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);

    $sql = "SELECT `articleID`, `value`, `reply`, `mail` FROM `assigning` WHERE `articleID`='$articleID' AND `mail`='$mail' AND `reply`='2'";
	$result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "此學士已拒絕過評閱這篇文章!";
    }
    else
        echo "";

    mysqli_close($link);
}
?>
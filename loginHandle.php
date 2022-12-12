<?php
session_start();
require_once("cfg.php");
require_once("sqlLink.php");

$mail = $_GET["mail"];
$pwd = $_GET["pwd"];

$link = connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE) or die("無法開啟資料連接!<br/>");

$sql = "SELECT `id`, `pwd`, `mail`, `identity` FROM user WHERE pwd='$pwd' AND mail='$mail'";

$result = mysqli_query($link, $sql);

$total_records = mysqli_num_rows($result);

if($total_records > 0) {
    
    $userdata = mysqli_fetch_assoc($result);

    $_SESSION["userid"] = $userdata["id"];
    $_SESSION['identity'] = $userdata['identity'];
    
    echo $userdata['identity'];
}
else { //無此帳密
    echo -1;
}

mysqli_close($link);
?>
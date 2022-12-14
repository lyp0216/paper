<?php
function replyHandle($number, $reply, $pwd) {

    require_once("cfg.php");
	require_once("sqlLink.php");
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);

    $sqlcmd = "SELECT article.articleID, `abstract`, `mail`, `reply` FROM `article` INNER JOIN `assigning` ON article.articleID = assigning.articleID WHERE `value`='$number'";
    $result = mysqli_query($link, $sqlcmd);
    $datas = null;

    if (mysqli_num_rows($result) > 0) {
        $datas = mysqli_fetch_assoc($result);     
    }
    //沒資料代表編碼不吻合

    if ($datas != null) {

        //確認尚未回覆
        if ($datas['reply'] == "0" AND $reply==1 or $reply==2) {

            $articleID = $datas['articleID'];
            $mail = $datas['mail'];

            $sqlcmd = "UPDATE `assigning` SET `reply`='$reply' WHERE `articleID`='$articleID' AND `mail`='$mail'";
            
            if (mysqli_query($link, $sqlcmd)) {
                if ($reply == "1") {
                    $sqlcmd = "UPDATE `article` SET `state`='3' WHERE `articleID`='$articleID'";
                    if (mysqli_query($link, $sqlcmd)) {
                        $sqlcmd = "SELECT `id`, `pwd`, `name`, `mail`, `tel`, `identity` FROM `user` WHERE `mail` = '$mail'";
                        $result = mysqli_query($link, $sqlcmd);
                        if (mysqli_num_rows($result) == 0) {
                            $sqlcmd = "INSERT INTO `user`(`pwd`, `mail`, `identity`) VALUES ('$pwd','$mail','2')";
                            if (mysqli_query($link, $sqlcmd)) {
?>
                            <div>感謝您接受審稿</div>
                            <div><a href="login.html">前往登入</a></div>
<?php
                            }
                        }
                    }
                }
                elseif ($reply == "2") {
                    $sqlcmd = "UPDATE `article` SET `state`='1' WHERE `articleID`='$articleID'";
                    if (mysqli_query($link, $sqlcmd)) {
?>                        
                        <div>感謝您的回覆</div>
<?php
                    }
                }
            }
        }
        else if ($datas['reply'] == 1 OR $datas['reply'] == 2) {
            echo "您已回覆過此邀請";
        }
        else 
            header("Location: login.html"); 
    }
    else {
        echo "";
    }
    mysqli_close($link);
}

if (isset($_GET["value"]) && isset($_GET["p"]) && isset($_GET["reply"]) && $_GET["reply"] == 1 OR $_GET["reply"] == 2) {

    $number = $_GET["value"];
    $pwd = $_GET["p"];
    $reply = $_GET["reply"];

    replyHandle($number, $reply, $pwd);
}
else {
    header("Location: login.html"); 
}
?>
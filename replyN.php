<?php
function replyHandle($number, $reply) {

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
        if($datas['reply'] == "unreply") {

            $articleID = $datas['articleID'];
            $mail = $datas['mail'];

            $sqlcmd = "UPDATE `assigning` SET `reply`='$reply' WHERE `articleID`='$articleID' AND `mail`='$mail'";
            
            if (mysqli_query($link, $sqlcmd)) {
                if ($reply == "agree") {
                    $sqlcmd = "UPDATE `article` SET `state`='審稿中' WHERE `articleID`='$articleID'";
                    if (mysqli_query($link, $sqlcmd)) {
                        echo "感謝您接受審稿</br>";
                        echo "前往登入";
                    }
                }
                elseif ($reply == "reject") {
                    $sqlcmd = "UPDATE `article` SET `state`='尚未分派' WHERE `articleID`='$articleID'";
                    if (mysqli_query($link, $sqlcmd)) {
                        echo "感謝您的回覆</br>";
                    }
                }
            }
        }
        else {
            echo "您已回覆過此邀請";
        }
    }
    else {
        echo "什麼都沒有";
    }
    mysqli_close($link);
}

if (isset($_GET["value"]) && isset($_GET["reply"])) {

    $number = $_GET["value"];
    $reply = $_GET["reply"];

    replyHandle($number, $reply);
}
?>
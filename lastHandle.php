<?php
if (isset($_GET["articleID"])) {
    require_once("cfg.php");
    require_once("sqlLink.php");

    $aid = $_GET["articleID"];

    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
    $sql = "UPDATE `article` SET `state`='5' WHERE `articleID`='$aid'";

    if (mysqli_query($link, $sql)){

        $sql = "SELECT user.id, user.name, user.mail, `articleID`, `writer`, `articlename`FROM `article` INNER JOIN `user` ON article.id = user.id WHERE article.articleID='$aid'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {

            $articleDatas = mysqli_fetch_assoc($result);

        }

        $http = "http";
        $IP = $_SERVER['HTTP_HOST'];

        $url_home = $http . "://" . $IP . "/paper/FrontPage.html";

        $to = $articleDatas["mail"];
        $subject = "致理e化投稿網 稿件審核結果通知"; //主旨
        $message = "
        <html>
        <head>
        </head>
        <body>
        
        <div>您好</div><br>
        
        <div>您的 " . $articleDatas['articlename'] . " 審核結果已經出來了，可前往致理e化投稿網查看結果。</div>
        
        <div><a href='" . $url_home . "'>前往網頁</a></div>

        </body>
        </html>
        ";
        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
        if(mail($to, $subject, $message, $headers)) {
            echo 1;
        }
    }
    else {
        echo 0;
    }
    mysqli_close($link);
}
?>
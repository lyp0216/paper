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
        echo 0;
    }
    else {
        echo 1;
        SendMail($mail, $articleID);
    }
    mysqli_close($link);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function AccountHandle($mail) {

    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
    //尋找是否已有帳號
    $sqlcmd = "SELECT `id`, `pwd`, `name`, `mail`, `identity` FROM `user` WHERE `mail`='$mail' AND `identity`=2";
    $result = mysqli_query($link, $sqlcmd);

    //已有帳號
    if (mysqli_num_rows($result) > 0) {
        $acStr = "";
    }
    else {
        $mailStr = explode("@", $mail);
        $ac = $mailStr[0];
        $pwd = generateRandomString(12);

        //新增到資料庫
        $sqlcmd = "INSERT INTO `user`(`pwd`, `mail`, `identity`) VALUES ('$pwd','$mail','2')";
        if (mysqli_query($link, $sqlcmd)) {
            $acStr = "<div>您的帳號為您的信箱</div>
    
            <div>您的預設密碼為:" . $pwd . "</div>";
        }
    }
    mysqli_close($link);
    return $acStr;
}

function SendMail($sendMail, $articleID) {
    
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
    $sqlcmd = "SELECT `articleID`, `articlename`, `abstract`, `category`, `fileName` FROM `article` WHERE `articleID`='$articleID'";
    $result = mysqli_query($link, $sqlcmd);
    $articleInfo = null;

    if (mysqli_num_rows($result) > 0) {
        $articleInfo = mysqli_fetch_assoc($result);
    }

    //產生隨機編碼並尋找資料庫中有無相同編碼，若有就再產生並比對一次，無則跳出迴圈
    do {
        $number = generateRandomString();//產生編碼

        //尋找有無重複編碼
        $sqlcmd = "SELECT `articleID`, `value` FROM `assigning` WHERE `value`='$number'";
        $result = mysqli_query($link, $sqlcmd);
        
    } while (mysqli_num_rows($result) > 0);//若有重複編碼則會大於0，重複執行


    //網址 須隨者本地資料位置更改
    $http = "http";
    $IP = $_SERVER['HTTP_HOST'];

    $url_downloadFile = $http . "://" . $IP . "/paper/Download.php?filename=" . $articleInfo["fileName"];
    $url_agree = $http . "://" . $IP . "/paper/replyN.php?value=$number&&reply=1";
    $url_reject = $http . "://" . $IP . "/paper/replyN.php?value=$number&&reply=2";

    //帳號密碼
    $acStr = AccountHandle($sendMail);

    //信件資料
    $to = $sendMail;
    $subject = "致理e化投稿網 論文審稿邀請: " . $articleInfo['category']; //主旨
    $message = "
    <html>
    <head>
    </head>
    <body>
    
    <div>學士您好</div><br>
    
    <div>我們誠摯的邀請您來審閱 \"" . $articleInfo["articlename"] . "\" 論文文章</div><br>
    
    <div></div>
    
    <div>以下為此文章的摘要</div>
    
    <div>--------------------</div>
    
    <div>". $articleInfo["abstract"] . "</div>
    
    <div>--------------------</div><br>
    
    <div>如要下載並閱讀此文章的PDF,請點擊此連結:</div>
    
    <div><a href='" . $url_downloadFile . "'>下載文章</a></div><br>
    
    <div>若是您想要審閱此篇文章,請點擊此連結:</div>
    
    <div><a href='" . $url_agree . "'>同意審稿</a></div><br>
    
    <div>若是您不想要審閱此篇文章,請點擊此連結:</div>
    
    <div><a href='" . $url_reject . "'>拒絕審稿</a></div><br>
    
    " . $acStr . "
    
    </body>
    </html>
    ";
    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

    //判斷信件是否成功寄出
    if(mail($to, $subject, $message, $headers)) {

        //新增資料
        $sqlA = "INSERT INTO `assigning`(`articleID`, `value`, `mail`, `reply`) VALUES ('$articleID','$number', '$to', '0')";

        if (mysqli_query($link, $sqlA)) {

            //修改該文件的狀態
            $sql = "UPDATE `article` SET `state`='2' WHERE `articleID`='$articleID'";

            if (mysqli_query($link, $sql)){
                mysqli_free_result($result);

                return 0;
                
            }
        }
    }
    else {
        mysqli_free_result($result);

        return 1;
        
    }
    mysqli_close($link);
}
?>
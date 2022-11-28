<?php
//require_once("checkLogin.php");

//產生一個10位數編碼
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function CheckMail($mail, $articleID) {
    require_once("cfg.php");
    require_once("sqlLink.php");
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);

    $sqlcmd = "SELECT `articleID`, `value`, `reply`, `mail` FROM `assigning` WHERE `articleID`='$articleID' AND `mail`='$mail' AND `reply`='reject'";

    $result = mysqli_query($link, $sqlcmd);

    //如有資料
    if (mysqli_num_rows($result) > 0) {
        $check = 1;
    }
    else {
        $check = 0;
    }
    mysqli_free_result($result);
    mysqli_close($link);
    return $check;
}

function AccountHandle($mail) {
    require_once("cfg.php");
    require_once("sqlLink.php");
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);

    //尋找是否已有帳號
    $sqlcmd = "SELECT `id`, `pwd`, `name`, `mail`, `identity` FROM `user` WHERE `mail`='$mail' AND `identity`='reviewer'";
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
        $sqlcmd = "INSERT INTO `user`(`id`, `pwd`, `mail`, `identity`) VALUES ('$ac','$pwd','$mail','reviewer')";
        if (mysqli_query($link, $sqlcmd)) {
            $acStr = "<div>您的帳號為:" . $ac . "</div>
    
            <div>您的預設密碼為:" . $pwd . "</div>";
        }
    }
    mysqli_close($link);
    return $acStr;
}


//if (isset($_POST["mail"]) && $_POST["mail"] != "") {
function SendMail($sendMail, $articleID) {
    require_once("cfg.php");
    require_once("sqlLink.php");
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
    
    //$articleID = $_SESSION['articleID'];
    $sqlcmd = "SELECT `articleID`, `articlename`, `abstract` FROM `article` WHERE `articleID`='$articleID'";
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
    $url_agree = "http://localhost:8080/myWeb/npaper/replyN.php?value=$number&&reply=agree";
    $url_reject = "http://localhost:8080/myWeb/npaper/replyN.php?value=$number&&reply=reject";

    //帳號密碼
    $acStr = AccountHandle($sendMail);

    //信件資料
    $to = $sendMail;
    $subject = "OOO的審稿者邀請: OO領域"; //主旨
    $message = "
    <html>
    <head>
    </head>
    <body>
    
    <div>尊敬的博士您好</div><br>
    
    <div>我們誠摯的邀請您來審閱 \"" . $articleInfo["articlename"] . "\" 論文文章</div><br>
    
    <div></div>
    
    <div>以下為此文章的摘要</div>
    
    <div>--------------------</div>
    
    <div>". $articleInfo["abstract"] . "</div>
    
    <div>--------------------</div><br>
    
    <div>如要下載並閱讀此文章的PDF,請點擊此連結:</div>
    
    <div><a href='" . "https://translate.google.com.tw/?hl=zh-TW" . "'>下載文章</a></div><br>
    
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
        $articleID = $_SESSION['articleID'];

        //新增資料
        $sqlA = "INSERT INTO `assigning`(`articleID`, `value`, `mail`, `reply`) VALUES ('$articleID','$number', '$to', 'unreply')";

        if (mysqli_query($link, $sqlA)) {

            //修改該文件的狀態
            $sql = "UPDATE `article` SET `state`='分派中' WHERE `articleID`='$articleID'";

            if (mysqli_query($link, $sql)){
                mysqli_free_result($result);
                mysqli_close($link);
                return 0;
                exit;
            }
        }
    }
    else {
        mysqli_free_result($result);
        mysqli_close($link);
        return 1;
        exit;
    }
    
}
?>


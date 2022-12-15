<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once("cfg.php");
require_once("sqlLink.php");

$mail = $_REQUEST["m"];
$articleID = $_REQUEST["id"];

if ($mail != "") {
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);

    //找出有無拒絕評閱紀錄
    $sql = "SELECT `articleID`, `value`, `reply`, `mail` FROM `assigning` WHERE `articleID`='$articleID' AND `mail`='$mail' AND `reply`='2'";
	$result = mysqli_query($link, $sql);

    //有資料代表有拒絕紀錄
    if (mysqli_num_rows($result) > 0) {
        echo "此學士已拒絕過評閱這篇文章!";
    }
    else {
        $pwd = AccountHandle($mail);;
        if ($pwd != "") {
            $acStr = " <div>提醒:同意評閱後才會開通帳號</div>
        
            <div>您的帳號為您的信箱</div>
    
            <div>您的預設密碼為:" . $pwd . "</div>";
        }
        else {
            $acStr = "";
        }
        SendMail($mail, $articleID, $pwd, $acStr); 
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
    $sqlcmd = "SELECT `id`, `pwd`, `name`, `mail`, `identity` FROM `user` WHERE `mail`='$mail' AND `identity`=2 OR `identity`=3";
    $result = mysqli_query($link, $sqlcmd);

    //已有帳號
    if (mysqli_num_rows($result) > 0) {
        return "";
    }
    else {
        // $mailStr = explode("@", $mail);
        // $ac = $mailStr[0];
        return generateRandomString(12);
    }
    mysqli_close($link);
}

function SendMail($sendMail, $articleID, $pwd, $acStr) {
    
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
    $url_agree = $http . "://" . $IP . "/paper/replyN.php?value=$number&p=$pwd&reply=1";
    $url_reject = $http . "://" . $IP . "/paper/replyN.php?value=$number&p=$pwd&reply=2";

    //信件資料
    // $to = $sendMail;
    // $subject = "致理e化投稿網 論文審稿邀請: " . $articleInfo['category']; //主旨
    // $message = "
    // <html>
    // <head>
    // </head>
    // <body>
    
    // <div>學士您好</div><br>
    
    // <div>我們誠摯的邀請您來審閱 \"" . $articleInfo["articlename"] . "\" 論文文章</div><br>
    
    // <div></div>
    
    // <div>以下為此文章的摘要</div>
    
    // <div>--------------------</div>
    
    // <div>". $articleInfo["abstract"] . "</div>
    
    // <div>--------------------</div><br>
    
    // <div>如要下載並閱讀此文章的PDF,請點擊此連結:</div>
    
    // <div><a href='" . $url_downloadFile . "'>下載文章</a></div><br>
    
    // <div>若是您想要審閱此篇文章,請點擊此連結:</div>
    
    // <div><a href='" . $url_agree . "'>同意審稿</a></div><br>
    
    // <div>若是您不想要審閱此篇文章,請點擊此連結:</div>
    
    // <div><a href='" . $url_reject . "'>拒絕審稿</a></div><br>
    
    // " . $acStr . "
    
    // </body>
    // </html>
    // ";
    // $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

    // //判斷信件是否成功寄出
    // if (mail($to, $subject, $message, $headers)) {

    //     //新增資料
    //     $sqlA = "INSERT INTO `assigning`(`articleID`, `value`, `mail`, `reply`) VALUES ('$articleID','$number', '$to', '0')";

    //     if (mysqli_query($link, $sqlA)) {

    //         //修改該文件的狀態
    //         $sql = "UPDATE `article` SET `state`='2' WHERE `articleID`='$articleID'";

    //         if (mysqli_query($link, $sql)) {
    //             mysqli_free_result($result);

    //             echo 1;
                
    //         }
    //     }
    // }
    // else {
    //     mysqli_free_result($result);

    //     echo "信件寄送失敗!";
        
    // }
    
    $mail= new PHPMailer();                         //建立新物件
    $mail->IsSMTP();                                //設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                         //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                      // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";                 //Gamil的SMTP主機
    $mail->Port = "465";                            //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8";                       //郵件編碼
    $mail->Username = "chen0081110921@gmail.com"; //Gamil帳號
    $mail->Password = 'chuzrlkzeveutzww'; //ywwjnvwpsekdrboy           //Gmail密碼
    $mail->From = "chen0081110921@gmail.com";     //寄件者信箱
    $mail->FromName = "Chen";                       //寄件者姓名
    $mail->Subject = "致理e化投稿網 論文審稿邀請: " . $articleInfo['category'];            //郵件標題
    $mail->Body = "
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

    $mail->IsHTML(true);                      //郵件內容為html
    $mail->AddAddress("$sendMail");            //收件者郵件及名稱
    if(!$mail->Send()){
        echo "Error:".$mail->ErrorInfo;
        echo "信件寄送失敗!";
    }
    else {

        //新增資料
        $sqlA = "INSERT INTO `assigning`(`articleID`, `value`, `mail`, `reply`) VALUES ('$articleID','$number', '$sendMail', '0')";

        if (mysqli_query($link, $sqlA)) {

            //修改該文件的狀態
            $sql = "UPDATE `article` SET `state`='2' WHERE `articleID`='$articleID'";

            if (mysqli_query($link, $sql)) {
                mysqli_free_result($result);

                echo 1;
                
            }
        }
    }

    mysqli_close($link);
}
?>
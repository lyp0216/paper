<?php
session_start();
// if (!isset($_SESSION['identity']) OR $_SESSION['identity'] != 0) {
//     header("Location: login.html"); 
// }

if (!isset($_GET["value"])) {
    header("Location: ManagerFrontPage.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ManagerThirdPage.css">
    <link rel="stylesheet" href="css/RWD_Manager.css">
    <link rel="stylesheet" href="css/footer.css">
    
    <title>管理者</title>
</head>

<body>
    <header class="flex">
        <div id="logo">
            <a href="https://www.chihlee.edu.tw/"><img src="img/chihleeB.png" alt=""></a>
        </div>
        <menu>
            <ul>
                <li><a href="FrontPage.html" class="action">關於論文</a></li>
                <li><a href="PostPage.php">投稿專區</a></li>
                <li><a href="SubmissionQuery.php">投稿狀態查詢</a></li>
                <li><a href="ReviewerFrontPage.php">審稿專區</a></li>
                <li><a href="login.html"><img src="img/user.png" alt="" style="width: 18px;height: 18px;"></a></li>
                <li><a href="DataUpdate.php"><img src="img/settings.png" alt="" style="width: 18px;height: 18px;"></a>
                </li>
            </ul>
        </menu>
        <div id="hamburger">
            <div class="hamT"></div>
            <div class="hamM"></div>
            <div class="hamB"></div>
        </div>
    </header>
    <div class="ManagerThirdPage container" id="ManagerThirdPage">
        <div class="ManagerThirdSize" id="ManagerThirdSize">
    <?php

//require_once("checkLogin.php");

// $msg = "";

// if (isset($_POST["mail"])) {

// 	if ($_POST["mail"] != "") {
// 		$msg = "";
// 		$mail = $_POST["mail"];
// 	}
//     else 
// 	    $msg = "請輸入完整的信箱";
// }

// $checkSend = 1;
// if (isset($mail) && $mail != "") {

	
// 	//檢查是否被拒絕過
// 	$articleID = $_POST["articleID"];
// 	$checkSend = CheckMail($mail, $articleID);

// 	//回傳1 代表此人已拒絕過審稿
// 	if ($checkSend == 1) {
// 		$msg = "此學士已拒絕過評閱這篇文章!";
// 	}
// 	else {
// 		$msg = "";
// 		$checkSend = SendMail($mail, $articleID);
// 	}
// }


if (isset($_GET["value"])) {
	$datas = $_SESSION['assign'];
	$datasNum = $_GET["value"];
	$articleID = $datas[$datasNum]['articleID'];
	$articleName = $datas[$datasNum]['articlename'];
	$category = $datas[$datasNum]['category'];
    $summary = $datas[$datasNum]['abstract'];
	$_SESSION['articleID'] = $articleID;

	if ($datas[$datasNum]['state'] != 1) {
        header("Location: ManagerFrontPage.php"); 
    }

    unset($_SESSION['assign']);
?>
    
            <form method="post">
                <div class="textDiv" id="textDiv">
                    <p>文章編號：<span id="articleID"><?php echo $articleID; ?></span></p>
                    <input type="hidden" name="articleID" value="<?php echo $articleID?>">
                </div>
                <div class="textDiv" id="textDiv">
                    <p>文章標題：<span><?php echo $articleName; ?></span></p>
                </div>
                <div class="textDiv" id="textDiv">
                    <p>文章類別：<span><?php echo $category; ?></span></p>
                </div>
                <div class="textDiv" id="textDiv">
                    <p>文章摘要：<span><?php echo $summary; ?></span></p>
                </div>
                <div class="textDiv" id="textDiv">
                    <p>請輸入信箱：<input type="email" size="35"  placeholder="請輸入信箱" id="mail" name="mail"></p>
                </div>
                <div class="state" id="state">
                    <span class="stateTxt" id="stateTxt"></span>
                </div>
                <div class="buttonDiv flex" id="buttonDiv">
                    <!-- <input type="button" value="返回" onClick=location="ManagerFrontPage.php" />
                    <input type="submit" value="確認並送出"/> -->
                    <a href="ManagerFrontPage.php"><button type="button" id="back">返回</button></a> 
                    <button type="button" id="submit">確認並送出</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>
    <footer>
        Copyright &copy; 2022 Yu. All right reserved.<br>
        220305 新北市板橋區文化路1段313號
        <br>
        No.313, Sec. 1, Wenhua Rd., Banqiao Dist., New Taipei City 220305, Taiwan (R.O.C.)
        <br>
        TEL：(02)2257-6167 │ (02)2257-6168 │ FAX：(02)2258-3710
    </footer>
</body>
<script src="checkMail.js"></script>
</html>
<script>
    let hb = document.getElementById("hamburger");
    let meun = document.getElementsByTagName("menu")[0];
    let hamT = document.getElementsByClassName("hamT")[0];
    let hamM = document.getElementsByClassName("hamM")[0];
    let hamB = document.getElementsByClassName("hamB")[0];
    hb.addEventListener("click", function () {
        if (meun.style.display == "none" || meun.style.display == "") {
            meun.style.display = "block";
            hamT.style.transform = "rotate(26deg)";
            hamM.style.opacity = "0";
            hamB.style.transform = "rotate(-26deg)";
        } else {
            meun.style.display = "none";
            hamT.style.transform = "rotate(0deg)";
            hamM.style.opacity = "1";
            hamB.style.transform = "rotate(0deg)";
        }
    })
</script>
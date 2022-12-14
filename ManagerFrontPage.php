<?php
session_start();

$pageid = 0;
if (!isset($_SESSION['identity']) OR $_SESSION['identity'] != $pageid ) {
    echo "<script>alert('請以管理者帳號登入');
            location.assign('login.html');
            </script>";
}

require_once("cfg.php");
require_once("sqlLink.php");
require_once("mp.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ManagerFrontPage.css">
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

    <div class="ManagerFrontPage container" id="ManagerFrontPage">
        <div class="ManagerFrontSize" id="ManagerFrontSize">
            <fieldset>
                <span id="tab-1" style="display: none;">尚未分派</span>
                <span id="tab-2" style="display: none;">分派中</span>
                <span id="tab-3" style="display: none;">審稿中</span>
                <span id="tab-4" style="display: none;">已審稿</span>

                <!-- 頁籤按鈕 -->
                <div id="tab" class="tab">
                    <ul>
                        <li><a href="#tab-1">尚未分派</a></li>
                        <li><a href="#tab-2">分派中</a></li>
                        <li><a href="#tab-3">審稿中</a></li>
                        <li><a href="#tab-4">已審稿</a></li>
                    </ul>

                    <!-- 頁籤的內容區塊 -->
                    <div class="tab-content-1">
                        <div class="tableDiv" id="tableDiv">
                            
                            <table>

                                <?php showInfo(1);?>

                            </table>
                        </div>
                    </div>

                    <div class="tab-content-2">
                        <div class="tableDiv">
                            <table>

                                <?php showInfo(2);?>

                            </table>
                        </div>
                    </div>

                    <div class="tab-content-3">
                        <div class="tableDiv">
                            <table>
                            
                                <?php showInfo(3);?>

                            </table>
                        </div>
                    </div>

                    <div class="tab-content-4">
                        <div class="tableDiv">
                            <table>
                            
                                <?php showInfo(4);?>

                            </table>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <script>
        var i=0;
        var btnidstr = "assign_" + i;
        var btn = [];

        while (document.getElementById(btnidstr)) {
            
            document.getElementById(btnidstr).addEventListener("click", btnF);

            i++;
            btnidstr = "assign_" + i;
        }
        

        function btnF() {
            var url = "assign.php?value=" + this.value;
            window.location.assign(url);
        }
    </script>

    <footer>
        Copyright &copy; 2022 Yu. All right reserved.<br>
        220305 新北市板橋區文化路1段313號
        <br>
        No.313, Sec. 1, Wenhua Rd., Banqiao Dist., New Taipei City 220305, Taiwan (R.O.C.)
        <br>
        TEL：(02)2257-6167 │ (02)2257-6168 │ FAX：(02)2258-3710
    </footer>
</body>

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
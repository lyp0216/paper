<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/RWD.css">
    <link rel="stylesheet" href="css/DataUpdate.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>基本資料更新</title>
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
                <li><a href="DataUpdate.php"><img src="img/settings.png" alt="" style="width: 18px;height: 18px;"></a></li>
            </ul>
        </menu>
        <div id="hamburger">
            <div class="hamT"></div>
            <div class="hamM"></div>
            <div class="hamB"></div>
        </div>
    </header>
    <?php
             session_start();

                        require_once("cfg.php");
                        require_once("sqlLink.php");
    
                            $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
                            or die("無法開啟資料連接!<br/>");
                            $id=0;


                        $query = "SELECT * FROM user  WHERE `id`='$id'";

                        $query_run = mysqli_query($link,$query);
                        
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $row)
                            {
                    ?>
    <div class="container DataUpdate" id="DataUpdate">
        <div class="UpdateSize" id="UpdateSize">
            <fieldset>
            <form action="Updata.php" method="post" enctype="multipart/form-data">
                <legend>基本資料更新</legend>
                <div class="flex UpdateDiv">
                    <div class="UpdateP">
                        <p class="textP">姓名:</p>
                    </div>
                    <div><input class="UpdateInput" type="text" name="name" placeholder="<?php echo $row['name']; ?>"></div>
                </div>
                <div class="flex UpdateDiv">
                    <div class="UpdateP">
                        <p class="textP">電子郵件：</p>

                    </div>
                    <div><input class="UpdateInput" type="text" name="mail"  placeholder="<?php echo $row['mail']; ?>"></div>
                </div>
                <div  class="flex UpdateDiv">
                    <div class="UpdateP">
                        <p class="textP">電話：</p>
                    </div>
                    <div><input class="UpdateInput" type="tel" name="tel"  placeholder="<?php echo $row['tel']; ?>"></div>
                </div>
                <div  class="flex UpdateDiv">
                    <div class="UpdateP">
                        <p class="textP">密碼：</p>
                    </div><div><input class="UpdateInput" type="text" name="pwd"  placeholder="<?php echo $row['pwd']; ?>"></div>
                </div>
                <div  class="flex UpdateDiv">
                    <div class="UpdateP">
                        <p class="textP">再次輸入密碼：</p>
                    </div><div><input class="UpdateInput" type="password" value=""></div>
                </div>
                <div  class="flex UpdateDiv">
                    <div class="UpdateP">
                        <p class="textP">單位：</p>
                        
                    </div><div><select name="select" id="select">
                            <option value="1">123</option>
                        </select></div>
                </div>
                <div class="button-group flex">
                    <input class="button buttonB" type="submit" name="Upbutton" value="Submit">
                    <input class="button buttonB" type="button" value="Cancel">
                </div>
                </form>
            </fieldset>
        </div>
    </div>
    <?php
				     }
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
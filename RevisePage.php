<!DOCTYPE html>
<html lang="en">
 <?php
                        session_start();


                        require_once("cfg.php");
                        require_once("sqlLink.php");

                            $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
                            or die("無法開啟資料連接!<br/>");
                            $id=$_SESSION['userid'];

                        $query = "SELECT * FROM selection WHERE `userid`='$id'";

                        $query_run = mysqli_query($link,$query);

                            foreach($query_run as $row)
                            {

                            if(mysqli_num_rows($query_run) > 0)
                                                    {
                                                        foreach($query_run as $row[0])
                                                        {
                                                            switch ($row['Manuscript Review Status']) {
                                                                case 38:
                                                                    $state = "已通過";
                                                                    break;
                                                                case 39:
                                                                    $state = "未通過";
                                                                    break;
                                                                case 40:
                                                                    $state = "修改後通過";
                                                                    break;
                                                            }
                                                            }
                    ?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/RWD.css">
    <link rel="stylesheet" href="css/PostPage.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>投稿頁面</title>
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
                <li><a href="login.html"><img src="img/user.png" alt="" style="width: 20px;height: 20px;"></a></li>
                <li><a href="DataUpdate.php"><img src="img/settings.png" alt="" style="width: 20px;height: 20px;"></a></li>
                </li>
            </ul>
        </menu>
        <div id="hamburger">
            <div class="hamT"></div>
            <div class="hamM"></div>
            <div class="hamB"></div>
        </div>
    </header>
    <div id="postPage" class="container postPage">
        <div class="postSize" id="postSize">
            <fieldset>
                <legend>文章目前狀態</legend>
                <div>
                    <p class="textP">文章目前狀態：<?php echo $state; ?><span></span></p>
                </div>
            </fieldset>
            <fieldset>
                <legend>評審評論</legend>
                <div>
                    <div>
                        <textarea name="abstract" id="abstract" style="height: 75px;resize: vertical;" cols="30"
                            rows="2"  placeholder=<?php echo $row['Notes to the author']; ?>></textarea>
                    </div>
                </div>
                         <?php
                                           				     }
                                           				     }
                            ?>
            </fieldset>

                        <fieldset>
                        <form action="fileupdate.php" method="post" enctype="multipart/form-data">
                            <legend>檔案重新上傳</legend>
                            <div class="dw-wrap">
                                <input class="fileUpload" type="file" name="file" accept=".doc,.docx,.pdf"><br/>
                            </div>

                        </fieldset>
                        <div class="button-group flex">
                            <input class="button buttonB" type="submit" name="ufbutton1" value="Submit">
                            <input class="button buttonB" type="button" value="Cancel">
                        </div>
                            </form>


        </div>

    </div>


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

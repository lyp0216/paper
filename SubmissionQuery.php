<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/RWD.css">
    <link rel="stylesheet" href="css/SubmissionQuery.css">
    <link rel="stylesheet" href="css/footer.css">

    <?php
        $pageid = 1;
        if (!isset($_SESSION['identity']) OR $_SESSION['identity'] != $pageid ) {
            echo "<script>alert('請以投稿者帳號登入');
            location.assign('login.html');
            </script>";
            //header("Location: login.html");
        }
    ?>

    <title>投稿狀態查詢</title>
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
            </ul>
        </menu>
        <div id="hamburger">
            <div class="hamT"></div>
            <div class="hamM"></div>
            <div class="hamB"></div>
        </div>
    </header>
    <div id="SubmissionQuery" class="SubmissionQuery container" style="min-height: 100%;">
        <div id="SubmissionQuerySize" class="SubmissionQuerySize">
            <fieldset>
                <legend>我的論文</legend>
                <table>
                    <tr id="SubmissionQueryTableTh" class="SubmissionQueryTableTh" >
                        <th class="SubmissionQueryTableWriter">作者</th>
                        <th class="SubmissionQueryTableName">作品名稱</th>
                        <th class="SubmissionQueryTableCategory">類別</th>
                        <th class="SubmissionQueryTableUpload">檔案上傳</th>
                        <th class="SubmissionQueryTableState">審稿狀態</th>
                    </tr>  
                    <?php
                    require_once("cfg.php");
                    require_once("sqlLink.php");

                        $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
                        or die("無法開啟資料連接!<br/>");

                        $userid = $_SESSION["userid"];
                        $query = "SELECT * FROM article WHERE id='$userid'";

                        $query_run = mysqli_query($link,$query);
                        
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $row)
                            {
                                switch ($row['state']) {
                                    case 1:
                                        $state = "尚未分派";
                                        break;
                                    case 2:
                                        $state = "分派中";
                                        break;
                                    case 3:
                                    case 4:
                                        $state = "審稿中";
                                        break;
                                    case 5:
                                        $state = "審稿完畢";
                                        break;
                                }
                    ?>
                    <tr>
                        <td><span><?php echo $row['writer']; ?></span></td>
                        <td><?php echo $row['articlename']; ?></td>
                        <td><span><?php echo $row['category']; ?></span></td>
                        <td><a href="Download.php?filename=<?php echo $row["fileName"];?>"><span><?php echo  $row["fileName"]; ?></span></a></td>
                        <td><a href="RevisePage.php"><span><?php echo $state; ?></span></a></td>              
                    </tr> 
                 <?php
				     }
				     }
			        ?>
                </table>            
  
            </fieldset>
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

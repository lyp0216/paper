<!DOCTYPE html>
<html lang="en">

<?php
                            
function pendingreview()
{   require_once("cfg.php");
    require_once("sqlLink.php");

        $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
        or die("無法開啟資料連接!<br/>");
		$sql = "SELECT * FROM article WHERE state = '待評閱'";
							
		if ($result = mysqli_query($link,$sql))
			{
				$total_records = mysqli_num_rows($result);
				return  $total_records;
					}
}							
function review()
{
    require_once("cfg.php");
    require_once("sqlLink.php");

        $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
        or die("無法開啟資料連接!<br/>");
							$sql = "SELECT * FROM article WHERE state = '評閱中'";
							
							if ($result = mysqli_query($link,$sql))
							{
							$total_records = mysqli_num_rows($result);
							return  $total_records;
							}
}
function Reviewafterrevision()
{
    require_once("cfg.php");
    require_once("sqlLink.php");

        $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
        or die("無法開啟資料連接!<br/>");
							$sql = "SELECT * FROM article WHERE state = '修改後評閱'"; 
							
							if ($result = mysqli_query($link,$sql))
							{
							$total_records = mysqli_num_rows($result);
							return  $total_records;
							}
}
function completereview()
{
    require_once("cfg.php");
    require_once("sqlLink.php");

        $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
        or die("無法開啟資料連接!<br/>");
							$sql = "SELECT * FROM article WHERE state = '完成評閱'"; 
							
							if ($result = mysqli_query($link,$sql))
							{
							$total_records = mysqli_num_rows($result);
							return  $total_records;
							}
}
							?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ReviewerFrontPage.css">
    <link rel="stylesheet" href="css/RWD_reviewer.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>所有評論</title>
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
    <div class="Reviewer container">
        <div class="ReviewerSize" id="ReviewerSize">
            <div class="ReaderTitle">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><span>所有評閱</span></li>
                </ol>
            </div>
            <div class="but">
                <div class="ReaderBut">
                    <div style="display: flex;">
                        <div class="bottonBox">
                            <input class="btnNew btnColor b myMOUSE" type="button" name="register" value="待評閱"
                                onclick="window.location.href='ReviewerWaitPage.php'" />
                        </div>
                        <div class="numBox">
                           <span><?php echo pendingreview(); ?></span>
                        </div>
                        <span style="margin: auto 0;color: #000;">篇</span><br>
                    </div>
                    <div style="display: flex;">
                        <div class="bottonBox">
                            <input class="btnNew btnColor myMOUSE" type="button" name="register" value="評閱中"
                                onclick="window.location.href='ReviewerConductPage.php'" />
                        </div>
                        <div class="numBox">
                            <span><?php echo review(); ?></span>
                        </div>
                        <span style="margin: auto 0;color: #000;">篇</span><br>
                    </div>
                    <h2>歷史評閱紀錄</h2>
                    <div style="display: flex;">
                        <div class="bottonBox">
                            <input class="btnNew btnColor  myMOUSE" type="button" name="register" value="修改後評閱"
                                onclick="window.location.href='ReviewerRevisePage.php'" />
                        </div>
                        <div class="numBox">
                            <span><?php echo Reviewafterrevision()?></span>
                        </div>
                        <span style="margin: auto 0;color: #000;">篇</span><br>
                    </div>
                    <div style="display: flex;">
                        <div class="bottonBox">
                            <input class="btnNew btnColor a  myMOUSE" type="button" name="register" value="完成評閱"
                                onclick="window.location.href='ReviewerFinishPage.php'" />
                        </div>
                        <div class="numBox">
                            <span><?php echo completereview() ?></span>
                        </div>
                        <span style="margin: auto 0;color: #000;">篇</span><br>
                    </div>
                    <!--<input class="btnNew btnColor myMOUSE" type="button" name="register" value="評閱中" onclick="window.location.href='評閱中.html'"/><span>0</span>篇<br>
				
				<input class="btnNew btnColor  myMOUSE" type="button" name="register" value="待修改評閱" onclick="window.location.href='修改後待評閱.html'"/><span>0</span>篇<br>
				<input class="btnNew btnColor a  myMOUSE" type="button" name="register" value="完成評閱" onclick="window.location.href='完成評閱.html'"/><span>0</span>篇<br>
				<input class="btnNew btnColor a myMOUSE" type="button" name="register" value="拒絕評閱" onclick="window.location.href='拒絕評閱.html'"/><span>0</span>篇-->

                </div>
            </div>
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
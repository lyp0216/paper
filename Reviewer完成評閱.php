<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ReviwerFinishPage.css">
    <link rel="stylesheet" href="css/RWD_reviewer.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Document</title>
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
                <li><a href="ReviewerFrontPage.html">審稿專區</a></li>
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
    <div class="FinishPage container" id="FinishPage">
        <div class="FinishSize" id="FinishPage">
            <div class="ReaderTitle">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <div class="breadcrumb-div"><a href="審稿者首頁.html">所有評閱</a></div>
                    </li>
                </ol>
            </div>
            <div class="order">
                <span style="white-space:pre"> </span><span class="line"></span>
                <span style="white-space:pre"> </span><span class="txt">完成評閱</span>
                <span style="white-space:pre"> </span><span class="line"></span>
            </div>
            <table class="tableR">
                <tbody>
                    <tr>
                        <th scope="col">稿件編號</th>
                        <th scope="col">篇名</th>
                        <th scope="col">邀請日期</th>
                        <th scope="col">審稿期限</th>
                        <th scope="col">評閱狀態</th>
                    </tr>
                    <tr>
                        <td><a href="">123456</a></td>
                        <td><a href="">12345671234567</a></td>
                        <td><a href="">12/32</a></td>
                        <td><a href="">12/32</a></td>
                        <td><a href="">被拒絕</a></td>
                    </tr>
                    <tr>
                        <td><a href="">123456</a></td>
                        <td><a href="">12345671234567</a></td>
                        <td><a href="">12/32</a></td>
                        <td><a href="">12/32</a></td>
                        <td><a href="">被拒絕</a></td>
                    </tr>
                </tbody>
            </table>
            <!--<input type ="button" onclick="history.go(-N)" value="回到上N頁"></input>-->
            <div class="FinishBtn">
                <input type="button" onclick="history.back()" value="上一頁">
                <input type="button" onclick="history.forward()" value="下一頁">
            </div>

            <!--<ul class="pagination">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a class="active" href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">»</a></li>
            </ul>-->
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
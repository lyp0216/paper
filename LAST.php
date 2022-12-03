<?php
session_start();
if (isset($_GET["value"])) {
    
    $aID = $_GET["value"];

    $datas = $_SESSION['reviewed'];
	$datasNum = $_GET["value"] -1;
	$articleID = $datas[$datasNum]['articleID'];
	$articleName = $datas[$datasNum]['articlename'];
	$category = $datas[$datasNum]['category'];
    $summary = $datas[$datasNum]['abstract'];
    
    $comments = $datas[$datasNum]['comments'];

    if ($comments=="") {
        $comments = "無";
    }
	$_SESSION['articleID'] = $articleID;

    $sql = "";
    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/ManagerForthPage.css">
        <link rel="stylesheet" href="css/RWD_Manager.css">
        <link rel="stylesheet" href="css/footer.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="https://unpkg.com/sweetalert2@7.0.7/dist/sweetalert2.all.js"></script>
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
        <div class="ManagerForthPage container" id="ManagerForthPage">
            <div class="ManagerForthSize" id="ManagerForthSize">
                <!-- <form method="post" action="lastHandle.php"> -->
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
                    <div class="textareaDiv" id="textareaDiv">
                        <p>文章摘要：<span><?php echo $summary; ?></span></p>
                    </div>
                    
                    <!-- <div>
                        <table>
                            <tr>
                                <th>是否符合主題</th>
                                <th>是否具有參考價值</th>
                                <th>論文長度</th>
                                <th>論文內容的質量</th>
                                <th>實驗評估</th>
                                <th>技術正確性</th>
                                <th>論文獨創性</th>
                                <th>論文的完整度</th>
                                <th>論文插圖質量</th>
                                <th>參考文獻的充分性</th>
                            </tr>
                            <tr>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                                <td>是</td>
                            </tr>
                        </table>
                                                                
                    </div> -->

                    <div class="textDiv" id="textDiv">
                        <p>是符合主題：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>是符具有參考價值：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文長度：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文內容質量：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>實驗評估：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>技術正確性：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文獨創性：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文的完整度：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文插圖質量：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>參考文獻充分性：<span>測試</span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>評論結果：<span>通過</span></p>
                    </div>
                    <div class="textareaDiv" id="textareaDiv">
                        <p>評審建議：</p>
                        <div class="a"><textarea name="suggest" id="suggest" cols="30" rows="5"><?php echo $comments; ?></textarea></div>
                        
                    </div>

                    <!-- <div>
                        <p>評論結果</p>
                        <p>通過</p>
                    </div> -->

                    <!-- <div>
                        <p>審稿者的建議</p>
                        <p></p>
                    </div> -->

                    <div class="buttonDiv flex" id="buttonDiv">
                        <input type="button" id="back" value="返回" />
                        <input type="button" id="submit_btn" value="確認並送出結果"/>
                    </div>
                <!-- </form> -->
            </div>
        </div>
        
        <script>
            document.getElementById('submit_btn').addEventListener('click', (e)=>{
                e.preventDefault();
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (xmlhttp.responseText == 1) {
                            alert("已送出");
                            location.assign("ManagerFrontPage.php");
                        }
                    }
                };
                var articleID = document.getElementById("articleID").innerHTML;
                xmlhttp.open("GET", "lastHandle.php?articleID=" + articleID, true);
                
                xmlhttp.send();

            });

            document.getElementById('back').addEventListener('click', (e)=>{
                //e.preventDefault();
                location.assign("ManagerFrontPage.php");
            });
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

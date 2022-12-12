<?php
session_start();

require_once("cfg.php");
require_once("sqlLink.php");

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

    $sql = "SELECT `Does it fit the theme?`, `Does the paper have reference value`, `Essay length`, `The quality of the content of the paper`, `Experimental evaluation`, `technical correctness`, `The originality of the paper`, `the completeness of the thesis`, `Paper illustration quality`, `sufficiency of references`, `Comment result`, `Notes to the author` FROM `selection` WHERE `articleID` = '$articleID'";
    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
	$result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        $commentDatas = mysqli_fetch_assoc($result);            
    }

    mysqli_close($link);

    function switchInfo($infoNum) {
        switch ($infoNum) {
            //主題
            case '1':
                return "非常符合";
                break;
            case '2':
                return "符合";
                break;
            case '3':
                return "普通";
                break;
            case '4':
                return "不太符合";
                break;
            case '5':
                return "不符合";
                break;
            //參考價值
            case '6':
                return "對廣大讀者具有高參考價值";
                break;
            case '7':
                return "對有限讀者有高參考價值";
                break;
            case '8':
                return "對廣大讀者有邊際參考價值";
                break;
            case '9':
                return "對有限讀者有邊際參考價值";
                break;
            case '10':
                return "無參考價值";
                break;
            //論文長度
            case '11':
                return "合適的";
                break;
            case '12':
                return "需延長";
                break;
            case '13':
                return "需縮短";
                break;
            //質量
            case '14':
                return "出色的";
                break;
            case '15':
                return "一般";
                break;
            case '16':
                return "較差的";
                break;
            //實驗評估
            case '17':
                return "具有說服力";
                break;
            case '18':
                return "有限但令人信服";
                break;
            case '19':
                return "無說服力的";
                break;
            //技術正確性
            case '20':
                return "正確的";
                break;
            case '21':
                return "部分正確";
                break;
            case '22':
                return "不正確";
                break;
            //獨創性
            case '23':
                return "出色的";
                break;
            case '24':
                return "一般";
                break;
            case '25':
                return "較差的";
                break;
            //完整度
            case '26':
                return "出色的";
                break;
            case '27':
                return "一般";
                break;
            case '28':
                return "較差的";
                break;
            //插圖質量
            case '29':
                return "出色的";
                break;
            case '30':
                return "一般";
                break;
            case '31':
                return "較差的";
                break;
            //文獻充分性
            case '32':
                return "參考文獻足夠";
                break;
            case '33':
                return "參考文獻有一些遺漏";
                break;
            case '34':
                return "參考文獻不足";
                break;
            //結果
            case '35':
                return "接受";
                break;
            case '37':
                return "拒絕";
                break;
            case '38':
                return "修改後接受";
                break;
            
            default:
                if ($infoNum == "") {
                    $infoNum = "無建議";
                }
                return $infoNum;
                break;
        }
    }

    foreach($commentDatas as $infoNum) {
        $infoStr[] = switchInfo($infoNum);
    } 
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
        <script></script>
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

                    <div class="textDiv" id="textDiv">
                        <p>是否符合主題：<span><?php echo $infoStr[0];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>是否具有參考價值：<span><?php echo $infoStr[1];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文長度：<span><?php echo $infoStr[2];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文內容質量：<span><?php echo $infoStr[3];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>實驗評估：<span><?php echo $infoStr[4];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>技術正確性：<span><?php echo $infoStr[5];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文獨創性：<span><?php echo $infoStr[6];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文的完整度：<span><?php echo $infoStr[7];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>論文插圖質量：<span><?php echo $infoStr[8];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>參考文獻充分性：<span><?php echo $infoStr[9];?></span></p>
                    </div>
                    <div class="textDiv" id="textDiv">
                        <p>評論結果：<span><?php echo $infoStr[10];?></span></p>
                    </div>
                    <div class="textareaDiv" id="textareaDiv">
                        <p>評審建議：</p>
                        <div class="a"><textarea name="suggest" id="suggest" cols="30" rows="5"><?php echo $infoStr[11]; ?></textarea></div>
                        
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

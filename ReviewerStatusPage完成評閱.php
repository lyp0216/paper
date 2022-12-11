<!DOCTYPE html>
<html lang="en">

<?php
                           
                        
					
                            require_once("cfg.php");
                            require_once("sqlLink.php");
       
                            $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
                            or die("無法開啟資料連接!<br/>");
							$id = $_GET['id'];
			                $sql = "SELECT * FROM article where articleID='$id'" ;
                            $result = mysqli_query($link, $sql);							
                            $row = mysqli_fetch_row($result);
?>
	
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ReviewerStatusPage.css">
    <link rel="stylesheet" href="css/RWD_reviewer.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>審稿頁面</title>
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
    <div class="ReviewerStatus container" id="ReviewerStatus">
        <div class="ReviewerStatusSize" id="ReviewerStatusSize">
            <!--<fieldset> 標籤 (tag) 用來對表單 (form) 中的控制元件做分組 (group)，而 <legend> 標籤通常是 <fieldset> 裡面的第一個元素作為該分組的標題 (caption)。-->
            <fieldset>
                <legend>稿件評論狀態</legend>
				<?php
					$sql = "SELECT `Comment result` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                <div class="radio-group">
                    <input type="radio" class="radio-input" id="1" name="number"value="35"<?php
						$k=$row[0]==35?'checked="checked"':'' ;echo $k;
						?>>
                    <label for="1" class="radio-label">
                        <span class="radio-button"></span>接受
                    </label>
                </div>
                <div class="radio-group">
                    <input type="radio" class="radio-input" id="2" name="number"value="36"<?php
						$k=$row[0]==36?'checked="checked"':'' ;echo $k;
						?>>
                    <label for="2" class="radio-label">
                        <span class="radio-button"></span>拒絕
                    </label>
                </div>
                <div class="radio-group">
                    <input type="radio" class="radio-input" id="3" name="number"value="37"<?php
						$k=$row[0]==37?'checked="checked"':'' ;echo $k;
						?>>
                    <label for="3" class="radio-label">
                        <span class="radio-button"></span>修改後接受
                    </label>
                </div>
            </fieldset>
            <fieldset>
                <legend>投稿者資訊</legend>
				<?php
					$sql = "SELECT * FROM article where articleID='$id'";
					$aaa = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($aaa);
					
					?>
                <div style="display:flex;">
					<div class="text"><p class="textP">稿件編號：</p></div><div class="textPp "><span style="border-bottom: 1px #cccccc solid;"><?php
						echo"$row[1]";
					?></span></div>
				</div>
				<div style="display:flex;">
					<div class="text"><p class="textP">作品名稱：</p></div><div class="textPp "><span style="border-bottom: 1px #cccccc solid;"><?php
						echo"$row[5]";
					?></span></div>
				</div>
				<div style="display:flex;">
					<div class="text"><p class="textP">投稿者姓名：</p></div><div class="textPp "><span style="border-bottom: 1px #cccccc solid;"><?php
						echo"$row[2]";
					?></span></div>
				</div>
				<div style="display:flex;">
					<div class="text"><p class="textP">稿件類別：</p></div><div class="textPp "><span style="border-bottom: 1px #cccccc solid;"><?php
						echo"$row[6]";
					?></span></div>
				</div>
				<div style="display:flex;">
					<div class="text"><p class="textP">作品摘要：</p></div><div class="textPp "><textarea name="text" id="text" cols="30" rows="10"><?php
						echo"$row[7]";
						?></textarea></div>
				</div>
				
				

            </fieldset>
            <fieldset>
                <legend>檔案下載</legend>
                <li class="dw-wrap">
                    <a href="$row[1]/download/" class="dw-link dw-item">
                        <div class="dw-name">
						<?php echo"$row[5]";?>
                        </div>
                        <div class="dw-image"><img class="list-image-thumb" src="img/dw.png" alt="down"></div>
                    </a>
                </li>
            </fieldset>
            <div>
            <form action="selection.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>是否符合主題？</legend>
					<?php
					$sql = "SELECT `Does it fit the theme?` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="4" name="number1" value="1"<?php
						$a=$row[0]==1?'checked="checked"':'' ;echo $a;
						?>>
                        <label for="4" class="radio-label" ><span class="radio-button"></span>非常符合</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="5" name="number1" value="2"<?php
					$a=$row[0]==2?'checked="checked"':'' ;echo $a;
						?>>
						<label for="5"
                            class="radio-label"><span class="radio-button" ></span>符合</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="6" name="number1"value="3"<?php
						$a=$row[0]==3?'checked="checked"':'' ;echo $a;
						?>>
                        <label for="6" class="radio-label">
                            <span class="radio-button"></span>普通
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="7" name="number1"value="4"<?php
						$a=$row[0]==4?'checked="checked"':'' ;echo $a;
						?>>
                        <label for="7" class="radio-label">
                            <span class="radio-button"></span>不太符合
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="8" name="number1"value="5"<?php
						$a=$row[0]==5?'checked="checked"':'' ;echo $a;
						?>>
                        <label for="8" class="radio-label">
                            <span class="radio-button"></span>不符合
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>論文是否具有參考價值</legend>
					<?php
					$sql = "SELECT `Does the paper have reference value` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="9" name="number2"value="6"<?php
						$b=$row[0]==6?'checked="checked"':'' ;echo $b;
						?>>
                        <label for="9" class="radio-label">
                            <span class="radio-button"></span>對廣大讀者具有高參考價值
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="10" name="number2"value="7"<?php
						$b=$row[0]==7?'checked="checked"':'' ;echo $b;
						?>>
                        <label for="10" class="radio-label">
                            <span class="radio-button"></span>對有限讀者有高參考價值
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="11" name="number2"value="8"<?php
						$b=$row[0]==8?'checked="checked"':'' ;echo $b;
						?>>
                        <label for="11" class="radio-label">
                            <span class="radio-button"></span>對廣大讀者有邊際參考價值
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="12" name="number2"value="9"<?php
						$b=$row[0]==9?'checked="checked"':'' ;echo $b;
						?>>
                        <label for="12" class="radio-label">
                            <span class="radio-button"></span>對有限讀者有邊際參考價值
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="13" name="number2"value="10"<?php
						$b=$row[0]==10?'checked="checked"':'' ;echo $b;
						?>>
                        <label for="13" class="radio-label">
                            <span class="radio-button"></span>無參考價值
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>論文長度</legend>
					<?php
					$sql = "SELECT `Essay length` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="14" name="number3"value="11"<?php
						$c=$row[0]==11?'checked="checked"':'' ;echo $c;
						?>>
                        <label for="14" class="radio-label">
                            <span class="radio-button"></span>合適的
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="15" name="number3"value="12"<?php
						$c=$row[0]==12?'checked="checked"':'' ;echo $c;
						?>>
                        <label for="15" class="radio-label">
                            <span class="radio-button"></span>需延長(請在下方說明)
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="16" name="number3"value="13"<?php
						$c=$row[0]==13?'checked="checked"':'' ;echo $c;
						?>>
                        <label for="16" class="radio-label">
                            <span class="radio-button"></span>需縮短(請在下方說明)
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>論文內容的質量</legend>
					<?php
					$sql = "SELECT `The quality of the content of the paper` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="17" name="number4"value="14"<?php
						$d=$row[0]==14?'checked="checked"':'' ;echo $d;
						?>>
                        <label for="17" class="radio-label">
                            <span class="radio-button"></span>出色的
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="18" name="number4"value="15"<?php
						$d=$row[0]==15?'checked="checked"':'' ;echo $d;
						?>>
                        <label for="18" class="radio-label">
                            <span class="radio-button"></span>一般
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="19" name="number4"value="16"<?php
						$d=$row[0]==16?'checked="checked"':'' ;echo $d;
						?>>
                        <label for="19" class="radio-label">
                            <span class="radio-button"></span>較差的
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>實驗評估</legend><?php
					$sql = "SELECT `Experimental evaluation` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="20" name="number5"value="17<?php
						$e=$row[0]==17?'checked="checked"':'' ;echo $e;
						?>>
                        <label for="20" class="radio-label">
                            <span class="radio-button"></span>具有說服力
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="21" name="number5"value="18"<?php
						$e=$row[0]==18?'checked="checked"':'' ;echo $e;
						?>>
                        <label for="21" class="radio-label">
                            <span class="radio-button"></span>有限但令人信服
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="22" name="number5"value="19"<?php
						$e=$row[0]==19?'checked="checked"':'' ;echo $e;
						?>>
                        <label for="22" class="radio-label">
                            <span class="radio-button"></span>無說服力的
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>技術正確性</legend><?php
					$sql = "SELECT `technical correctness` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="23" name="number6"value="20"<?php
						$f=$row[0]==20?'checked="checked"':'' ;echo $f;
						?>>
                        <label for="23" class="radio-label">
                            <span class="radio-button"></span>正確的
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="24" name="number6"value="21"<?php
						$f=$row[0]==21?'checked="checked"':'' ;echo $f;
						?>>
                        <label for="24" class="radio-label">
                            <span class="radio-button"></span>部分正確
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="25" name="number6"value="22"<?php
						$f=$row[0]==22?'checked="checked"':'' ;echo $f;
						?>>
                        <label for="25" class="radio-label">
                            <span class="radio-button"></span>不正確
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>論文獨創性</legend>
					<?php
					$sql = "SELECT `The originality of the paper` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="26" name="number7"value="23"<?php
						$g=$row[0]==23?'checked="checked"':'' ;echo $g;
						?>>
                        <label for="26" class="radio-label">
                            <span class="radio-button"></span>出色的
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="27" name="number7"value="24"<?php
						$g=$row[0]==24?'checked="checked"':'' ;echo $g;
						?>>
                        <label for="27" class="radio-label">
                            <span class="radio-button"></span>一般
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="28" name="number7"value="25"<?php
						$g=$row[0]==25?'checked="checked"':'' ;echo $g;
						?>>
                        <label for="28" class="radio-label">
                            <span class="radio-button"></span>較差的
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>論文的完整度</legend>
					<?php
					$sql = "SELECT `the completeness of the thesis` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="29" name="number8"value="26"<?php
						$h=$row[0]==26?'checked="checked"':'' ;echo $h;
						?>>
                        <label for="29" class="radio-label">
                            <span class="radio-button"></span>出色的
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="30" name="number8"value="27"<?php
						$h=$row[0]==27?'checked="checked"':'' ;echo $h;
						?>>
                        <label for="30" class="radio-label">
                            <span class="radio-button"></span>一般
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="31" name="number8"value="28"<?php
						$h=$row[0]==28?'checked="checked"':'' ;echo $h;
						?>>
                        <label for="31" class="radio-label">
                            <span class="radio-button"></span>較差的
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>論文插圖質量</legend>
					<?php
					$sql = "SELECT `Paper illustration quality` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="32" name="number9"value="29"<?php
						$i=$row[0]==29?'checked="checked"':'' ;echo $i;
						?>>
                        <label for="32" class="radio-label">
                            <span class="radio-button"></span>出色的
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="33" name="number9"value="30"<?php
						$i=$row[0]==30?'checked="checked"':'' ;echo $i;
						?>>
                        <label for="33" class="radio-label">
                            <span class="radio-button"></span>一般
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="34" name="number9"value="31"<?php
						$i=$row[0]==31?'checked="checked"':'' ;echo $i;
						?>>
                        <label for="34" class="radio-label">
                            <span class="radio-button"></span>較差的
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>參考文獻的充分性</legend>
					<?php
					$sql = "SELECT `sufficiency of references` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="35" name="number10"value="32"<?php
						$j=$row[0]==32?'checked="checked"':'' ;echo $j;
						?>>
                        <label for="35" class="radio-label">
                            <span class="radio-button"></span>參考文獻足夠
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="36" name="number10"value="33"<?php
						$j=$row[0]==33?'checked="checked"':'' ;echo $j;
						?>>
                        <label for="36" class="radio-label">
                            <span class="radio-button"></span>參考文獻有一些遺漏（請在下方說明）
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="37" name="number10"value="34"<?php
						$j=$row[0]==34?'checked="checked"':'' ;echo $j;
						?>>
                        <label for="37" class="radio-label">
                            <span class="radio-button"></span>參考文獻不足（請在下方說明）
                        </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>評論結果</legend>
					<?php
					$sql = "SELECT `Comment result` FROM `selection`";
					$abc = mysqli_query($link, $sql);
					$row = mysqli_fetch_row($abc);
					
					?>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="38" name="number11"value="35"<?php
						$k=$row[0]==35?'checked="checked"':'' ;echo $k;
						?>>
                        <label for="38" class="radio-label">
                            <span class="radio-button"></span>接受
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="39" name="number11"value="36"<?php
						$k=$row[0]==36?'checked="checked"':'' ;echo $k;
						?>>
                        <label for="39" class="radio-label">
                            <span class="radio-button"></span>拒絕
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" class="radio-input" id="40" name="number11"value="37"<?php
						$k=$row[0]==37?'checked="checked"':'' ;echo $k;
						?>>
                        <label for="40" class="radio-label">
                            <span class="radio-button"></span>修改後接受
                        </label>
                    </div>
                </fieldset>
            </div>
            <fieldset>
                <legend>給作者的意見說明</legend>
                <div id="textareaBox" name="textareaBox" class="textareaBox">
                    <textarea name="textarea" value="textarea" id="textarea" class="textarea" cols="30" rows="4">
					
</textarea>
                </div>
            </fieldset>
            <div class="button-group">
                <input class="button buttonB" type="button" value="返回"onclick="location.href='ReviewerFrontPage.php'">
                
            </div>
        </div>
    </div>
</form>
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
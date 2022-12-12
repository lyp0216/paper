<!DOCTYPE html>
<html lang="en">

<?php

require_once("cfg.php");
require_once("sqlLink.php");

    $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
    or die("無法開啟資料連接!<br/>");
						    $sql = "SELECT * FROM 評閱中首頁" ;
                            $result = mysqli_query($link, $sql);							

                            $per_total = mysqli_num_rows($result);
                            $per = 1;
                            $pages = ceil($per_total/$per);

                            if(!isset($_GET['page'])){
	                            $page=1;
                            }else{
	                            $page = $_GET['page'];
                            }

                            $start=($page-1)*$per;
                            $result = mysqli_query($link,$sql.' LIMIT '.$start.', '.$per) ;

                            $page_start = $start +1;
                            $page_end = $start + $per;
                            if($page_end>$per_total){
                            $page_end = $per_total;	
                            }
                            ?>

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
                     <?php
					$total_fields = mysqli_num_fields($result);
					
					while ($row = mysqli_fetch_row($result)){
						echo "<tr>";
						for( $i = 0;$i <= $total_fields-1; $i++ ){
						if($i==0){
								echo"<td><a href='ReviewerStatusPage待評閱.php?id=$row[$i]'>$row[$i]</a></td>";
							continue;
							}
							
							echo "<td>" . $row[$i] . "</td>";
						}
							
						echo"</tr>";
					}
					
					?>
                </tbody>
            </table>
            <!--<input type ="button" onclick="history.go(-N)" value="回到上N頁"></input>-->
            <div class="FinishBtn">
			<?php
			if($pages>1){
				if($page=='1'){
					/*echo "首頁";*/
					/*echo "上一頁";*/
				}else{
					/*echo "<a href=?page=1>首頁 </a> "*/;
					echo "<a href=?page=".($page-1).">上一頁 </a> ";	
				}
			}
			  //此分頁頁籤以左、右頁數來控制總顯示頁籤數，例如顯示5個分頁數且將當下分頁位於中間，則設2+1+2 即可。若要當下頁位於第1個，則設0+1+4。也就是總合就是要顯示分頁數。如要顯示10頁，則為 4+1+5 或 0+1+9，以此類推。	
     for($i=1 ; $i<=$pages ;$i++){ 
        $lnum = 2;  //顯示左分頁數，直接修改就可增減顯示左頁數
        $rnum = 2;  //顯示右分頁數，直接修改就可增減顯示右頁數

   //判斷左(右)頁籤數是否足夠設定的分頁數，不夠就增加右(左)頁數，以保持總顯示分頁數目。
     if($page <= $lnum){
         $rnum = $rnum + ($lnum-$page+1);
     }

     if($page+$rnum > $pages){
         $lnum = $lnum + ($rnum - ($pages-$page));
     }

        //分頁部份處於該頁就不超連結,不是就連結送出$_GET['page']
          if($page-$lnum <= $i && $i <= $page+$rnum){
              if($i==$page){
                 echo $i.' ';
                      }else{
                          echo '<a href=?page='.$i.'>'.$i.'</a> ';
                   }
              }
          }


	//在最後頁時,該頁就不超連結,可連結就送出$_GET['page']	
	if($page==$pages){
		/*echo " 下一頁";*/
		/*echo " 末頁";*/	
	}else{
		echo "<a href=?page=".($page+1)."> 下一頁</a>";
		/*echo "<a href=?page=".$pages."> 末頁</a>"*/;		
	}
  
  ?>	
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
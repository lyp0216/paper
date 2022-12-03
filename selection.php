<?php
if(isset($_POST["but1"])){  
    session_start();	
    $number1=$_POST["number1"];
	$number2=$_POST["number2"];
	$number3=$_POST["number3"];
    $number4=$_POST["number4"];
	$number5=$_POST["number5"];
	$number6=$_POST["number6"];
	$number7=$_POST["number7"];
	$number8=$_POST["number8"];
	$number9=$_POST["number9"];
	$number10=$_POST["number10"];
	$number11=$_POST["number11"];
    $aId = $_POST["aId"];
	
	require_once("cfg.php");
    require_once("sqlLink.php");
        
    $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
    or die("無法開啟資料連接!<br/>");
		
    		
    $sql="INSERT INTO selection(稿件評論狀態,是否符合主題？,論文是否具有參考價值,論文長度,論文內容的質量,實驗評估,技術正確性,論文獨創性,論文的完整度,論文插圖質量,參考文獻的充分性,評論結果,articleID) 
	value ('$number11','$number1','$number2','$number3','$number4','$number5','$number6','$number7','$number8','$number9','$number10','$number11','$aId')";
    $result=mysqli_query($link,$sql);
	
    $sql = "UPDATE `article` SET `state`=4 WHERE `articleID`='$aId'";
	$result=mysqli_query($link,$sql);
    
   if (mysqli_affected_rows($link)>0) {

       $id1= mysqli_insert_id ($link);
      header("Refresh:2; url=ReviewerFrontPage.php");  
       }
       elseif(mysqli_affected_rows($link)==0) {
           echo "無資料新增";
          
       }
       else {
           echo "其他錯誤";
       }
        mysqli_close($link); 
    
    }		

?>
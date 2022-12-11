<?php
if(isset($_POST["but1"])){  
    session_start();	
	$number=$_POST["number"]?? "";
    $number1=$_POST["number1"]?? "";
	$number2=$_POST["number2"]?? "";
	$number3=$_POST["number3"]?? "";
    $number4=$_POST["number4"]?? "";
	$number5=$_POST["number5"]?? "";
	$number6=$_POST["number6"]?? "";
	$number7=$_POST["number7"]?? "";
	$number8=$_POST["number8"]?? "";
	$number9=$_POST["number9"]?? "";
	$number10=$_POST["number10"]?? "";
	$number11=$_POST["number11"]?? "";
	$textarea=$_POST["textarea"]?? "";
    $aId = $_POST["aId"]?? "";
	$but1=$_POST["but1"]?? "";
	$but2=$_POST["but2"]?? "";
	$userid=$_SESSION["userid"];

	require_once("cfg.php");
    require_once("sqlLink.php");
        
    $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
    or die("無法開啟資料連接!<br/>");
		
   $sql = "UPDATE `selection` SET `Manuscript Review Status`='$number11',`Does it fit the theme?`='$number1',`Does the paper have reference value`='$number2',`Essay length`='$number3',
   `The quality of the content of the paper`='$number4',`Experimental evaluation`='$number5',`technical correctness`='$number6',`The originality of the paper`='$number7',`the completeness of the thesis`='$number8'
   ,`Paper illustration quality`='$number9',`sufficiency of references`='$number10',`Comment result`='$number11',`Notes to the author`='$textarea'";
  $result=mysqli_query($link,$sql);
	if  ($but1==1){
		    $sql = "UPDATE `article` SET `state`=6 WHERE `articleID`='$aId'";
	        $result=mysqli_query($link,$sql);
			
			 return header("Refresh:1; url=ReviewerFrontPage.php");
			
	}
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
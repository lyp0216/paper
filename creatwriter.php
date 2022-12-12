<?php
session_start();
					
if(isset($_POST["button1"])){  
	
	$writer=$_POST["writer"];
	$workname=$_POST["workName"];
	$abstract=$_POST["abstract"];
	//$file=$_POST["file"];
	$state=1;
	$category=$_POST["postSelect"];

	$userid = $_SESSION["userid"];

	require_once("cfg.php");
	require_once("sqlLink.php");
	
	if (isset($_FILES["file"])){

		if (copy($_FILES["file"]["tmp_name"], $_FILES["file"]["name"])) {
			$fileName = $_FILES["file"]["name"];
			echo "上傳檔案成功<br/>";
			unlink($_FILES["file"]["tmp_name"]);
		}
		else {
			echo"檔案上傳失敗<br/>";
		}
	}

	$link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
	or die("無法開啟資料連接!<br/>");

	//$sql="INSERT INTO article(writer,articlename,abstract,state,category) value ('$writer','$workname','$abstract','$state','$category')";
	
	$sql = "INSERT INTO `article`(`id`, `writer`, `abstract`, `fileName`, `articlename`, `category`, `state`) VALUES ('$userid', '$writer','$abstract', '$fileName', '$workname','$category','$state')";

	$result=mysqli_query($link, $sql);
	if (mysqli_affected_rows($link) > 0) {

		$id1 = mysqli_insert_id($link);
		//header("Refresh:2; url=SubmissionQuery.php");  
	}
	elseif (mysqli_affected_rows($link)==0) {
		echo "無資料新增";
		
	}
	else {
		echo "其他錯誤";
	}
	mysqli_close($link); 
}

/*# 原始檔案位置
$filePath = '../labphp/filees/123.docx';

# 檔案類型（一般性檔案）
$contentType="application/octet-stream";

# 下載後的檔名
$newFileName = '論文下載檔.docx';

# 各種檔案標頭
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: " . $contentType);
header("Content-Length: " .(string)(filesize($filePath)) );
header("Content-Transfer-Encoding: binary\n");

# 以附件方式下載檔案，並指定下載後的預設檔名
header('Content-Disposition: attachment; filename="' . $newFileName . '"');

# 輸出檔案內容
readfile($filePath);

exit();
*/
?>

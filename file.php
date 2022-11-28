<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>上傳檔案</title>
</head>
<body>
<form action="file.php" name="file" method="post" enctype="multipart/form-data">
選擇檔案上傳:<input type="file" name="file" accept=".doc,.docx,.pdf"/><br/>
<input type="submit" value="上傳檔案">
</form>
<?php
if(isset($_FILES["file"])){

if(copy($_FILES["file"]["tmp_name"],
        $_FILES["file"]["name"])){
echo"上傳檔案成功<br/>";
unlink($_FILES["file"]["tmp_name"]);
}else echo"檔案上傳失敗<br/>";

}

?>

</html>


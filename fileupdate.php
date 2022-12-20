<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>


<?php
session_start();

if(isset($_FILES["file"])){

            $link = mysqli_connect("localhost","root","","topic") or die("無法開啟資料連接!<br/>");
            $id = $_SESSION["userid"];

            if(copy($_FILES["file"]["tmp_name"],
                    $_FILES["file"]["name"])){
            //$fileName = $_FILES["file"]["name"];
            echo"<script>alert('上傳檔案成功')</script>";
            unlink($_FILES["file"]["tmp_name"]);

            //$sql = "UPDATE `article` SET fileName='$fileName' WHERE id= '$id'";
            header("Refresh:2; url=SubmissionQuery.php");
            }
            else{
             echo"<script>alert('檔案上傳失敗')</script>";
             header("Refresh:2; url=RevisePage.php");
            }
            mysqli_close($link);
            }

?>
</html>

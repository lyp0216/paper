<?php
session_start();
$mail="";
$pwd="";

if(isset($_POST["mail"]) )
    $mail=$_POST["mail"];
if(isset($_POST["pwd"]) )
    $pwd=$_POST["pwd"];

if($mail!="" && $pwd!=""){

  require_once("cfg.php");
  require_once("sqlLink.php");

      $link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
      or die("無法開啟資料連接!<br/>");

  $sql ="SELECT * FROM user WHERE pwd='";
  $sql.=$pwd."' AND mail='".$mail."'";

  $result=mysqli_query($link,$sql);
  $total_records=mysqli_num_rows($result);

  if($total_records > 0){
    $_SESSION["login_session"]=true;
    header("Location: PostPage.php ");
  }else{
    echo "帳號或密碼錯誤";
    $_SESSION["login_session"]=false;
    header("Refresh: 3; url=login.html");
  }
  mysqli_close($link);
}else{
    echo "欄位不可為空";
    header("Refresh: 3; url=login.html");
}

?>
<?php
/*session_start();
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
}*/

session_start();
require_once("cfg.php");
require_once("sqlLink.php");

if (isset($_POST["mail"]) AND isset($_POST["pwd"])) {
    $mail = $_POST["mail"];
    $pwd = $_POST["pwd"];
}

if($_POST["mail"] != "" AND $_POST["pwd"] != "") {

    $link = connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE) or die("無法開啟資料連接!<br/>");

    $sql = "SELECT `id`, `pwd`, `mail`, `identity` FROM user WHERE pwd='$pwd' AND mail='$mail'";

    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    $total_records = mysqli_num_rows($result);

    if($total_records > 0) {
        
        $userdata = mysqli_fetch_assoc($result);
        //$_SESSION["login_session"]=true;
        //$_SESSION['identity'] = $userdata["identity"];
        //header("Location: PostPage.php ");
        $_SESSION["userid"] = $userdata["id"];
        $_SESSION['identity'] = $userdata['identity'];
        switch ($userdata['identity']) {
        //0=管理 1=投稿 2=審稿 3=投稿+審稿
            case 0: 
                header("Location: ManagerFrontPage.php"); 
                break;
            case 1:
                header("Location: PostPage.php");
                break;
            case 2:
            case 3:
                header("Location: FrontPage.html");
                break;
            default:
                # code...
            break;
        }
    }
    else
        echo "帳號密碼錯誤"; 
}
else {
    echo "請輸入帳號密碼";
}
?>
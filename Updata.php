<?php
session_start();
if (isset($_POST["Upbutton"])){ 
    $link = mysqli_connect("localhost","root","","topic") or die("無法開啟資料連接!<br/>");
    $name = $_POST["name"];
    $email = $_POST["mail"];
    $pwd = $_POST["pwd"];
    $tel = $_POST["tel"];
    $id = $_SESSION["userid"];

    $sql = "UPDATE `user` SET name='$name',pwd='$pwd',mail='$email',tel='$tel' WHERE `id`= '$id'";
    // 用mysqli_query方法執行(sql語法)將結果存在變數中
        
    //$result = mysqli_query($link,$sql);

    if( $name != "" && $pwd != ""&& $email != ""&& $tel != "" ){
        
        //判斷更新資料有沒有成功
        if(mysqli_query($link, $sql)){
            echo "更新成功";
        }
        else{
            echo "更新失敗".mysqli_error($link);
        }
    }
    else {
        echo "資料更新不能空白。";
    }

    mysqli_close($link); 
			
}
?> 
<?php
			session_start();

			if(isset($_POST["signBut"])){  
			$id=$_POST["mail"];
			$name=$_POST["name"];
			$email=$_POST["mail"];
			$pwd=$_POST["password"];
			$tel=$_POST["tel"];
			$id=$_SESSION['id'];

			
				/*$from="euny900216@gmail.com";
				$to=$_POST["mail"];
				$subject="致理投稿帳號開通";
				$text="您的帳號已成功開通";
				//$header="\nMIME-Version:1.0\n";
				//$header="Content-Type:text/html;charset=utf8\n";
				//$header="From:$from\n Reply-To:$from\n";
				if(mail($to,$subject,$text,$from)){
				echo "郵件寄出<br/>";}
				else{
					echo "郵件寄出失敗<br/>";
				}*/


				
				require("./phpmailer/class.phpmailer.php");
					
				$mail= new PHPMailer();                    //建立新物件
				$mail->IsSMTP();                           //設定使用SMTP方式寄信
				$mail->SMTPAuth = true;                    //設定SMTP需要驗證
				$mail->SMTPSecure = "ssl";                 // Gmail的SMTP主機需要使用SSL連線
				$mail->Host = "smtp.gmail.com";            //Gamil的SMTP主機
				$mail->Port = "465";                       //Gamil的SMTP主機的埠號(Gmail為465)。
				$mail->CharSet = "utf-8";                  //郵件編碼
				$mail->Username = "euny900216@gmail.com";  //Gamil帳號
				$mail->Password ='iekngpdiezfiuzqp';       //Gmail密碼
				$mail->From = "euny900216@gmail.com";     //寄件者信箱
				$mail->FromName = "Lu";                   //寄件者姓名
				$mail->Subject ="帳號開通成功";            //郵件標題
				$mail->Body = "親愛的".$name."您好：<br/>
				您在致理投稿網站的帳號及密碼如下：<br />".				
				"*帳號：".$email."<br />".
				"*密碼：".$pwd."<br />".				
				"此為系統通知信，請不要直接回覆此信件<br />
				
				主辨單位：致理科技大學<br />
				活動網站：https://www.chihlee.edu.tw/<br />
				聯絡信箱:xxxx@gmail.com<br />
				聯絡電話：(02)2257-6167";//郵件內容

				$mail->IsHTML(true);                      //郵件內容為html
				$mail->AddAddress("$email");            //收件者郵件及名稱
				if(!$mail->Send()){
					echo "寄信失敗! ";   
				}
					else{
						echo "<b>查看信件</b>";
					}
					


			
				

			require_once("cfg.php");
			require_once("sqlLink.php");

			$link =connect(DB_HOST,DB_USER,DB_PWD,DB_DATABASE)
				or die("無法開啟資料連接!<br/>");
			$sql="INSERT INTO user(id,name,mail,pwd,tel)value ('$id','$name','$email','$pwd','$tel')";
			$result=mysqli_query($link,$sql);
			if (mysqli_affected_rows($link)>0) {

				$id1= mysqli_insert_id ($link);
				header("Refresh:2; url=login.html");  
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
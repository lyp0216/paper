<?php
		
				$from="euny900216@gmail.com";
				$to="10833201@gm.chihlee.edu.tw";
				$subject="致理投稿帳號開通";
				$text="您的帳號已成功開通";
				//$header="\nMIME-Version:1.0\n";
				//$header="Content-Type:text/html;charset=utf8\n";
				$header="From:$from Reply-To:$from";
				if(mail($to,$subject,$text,$from)){
				echo "郵件寄出<br/>";}
				else{
					echo "郵件寄出失敗<br/>";
				}/**/

?>
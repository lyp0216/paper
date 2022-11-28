<?php
	function connect($host, $user, $pwd, $database) {
		/*$localhost = "localhost";
		$root = "root";
		$pwd = "";
		$mydb = "topic";*/
		$link = mysqli_connect($host, $user, $pwd, $database);
		if($link) 
			mysqli_query($link,'SET NAMES utf8');
		return $link;
	}
?>
<?php 
header("Content-Type:text/html; charset=utf-8");
if ($_FILES["file"]["error"] > 0){ 
    echo "Error: " . $_FILES["file"]["error"]; 
} else {
    echo "<a href='"."data:".$_FILES["file"]["type"].";base64,".base64_encode(file_get_contents($_FILES['file']['tmp_name']))."'>".$_FILES["file"]["name"]."</a>";
}
?>
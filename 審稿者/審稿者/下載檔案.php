<?php

											
header("Content-type: text/html; charset=utf-8");

$file="./9707.zip"; // 實際檔案的路徑+檔名

$filename="0928.zip"; // 下載的檔名

//指定類型

header("Content-type: ".filetype("$file"));

//指定下載時的檔名

header("Content-Disposition: attachment; filename=".$filename."");

//輸出下載的內容。

readfile($file);

?>
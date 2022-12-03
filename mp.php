<?php

function selectInfo($state) {
    
    //$sql = "SELECT `articleID`, `articlename`, `summary`, `category`, `id`, `name`, `state`, `deadline` FROM `user` INNER JOIN `article` ON user.id = article.userId WHERE `state`='$state'";
    $sql = "SELECT article.id, `name`, `articleID`, `writer`, `abstract`, `filee`, `articlename`, `category`, `comments`, `state`, `invitationdate`, `deadline` FROM `article` INNER JOIN `user` ON article.id = user.id WHERE `state`='$state'";

    $link = connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
	$result = mysqli_query($link, $sql);
    mysqli_close($link);
	return $result;
}

function showInfo($state) {
    $result = selectInfo($state);

    if (mysqli_num_rows($result) > 0) {

        $datas = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $datas[] = $row;
        }
    }

    if (isset($datas)) {

        if ($state == 1) {
            $i=1;
            $_SESSION['assign'] = $datas;
            $btnTitle = "<th></th>";
            $btnStr = "<td><input type='button' value='分派' onClick=location='assign.php?value='></td>";
            $localNum = 75;

?>
                <tr>
                    <th>文章編號</th>
                    <th>文章標題</th>
                    <th>作者</th>
                    <th>類別</th>
                    <th>期限</th>
                    <th></th>
                </tr>
<?php

            foreach ($datas as $key => $row) {
                $btn = substr_replace($btnStr, $i, $localNum, 0);
?>
                    <tr>
                        <td><span id=''><?php echo $row["articleID"];?></span></td>
                        <td><?php echo $row["articlename"]?></td>
                        <td><?php echo $row["name"]?></td>
                        <td><?php echo $row["category"]?></td>
                        <td><?php echo $row["deadline"]?></td>
                        <td><button type="button" id="<?php echo "assign_" . $key;?>" value="<?php echo $key;?>">分派</button></td>
                    </tr>
<?php
    
                $i++;
            }
        }
        elseif ($state == 4) {
            $i=1;
            $_SESSION['reviewed'] = $datas;
            $btnTitle = "<th></th>";
            $btnStr = "<td><input type='button' value='確認' onClick=location='LAST.php?value='></td>";
            $localNum = 73;

?>
                <tr>
                    <th>文章編號</th>
                    <th>文章標題</th>
                    <th>作者</th>
                    <th>類別</th>
                    <th>期限</th>
                    <th></th>
                </tr>
<?php

            foreach ($datas as $key => $row) {
                $btn = substr_replace($btnStr, $i, $localNum, 0);
?>
                <tr>
                    <td><span id=''><?php echo $row["articleID"];?></span></td>
                    <td><?php echo $row["articlename"]?></td>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row["category"]?></td>
                    <td><?php echo $row["deadline"]?></td>
                    <td><button type="button" id="<?php echo $i;?>" onClick=location='<?php echo "LAST.php?value=$i"?>'>確認</button></td>
                </tr>
<?php
    
                $i++;
            }
        }
        else {
            $i="";
            $btnTitle = "";
            $btnStr = "";
            $localNum = 0;

?>
                <tr>
                    <th>文章編號</th>
                    <th>文章標題</th>
                    <th>作者</th>
                    <th>類別</th>
                    <th>期限</th>
                </tr>
<?php

            foreach ($datas as $key => $row) {
?>
                <tr>
                    <td><span id=''><?php echo $row["articleID"];?></span></td>
                    <td><?php echo $row["articlename"]?></td>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row["category"]?></td>
                    <td><?php echo $row["deadline"]?></td>
                </tr>
<?php
            }
        }
    }
    else {
?>
            <tr>
                <td>目前尚無資料</td>
            </tr>
<?php
    }
}
?>


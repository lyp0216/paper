<?php
    require_once("cfg.php");
    require_once("sqlLink.php");

    $articleID = 1;

    $comment = "test";
?>

<form method="post">
    <div>
        <p>文章編號：<span><?php echo $articleID; ?></span></p>
        <input type="hidden" name="articleID" value="<?php echo $articleID; ?>">
    </div>
    
    <div>
        評論：<?php echo $comment; ?>
        <input type="hidden" name="comment" value="<?php echo $comment; ?>" >
    </div>

    <div>
        <input type="submit" value="送出">
    </div>

    <div><a href="ManagerFrontPage.php">返回</a></div>
</form>
<?php
require_once("mp.php");
?>

<div class="ManagerFrontPage container" id="ManagerFrontPage">
        <div class="ManagerFrontSize" id="ManagerFrontSize">
            <fieldset>
                <span id="tab-1" style="display: none;">尚未分派</span>
                <span id="tab-2" style="display: none;">分派中</span>
                <span id="tab-3" style="display: none;">審稿中</span>
                <span id="tab-4" style="display: none;">已審稿</span>

                <!-- 頁籤按鈕 -->
                <div id="tab" class="tab">
                    <ul>
                        <li><a href="#tab-1">尚未分派</a></li>
                        <li><a href="#tab-2">分派中</a></li>
                        <li><a href="#tab-3">審稿中</a></li>
                        <li><a href="#tab-4">已審稿</a></li>
                    </ul>

                    <!-- 頁籤的內容區塊 -->
                    <div class="tab-content-1">
                        <div class="tableDiv" id="tableDiv">
                            
                            <table>
                                <?php showInfo("尚未分派");?>
                                <!--<tr>
                                    <th>文章編號</th>
                                    <th>文章標題</th>
                                    <th class="summary">摘要</th>
                                    <th>作者</th>
                                    <th>類別</th>
                                    <th>期限</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>1234567</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td><input type="button" value="分派"></td>
                                </tr>-->
                            </table>
                        </div>
                    </div>
                    <div class="tab-content-2">
                        <div class="tableDiv">
                            <table>

                            <?php showInfo("分派中");?>

                            </table>
                        </div>
                    </div>
                    <div class="tab-content-3">
                        <div class="tableDiv">
                            <table>
                            
                            <?php showInfo("審稿中");?>

                            </table>
                        </div>
                    </div>
                    <div class="tab-content-4">
                        <div class="tableDiv">
                            <table>
                            
                            <?php showInfo("已審稿");?>

                            </table>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
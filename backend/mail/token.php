<?php
/**
 * @var $this \yii\web\View
 * @var $url \common\models\User
 */
?>
<div class="box">
    <div class="box-head">
        <img class="img-circle center-block" src="<?= $logo ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">    
    </div>
    <div class="box-body">
        <p>Hey <?= $name ?></p>
        <p>Please enter the 6 digit code in your token verification box.</p>
        <p class="token"><?= $token ?></p>
        <p>
            If you have not made this change or notice any error, please contact us at support@tickcoin.io
        </p>
        <p>Cheer!</p>
        <p>Tickcoin Team</p>
    </div>
    <div class="box-footer">
        <p>
            Important Note: Tickcoin never ask for your password, wallet details over email/phone. 
            Please do not share your password with anyone. For any questions write to support@tickcoin.io
        </p>
    </div> 
</div>

<?php
use yii\helpers\Html;
/**
 * @var $this \yii\web\View
 * @var $url \common\models\User
 * 
 */
?>
<div class="box">
    <div class="box-head">
        <img class="img-circle center-block" src="<?= $logo ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">    
    </div>
    <div class="box-body">
       <p>Hey <?= $name ?></p>
        <p class="text-center">
            In order to start using your Tickcoin account, you need to confirm your email address.
        </p>
        <p class="text-center">
            <?php echo Yii::t('backend', 'Your activation link: {url}', ['url' => Yii::$app->formatter->asUrl($url)]) ?>
        </p>
    </div>
    <div class="box-footer">
        <p>
            Important Note: Tickcoin never ask for your password, wallet details over email/phone. 
            Please do not share your password with anyone. For any questions write to support@tickcoin.io
        </p>
    </div> 
</div>



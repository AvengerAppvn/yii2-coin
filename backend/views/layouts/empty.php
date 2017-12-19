<?php
/**
 * @var $this yii\web\View
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use backend\assets\BackendAsset;
use borales\extensions\phoneInput\PhoneInput;
$this->title = Yii::t('backend', 'Register');
$this->params['breadcrumbs'][] = $this->title;
$bundle = BackendAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>

<div class="register-box">
    <div class="register-logo">
                <img class="img-circle center-block" src="<?= $this->assetManager->getAssetUrl($bundle, 'img/coin_logo.png') ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">    
    </div><!-- /.register-logo -->
    <div class="register-box-body">
        <?php echo $content ?>    
    </div>
</div>


<?php $this->endContent(); ?>

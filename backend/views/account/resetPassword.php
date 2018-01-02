<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\BackendAsset;

$bundle = BackendAsset::register($this);
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\ResetPasswordForm */

$this->title = Yii::t('frontend', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-box">
    <div class="register-logo">
                <img class="img-circle center-block" src="<?= $this->assetManager->getAssetUrl($bundle, 'img/coin_logo.png') ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">    
    </div><!-- /.register-logo -->

    <div class="register-box-body"  style="padding:25px">
        <h1><?php echo Html::encode($this->title) ?></h1>
    
        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>


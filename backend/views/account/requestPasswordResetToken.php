<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\BackendAsset;
use himiklab\yii2\recaptcha\ReCaptcha;

$bundle = BackendAsset::register($this);
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\PasswordResetRequestForm */

$this->title =  Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-box">
    <div class="register-logo">
                <img class="img-circle center-block" src="<?= $this->assetManager->getAssetUrl($bundle, 'img/coin_logo.png') ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">    
    </div><!-- /.register-logo -->

    <div class="register-box-body"  style="padding:25px">

        <h2><?php echo Html::encode($this->title) ?></h2>
    
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?php echo $form->field($model, 'email')->textInput(['placeholder' => 'Enter your email','style'=>'margin:20px 0 5px 0'])->label(false) ?>
            
            <?php echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className()) ?>
            
            <div class="form-group text-center">
                <?php echo Html::submitButton('Send', ['class' => 'btn btn-primary','style'=>'padding:10px 25px 10px 25px']) ?>
                <p style="padding:20px 20px 10px 20px">
                    <?= Html::a('Back to Login page',['/login'],['style'=>'cursor:pointer']); ?>
                </p>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

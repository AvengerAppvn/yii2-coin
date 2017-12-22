<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use backend\assets\BackendAsset;

$bundle = BackendAsset::register($this);
$this->title = Yii::t('backend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
    <div class="login-logo">
        <?= Html::img(['/img/coin_logo.png'],[
            'alt'=>'logo',
            'data-holder-rendered'=>'true',
            'style'=>'width: 140px; height: 140px;',
            'class'=>'img-circle center-block']); ?>

    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="head">
            <h1 class="text-center">
            <i class="fa fa-lock text-success" aria-hidden="true"></i>
            <?php echo Html::encode($this->title) ?>
            </h1>
            <p class="header text-light">Please enter your credentials to login.</p>
        </div>
        <div class="body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className()) ?>
            <?php //echo $form->field($model, 'rememberMe')->checkbox(['class'=>'simple']) ?>
        </div>
        <div class="footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Login'), [
                'class' => 'btn btn-lg btn-primary btn-flat',
                'name' => 'login-button',
                'style' => 'margin-right:15px'
            ]) ?>
            
            <?php echo Html::a(Yii::t('backend', 'Register'), ['/register'],[
                'class' => 'btn btn-lg btn-success btn-flat',
                'name' => 'register-button'
            ]) ?>
        </div>
        <div style="padding:10px 0">
            <?= Html::a('Forget password?',['account/forgot-password']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="text-info" style="padding:10px 0">
        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        <?= Html::a('Back to Information Site',['@frontendUrl']); ?>
    </div>
</div>
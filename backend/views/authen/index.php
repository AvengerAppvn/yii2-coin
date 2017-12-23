<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use backend\assets\BackendAsset;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
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
                        <?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?php echo Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                ]) ?>
            <?php endif; ?>
    <div class="login-box-body">

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="head">
            <h3 class="text-center">
            <i class="fa fa-user text-success" style="color:#dccb8b" aria-hidden="true"></i>
             Welcome <?php echo Yii::$app->user->identity->username ?>
            </h3>
            <p class="header text-light">2-Step Verification</p>
        </div>
        <div class="body">
            <?php echo $form->field($model, 'one_time_password') ?>
        </div>
        <div class="footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Next'), [
                'class' => 'btn btn-lg btn-primary btn-flat',
                'name' => 'login-button',
                'style' => 'margin-right:15px'
            ]) ?>
            
            <?php echo Html::a(Yii::t('backend', 'Cancel'),['cancel'], [
                'class' => 'btn btn-lg btn-warning btn-flat',
                'style' => 'margin-right:15px'
            ]) ?>
        </div>
         <?php ActiveForm::end(); ?>
    </div>
</div>
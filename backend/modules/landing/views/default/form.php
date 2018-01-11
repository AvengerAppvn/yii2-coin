<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use backend\assets\BackendAsset;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings');
$script = <<< JS
        var onSubmit = function(token) {
          console.log('success!');
        };

        var onloadCallback = function() {
          grecaptcha.render('submit', {
            'sitekey' : '6LeWQUAUAAAAADe_u72kAuwbpD9TcCooTOckOIII',
            'callback' : onSubmit
          });
        };
JS;

$this->registerJsFile('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit',['async','defer']);
$position = \yii\web\View::POS_READY;
$this->registerJs($script,$position);
?>

<div class="landing-form" style="color:white">

    <?php $form = ActiveForm::begin(); ?>

    <h1 class="text-center"><?php echo Yii::t('frontend', 'Tickcoin') ?></h1>

    <div style="min-height: 320px;background: #b9def0;color:#333;padding-top: 48px">
        <h2 class="text-center">
            One More Step
        </h2>
        <h3 class="text-center">
            Please complete the security check to proceed.
        </h3>
        <div class="text-center" style="width: 320px;margin:10px auto;padding-top: 48px">
            <?php //echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className()) ?>
            <?php echo Html::submitButton('I\'m not a robot',
                ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
    <div class="landing-footer text-center">
        <?= Yii::$app->keyStorage->get('landing.footer', '© Tickcoin, Inc. 2018 - New York, USA'); ?>
    </div>
</div>

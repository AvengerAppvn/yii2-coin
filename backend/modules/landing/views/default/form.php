<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use backend\assets\BackendAsset;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings')
?>

<div class="landing-form" style="color:white">

    <?php $form = ActiveForm::begin(); ?>


    <h1 class="text-center"><?php echo Yii::t('frontend', 'Tickcoin') ?></h1>
    <h2 class="text-center">
        One More Step
    </h2>
    <h3 class="text-center">
        Please complete the security check to proceed.
    </h3>
    <div class="text-center" style="width: 320px;margin:10px auto;">
        <?php echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className(),[
            'jsCallback'=>'console.log("Test")'
        ]) ?>
    </div>

    <div class="landing-footer text-center">
        <?=  Yii::$app->keyStorage->get('landing.footer', '© Tickcoin, Inc. 2018 - New York, USA'); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

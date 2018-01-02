<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings')
?>

<div class="landing-form">

    <?php $form = ActiveForm::begin(); ?>


    <h2><?php echo Yii::t('frontend', 'Account Settings') ?></h2>

    <?php //echo $form->field($model, 'username') ?>

    <?php ActiveForm::end(); ?>

</div>

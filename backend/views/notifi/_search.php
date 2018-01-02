<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\NotificationSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="notification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'notification_id') ?>

    <?php echo $form->field($model, 'type') ?>

    <?php echo $form->field($model, 'data') ?>

    <?php echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'account_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'amount_hash') ?>

    <?php // echo $form->field($model, 'transaction_id') ?>

    <?php // echo $form->field($model, 'resource_path') ?>

    <?php // echo $form->field($model, 'delivery_attempts') ?>

    <?php // echo $form->field($model, 'delivery_response') ?>

    <?php // echo $form->field($model, 'rawdata') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

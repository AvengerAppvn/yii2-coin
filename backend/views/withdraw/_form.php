<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Withdraw;

/* @var $this yii\web\View */
/* @var $model common\models\Withdraw */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="withdraw-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <p>Member: <?php echo $model->user_id ?></p>

    <?php //echo $form->field($model, 'sender')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'amount')->textInput() ?>

    <?php //echo $form->field($model, 'txid')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type')->dropDownList(Withdraw::types()) ?>
    <?php echo $form->field($model, 'status')->dropDownList(Withdraw::statuses()) ?>

    <?php //echo $form->field($model, 'manager_id')->textInput() ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'requested_at')->textInput() ?>

    <?php //echo $form->field($model, 'completed_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

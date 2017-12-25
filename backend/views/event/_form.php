<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'sender')->textInput() ?>

    <?php echo $form->field($model, 'wallet_from')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'wallet_to')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'receiver')->textInput() ?>

    <?php echo $form->field($model, 'type')->textInput() ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

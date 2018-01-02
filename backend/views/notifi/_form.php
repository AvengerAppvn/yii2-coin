<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'notification_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'account_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'amount')->textInput() ?>

    <?php echo $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'delivery_attempts')->textInput() ?>

    <?php echo $form->field($model, 'rawdata')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <?php echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

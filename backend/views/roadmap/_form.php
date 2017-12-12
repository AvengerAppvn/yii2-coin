<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use trntv\yii\datetime\DateTimeWidget;
/* @var $this yii\web\View */
/* @var $model common\models\Roadmap */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="roadmap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'level')->textInput() ?>

    <?php echo $form->field($model, 'price')->textInput() ?>

    <?php echo $form->field($model, 'amount')->textInput() ?>

    <?php echo $form->field($model, 'date_from')->widget(
            DateTimeWidget::className(),
            [
                'phpDatetimeFormat' => 'yyyy-MM-dd'
            ]
        ) ?>
    <?php echo $form->field($model, 'date_to')->widget(
            DateTimeWidget::className(),
            [
                'phpDatetimeFormat' => 'yyyy-MM-dd'
            ]
        ) ?>


    <?php echo $form->field($model, 'time_from')->textInput() ?>

    <?php echo $form->field($model, 'time_to')->textInput() ?>
    <?php echo $form->field($model, 'status')->checkbox(
            [
                'label' => 'Active',
            ]
        ) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
$this->title = Yii::t('backend', 'Landing page edit');
?>
<div class="box">

    <div class="box-body">

        <?php $form = ActiveForm::begin(); ?>

        <?php //echo $form->field($page, 'title')->textInput(['maxlength' => true]) ?>

        <?php //echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($page, 'body')->widget(
            \yii\imperavi\Widget::className(),
            [
                'plugins' => ['fullscreen', 'fontcolor', 'video'],
                'options'=>[
                    'minHeight'=>400,
                    'maxHeight'=>400,
                    'buttonSource'=>true,
                    'imageUpload'=>Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
                ]
            ]
        ) ?>

        <div class="form-group">
            <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<div class="box">
    <div class="box-body">
        <?php echo \common\components\keyStorage\FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap\ActiveForm',
            'submitText' => Yii::t('backend', 'Save'),
            'submitOptions' => ['class' => 'btn btn-primary']
        ]); ?>


    </div>


</div>


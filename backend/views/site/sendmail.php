<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SendmailForm */
/* @var $users common\models\User[] */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = Yii::t('backend', 'Send mail');

?>
<div class="box">
    <div class="box-body">
        <div class="article-form">

            <?php $form = ActiveForm::begin(); ?>

            <?php echo $form->field($model, 'to')->dropDownList(\yii\helpers\ArrayHelper::map(
                $users,
                'username',
                'username'
            ), ['prompt' => 'All']) ?>
            <?php echo $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'body')->widget(
                \yii\imperavi\Widget::className(),
                [
                    //'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 200,
                        'maxHeight' => 200,
                        //'buttonSource' => true,
                        'convertDivs' => false,
                        'removeEmptyTags' => false,
                        //'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
                    ]
                ]
            ) ?>



            <?php //echo $form->field($model, 'attachments')->widget(
            //                Upload::className(),
            //                [
            //                    'url' => ['/file-storage/upload'],
            //                    'sortable' => true,
            //                    'maxFileSize' => 10000000, // 10 MiB
            //                    'maxNumberOfFiles' => 10
            // ]);
            ?>

            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('backend', 'Send'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>


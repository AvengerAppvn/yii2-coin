<?php
use yii\helpers\Html;
use trntv\filekit\widget\Upload;

$this->title = Yii::t('backend', 'Created a new ticket');
/** @var \app\modules\support\models\TicketHead $ticketHead */
/** @var \app\modules\support\models\TicketBody $ticketBody */
?>
<div class="page-support padtop20">
    <div class="panel panel-primary panel-profile">
        <div class="panel-heading clearfix">
            <h2 class="panel-title"><?= Yii::t('backend', 'Created a new ticket') ?></h2>
        </div>

        <div class="panel-body">
            <?php $form = \yii\widgets\ActiveForm::begin([]) ?>

            <div class="col-xs-12">
                <?= $form->field($ticketHead, 'topic')->textInput()->error() ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($ticketHead, 'department')->dropDownList($qq) ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($ticketBody, 'text')->textarea([
                    'style' => 'height: 150px; resize: none;',
                ]) ?>
            </div>
            <div class="col-xs-12">
                <?php echo $form->field($ticketBody, 'attachments')->widget(
                    Upload::className(),
                    [
                        'url' => ['support-upload'],
                        'sortable' => true,
                        'maxFileSize' => 2000000, // 2 MiB
                        'maxNumberOfFiles' => 3
                    ])->label(false);
                ?>
            </div>
            <div class="text-center">
                <button class='btn btn-success'><?= Yii::t('backend', 'Send new ticket') ?></button>
            </div>
            <?php $form->end() ?>
        </div>

        <div class="panel-footer">
            <?= Html::a(
                Html::tag('i','',[
                'class'=>'fa fa-arrow-left'
                ]).' '.Yii::t('frontend', 'Back'), ['/support/ticket'],['class'=>'btn btn-default']);
            ?>
        </div>
    </div>
</div>


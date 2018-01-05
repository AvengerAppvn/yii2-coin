<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
$this->title = Yii::t('backend', 'Support');

/** @var \app\modules\support\models\TicketBody $newTicket */
/** @var \app\modules\support\models\TicketBody $thisTicket */

?>
<div class="page-support padtop20">
    <div class="panel panel-success panel-profile">
        <div class="panel-heading clearfix">
            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="fa fa-ticket" aria-hidden="true"></i> <?= Yii::t('backend', 'View ticket') ?></h2>
        </div>
        <div class="panel-body">
            <?php if ($error = Yii::$app->session->getFlash('error')) : ?>
                <div class="alert alert-danger text-center"><?= $error ?></div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <?= $form->field($newTicket,
                'text')->textarea(['style' => 'height: 150px; resize: none;'])->error() ?>
            <?php echo $form->field($newTicket, 'attachments')->widget(
                Upload::className(),
                [
                    'url' => ['support-upload'],
                    'sortable' => true,
                    'maxFileSize' => 2000000, // 2 MiB
                    'maxNumberOfFiles' => 3
                ])->label(false);
            ?>
            <div class="text-center">
                <button class='btn btn-success'><?= Yii::t('backend', 'Add message') ?></button>
            </div>
            <?= $form->errorSummary($newTicket) ?>
            <?php $form->end() ?>
        </div>
    </div>


    <div class="panel panel-primary panel-profile">
        <div class="panel-heading clearfix">
            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="fa fa-comments" aria-hidden="true"></i> <?= Yii::t('backend', 'Feedback') ?></h2>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <?php foreach ($thisTicket as $ticket) : ?>
                    <tr>
                        <td>
                            <p><b><?= $ticket['name_user'] ?></b></p>
                            <p class="text-danger"><?= $ticket['date'] ?></p>

                        </td>
                        <td>
                            
                            <?= nl2br(Html::encode($ticket['text'])) ?>
                            <?php if (!empty($ticket->file)) : ?>
                                <hr>
                                <?php foreach ($ticket->ticketFiles as $ticketFile) : ?>
                                    <?= Html::img($ticketFile->url,['class'=>'img-thumbnail']); ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <?= Html::a(
                Html::tag('i', '', [
                    'class' => 'fa fa-arrow-left'
                ]) . ' ' . Yii::t('backend', 'Back'), ['/support/ticket'], ['class' => 'btn btn-default']);
            ?>
        </div>
    </div>
</div>

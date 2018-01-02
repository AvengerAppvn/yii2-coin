<?php
use yii\helpers\Url;
use app\modules\support\models\TicketHead;
use yii\helpers\Html;

/** @var TicketHead $dataProvider */

$this->title = Yii::t('backend', 'Support');

$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
           location.href = '" . Url::toRoute(['ticket/view', 'id' => '']) . "' + id ;
    });

");
?>
<div class="page-support padtop20">
    <div class="panel panel-primary panel-profile">
        <div class="panel-heading clearfix">
            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">
                <?= Yii::t('backend', 'List Ticket') ?></h2>
            <div class="btn-group pull-right">
                <?= \yii\helpers\Html::a(Html::tag('i','',[
                        'class'=>'fa fa-plus'
                    ]).' '.Yii::t('backend', 'Send ticket'), ['open'], ['class' => 'btn btn-success']); ?>
            </div>
        </div>
        <div class="panel-body">
            <div>
                <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'rowOptions' => function ($model) {
                        return ['data-id' => $model->id, 'class' => 'ticket'];
                    },
                    'columns' => [
                        'topic',
                        'department',
                        [
                            'attribute' => 'status',
                            'contentOptions' => [
                                'style' => 'text-align:center;',
                            ],
                            'value' => function ($model) {
                                switch ($model['status']) {
                                    case TicketHead::OPEN :
                                        return '<div class="label label-info">Open</div>';
                                    case TicketHead::WAIT :
                                        return '<div class="label label-warning">Processing</div>';
                                    case TicketHead::ANSWER :
                                        return '<div class="label label-success">Completed</div>';
                                    case TicketHead::CLOSED :
                                        return '<div class="label label-default">Closed</div>';
                                }
                            },
                            'format' => 'html',
                        ],
                        [
                            'contentOptions' => [
                                'style' => 'text-align:right; font-size:13px',
                            ],
                            'attribute' => 'date_update',
                            'value' => "date_update",
                        ],
                    ],
                ]) ?>
            </div>

        </div>
    </div>
</div>


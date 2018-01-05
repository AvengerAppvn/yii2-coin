<?php
/** @var \app\modules\support\models\TicketHead $dataProvider */
?>

<div class="panel page-block">
    <div class="container-fluid row">
    <a href="<?= \yii\helpers\Url::toRoute(['admin/open']) ?>" class="btn btn-primary" style="margin-left: 15px">Open ticket</a>
    <br><br>
    <div class="container-fluid">
        <div class="col-md-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => [
                    [
                        'attribute' => 'userName',
                        'value'     => 'userName.username',
                    ],
                    [
                        'attribute' => 'department',
                        'value'     => 'department',
                    ],
                    [
                        'attribute' => 'topic',
                        'value'     => 'topic',
                    ],
                    [
                        'attribute' => 'status',
                        'value'     => function ($model) {
                            switch ($model->body['client']) {
                                case 0 :
                                    if ($model->status == \app\modules\support\models\TicketHead::CLOSED) {
                                        return '<div class="label label-success">Client</div>&nbsp;<div class="label label-default">Closed</div>';
                                    }

                                    return '<div class="label label-success">Client</div>';
                                case 1 :
                                    if ($model->status == \app\modules\support\models\TicketHead::CLOSED) {
                                        return '<div class="label label-primary">Administrator</div>&nbsp;<div class="label label-default">Closed</div>';
                                    }

                                    return '<div class="label label-primary">Administrator</div>';
                            }
                        },
                        'format'    => 'html',
                    ],
                    [
                        'attribute' => 'date_update',
                        'value'     => 'date_update',
                    ],
                    [
                        'class'         => 'yii\grid\ActionColumn',
                        'template'      => '{update}&nbsp;{delete}&nbsp;{closed}',
                        'headerOptions' => [
                            'style' => 'width:230px',
                        ],
                        'buttons'       => [
                            'update' => function ($url, $model) {
                                return \yii\helpers\Html::a('Answer',
                                    \yii\helpers\Url::toRoute(['admin/answer', 'id' => $model['id']]),
                                    ['class' => 'btn-xs btn-info']);
                            },
                            'delete' => function ($url, $model) {
                                return \yii\helpers\Html::a('Delete',
                                    \yii\helpers\Url::to(['admin/delete', 'id' => $model['id']]),
                                    [
                                        'class'   => 'btn-xs btn-danger',
                                        'onclick' => 'return confirm("Are you sure to delete?")',
                                    ]
                                );
                            },
                            'closed' => function ($url, $model) {
                                return \yii\helpers\Html::a('Close',
                                    \yii\helpers\Url::to(['admin/closed', 'id' => $model['id']]),
                                    [
                                        'class'   => 'btn-xs btn-primary',
                                        'onclick' => 'return confirm("Are you sure to close?")',
                                    ]
                                );
                            },
                        ],
                    ],
                ],
            ]) ?>
        </div>
    </div>
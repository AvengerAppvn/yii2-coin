<?php
use yii\helpers\Html;
use common\models\Withdraw;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\WithdrawSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Withdraws';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdraw-index">
    <?php Pjax::begin(); ?>
    <?=Html::beginForm(['/withdraw/index'],'post');?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'Member',
                'value' => function ($model) {
                    return $model->user_id && $model->user ? $model->user->username : null;
                },
            ],
            //'sender',
            'receiver',
            'amount',
            // 'txid',
            [
                'class' => \common\grid\EnumColumn::className(),
                'attribute' => 'type',
                'enum' => Withdraw::types(),
                'filter' => Withdraw::types()
            ],
            [
                'class' => \common\grid\EnumColumn::className(),
                'attribute' => 'status',
                'enum' => Withdraw::statuses(),
                'filter' => Withdraw::statuses()
            ],
            //'manager_id',
            //'created_at:datetime',
            // 'updated_at',
            'requested_at:datetime',
            'completed_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {view}'
                'template' => ' {view} {update} {done}',
                'buttons' => [
                    'done' => function ($url, $model) {
                        return \yii\bootstrap\Html::a('<span class="fa fa-check fa-lg text-success"></span>',
                            $url, [
                            'title' => 'Completed',
                            'onclick' => 'confirm("Are you sure to complete this withdraw?")'
                            //'data-pjax'=>'w0',
                            //'data-add-question'=>$model['id'],
                        ]);
                    }
                ],
                'options' => [
                    'style' => 'width:100px;',
                ]
            ],
        ],
    ]); ?>
    <?= Html::endForm();?>
    <?php Pjax::end(); ?>
</div>

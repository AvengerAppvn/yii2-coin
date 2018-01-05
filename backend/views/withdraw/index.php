<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\WithdrawSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Withdraws';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdraw-index">

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
            'sender',
            'receiver',
            'amount',
            // 'txid',
             'type',
             'status',
             'manager_id',
             //'created_at:datetime',
            // 'updated_at',
             'requested_at:datetime',
             'completed_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {view}'
                'template' => '{update}{view}'

            ],
        ],
    ]); ?>

</div>

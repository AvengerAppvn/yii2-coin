<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\models\Withdraw;
?>
<div class="deposit-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'requested_at:datetime',
            'receiver',
            'amount',
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
            // 'completed_at:datetime',

            //'txid',
        ]
    ]); ?>
</div>

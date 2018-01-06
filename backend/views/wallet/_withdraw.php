<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\grid\EnumColumn;
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
                'class' => EnumColumn::className(),
                'label' => 'Wallet',
                'attribute' => 'type',
                'enum' => [
                    Yii::t('backend', 'TKC'),
                    Yii::t('backend', 'BTC'),
                    Yii::t('backend', 'ETH'),
                ]
            ],
            'completed_at:datetime',
             [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => [
                    Yii::t('backend', 'Request'),
                    Yii::t('backend', 'Processing'),
                    Yii::t('backend', 'Completed'),
                ]
            ],
            //'txid',
        ]
    ]); ?>
</div>

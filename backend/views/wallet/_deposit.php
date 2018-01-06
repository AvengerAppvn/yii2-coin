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

            'sender',
            'amount',
            [
                'class' => EnumColumn::className(),
                'label' => 'Coin',
                'attribute' => 'type',
                'enum' => [
                    Yii::t('backend', 'TKC'),
                    Yii::t('backend', 'BTC'),
                    Yii::t('backend', 'ETH'),
                ]
            ],
            [
                'class' => EnumColumn::className(),
                'label' => 'Confirmed',
                'attribute' => 'status',
                'enum' => [
                    Yii::t('backend', 'Request'),
                    Yii::t('backend', 'Processing'),
                    Yii::t('backend', 'Completed'),
                ]
            ],
            //'created_at:datetime',
        ]
    ]); ?>
</div>

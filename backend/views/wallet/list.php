<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wallet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-index">

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
            'amount_btc',
            'bonus_btc',
            'amount_eth',
            'bonus_eth',
            'amount_coin',
            'amount_bonus',
            'amount_ico',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {view}'
                'template' => '{view}'

            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="wallet-history">
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'created_at',
            'wallet_btc',
            'wallet_coin',
            'status',
            // 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

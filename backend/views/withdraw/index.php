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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Withdraw', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'sender',
            'receiver',
            'amount',
            // 'txid',
            // 'type',
            // 'status',
            // 'manager_id',
            // 'created_at',
            // 'updated_at',
            // 'requested_at',
            // 'completed_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        Event log
    </p>

    <?php // echo GridView::widget([
        // 'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'columns' => [
        //     ['class' => 'yii\grid\SerialColumn'],

        //     'id',
        //     'sender',
        //     'wallet_from',
        //     'wallet_to',
        //     'receiver',
        //     // 'type',
        //     // 'status',
        //     // 'created_at',

        //     ['class' => 'yii\grid\ActionColumn'],
        // ],
    //]); 
    ?>

</div>

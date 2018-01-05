<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Roadmap */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roadmaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roadmap-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Roadmap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'level',
            'price',
            'amount',
            'date_from',
            'time_from',
            'date_to',
            'time_to',
             'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

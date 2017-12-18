<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'related_id',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : 'Admin';
                },
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username')
            ],
            'level',
            'amount_btc',
            'amount_btc_bonus',
            'amount_eth',
            'amount_eth_bonus',
            'amount_total_bonus',
            // 'type',
            // 'status',
            // 'created_at',
            // 'updated_at',

        ],
    ]); ?>
<?php Pjax::end(); ?></div>

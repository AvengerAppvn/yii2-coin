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
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'showFooter'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'related_id',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : '';
                },
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username')
            ],
            [
                'attribute' => 'level',
                'footer' => 'Total',
                'value' => function ($model) {
                    return 'F'.$model->level;
                }
            ],
            //'amount_btc',
            //'amount_btc_bonus',

            [
                'attribute' => 'amount_btc_bonus',
                'footer' => '<b>'.number_format($total_btc_bonus,8).'</b>',
                'value' => function ($model) {
                    return $model->amount_btc_bonus;
                }
            ],
            [
                'attribute' => 'amount_eth_bonus',
                'footer' => '<b>'.number_format($total_eth_bonus,8).'</b>',
                'value' => function ($model) {
                    return $model->amount_eth_bonus;
                }
            ],
            //'amount_eth',
            //'amount_total_bonus',
            // 'type',
            // 'status',
            // 'created_at',
            // 'updated_at',
//            'footer'=> [
//                'amount_btc_bonus'=>100
//            ]
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

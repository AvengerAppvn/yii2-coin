<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RefererSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referer-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Referer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) ?>

</div>

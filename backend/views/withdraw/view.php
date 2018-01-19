<?php
use common\models\Withdraw;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Withdraw */

$this->title = $model->receiver;
$this->params['breadcrumbs'][] = ['label' => 'Withdraws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdraw-view">

    <div class="row">
        <div class="col-md-6">

            <p>
                <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
                //'class' => 'btn btn-danger',
                //'data' => [
                //    'confirm' => 'Are you sure you want to delete this item?',
                //    'method' => 'post',
                //],
                //]) ?>
            </p>
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    //'user_id',
                    [
                        'attribute' => 'user_id',
                        'value' => function ($model) {
                            return $model->user_id && $model->user ? $model->user->username : '';
                        }
                    ],
                    //'sender',
                    'receiver',
                    'amount',
                    //'txid',
                    [
                        'class' => \common\grid\EnumColumn::className(),
                        'attribute' => 'type',
                        'value' => ArrayHelper::getValue(Withdraw::types(), $model->type)
                    ],
                    [
                        'class' => \common\grid\EnumColumn::className(),
                        'attribute' => 'status',
                        'value' => ArrayHelper::getValue(Withdraw::statuses(), $model->status)
                    ],
                    //'status',
                    //'manager_id',
                    'created_at:datetime',
                    //'updated_at',
                    //'requested_at',
                    'completed_at:datetime',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <h3>
                    Address wallet of receiver:</h3>
                <h4>
                    <?php echo $model->receiver ?>
                </h4>
                <img src="<?= $code ?>"/>
            </div>
        </div>
    </div>


</div>

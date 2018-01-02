<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'notification_id',
            'type',
            'data:ntext',
            'user_id',
            'account_id',
            'address',
            'currency',
            'amount',
            'amount_hash',
            'transaction_id',
            'resource_path',
            'delivery_attempts',
            'delivery_response:ntext',
            'rawdata:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

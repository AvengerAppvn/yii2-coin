<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = 'Update Notification: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notification-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

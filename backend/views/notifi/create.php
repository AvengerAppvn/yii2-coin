<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = 'Create Notification';
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

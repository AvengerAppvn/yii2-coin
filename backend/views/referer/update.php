<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Referer */

$this->title = 'Update Referer: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Referers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="referer-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Roadmap */

$this->title = 'Update Roadmap: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roadmaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roadmap-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

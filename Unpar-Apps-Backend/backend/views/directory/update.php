<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Directory */

$this->title = 'Update Directory: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="directory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

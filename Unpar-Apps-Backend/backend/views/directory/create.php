<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Directory */

$this->title = 'Create Directory';
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="directory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

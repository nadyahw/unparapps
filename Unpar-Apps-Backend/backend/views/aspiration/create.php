<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Aspiration */

$this->title = 'Create Aspiration';
$this->params['breadcrumbs'][] = ['label' => 'Aspirations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspiration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

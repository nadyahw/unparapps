<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Aspiration */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Aspirations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspiration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'content',
            'create_date',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => "<img src='".Yii::$app->urlManagerFrontEnd->createUrl([$model->img])."' width='300'>",
            ],
            [
                'label'=>'status',
                'value'=>$model->status == '0' ?'Tidak Aktif':'Aktif',
            ],
        ],
    ]) ?>

</div>

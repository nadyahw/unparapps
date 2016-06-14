<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use common\models\Aspiration;

/* @var $this yii\web\View */
/* @var $model common\models\Aspiration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aspiration-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    <?= $form->field($model, 'content')->textArea(['maxlength' => true,'readonly'=>true,'rows'=>'4']) ?>
    <?= $form->field($model, 'create_date')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    <?= $form->field($model, 'img')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    <?= $form->field($model, 'status')->dropDownList([Aspiration::STATUS_AKTIF => 'Aktif', Aspiration::STATUS_TIDAK => 'Tidak Aktif'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

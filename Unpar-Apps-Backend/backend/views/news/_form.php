<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\News;
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(letyii\tinymce\Tinymce::className(),  Yii::$app->params['tinyMceWidgetConf']);
    ?>

    <?= $form->field($model, 'thumbnail')->textInput(['maxlength'=>true]) ?>
    <?= $form->field($model, 'tipe')->dropDownList([News::TIPE_EVENT => 'Event', News::TIPE_BEASISWA=> 'Beasiswa'])?>

    <?= $form->field($model, 'status')->dropDownList([News::STATUS_AKTIF => 'Aktif', News::STATUS_TIDAK => 'Tidak Aktif'])?>

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

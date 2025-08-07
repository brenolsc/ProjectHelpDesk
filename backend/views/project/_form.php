<?php

use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Project $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile(
        '@web/js/projectForm.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name', [
        'labelOptions' => ['style' => 'font-weight: bold; margin-top: 20px; display: block;']
    ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tech_stack', [
        'labelOptions' => ['style' => 'font-weight: bold; margin-top: 20px; display: block;']
    ])->radioList([
        'Sistema A' => 'Sistema A',
        'Sistema B' => 'Sistema B',
        'Sistema C' => 'Sistema C',
    ]) ?>

    <?= $form->field($model, 'description', [
        'labelOptions' => ['style' => 'font-weight: bold; margin-top: 20px; display: block;']
    ])->widget(Summernote::class, [
        'useKrajeePresets' => true,
    ]) ?>

    <?= $form->field($model, 'start_date', [
        'labelOptions' => ['style' => 'font-weight: bold; margin-top: 20px; display: block;']
    ])->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['readOnly' => true],
    ]) ?>


    <?php foreach($model->images as $image): ?>
    <div id="project-form__image-container-<?= $image->id ?>" class="project-form__image-container">
        <?= Html::img($image->file->absoluteUrl(), [
            'alt' => 'Demonstração',
            'height' => '200px',
            'class' => 'project-form__image'
        ]) ?>

        <?= Html::button(Yii::t('app','Deletar'), ['class' => 'btn btn-danger  btn-delete-project',
            'data-project-image-id' => '$image->id'
        ]) ?>

        <div id="project-form__image-error-message- <?= $image->id ?>" class="text-danger"></div>
    </div>

    <?php endforeach; ?>

    <!-- Campo de imagem com espaçamento -->
    <div style="margin-top: 20px;">
        <?= $form->field($model, 'imagefile')
            ->fileInput()
            ->label('Imagem do Projeto', ['style' => 'font-weight: bold;']) ?>
    </div>

    <?php  $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group" style="margin-top: 30px;">
        <?= Html::submitButton(Yii::t('app', 'Salvar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
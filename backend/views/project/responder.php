<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Project $model */

$this->title = 'Responder chamado: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chamados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="project-view">
    <p><strong>Nome:</strong> <?= Html::encode($model->name) ?></p>
    <p><strong>Sistema:</strong> <?= Html::encode($model->tech_stack) ?></p>
    <p><strong>Descrição:</strong> <?= Html::decode($model->description) ?></p>
    <p><strong>Data de Início:</strong> <?= Html::encode($model->start_date) ?></p>
</div>

<hr>

<div class="project-responder-form">
    <h3>Responder Chamado</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resposta')->textarea(['rows' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar Resposta', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

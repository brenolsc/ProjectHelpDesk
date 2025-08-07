<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Chamados Atendidos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chamados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-attended">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'tech_stack:ntext',
            'start_date',
            //'end_date',
            // outros campos
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {responder} {delete}',  // adiciona o {responder} aqui
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Visualizar', $url, [
                            'class' => 'btn btn-info btn-sm',
                            'title' => 'Visualizar',
                            'aria-label' => 'Visualizar',
                            'data-pjax' => '0',
                        ]);
                    },
                    'responder' => function ($url, $model, $key) {
                        if (Yii::$app->controller->action->id === 'attended') {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> Responder', ['responder', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-sm',
                                'title' => 'Responder chamado',
                                'aria-label' => 'Responder chamado',
                            ]);
                        }
                        return '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', $url, [
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Deletar',
                            'aria-label' => 'Deletar',
                            'data-confirm' => 'Tem certeza que deseja deletar este chamado?',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>

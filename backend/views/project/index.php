<?php

use common\models\Project;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Chamados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Novo Chamado'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Chamados Atendidos', ['attended'], ['class' => 'btn btn-info']) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'tech_stack:ntext',
            'start_date',
            //'end_date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {attend} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Visualizar', $url, [
                            'class' => 'btn btn-info btn-sm',
                            'title' => 'Visualizar',
                            'aria-label' => 'Visualizar',
                            'data-pjax' => '0',
                        ]);
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
                    'attend' => function ($url, $model, $key) {
                        if ($model->status !== 'atendido') {
                            return Html::a('Atender Chamado', ['attend', 'id' => $model->id], [
                                'class' => 'btn btn-success btn-sm',
                                'title' => 'Atender',
                                'aria-label' => 'Atender',
                                'data-confirm' => 'Tem certeza que deseja Atender este chamado?',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        }
                        return '';
                    },
                ],
                'urlCreator' => function ($action, Project $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],


        ],
    ]); ?>


</div>

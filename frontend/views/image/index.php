<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;

/** @var ActiveDataProvider $dataProvider */

$this->title = 'Список изображений';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a('Загрузить изображение', ['image/upload'], ['class' => 'btn btn-primary']) ?>

<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'size',
        'created_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                        [
                                'delete', 'id' => $model->id], [
                                    'title' => 'Удалить',
                                    'data-confirm' => 'Вы уверены, что хотите удалить эту запись?',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                        ]);
                },
            ],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-download"></span>',
                        [
                            'download', 'id' => $model->id], [
                            'title' => 'Скачать',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                },
            ],
        ],
    ],
    'options' => [
        'class' => 'grid-view',
    ],
    'tableOptions' => [
        'class' => 'table table-striped',
    ],
    'pager' => [
        'options' => [
            'class' => 'pagination justify-content-center',
        ],
        'prevPageLabel' => 'Назад',
        'nextPageLabel' => 'Вперед',
    ],
]) ?>


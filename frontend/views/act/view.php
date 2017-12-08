<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = 'Акт №' . $model->number . " от " . Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Акты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->number;
?>
<div class="act-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Уверены, что надо удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php
        echo ButtonDropdown::widget([
            'label' => 'Печать',
            'options' => [
                'class' => 'btn btn-info',
            ],
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'Акт приёма',
                        'url' => "index.php?r=act/printact&id=$model->id"
                    ],
                    [
                        'label' => 'Акт передачи',
                        'url' => "index.php?r=act/printacttransfer&id=$model->id"
                    ],
                    [
                        'label' => 'Приложение к Акту',
                        'url' => "index.php?r=act/printactannex&id=$model->id"
                    ],
                    [
                        'label' => '',
                        'options' => [
                            'role' => 'presentation',
                            'class' => 'divider'
                        ]
                    ],
                    [
                        'label' => 'Карточка',
                        'url' => "index.php?r=act/printcards&id=$model->id"
                    ]
                ]
            ]
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'date',
            'grantor',
            'comment:ntext',
        ],
    ]) ?>
    
    <?= Html::a(Yii::t('app', 'Добавить книгу в акт'), ['actbook/create', 'act_id' => $model->id], ['class' => 'btn btn-success']) ?>
    
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getActBooks()]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
//            'inventory_number',
            [
                'attribute' => 'inventory_number',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->inventory_number,['actbook/update', 'id' => $model->id]);
                },
//                'value' => 'book.title',
            ],
            'price',
            [
                'attribute' => 'book_id',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->book->title,['book/view', 'id' => $model->book_id]);
                },
//                'value' => 'book.title',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'actbook',
                'contentOptions' => ['style' => 'white-space: nowrap'],
            ],
        ],
    ]); ?>

</div>

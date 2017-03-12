<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = 'Акт №' . $model->number;
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
            'inventory_number',
            'price',
            [
                'attribute' => 'book_id',
                'value' => 'book.title',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'actbook',
            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Книги'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

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
            'isbn',
            'author:ntext',
            'authorname:ntext',
            'authorpatronymic:ntext',
            'otherauthors:ntext',
            'editor:ntext',
            'title:ntext',
            'city',
            'publisher',
            'year',
            'volume',
            'serie:ntext',
            'description:ntext',
            'comment:ntext',
        ],
    ]) ?>

    
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getActBooks()]),
        'columns' => [
            // 'id',
            [
                'attribute' => 'act_id',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->act->number,['act/view', 'id' => $model->act_id]);
                },
//                'value' => 'act.number',
            ],
            'inventory_number',
            'price',
        ],
    ]); ?>
</div>

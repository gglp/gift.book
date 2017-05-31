<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = 'Акт №' . $model->number . " от " . Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy');

$amount = 0;

foreach ($model->actBooks as $actbook){
    $amount += $actbook->price;
}
?>
<div class="act-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p><?= Html::encode("Даритель: " . $model->grantor) ?></p>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getActBooks()
                ->orderBy(['inventory_number' => SORT_ASC]),
            'pagination' => false,
            'sort' => false,]),
        'layout'=>"{items}",
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '50']
            ],

            // 'id',
            [
                'attribute' => 'inventory_number',
                'format' => 'text',
                'label' => 'Инв.номер',
                'headerOptions' => ['width' => '120']
            ],
            [
                'attribute' => 'book_id',
                'format' => 'raw',
                'headerOptions' =>['width' => '400'],
                'value' => function($model){
                    return Html::encode($model->book->description);
                },
//                'value' => 'book.title',
            ],
            'price',
        ],
    ]); ?>

</div>

<p><?= Html::encode("Всего книг: " . count($model->actBooks) . " на сумму: " . $amount . " руб.") ?></p>


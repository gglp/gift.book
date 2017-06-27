<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = 'Акт приёма книг № ' . $model->number . " от " . Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy');

$amount = 0;

foreach ($model->actBooks as $actbook){
    $amount += $actbook->price;
}
?>
<div class="act-view">

    <p>ИНИОН РАН</p>
    <p>Пожертвование</p>
    
    <h2><?= Html::encode($this->title) ?></h2>
    <p>(лист инвентарной книги)</p>
    
    <p><?= Html::encode("От: " . $model->grantor) ?></p>

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

<p><?= Html::encode("Итого принято книг: " . count($model->actBooks)) ?><br />
<?= Html::encode("На сумму: " . $amount . " руб. 00 коп.") ?></p>
<br />
<p>Акт составил: _________________________________</p>


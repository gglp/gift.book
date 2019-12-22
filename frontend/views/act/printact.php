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
    
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
    <p style="text-align: center">(лист инвентарной книги)</p>
    
    <p style="margin-bottom: 23px;"><?= Html::encode("От: " . $model->grantor) ?></p>
    <br />
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
<?= Html::encode("На сумму: " . intval($amount) . ' руб. ' . round(($amount - intval($amount)) * 100) .' коп.') ?></p>
<br />
<p>Акт составил: _________________________________</p>


<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = 'АКТ № ' . $model->number . " от " . Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy');

$amount = 0;

foreach ($model->actBooks as $actbook){
    $amount += $actbook->price;
}
?>
<div class="act-view">
    
    <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
    <p>передачи литературы из Отдела комплектования научных фондов (ОКНФ)
        в Отдел научных фондов (ОНФ) ИНИОН РАН в количестве
        <?= Html::encode(count($model->actBooks)) ?> ед.
        <?= Html::encode("на сумму: " . $amount . " руб. 00 коп.") ?></p>
    <p>Упаковано в коробки в количестве ______ шт.</p>
    <p>Источник поступления: пожертвования</p>
    <p>Передал: ОКНФ _______________________</p>
    <p>Принял: ОНФ   _______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Зав. ОНФ _______________________ /Т.И.Решетник/</p>
    
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

<p><?= Html::encode("Итого передано книг: " . count($model->actBooks)) ?><br />
<?= Html::encode("На сумму: " . $amount . " руб. 00 коп.") ?></p>
<br />
<p>Акт составил: _________________________________</p>


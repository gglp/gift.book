<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Catalog */
/* @var $allBooks array */
/* @var $dateRangeModel frontend\models\CatatogDateRangeForm */



$this->title = 'Книги, полученные ФБ ИНИОН РАН, по рубрике "' . $model->name . '" (' . $model->code . ') с ' . Yii::$app->formatter->asDate($dateRangeModel->from, 'dd.MM.yyyy') .  ' по ' . Yii::$app->formatter->asDate($dateRangeModel->to, 'dd.MM.yyyy');

$sumPrice = 0;
$sumCount = 0;

?>
<div class="act-view">
    <p>ИНИОН РАН</p>
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Книга</th>
                <th scope="col">Инв. номер</th>
                <th scope="col">Акт</th>
                <th scope="col">Цена</th>
            </tr>
        </thead>
        <tbody>
      <?php 
        foreach ($allBooks as $key => $book) {
            $sumCount += 1;
            $sumPrice += $book['rprice'];
            print 
            '<tr>' .
                '<td>' . ($key + 1) . '</td>' .
                '<td>' . Html::encode($book['rbook']) . '</td>' .
                '<td>' . Html::encode($book['rinventory_number']) . '</td>' .
                '<td>' . Html::encode($book['rnumber']) . ' от ' . Html::encode(Yii::$app->formatter->asDate($book['rdate'], 'dd.MM.yyyy')) . '</td>' .
                '<td>' . Html::encode($book['rprice']) . '</td>' .
            '</tr>';   
        }
      ?>
        </tbody>
    </table>
</div>

<p><?= Html::encode("Итого принято книг: " . $sumCount) ?><br />
<?= Html::encode("На сумму: " . intval($sumPrice) . ' руб. ' . round(($sumPrice - intval($sumPrice)) * 100) .' коп.') ?></p>



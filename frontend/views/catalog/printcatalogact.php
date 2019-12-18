<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Catalog */
/* @var $allModels array */
/* @var $dateRangeModel frontend\models\CatatogDateRangeForm */



$this->title = 'Книги, полученные ФБ ИНИОН РАН, по рубрике "' . $model->name . '" (' . $model->code . ') с ' . $dateRangeModel->from .  ' по ' . $dateRangeModel->to;

$sumPrice = 0;
$sumCount = 0;

?>
<div class="act-view">
<h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Автор, название</th>
      <th scope="col">Инв. номер</th>
      <th scope="col">Номер акта</th>
      <th scope="col">Дата акта</th>
      <th scope="col">Кол-во</th>
      <th scope="col">Цена</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        foreach ($allModels as $key => $book) {
            $sumCount += $book['resbookcount'];
            $sumPrice += $book['resprice'];
            print 
            '<tr>' .
                '<td>' . ($key + 1) . '</td>' .
                '<td>' . Html::encode($book['resauthor'] . ' - ' . $book['restitle']) . '</td>' .
                '<td>' . Html::encode($book['resinvnum']) . '</td>' .
                '<td>' . Html::encode($book['resactnumber']) . '</td>' .
                '<td>' . Html::encode($book['resactdate']) . '</td>' .
                '<td>' . Html::encode($book['resbookcount']) . '</td>' .
                '<td>' . Html::encode($book['resprice']) . '</td>' .
            '</tr>';
                    
        }
      ?>
  </tbody>    
</table>


</div>

<p><?= Html::encode("Итого принято книг: " . $sumCount) ?><br />
<?= Html::encode("На сумму: " . $sumPrice . " руб. 00 коп.") ?></p>



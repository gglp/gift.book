<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = 'Приложение к Акту приёма книг №' . $model->number . " от " . Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy');

$amount = 0;

foreach ($model->actBooks as $actbook){
    $amount += $actbook->price;
}
?>
<div class="act-view">

    <p>ФГБУН ИНИОН РАН</p>
    <br />
    <br />
    <br />
    <br />
    <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
    <br />
    <p>Приходный акт на литературу, полученную безвозмездно <?= Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy') ?> <?= Html::encode("от: " . $model->grantor) ?></p>

</div>
<br />
<br />
<p><?= Html::encode("Всего поступило: " . count($model->actBooks) . " экз. на сумму: " . $amount . " руб.") ?></p>
<p><?= Html::encode("Взято на баланс: " . count($model->actBooks) . " экз. на сумму: " . $amount . " руб.") ?></p>
<br />
<br />
<p>Акт составил: _________________________________</p>
<br />
<p>Дата: _________________________________</p>

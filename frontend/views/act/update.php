<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Act */

$this->title = Yii::t('app', 'Изменить {modelClass}: ', [
    'modelClass' => 'Акт №',
]) . $model->number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Акты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="act-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ActBook */

$this->title = Yii::t('app', 'Изменить {modelClass}: ', [
    'modelClass' => 'книгу в акте',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Книга в акте'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="act-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

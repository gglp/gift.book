<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ActBook */

$this->title = Yii::t('app', 'Create Act Book');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Act Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = Yii::t('app', 'Добавить книгу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Книги'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

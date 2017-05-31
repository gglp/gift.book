<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'isbn') ?>

    <?= $form->field($model, 'author') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'publisher') ?>

    <?= $form->field($model, 'volume') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Сбросить'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

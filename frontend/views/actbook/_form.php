<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;

use frontend\models\Book;

/* @var $this yii\web\View */
/* @var $model frontend\models\ActBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="act-book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_id')->widget(
            Select2Widget::className(),
            [
                'items' => isset($model->book_id) ? ArrayHelper::map(Book::find()->all(), 'id', 'title') : ['id' => null, 'title' => ''],
                'ajax' => ['actbook/ajax', 'act_id' => $model->act_id],
            ]
        );
    ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inventory_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Catalog */
/* @var $dateRangeModel frontend\models\CatatogDateRangeForm */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Изменить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Уверены, что надо удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'name',
        ],
    ]) ?>

</div>
<!-- Форма диапазона дат -->
<div class="date-range-form panel panel-default">
    <div class="panel-body">
    <?php $form = ActiveForm::begin(['action' => ['report', 'id' => $model->id], 'options' => ['class' => 'navbar-form navbar-left', 'target' => '_blank']]); ?>

    <?= $form->field($dateRangeModel, 'from')->widget(DatePicker::classname(), [
        'options' => ['class' => 'form-control'],
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>

    <?= $form->field($dateRangeModel, 'to')->widget(DatePicker::classname(), [
        'options' => ['class' => 'form-control'],
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Печать отчета принятых книг'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- End Форма диапазона дат -->
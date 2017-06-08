<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ActSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Акты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить Акт'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            //'number',
            [
                'attribute' => 'number',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->number,['act/view', 'id' => $model->id]);
                },
            ],
            'date',
            'grantor',
            'comment:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'white-space: nowrap'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

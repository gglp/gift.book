<?php
use yii\helpers\Html;

//echo 'Hello!';

$actbooks = $model->actBooks;
//print_r ($books);

foreach ($actbooks as $actbook) {
$book = $actbook->book;
?>
<table width="100%">
    <tr>
        <td width="20%" valign="top"><?php echo $actbook->inventory_number; ?><br /><br />ИНИОН</td>
        <td colspan="2" valign="top" height="150px"><?php echo $book->description; ?><br /><br /><?php echo implode(', ', $book->getCatalogData('code')); ?></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="25%"><?php echo $model->number; ?><br /><?= Html::encode(Yii::$app->formatter->asDate($model->date, 'dd.MM.yyyy')) ?></td>
    </tr>
</table>
<?php
}

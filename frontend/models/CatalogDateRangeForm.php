<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CatalogDateRangeForm extends Model
{
    public $from;
    public $to;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to', 'from'], 'required'],
            [['to', 'from'], 'date', 'format' => 'php:Y-m-d'],
            ['to', 'compare', 'compareAttribute' => 'from', 'operator' => '>=']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'from' => Yii::t('app', 'Дата начала'),
            'to' => Yii::t('app', 'Дата конца'),
        ];
    }

}

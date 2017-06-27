<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%act_book}}".
 *
 * @property integer $id
 * @property integer $act_id
 * @property integer $book_id
 * @property string $price
 * @property string $inventory_number
 *
 * @property Act $act
 * @property Book $book
 */
class ActBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%act_book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_id', 'book_id'], 'integer'],
            [['price'], 'number'],
            [['inventory_number'], 'string', 'max' => 255],
            [['act_id'], 'exist', 'skipOnError' => true, 'targetClass' => Act::className(), 'targetAttribute' => ['act_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'act_id' => Yii::t('app', 'Акт'),
            'book_id' => Yii::t('app', 'Автор, заглавие'),
            'price' => Yii::t('app', 'Цена'),
            'inventory_number' => Yii::t('app', 'Инвентарный номер'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAct()
    {
        return $this->hasOne(Act::className(), ['id' => 'act_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }
}

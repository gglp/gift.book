<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%act}}".
 *
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $grantor
 * @property string $comment
 *
 * @property ActBook[] $actBooks
 */
class Act extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%act}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['comment'], 'string'],
            [['number', 'grantor'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Номер'),
            'date' => Yii::t('app', 'Дата'),
            'grantor' => Yii::t('app', 'Даритель'),
            'comment' => Yii::t('app', 'Комментарий'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActBooks()
    {
        return $this->hasMany(ActBook::className(), ['act_id' => 'id']);
    }
}

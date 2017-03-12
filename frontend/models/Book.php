<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $isbn
 * @property string $author
 * @property string $title
 * @property integer $year
 * @property string $city
 * @property string $publisher
 * @property integer $volume
 * @property string $comment
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'title', 'comment'], 'string'],
            [['year', 'volume'], 'integer'],
            [['isbn'], 'string', 'max' => 13],
            [['city', 'publisher'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'isbn' => Yii::t('app', 'ISBN'),
            'author' => Yii::t('app', 'Автор'),
            'title' => Yii::t('app', 'Название'),
            'year' => Yii::t('app', 'Год'),
            'city' => Yii::t('app', 'Город'),
            'publisher' => Yii::t('app', 'Издательство'),
            'volume' => Yii::t('app', 'Объём'),
            'description' => Yii::t('app', 'Описание'),
            'comment' => Yii::t('app', 'Комментарий'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActBooks()
    {
        return $this->hasMany(ActBook::className(), ['book_id' => 'id']);
    }
}

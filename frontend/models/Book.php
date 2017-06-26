<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $isbn
 * @property string $author
 * @property string $authorname
 * @property string $authorpatronymic
 * @property string $otherauthors
 * @property string $editor
 * @property string $title
 * @property integer $year
 * @property string $city
 * @property string $publisher
 * @property integer $volume
 * @property string $serie
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
            [['title', 'description', 'comment'], 'string'],
            [['year', 'volume'], 'integer'],
            [['isbn', 'author', 'otherauthors', 'authorname', 'authorpatronymic', 'editor', 'city', 'publisher', 'serie'], 'string', 'max' => 255],
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
            'author' => Yii::t('app', 'Автор - Фамилия'),
            'authorname' => Yii::t('app', 'Автор - Имя'),
            'authorpatronymic' => Yii::t('app', 'Автор - Отчество'),
            'otherauthors' => Yii::t('app', 'Другие авторы'),
            'editor' => Yii::t('app', 'Ответственность'),
            'title' => Yii::t('app', 'Заглавие'),
            'year' => Yii::t('app', 'Год'),
            'city' => Yii::t('app', 'Город'),
            'publisher' => Yii::t('app', 'Издательство'),
            'volume' => Yii::t('app', 'Объём'),
            'serie' => Yii::t('app', 'Серия'),
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
    
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        
        if ($this->description == "")
        {
            $this->description =
                    $this->author
                    . ", " . mb_substr($this->authorname, 0, 1) . "."
                    . mb_substr($this->authorpatronymic, 0, 1) . "."
                    . " " . $this->title
                    . " / " . $this->otherauthors . ";"
                    . "; " . $this->editor
                    . " – " . $this->city
                    . ": " . $this->publisher
                    . ", " . $this->year
                    . ". – " . $this->volume . " с."
                    . " – " . $this->serie . "."
                    . " – ISBN " . $this->isbn
                    . "."
                    ;
        }
        
        return true;
    }
}

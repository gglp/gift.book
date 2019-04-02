<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property BookCatalog[] $bookCatalogs
 * @property Book[] $books
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['code'], 'integer', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Номер'),
            'code' => Yii::t('app', 'Код рубрики'),
            'name' => Yii::t('app', 'Название рубрики'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCatalogs()
    {
        return $this->hasMany(BookCatalog::className(), ['catalog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('book_catalog', ['catalog_id' => 'id']);
    }
}

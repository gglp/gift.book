<?php

namespace frontend\models;

use Yii;
use frontend\behaviors\BookCatalogManagmentBehavior;

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
     * @var array Field to store catalog items when edited at form
     */
    public $formcatalog;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }
    
    public function behaviors()
    {
        return [
            'adjustWithCatalog' => [
                'class' => BookCatalogManagmentBehavior::className(),
            ],
        ];
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
            [['formcatalog'], 'safe'],
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
            'formcatalog' => Yii::t('app', 'Рубрики'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActBooks()
    {
        return $this->hasMany(ActBook::className(), ['book_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCatalogs()
    {
        return $this->hasMany(BookCatalog::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['id' => 'catalog_id'])->viaTable('book_catalog', ['book_id' => 'id']);
    }   
    
    /**
     * Returns catalog for a form
     * Return value is an array like ['11', '13'] fit for form attribute
     */
    public function getFormCatalog()
    {
        $result = [];
        $items = BookCatalog::find()->select('catalog_id')->where(['book_id' => $this->id])->asArray()->all(); 
        foreach ($items as $val) {
            $result[] = $val['catalog_id'];
        }
        return $result;
    }
    
    /**
     * Returns array of model's catalog items
     * 
     * @param string $what Which data to get from catalog. Should be 'code' or 'name'
     * @return array
     */
    public function getCatalogData($what)
    {
        $result = [];
        foreach ($this->catalogs as $catalog) {
            $result[] = $catalog[$what];
        }
        return $result;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        
/*        echo '<pre>';
        echo var_dump(!empty($this->isbn) ? " – ISBN " . $this->isbn : "");
        die('</pre>');
*/                
        if ($this->description == "")
        {
            // Подготовим описание автора
            $author = (!empty($this->author) ? $this->author : "")
                    . (!empty($this->authorname) ? ", " . mb_substr($this->authorname, 0, 1) . "." : "")
                    . (!empty($this->authorpatronymic) ? mb_substr($this->authorpatronymic, 0, 1) . "." : "")
                    ;
            
            // Теперь автор и остальные авторы
            $authorInOtherAuthors = (!empty($this->authorname) ? mb_substr($this->authorname, 0, 1) . "." : "")
                    . (!empty($this->authorpatronymic) ? mb_substr($this->authorpatronymic, 0, 1) . "." : "")
                    . (!empty($this->author) ? " ".$this->author : "")
                    ;
            
            $tempArray = array();
            if (!empty($authorInOtherAuthors)) {
                $tempArray[] = $authorInOtherAuthors;
            }
            if (!empty($this->otherauthors)) {
                $tempArray[] = $this->otherauthors;
            }
            
            $otherauthors = implode(", ", $tempArray);
            
            $tempArray = array();
            if (!empty($otherauthors)) {
                $tempArray[] = $otherauthors;
            }
            if (!empty($this->editor)) {
                $tempArray[] = $this->editor;
            }

            $authorsWithEditor = implode("; ", $tempArray);
            
            // Сформируем полное библиографическое описание
            $this->description =
                    (!empty($author) ? ($author . " ") : "")
                    . $this->title
                    . (!empty($authorsWithEditor) ? " / " . $authorsWithEditor . "." : "")
                    . " – " . $this->city
                    . ": " . $this->publisher
                    . ", " . $this->year
                    . (!empty($this->volume) ? ". – " . $this->volume . " с." : "")
                    . (!empty($this->serie) ? " – (" . $this->serie . ")." : "")
                    . (!empty($this->isbn) ? " – ISBN " . $this->isbn . "." : "")
                    ;
        }
        
        return true;
    }
}

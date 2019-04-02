<?php
namespace frontend\behaviors;

use Yii;
use yii\db\ActiveRecord;
use frontend\models\BookCatalog;

/**
 * Adjusts catalog for a book from data which came from form
 */
class BookCatalogManagmentBehavior extends \yii\base\Behavior
{
    /**
     * @inheritdoc
     */      
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];
    } 
    
    /**
     * Event handler.
     * 
     * @param \yii\base\Event $event
     */    
    public function afterInsert($event)
    {
        $book = $this->owner;
        $formcatalog = $book->formcatalog;
        if (!empty($formcatalog) && is_array($formcatalog)) {
            foreach ($formcatalog as $val) {
                $item = new BookCatalog([
                    'book_id' => $book->id,
                    'catalog_id' => $val,
                ]);
                $item->save(false);
            }
        }
        
    }
    
    /**
     * Event handler.
     * 
     * @param \yii\base\Event $event
     */    
    public function afterUpdate($event)
    {
        $book = $this->owner;
        
        $newcatalog = [];
        $formcatalog = $book->formcatalog;
        if (!empty($formcatalog) && is_array($formcatalog)) {
            foreach ($formcatalog as $val) {
                $newcatalog[(int) $val] = (int) $val;
            }
        }
        
        foreach( $book->bookCatalogs as $bookCatalog) {
            $cat_id = $bookCatalog->catalog_id;
            if (!isset($newcatalog[$cat_id])) {
               $bookCatalog->delete(); 
            } else {
                unset($newcatalog[$cat_id]);
            }
        }
        
        foreach ($newcatalog as $val) {
            $item = new BookCatalog([
                'book_id' => $book->id,
                'catalog_id' => $val,
            ]);
            $item->save(false);            
        }
        
    }
    
}

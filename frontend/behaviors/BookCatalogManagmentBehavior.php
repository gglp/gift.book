<?php
namespace frontend\behaviors;

use Yii;
use yii\db\ActiveRecord;
use frontend\models\BookCatalog;

/**
 * Adjusts catalog for a book from data which comes from form
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
        $this->saveNewItems($this->owner->formcatalog);
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
        // not model editing with form scenario
        if (is_null($formcatalog)) {
            return;
        }
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
        
        $this->saveNewItems($newcatalog);
    }
	
    private function saveNewItems($formcatalog)
    {
        $book = $this->owner;
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
    
}

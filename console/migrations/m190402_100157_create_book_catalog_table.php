<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book_catalog`.
 */
class m190402_100157_create_book_catalog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        
        $this->createTable('book_catalog', [
            'book_id' => $this->integer()->notNull(),
            'catalog_id' => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('idx-book_catalog-pk', 'book_catalog', ['book_id', 'catalog_id']);    
        $this->createIndex('idx-book_catalog-catalog_id', 'book_catalog', 'catalog_id');
        
        $this->addForeignKey('fk-book_catalog-book', 'book_catalog', 'book_id', 'book', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-book_catalog-catalog', 'book_catalog', 'catalog_id', 'catalog', 'id', 'CASCADE', 'RESTRICT');        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book_catalog');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `act_book`.
 * Has foreign keys to the tables:
 *
 * - `act`
 * - `book`
 */
class m170209_112633_create_junction_table_for_act_and_book_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('act_book', [
            'id' => $this->primaryKey(),
            'act_id' => $this->integer()->comment('Акт'),
            'book_id' => $this->integer()->comment('Книга'),
            'price' => $this->decimal(10, 2)->comment('Цена'),
            'inventory_number' => $this->string()->comment('Инвентарный номер')
        ]);

        // creates index for column `act_id`
        $this->createIndex(
            'idx-act_book-act_id',
            'act_book',
            'act_id'
        );

        // add foreign key for table `act`
        $this->addForeignKey(
            'fk-act_book-act_id',
            'act_book',
            'act_id',
            'act',
            'id',
            'CASCADE'
        );

        // creates index for column `book_id`
        $this->createIndex(
            'idx-act_book-book_id',
            'act_book',
            'book_id'
        );

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-act_book-book_id',
            'act_book',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `act`
        $this->dropForeignKey(
            'fk-act_book-act_id',
            'act_book'
        );

        // drops index for column `act_id`
        $this->dropIndex(
            'idx-act_book-act_id',
            'act_book'
        );

        // drops foreign key for table `book`
        $this->dropForeignKey(
            'fk-act_book-book_id',
            'act_book'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-act_book-book_id',
            'act_book'
        );

        $this->dropTable('act_book');
    }
}

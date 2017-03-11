<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m170208_094404_create_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'isbn' => $this->string(13)->comment('ISBN'),
            'author' => $this->text()->comment('Автор'),
            'title' => $this->text()->comment('Название'),
            'year' => $this->integer(4)->comment('Год издания'),
            'city' => $this->string()->comment('Город издания'),
            'publisher' => $this->string()->comment('Издательство'),
            'volume' => $this->integer(4)->comment('Объём'),
            'description' => $this->text()->comment('Описание'),
            'comment' => $this->text()->comment('Комментарий'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book');
    }
}

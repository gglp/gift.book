<?php

use yii\db\Migration;

class m170608_085048_alter_isbn_column_in_book_table extends Migration
{
    public function up()
    {
        $this->alterColumn('book', 'isbn', $this->string()->comment('ISBN'));
    }

    public function down()
    {
        $this->alterColumn('book', 'isbn', $this->string(13)->comment('ISBN'));
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

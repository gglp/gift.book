<?php

use yii\db\Migration;

class m170608_082921_add_columns_to_book_table extends Migration
{
    public function up()
    {
        $this->addColumn('book', 'editor', $this->string()->comment('Ответственный редактор'));
        $this->addColumn('book', 'serie', $this->string()->comment('Серия'));
    }

    public function down()
    {
        $this->dropColumn('book', 'editor');
        $this->dropColumn('book', 'serie');
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

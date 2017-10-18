<?php

use yii\db\Migration;

class m170622_084047_insert_values_into_book_table extends Migration
{
    public function up()
    {
        return true;
    }

    public function down()
    {
        echo "m170622_084047_insert_values_into_book_table cannot be reverted.\n";

        return true;
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

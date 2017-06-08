<?php

use yii\db\Migration;

/**
 * Handles adding author to table `book`.
 */
class m170605_190647_add_author_columns_to_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('book', 'authorname', $this->string()->comment('Имя'));
        $this->addColumn('book', 'authorpatronymic', $this->string()->comment('Отчество'));
        $this->addColumn('book', 'otherauthors', $this->text()->comment('Другие авторы'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('book', 'authorname');
        $this->dropColumn('book', 'authorpatronymic');
        $this->dropColumn('book', 'otherauthors');
    }
}

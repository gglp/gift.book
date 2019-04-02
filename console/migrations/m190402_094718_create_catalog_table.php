<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog`.
 */
class m190402_094718_create_catalog_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
         
        $this->createTable('catalog', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->comment('Код рубрики'),
            'name' => $this->string()->notNull()->comment('Название рубрики'),
        ], $tableOptions);
        
        $this->createIndex('idx-catalog-code', 'catalog', 'code', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalog');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `act`.
 */
class m170209_110411_create_act_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('act', [
            'id' => $this->primaryKey(),
            'number' => $this->string()->comment('Номер'),
            'date' => $this->date()->comment('Дата'),
            'grantor' => $this->string()->comment('Даритель'),
            'comment' => $this->text()->comment('Комментарий')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('act');
    }
}

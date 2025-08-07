<?php

use yii\db\Migration;

class m250807_133522_add_resposta_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'resposta', $this->text());
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250807_133522_add_resposta_to_project_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250807_133522_add_resposta_to_project_table cannot be reverted.\n";

        return false;
    }
    */
}

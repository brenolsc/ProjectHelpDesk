<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%project}}`.
 */
class m250807_125839_add_status_column_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'status', $this->string()->defaultValue('pendente'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%project}}', 'status');
    }
}

<?php

use \yii\db\Migration;

class m190124_110202_add_guest_db2_table extends Migration
{
    public function up()
    {
        $this->db = 'db2';
        parent::init();

        $this->createTable('{{guest}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'description' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{guest}}');
    }
}

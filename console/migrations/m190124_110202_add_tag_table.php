<?php

use \yii\db\Migration;

class m190124_110202_add_tag_table extends Migration
{
    public function up()
    {
        $this->db = 'db2';
        parent::init();

        $this->createTable('{{tag}}', [
            'id' => $this->primaryKey(),
            'display_name' => $this->string()->notNull()->unique(),
            'description' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ]);
        $this->createIndex('idx-tag-display_name', 'tag', 'display_name');
    }

    public function down()
    {
        $this->dropIndex('idx-tag-display_name', 'tag');
        $this->dropTable('{{tag}}');
    }
}

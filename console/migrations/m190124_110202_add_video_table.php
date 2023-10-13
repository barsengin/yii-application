<?php

use \yii\db\Migration;

class m190124_110202_add_video_table extends Migration
{
    public function up()
    {
        $this->db = 'db2';
        parent::init();

        $this->createTable('{{video}}', [
            'id' => $this->primaryKey(),
            'guest_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull()->unique(),
            'url' => $this->string()->notNull(),
            'description' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-video-guest_id', 'video', 'guest_id', 'guest', 'id', 'CASCADE' );

        $this->createIndex('idx-video-url', 'video', 'url');
    }

    public function down()
    {
        $this->dropIndex('idx-video-url', 'video');
        $this->dropForeignKey('fk-video-guest_id', 'video' );
        $this->dropTable('{{video}}');
    }
}

<?php

use \yii\db\Migration;

class m190124_110202_add_video_tag_table extends Migration
{
    public function up()
    {
        $this->db = 'db2';
        parent::init();

        $this->createTable('{{video_tag}}', [
            'tag_id' => $this->integer()->notNull(),
            'video_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk-video_tag-video_id', 'video_tag', 'video_id', 'video', 'id', 'CASCADE' );
        $this->addForeignKey('fk-video_tag-tag_id', 'video_tag', 'tag_id', 'tag', 'id', 'CASCADE' );
    }

    public function down()
    {
        $this->dropForeignKey('fk-video_tag-video_id', 'video_tag');
        $this->dropForeignKey('fk-video_tag-tag_id', 'video_tag');
        $this->dropTable('{{video_tag}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m230528_141547_add_table_image
 */
class m230528_141547_add_table_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image',[
            'id' => $this->primaryKey(11),
            'path' => $this->string(128)->Null(),
            'size' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('image');
    }

}

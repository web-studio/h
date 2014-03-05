<?php

class m140212_114636_alter_table_userTransaction_add_receiver_id extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{user_transactions}}', 'receiver_id', 'int(10)');
    }

    public function down()
    {
        $this->dropColumn('{{user_transactions}}', 'receiver_id');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
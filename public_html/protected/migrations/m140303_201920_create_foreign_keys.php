<?php

class m140303_201920_create_foreign_keys extends CDbMigration
{
	public function up()
	{
        $this->addForeignKey('user_id','{{user_deposits}}', 'user_id', '{{users}}', 'id');

	}

	public function down()
	{
		$this->dropForeignKey('user_id','{{user_deposits}}');

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
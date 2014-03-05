<?php

class m140217_182210_alter_table_user_deposits extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user_deposits}}', 'transaction_id', 'int(10)');
	}

	public function down()
	{
		$this->dropColumn('{{user_deposits}}', 'transaction_id');
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
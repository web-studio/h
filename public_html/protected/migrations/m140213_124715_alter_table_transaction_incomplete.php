<?php

class m140213_124715_alter_table_transaction_incomplete extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user_transactions_incomplete}}', 'batch_num', 'varchar(100)');
	}

	public function down()
	{
		$this->dropColumn('{{user_transactions_incomplete}}', 'batch_num');
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
<?php

class m140218_092003_alter_table_transaction_incomplete extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user_transactions_incomplete}}', 'type', 'tinyint(1)');
        $this->addColumn('{{user_transactions_incomplete}}', 'status', 'tinyint(1)');
	}

	public function down()
	{
		$this->dropColumn('{{user_transactions_incomplete}}', 'type');
        $this->dropColumn('{{user_transactions_incomplete}}', 'status');
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
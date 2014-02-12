<?php

class m140212_070122_alter_table_user_transactions extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user_transactions}}', 'ref_id', 'int');
	}

	public function down()
	{
		$this->dropColumn('{{user_transactions}}', 'ref_id');
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
<?php

class m140209_133730_alter_table_users_add_column_update_time extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{users}}', 'updatetime', 'datetime');
        $this->addColumn('{{users}}', 'status', 'int');
	}

	public function down()
	{
		$this->dropColumn('{{users}}', 'updatetime');
        $this->dropColumn('{{users}}', 'status');
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
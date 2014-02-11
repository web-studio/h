<?php

class m140211_193719_alter_table_user_deposits extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user_deposits}}', 'date_create', 'datetime');
	}

	public function down()
	{
        $this->dropColumn('{{user_deposits}}', 'date_create');
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
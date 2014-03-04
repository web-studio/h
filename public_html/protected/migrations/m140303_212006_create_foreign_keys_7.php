<?php

class m140303_212006_create_foreign_keys_7 extends CDbMigration
{
	public function up()
	{


        $this->addForeignKey('fk_user_id_transactions_inc','{{user_transactions_incomplete}}', 'user_id', '{{users}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('fk_user_id_transactions_inc','{{user_transactions_incomplete}}');
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
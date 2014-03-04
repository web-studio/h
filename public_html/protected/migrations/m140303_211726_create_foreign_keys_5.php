<?php

class m140303_211726_create_foreign_keys_5 extends CDbMigration
{
	public function up()
	{


        $this->addForeignKey('fk_user_id_ref','{{referrals}}', 'user_id', '{{users}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('fk_user_id_ref','{{referrals}}');
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
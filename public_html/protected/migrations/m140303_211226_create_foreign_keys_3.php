<?php

class m140303_211226_create_foreign_keys_3 extends CDbMigration
{
	public function up()
	{


        $this->addForeignKey('bonus_user_id','{{bonus_program}}', 'user_id', '{{users}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('bonus_user_id','{{bonus_program}}');
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
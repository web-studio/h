<?php

class m140303_205517_create_foreign_keys_2 extends CDbMigration
{
	public function up()
	{

        $this->addForeignKey('site_id','{{bonus_program}}', 'site_id', '{{bonus_sites}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('site_id','{{bonus_program}}');
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
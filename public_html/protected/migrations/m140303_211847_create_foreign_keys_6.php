<?php

class m140303_211847_create_foreign_keys_6 extends CDbMigration
{
	public function up()
	{


        $this->addForeignKey('fk_user_id_output_transactions','{{output_transactions}}', 'user_id', '{{users}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('fk_user_id_output_transactions','{{output_transactions}}');
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
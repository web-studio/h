<?php

class m140303_212108_create_foreign_keys_8 extends CDbMigration
{
	public function up()
	{

       // $this->addForeignKey('user_deposit_type_id','{{user_deposits}}', 'deposit_type_id', '{{deposit_types}}', 'id');
       $this->addForeignKey('fk_user_id_transactions','{{user_transactions}}', 'user_id', '{{users}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('fk_user_id_transactions','{{user_transactions}}');
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
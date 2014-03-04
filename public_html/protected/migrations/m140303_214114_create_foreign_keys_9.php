<?php

class m140303_214114_create_foreign_keys_9 extends CDbMigration
{
	public function up()
	{
        $this->addForeignKey('user_deposit_type_id','{{user_deposits}}', 'deposit_type_id', '{{deposit_types}}', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('user_deposit_type_id','{{user_deposits}}');
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
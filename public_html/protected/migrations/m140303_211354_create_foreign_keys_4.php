<?php

class m140303_211354_create_foreign_keys_4 extends CDbMigration
{
	public function up()
	{

        $this->addForeignKey('fk_ref_id_ref','{{referrals}}', 'ref_id', '{{users}}', 'id');
	}

	public function down()
	{

        $this->dropForeignKey('fk_ref_id_ref','{{referrals}}');
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
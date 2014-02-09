<?php

class m140209_101757_create extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{user_roles}}', [
            'id'=>'pk',
            'name'=>'string',
            'title'=>'string'
        ]);

        $this->insert('{{user_roles}}', array(
            'name' => 'admin',
            'title' => 'Администратор'
        ));

        $this->insert('{{user_roles}}', array(
            'name' => 'user',
            'title' => 'Пользователь'
        ));

        $this->createTable('{{users}}', [
            'id'=>'pk',
            'role_id'=>'int',
            'login'=>'string',
            'email'=>'string',
            'password'=>'string',
            'mobile'=>'string',
            'first_name'=>'string',
            'last_name'=>'string',
            'city'=>'string',
            'country' => 'string',
            'street' => 'string',
            'activekey'=>'string',
            'createtime'=>'datetime',
            'last_visit'=>'datetime',
            'internal_purse'=>'string',
            'perfect_purse'=>'string',
            'secret'=>'string',
        ]);

        $this->createTable('{{referrals}}', [
            'id' => 'pk',
            'user_id' => 'int',
            'ref_id' => 'int',
        ]);

        $this->createTable('{{deposit_types}}', [
            'id' => 'pk',
            'name' => 'string',
            'description' => 'string',
            'days' => 'int',
            'percent' => 'int',
            'min_amount' => 'int',
            'max_amount' => 'int',
            'status' => 'int',
            'total_return' => 'string'
        ]);

        $this->createTable('{{user_deposits}}', [
            'id' => 'pk',
            'user_id' => 'int',
            'deposit_type_id' => 'string',
            'deposit_amount' => 'decimal',
            'expire' => 'datetime',
            'reinvest' => 'int',
            'status' => 'int',
        ]);

        $this->createTable('{{user_transactions}}', [
            'id' => 'pk',
            'user_id' => 'int',
            'amount' => 'decimal',
            'amount_type' => 'int',
            'payment_id' => 'string',
            'reason' => 'string',
            'time' => 'datetime',
            'amount_after' => 'decimal',
            'amount_before' => 'decimal',
        ]);

        $this->createTable('{{user_transactions_incomplete}}', [
            'id' => 'pk',
            'user_id' => 'int',
            'payment_id' => 'string',
            'amount' => 'decimal',
            'payer' => 'string',
            'hash' => 'string',
            'reason' => 'string',
            'time' => 'datetime',
        ]);

        $this->createTable('{{output_transactions}}', [
            'id' => 'pk',
            'user_id' => 'int',
            'payee_account_name' => 'string',
            'payee_account' => 'string',
            'payment_amount' => 'decimal',
            'payment_batch_num' => 'string',
            'payment_id' => 'string',
            'created_time' => 'datetime',
            'status' => 'int',
            'error' => 'string',
        ]);

        $this->createTable('{{messages}}', [
            'id' => 'pk',
            'from_msg' => 'int',
            'to_msg' => 'int',
            'subject' => 'string',
            'message' => 'text',
            'file' => 'string',
            'send_time' => 'datetime',
            'reading_time' => 'datetime',
            'status' => 'int',
            'trash' => 'int',
        ]);

        $this->createTable('{{news}}', [
            'id' => 'pk',
            'title' => 'string',
            'description' => 'string',
            'text' => 'text',
            'image' => 'string',
            'status' => 'integer',
            'created_time' => 'datetime',
            'update_time' => 'datetime',
        ]);

	}

	public function down()
	{
        $this->dropTable('{{user_roles}}');

        $this->dropTable('{{users}}');

        $this->dropTable('{{referrals}}');

        $this->dropTable('{{deposit_types}}');

        $this->dropTable('{{user_deposits}}');

        $this->dropTable('{{user_transactions}}');

        $this->dropTable('{{user_transactions_incomplete}}');

        $this->dropTable('{{output_transactions}}');

        $this->dropTable('{{messages}}');

        $this->dropTable('{{news}}');

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
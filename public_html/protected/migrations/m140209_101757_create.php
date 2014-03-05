<?php

class m140209_101757_create extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{user_roles}}', [
            'id'=>'pk NOT NULL',
            'name'=>'varchar(20)',
            'title'=>'varchar(50)'
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
            'role_id'=>'tinyint(1)',
            'login'=>'varchar(24)',
            'email'=>'varchar(50)',
            'password'=>'varchar(24)',
            'mobile'=>'varchar(11)',
            'first_name'=>'varchar(24)',
            'last_name'=>'varchar(24)',
            'city'=>'varchar(24)',
            'country' => 'varchar(24)',
            'street' => 'varchar(50)',
            'activekey'=>'varchar(50)',
            'createtime'=>'datetime',
            'last_visit'=>'datetime',
            'internal_purse'=>'varchar(12)',
            'perfect_purse'=>'varchar(10)',
            'secret'=>'varchar(50)',
        ]);

        $this->createTable('{{referrals}}', [
            'id' => 'pk',
            'user_id' => 'int(10)',
            'ref_id' => 'int(10)',
        ]);

        $this->createTable('{{deposit_types}}', [
            'id' => 'pk',
            'name' => 'varchar(50)',
            'description' => 'varchar(255)',
            'days' => 'int(3)',
            'percent' => 'decimal(10,2)',
            'min_amount' => 'decimal(10,2)',
            'max_amount' => 'decimal(10,2)',
            'status' => 'tinyint(1)',
            'total_return' => 'varchar(50)'
        ]);

        $this->insert('{{deposit_types}}', array(
            'name' => 'Test',
            'days' => '45',
            'percent' => '1.3',
            'min_amount' => '10.00',
            'max_amount' => '300.00',
            'status' => '1',
        ));

        $this->insert('{{deposit_types}}', array(
            'name' => 'Basic',
            'days' => '60',
            'percent' => '1.4',
            'min_amount' => '300.01',
            'max_amount' => '1500.00',
            'status' => '1',
        ));

        $this->insert('{{deposit_types}}', array(
            'name' => 'Business',
            'days' => '75',
            'percent' => '1.5',
            'min_amount' => '1500.01',
            'max_amount' => '3000.00',
            'status' => '1',
        ));

        $this->insert('{{deposit_types}}', array(
            'name' => 'Professional',
            'days' => '90',
            'percent' => '1.7',
            'min_amount' => '3000.01',
            'max_amount' => '30000.00',
            'status' => '1',
        ));


        $this->createTable('{{user_deposits}}', [
            'id' => 'pk',
            'user_id' => 'int(10)',
            'deposit_type_id' => 'int(4)',
            'deposit_amount' => 'decimal(10,2)',
            'expire' => 'datetime',
            'reinvest' => 'tinyint(1)',
            'status' => 'tinyint(1)',
        ]);

        $this->createTable('{{user_transactions}}', [
            'id' => 'pk',
            'user_id' => 'int(10)',
            'amount' => 'decimal(10,2)',
            'amount_type' => 'tinyint(1)',
            'payment_id' => 'varchar(50)',
            'reason' => 'varchar(255)',
            'time' => 'datetime',
            'amount_after' => 'decimal(10,2)',
            'amount_before' => 'decimal(10,2)',
        ]);

        $this->createTable('{{user_transactions_incomplete}}', [
            'id' => 'pk',
            'user_id' => 'int(10)',
            'payment_id' => 'varchar(100)',
            'amount' => 'decimal(10,2)',
            'payer' => 'varchar(100)',
            'hash' => 'varchar(100)',
            'reason' => 'varchar(100)',
            'time' => 'datetime',
        ]);

        $this->createTable('{{output_transactions}}', [
            'id' => 'pk',
            'user_id' => 'int(10)',
            'payee_account_name' => 'varchar(100)',
            'payee_account' => 'varchar(100)',
            'payment_amount' => 'decimal(10,2)',
            'payment_batch_num' => 'varchar(100)',
            'payment_id' => 'varchar(100)',
            'created_time' => 'datetime',
            'status' => 'tinyint(1)',
            'error' => 'varchar(100)',
        ]);

        $this->createTable('{{messages}}', [
            'id' => 'pk',
            'from_msg' => 'int(10)',
            'to_msg' => 'int(10)',
            'subject' => 'varchar(127)',
            'message' => 'text',
            'file' => 'varchar(127)',
            'send_time' => 'datetime',
            'reading_time' => 'datetime',
            'status' => 'tinyint(1)',
            'trash' => 'tinyint(1)',
        ]);

        $this->createTable('{{news}}', [
            'id' => 'pk',
            'title' => 'varchar(127)',
            'description' => 'varchar(255)',
            'text' => 'text',
            'image' => 'varchar(127)',
            'status' => 'tinyint(1)',
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
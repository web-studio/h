<?php

class m140218_111620_create_tables_bonus extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{bonus_sites}}', [
            'id'=>'pk',
            'url' => 'varchar(50)',
            'title' => 'varchar(100)',
            'status' => 'tinyint(1)'
        ]);

        $this->insert('{{bonus_sites}}', [
            'url' => 'www.talkgold.com',
            'title' => 'talkgold',
            'status' => 1,
        ]);
        $this->insert('{{bonus_sites}}', [
            'url' => 'www.dreamteammoney.com',
            'title' => 'dreamteammoney',
            'status' => 1,
        ]);
        $this->insert('{{bonus_sites}}', [
            'url' => 'www.rolclub.com',
            'title' => 'rolclub',
            'status' => 1,
        ]);
        $this->insert('{{bonus_sites}}', [
            'url' => 'www.moneymakergroup.com',
            'title' => 'moneymakergroup',
            'status' => 1,
        ]);
        $this->insert('{{bonus_sites}}', [
            'url' => 'www.mmgp.ru',
            'title' => 'mmgp',
            'status' => 1,
        ]);
        $this->insert('{{bonus_sites}}', [
            'url' => 'www.rusmmg.ru',
            'title' => 'rusmmg',
            'status' => 1,
        ]);
        $this->insert('{{bonus_sites}}', [
            'url' => 'www.profit-maker.org',
            'title' => 'profit-maker',
            'status' => 1,
        ]);

        $this->createTable('{{bonus_program}}', [
            'id' => 'pk',
            'user_id' => 'int(10)',
            'site_id' => 'int(10)',
            'link' => 'varchar(255)',
            'date_create' => 'datetime',
            'date_update' => 'datetime',
            'status' => 'tinyint(1)'
        ]);

	}

	public function down()
	{
		$this->dropTable('{{bonus_sites}}');
        $this->dropTable('{{bonus_program}}');
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
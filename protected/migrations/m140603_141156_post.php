<?php

class m140603_141156_post extends CDbMigration
{
	public function up()
	{
		$this->createTable('post', array(
           'id'=>'pk',
           'idKategori'=>'int',
           'namaFile'=>'VARCHAR(300) not null',
        ));
	}

	public function down()
	{
		$this->dropTable('post');
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
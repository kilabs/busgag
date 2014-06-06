<?php

class m140606_141007_add_diskripsi extends CDbMigration
{
	public function up()
	{
		$this->addColumn('post','deskripsi','text');
	}

	public function down()
	{
		$this->dropColumn('post','deskripsi');
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
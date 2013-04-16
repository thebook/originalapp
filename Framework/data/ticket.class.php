<?php

/**
* ticket root class
*/
class ticket extends alpha
{
	var $freepost_table;
	var $cheque_table;

	function __construct()
	{
		$this->construct_freepost_table();
		$this->construct_cheque_table();
	}

	public function construct_freepost_table ()
	{
		$this->freepost_table = 'freepost';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->freepost_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name'    => 'user',
					'data_type'      => 'INT'
				),
				array(
					'column_name'    => 'email',
					'data_type'      => 'varchar(30)'
				),
				array(
					'column_name'    => 'first_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name'    => 'second_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name' => 'address',
					'data_type'   => 'varchar(200)',
				),
				array(
					'column_name' => 'post_code',
					'data_type'   => 'varchar(7)',
				),
				array(
					'column_name' => 'town',
					'data_type'   => 'varchar(30)',
				),
				array(
					'column_name' => 'area',
					'data_type'   => 'varchar(50)',
				),
				array(
					'column_name' => 'date',
					'data_type'   => 'date'
				)
			)
		));
	}

	public function construct_cheque_table ()
	{	
		$this->cheque_table = 'cheque';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->cheque_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name'    => 'user',
					'data_type'      => 'INT'
				),
				array(
					'column_name'    => 'email',
					'data_type'      => 'varchar(30)'
				),
				array(
					'column_name'    => 'first_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name'    => 'second_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name' => 'address',
					'data_type'   => 'varchar(200)',
				),
				array(
					'column_name' => 'post_code',
					'data_type'   => 'varchar(7)',
				),
				array(
					'column_name' => 'town',
					'data_type'   => 'varchar(30)',
				),
				array(
					'column_name' => 'area',
					'data_type'   => 'varchar(50)',
				),
				array(
					'column_name' => 'date',
					'data_type'   => 'date'
				),
				array(
					'column_name' => 'amount',
					'data_type'   => 'int'
				)
			)
		));			
	}
}	
?>
<?php

/**
* the cration of a users clas 
*/
class users extends alpha
{
	$table_name;

	function __construct()
	{	
		$this->table_name = 'accounts';		
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $table_name,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name' => 'e_mail',					
					'unique'      => true,				
					'data_type'   => 'varchar(30)' 
				),
				array(
					'column_name' => 'first_name',
					'unique'      => false,
					'data_type'   => 'varchar(22)' 
				),
				array(
					'column_name'=> 'second_name',
					'unique'     => false,
					'data_type'  => 'varchar(22)' 
				),
				array(
					'column_name' => 'password',					
					'unique'      => false,					
					'data_type'   => 'varchar(30)' 
				),
				array(
					'column_name' => 'credit',					
					'unique'      => false,					
					'data_type'   => 'int'
				),
				array(
					'column_name' => 'address',					
					'unique'      => false,					
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'recieve_newsletter',
					'unique'      => false,
					'data_type'   => 'tinyint'
				),
				array(
					'column_name' => 'university',
					'unique'      => false,					
					'data_type'   => 'varchar(55)' 
				),
				array(
					'column_name' => 'history',
					'unique'      => false,					
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'price_promise',
					'unique'      => false,					
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'unaccepted_book',
					'unique'      => false,					
					'data_type'   => 'blob',
					'null'        => true
				),
			)
		));
	}	
}
	
?>
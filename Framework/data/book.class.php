<?php

/**
*  root book class 
*/
class book extends alpha
{
	
	function __construct()
	{	
		$layout = array();
		
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->account_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name' => 'email',
					'unique'      => true,				
					'data_type'   => 'varchar(30)' 
				),
				array(
 					'column_name' => 'first_name',
					'data_type'   => 'varchar(22)' 
				),
				array(
					'column_name'=> 'second_name',
					'data_type'  => 'varchar(22)' 
				),
				array(
					'column_name' => 'password',									
					'data_type'   => 'varchar(30)' 
				),
				array(
					'column_name' => 'credit',
					'data_type'   => 'int'
				),
				array(
					'column_name' => 'recieve_newsletter',
					'data_type'   => 'tinyint'
				),
				array(
					'column_name' => 'university',			
					'data_type'   => 'varchar(55)' 
				),
				array(
					'column_name' => 'history',		
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'price_promise',	
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'unaccepted_book',
					'data_type'   => 'blob',
					'null'        => true
				),
			)
		));
	}
}
	
?>
<?php

/**
* the cration of a users clas 
*/
class account extends alpha
{
	var $account_table;
	var $address_table;

	function __construct()
	{	
		parent::__construct('account');
		$this->account_table = 'account';
		$this->address_table = 'address';

		$table = new table_creator;
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
					'data_type'   => 'varchar(11)'
				),
				array(
					'column_name' => 'recieve_newsletter',
					'data_type'   => 'varchar(1)'
				),
				array(
					'column_name' => 'university',			
					'data_type'   => 'varchar(55)',
					'null'        => true
				),
				array(
					'column_name' => 'year',
					'data_type'   => 'varchar(4)',
					'null'        => true
				),
				array(
					'column_name' => 'subject',
					'data_type'   => 'varchar(30)',
					'null'        => true
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
		
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->address_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name' => 'user',
					'data_type'   => 'varchar(30)',
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
				)
			)
		));
	}

	public function get_account ($account_email)
	{
		$table = new table_creator;
		return $table->get_row($this->account_table, 'email', $account_email);
	}

	public function get_address ($account_email)
	{
		$table = new table_creator;
		return $table->get_rows($this->address_table, 'user', $account_email);
	}

	public function get_account_value ($account_id, $value_to_get )
	{
		$account = $this->get_account($account_id);
		return $account[$value_to_get];
	}

	public function get_is_email_in_use ($email)
	{
		$table = new table_creator;
		return $table->check_if_value_is_in_column($this->account_table, "email", $email);
	}

	public function set_new_account ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->account_table, $array_of_information );
	}

	public function set_new_address ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->address_table, $array_of_information);
	}
}
	
?>
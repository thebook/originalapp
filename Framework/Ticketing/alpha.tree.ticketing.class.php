<?php

/**
* A ticketing class alpha
*/
abstract class alpha_tree_ticket
{
	var $table_name;
	var $paramaters;

	function __construct($ticket_definiton_path) 
	{
		$this->paramaters['manifestation'] = ( include $ticket_definiton_path );
		
		multi($this->paramaters['manifestation']);
		
		$this->create_ticketing_table($this->paramaters['manifestation']['table_creation']);
	}

	protected function create_ticketing_table ($table_paramaters)
	{
		extract($table_paramaters);

		$this->table_name = $table_name;

		$table = new table_creator;

		$columns[] = 
			array(
				'column_name'    => 'ticket_id',
				'data_type'      => 'INT',
				'auto_increment' => true,
				'unique'         => false );

		$table->check_if_table_exists_if_not_create_one(
			array(
				'table_name'  => $table_name,
				'primary_key' => 'ticket_id',
				'fields' => $columns ));
	}

	/**
	 * Gets all of the tickets in the table and their information, does not require parmaters as the 
	 * table name should have been set in the construct 
	 * @return array An array of all rows and their values and column names
	 */
	public function get_all_tickets ()
	{
		$table = new table_creator; 

		return $table->get_all_rows_from_table($this->table_name);
	}

	/**
	 * Creates a ticket in the database table, 
	 * @param  array $ticket_to_create the array holds the key value as the column name and the value as the column value
	 * @return                    Adds a row to the table 
	 */
	public function create_ticket ($ticket_to_create)
	{
		$table = new table_creator;

		$ticket_to_create = $this->_prepare_ticket_for_submission($ticket_to_create);
		
		$table->add_row_to_table($this->table_name, $ticket_to_create );
	}

	public function alter_ticket ($ticket_id, $ticket_values_to_alter_with)
	{
		$table = new table_creator;

		$ticket_values_to_alter_with = $this->_prepare_ticket_for_submission($ticket_values_to_alter_with);

		$table->update_row($this->table_name, $ticket_values_to_alter_with, 'ticket_id', $ticket_id);
	}

	public function get_ticket ($ticket_id)
	{
		$table = new table_creator;

		return $table->get_row($this->table_name, 'ticket_id', $ticket_id);
	}

	public function remove_ticket ($ticket_id)
	{
		$table = new table_creator;

		$table->delete_row($this->table_name, 'ticket_id', $ticket_id );
	}

	protected function _prepare_ticket_for_submission ($ticket_to_create)
	{
		foreach ($ticket_to_create as $column_name => $value) :

			if ( is_array($value) ) : 

				$ticket_to_create[$column_name] = serialize($value);

			endif;

		endforeach;

		return $ticket_to_create;
	}

	public function get_being ()
	{}

	abstract public function page();
}

?>
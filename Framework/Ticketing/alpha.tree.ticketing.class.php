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
						
		add_action('admin_menu', array($this, 'create_ticketing_page') );

		add_action('wp_ajax_ticket_admin_creation',   array($this, 'ticket_creation_element' ));
		add_action('wp_ajax_nopriv_complete_ticket',  array($this, 'create_new_book_ticket' ));
		add_action('wp_ajax_nopriv_send_email',       array($this, 'email' ) );
		add_action('wp_ajax_show_users_for_ticket',   array($this, 'users_for_ticket' )  );
		add_action('wp_ajax_get_tickets',             array($this, 'display_tickets' )  );
		add_action('wp_ajax_update_ticket',           array($this, 'update_ticket_after_verify' ) );
		add_action('wp_ajax_change_ticket',           array($this, 'change_ticket' ) );
		add_action('wp_ajax_update_date',             array($this, 'change_expiry_date' ) );
		add_action('wp_ajax_delete_tickets',          array($this, 'delete_all_tickets' ) );

		$this->create_ticketing_table($this->paramaters['manifestation']['table_creation']);
	}

	public function create_ticketing_page ()
	{
		multi($this->paramaters['manifestation']);
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

	public function get_all_tickets ()
	{
		$table = new table_creator; 

		return $table->get_all_rows_from_table($this->table_name);
	}

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

	public function delete_all_tickets ()
	{
		$table = new table_creator; 

		$table->delete_all_table_rows($this->table_name);
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

	public function get_being () {}

	abstract public function page();
}

?>
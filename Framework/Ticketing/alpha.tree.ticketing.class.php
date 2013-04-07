<?php

/**
* A ticketing class alpha
*/
abstract class alpha_tree_ticket extends alpha
{
	var $table_name;
	var $being; 
	var $paramaters;

	function __construct($ticket_definiton_path) 
	{
		parent::__construct();

		$this->paramaters['manifestation'] = ( include $ticket_definiton_path );
		$this->create_ticketing_table($this->paramaters['manifestation']['table_creation']);


		add_action('admin_menu', array($this, 'create_ticketing_page') );
		
		add_action('wp_ajax_ticket_admin_creation',   array($this, 'ticket_creation_element' ));

		add_action('wp_ajax_complete_ticket',         array($this, 'create_new_book_ticket' ));
		add_action('wp_ajax_nopriv_complete_ticket',  array($this, 'create_new_book_ticket' ));

		add_action('wp_ajax_nopriv_send_email',       array($this, 'email' ) );

		add_action('wp_ajax_get_tickets',             array($this, 'display_tickets' )  );

		add_action('wp_ajax_update_ticket',           array($this, 'update_ticket_after_verify' ) );
		add_action('wp_ajax_change_ticket',           array($this, 'change_ticket' ) );
		add_action('wp_ajax_update_date',             array($this, 'change_expiry_date' ) );
		add_action('wp_ajax_delete_tickets',          array($this, 'delete_all_tickets' ) );

		add_action('wp_ajax_tickets_get_property',        array($this, 'get_class_property' ) );
		add_action('wp_ajax_nopriv_tickets_get_property', array($this, 'get_class_property' ) );
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

		$columns[] = array(
			'column_name'    => 'ticket_id',
			'data_type'      => 'INT',
			'auto_increment' => true,
			'unique'         => false );

		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $table_name,
			'primary_key' => 'ticket_id',
			'fields' => $columns ));
	}

	public function get_all_tickets ()
	{
		$table   = new table_creator; 
		$tickets = $table->get_all_rows_from_table($this->table_name);

		return $this->_unseal_tickets($tickets);
	}

	public function create_ticket ($ticket_to_create)
	{
		$table = new table_creator;
		$ticket_to_create = $this->_seal_ticket($ticket_to_create);
		$table->add_row_to_table($this->table_name, $ticket_to_create );
	}

	public function alter_ticket ($ticket_id, $ticket_values_to_alter_with)
	{
		$table = new table_creator;
		$ticket_values_to_alter_with = $this->_seal_ticket($ticket_values_to_alter_with);
		$table->update_row($this->table_name, $ticket_values_to_alter_with, 'ticket_id', $ticket_id);
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

	public function get_ticket ($ticket_id)
	{
		$table  = new table_creator;
		$ticket = $table->get_row($this->table_name, 'ticket_id', $ticket_id);
		return $this->_unseal_ticket($ticket);
	}

	public function set_ticket ($ticket_id, $set_value)
	{
		$table     = new table_creator;
		$set_value = $this->_seal_ticket($set_value);
		$table->update_row($this->table_name, $set_value, 'ticket_id', $ticket_id);
	}

	public function get_ticket_property ($ticket_id, $property_to_get)
	{
		$ticket = $this->get_ticket($ticket_id);
		$ticket = $this->_unseal_ticket($ticket);
		return $ticket[$property_to_get];
	}

	public function set_ticket_property ($ticket_id, $property, $property_value)
	{
		$table = new table_creator;
		$table->update_row($this->table_name, array( $property => $property_value ), 'ticket_id', $ticket_id );
	}

	public function get_tickets_based_on_property ($property, $property_value)
	{
		$table   = new table_creator;
		$tickets = $table->get_rows($this->table_name, $property, $property_value);
		return $this->_unseal_tickets($tickets);
	}

	public function set_tickets_based_on_property ($property, $property_value, $set_value)
	{
		$tickets = $this->get_tickets_based_on_property($property, $property_value);

		foreach ($tickets as $ticket) :
			$this->set_ticket($ticket['ticket_id'], $set_value);
		endforeach;
	}

	// public function set_being () {
	// 	$tickets = $this->get_all_tickets();
	// 	$tickets = $this->_unseal_tickets($tickets);
	// 	$this->being = $tickets;
	// }

	protected function _seal_ticket ($ticket)
	{
		$table  = new table_creator; 		
		$ticket = $table->serialize_arrays_in_an_array($ticket);

		return $ticket;
	}

	protected function _unseal_ticket ($ticket)
	{
		$table = new table_creator;	
		return $table->unserialize_strings_in_an_array($ticket);
	}

	protected function _seal_tickets ($tickets)
	{
		foreach ($tickets as $ticket_number => $ticket) :
	
			$tickets[$ticket_number] = $this->_seal_ticket($ticket);
	
		endforeach;

		return $tickets;
	}	

	protected function _unseal_tickets ($tickets)
	{
		foreach ($tickets as $ticket_number => $ticket) :				
	
			$tickets[$ticket_number] = $this->_unseal_ticket($ticket);
	
		endforeach;

		return $tickets;
	}

	public function get_class_property ()
	{	
		$property = $_GET['property_to_get'];
		$report   = array(
			'error' => true
		);

		if (property_exists($this, $property)) :
			if ( !is_object($this->$property) ) :
				$report['error']  = false;
				$report['text']   = "Property : \"$property\" exists and is a ". gettype($this->$property);
				$report['return'] = $this->$property;
			else :
				$report['text'] = "Property : \"$property\", exsists but is an object"; 
			endif;
		else : 
			$report['text'] = "Property : \"$property\", does not exsist inside the class"; 
		endif;

		echo json_encode($report);

		exit;
	}

	abstract public function page ();
}

?>
<?php

/**
* A ticketing class alpha
*/
abstract class alpha_tree_ticket
{
	var $table_name;
	var $being; 
	var $paramaters;

	function __construct($ticket_definiton_path) 
	{
		$this->paramaters['manifestation'] = ( include $ticket_definiton_path );
		$this->create_ticketing_table($this->paramaters['manifestation']['table_creation']);
		$this->update_being();

		add_action('admin_menu', array($this, 'create_ticketing_page') );
		
		add_action('wp_ajax_ticket_admin_creation',   array($this, 'ticket_creation_element' ));

		add_action('wp_ajax_complete_ticket',        array($this, 'create_new_book_ticket' ));
		add_action('wp_ajax_nopriv_complete_ticket', array($this, 'create_new_book_ticket' ));

		add_action('wp_ajax_nopriv_send_email',       array($this, 'email' ) );

		add_action('wp_ajax_get_tickets',             array($this, 'display_tickets' )  );

		add_action('wp_ajax_update_ticket',           array($this, 'update_ticket_after_verify' ) );
		add_action('wp_ajax_change_ticket',           array($this, 'change_ticket' ) );
		add_action('wp_ajax_update_date',             array($this, 'change_expiry_date' ) );
		add_action('wp_ajax_delete_tickets',          array($this, 'delete_all_tickets' ) );

		add_action('wp_ajax_tickets_get_property',        array($this, 'get_class_property' ) );
		add_action('wp_ajax_nopriv_tickets_get_property', array($this, 'get_class_property' ) );

		add_action('wp_ajax_nopriv_get_from_tickets_class', array($this, 'get_' ) );
		add_action('wp_ajax_get_from_tickets_class',        array($this, 'get_' ) );

		// add_action('wp_ajax_show_users_for_ticket',   array($this, 'users_for_ticket' )  );
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

	public function get_ticket ($ticket_id)
	{
		$table = new table_creator;
		# unseal ticket
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

	public function get_ticket_property ($ticket_id, $property_to_get)
	{
		$ticket = $this->get_ticket($ticket_id);
		return $ticket[$property_to_get];
	}

	public function update_being () {

		$tickets = $this->get_all_tickets();

		return $this->being = $tickets;
	}

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

	protected function _unseal_tickets ($tickets)
	{
		foreach ($tickets as $ticket_number => $ticket) :				
	
			$tickets[$ticket_number] = $this->_unseal_ticket($ticket);
	
		endforeach;

		return $tickets;
	}

	public function update_and_return_being ()
	{	
		echo json_encode($this->update_being());
		exit;
	}

	public function set_up_json_return_object ()
	{
		return array(
			'error' => true, 
			'text'  => false,
			'return'=> false
		);
	}

	public function get_ ()
	{	
		$report = $this->set_up_json_return_object();

		if (isset($_GET['method'])) : 

			$method     = "get_{$_GET['method']}";
			$paramaters = (isset($_GET['paramaters'])? $_GET['paramaters'] : false );

			try {
				
				$reflection = new ReflectionMethod($this, $method);

				if ($reflection->isPublic()) :
					
					if ($paramaters) :
						$array_of_paramaters = array();

						foreach ($paramaters as $paramater) :
							$array_of_paramaters[] = $paramater;
						endforeach;

						$report['return'] = call_user_func_array(array($this, $method), $array_of_paramaters);
					else :
						$report['return'] = call_user_func(array($this, $method));
					endif;

					$report['error'] = false;
					$report['text']  = "Method : \"$method\" has been sucessfuly called";

				else : 
					$report['text'] = "Method : \"$method\" is not public in this class, as such will not be called";
				endif;

			} catch (Exception $exception) { 
				$report['text'] = $exception->getMessage();
			}
		else : 
			$report['text'] = "Method name was not given as such it was not called";
		endif;

		echo json_encode($report);

		exit;
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
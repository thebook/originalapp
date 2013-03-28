<?php 
 
 /**
 * A class for displaying tickets 
 */
 abstract class branch_ticket_format extends branch_ticket_splitter
 {
 	
 	public function get_and_sort_tickets ()
	{
		$get_tickets    = $this->get_all_tickets();
		$tickets        = array();
		$tickets['all'] = $this->_display_all_tickets($get_tickets);

		foreach ($this->paramaters['manifestation']['ticket_types'] as $type) {

			$tickets[$type] = $this->_return_specific_tickets('status', $type, $get_tickets);
		}

		return $tickets;
	}

	public function sort_ticket_states ()
	{
		$get_tickets = $this->get_all_tickets();
		
		foreach ($get_tickets as $ticket) :
			
		 	if ( $this->_calculate_expirey_date($ticket['date_expected']) < 1 and $ticket['status'] !== 'expired' ) :

		 		$history = $this->_add_to_ticket_history($ticket['ticket_id']);
		 		$this->alter_ticket($ticket['ticket_id'], array('status' => 'expired', 'history' => $history ));
		 		
		 		# corespondance
		 	
		 	endif;
		endforeach;
	}

	public function users_for_ticket ()
	{
		global $user;
		echo json_encode($user->get_users());
		exit;
	}

	public function change_expiry_date ()
	{	
		$ticket       = $_POST['information'];
		$time         = new helper_time;
		$ticket_state = $this->get_ticket($ticket['id']);
		$current_date_in_days = $time->calculate_total_number_of_days(date('d/m/Y'), '/');
		$new_expectation_date = $current_date_in_days + $ticket['days_to_add'];
		$ticket_creation_date_in_days = $time->calculate_total_number_of_days($ticket_state['date_created'], '-');

		$this->alter_ticket($ticket['id'], array(
			'date_expected' => $new_expectation_date, 
		));

		echo json_encode( $this->_response(array(
			'Ticket date changed',
			'Ticket expectation date has been changed from _o"'. ( round($ticket_state['date_expected'] - $current_date_in_days) ) .'"o_ to _o"'. ( $new_expectation_date - $current_date_in_days ) .'"o_'
		)));

		exit;
	}

	public function create_new_book_ticket ()
	{
		$ticket     = $_POST['ticket'];
		$new_ticket = array(
			'status' 	    => $ticket['status'],
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'by_user'       => $ticket['by_user'],
			'quoted_price'  => $ticket['quote'],
			'books_ordered' => $ticket['books'],
			'history'       => array()
		);

		$this->create_ticket($new_ticket);

		echo json_encode($new_ticket);

		exit;
	}

	public function change_ticket ()
	{
		$ticket = $_POST['information'];
		$id = $ticket['ticket'];
		unset($ticket['ticket']);
		$this->alter_ticket($id, $ticket);
		exit;
	}
 }
?>
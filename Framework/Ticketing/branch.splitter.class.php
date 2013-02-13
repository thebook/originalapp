<?php 

/**
* Ticket splitter branch class
*/
abstract class branch_ticket_splitter extends branch_ticket
{
	public function update_ticket ()
	{
		$method = "_{$_POST['information']['action']}";

		$response = $this->$method($_POST['information']['message']);

		echo json_encode($response);

		exit;
	}

	protected function _all_books_are_here_as_promised ($message)
	{	
		$message = $this->_initialise_message($message, 'books');
		
		$this->alter_ticket($message['ticket_id'], array(
			'status'  => 'complete',
			'history' => $message['history']
		));

		// Print check here 
		// Add new books to stock
		// Send email here after print is sucessfull
		
		$response = new response(array(
			'Ticket Completed',
			"Ticket _o {$message['ticket_id']} o_ has been moved to the _o Complete o_ group and a check of _o £{$message['new_quote']}! o_ should be printed. Books that have arrived are : ",
			array($message['books'], 'title')
		));

		return $response->return;
	}

	protected function _some_books_are_bad ($message)
	{
		$message = $this->_initialise_message($message, 'bad_books');

		$this->alter_ticket($message['ticket_id'], array(
			'status'  		=> 'complete',
			'books_ordered' => $message['books'],
			'quoted_price'  => $message['new_quote'],
			'history' 		=> $message['history']
		));

		$this->create_ticket(array(
			'status' 		=> 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'by_user'		=> $message['current_ticket']['by_user'],
			'books_ordered'	=> $message['bad_books'],
			'quoted_price'  => $message['deducted_money'],
			'history' 		=> $message['history']
		));

		// Add books to stock
		// Print check here 
		
		$response = new response(array(
			'Some Books are in a bad condition',
			"Ticket _o {$message['ticket_id']} o_ has been split into two different tickets and the quote has been changed from _o £{$message['old_quote']}! o_ to _o £{$message['new_quote']}! o_:",
			"The Following books have been split into the _o Complete o_ ticket, and a check of _@ £{$message['new_quote']}! @_ has been printed : ",
			array($message['books'], 'title'),
			"The Following books have been split into the _o Awaiting Return o_ticket, as they are in unaceptable condition. A sum of _@ £{$message['deducted_money']}! @_ has been deducted from the original price : ",
			array($message['bad_books'], 'title')
		));

		return $response->return;
	}

	protected function _all_bad_books ($message)
	{
		$message = $this->_initialise_message($message, 'bad_books');

		$this->alter_ticket($message['ticket_id'], array(
			'status'        => 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'books_ordered' => $message['bad_books'],
			'history'       => $message['history']
		));

		# Send email to user
		
		$response = new response(array(
			'Ticket Moved To Awaiting Response',
		 	"Ticket _o {$message['ticket_id']} o_ has moved to the _o Awaiting Response o_ group because all of the books in it are in a bad shape.",
		 	"An e-mail will be sent to the user asking them if they wish to donate the books, if not the books shall be moved to _o Awaiting Return o_ : ",
		 	array( $message['bad_books'], 'title' ),
		 	"Should the user not respond in the expiration period time, the books shall be considered automaticly donated, and put into _o Complete o_ group."
		));
		
		return $response->return;
	}

	protected function _all_bad_books_with_some_missing ($message)
	{		
		$message = $this->_initialise_message($message, 'bad_books');

		$this->alter_ticket($message['ticket_id'], array(
			'status'        => 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'quoted_price'  => $message['quote'],
			'books_ordered' => $message['bad_books'],
			'history'       => $message['history']
		));

		# Send email to user

		$response = new response (array(
			'Books are all in bad Condition',
			"Ticket _o {$message['ticket_id']} o_ has moved to the _o Awaiting Response o_ group because all of the books in it are in a bad shape as well as some promised book/s are missing.",
			'An e-mail will be sent to the user asking them if they wish to donate the books, if not the books shall be moved to Awaiting Return :',
			array($message['bad_books'], 'title'),
			'The Promised book(s) that never arrived are : ',
			array($message['promised_books'][0], 'title'),
			'Should the user not respond in the expiration period time, the books shall be considered automaticly donated, and put into _o Complete o_ group.'
		));

		return $response->return;
	}

	protected function _some_books_are_in_bad_condition_and_some_missing ($message)
	{
		$message = $this->_initialise_message($message, 'books');
		
		$this->alter_ticket($message['ticket_id'], array(
			'status'  		=> 'complete',
			'books_ordered' => $message['books'],
			'quoted_price'  => $message['new_quote'],
			'history' 		=> $message['history']
		));

		$this->create_ticket(array(
			'status' 		=> 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'by_user'		=> $message['current_ticket']['by_user'],
			'books_ordered'	=> $message['bad_books'],
			'quoted_price'  => $message['deducted_money'],
			'history' 		=> $message['history']
		));

		$response = new response (array(
			'Some books are in bad condition and some missing',			
			"Ticket {$message['ticket_id']} has been split into two different tickets and the quote has been changed from _o £{$message['old_quote']}! o_ to _o £{$message['new_quote']}! o_ : ",
			array($message['books'], 'title'),
			'The Following books have been split into the _oAwaiting Responseo_ ticket as they are in an uneceptable condition',
			array($message['bad_books'], 'title'),
			'The Following books never arrived : ',
			array($message['promised_books'][0], 'title'),
			"A sum of _o £{$message['deducted_money']}! o_ has been deducted from the original quote because of bad or missing books."
		));

		return $response->return;
	}

	protected function _initialise_message ($message, $get_quote_from)
	{
		$message['current_ticket'] = $this->get_ticket($message['ticket_id']);
		$message['new_quote'] 	   = $this->_calculate_quote_from_books($message[$get_quote_from]);
		$message['old_quote'] 	   = $message['current_ticket']['quoted_price'];
		$message['deducted_money'] = $message['old_quote'] - $message['new_quote'];
		$message['history']        = unserialize($message['current_ticket']['history']);

		array_push($message['history'], $message['current_ticket']);

		return $message;
	}

	protected function _calculate_quote_from_books ($books)
	{
		$quote = 0;
		foreach ($books as $book) {
			$quote = $quote + $book['lowest'];
		}

		return $quote;
	}

	protected function _format_book_names_to_return_in_array_for_growl ($books)
	{	
		$return_array = array();

		foreach ($books as $book) {			
			$return_array[] = "{$book['title']} _!| {$book['isbn']}!_";
		}

		return $return_array;
	}

	protected function calculate_expiration_date ()
	{
		global $global_admin_options_white_whale;
		$time = new helper_time;

		return round($time->calculate_total_number_of_days(date('d/m/Y'))) + $global_admin_options_white_whale['expiery_wait'];
	}	
}


?>
<?php 

/**
* Ticket splitter branch class
*/
abstract class branch_ticket_splitter extends branch_ticket
{
	public function update_ticket ()
	{
		$method = "_{$_POST['information']['action']}";

		$response = $this->$method($this->_initialise_message($_POST['information']['message']));

		echo json_encode($response);

		exit;
	}

	protected function _response ($response)
	{
		$response = new response($response);

		return $response->return;
	}

	protected function _alter_book_ticket ($status, $details, $quote_to_use, $books_to_submit)
	{		
		$this->alter_ticket($details['ticket_id'], $this->_prepare_ticket($status, $details, $quote_to_use, $books_to_submit));
	}

	protected function _create_book_ticket ($status, $details, $quote_to_use, $books_to_submit)
	{
		$this->create_ticket($details['ticket_id'], $this->_prepare_ticket($status, $details, $quote_to_use, $books_to_submit));
	}

	protected function _prepare_ticket ( $status, $details, $quote_to_use, $books_to_submit )
	{	

		return array(
			'status'        => $status,
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'by_user'		=> $details['current_ticket']['by_user'],
			'quoted_price'  => $quote_to_use,
			'books_ordered' => $details[$books_to_submit],
			'history'       => $details['history']
		);
	}

	protected function _all_books_didint_arrive ($message)
	{
		$this->_alter_book_ticket('expired', $message, $message['old_quote'], 'promised_books' );

		return $this->_response(array(
			'Ticket Expired',
			'No Books have arrived, and as such the ticket has been moved into the _o "Expired Section" o_',
			'The books that didint arrive are :',
			array($message['promised_books'], 'title')
		));
	}

	protected function _some_of_the_books_did_not_arrive_and_the_ones_that_did_are_all_bad_condition ($message)
	{		
		$bad_books_quote = $this->_quote($message['bad_books']);

		$this->_alter_book_ticket('awaiting_response', $message, $bad_books_quote, 'bad_books' );

		# Send email to user

		return $this->_response(array(
			'Books are all in bad Condition',
			"Ticket _o {$message['ticket_id']} o_ has moved to the _o \"Awaiting Response\" o_ group because all of the books in it are in a bad shape as well as some promised book/s are missing.",
			'An e-mail will be sent to the user asking them if they wish to donate the books, if not the books shall be moved to Awaiting Return :',
			array($message['bad_books'], 'title'),
			'The Promised book(s) that never arrived are : ',
			array($message['promised_books'], 'title'),
			'Should the user not respond in the expiration period time, the books shall be considered automaticly donated, and put into _o Complete o_ group.'
		));
	}

	protected function _some_unexpected_books_arrived_out_of_the_batch_that_are_useable_along_with_some_that_are_in_bad_shape ($message)
	{
		$promised_books_quote   = $this->_quote($message['promised_books']);
		$unusable_books_quote   = $this->_quote($message['bad_books']);
		$unexpected_books_quote = $this->_quote($message['unexpected_books']);

		$this->_alter_book_ticket('expired', $message, $promised_books_quote, $message['promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return " some unexpected books arrived out of the batch that are useable along with some that are in bad shape";
	}

	protected function _some_books_didint_arrive_but_unexpected_books_arrived_along_with_normal_ones_and_some_that_are_unusable ($message)
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$promised_books_quote   	  = $this->_quote($message['promised_books']);
		$unusable_books_quote   	  = $this->_quote($message['bad_books']);
		$unexpected_books_quote 	  = $this->_quote($message['unexpected_books']);		

		$this->_alter_book_ticket('expired', $message, $promised_books_quote, $message['promised_books']);
		$this->_create_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);
	
		return "some books didint arrive but unexpected books arrived along with normal ones and some that are unusable";
	}

	protected function _all_books_arrived_along_with_some_new_books_and_some_books_are_in_bad_shape ($message) 
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$unusable_books_quote   	  = $this->_quote($message['bad_books']);
		$unexpected_books_quote 	  = $this->_quote($message['unexpected_books']);

		$this->_create_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return "all books arrived along with some new books and some books are in bad shape";	
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

	protected function _initialise_message ($message)
	{
		$message['current_ticket'] = $this->get_ticket($message['ticket_id']);
		$message['history']        = unserialize($message['current_ticket']['history']);
		$message['old_quote'] 	   = $message['current_ticket']['quoted_price'];
		// $message['new_quote'] 	   = $this->_quote($message[$get_quote_from]);
		// $message['deducted_money'] = $message['old_quote'] - $message['new_quote'];

		array_push($message['history'], $message['current_ticket']);

		return $message;
	}

	protected function _quote ($books)
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
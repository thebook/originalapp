<?php 

/**
* Ticket splitter branch class
*/
abstract class branch_ticket_splitter extends branch_ticket
{
	public function update_ticket_after_verify ()
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

		return $this->_response(array(
			'Some books arrived, some unexpected and some bad',
			'Not all of the promised books have arrived, however some unexpected books were detected amongst then and some of the arrived books are in an unusable shape',
			'This tickets unarrived books has been moved to the _o Expired o_ group, a new ticket for the _o Unusable Books o_ has been created',
			"A new ticket for the _o Unexpected Books o_ has been created aswell, the quote being _o £$unexpected_books_quote! o_",
			'An email has been sent informing the customer about the awaiting tickets'
		));
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
		
		return $this->_response(array(
			'Some books arrived, some unexpected and in bad condition',
			'The _@ unarrived books  @_ of this ticket have been moved to the _o "Expired" o_ group',
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_",
			'The _@ unusable books   @_ have been moved as a ticket to the _o "Awaiting Response" o_ group, and shall be donted if they wait time expires, or the customer says so, if not they will be returned',
			"The _@ unexpected books @_ have been moved as a ticket to the _o \"Awaiting Response\" o_ group, with a quote of _o £$unexpected_books_quote! o_"
		));
	}

	protected function _all_books_arrived_along_with_some_new_books_and_some_books_are_in_bad_shape ($message) 
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$unusable_books_quote   	  = $this->_quote($message['bad_books']);
		$unexpected_books_quote 	  = $this->_quote($message['unexpected_books']);

		$this->_alter_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return $this->_response(array(
			'All books arrived, some unexpected and in bad condition',
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_",
			'The _@ unusable books   @_ have been moved as a ticket to the _o "Awaiting Response" o_ group, and shall be donted if they wait time expires, or the customer says so, if not they will be returned',
			"The _@ unexpected books @_ have been moved as a ticket to the _o \"Awaiting Response\" o_ group, with a quote of _o £$unexpected_books_quote! o_"
		));
	}

	protected function _all_books_arrived_with_some_unexpected_ones_and_are_all_in_good_shape ($message)
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$unexpected_books_quote 	  = $this->_quote($message['unexpected_books']);

		$this->_alter_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return $this->_response(array(
			'All books arrived, and some unexpected ones, all in good shape',
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_",
			"The _@ unexpected books @_ have been moved as a ticket to the _o \"Awaiting Response\" o_ group, with a quote of _o £$unexpected_books_quote! o_"
		));
	}

	protected function _all_books_arrrived_and_are_all_in_perfect_condition ($message)
	{
		$this->_alter_book_ticket('complete', $message, $message['old_quote'], $message['arrived_promised_books']);

		return $this->_response(array(
			'All promised books arrived and are all perfect',
			"The _@ promised books @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £{$message['old_quote']}! should be printed. o_",
		));
	}

	protected function _all_books_arrived_and_are_bad ($message)
	{
		$unusable_books_quote = $this->_quote($message['bad_books']);
		$this->_alter_book_ticket('awaiting_response', $message, $message['old_quote'], $message['bad_books']);

		return $this->_response(array(
			'All the books arrived but are in bad shape',
			"The _@ promised books @_ that arrived have been moved to the _o \"Awaiting Response\" o_ and shall be donted if they wait time expires, or the customer says so, if not they will be returned.",
		));
	}

	protected function _some_books_arrived_along_with_some_unexpected_ones_and_are_all_in_good_condition ($message)
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$promised_books_quote   	  = $this->_quote($message['promised_books']);
		$unexpected_books_quote 	  = $this->_quote($message['unexpected_books']);	

		$this->_alter_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);
		$this->_create_book_ticket('expired', $message, $promised_books_quote, $message['promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return $this->_response(array(
			'Some books arrived, and unexpected ones all in good condition',
			'The _@ unarrived books  @_ of this ticket have been moved to the _o "Expired" o_ group',
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_",
			"The _@ unexpected books @_ have been moved as a ticket to the _o \"Awaiting Response\" o_ group, with a quote of _o £$unexpected_books_quote! o_"
		));
	}

	protected function _all_books_arrived_and_some_are_in_a_unaceptable_condition ($message)
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$unusable_books_quote   	  = $this->_quote($message['bad_books']);

		$this->_alter_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);

		return $this->_response(array(
			'All books have arrived but some are in bad shape',	
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_",
			'The _@ unusable books   @_ have been moved as a ticket to the _o "Awaiting Response" o_ group, and shall be donted if they wait time expires, or the customer says so, if not they will be returned',
		));
	}

	protected function _only_unexpected_books_arrived ($message)
	{
		$unexpected_books_quote = $this->_quote($message['unexpected_books']);

		$this->_alter_book_ticket('expired', $message, $message['old_quote'], $message['promised_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return $this->_response(array(
			'Only unexpected books arrived',
			'All the _@ unarrived books  @_ of this ticket have been moved to the _o "Expired" o_ group, since they did not arrive',
			"The _@ unexpected books @_ have been moved as a ticket to the _o \"Awaiting Response\" o_ group, with a quote of _o £$unexpected_books_quote! o_"
		));
	}

	protected function _some_books_didint_arrive_and_some_that_did_are_not_in_a_good_shape ($message)
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);
		$unusable_books_quote   	  = $this->_quote($message['bad_books']);

		$this->_alter_book_ticket('expired', $message, $message['old_quote'], $message['promised_books']);
		$this->_create_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);		
		$this->_create_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);

		return $this->_response(array(
			'Some books arrived and some are in a bad shape',
			'The _@ unarrived books  @_ of this ticket have been moved to the _o "Expired" o_ group',
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_",
			'The _@ unusable books   @_ have been moved as a ticket to the _o "Awaiting Response" o_ group, and shall be donted if they wait time expires, or the customer says so, if not they will be returned'
		));
	}

	protected function _all_books_arrived_with_some_unexpected_books_and_only_some_unexpected_books_are_in_good_shape ($message)
	{
		$unusable_books_quote = $this->_quote($message['bad_books']);
		$unexpected_books_quote = $this->_quote($message['unexpected_books']);

		$this->_alter_book_ticket('awaiting_response', $message, $unusable_books_quote, $message['bad_books']);
		$this->_create_book_ticket('awaiting_response', $message, $unexpected_books_quote, $message['unexpected_books']);

		return $this->_response(array(
			'All books arrived, with unexpected ones which are in good shape',
			'The _@ unusable books   @_ have been moved as a ticket to the _o "Awaiting Response" o_ group, and shall be donted if they wait time expires, or the customer says so, if not they will be returned',
			"The _@ unexpected books @_ have been moved as a ticket to the _o \"Awaiting Response\" o_ group, with a quote of _o £$unexpected_books_quote! o_"
		));
	}

	protected function _some_books_didint_arrive_but_the_ones_that_did_are_in_a_good_condition ($message)
	{
		$arrived_promised_books_quote = $this->_quote($message['arrived_promised_books']);

		$this->_alter_book_ticket('complete', $message, $arrived_promised_books_quote, $message['arrived_promised_books']);

		return $this->_response(array(
			'Some books arrived and all are in a good condition',
			'The _@ unarrived books  @_ of this ticket have been moved to the _o "Expired" o_ group',
			"The _@ promised books   @_ that arrived have been moved to the _o \"Complete\" o_ group and a check of _o £$arrived_promised_books_quote! should be printed. o_"
		));
	}



	protected function _initialise_message ($message)
	{
		$message['current_ticket'] = $this->get_ticket($message['ticket_id']);
		$message['history']        = unserialize($message['current_ticket']['history']);
		$message['old_quote'] 	   = $message['current_ticket']['quoted_price'];

		array_push($message['history'], $message['current_ticket']);

		return $message;
	}

	protected function _add_to_ticket_history ($ticket_id)
	{
		$ticket = $this->get_ticket($ticket_id);
		$ticket['history'] = unserialize($ticket['history']);
		return array_push($ticket['history'], $ticket['current_ticket']);
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
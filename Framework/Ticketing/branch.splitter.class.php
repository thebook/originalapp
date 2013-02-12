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
		$current_ticket = $this->get_ticket($message['ticket_id']);
		$quote   	    = $current_ticket['quoted_price'] / 100;
		$history 	    = unserialize($current_ticket['history']);
		array_push($history, $current_ticket );			
		$this->alter_ticket($message['ticket_id'], array(
			'status'  => 'complete',
			'history' => $history
		));

		// Print check here 
		// Add new books to stock
		// Send email here after print is sucessfull

		$response['header']   = 'Ticket Completed';
		$response['message']  = "<p class=\"seperate_notifications\">Ticket <strong>\"{$message['ticket_id']}\"</strong> has moved to the <strong>Complete</strong> group and a check of <strong>£$quote</strong> should be printed. Books arrived are :</p>";
		$response['message'] .= $this->_format_book_names_to_return_in_string_for_growl($message['books']);

		return $response;
	}

	protected function _some_books_are_bad ($message)
	{
		$current_ticket = $this->get_ticket($message['ticket_id']);
		$new_quote = 0;
		$old_quote = $current_ticket['quoted_price'];
		foreach ($message['books'] as $book) {
			$new_quote = $new_quote + $book['lowest'];
		}

		$money_taken_from_old_quote_because_of_bad_books = $old_quote - $new_quote;
		$history   = unserialize($current_ticket['history']);
		array_push($history, $current_ticket );			

		$this->alter_ticket($message['ticket_id'], array(
			'status'  		=> 'complete',
			'books_ordered' => $message['books'],
			'quoted_price'  => $new_quote,
			'history' 		=> $history
		));

		$this->create_ticket(array(
			'status' 		=> 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'by_user'		=> $current_ticket['by_user'],
			'books_ordered'	=> $message['bad_books'],
			'quoted_price'  => $money_taken_from_old_quote_because_of_bad_books,
			'history' 		=> $history
		));

		// Add books to stock
		// Print check here 

		$response['header']   = 'Some Books are in bad condition';
		$response['message']  = "<p class=\"seperate_notifications\">Ticket <strong>\"{$message['ticket_id']}\"</strong> has bee split into two different tickets and the quote has been changed from <strong>£". $old_quote / 100 ."</strong> to <strong>£". $new_quote / 100 ."</strong>: </p>";
		$response['message'] .= '<p class="seperate_notifications">The Following books have been split into the <strong>Complete</strong> ticket, and a check of <span style="text-decoration: underline;">£'. ( $new_quote/100 ) .'</span> has been printed :</p>';
		$response['message'] .= $this->_format_book_names_to_return_in_string_for_growl($message['books']);
		$response['message'] .= '<p class="seperate_notifications">The Following books have been split into the <strong>Awaiting Return</strong>ticket, as they are in unaceptable condition. A sum of <span style="text-decoration: underline;">£'. ( $money_taken_from_old_quote_because_of_bad_books/100 ) .'</span> has been deducted from the original price :</p>';
		$response['message'] .= $this->_format_book_names_to_return_in_string_for_growl($message['bad_books']);

		return $response;		
	}

	protected function _all_bad_books ($message)
	{
		$current_ticket = $this->get_ticket($message['ticket_id']);
		$quote 		    = $current_ticket['quoted_price'] / 100;
		$history 	    = unserialize($current_ticket['history']);

		array_push($history, $current_ticket );

		$this->alter_ticket($message['ticket_id'], array(
			'status'        => 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'books_ordered' => $message['bad_books'],
			'history'       => $history
		));

		# Send email to user
		
		$response['header']   = 'Ticket Moved To Awaiting Response';
		$response['message']  = "<p class=\"seperate_notifications\">Ticket <strong>\"{$message['ticket_id']}\"</strong> has moved to the <strong>Awaiting Response</strong> group because all of the books in it are in a bad shape.</p>";
		$response['message'] .= "<p class=\"seperate_notifications\">An e-mail will be sent to the user asking them if they wish to donate the books, if not the books shall be moved to <strong>Awaiting Return</strong> : </p>";
		$response['message'] .= $this->_format_book_names_to_return_in_string_for_growl($message['bad_books']);
		$response['message'] .= "<p class=\"seperate_notifications\">Should the user not respond in the expiration period time, the books shall be considered automaticly donated, and put into <strong>Complete</strong> group.</p>";
		
		return $response;
	}

	protected function _all_bad_books_with_some_missing ($message)
	{
		$current_ticket = $this->get_ticket($message['ticket_id']);
		$quote 		    = $current_ticket['quoted_price'] / 100;
		$new_quote 		= $this->_calculate_quote_from_books($message['bad_books']);
		$history 	    = unserialize($current_ticket['history']);

		array_push($history, $current_ticket );



		$message = $this->_initialise_message($message);

		$this->alter_ticket($message['ticket_id'], array(
			'status'        => 'awaiting_response',
			'date_created'  => date('Y-m-d'),
			'date_expected' => $this->calculate_expiration_date(),
			'quoted_price'  => $message['quote'],
			'books_ordered' => $message['bad_books'],
			'history'       => $history
		));

		# Send email to user
		
		$response['header']   = 'Books are all in bad Condition';
		$response['message']  = "<p class=\"seperate_notifications\">Ticket <strong>\"{$message['ticket_id']}\"</strong> has moved to the <strong>Awaiting Response</strong> group because all of the books in it are in a bad shape as well as some promised book/s are missing.</p>";
		$response['message'] .= "<p class=\"seperate_notifications\">An e-mail will be sent to the user asking them if they wish to donate the books, if not the books shall be moved to <strong>Awaiting Return</strong> : </p>";
		$response['message'] .= $this->_format_book_names_to_return_in_string_for_growl($message['bad_books']);
		$response['message'] .= "<p class=\"seperate_notifications\">The Promised book(s) that never arrived are : </p>";
		$response['message'] .= $this->_format_book_names_to_return_in_string_for_growl($message['promised_books'][0]);
		$response['message'] .= "<p class=\"seperate_notifications\">Should the user not respond in the expiration period time, the books shall be considered automaticly donated, and put into <strong>Complete</strong> group.</p>";

		return $response;
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

		$old_quote = $message['old_quote'] / 100;
		$quote     = $message['new_quote'] / 100;

		$response['header']  = 'Some books are in bad condition and some missing';
		$response['message'] = 
			new response("
				~o 	Ticket {$message['ticket_id']} has been split into two different tickets 
					and the quote has been changed from _!$old_quote!_ to _!$quote!_ : o~

				~o 	The Following Books have been split into the _!Complete!_ ticket, and a check of (($quote)) 
					will be printed. o~ ".

					$this->_format_book_names_to_return_in_string_for_growl($message['books']) ."

				~o 	The Following books have been split into the _!Awaiting Response!_ ticket as they are 
					in an uneceptable condition o~ ".

					$this->_format_book_names_to_return_in_string_for_growl($message['bad_books']) ."

				~o 	The Following books never arrived : o~ ".

					$this->_format_book_names_to_return_in_string_for_growl($message['promised_books'][0]) ."

				~o	A sum of _!". $message['deducted_money'] / 100 ."!_ has been deducted from the original quote 
					because of bad or missing books. o~
			");

		return $response;
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

	protected function _format_book_names_to_return_in_string_for_growl ($books)
	{	
		$string = '~+';

		foreach ($books as $book) {			
			$string .= "~*{$book['title']} _! | {$book['isbn']} !_ *~";
		}

		return $string .= '+~';
	}

	protected function calculate_expiration_date ()
	{
		global $global_admin_options_white_whale;
		$time = new helper_time;

		return round($time->calculate_total_number_of_days(date('d/m/Y'))) + $global_admin_options_white_whale['expiery_wait'];
	}	
}


?>
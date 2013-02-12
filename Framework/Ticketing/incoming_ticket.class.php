<?php

/**
* A class for ticketing incoming books 
*/
class tickets extends branch_ticket_splitter
{
	public function prepare_books_ticket ()
	{
		$ticket = 
			array(
				'date_created'  => date('Y-m-d'),
				'date_expected' => $this->calculate_expiration_date(),
				'status' 		=> $_POST['ticket']['status'],
				'by_user' 		=> $_POST['ticket']['by_user'],
				'history'      	=> array(),
				'quoted_price'  => $_POST['ticket']['quote'],
				'books_ordered'	=> $_POST['ticket']['books']
		);

		$this->create_ticket($ticket);

		$response['header']   = 'Ticket Created';
		$response['message']  = "<p class=\"seperate_notications\">Ticket has been created for User : <strong>\"{$_POST['ticket']['by_user']}\"</strong>, with the quote of <strong>\"£". ( $_POST['ticket']['quote'] / 100 )."\"</strong>; and has been given the status of <strong>\"".ucwords(str_replace('_', ' ', $_POST['ticket']['status']))."\"</strong></p>";

		echo json_encode($response);

		exit;
	}

	public function users_for_ticket ()
	{
		global $user;
		
		echo json_encode($user->get_users());
		
		exit;
	}	

	public function ticket_creation_element ()
	{ ?>				
		<div class="ticket_create_ticket">
			
			<div class="ticket_search">
				
				<span class="ticket_search_label">Search for book: </span>
				
				<input type="text" class="ticket_input">

				<div data-function-to-call="search_though_amazon_for_a_book" 
				     data-function-instructions="{'input' : '.ticket_input', 'numerical_search' : 'isbn', 'book_wrap' : '.ticket_book', 'action' : 'amazon', 'search_for' : 'books', 'filter_by' : 'tiny' }" 
				     class="ticket_button">Search</div>
			</div>

			<div class="ticket_book"></div>

			<div class="ticket_basket">

				<div class="ticket_basket_book"><span class="ticket_basket_book_name"><strong class="quote">£ 0</strong></span></div>

				<div class="basket_hold"></div>

				<div data-function-to-call="search_though_amazon_for_a_book.prototype.basket.prototype.complete_ticket_on_admin_side" 
				      class="ticket_button complete">Complete Ticket</div>

			</div>

		</div>

		<?php exit; ?>

<?php }

	public function page ()
	{ ?> 

		<?php global $global_admin_options_white_whale; ?>		

		<div class="tickets_all">

			<div class="ticket_labels_guide">

				<?php foreach ($this->paramaters['manifestation']['ticket_types'] as $ticket_type): ?>
					
					<span class="ticket_label_guide">
						<span style="background-color: #<?php echo $global_admin_options_white_whale[$ticket_type.'_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : <?php echo ucwords(str_replace('_', ' ', $ticket_type )); ?>,</span>
					</span>

				<?php endforeach; ?>
				
			</div>

			<div class="create_ticket_button" data-function-to-call="open_ticket_in_admin">Create Ticket</div>

			<?php $tickets = $this->get_and_sort_tickets(); ?>

			<div class="tickets">

				<div class="tickets_tabs">
					
					<?php foreach ($tickets as $ticket_type => $ticket ): ?>

						<div data-function-to-call="ticket_tab" id="<?php echo $ticket_type; ?>" class="ticket_tab"><?php echo ucwords(str_replace('_', ' ', $ticket_type )); ?></div>

					<?php endforeach; ?>

				</div>		
				
			</div>

			<script>alpha.track_events_on_this('.tickets_all', 'click');</script>

		</div>

<?php }

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

	public function display_tickets ()
	{ ?>

		<?php $get_tickets = $this->get_and_sort_tickets(); ?>

		<div id="window_of_<?php echo $_GET['tickets_to_show']; ?>"class="ticket_overall_wrap ticket_window">
			
			<div data-function-to-call="ticket_tab.prototype.load" id="<?php echo $_GET['tickets_to_show']; ?>" class="ticket_button reload_ticket">Reload</div>
			
			<?php foreach ($get_tickets[$_GET['tickets_to_show']] as $ticket ): ?>
				
				<?php $this->_display_ticket($ticket); ?>

			<?php endforeach; ?>

		</div>

		<?php exit; ?>

<?php }

	protected function _display_ticket_status ($current_status)
	{
		global $global_admin_options_white_whale;

		$return_string = "<div style=\"background-color: #". $global_admin_options_white_whale[$current_status .'_color'] .";\" class='ticket_status'></div>";
		
		return $return_string;
	}

	protected function _display_ticket_date_expected ($date_expected)
	{	
		$time = new helper_time;

		return ( $date_expected - round($time->calculate_total_number_of_days(date('d-m-Y'), '-')) ). ' days';
	}

	protected function _display_ticket_ticket_id ($ticket_id)
	{
		return $ticket_id;
	}

	protected function _display_ticket_date_created ($date)
	{
		return $date;
	}

	protected function _display_ticket_quoted_price ($quote)
	{
		return '£'. $quote / 100;
	}

	protected function _display_ticket_books_ordered ($books)
	{	
		$books         = unserialize($books);
		$return_string = ''; 

		foreach ($books as $book)
		{
			$return_string .= "<div style=\"display : none;\" class=\"books_for_ticket\"><div class=\"ticket_book_start_label\"><span>Isbn: </span><strong>{$book['isbn']}</strong></div>";
				$return_string .= "<div class=\"ticket_book_label\"><span>Title</span><i>{$book['title']}</i></div>";
				$return_string .= "<div class=\"ticket_book_label\"><span>Author<i></span>{$book['author']}</i></div>";
			$return_string .= '</div>';
		}

		$return_string .= '<div data-function-to-call="show_or_hide_element" data-function-instructions="{\'class_to_mark_as_hidden\' : \'book_info_hidden\', \'elements_to_hide\' : \'.books_for_ticket\' }" class="book_info_hidden ticket_button">Info</div>';

		return $return_string;
	}

	protected function _display_ticket_by_user ($user_id)
	{ 
	 	global $user; 

		$user_info      = $user->get_user('id', $user_id );
		unset($user_info['id']);
		$return_string  = "<span class=\"user_ticket_id\">User Id: $user_id</span>";
		$return_string .= '<div style="display: none;" class="user_info user_info_for_ticket">';

			foreach ($user_info as $field_name => $field_value) : 

				$return_string .= '<div class="user_field_wrap">';
					$return_string .= '<div class="user_field">'. ucwords(str_replace('_', ' ', $field_name )) .'</div>';
					$return_string .= '<div class="user_info_field">'. $field_value .'</div>';
				$return_string .= '</div>';

			endforeach;		

		$return_string .= '</div>';
		$return_string .= '<div data-function-to-call="show_or_hide_element" data-function-instructions="{\'class_to_mark_as_hidden\' : \'user_hidden\', \'elements_to_hide\' : \'.user_info_for_ticket\' }" class="user_hidden ticket_button">More</div>';

		return $return_string;
	}

	protected function _verify_ticket_button ($ticket)
	{
		return str_replace('"', "'", json_encode(unserialize($ticket['books_ordered'])));
	}

	protected function _display_ticket ($ticket)
	{ ?>
		<div class="ticket_box_wrap">

			<div class="ticket_box">

				<div class="ticket_information_row">

					<div data-function-to-call="check_books" 
					     data-function-instructions="{ 'books' : <?php echo $this->_verify_ticket_button($ticket['ticket']); ?>, 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>' }" 
					     class="button">Verify Ticket</div>				

				</div>

				<?php foreach ( $ticket['formated'] as $ticket_column ): ?>
							
					<div class="ticket_information_row">

						<div class="ticket_information_type"><?php echo $ticket_column['name']; ?></div>

						<div class="ticket_information"><?php echo $ticket_column['value']; ?></div>

					</div>

				<?php endforeach; ?>

			</div>
		</div>

<?php }
}

?>
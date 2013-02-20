<?php

/**
* A class for ticketing incoming books 
*/
class tickets extends branch_ticket_format
{

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

		<?php $this->sort_ticket_states(); ?>

		<?php $tickets = $this->get_and_sort_tickets(); ?>

		<div class="tickets_all">

			<div class="ticket_labels_guide">

				<?php foreach ($this->paramaters['manifestation']['ticket_types'] as $ticket_type): ?>
					
					<span class="ticket_label_guide">
						<span style="background-color: #<?php echo $global_admin_options_white_whale[$ticket_type.'_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : <?php echo ucwords(str_replace('_', ' ', $ticket_type )); ?>,</span>
					</span>

				<?php endforeach; ?>
				
			</div>

			<div class="create_ticket_button" data-function-to-call="open_ticket_in_admin">Create Ticket</div>		
				
			<div class="tickets">

				<div class="search_users_wrap"><input type="text" data-function-to-call="filter_search" data-function-instructions="{'what_to_filter' : '.ticket_box_wrap', 'filter_by' : 'data_type'}" class="search_users"></div>

				<script>alpha.track_events_on_this(".search_users", 'keypress');</script>

				<div class="tickets_tabs">
					
					<?php foreach ($tickets as $ticket_type => $ticket ): ?>

						<div data-function-to-call="ticket_tab" id="<?php echo $ticket_type; ?>" class="ticket_tab"><?php echo ucwords(str_replace('_', ' ', $ticket_type )); ?></div>

					<?php endforeach; ?>

				</div>				
				
			</div>

			<script>alpha.track_events_on_this('.tickets_all', 'click');</script>

		</div>

<?php }

	protected function _display_ticket_buttons ($ticket)
	{ ?>
		<?php extract($ticket['ticket']); ?>

			<?php if ($status === 'waiting_arrival'): ?>
				
				<div data-function-to-call="check_books" data-function-instructions="{ 'books' : <?php echo $this->_verify_ticket_button($ticket['ticket']); ?>, 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>' }" class="button">Verify Ticket</div>

			<?php endif ?>

			<?php if ($status === 'awaiting_return'): ?>
				
				<div data-function-to-call="change_ticket" data-function-instructions="{ 'message' : { 'header' : 'Books Returned', 'message' : 'Ticket has been moved to the <strong>Returned</strong> group.'}, 'ticket' : { 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'status' : 'returned' } }" class="button">Books Returned</div>

			<?php endif ?>

			<?php if ($status === 'returned' ): ?>
				
				<div data-function-to-call="change_ticket" data-function-instructions="{ 'message' : { 'header' : 'Ticket Revived', 'message' : 'Ticket has been put back into the <strong>Awaiting Return</strong> group.' }, 'ticket' : { 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'status' : 'awaiting_return' }}" class="button">Not Returned?</div>
				
			<?php endif ?>

			<?php if ($status === 'awaiting_delivery' ): ?>
				
				<div data-function-to-call="change_ticket" data-function-instructions="{ 'message' : { 'header' : 'Books Sent', 'message' : 'Ticket has been put into the <strong>Delivered</strong> group, as they have been sent.' }, 'ticket' : { 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'status' : 'delivered' }}" class="button">Books Sent?</div>
				<div data-function-to-call="change_ticket" data-function-instructions="{ 'message' : { 'header' : 'Ticket moved to expire', 'message' : 'Ticket has been moved to the <strong>Expired</strong> group, this ticket will be treated as if its order never arrived.'}, 'ticket' : { 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'status' : 'expired' } }" class="button">Order Canceled?</div>
			<?php endif; ?>

			<?php if ($status === 'delivered' ): ?>
				
				<div data-function-to-call="change_ticket" data-function-instructions="{ 'message' : { 'header' : 'Books Not Sent', 'message' : 'Ticket has been put back into the <strong>Awaiting Delivery</strong> group, as they books are deemd to not have been sent.' }, 'ticket' : { 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'status' : 'awaiting_delivery' }}" class="button">Books Not Sent?</div>

			<?php endif; ?>

			<?php if ($status === 'waiting_arrival' or $status === 'awaiting_return' or $status === 'awaiting_response'): ?>
				
				<div data-function-to-call="change_ticket" data-function-instructions="{ 'message' : { 'header' : 'Ticket moved to expire', 'message' : 'Ticket has been moved to the <strong>Expired</strong> group, this ticket will be treated as if its order never arrived.'}, 'ticket' : { 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'status' : 'expired' } }" class="button">Expire</div>			
				<div data-function-to-call="extend_ticket_expirey" data-function-instructions="{ 'ticket' : '<?php echo $ticket['ticket']['ticket_id']; ?>', 'days_left' : '<?php echo $this->_calculate_expirey_date($ticket['ticket']['date_expected']);  ?>' }" class="button">Change Expirey</div>

			<?php endif ?>

<?php }

	protected function _ticket_filter ($ticket)
	{	
		
		$filter = '';
		$ordered_books = unserialize($ticket['ticket']['books_ordered']);
		unset($ticket['ticket']['books_ordered']);
		
		foreach ($ticket['ticket'] as $column_name => $column_value ) :
			
			($column_name === 'quoted_price' ) and $column_value = '£'. $column_value / 100;
			($column_name === 'date_expected') and $column_value = $this->_calculate_expirey_date($column_value) .' days';
			($column_name === 'status')        and $column_value = str_replace('_', ' ', $column_value);

			$filter .= str_replace('_', ' ', $column_name ) ." :: $column_value ";

		endforeach;

		foreach ($ordered_books as $book) :
			
			$filter .=	"Title :: {$book['title']} ";
			$filter .=	"ISBN :: {$book['isbn']} ";
			$filter .=	"Author :: {$book['author']} ";

		endforeach;

		return "data-filter=\"$filter\"";
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

	protected function _display_ticket ($ticket)
	{ ?>		
		<?php if ($ticket['ticket']['status'] === 'awaiting_delivery' or $ticket['ticket']['status'] === 'delivered' ) : ?>

		 	<?php $ticket['formated']['date_expected']['value'] = 'no expected date'; ?>

		<?php endif; ?>

		<div class="ticket_box_wrap" <?php echo $this->_ticket_filter($ticket); ?>>
		
			<div class="ticket_box">

				<div class="ticket_information_row">

					<?php $this->_display_ticket_buttons($ticket); ?>

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

	protected function _calculate_expirey_date ($date_expected)
	{
		$time = new helper_time;

		return ( $date_expected - round($time->calculate_total_number_of_days(date('d-m-Y'), '-')) );	
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
}

?>
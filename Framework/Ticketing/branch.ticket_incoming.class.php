<?php

/**
* A class for keeping track of incoming tickets 
*/
class branch_ticket_books_bought extends alpha_tree_ticket
{
	protected function _ticket_creation_element ()
	{ ?>
		
		<div class="create_ticket_button">Create Ticket</div>
		
		<div class="ticket_create_ticket">
			
			<div class="ticket_search">
				<input type="text" class="ticket_input">
				<div class="button">Search</div>
			</div>

			<div class="ticket_book">
				<div class="ticket_book_thumbnail"></div>
				<div class="ticket_book_name">Title</div>
				<div class="ticket_book_author">Author</div>
				<div class="ticket_book_isbn">213213</div>
				<div class="ticket_button">Add Book</div>
			</div>

			<div class="ticket_basket">
				
				<div class="ticket_basket_book">
					<span class="ticket_basket_book_name">Book Name: <strong>The extremly long name of the long extremity,</strong></span>
					<span class="ticket_basket_book_name">ISBN: <strong>294356656,</strong></span>
					<span class="ticket_basket_book_name">£ <strong>90.00</strong></span>
					<span class="ticket_basket_remove_button">Remove Book</span>					
				</div>

				<div class="ticket_basket_book">
					<span class="ticket_basket_book_name">Book Name: <strong>The,</strong></span>
					<span class="ticket_basket_book_name">ISBN: <strong>294356656,</strong></span>
					<span class="ticket_basket_book_name">£ <strong>90.00</strong></span>
					<span class="ticket_basket_remove_button">Remove Book</span>					
				</div>

				<div class="ticket_button">Complete Ticket</div>
			</div>

		</div>


<?php }

	public function page ()
	{ ?> 

		<?php $this->_initialise_tickets(); ?>

		<?php $this->_ticket_creation_element(); ?>

		<div class="tickets">

			<div class="tickets_tabs">
				
				<?php foreach ($this->paramaters['tickets'] as $ticket_type => $tickets ): ?>

					<div class="ticket_tab"><?php echo ucwords(str_replace('_', ' ', $ticket_type )); ?></div>

				<?php endforeach ?>

			</div>

			<div class="ticket_overall_wrap">

				<?php foreach ($this->paramaters['tickets'] as $ticket): ?>
					
					<?php $this->_display_tickets($ticket); ?>

				<?php endforeach; ?>

			</div>
			
		</div>

<?php }

	protected function _initialise_tickets ()
	{
		$tickets = $this->get_all_tickets();
		$this->paramaters['tickets']['all']     = $this->_display_all_tickets($tickets);
		$this->paramaters['tickets']['pending'] = $this->_display_pending_tickets($tickets);
		$this->paramaters['tickets']['complete']= $this->_display_complete_tickets($tickets);
	}

	protected function _display_all_tickets ($tickets)
	{		
		$time 			  = new helper_time;
		$formated_tickets = array();

		foreach ($tickets as $ticket) :

			$formated_tickets[] = $this->_format_ticket($ticket, $time);

		endforeach;

		return $formated_tickets;
	}

	protected function _display_pending_tickets ($tickets)
	{
		$time 			  = new helper_time;
		$formated_tickets = array();

		foreach ($tickets as $ticket ) : 
			
			if ( $ticket['pending_or_complete'] === 1 ) : 

				$formated_tickets[] = $this->_format_ticket($ticket, $time);

			endif;

		endforeach;

		return $formated_tickets;
	}

	protected function _display_complete_tickets ($tickets)
	{
		$time 			  = new helper_time;
		$formated_tickets = array();

		foreach ($tickets as $ticket ) : 
			
			if ( $ticket['pending_or_complete'] === 0 ) : 

				$formated_tickets[] = $this->_format_ticket($ticket, $time);

			endif;

		endforeach;

		return $formated_tickets;
	}

	protected function _format_ticket ($ticket, $time)
	{
		return array(
			array(
				'name'  => 'Ticket ID',
				'value' => $ticket['ticket_id'] ),
			array(
				'name'  => 'Pending',
				'value' => ( $ticket['pending_or_complete'] === 1? '<div class="ticket_pending"></div>' : '<div class="ticket_not_pending"></div>' ) ),
			array(
				'name'  => 'Started On',
				'value' => $ticket['date_created'] ),
			array(
				'name'  => 'Days Left Till Expire',
				'value' => ( round($time->calculate_total_number_of_days(reverse_string_at_points('-', $ticket['date_expected']), '-')) - round($time->calculate_total_number_of_days(date('d-m-Y'), '-')) ) ),
			array(
				'name'  => 'Created By',
				'value' =>  "User Id: {$ticket['by_user']}<div class=\"ticket_user_info\"></div>" ),
			array(
				'name'  => 'Books Expected',
				'value' => '' ));
	}

	protected function _display_tickets ($tickets)
	{
		foreach ($tickets as $ticket) {
			$this->_ticket($ticket);
		}
	}

	protected function _ticket ($ticket)
	{ ?>

		<div class="ticket_box">

			<div class="ticket_information_row_button">

				<div class="button">Update Ticket</div>

			</div>

			<?php foreach ( $ticket as $ticket_column ): ?>
						
				<div class="ticket_information_row">

					<div class="ticket_information_type"><?php echo $ticket_column['name']; ?></div>

					<div class="ticket_information"><?php echo $ticket_column['value']; ?></div>

				</div>

			<?php endforeach; ?>

		</div>

<?php }

	protected function _get_user_attached_to_ticket ($user_id)
	{ ?> 
		<?php global $user; ?>

		<?php $user_info = $user->get_user('id', $user_id ); ?>
		
		<div class="user_info">

			<?php foreach ($user_info as $field_name => $field_value): ?>

				<div class="user_field"><?php echo ucwords(str_replace('_', ' ', $field_name )); ?>  </div>
				<div class="user_info"> <?php echo $field_value; ?> </div>

			<?php endforeach ?>

		</div>

<?php }
}

?>			
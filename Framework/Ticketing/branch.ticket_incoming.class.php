<?php

/**
* A class for keeping track of incoming tickets 
*/
class branch_ticket_books_bought extends alpha_tree_ticket
{
	public function prepare_books_ticket ()
	{
		$time   = new helper_time;
		global $global_admin_options_white_whale;

		$ticket = 
			array(
				'date_created'        => date('Y-m-d'),
				'date_expected'       => round($time->calculate_total_number_of_days(date('Y/m/d'))) + $global_admin_options_white_whale['expiery_wait'],
				'status' 			  => $_POST['ticket']['status'],
				'by_user' 			  => $_POST['ticket']['by_user'],
				'previous_order'      => array(),
				'quoted_price'        => $_POST['ticket']['quote'],
				'books_ordered'		  => $_POST['ticket']['books']
		);

		$this->create_ticket($ticket);

		$response['header']   = 'Ticket Created';
		$response['message']  = "<p class=\"seperate_notications\">Ticket has been created for User : <strong>\"{$_POST['ticket']['by_user']}\"</strong>, with the quote of <strong>\"£". ( $_POST['ticket']['quote'] / 100 )."\"</strong>; and has been given the status of <strong>\"{$_POST['ticket']['status']}\"</strong></p>";

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
				
				<span class="ticket_label_guide">
					<span style="background-color: #<?php echo $global_admin_options_white_whale['pending_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : Pending,</span>
				</span>

				<span class="ticket_label_guide">
					<span style="background-color: #<?php echo $global_admin_options_white_whale['complete_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : Complete,</span>
				</span>

				<span class="ticket_label_guide">
					<span style="background-color: #<?php echo $global_admin_options_white_whale['waiting_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : Waiting For Response,</span>
				</span>

				<span class="ticket_label_guide">
					<span style="background-color: #<?php echo $global_admin_options_white_whale['returned_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : Returned,</span>
				</span>

				<span class="ticket_label_guide">
					<span style="background-color: #<?php echo $global_admin_options_white_whale['expired_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : Expired,</span>
				</span>

				<span class="ticket_label_guide">
					<span style="background-color: #<?php echo $global_admin_options_white_whale['waiting_return_color']; ?>" class="ticket_circle"></span><span class="ticket_label_description"> : Awaiting Return,</span>
				</span>
				
			</div>

			<div class="create_ticket_button" data-function-to-call="open_ticket_in_admin">Create Ticket</div>

			<?php $this->_initialise_tickets(); ?>

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

			<script>alpha.track_events_on_this('.tickets_all', 'click');</script>

		</div>

<?php }

	protected function _initialise_tickets ()
	{
		$tickets = $this->get_all_tickets();
		$this->paramaters['tickets']['all']     = $this->_display_all_tickets($tickets);
		$this->paramaters['tickets']['pending'] = $this->_return_specific_tickets('pending', $tickets);
		$this->paramaters['tickets']['complete']= $this->_return_specific_tickets('complete', $tickets);
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

	protected function _return_specific_tickets ($tickets_status, $tickets)
	{
		$time 			  = new helper_time;
		$formated_tickets = array();

		foreach ($tickets as $ticket ) : 
			
			if ( $ticket['status'] === $tickets_status ) : 

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
				'name'  => 'Status',
				'value' => ( $ticket['status'] === 'pending'? '<div class="ticket_pending"></div>' : '<div class="ticket_not_pending"></div>' ) ),
			array(
				'name'  => 'Started On',
				'value' => $ticket['date_created'] ),
			array(
				'name'  => 'Expires In',
				'value' => ( $ticket['date_expected'] - round($time->calculate_total_number_of_days(date('Y-m-d'), '-')) ) . ' days' ),
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

				<div data-function-to-call="invoke" data-function-instructions="{ 'path' : 'stuff' }" class="button">Update Ticket</div>

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
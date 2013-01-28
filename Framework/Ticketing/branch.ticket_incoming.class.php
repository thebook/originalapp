<?php

/**
* A class for keeping track of incoming tickets 
*/
class branch_ticket_books_bought extends alpha_tree_ticket
{

	public function page ()
	{ ?> 

		<?php $tickets = $this->get_all_tickets(); ?>

		<?php foreach ($tickets as $ticket_name => $ticket): ?>
			
			<?php $this->_ticket($ticket); ?>

		<?php endforeach; ?>

<?php }

	protected function _get_how_many_days_is_expected_to_last ($expected_date)
	{
		$time = new helper_time;
		return round($time->calculate_total_number_of_days($expected_date, '-')) - round($time->calculate_total_number_of_days(date('d-m-Y'), '-'));
	}

	protected function _ticket ($ticket)
	{ ?>
		
		<?php $time = new helper_time; ?>

		<?php $days_left_to_expected_deliver = $this->_get_how_many_days_is_expected_to_last(reverse_string_at_points('-', $ticket['date_expected'])); ?>

		<div class="ticket_box">
			

			<div class="ticket_information_row">

				<div class="ticket_information_type">Ticket ID</div>
				<div class="ticket_information"><?php echo $ticket['ticket_id']; ?></div>				
			</div>

			<div class="ticket_information_row">

				<div class="ticket_information_type">Pending        </div>
				<div class="ticket_information"><?php echo ( $ticket['pending_or_complete'] === 1? '<div class="ticket_pending"></div>' : '<div class="ticket_not_pending"></div>' ); ?></div>
			</div>
			
			<div class="ticket_information_row">

				<div class="ticket_information_type">Start Date</div>
				<div class="ticket_information"><?php echo $ticket['date_created']; ?>       </div>
			</div>

			<div class="ticket_information_row">

				<div class="ticket_information_type">Days Left</div>
				<div class="ticket_information"><?php echo $days_left_to_expected_deliver; ?></div>
			</div>

			<div class="ticket_information_row">
					<div class="ticket_information_type">Created By</div>
				<div class="ticket_information"><?php echo $ticket['by_user']; ?></div>
			</div>

			<div class="ticket_information_row">

				<div class="ticket_information_type">Quoted Price</div>
				<div class="ticket_information"><?php echo $ticket['quoted_price']; ?></div>
			</div>

			<div class="ticket_information_row">

				<div class="ticket_information_type">Books Expected</div>
				<div class="ticket_information"></div>
			</div>

		</div>

<?php }
}

?>			
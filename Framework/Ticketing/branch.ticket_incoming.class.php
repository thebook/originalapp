<?php

/**
* A class for keeping track of incoming tickets 
*/
abstract class branch_ticket extends alpha_tree_ticket
{	
	protected function _format_ticket ($ticket)
	{	
		$format = array();
		
		unset($ticket['history']);

		foreach ($ticket as $ticket_option_name => $ticket_option_value) :
			
			$format[$ticket_option_name] = 
				array(
					'name'  => ucwords(str_replace('_', ' ', $ticket_option_name)),
					'value' => $this->{'_display_ticket_'.$ticket_option_name}($ticket_option_value)
				);

		endforeach;

		return array('ticket' => $ticket, 'formated' => $format );
	}

	protected function _display_all_tickets ($tickets)
	{		
		$formated_tickets = array();

		foreach ($tickets as $ticket) :

			$formated_tickets[] = $this->_format_ticket($ticket);

		endforeach;

		return $formated_tickets;
	}

	protected function _return_specific_tickets ($column_to_filter_by, $value_to_filter_with, $tickets)
	{
		$formated_tickets = array();

		foreach ($tickets as $ticket ) : 
			
			if ( $ticket[$column_to_filter_by] === $value_to_filter_with ) : 

				$formated_tickets[] = $this->_format_ticket($ticket);

			endif;

		endforeach;

		return $formated_tickets;
	}
}

?>			
 <?php 
 
 /**
 * A class for displaying tickets 
 */
 abstract class branch_ticket_format extends branch_ticket_splitter
 {
 	
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

	public function sort_ticket_states ()
	{
		$get_tickets = $this->get_all_tickets();
		
		foreach ($get_tickets as $ticket) :
			
		 	if ( $this->_calculate_expirey_date($ticket['date_expected']) < 1 and $ticket['status'] !== 'expired' ) :

		 		$history = $this->_add_to_ticket_history($ticket['ticket_id']);
		 		$this->alter_ticket($ticket['ticket_id'], array('status' => 'expired', 'history' => $history ));
		 		
		 		# corespondance
		 	
		 	endif;
		endforeach;
	}

	protected function _setup_mail_sender_and_send ($message, $recipient, $subject)
	{	
	global $global_admin_options_white_whale;

		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = $global_admin_options_white_whale['encription'];
		$mail->Host 	  = $global_admin_options_white_whale['mail_host'];
		$mail->Username   = $global_admin_options_white_whale['email'];
		$mail->Password   = $global_admin_options_white_whale['email_password'];
		$mail->From       = $mail->Username;
		$mail->FromName   = $global_admin_options_white_whale['name'];
		$mail->Subject    = $subject;
		$mail->Body 	  = $message;
		$mail->WordWrap   = 50;
		$mail->AddAddress($recipient);
		$mail->IsHTML(true);

		if ($mail->Send()) :

			return "Email has been sent to $subject";

		else : 

			return $mail->ErrorInfo;

		endif;
	}

	protected function _what_to_do_with_expired_ticket ($ticket)
	{}
 }
 
 ?>
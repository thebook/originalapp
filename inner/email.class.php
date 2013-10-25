<?php

/**
* a email sending class
*/
class email extends alpha
{
	var $email;
	var $name;

	function __construct()
	{
		parent::__construct('email');
		$this->table = new table_creator;
		$this->email = 'noreply@recyclabook.com';
		$this->name  = 'Recyclabook';
	}

	public function set_send_email ($type, $user)
	{
		$account     = $this->table->get_row('account', 'email', $user);
		$address     = $this->table->get_row('address', 'user', $user);
		$data        = $this->format_email_data_for_replacement(array(
			'user'    => $account,
			'address' => $address 
		));
		$mail        = $this->table->get_row('book_settings', 'name', $type.'_email');
		$final_email = $this->insert_data_into_email_text($mail, $data);

		return $this->set_email(
			$account['first_name'] . $account['first_name'],
			$account['email'],
			( $type === 'pack' ? 'Your Freepost Pack' : 'Print Pack' ),
			$final_email
		);
	}	

	protected function format_email_data_for_replacement ($email)
	{
		$email['user']['price_promise'] = json_decode($email['user']['price_promise']);
		$email_data                     = array(
			$email['user']['first_name'] .' '. $email['user']['second_name'],
			$this->turn_price_promise_prices_into_a_sum($email['user']['price_promise']),
			$this->turn_book_data_into_html_list($email['user']['price_promise']),
			$email['user']['id'],
			$this->turn_address_array_into_html_list($email['address']),
			date('d-m-Y'),
			$email['user']['password']
		);
		
		return $email_data;
	}

	protected function turn_book_data_into_html_list ($books)
	{	
		$text = '<ul>';
		foreach ($books as $book) {
			$text .= "<li><strong>Title : {$book->item_name}</strong></li>";
			$text .= "<li>Author : {$book->author}</li>";
			$text .= "<li>Quote : £{$book->standard_price}</li>";
		}
		$text .= '</ul>';
		return $text;
	}

	protected function turn_address_array_into_html_list ($address)
	{	
		$text  = '<ul>';
		$text .= "<li>{$address['address']}</li>";
		$text .= "<li>{$address['area']}</li>";
		$text .= "<li>{$address['town']}</li>";
		$text .= "<li>{$address['post_code']}</li>";
		$text .= '</ul>';
		return $text;
	}

	protected function turn_price_promise_prices_into_a_sum ($price_promises)
	{
		$sum = 0;
		foreach ($price_promises as $promise) {
			$sum = $sum + $promise->standard_price;
		}
		return $sum;
	}

	protected function insert_data_into_email_text ($text, $data)
	{
		$email = preg_replace(
			array(
				'/USER_NAME/',
				'/PRICE_PROMISE_SUM/',
				'/ADDED_BOOKS/',
				'/USER_ID/',
				'/USER_ADDRESS/',
				'/DATE/',
				'/USER_PASSWORD/'
			),
			$data,
			$text
		);

		return $email['value'];
	}

	public function set_email ($name, $email, $subject, $text)
	{	
		require_once ABSPATH .'/wp-includes/class-phpmailer.php';
		require_once ABSPATH .'/wp-includes/class-pop3.php';
		require_once ABSPATH .'/wp-includes/class-smtp.php';

		$mail = new PHPMailer();
		$mail->SetFrom($this->email, $this->name);
		$mail->AddReplyTo($this->email, $this->name);
		$mail->AddAddress($email, $name);
		$mail->Subject = $subject;
		$mail->MsgHTML($text);

		if(!$mail->Send()) {
		  return "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  return "Message sent!";
		}
	}
}
	
?>
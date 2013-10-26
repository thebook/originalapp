<?php

	class settings extends alpha
	{
		
		function __construct()
		{
			parent::__construct('setting');
			
			$this->table_name = 'book_settings';
			$this->table      = new table_creator;
			$this->table->check_if_table_exists_if_not_create_one(array(
				'table_name'  => $this->table_name,
				'fields'      => array(
					array(
						'column_name' => 'name',
						'data_type'   => 'longtext',
					),
					array(
						'column_name'=> 'value',
						'data_type'  => 'longtext' 
					),
				)
			));

			if ( $this->get_option('set')['value'] !== 'yes' ) {
				$this->set_options(array(
					array(
						'name' => 'set',
						'value'=> 'yes'
					),					
					array( 
						'name'  => 'admin',
						'value' => 'recyclaboss'
					),
					array( 
						'name'  => 'password',
						'value' => 'thinkbigger12!'
					),
					array( 
						'name'  => 'header_search_title',
						'value' => 'How Much Is Your Book Worth'
					),
					array( 
						'name'  => 'header_search_input',
						'value' => 'Please Type Your ISBN here'
					),
					array( 
						'name'  => 'header_box_title',
						'value' => 'What We Do'
					),
					array( 
						'name'  => 'header_box_paragraph',
						'value' => 'Recyclabook accepts over a million different titles, you can easily sell your book and get paid quickly and safely.'
					),
					array( 
						'name' => 'password_email',
						'value'=> "Hi USER_NAME,\n\n You have asked for a password reminder for user name USER_NAME, this is your password USER_PASSWORD.\n\nHave a pleaseant day.\nRecyclabook team."
					),
					array( 
						'name'  => 'print_email',
						'value' => "Hi USER_NAME,\n\nCongratulations! You have successfully added the following item(s) to your price promise basket:\nADDED_BOOKS\nThe price promise basket is our way of promising that we will give you the price quoted on the day that you registered your books. Your price promise as of DATE is:\n\nPRICE_PROMISE_SUM\n\nYour Price Promise Expires In Two Weeks. The quotes given may not be valid after this period. Hurry, send us your books so we can send you your money!\nWe will soon dispatch a freepost pack to the following address:\nUSER_ADDRESS\n\nOnce you have received the freepost pack, just pop your books into the pre-addressed envelope. Your unique customer identification is USER_ID, pop this number on the letter provided within the freepost pack. Lost the letter? Don’t worry, just include a copy of this email with your books. To check on your price promise basket or to add any new books, visit Recyclabook. Here you can log in and monitor where your books are and, more importantly, where your money is through your account hub.\n\nMany Thanks,\nThe Recyclabook Team"
					),
					array( 
						'name'  => 'pack_email',
						'value' => "Hi USER_NAME,\n\nCongratulations! You have successfully added the following item(s) to your price promise basket: ADDED_BOOKS\nThe price promise basket is our way of promising that we will give you the price quoted on the day that you registered your books. Your price promise as of DATE is:\n\nPRICE_PROMISE_SUM\n\nYour Price Promise Expires In Two Weeks. The quotes given may not be valid after this period. Hurry, send us your books so we can send you your money!\nWe will soon dispatch a freepost pack to the following address:\n\nUSER_ADDRESS\n\nOnce you have received the freepost pack, just pop your books into the pre-addressed envelope. Your unique customer identification is USER_ID, pop this number on the letter provided within the freepost pack. Lost the letter? Don’t worry, just include a copy of this email with your books. To check on your price promise basket or to add any new books, visit Recyclabook. Here you can log in and monitor where your books are and, more importantly, where your money is through your account hub.\n\nMany Thanks,\nThe Recyclabook Team\nLike us on Facebook or follow us on Twitter for a chance to win some great prizes, to date we have given away hundreds of prizes including an i-Pad 2 and a Mango Bike!!"
					),
					array( 
						'name'  => 'pack_letter',
						'value' => "Hello!\n\nThank you for using the Recyclabook freepost pack. The books that you registered have a two week price promise (as of the date described in your email).\n\nThe quotes given may not be valid after this two week period. So hurry, just pop your book(s) into the envelope within this bag (that has a freepost sticker attached) and post it back to us.\n\nThere are a few details that we need from you, just to be sure that we pay the right person. Either fill out your details below or just print out the confirmation email and add that into your freepost pack. If we do not receive a completed copy of this letter or the printed email, you may have to wait a lot longer for your cheque.\n\nCustomer identification number: USER_ID \n\nQuote given: £ PRICE_PROMISE_SUM \n\nFull name USER_NAME (for your cheque):\n\n\nTo check on your price promise basket or to add any new books, visit Recyclabook.com. Here you can log in and monitor where your books are and, more importantly, where your money is through your account hub.\n\nMany Thanks,\n\nThe Recyclabook Team\nLike us on Facebook or follow us on Twitter for a chance to win some great prizes, to date we have given away hundreds of prizes including an i-Pad 2 and a Mango Bike!!"
					),
				));
			}
		}

		public function set_options ($options)
		{
			foreach ($options as $option) {
				$this->set_option($option);
			}
		}

		public function set_option_value ($name, $value)
		{
			$this->table->update_row($this->table_name, array( 'value' => $value ), 'name', $name); 
		}

		public function set_option ($option_array)
		{	
			$this->table->add_row_to_table($this->table_name, $option_array );
		}

		public function get_options ($option_names)
		{	
			$options = array();

			foreach ($option_names as $option_name) {
				$options[] = $this->get_option($option_name);
			}	

			return $options;
		}

		public function get_option ($option_name)
		{	
			return $this->table->get_row($this->table_name, 'name', $option_name);
		}

	}

?>
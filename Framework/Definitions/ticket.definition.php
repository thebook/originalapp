<?php 

return array(
		'ticket_types'   => 
			array(
				'waiting_arrival',
				'complete',
				'expired',
				'returned',
				'awaiting_return',
				'awaiting_response'
			),
		'table_creation' => 
			array(
				'table_name' => 'incoming_books',
				'columns'    => 
					array(															
						array(
							'column_name'    => 'status',
							'data_type'      => 'VARCHAR(100)',
							'auto_increment' => false,
							'unique'         => false
						),
						array(
							'column_name'    => 'quoted_price',
							'data_type'      => 'INT',
							'auto_increment' => false,
							'unique'         => false
						),	
						array(
							'column_name'    => 'date_created',
							'data_type'      => 'DATE',
							'auto_increment' => false,
							'unique'         => false
						),
						array(
							'column_name'    => 'date_expected',
							'data_type'      => 'INT',
							'auto_increment' => false,
							'unique'         => false
						),
						array(
							'column_name'    => 'by_user',
							'data_type'      => 'INT',
							'auto_increment' => false,
							'unique'         => false
						),						
						array(
							'column_name'    => 'books_ordered',
							'data_type'      => 'LONGTEXT',
							'auto_increment' => false,
							'unique'         => false
						),
						array(
							'column_name'    => 'history',
							'data_type'      => 'LONGTEXT',
							'auto_increment' => false,
							'unique'         => false
						))
					),
		'opt' => 
			array(
				// hook in the ticket creation element
				array(
					'f' => 'add_action',
					'o' => array('wp_ajax_ticket_admin_creation', array($this, 'ticket_creation_element' ) ) 
				),
				// hook in the ticket addition element
				array(
					'f' => 'add_action',
					'o' => array('wp_ajax_complete_ticket', array($this, 'prepare_books_ticket' ) ) 
				),
				// hook into ticket display creation 
				array(
					'f' => 'add_action',
					'o' => array('wp_ajax_show_users_for_ticket', array($this, 'users_for_ticket' ) ) 
				),
				// display tickets for specific type
				array(
					'f' => 'add_action',
					'o' => array('wp_ajax_get_tickets', array($this, 'display_tickets' ) ) 
				),	
				// complete ticket order
				array(
					'f' => 'add_action',
					'o' => array('wp_ajax_complete_ticket_order', array($this, 'complete_ticket' ) )
				),
				// update ticket
				array(
					'f' => 'add_action',
					'o' => array('wp_ajax_update_ticket_order', array($this, 'change_ticket' ) )
				),
				// Create Menu page
				array(
					'f' => 'add_menu_page',
					'o' => 
						array(
							'Tickets',       // Page title
							'Tickets',       // Menu title		
							'administrator', // Capabilities	
							'ticketing',     // slug 
							'',		         // function
							'',              // Icon url
							'54' 			 // Page position
						) ),
				// Create Submenu page 
				array(
					'f' => 'add_submenu_page',
					'o' => 
						array(
							'ticketing',      // Add to which parent page
							'Incoming Books', // Title to display
							'Awaiting Books', // Inner title
							'manage_options', // Premissions
							'ticketing',   // Page slug, how it will be reffered to         
							array( $this, 'page' ) ))
		));	

?>
<?php 

	return array( 
			'options' => 'main_meta',
			'nonce' => 'lf-meta-nonce',
			'nonce_value' => basename(__FILE__),
			'opt' => 
				array(
					// Post Settings 
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'book_settings_amazon_search',
									'desc'=> 'Search for various books in amazon and list them as the current bok',
									'title' => __('Amazon Search', 'liquidflux'),
									'post_type' => 'books',
									'context' => 'normal',
									'priority' => 'low',
									'options' => 
										array( 
											'opt' => 
												array(
													// Nonce Field
													array(
														'f' => 'wp_nonce_field',
														'o' => array(
																	basename(__FILE__), 
																	'lf-meta-nonce' )),
													// Amazon Search 
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'amazon_list',
																'title'       => 'Amazon',
																'description' => 'Search for a book in from amazon and fill in the fields',
																'array'       => 'main_meta',
																'name'        => 'book_amazon',
																'saved'       => '' )) )
													))))),
					// Post Settings 
					array( 
						'f' => array( $this, 'pop' ),
						'o'	=>	
							array(
								array( 
									'id' => 'book_settings_meta_bok',
									'desc'=> 'Set the propeties of the book, you wish to add here',
									'title' => __('Book Properties', 'liquidflux'),
									'post_type' => 'books',
									'context' => 'normal',
									'priority' => 'low',
									'options' => 
										array( 
											'opt' => 
												array(
													// Nonce Field
													array(
														'f' => 'wp_nonce_field',
														'o' => array(
																	basename(__FILE__), 
																	'lf-meta-nonce' )
													),
													// Book Title
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'Book Title',
																'description' => 'Write in the the title of the book',
																'array'       => 'main_meta',
																'name'        => 'book_title',
																'saved'       => '' )) ),
													// Book Image 
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'upload',
																'title'       => 'Book Image',
																'description' => 'The image of the book, cover, or something else',
																'array'       => 'main_meta',
																'name'        => 'book_thumbnail',
																'saved'       => '' )) ),
													// Author
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'Author',
																'description' => 'Write in the the name of the book author',
																'array'       => 'main_meta',
																'name'        => 'book_author',
																'saved'       => '' )) ),
													// // description
													// array(
													// 	'f' => array( $this, 'create'),
													// 	'o' => array(
													// 		array(
													// 			'type'        => 'textarea',
													// 			'title'       => 'Description',
													// 			'description' => 'The description of the book, synospis, print date, how many pages (so forth)',
													// 			'array'       => 'main_meta',
													// 			'name'        => 'book_descrpiton',
													// 			'saved'       => '' )) ),
													// description
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'Binding',
																'description' => 'The binding of the book, i.e( paperback, hardcover )',
																'array'       => 'main_meta',
																'name'        => 'book_binding',
																'saved'       => '' )) ),
													// ISBN
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'ISBN Number',
																'description' => 'Write the ISBN number of the book',
																'array'       => 'main_meta',
																'name'        => 'book_isbn',
																'saved'       => '' )) ),
													// Cheapest Price
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'Cheapest Used Price',
																'description' => 'The cheapest used price found on amazon at the time of creation',
																'array'       => 'main_meta',
																'name'        => 'book_cheapest_price',
																'saved'       => '' )) ),
													// Retail Price
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'Retail Price',
																'description' => 'The retail price',
																'array'       => 'main_meta',
																'name'        => 'book_retail',
																'saved'       => '' )) ),
													// Dimensions
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'text',
																'title'       => 'Dimensions',
																'description' => 'The dimensions of the book like so : (13.8 x 1.3 x 21.6 cm)',
																'array'       => 'main_meta',
																'name'        => 'book_dimensions',
																'saved'       => '' )) ),
													// Weight
													array(
														'f' => array( $this, 'create'),
														'o' => array(
															array(
																'type'        => 'slider',
																'title'       => 'Weight',
																'description' => 'The weight of the book in grams, ( 1000g = 1kg )',
																'array'       => 'main_meta',
																'name'        => 'book_weight',
																'saved'       => '',
																'min'         => '100',
																'max'         => '7000',
																'value'       => ' g' )) ),													
								))))
							)));	

?>
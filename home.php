<?php get_header(); ?>
	<!-- Bar  -->
	<!-- <section class="bar_outer_wrap"></section> -->
	
	<!-- Homepage -->
<!-- 	<section class="homepage_body_wrap pages" style="display: none;">

		<div class="homepage_body_inner_wrap">

			<div class="homepage_how_it_works_option_title_wrap">
				<div class="homepage_how_it_works_option_title_scrible">1st option</div>
				<div class="homepage_how_it_works_option_title">
					<span class="homepage_how_it_works_option_title_part_one">Free</span>
					<span class="homepage_how_it_works_option_title_part_two">post</span>
				</div>
			</div>

			<div class="homepage_how_it_works_boxes_numbers_wrap">
				<div class="with-icon-homepage-how-it-works-box-number-one"></div>
				 <div class="with-icon-homepage-how-it-works-box-number-two"></div>	
				<div class="with-icon-homepage-how-it-works-box-number-three"></div>
			</div>

			<div class="homepage_how_it_works_boxes_wrap">
				<div class="homepage_how_it_works_box_wrap_first">
					<div class="homepage_how_it_works_box homepage_how_it_works_box_first">						
						<div class="homepage_how_it_works_box_text_wrap">
							<div class="homepage_how_it_works_box_title">Find Your Books</div>
							<div class="homepage_how_it_works_text">find your books and add them to your sell basket</div>
						</div>
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/type.png'; ?>" class="homepage_how_it_works_box_first_image">
					</div>
					<div class="homepage_arrows_warp">
						<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>
						<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>						
						<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>
					</div>
				</div>				

				<div class="homepage_how_it_works_box_wrap_second">				
					<div class="homepage_how_it_works_box_second">											
						<div class="homepage_how_it_works_box_text_wrap">
							<div class="homepage_how_it_works_box_title">Freepost<br/>Your Books</div>
							<div class="homepage_how_it_works_text">we send you a freepost pack and you send us your books</div>
						</div>					
						<img  src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/letter.png'; ?>" class="homepage_how_it_works_box_second_image">					
					</div>
					<div class="homepage_arrows_warp">
						<div class="with-icon-homepage-how-it-works-box-left-blue-arrow"></div>
						<div class="with-icon-homepage-how-it-works-box-right-arrow"></div>						
						<div class="with-icon-homepage-how-it-works-box-left-arrow"></div>
					</div>
				</div>

				<div class="homepage_how_it_works_box_wrap_last">
					<div class="homepage_how_it_works_box homepage_how_it_works_box_last">												
						<div class="homepage_how_it_works_box_text_wrap">
							<div class="homepage_how_it_works_box_title"><br/>Get Paid</div>
							<div class="homepage_how_it_works_text">we send you a cheque the same day we receive your books</div>
						</div>
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/check.png'; ?>" class="homepage_how_it_works_box_third_image">
					</div>
				</div>
			</div>

			<div class="homepage_how_it_works_boxes_buttons_wrap">
				
				<div class="homepage_how_it_works_box_first_button_wrap">
					<div id="where_is_my_isbn_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">
						Where is My ISBN 
						<span id="where_is_my_isbn_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>
					</div>
					<div id="where_is_my_isbn_toggle" class="homepage_how_it_works_box_button_expanded">
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/where_is_my_isbn.png'; ?>" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">
						<div class="homepage_how_it_works_box_button_expanded_text">
							Just look at the back of your book and find the 13 or 9 digit number bellow the barcode.
						</div>
					</div>
				</div>
				
				<div class="homepage_how_it_works_box_second_button_wrap">
					<div id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_box_button">
						Freepost Options 
						<span id="freepost_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>
					</div>
					<div id="freepost_toggle" class="homepage_how_it_works_box_button_expanded">
						<div class="homepage_how_it_works_box_button_expanded_text">
							We'll send you a postage pack, inside you'll get an envelope with which you can post your books for free
						</div>
						<div class="homepage_how_it_works_box_button_expanded_text_highlight">or</div>
						<div class="homepage_how_it_works_box_button_expanded_text">
							If you have your own package you can print off our own packaging label from this website
						</div>
						<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/freepost_options.png'; ?>" alt="how it works" class="homepage_how_it_works_box_button_expanded_image">
					</div>
				</div>
				
				<div class="homepage_how_it_works_box_third_button_wrap">
					<div  id="paid_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="homepage_how_it_works_last_box_button">
						How Am I Being Paid 
						<span id="paid_trigger" data-function-to-call="front.prototype.toggle_popup_boxes" class="with-icon-down-arrow-for-how-it-works-button"></span>						
					</div>
					<div id="paid_toggle" class="homepage_how_it_works_box_button_expanded">
						<div class="homepage_how_it_works_box_button_expanded_text">
							Dont worry about filling in your bank details, we'll send you a cheque the same day we recieve your books.
						</div> 
					</div>
				</div>
			</div>

			<div class="with-icon-or-sticker-recyclabus"></div>
			<div class="homepage_recyclabus_box_wrap">
				<div class="homepage_recyclabus_box_title_scrible">2nd option</div>
				<div class="homepage_recyclabus_box_title">
					Recycla<span class="homepage_recyclabus_box_title_color">Bus</span>
				</div>
				<div class="homepage_recyclabus_box_text_wrap">
					<div class="homepage_recyclabus_box_point">
						<div class="with-icon-recyclabus-point-leaf"></div>
						<div class="homepage_recyclabus_box_point_text">Our bus is touring Universities all over the country, come along and get paid instantly</div>
					</div>
					<div class="homepage_recyclabus_box_point">
						<div class="with-icon-recyclabus-point-leaf"></div>
						<div class="homepage_recyclabus_box_point_text">It gives you an <strong>extra 20%</strong> on your sell quote</div>
					</div>
					<div class="homepage_recyclabus_box_point">
						<div class="with-icon-recyclabus-point-leaf"></div>
						<div class="homepage_recyclabus_box_point_text">No need to fill in any details <strong>just turn up on the day</strong></div>
					</div>
				</div>
				<div class="homepage_recyclabus_box_button_wrap">
					<div data-function-instructions="{'page' : 'recyclabus' }" data-function-to-call="front.prototype.change_page" class="homepage_recyclabus_box_button_text">Find Out More</div>
					<div class="with-icon-recyclabus-find-out-more-arrow"></div>
				</div>
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/recyclabus.png'; ?>"class="homepage_recyclabus_box_image">
			</div>

			<div class="homepage_alies_bar">
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/iod.png'; ?>" alt="" class="homepage_ally_bar_image">
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/fsc.png'; ?>" alt="" class="homepage_ally_bar_image">
				<img src="<?php echo FRAMEWORKURI .'/CSS/Includes/works/recycle.png'; ?>" alt="" class="homepage_ally_bar_image">
			</div>
		</div>			
	</section> -->
	
	<!-- Recyclabus -->
	<!-- <section class="recyclabus pages"></section> -->

	<!-- User registration -->
	<!-- <section class="input_box_body_wrap account pages">
		<div class="account_wrap"></div>
	</section> -->
	
	<!-- Selling -->
	<!-- <section class="body pages"></section> -->

<!-- 	<section class="checkout pages">
		<div class="checkout_wrap">
			<div class="confirmation_overview">
				<div class="basket_overview_outer_wrap">

					<div class="basket_overview_wrap">
						<div class="basket_overview_title">Basket Overview</div>
						<div class="basket_overview_items">
							<div class="basket_overview_item">
								<img class="basket_overview_item_thumbnail" src="http://farm8.staticflickr.com/7278/8166869046_393e5eecf4.jpg">
								<div class="basket_overview_item_text_wrap">
									<div class="basket_overview_item_text_title">Jaggarnath</div>
									<div class="basket_overview_item_text_author">by Kelsey McDolth</div>
									<div class="basket_overview_item_isbn"><span class="basket_overview_item_isbn_highlight">isbn</span> 923495943</div>
								</div>
								<div class="basket_overview_item_price_wrap">
									<div class="basket_overview_item_price_text">Sell for</div>
									<div class="basket_overview_item_price">£ 12.20</div>
								</div>
							</div>
								<div class="with-icon-x-for-overview-item"></div>
							<div class="basket_overview_item">
								<img class="basket_overview_item_thumbnail" src="http://farm8.staticflickr.com/7278/8166869046_393e5eecf4.jpg">
								<div class="basket_overview_item_text_wrap">
									<div class="basket_overview_item_text_title">Jaggarnath</div>
									<div class="basket_overview_item_text_author">by Kelsey McDolth</div>
									<div class="basket_overview_item_isbn"><span class="basket_overview_item_isbn_highlight">isbn</span> 923495943</div>
								</div>
								<div class="basket_overview_item_price_wrap">
									<div class="basket_overview_item_price_text">Sell for</div>
									<div class="basket_overview_item_price">£ 12.20</div>
								</div>
							</div>
						</div>
						<div class="basket_overview_bar">
							<div class="basket_overview_bar_block"></div>
						</div>
					</div>
					
					<div class="basket_overview_edit_button">Edit Basket</div>
					<div class="basket_overview_total_wrap">
						<div class="basket_overview_total">£12.20</div>
						<div class="basket_overview_total_text">Total Sale:</div>
					</div>
					
				</div>
				
				<div class="address_overview_wrap_outer">
					<div class="address_overview_wrap">
						<div class="address_overview_title">Address Confirmation</div>
						<div class="address_overview_inputs">
							<input class="address_overview_input" 		readonly value="">
							<input class="address_overview_input" 		readonly value="Country">
							<input class="address_overview_input" 		readonly value="Region">
							<input class="address_overview_input_small" readonly value="Post Code">
						</div>
					</div>
					<div class="address_overview_edit">Edit Address</div>
				</div>
			</div>

			<div class="how_would_you_like_wrap">
				<div class="how_would_you_like_title">How would you like to send your books?</div>
				<div class="how_would_you_like_titles_wrap">
					<div class="how_would_you_like_tab_title_active ">We Send you a freepost pack</div>
					<div class="how_would_you_like_tab_title active_tab_right">Print your own freepost pack</div>
				</div>
				<div class="how_would_you_like_tab_wrap">
					<div class="how_would_you_like_we_send_active_tab">
						<img class="we_send_freepost_tab_image" src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/freepost_send.png">
						<div class="we_send_freepost_tab_text_wrap">
							<ul class="we_send_freepost_tab_text">
								<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>
								<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>
								<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>
							</ul>
							<div class="we_send_freepost_tab_tick_button">
								<div class="with-icon-we-checkout-tick"></div>
								<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>
							</div>
						</div>
					</div>

					<div class="how_would_you_like_we_send_tab">
						<img class="we_send_freepost_tab_image" src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/print.png">
						<div class="we_send_freepost_tab_text_wrap">
							<ul class="we_send_freepost_tab_text">
								<li class="we_send_freepost_tab_paragraph">Youll get instructions to guide you through a Pre-paid Envelope for your books.</li>
								<li class="we_send_freepost_tab_paragraph">Just pop them in the <strong>pre-paid</strong>, <strong>pre-addressed</strong> bag and send them to us for quick payment.</li>
								<li class="we_send_freepost_tab_paragraph">Well send you a cheque on the day we recieve your books.</li>
							</ul>
							<div class="we_send_freepost_tab_tick_button">
								<div class="with-icon-we-checkout-tick-dark"></div>
								<div class="we_send_freepost_tab_tick_button_text">Current Selection</div>
							</div>
						</div>
					</div>
				</div>
				<div class="checkout_button">Confirm & Complete</div>
			</div>
		</div>		
	</section> -->

<!-- 	<section class="thank_you pages">
		
		<div class="thank_you_banner_wrap">
			<div class="thank_you_banner">
				<div class="with-icon-thank-you-icon-leaf"></div>
				<div class="thank_you_banner_title_one">Thank you </div>
				<div class="thank_you_banner_title_two">For using recyclabook</div>
				<div class="thank_you_banner_summary">You have sold your books. You will recieve a cheque for <span class="thank_you_banner_summary_underline">£xx.xx</span> as soon as we get your books</div>
				<div class="thank_you_banner_paragraph">We'll be waiting for your books to arrive, in the meantime, <strong>you have an account now</strong>. You cna login and track the books and payments anytime, theres also an option to tell us when you've sent your books so we can get your payment out <strong>even quicker.</strong></div>
			</div>
			<div class="with-icon-thank-you-bottom-arrow"></div>
		</div>
		<div class="thank_you_circle_wrap">
			<div class="with-icon-thank-you-corn"></div>
			<div class="thank_you_circle_text_wrap">
				<div class="thank_you_circle_text_header">Alas we shall</div>
				<div class="thank_you_circle_text">to the edge of earth and back dear friend and trips and trips till death</div>
			</div>
		</div>
		<div class="with-icon-your-account"></div>
	</section> -->

	<!-- <section class="placeholder"></section> -->

<!-- 
	<section class="profile_hub">

		<div class="profile_hub_inner_wrap">

			<div class="profile_hub_header">
				<div class="profile_hub_header_title">Profile Hub</div>
				<div class="profile_hub_header_text">For withdrawals, tracking, order history and editing account details</div>
			</div>
			
			<div class="profile_hub_account profile_hub_box">
				<div class="profile_hub_account_bar">
					<div class="with-icon-profile-hub-account"></div>
					<div class="profile_hub_account_bar_greeting">Hi james</div>
					<div class="profile_hub_account_bar_text">Account Details</div>
				</div>
				<div class="profile_hub_account_body">
					<div class="profile_hub_account_main_details">
						<input type="text" class="profile_hub_account_main_details_small_input">
						<input type="text" class="profile_hub_account_main_details_small_input">
						<input type="text" class="profile_hub_account_main_details_large_input">
						<input type="text" class="profile_hub_account_main_details_small_input">
						<input type="text" class="profile_hub_account_main_details_small_input">
						<input type="text" class="profile_hub_account_main_details_small_input">
					</div>

					<div class="profile_hub_account_extra_details">
						<div class="profile_hub_account_extra_details_title">Registered email</div>
						<input type="text" class="profile_hub_account_extra_details_input">
					</div>
					<div class="profile_hub_account_extra_buttons">
						<div class="profile_hub_account_extra_buttons_small_button">
							<div class="with-icon-plus-for-profile-hub-account-extra-buttons"></div>
						</div>
						<div class="profile_hub_account_extra_buttons_large_button">Edit Account Details</div>
					</div>
				</div>
			</div>

			<div class="profile_hub_box_right profile_hub_bank">
				<div class="profile_hub_bank_bar">
					<div class="with-icon-for-profile-hub-bank"></div>
					<div class="profile_hub_bank_greeting">RecyclaBank</div>
				</div>
				<div class="profile_hub_bank_body">
					<div class="profile_hub_bank_status">
						<div class="profile_hub_bank_stats_first">
							<div class="with-icon-pig-for-account-balance"></div>
							<div class="profile_hub_bank_stats_label">Account balance</div>
							<input type="text" class="profile_hub_bank_stats_input" value="£10.32" readonly>
						</div>
						<div class="profile_hub_bank_stats_middle">
							<div class="with-icon-clock-for-account-withdrawal"></div>
							<div class="profile_hub_bank_stats_label">Last withdrawal</div>
							<input type="text" class="profile_hub_bank_stats_input" value="02/05/2013" readonly>
						</div>
						<div class="profile_hub_bank_stats_last">
							<div class="with-icon-hand-for-account-donation"></div>
							<div class="profile_hub_bank_stats_label">Total Donations</div>
							<input type="text" class="profile_hub_bank_stats_input" value="0.01" readonly>
						</div>
						<div class="profile_hub_bank_buttons">
							<div class="with-icon-for-bank-withdraw">Withdraw Funds</div>
							<div class="with-icon-for-bank-donate">Donate to RAG</div>
						</div>
					</div>
				</div>
			</div>

			<div class="profile_hub_tracking profile_hub_box_right">
				<div class="profile_hub_tracking_bar">
					<div class="with-icon-for-profile-hub-tracking"></div>
					<div class="profile_hub_tracking_bar_title">Book Tracking</div>
					<div class="profile_hub_tracking_bar_sort">
						<div class="profile_hub_tracking_bar_sort_drop">
							<div class="with-icon-for-profile-hub-tracking-drop-arrow"></div>
							<div class="profile_hub_tracking_bar_sort_drop_item">Order By</div>
							<div class="profile_hub_tracking_bar_sort_drop_item">Show something</div>
							<div class="profile_hub_tracking_bar_sort_drop_item">Something else</div>
						</div>
						<div class="with-icon-eye-for-profile-hub-tracking"></div>
						<div class="with-icon-down-arrow-for-profile-hub-drop"></div>
					</div>
				</div>
				<div class="profile_hub_tracking_body">
					<div class="profile_hub_tracking_inner_body">
						<div class="profile_hub_tracking_sroll">
							<div class="profile_hub_tracking_sroll_handle"></div>
						</div>
						<div class="profile_hub_tracking_show_bar">
							<div class="profile_hub_tracking_show_bar_text">Showing all</div>
							<div class="with-icon-for-profile-hub-tracking-envelope"></div>
						</div>
						<div class="profile_hub_tracking_items">
							<div class="profile_hub_tracking_title">Price promises</div>
							<div class="profile_hub_tracking_item">
								<div class="profile_hub_tracking_item_image"></div>
								<div class="profile_hub_tracking_item_text">
									<div class="profile_hub_tracking_item_text_title">Jaggernath</div>
									<div class="profile_hub_tracking_item_text_author">by Author</div>
									<div class="profile_hub_tracking_item_text_quote">£7.32</div>
									<div class="profile_hub_tracking_item_text_isbn">09232145</div>
								</div>
								<div class="profile_hub_tracking_item_options">
									<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/profilehub/freepost.png" alt="" class="profile_hub_tracking_item_options_image">
									<div class="with-icon-for-profile-hub-tracking-remove-book">Remove book</div>
								</div>
							</div>
							<div class="profile_hub_tracking_item">
								
								<div class="profile_hub_tracking_item_options_damaged_book_dropout">
									<div class="with-icon-left-arrow-for-damaged-book-box"></div> -->
								<!-- <div class="profile_hub_tracking_item_options_damaged_book_dropout_title">Comments</div>
									<div class="profile_hub_tracking_item_options_damaged_book_dropout_text">It was a reall poopady pop, and a stuffed ystuff stuff stuff</div>
								</div>

								<div class="profile_hub_tracking_item_image"></div>
								<div class="profile_hub_tracking_item_text">
									<div class="profile_hub_tracking_item_text_title">Jaggernath</div>
									<div class="profile_hub_tracking_item_text_author">by Author</div>
									<div class="profile_hub_tracking_item_text_quote">£7.32</div>
									<div class="profile_hub_tracking_item_text_isbn">09232145</div>
								</div>

								<div class="profile_hub_tracking_item_options">
									<div class="profile_hub_tracking_item_options_damaged_book_info">
										<div class="with-icon-for-damaged-book-info"></div>
										<div class="profile_hub_tracking_item_options_damaged_book_info_text">Damaged book</div>
									</div>								

									<div class="with-icon-for-damaged-book-return">Return</div>
									<div class="with-icon-for-damaged-book-donate">Donate</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="profile_hub_box profile_hub_history">
				<div class="profile_hub_history_bar">
					<div class="with-icon-for-profile-hub-history"></div>
					<div class="profile_hub_history_bar_greeting">Order History</div>
					<div class="profile_hub_history_notification"></div>
				</div>
				<div class="profile_hub_history_body">
					<div class="profile_hub_history_inner_body">
						<div class="profile_hub_history_scroll">
							<div class="profile_hub_history_scroll_handle"></div>
						</div>
						<div class="profile_hub_history_items">
							<div class="profile_hub_history_item">
								<div class="profile_hub_history_item_image"></div>
								<div class="profile_hub_history_item_text">
									<div class="profile_hub_history_item_title">Jagganath</div>
									<div class="profile_hub_history_item_author">by Author</div>
									<div class="profile_hub_history_item_price">£7.32</div>
									<div class="profile_hub_history_item_isbn">02930492</div>
								</div>
								<div class="profile_hub_history_item_icon">
									<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/profilehub/sold.png" class="profile_hub_history_item_icon_image">
									<div class="profile_hub_history_item_icon_date">02/05/2013</div>
								</div>
							</div>
							<div class="profile_hub_history_item">
								<div class="profile_hub_history_item_image"></div>
								<div class="profile_hub_history_item_text">
									<div class="profile_hub_history_item_title">Jagganath</div>
									<div class="profile_hub_history_item_author">by Author</div>
									<div class="profile_hub_history_item_price">£7.32</div>
									<div class="profile_hub_history_item_isbn">02930492</div>
								</div>
								<div class="profile_hub_history_item_icon">
									<img src="<?php echo FRAMEWORKURI; ?>/CSS/Includes/works/profilehub/donated.png" class="profile_hub_history_item_icon_image">
									<div class="profile_hub_history_item_icon_date">02/05/2013</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</section> -->






	















	






	<!-- <div class="homepage_blue_bar"></div> -->
	<!-- <div class="homepage_bottom_navigation_wrap">

		<div class="homepage_bottom_navigation">
			<div class="homepage_bottom_navigation_button">Contact</div>
			<div class="homepage_bottom_navigation_button">Got Questions?</div>
			<div class="homepage_bottom_navigation_button">Media</div>
			<div class="homepage_bottom_navigation_button">Jobs</div>
			<div class="homepage_bottom_navigation_button">Word From Us</div>
			<div class="homepage_bottom_navigation_button">T&C's</div>

			<div class="homepage_bottom_navigation_copyright">
				<div class="with-icon-bottom-navigation-copyright"></div>
				<div class="homepage_bottom_navigation_copyright_text">Recyclabook &copy. 2013</div>
			</div>
		</div>
	</div> -->

<?php get_footer(); ?>